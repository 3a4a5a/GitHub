<?php

namespace common\modules\follow\models;

use Yii;

/**
 * This is the model class for table "follow".
 *
 * @property int $follower_id
 * @property int $followed_id
 */
class Follow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'follow';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'follower_id' => 'Follower ID',
            'followed_id' => 'Followed ID',
        ];
    }
    
    public static function primaryKey()
    {
        return ['follower_id'];
    }
}
