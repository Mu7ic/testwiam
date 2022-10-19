<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m221019_141126_create_table_vote_images
 */
class m221019_141126_create_table_vote_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('vote_images', [
            'id' => $this->primaryKey(),
            'id_image' => $this->integer()->notNull(),
            'url_image' => $this->string()->notNull(),
            'vote' => $this->boolean()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('vote_images');
    }
}
