<?php

use yii\db\Migration;

class m171027_113435_create_table_timeline_slide extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%timeline_slide}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'date' => $this->integer()->notNull(),
            'number' => $this->integer(),
            'width_preset' => $this->integer(1),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%timeline_slide}}');
    }
}