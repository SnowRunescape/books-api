<?php

class m240913_023557_books extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'author' => $this->string()->notNull(),
            'isbn' => $this->string()->notNull(),
            'price' => $this->string(11)->notNull(),
            'stock' => $this->integer()->notNull(),
            'image' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('IDX_TITLE', 'books', 'title');
        $this->createIndex('IDX_AUTHOR', 'books', 'author');
        $this->createIndex('IDX_ISBN', 'books', 'isbn');
        $this->createIndex('IDX_PRICE', 'books', 'price');
    }

    public function down()
    {
        $this->dropTable('books');
    }
}
