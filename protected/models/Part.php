<?php

/**
 * This is the model class for table "part".
 *
 * The followings are the available columns in table 'part':
 * @property integer $id
 * @property string $name
 * @property string $manufacturer
 * @property string $part_number
 * @property string $note
 *
 * The followings are the available model relations:
 * @property Expense[] $expenses
 */
class Part extends PaavActiveRecord
{

    const TYPE_GENERIC   = 13;
    const TYPE_MOTOR_OIL = 2;
    const TYPE_FLUID     = 12;
    const TYPE_ACCESSORY = 9;
    const NOVENDOR = -1;

    // public $descr = '';


    protected static $subclasses = array(
        self::TYPE_GENERIC   => 'GenericPart',
        self::TYPE_MOTOR_OIL => 'MotorOil',
        self::TYPE_FLUID     => 'Fluid',
        self::TYPE_ACCESSORY => 'Accessory',
    );

    protected $superType = null;

    /**
     * @param array $attributes
     * @return Car
     */
    protected function instantiate($attributes)
    {
        $superType = self::findSuperType($attributes['part_type_id']);
        $subclass = self::$subclasses[$superType];

        $model = new $subclass();
        $model->superType = $superType;
        $model->setIsNewRecord(false);

        return $model;
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'part';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('part_type_id, vendor_id', 'required'),
            array('part_type_id, vendor_id', 'numerical', 'integerOnly'=>true,
                'min'=>0),
			array('note', 'length', 'max'=>500),
			array('part_number', 'length', 'max'=>50),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, manufacturer, part_number, note', 'safe', 'on'=>'search'),
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
			'expenses' => array(self::HAS_MANY, 'PartExpense', 'part_id'),
            'type'     => array(self::BELONGS_TO, 'PartType', 'part_type_id'),
            'vendor'   => array(self::BELONGS_TO, 'Vendor', 'vendor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        return array(
            'part_type_id' => 'Тип расходного материала',
            'name'         => 'Название',
            'vendor_id'    => 'Производитель',
            'part_number'  => 'Артикул',
            'note'         => 'Комментарий',
            'descr'        => 'Описание',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('manufacturer',$this->manufacturer,true);
		$criteria->compare('part_number',$this->part_number,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Part the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     *
     * @return
     */
    protected static function findSuperType($typeId)
    {
        $typeParentId = PartType::getParentId($typeId);

        foreach (array($typeId, $typeParentId) as $type)
            if (isset(self::$subclasses[$type]))
                return $type;

        return false;
    }

    /**
     *
     * @return
     */
    public function getDescr()
    {
        return $this->name; 
    }

    /**
     *
     * @return
     */
    public function getSuperType()
    {
        return $this->superType; 
    }

    /**
     *
     * @return
     */
    public static function getSubclass($typeId)
    {
        $superType = self::findSuperType($typeId); 

        return self::$subclasses[$superType ?: 0];
    }
}

class GenericPart extends Part
{
    /**
     *
     */
    public function init()
    {
        $this->superType = Part::TYPE_GENERIC;
    }
}

class Fluid extends Part
{
	public function rules()
	{
		$rules = array(
			array('name', 'required'),
			array('name', 'length', 'max'=>50),
			array('volume', 'numerical', 'min' => 0.01, 'max' => 999.99),
        );

        return array_merge($rules, parent::rules());
    }

    /**
     *
     */
    public function init()
    {
        $this->superType = Part::TYPE_FLUID;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        $labels = array(
            'volume' => 'Объем (в литрах)',
        );

        return array_merge(parent::attributeLabels(), $labels);
	}

}

class MotorOil extends Fluid
{
	public function rules()
	{
		$rules = array(
            array('sae_grade', 'match', 'pattern'=>'/\d{1,2}W-\d{2}/i',
                'message'=>'Вязкость по SAE должна быть в формате "xxW-xx".'
            ),
        );

        return array_merge($rules, parent::rules());
    }

    /**
     *
     */
    public function init()
    {
        $this->superType = Part::TYPE_MOTOR_OIL;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
        $labels = array(
            'sae_grade' => 'Вязкость по SAE',
        );

        return array_merge(parent::attributeLabels(), $labels);
	}

    /**
     *
     * @return
     */
    public function getDescr()
    {
        $descr = $this->name;

        if ($this->volume)
            $descr .= ' ' . $this->volume . ' л';

        return $descr; 
    }
}

class Accessory extends Part
{
    /**
     *
     */
    public function init()
    {
        $this->superType = Part::TYPE_ACCESSORY;
    }
}
