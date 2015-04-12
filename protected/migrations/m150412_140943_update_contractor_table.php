<?php

class m150412_140943_update_contractor_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('contractor', 'head_id', 'smallint(10) unsigned not null');
        $this->addColumn('contractor', 'address_id', 'integer');

        // Fills contractor_head and address tables with data from contractor
        // table
        $cmd = $this->dbConnection->createCommand(array(
            'select' => 'id,name,address',
            'from' => 'contractor'
        ));

        $rows = $cmd->queryAll();

        $i = 1;

        foreach ($rows as $row) {
            $this->update('contractor', array(
                'head_id' => $i,
                'address_id' => $i
            ), 'id=:id', array(':id' => $row['id']));

            $this->insert('contractor_head', array(
                'id' => $i,
                'name' => $row['name']
            ));
            $this->insert('address', array(
                'id' => $i,
                'line1' => $row['address']
            ));

            $i++;
        }

        $this->createIndex('ix_fk_contractor_head$contractor', 'contractor',
                           'head_id');
        $this->createIndex('ix_fk_address$contractor', 'contractor',
                           'address_id');
        $this->addForeignKey('fk_contractor_head$contractor', 'contractor',
                             'head_id', 'contractor_head', 'id');
        $this->addForeignKey('fk_address$contractor', 'contractor',
                             'address_id', 'address', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('fk_contractor_head$contractor', 'contractor');
        $this->dropForeignKey('fk_address$contractor', 'contractor');
        $this->dropIndex('ix_fk_contractor_head$contractor', 'contractor');
        $this->dropIndex('ix_fk_address$contractor', 'contractor');

        $this->dropColumn('contractor', 'head_id');
        $this->dropColumn('contractor', 'address_id');

        $this->truncateTable('contractor_head');
        $this->truncateTable('address');
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
