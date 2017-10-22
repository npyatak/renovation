<?php

use yii\db\Migration;


class m171020_140535_create_table_house extends Migration
{
    public function safeUp() {
        $data = require(__DIR__ . '/_house_data.php');
        
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%house}}', [
            'id' => $this->primaryKey(),
            'district_id' => $this->integer()->notNull(),
            'region_id' => $this->integer()->notNull(),
            'address' => $this->string(),

            'lat' => $this->decimal(10, 8),
            'lng' => $this->decimal(11, 8),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

        ], $tableOptions);
        
        $this->addForeignKey("{house}_district_id_fkey", '{{%house}}', 'district_id', '{{%district}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey("{house}_region_id_fkey", '{{%house}}', 'region_id', '{{%region}}', 'id', 'CASCADE', 'CASCADE');
        
        $this->batchInsert('{{%house}}', ['district_id', 'region_id', 'address', 'lat', 'lng', 'created_at', 'updated_at'], 
            $data
        );
    }

    public function safeDown() {
        $this->dropTable('{{%house}}');
    }
}
