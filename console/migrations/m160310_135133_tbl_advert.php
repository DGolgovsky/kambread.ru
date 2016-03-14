<?php

use yii\db\Schema;
use yii\db\Migration;

class m160310_135133_tbl_advert extends Migration
{
    public function up()
    {
        $this->execute("
                CREATE TABLE IF NOT EXISTS advert (
                    idadvert INT PRIMARY KEY DEFAULT NEXTVAL('advert_id_seq'),
                    price INT DEFAULT NULL,
                    address varchar(255) DEFAULT NULL,
                    fk_agent INT DEFAULT NULL,
                    bedroom smallint DEFAULT NULL,
                    livingroom smallint DEFAULT NULL,
                    parking smallint DEFAULT NULL,
                    kitchen smallint DEFAULT NULL,
                    general_image varchar(200) DEFAULT NULL,
                    description text,
                    location varchar(30) DEFAULT NULL,
                    hot smallint DEFAULT NULL,
                    sold smallint DEFAULT NULL,
                    type varchar(50) DEFAULT NULL,
                    recommend smallint DEFAULT NULL,
                    created_at int NOT NULL,
                    updated_at int NOT NULL
                ); ALTER TABLE advert ALTER COLUMN idadvert SET DEFAULT NEXTVAL('advert_id_seq');
        ");
    }
    
    public function down()
    {
        $this->dropTable("advert");
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
