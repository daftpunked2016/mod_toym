<?php

/**
 * This is the model class for table "{{account}}".
 *
 * The followings are the available columns in table '{{account}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $salt
 * @property integer $account_type_id
 * @property string $date_created
 * @property string $date_updated
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class Account extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{account}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt, account_type_id, date_created, date_updated', 'required'),
			array('salt, account_type_id, status_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>40),
			array('password', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, salt, account_type_id, date_created, date_updated, status_id', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'User', 'account_id'),
			'user' => array(self::HAS_ONE, 'User', 'account_id'),
		);
	}

	public function scopes()
	{
		return array(
			'isActive' => array(
				'condition' => 't.status_id = 1',
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'account_type_id' => 'Account Type',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'status_id' => 'Status',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt);
		$criteria->compare('account_type_id',$this->account_type_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Account the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function authenticate($username, $password)
	{
		$username = strtolower($username);
	   	$account = self::model()
	   		->isActive()
	   		->find('LOWER(username) = :username AND (account_type_id = 2 OR account_type_id = 3)', array(':username'=>$username));
	   		//->with('user');

	   	if($account != null) {
	   		if($account->validatePassword($password)) {
	   			return $account;
	   		}
	   	}

	   	return false;
	}

	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt) === $this->password;
	}
	
	/**
	 * Generate salt for safer encryption
	 */
	public function generateSalt()
	{
		// Simple timestamp. Needs to be worked on to make site more secure
		return time();
	}
	
	/*
	 * Create hashed password
	 */
	public function hashPassword($password,$salt)
	{
		//Used to encrypt the password
		//You can either use sha1, sha2 or sha256
		//md5 not that secure anymore
		return sha1($password.$salt);
	}
}
