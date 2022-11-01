<?php

namespace app\console\migrations;

use yii\db\Migration;

/**
 * Class M221101201456CreateTableUserType
 */
class M221101201456CreateTableUserType extends Migration
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
        echo "M221101201456CreateTableUserType cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M221101201456CreateTableUserType cannot be reverted.\n";

        return false;
    }
    */
}
