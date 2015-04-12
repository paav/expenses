<?php

class m150412_135455_add_address_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('address', array(
            'id' => 'pk',
            'line1' => 'string not null',
            'line2' => 'string',
            'line3' => 'string',
        ), 'engine=innodb default charset=utf8');
	}

	public function down()
	{
        $this->dropTable('address');
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
