<?php

use yii\db\Migration;

class m171024_112435_create_table_gallery extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%gallery}}', ['title'],  [
            ['Состояние домов, попавших в программу реновации'],
            ['Дома, построенные для переселения жильцов пятиэтажек в рамках программы реновации'],
            ['Примерная отделка квартир в новых домах'],
            ['Социальные обязательства: детские площадки, садики, школы и поликлиники'],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%gallery}}');
    }
}