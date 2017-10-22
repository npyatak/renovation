<?php

use yii\db\Migration;

class m171020_150535_create_table_compare extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%compare}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull(),
            'title' => $this->string(),
            'image' => $this->string(),

            'new_text' => $this->text(),
            'old_text' => $this->text(),

            'status' => $this->integer()->notNull()->defaultValue(5),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

        ], $tableOptions);
        
    }

    public function safeDown() {
        $this->dropTable('{{%compare}}');
    }
}
