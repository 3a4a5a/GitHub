<?php

namespace common\modules\image\models;

use Yii;

/**
 * This is the model class for table "bimage".
 *
 * @property int $id
 * @property string $content
 * @property string $name
 * @property int $size
 * @property string $type
 * @property string $hash
 */
class BImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'name' => 'Name',
            'size' => 'Size',
            'type' => 'Type',
            'hash' => 'Hash',
        ];
    }
}