<?php

/**
 * This is the model class for table "contractor".
 *
 * The followings are the available columns in table 'contractor':
 * @property integer $id
 * @property string $name
 * @property integer $post_code
 * @property string $city
 * @property string $street
 * @property string $building
 * @property string $office
 * @property string $note
 *
 * The followings are the available model relations:
 * @property Expense[] $expenses
 */
class Contractor extends PaavActiveRecord
{
    const TYPE_STORE = 1;
    const TYPE_GARAGE = 2;
    const TYPE_STATION = 3;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contractor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('head_id,type_id', 'required'),
            array('head_id,type_id', 'numerical', 'integerOnly'=>true),
			array('note', 'length', 'max'=>240),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('note', 'safe', 'on'=>'search'),
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
			'expenses' => array(self::HAS_MANY, 'Expense', 'contractor_id'),
            'type' => array(self::BELONGS_TO, 'ContractorType', 'type_id'),
            'addressr' => array(self::BELONGS_TO, 'Address', 'address_id'),
            'head' => array(self::BELONGS_TO, 'ContractorHead', 'head_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$name = 'Название';

        if (isset($this->type_id)) {
            switch ($this->type_id) {
                case self::TYPE_STORE:
                    $name = 'Магазин';
                    break;

                case self::TYPE_GARAGE:
                    $name = 'Мастерская';
                    break;

                case self::TYPE_STATION:
                    $name = 'Заправка';
                    break;
            }
        }

		return array(
			'name' => $name,
            'head_id' => 'Название',
            'type_id' => 'Тип',
			'city' => 'Город',
			'address_id' => 'Адрес',
			'note' => 'Комментарий',
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
		$criteria->compare('post_code',$this->post_code);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('building',$this->building,true);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contractor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function type($contractorType)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition'=>'type_id=:id',
            'params'=>array(':id'=>$contractorType),
        )); 
        
        return $this;
    }

    public function filterPageHeading($headings)
    {
        if ($this->type_id === null)
            return false;

        $action = $this->isNewRecord ? 'new' : 'edit';
        
        return $headings[$action][$this->type_id - 1];
    }
}
