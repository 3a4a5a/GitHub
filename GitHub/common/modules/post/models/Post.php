<?php

namespace common\modules\post\models;

// Yii
use Yii;
use common\modules\comment\models\Comment;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use usualdesigner\yii2\behavior\HitableBehavior;
use yii\db\Expression;
use common\modules\image\models\BImage;
use common\modules\follow\models\Follow;
use common\modules\post\models\data\PostData;

// Custom
use common\modules\user\models\User;
use common\modules\label\models\Label;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $lead
 * @property string $text
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $commentable
 * @property int $user_id
 * @property int $image_id
 * @property string $publish_date
 * @property int $removed
 * @property int $hits_count
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE   = 1;
    const STATUS_DELETED  = 2;
    
    use \common\traits\ActiveRecordViewTrait;
    protected $viewDataClass = PostData::class;
    
    public $content;
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'hit' => [
                'class' => HitableBehavior::className(),
                'attribute' => 'hits_count',    //attribute which should contain uniquie hits value
                'group' => false,               //group name of the model (class name by default)
                'delay' => 60 * 60,             //register the same visitor every hour
                'table_name' => '{{%hits}}'     //table with hits data
            ]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'lead' => 'Lead',
            'text' => 'Text',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'commentable' => 'Commentable',
            'user_id' => 'User ID',
            'image_id' => 'Image ID',
            'publish_date' => 'Publish Date',
            'commentCount' => 'Comment Count',
            'removed' => 'Removed',
            'hits_count' => 'Hits Count',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::classname(), ['post_id' => 'id'])
                ->orderBy(['created_at' => SORT_DESC]);
    }
    
    /**
     * Visszatér a bejegyzéshez tartozó kommentek számával.
     * @return int
     */
    public function getCommentCount()
    {
        return $this->find()->where([
            'id' => $this->id
        ])->count();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabels() {
        return $this->hasMany(Label::className(), ['id' => 'label_id'])
            ->viaTable('post_label', ['post_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(BImage::className(), ['id' => 'image_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     * @param integer $id The user's ID whose followers need to be queried
     */
    /*public static function getPostsFromFollowersById($id)
    {
        return self::find()
                ->innerJoin('follow', 'post.user_id = follow.followed_id')
                ->where([
                    'follow.follower_id' => Yii::$app->user->id,
                    'status' => 1,
                ])
                ->andWhere(['!=', 'user_id', Yii::$app->user->id])
                ->orderBy([
                    'created_at' => SORT_DESC,
                ])
                ->with('user');
    }*/
}
