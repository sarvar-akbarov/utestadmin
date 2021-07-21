<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test_items}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tests}}`
 */
class m210720_023526_create_test_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test_items}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer(),
            'name' => $this->string(255),
            'count' => $this->integer(),
            'answers' => $this->string(255),
            'ball' => $this->decimal(2,1),
        ]);

        // creates index for column `test_id`
        $this->createIndex(
            '{{%idx-test_items-test_id}}',
            '{{%test_items}}',
            'test_id'
        );

        // add foreign key for table `{{%tests}}`
        $this->addForeignKey(
            '{{%fk-test_items-test_id}}',
            '{{%test_items}}',
            'test_id',
            '{{%tests}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%tests}}`
        $this->dropForeignKey(
            '{{%fk-test_items-test_id}}',
            '{{%test_items}}'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            '{{%idx-test_items-test_id}}',
            '{{%test_items}}'
        );

        $this->dropTable('{{%test_items}}');
    }
}
