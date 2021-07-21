<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210531_070431_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string(255)->comment("Логин"),
            'phone' => $this->string(255)->comment("Телефон номер"),
            'password' => $this->string(255)->comment("Пароль"),
            'fio' => $this->string(255)->comment("ФИО"),
            'avatar' => $this->string(255)->comment("Аватар пользователя"),
            'status' => $this->integer()->comment("Статус пользователя"), // Статус пользователя 1 => Aktiv, 2 => No Aktiv
            'permission' => $this->integer()->comment(""),//1- admin, 2- moderator, 3- student
        ]);

        $faker = Faker\Factory::create();

        $this->insert('{{%user}}',[
            'fio' => $faker->name(),
            'phone' => $faker->e164PhoneNumber(),
            'status' => 1,
            'permission' => 1,
            'login' => 'admin',
            'password' => \Yii::$app->getSecurity()->generatePasswordHash('admin')
        ]);

        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(255)->comment("Телефон номер"),
            'telegram_id' => $this->string(20),
            'fio' => $this->string(255)->comment("ФИО"),
            'telegram_id' => $this->string(30),
            'status' => $this->integer()->comment("Статус пользователя"), // Статус пользователя 1 => Aktiv, 2 => No Aktiv
            'balance' => $this->decimal(10,2),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%student}}');
        $this->dropTable('{{%user}}');
    }
}
