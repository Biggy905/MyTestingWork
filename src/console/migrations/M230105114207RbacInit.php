<?php

namespace app\console\migrations;

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;
use Yii;

class M230105114207RbacInit extends Migration
{
    public function up()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        $this->db = $authManager->db;

        $this->createTable($authManager->ruleTable, [
            'name' => $this->string(64)->notNull(),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY ([[name]])',
        ]);

        $this->createTable($authManager->itemTable, [
            'name' => $this->string(64)->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY ([[name]])',
            'FOREIGN KEY ([[rule_name]]) REFERENCES ' . $authManager->ruleTable . ' ([[name]])' .
            implode(' ', ['', 'ON DELETE SET NULL', 'ON UPDATE CASCADE']),
        ]);
        $this->createIndex('idx-auth_item-type', $authManager->itemTable, 'type');

        $this->createTable($authManager->itemChildTable, [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY ([[parent]], [[child]])',
            'FOREIGN KEY ([[parent]]) REFERENCES ' . $authManager->itemTable . ' ([[name]])' .
            implode(' ', ['', 'ON DELETE CASCADE', 'ON UPDATE CASCADE']),
            'FOREIGN KEY ([[child]]) REFERENCES ' . $authManager->itemTable . ' ([[name]])' .
            implode(' ', ['', 'ON DELETE CASCADE', 'ON UPDATE CASCADE']),
        ]);

        $this->createTable($authManager->assignmentTable, [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(),
            'PRIMARY KEY ([[item_name]], [[user_id]])',
            'FOREIGN KEY ([[item_name]]) REFERENCES ' . $authManager->itemTable . ' ([[name]])' .
            implode(' ', ['', 'ON DELETE CASCADE', 'ON UPDATE CASCADE']),
        ]);
        $this->createIndex('auth_assignment_user_id_idx', $authManager->assignmentTable, 'user_id');

        $this->dropIndex('auth_assignment_user_id_idx', $authManager->assignmentTable);
        $this->createIndex('{{%idx-auth_assignment-user_id}}', $authManager->assignmentTable, 'user_id');

        $this->dropIndex('idx-auth_item-type', $authManager->itemTable);
        $this->createIndex('{{%idx-auth_item-type}}', $authManager->itemTable, 'type');
    }

    public function down()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        $this->db = $authManager->db;

        $this->dropTable($authManager->assignmentTable);
        $this->dropTable($authManager->itemChildTable);
        $this->dropTable($authManager->itemTable);
        $this->dropTable($authManager->ruleTable);
    }
}
