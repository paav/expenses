<?php

class m150410_073152_add_user_id_column extends CDbMigration
{
	public function up()
	{
        $this->addColumn('expense', 'user_id', 'int(10) unsigned not null');
        $this->update('expense', array('user_id' => 3), '');
        $this->createIndex('ix_fk_user$expense', 'expense', 'user_id');
		$this->addForeignKey('fk_user$expense', 'expense', 'user_id', 'user', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('fk_user$expense', 'expense');
        $this->dropIndex('ix_fk_user$expense', 'expense');
        $this->dropColumn('expense', 'user_id');
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
