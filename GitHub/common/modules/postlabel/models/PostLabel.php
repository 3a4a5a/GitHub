<?php

namespace common\modules\postlabel\models;

use Yii;

/**
 * This is the model class for table "post_label".
 *
 * @property int $label_id
 * @property int $post_id
 */
class PostLabel extends \yii\db\ActiveRecord
{
    public $name;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_label';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label_id', 'post_id'], 'required'],
            [['label_id', 'post_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'label_id' => 'Label ID',
            'post_id' => 'Post ID',
        ];
    }
    
    public static function primaryKey()
    {
        return ['post_id'];
    }
}
