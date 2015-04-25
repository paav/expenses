<?php

class m150422_224702_add_parent_id_column_to_part_type_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('part_type', 'parent_id', 'smallint(5) unsigned');
        $this->createIndex('ix_fk_part_type$part_type', 'part_type',
                           'parent_id');
        $this->addForeignKey('fk_part_type$part_type', 'part_type',
                             'parent_id', 'part_type', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('fk_part_type$part_type', 'part_type');
        $this->dropIndex('ix_fk_part_type$part_type', 'part_type');
        $this->dropColumn('part_type', 'parent_id');
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
