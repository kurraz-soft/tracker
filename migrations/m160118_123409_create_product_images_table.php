<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_123409_create_product_images_table extends Migration
{
    public function up()
    {
        $this->createTable('product_images', [
            'id' => $this->primaryKey()->notNull(),
            'product_id' => $this->integer(),
            'tmp_id' => $this->string(255),
            'sort' => $this->integer(),
            'file' => $this->string(255)->notNull(),
        ]);

        $this->addForeignKey('f_product_images','product_images','product_id','products','id','cascade');
    }

    public function down()
    {
        $this->dropForeignKey('f_product_images','product_images');

        $this->dropTable('product_images');

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
