<?php
Yii::import('ext.paavtable.PaavTable');

class ContractorPaavTable extends PaavTable
{
    public $contractorType;

    public function init()
    {
        if (!isset($this->contractorType))
            throw new CException(
                'You must provide `ContractorType` property initial value');

        $this->columns = array('head.name','addressr.line1','note');
        $this->view = 'components.paavtable-custom.views.table';

        $this->dataProvider = new CActiveDataProvider('Contractor', array(
            'criteria' => array(
                'condition' => 'type_id=?',
                'with' => array('addressr', 'head'),
                'params' => array($this->contractorType),
            ),
            'sort' => array(
                'attributes' => array('name', 'addressr.line1', 'head.name'),
                'defaultOrder' => array('head.name' => CSort::SORT_ASC)
            )
        ));

        $pages = new CPagination($this->dataProvider->totalItemCount);
        $pages->pageSize = 10;
        $pages->applyLimit($this->dataProvider->criteria);
        $this->dataProvider->pagination = $pages;
        
        return parent::init();
    }
    
}
