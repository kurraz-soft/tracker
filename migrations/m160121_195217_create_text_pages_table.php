<?php

use yii\db\Schema;
use yii\db\Migration;

class m160121_195217_create_text_pages_table extends Migration
{
    public function up()
    {
        $this->createTable('text_pages',[
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'text_detail' => $this->text(),
            'meta_title' => $this->string(255),
            'meta_description' => $this->string(255),
            'meta_keywords' => $this->string(255),
        ]);
    }

    public function down()
    {
        $this->dropTable('text_pages');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
