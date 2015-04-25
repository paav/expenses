<?php

class m150423_130808_add_vendor_table extends CDbMigration
{
	public function up()
	{
        $sql = <<<'A'
CREATE TABLE IF NOT EXISTS `vendor`
    (
        `id` SMALLINT UNSIGNED AUTO_INCREMENT,
        `name` VARCHAR(50) NOT NULL,
        PRIMARY KEY(`id`)
    )
    SELECT `id`,`manufacturer` `name`
    FROM `part`;
A;

        $this->execute($sql);
	}

	public function down()
	{
        $this->dropTable('vendor');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
