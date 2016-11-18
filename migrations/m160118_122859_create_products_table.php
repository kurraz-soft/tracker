<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_122859_create_products_table extends Migration
{
    public function up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'active' => $this->boolean()->defaultValue(true),
            'name' => $this->string('255')->notNull(),
            'text_preview' => $this->text(),
            'text_detail' => $this->text(),
            'price' => $this->decimal('10,2'),
        ]);
    }

    public function down()
    {
        $this->dropTable('products');

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
