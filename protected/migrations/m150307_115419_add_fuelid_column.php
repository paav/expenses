<?php

class m150307_115419_add_fuelid_column extends CDbMigration
{
	public function up()
	{
		$this->addColumn('expense', 'fuel_id', 'SMALLINT(5) UNSIGNED DEFAULT NULL');
		$this->createIndex('ix_fk_fuel$expense', 'expense', 'fuel_id');
		$this->addForeignKey('fk_fuel$expense', 'expense', 'fuel_id', 'fuel', 'id');
	}

	public function down()
	{
		$this->dropColumn('expense', 'fuel_id');
		$this->dropIndex('ix_fk_fuel$expense', 'expense');
		$this->dropForeignKey('fk_fuel$expense', 'expense');
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
