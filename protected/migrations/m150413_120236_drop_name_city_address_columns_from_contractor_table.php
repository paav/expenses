<?php

class m150413_120236_drop_name_city_address_columns_from_contractor_table extends CDbMigration
{
	public function up()
	{
        foreach (array('name', 'city', 'address') as $column)
            $this->dropColumn('contractor', $column);
	}

	public function down()
	{
		echo "Contact with creator of this migration to get data for previous state restoring.\n";
		return false;
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
