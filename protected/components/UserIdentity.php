<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	
	private $_id;
	const ERROR_USER_TAGGED = 3;
	const ERROR_USER_BANNED = 4;
	public function authenticate()
	{
		
		$user = User::model()->find('LOWER(username)=?',array(strtolower($this->username)));

		if($user === null){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} elseif(!$user->validatePassword($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		} elseif($user->active == User::USER_TAGGED) {
			$this->errorCode = self::ERROR_USER_TAGGED;
		} elseif($user->active == User::USER_BANNED) {
			$this->errorCode = self::ERROR_USER_BANNED;
		} else {
			$this->_id = $user->id; // This would set the id which would be 
			$this->username = $user->username;
			$this->errorCode = self::ERROR_NONE;

		}

		return $this->errorCode===self::ERROR_NONE;

	}

	public function getId(){
		return $this->_id;
	}
}