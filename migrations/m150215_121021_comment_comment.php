<?php

use yii\db\Schema;
use yii\db\Migration;
use bariew\commentAbstractModule\models\Comment;
class m150215_121021_comment_comment extends Migration
{
    public function up()
    {
        $this->createTable(Comment::tableName(), [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'owner_id' => Schema::TYPE_INTEGER,
            'parent_class' => Schema::TYPE_STRING,
            'parent_id' => Schema::TYPE_INTEGER,
            'branch_id' => Schema::TYPE_INTEGER,
            'content' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_SMALLINT,
        ]);
    }

    public function down()
    {
        $this->dropTable(Comment::tableName());
    }
}
