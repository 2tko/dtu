<?php

use yii\db\Migration;

/**
 * Class m210205_160710_CreateUserAddressTables
 */
class m210205_160710_CreateUserAddressTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('clients', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'gender' => $this->smallInteger()->notNull()->defaultValue(0),
            'login' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createIndex('login', 'clients', 'login', true);

        $this->createTable('addresses', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'zip_code' => $this->string(10)->notNull(),
            'country' => $this->string(2)->notNull(),
            'city' => $this->string()->notNull(),
            'street' => $this->string()->notNull(),
            'house_number' => $this->string(10)->notNull(),
            'office_number' => $this->string(10)->null(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey(
            'client_address',
            'addresses',
            'client_id',
            'clients',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('addresses');
        $this->dropTable('clients');
    }
}
