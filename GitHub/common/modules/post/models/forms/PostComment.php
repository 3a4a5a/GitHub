<?php

/* @var $post \common\modules\post\models\forms\PostComment */

namespace common\modules\post\models\forms;

// Yii
use Yii;
use yii\base\Model;

// Custom
use common\modules\comment\models\Comment;
use common\modules\post\models\Post;

class PostComment extends Model
{
    public $text;
    public $user_id;
    public $post_id;
    
    public function rules()
    {
        return [
            ['text', 'string', 'max' => 120],
            ['text', 'string', 'min' => 20],
        ];
    }
    
    /**
     * 
     * @return integer visszaadja a frissen beszúrt komment id-ját.
     * 0 Ha sikertlen a mnetés
     */
    public function saveComment()
    {
        if (strlen(trim($this->text)) == 0) {
            return false;
        }

        $comment = new Comment([
            'text' => $this->text,
            'post_id' => $this->post_id,
            'user_id' => Yii::$app->user->id,
        ]);
        
        if ($comment->save()) {
            $comment->refresh();
            $this->incrementCommentCount(); // +1 comment a komment counthoz
            return $comment->id;
        } else {
            return 0;
        }
    }
    
    /**
     * @return int Az érintett sorok számával tér vissza (1 ha minden jó)
     */
    public function incrementCommentCount()
    {
        return Post::updateAllCounters(['commentCount' => 1], ['id' => $this->post_id]);
    }
}