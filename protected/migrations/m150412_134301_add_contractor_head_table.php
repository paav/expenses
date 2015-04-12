<?php

class m150412_134301_add_contractor_head_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('contractor_head', array(
            'id' => 'smallint(5) unsigned not null auto_increment',
            'name' => 'varchar(255) not null',
            'primary key (id)',
        ), 'engine=innodb default charset=utf8');
	}

	public function down()
	{
        $this->dropTable('contractor_head');
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
