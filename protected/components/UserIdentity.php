<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);

        $user = User::model()->findByAttributes(array(
            'username' => $this->username
        ));

        $hashToVerify = Yii::app()->helper->getHash($this->password);

		if ($user === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;

        elseif ($user->password !== $hashToVerify)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;

		else {
			$this->errorCode=self::ERROR_NONE;
            $this->_id = $user->id;
            $this->setState('gender', $user->gender_id);
        }

		return !$this->errorCode;
	}

    public function getId()
    {
        return $this->_id;
    }
}
