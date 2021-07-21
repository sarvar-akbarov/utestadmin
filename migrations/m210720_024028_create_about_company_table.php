<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%about_company}}`.
 */
class m210720_024028_create_about_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('{{%about_company}}', [
            'id' => $this->primaryKey(),
            'logo' => $this->string(255)->comment("Логотип"),
            'address' => $this->text()->comment("Адрес"),
            'phone' => $this->string(255)->comment("Телефон номер"),
            'email' => $this->string(255)->comment("email"),
            'coor_x' => $this->string(255)->comment("Координация Х"),
            'coor_y' => $this->string(255)->comment("Координация У"),
        ]);

        $this->insert('{{%about_company}}', [
            'address' => '4 Chilanzar Street, Tashkent 100115, Uzbekistan',
            'phone' => '+998909090193',
            'email' => \Yii::$app->params['adminEmail'],
            'coor_x' => '41.28701203091903',
            'coor_y' => '69.22834892421469',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%about_company}}');
    }
}
