<?php

use yii\db\Schema;
use yii\db\Migration;

class m160310_135504_tbl_subscribe extends Migration
{
    public function up()
    {
        $tableOptions = null;
        $tableName = 'subscribe';
        if ($this->db->driverName === 'pgsql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = '';
        }
        $tableSchema = Yii::$app->db->schema->getTableSchema($tableName);
        if ($tableSchema === null) {
            $this->createTable('{{%subscribe}}', [
                'idsubscribe' => $this->primaryKey(),
                'email' => $this->string(),
                'date_subscribe' => $this->timestamp()->notNull()->defaultValue('now()'),
            ], $tableOptions);
        }
    }

    public function down()
    {
        $this->dropTable('{{%subscribe}}');
        return false;
    }
}
