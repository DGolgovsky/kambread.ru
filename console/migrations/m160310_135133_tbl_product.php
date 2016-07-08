<?php

use yii\db\Schema;
use yii\db\Migration;

class m160310_135133_tbl_product extends Migration
{
	public function up()
	{
		$tableOptions = null;
		$tableName = 'product';
		if ($this->db->driverName === 'pgsql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = '';
		}
		$tableSchema = Yii::$app->db->schema->getTableSchema($tableName);
		if ($tableSchema === null) {
		$this->createTable('{{%product}}', [
			'idproduct' => $this->primaryKey(),
			'price' => $this->double(),
			'user_id' => $this->integer()->unsigned()->notNull(),
			'name' => $this->string(255),
			'general_image' => $this->string(255),
			'description' => $this->string(),
			'new' => $this->boolean()->notNull(),
			'type' => $this->smallInteger(),
			'recommend' => $this->boolean()->notNull(),
			'created_at' => $this->integer()->unsigned()->notNull(),
			'updated_at' => $this->integer()->unsigned()->notNull(),
		], $tableOptions);
	}}

	public function down()
	{
		$this->dropTable('{{%product}}');
		return false;
	}
}
