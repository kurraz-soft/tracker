<?php

use yii\db\Schema;
use yii\db\Migration;

class m160116_195002_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users',[
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'login' => $this->string(255)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('users');

        return true;
    }
}
