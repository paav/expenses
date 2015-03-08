<?php

class m150307_114250_create_fuel_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('fuel', array(
            'id' => 'smallint(5) unsigned not null auto_increment',
            'name' => 'varchar(255) not null',
            'primary key (id)',
        ), 'engine=innodb default charset=utf8');
	}

	public function down()
	{
        $this->dropTable('fuel');
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
