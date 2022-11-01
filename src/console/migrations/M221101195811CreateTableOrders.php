<?php

namespace app\console\migrations;

use yii\db\Migration;

/**
 * Class M221101195811CreateTableOrders
 */
class M221101195811CreateTableOrders extends Migration
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
        echo "M221101195811CreateTableOrders cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M221101195811CreateTableOrders cannot be reverted.\n";

        return false;
    }
    */
}
