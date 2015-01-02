<?php

/**
 */
class JobExpense extends Expense
{
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        $rules = array(
            array('job_id, cost', 'required'),
			array('job_id', 'numerical', 'integerOnly'=>true, 'min'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('', 'safe', 'on'=>'search'),
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
			'job' => array(self::BELONGS_TO, 'Job', 'job_id'),
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
			'run' => 'Пробег',
			'cost' => 'Стоимость',
			'contractor_id' => 'Мастерская',
            'job_id'=>'Наименование',
            'note'=>'Комментарий',
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
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function scopes()
    {
        return array(
            'maxRun'=>array(
                'select'=>'run',
                'order'=>'run DESC',
                'limit'=>1,
            ),
        );
    }

    public function defaultScope() {
        return array(
            'condition' => 'expense_type_id=:type',
            'params' => array(':type' => Expense::TYPE_JOB),
        );
    }

}
