<?php

namespace app\console\migrations;

use yii\db\Migration;

/**
 * Class M220927084118Users
 */
class M220927084118Users extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%users}}',
            [
                'id' => $this->primaryKey(),
                'first_name' => $this->string(),
                'last_name' => $this->string(),
                'email' => $this->string(),
                'password' => $this->string(),
                'role' => $this->string(),
                'status' => $this->string(),
                'logged_at' => $this->dateTime(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
                'deleted_at' => $this->dateTime(),
            ]
        );
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%users}}');
    }
}
