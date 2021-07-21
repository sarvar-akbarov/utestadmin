<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%results}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%student}}`
 * - `{{%tests}}`
 * - `{{%test_items}}`
 */
class m210720_023659_create_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%results}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(),
            'test_id' => $this->integer(),
            'test_item_id'=> $this->integer(),
            'answers' => $this->string(255),
            'point' => $this->decimal(3,2),
        ]);

        // creates index for column `student_id`
        $this->createIndex(
            '{{%idx-results-student_id}}',
            '{{%results}}',
            'student_id'
        );

        // add foreign key for table `{{%student}}`
        $this->addForeignKey(
            '{{%fk-results-student_id}}',
            '{{%results}}',
            'student_id',
            '{{%student}}',
            'id',
            'CASCADE'
        );

        // creates index for column `test_id`
        $this->createIndex(
            '{{%idx-results-test_id}}',
            '{{%results}}',
            'test_id'
        );

        // add foreign key for table `{{%tests}}`
        $this->addForeignKey(
            '{{%fk-results-test_id}}',
            '{{%results}}',
            'test_id',
            '{{%tests}}',
            'id',
            'CASCADE'
        );

        // creates index for column `test_item_id`
        $this->createIndex(
            '{{%idx-results-test_item_id}}',
            '{{%results}}',
            'test_item_id'
        );

        // add foreign key for table `{{%test_items}}`
        $this->addForeignKey(
            '{{%fk-results-test_item_id}}',
            '{{%results}}',
            'test_item_id',
            '{{%test_items}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%student}}`
        $this->dropForeignKey(
            '{{%fk-results-student_id}}',
            '{{%results}}'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            '{{%idx-results-student_id}}',
            '{{%results}}'
        );

        // drops foreign key for table `{{%tests}}`
        $this->dropForeignKey(
            '{{%fk-results-test_id}}',
            '{{%results}}'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            '{{%idx-results-test_id}}',
            '{{%results}}'
        );

        // drops foreign key for table `{{%test_items}}`
        $this->dropForeignKey(
            '{{%fk-results-test_item_id}}',
            '{{%results}}'
        );

        // drops index for column `test_item_id`
        $this->dropIndex(
            '{{%idx-results-test_item_id}}',
            '{{%results}}'
        );

        $this->dropTable('{{%results}}');
    }
}
