<?php

/**
 */
class PartExpense extends Expense
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        $rules = array(
            array('part_id, unit_price, quantity', 'required'),
			array('part_id', 'numerical', 'integerOnly'=>true),
            array('quantity', 'numerical'),
			array('unit_price', 'numerical', 'min'=>0, 'max'=>999999.99),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('quantity, unit_price', 'safe', 'on'=>'search'),
		);

		return array_merge(parent::rules(), $rules);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        $relations = array(
			'part' => array(self::BELONGS_TO, 'Part', 'part_id'),
		);

		return array_merge(parent::relations(), $relations); 	
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'date' => 'Дата',
			'cost' => 'Стоимость',
			'contractor_id' => 'Магазин',
            'quantity' => 'Количество',
            'unit_price' => 'Цена за ед.',
			'note' => 'Примечание',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('run',$this->run);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('contractor_id',$this->contractor_id);
		$criteria->compare('descr',$this->descr,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Expenses the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

    public function defaultScope() {
        return array(
            'condition' => 'expense_type_id=:type',
            'params' => array(':type' => self::TYPE_PART),
        );
    }

    protected function afterFind()
    {
        $this->cost = $this->quantity * $this->unit_price;

        return parent::afterFind();
    }
}
