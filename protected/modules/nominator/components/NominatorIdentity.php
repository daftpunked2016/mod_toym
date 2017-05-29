<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class NominatorIdentity extends CUserIdentity
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
		$toym_account= ToymNominator::model()->isActive()->find('LOWER(email)="'.$username.'"');
		
		if($toym_account===null)
			Yii::app()->user->setFlash('error', 'Email / Password is Invalid');	
		else {
			if($toym_account->is_jci_member) {
				$account = Account::model()->findByPk($toym_account->account_id);
				$check_password = $account->validatePassword($this->password);
			} else {
				$check_password = $toym_account->validatePassword($this->password);
			}

			if(!$check_password) {
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
				Yii::app()->user->setFlash('error', 'Email / Password is Invalid');	
			} else {
				$this->_id=$toym_account->id;
				$this->username=$toym_account->email;
				$this->setState('name', $toym_account->getFullName());
				if($toym_account->is_jci_member) { $this->setState('account_id', $account->id); }
		
				$this->errorCode=self::ERROR_NONE;
			}
			return $this->errorCode==self::ERROR_NONE;
		}
	}
	
	/**
	 * Override getId() method
	 */
	public function getId()
	{
		return $this->_id;
	}
}