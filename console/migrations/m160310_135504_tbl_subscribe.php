<?php

use yii\db\Schema;
use yii\db\Migration;

class m160310_135504_tbl_subscribe extends Migration
{
    public function up()
    {
        $this->execute("
                CREATE TABLE IF NOT EXISTS subscribe (
                    idsubscribe INT NOT NULL,
                    email varchar(50) DEFAULT NULL,
                    date_subscribe timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    CONSTRAINT production UNIQUE(idsubscribe)
                );
        ");
    }
    
    public function down()
    {
        $this->dropTable("subscribe");
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
