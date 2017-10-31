<?php

use yii\db\Migration;

class m171030_133934_alter_table_gallery extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn("{{%gallery}}", 'image', $this->string());
    }

    public function safeDown() {
        $this->dropColumn("{{%gallery}}", 'image');
    }
}
