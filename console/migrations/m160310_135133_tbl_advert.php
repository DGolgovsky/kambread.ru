<?php

use yii\db\Schema;
use yii\db\Migration;

class m160310_135133_tbl_advert extends Migration
{
	public function up()
	{
		$tableOptions = null;
		$tableName = 'advert';
		if ($this->db->driverName === 'pgsql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = '';
		}
		
		$this->createTable('{{%advert}}', [
			'idadvert' => $this->primaryKey(),
			'price' => $this->integer(),
			'address' => $this->string(255),
			'fk_agent' => $this->integer()->notNull(),
			'bedroom' => $this->smallInteger(),
			'livingroom' => $this->smallInteger(),
			'parking' => $this->smallInteger(),
			'kitchen' => $this->smallInteger(),
			'general_image' => $this->string(255),
			'description' => $this->string(),
			'location' => $this->string(32),
			'hot' => $this->smallInteger(),
			'sold' => $this->smallInteger(),
			'type' => $this->smallInteger(),
			'recommend' => $this->smallInteger(),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
		], $tableOptions);
	}

	public function down()
	{
		$this->dropTable('{{%advert}}');
	}
}
