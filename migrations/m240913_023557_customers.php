<?php

class m240913_023557_customers extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('customers', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'cpf' => $this->string(14)->notNull()->unique(),
            'cep' => $this->string(9)->notNull(),
            'street' => $this->string()->notNull(),
            'number' => $this->string(10)->notNull(),
            'city' => $this->string()->notNull(),
            'state' => $this->string(2)->notNull(),
            'complement' => $this->string()->notNull(),
            'gender' => $this->char(1)->notNull()->check("gender IN ('M', 'F')"),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('IDX_CPF', 'customers', 'cpf');
        $this->createIndex('IDX_NAME', 'customers', 'name');
        $this->createIndex('IDX_CITY', 'customers', 'city');
    }

    public function down()
    {
        $this->dropTable('customers');
    }
}
