<?php

use yii\db\Migration;

class m171024_113435_create_table_gallery_slide extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gallery_slide}}', [
            'id' => $this->primaryKey(),
            'gallery_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'image' => $this->string(255),
            'number' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey("{gallery_slide}_gallery_id_fkey", '{{%gallery_slide}}', 'gallery_id', '{{%gallery}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%gallery_slide}}');
    }
}