<?php

use yii\db\Migration;

/**
 * Class m210721_003715_create_seeder
 */
class m210721_003715_create_seeder extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add a few data to categories table

        $categories = [
            'Mateatika',
            'Tarix',
            'Fizika',
            'Biologiya'
        ];

        foreach($categories as $category){
            $this->insert('{{%categories}}', [
                'name' => $category,
                'type' => 0,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
        $this->insert('{{%categories}}', [
            'name' => 'Blok test',
            'type' => 1,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        // -----------------------

        

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
