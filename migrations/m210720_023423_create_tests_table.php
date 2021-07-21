<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tests}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%categories}}`
 */
class m210720_023423_create_tests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tests}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description' => $this->text(),
            'analyse' => $this->string(255),
            'main_file' => $this->string(255),
            'images' => $this->string(512),
            'category_id' => $this->integer(),
            'is_premium' => $this->boolean(),
            'user_id' => $this->integer(),
            'has_gift' => $this->boolean()
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-tests-category_id}}',
            '{{%tests}}',
            'category_id'
        );

        // add foreign key for table `{{%categories}}`
        $this->addForeignKey(
            '{{%fk-tests-category_id}}',
            '{{%tests}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-tests-user_id}}',
            '{{%tests}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-tests-user_id}}',
            '{{%tests}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-tests-user_id}}',
            '{{%tests}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-tests-user_id}}',
            '{{%tests}}'
        );

        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-tests-category_id}}',
            '{{%tests}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-tests-category_id}}',
            '{{%tests}}'
        );

        $this->dropTable('{{%tests}}');
    }
}
