<?php

use yii\db\Migration;

/**
 * Class m180910_165443_user
 */
class m180910_165443_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180910_165443_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180910_165443_user cannot be reverted.\n";

        return false;
    }
    */
}
