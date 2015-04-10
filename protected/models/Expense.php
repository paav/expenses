<?php

/**
 * This is the model class for table "expense".
 *
 * The followings are the available columns in table 'expense':
 * @property integer $id
 * @property string $date
 * @property integer $run
 * @property double $cost
 * @property integer $contractor_id
 * @property string $note
 * @property string $expense_type_id
 * @property integer $quantity
 * @property double $unit_price
 * @property integer $part_id
 * @property integer $job_id
 *
 * The followings are the available model relations:
 * @property Contractor $contractor
 */
class Expense extends CActiveRecord
{
    const TYPE_PART = 1;
    const TYPE_JOB = 2;
    const TYPE_FUEL = 3;

    public $descr = '';
    public $type = '';

    public function __construct()
    {
        parent::__construct();

        $date = new DateTime();
        $this->date = $date->format('Y-m-d');
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'expense';
	}

    /**
     * @param array $attributes
     * @return Car
     */
    protected function instantiate($attributes)
    {
        if (isset($attributes['expense_type_id'])) {

            $type = $attributes['expense_type_id'];

            switch ($type) {
                case self::TYPE_PART:
                    $class = 'PartExpense';
                    break;

                case self::TYPE_JOB:
                    $class = 'JobExpense';
                    break;

                case self::TYPE_FUEL:
                    $class = 'FuelExpense';
                    break;
            }
        } else
            $class = get_class($this);

        $model = new $class(null);
        $model->setIsNewRecord(false);
        $model->type = isset($type) ? $type : null;  

        return $model;
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('expense_type_id, date', 'required'),
            array('contractor_id', 'required',
                'message' => 'Выберите мастерскую!'),
			array('run, contractor_id, bound_id', 'numerical', 'integerOnly'=>true),
			array('cost', 'numerical', 'min'=>0, 'max'=>999999.99),
            array('run', 'numerical', 'min'=>0, 'max'=>999999),
			array('note', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('date, run, cost, expense_type_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'contractor' => array(self::BELONGS_TO, 'Contractor', 'contractor_id'),
            'expenseType' => array(self::BELONGS_TO, 'ExpenseType', 'expense_type_id'),
			'part' => array(self::BELONGS_TO, 'Part', 'part_id'),
			'job' => array(self::BELONGS_TO, 'Job', 'job_id'),
			'fuel' => array(self::BELONGS_TO, 'Fuel', 'fuel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => 'Дата',
			'expense_type_id' => 'Тип',
			'run' => 'Пробег',
			'cost' => 'Стоимость',
			'contractor_id' => 'Контрагент',
			'descr' => 'Описание',
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
		$criteria->compare('expense_type_id',$this->expense_type_id);
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

    protected function beforeSave()
    {
        Yii::app()->format->dateFormat = 'Y-m-d';
        $this->date = Yii::app()->format->date($this->date);

        $this->user_id = Yii::app()->user->id;

        return parent::beforeSave();
    }

    public static function getTotalRun($provider)
    {
        $maxRun = $minRun = 0;

        foreach ($provider->data as $model) {
            $run = $model->run;

            if ($run === null)
                continue;

            if ($maxRun == 0 && $minRun == 0)
                $maxRun = $minRun = $run;

            if ($run > $maxRun)
                $maxRun = $run;    

            if ($run < $minRun)
                $minRun = $run;
        }

        return $maxRun - $minRun;
    }

    public static function getTotalCost($provider)
    {
        $totalCost = 0;

        foreach ($provider->data as $model)
            $totalCost += $model->cost;

        return $totalCost;
    }

    public function getType()
    {
        return $this->expense_type_id;
    }

    public function getControllerName()
    {
        return lcfirst(get_class($this));
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
}
