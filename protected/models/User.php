<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property integer $gender_id
 *
 * The followings are the available model relations:
 * @property Gender $gender
 */
class User extends PaavActiveRecord
{
	private $_identity;

    public $currentPwd;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array(
                'username, password',
                'required',
                'message' => 'Обязательное поле!',
            ),
            array(
                'first_name, email, gender_id',
                'required',
                'message' => 'Обязательное поле!',
                'on' => 'insert update',
            ),
            array(
                'first_name, username, password, email',
                'length',
                'min' => 2,
                'max' => 20,
                'tooShort' => 'От 2 до 20 символов!',
                'tooLong' => 'От 2 до 20 символов!',
            ),
            array(
                'password',
                'length',
                'min' => 6,
                'max' => 20,
                'tooShort' => 'От 6 до 20 символов!',
                'tooLong' => 'От 6 до 20 символов!',
                'except' => 'login',
            ),
            array(
                'password',
                'authenticate',
                'on' => 'login',
            ),
            array(
                'currentPwd',
                'required',
                'on' => 'update',
                'message' => 'Обязательное поле!',
            ),
            array(
                'currentPwd',
                'comparePwd',
                'on' => 'update',
            ),
            array(
                'first_name', 'match', 'pattern' => '/^[a-zа-я -]+$/ui',
                'message' => 'Некорректное имя пользователя.'
            ),
            array(
                'username', 'match', 'pattern' => '/^[\w.-]+$/',
                'message' => 'Некорректное имя пользователя.'
            ),
            array(
                'username',
                'unique',
                'message' => 'Пользователь с таким именем уже существует.',
                'except' => 'login',
            ),
            array(
                'email',
                'email',
                'message' => 'Некорректный адрес электронной почты.'
            ),
            array(
                'email',
                'unique',
                'message' => 'Пользователь с таким e-mail уже существует.'
            ),
			array('gender_id', 'in', 'range' => array(1, 2)),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
            array(
                'id, username, password, email, first_name, gender_id',
                'safe',
                'on'=>'search'
            ),
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
			'gender' => array(self::BELONGS_TO, 'Gender', 'gender_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Имя пользователя',
			'password' => 'Пароль',
			'email' => 'E-mail',
			'first_name' => 'Имя',
			'gender_id' => 'Пол',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('gender_id',$this->gender_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave()
    {
        if ($this->isNewRecord || $this->scenario !== 'hashedPwd')
            $this->password = Yii::app()->helper->getHash($this->password);

        return parent::beforeSave();
    }

    public function comparePwd($attr)
    {
        $pwdHash = Yii::app()->helper->getHash($this->$attr);

        if (!User::model()->exists('id=:id AND password=:pwdHash', array(
            ':id' => $this->id, ':pwdHash' => $pwdHash)))  

            $this->addError($attr, 'Неверный текущий пароль.');
    }

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);

			if(!$this->_identity->authenticate())
                foreach (array('username', 'password') as $attr)
                    $this->addError($attr,
                                    'Неверное имя пользователя или пароль.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			//$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity/*,$duration*/);
			return true;
		}
		else
			return false;
	}
}
