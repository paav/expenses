<?php

class m150423_143535_add_vendor_id_column_to_part_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('part', 'vendor_id', 'smallint(5) unsigned');
        $this->createIndex('ix_fk_vendor$part', 'part', 'vendor_id');
        $this->addForeignKey('fk_vendor$part', 'part', 'vendor_id',
                             'vendor', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('fk_vendor$part', 'part');
        $this->dropIndex('ix_fk_vendor$part', 'part');

        $this->dropColumn('part', 'vendor_id');
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
