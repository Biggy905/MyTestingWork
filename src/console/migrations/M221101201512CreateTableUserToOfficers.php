<?php

namespace app\console\migrations;

use yii\db\Migration;

/**
 * Class M221101201512CreateTableUserToOfficers
 */
class M221101201512CreateTableUserToOfficers extends Migration
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
        echo "M221101201512CreateTableUserToOfficers cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M221101201512CreateTableUserToOfficers cannot be reverted.\n";

        return false;
    }
    */
}
