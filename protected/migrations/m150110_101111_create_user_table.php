<?php

class m150110_101111_create_user_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('gender', array(
            'id' => 'smallint(5) unsigned not null auto_increment',
            'name' => 'varchar(50) default null',
            'primary key (id)',
        ), 'engine=innodb default charset=utf8');

        $this->createTable('user', array(
            'id' => 'int(10) unsigned not null auto_increment',
            'username' => 'varchar(100) not null',
            'password' => 'varchar(100) not null',
            'email' => 'varchar(100) not null',
            'first_name' => 'varchar(100)',
            'gender_id' => 'smallint(5) unsigned not null',
            'primary key (id)',
            'index ix_fk_gender$user (gender_id)',
            'constraint fk_gender$user foreign key (gender_id) references gender (id)',
        ), 'engine=innodb default charset=utf8');

	}

	public function down()
	{
        $this->dropTable('gender');
        $this->dropTable('user');
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
