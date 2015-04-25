<?php

class m150423_144749_copy_data_from_vendor_table_id_column_to_part_table_vendor_id_column extends CDbMigration
{
	public function up()
	{
        $sql = <<<'A'
UPDATE `part`,`vendor`
SET `part`.`vendor_id`=`vendor`.`id`
WHERE `part`.`id`=`vendor`.`id`
A;

        $this->execute($sql);
	}

	public function down()
	{
        $sql = <<<'A'
UPDATE `part`
SET `vendor_id`=DEFAULT
A;

        $this->execute($sql);
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
