<?php

class m150423_115350_add_volume_sae_grade_columns_to_part_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('part', 'volume', 'decimal(5,2)');
        $this->addColumn('part', 'sae_grade', 'char(6)');
	}

	public function down()
	{
        $this->dropColumn('part', 'volume');
        $this->dropColumn('part', 'sae_grade');
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
