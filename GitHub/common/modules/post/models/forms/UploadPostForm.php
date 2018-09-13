<?php

/* @var $image common\modules\image\models\Image */
/* @var $_image \yii\web\UploadedFile */

namespace common\modules\post\models\forms;

use Yii;
use yii\base\Model;
use \common\modules\image\models\BImage;
use common\modules\post\models\Post;
use yii\web\UploadedFile;

use yii\imagine\Image;
use Imagine\Image\Box;
use common\modules\label\models\Label;
use common\modules\postlabel\models\PostLabel;

/**
 * Login form
 */
class UploadPostForm extends Model
{
    // Oszlopok
    public $user_id;
    public $title;
    public $text;
    public $lead;
    public $status;
    public $commentable;
    public $publish_date;
    public $image_id;
    
    // Kapcsoló táblák
    // postlabel
    public $labels = null;
    
    // Objektumok
    public $_image;
    
    // Általános
    private $hash;
    private $thumbDirUrl;
    public $existingLabels;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['title', 'required'],
            ['title', 'string', 'max' => 64],
            
            ['lead', 'required'],
            ['lead', 'string', 'max' => 128],
            
            ['text', 'required'],
            ['text', 'string'],
            
            ['labels', 'each', 'rule' => ['string']],
            
            ['commentable', 'integer'],
            ['user_id', 'integer'],
            ['status', 'integer'],
            
            [['_image'], 'image', 'extensions' => 'jpg,png', 'skipOnEmpty' => true],
            
            [['publish_date'], 'date',
                'format' => 'yyyy-mm-dd',
            ],
        ];
    }
    
    public function handleImage()
    {
        $this->_image = UploadedFile::getInstance($this, '_image');
        
        if ($this->_image) {
            $this->initImage();
        }
    }
    
    private function initImage()
    {
        $this->hash = md5_file($this->_image->tempName);
        
        if (!$this->imageHashExists($this->hash)) {
            $this->createFolders();
            
            // Kép átméretezése az adatbázisban való tárolás előtt (ha szükséges)
            $size = getimagesize($this->_image->tempName);
            $width = $size[0];
            $height = $size[1];
            
            if ($width > 1024 || $height > 1024) {
                Image::getImagine()->open($this->_image->tempName)
                        ->thumbnail(new Box(1024, 1024))
                        ->save($this->_image->tempName , ['quality' => 90]);
            }
            
            $image = new BImage([
                'name' => $this->_image->name,
                'type' => $this->_image->type,
                'size' => $this->_image->size,
                'content' => file_get_contents($this->_image->tempName),
                'hash' => $this->hash,
            ]);
            
            $image->save();
            $this->saveImgTmb(); 
            
            // Az index visszaszerzése (egyszerűbb mód biztos van?!)
            $res = BImage::find()->select('id')->where(['hash' => $this->hash])->all();
            $this->image_id = $res[0]->id;
        }
    }
    
    /**
     * Megnézi van-e már ilyen kép feltöltve a szerverre.
     * @return Integer 
     */
    private function imageHashExists($hash)
    {
        $res = BImage::find()->select('id')->where(['hash' => $this->hash])->all();
        if ($res != null) {
            $this->image_id = $res[0]->id;
            return $res;
        } else {
            $this->image_id = null; // A biztonság kedvéért ráerősítünk
            return false;
        }
    }
    
    /**
     * Létrehozza a könyvtárakat ha szükséges
     */
    private function createFolders()
    {
        $this->thumbDirUrl = 'uploads/' . Yii::$app->user->id . '/images/thumb/' . $this->hash . '/';
        
        if (!is_dir($this->thumbDirUrl)) {    
            mkdir($this->thumbDirUrl, 0777, true);
        }
    }
    
    private function saveImgTmb()
    {
        // Thumbnail létrehozása és tárolása a fájlrendszerben.
        Image::getImagine()->open($this->_image->tempName)
                ->thumbnail(new Box(120, 120))
                ->save($this->thumbDirUrl . $this->_image->name , ['quality' => 90]);
    }
    
    /**
     * 
     * @return int A bejegyzett poszt elsődleges kulcsa
     */
    public function save()
    {
        $post = new Post([
            'title' => $this->title,
            'lead' => $this->lead,
            'user_id' => $this->user_id,
            'text' => $this->text,
            'publish_date' => $this->publish_date,
            'commentable' => $this->commentable,
            'status' => $this->status,
            'image_id' => $this->image_id
        ]);
        
        $post->save();
        
        $postId = $post->getPrimaryKey();
        $existingLabelNames = array();
        
        if ($this->labels != null) {
            $existingLabels = Label::find()->all();
            
            foreach($existingLabels as $labelObj) {
                $existingLabelNames[] = $labelObj->name;
            }

            foreach ($this->labels as $labelName) {
                if (!in_array($labelName, $existingLabelNames)) { // Ha új a label.
                    $label = new Label();
                    $label->name = $labelName;
                    $label->save();
                    $postLabel = new PostLabel();

                    // Elsődleges kulcs visszaszerzése.
                    $labelId = $label->getPrimaryKey();

                    $postLabel->post_id = $postId;
                    $postLabel->label_id = $labelId;
                } else { // Létező labelt kell hozzárendelni a bejegyzéshez.
                    $label = Label::find()->where(['name' => $labelName])->all();
                    $label = $label[0];

                    $postLabel = new PostLabel();
                    $postLabel->label_id = $label->id;
                    $postLabel->post_id = $postId;
                }

                $postLabel->save();
            }
        }
        
        return $postId;
    }
}
