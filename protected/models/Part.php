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
class Part extends CActiveRecord
{
    public $descr = '';

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
            array('part_type_id, name', 'required'),
            array('part_type_id', 'numerical', 'integerOnly'=>true, 'min'=>0, 'max'=>500),
			array('name', 'length', 'max'=>255),
			array('manufacturer, part_number', 'length', 'max'=>50),
			array('note', 'length', 'max'=>500),
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
            'type' => array(self::BELONGS_TO, 'PartType', 'part_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'part_type_id' => 'Тип',
			'name' => 'Наименование',
			'manufacturer' => 'Производитель',
			'part_number' => 'Артикул',
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

    protected function afterFind()
    {
        $descrParts = [
            $this->type->name,
            $this->manufacturer,
            $this->name,
            $this->part_number,
        ];

        $this->descr = implode(' ', $descrParts);   

        return parent::afterFind();
    }
}
