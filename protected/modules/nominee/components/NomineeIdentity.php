<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class NomineeIdentity extends CUserIdentity
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
		$username = strtolower($this->username);
		$account = ToymNominee::model()->find('LOWER(email)="'.$username.'"');
		
		if($account===null) {
			Yii::app()->user->setFlash('error', 'Email / Password is Invalid');	
		} else if(!$account->validatePassword($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
			Yii::app()->user->setFlash('error', 'Email / Password is Invalid');	
		} else {
			switch($account->status) 
			{
				case 1: //ACTIVE
					$this->_id=$account->id;
					$this->username=$account->email;
					//$this->setState('roles', $account->getRole());
					//$this->setState('account_type_id', $account->account_type_id);
					$this->setState('name', $account->getFullName());
					$this->errorCode = self::ERROR_NONE;
					break;
				default:
					Yii::app()->user->setFlash('error', 'Account is still Pending. Please wait and you will be notified once your account has been validated by the Admin.');
			}
			
			
		}
		return $this->errorCode==self::ERROR_NONE;
	}
	
	/**
	 * Override getId() method
	 */
	public function getId()
	{
		return $this->_id;
	}
}