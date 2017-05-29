<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AcIdentity extends CUserIdentity
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
		$account = Account::model()->isActive()->find('LOWER(username)="'.$username.'"');

		if($account===null) {
			Yii::app()->user->setFlash('error', 'Email / Password is Invalid');	
		} else {
			$areaChair = AreaChair::model()->find("account_id = {$account->id}");

			if($areaChair == null) { 
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
				Yii::app()->user->setFlash('error', 'Account Invalid for this module');	
			} else {
				if(!$account->validatePassword($this->password)) {
					$this->errorCode=self::ERROR_PASSWORD_INVALID;
					Yii::app()->user->setFlash('error', 'Email / Password is Invalid');	
				} else {
					$this->_id = $account->id;
					$this->username = $account->username;
					$this->setState('roles', $account->getRole());
					$this->setState('account_type_id', $account->account_type_id);
					$this->setState('area_chair_id', $areaChair->id);
					$this->setState('area_no', $areaChair->area_no);
					$this->setState('name', $account->user->getFullName());
					$this->errorCode=self::ERROR_NONE;
				}
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