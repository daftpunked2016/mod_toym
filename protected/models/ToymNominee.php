<?php

/**
 * This is the model class for table "{{toym_nominee}}".
 *
 * The followings are the available columns in table '{{toym_nominee}}':
 * @property integer $id
 * @property integer $nominator_id
 * @property string $email
 * @property string $password
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $title
 * @property string $name_on_trophy
 * @property string $phonetic_pronunciation
 * @property string $profession
 * @property string $position
 * @property integer $toym_category_id
 * @property integer $toym_subcategory_id
 * @property string $date_created
 * @property string $date_updated
 * @property integer $status
 */
class ToymNominee extends CActiveRecord
{
	public $new_password;
	public $confirm_password;
	public $current_password;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{toym_nominee}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, firstname, lastname, middlename, title, name_on_trophy, phonetic_pronunciation, profession, position, toym_category_id, toym_subcategory_id', 'required', 'message'=>'* This field is required.'),
			array('nominator_id, toym_category_id, toym_subcategory_id, status, salt', 'numerical', 'integerOnly'=>true),
			array('email','unique'),
			array('email','validateEmail'),
			array('email, firstname, middlename, lastname', 'length', 'max'=>40),
			array('current_password, confirm_password, new_password', 'required', 'message'=>'* This field is required.', 'on' => 'changePassword'),
			array('current_password', 'findPasswords', 'on' => 'changePassword'),
			array('confirm_password', 'compare', 'compareAttribute'=>'new_password', 'message'=>'New password doesn\'t match!', 'on'=>'changePassword'),
			array('new_password', 'length', 'min'=>8, 'max'=>16),
			array('title', 'length', 'max'=>10),
			array('name_on_trophy, phonetic_pronunciation', 'length', 'max'=>100),
			array('profession, position', 'length', 'max'=>155),
			array('date_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nominator_id, email, password, firstname, middlename, lastname, title, name_on_trophy, phonetic_pronunciation, profession, position, toym_category_id, toym_subcategory_id, date_created, date_updated, status', 'safe', 'on'=>'search'),
		);
	}

	public function scopes()
	{
		return array(
			'isActive' => array(
				'condition' => 't.status = 1',
			),
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'nominator' => array(self::BELONGS_TO, 'ToymNominator', 'nominator_id'),
			'category' => array(self::BELONGS_TO, 'ToymCategory', 'toym_category_id'),
			'subcategory' => array(self::BELONGS_TO, 'ToymSubcategory', 'toym_subcategory_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nominator_id' => 'Nominator',
			'email' => 'Email',
			'password' => 'Password',
			'firstname' => 'First Name',
			'middlename' => 'Middle Name',
			'lastname' => 'Last Name',
			'title' => 'Title',
			'name_on_trophy' => 'Name To Appear On Trophy',
			'phonetic_pronunciation' => 'Phonetic Pronunciation',
			'profession' => 'Profession',
			'position' => 'Position',
			'toym_category_id' => 'Category',
			'toym_subcategory_id' => 'Subcategory',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'status' => 'Status',
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
		$criteria->compare('nominator_id',$this->nominator_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('middlename',$this->middlename,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('name_on_trophy',$this->name_on_trophy,true);
		$criteria->compare('phonetic_pronunciation',$this->phonetic_pronunciation,true);
		$criteria->compare('profession',$this->profession,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('toym_category_id',$this->toym_category_id);
		$criteria->compare('toym_subcategory_id',$this->toym_subcategory_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function validateEmail($attribute,$params)
	{
		$id = Yii::app()->user->id;		

		if ($this->email != "") {

			//if (!$this->hasErrors()) {

				if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
					$this->addError('email','Please use a valid email address.');
				} 
				//else {
				// 	$nominee_account=self::model()->find(array(
				// 		'condition'=>'email=:email',
				// 		'params'=>array(
				// 			':email'=>$this->email
				// 		)
				// 	));

				// 	$nominee_account2 = self::model()->findByPk($id);
					
				// 	if($nominee_account !== null) {
				// 		if($nominee_account->email !== $nominee_account2->email) {
				// 			$this->addError('username','Email address is already in use.');
				// 		}
				// 	}
				// }
			//}
		}
	}

	//comparing current password
	public function findPasswords($attribute, $params)
    {
        if (!$this->validatePassword($this->current_password))
            $this->addError($attribute, 'Old password is incorrect.');
    }


	protected function beforeSave()
	{
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->salt = $this->generateSalt();
				$this->status = 3; //AC Pending
				//$this->temp_password = $this->password;
				//$this->password = $this->hashPassword($this->password,$this->salt);
			} else {
				$this->date_updated = date('Y-m-d H:i');
			}
			return true;
		} else {
			return false;
		}
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

	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt) === $this->password;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ToymNominee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getFullName()
	{
		return $this->firstname.' '.$this->lastname;
	}

	public function approveNomination()
	{
		$prefix = mt_rand(1000,9999);
    	$temp_password =  uniqid($prefix); // CREATE RANDOM PASSWORD

		$this->status = 1;
		$this->temp_password = $temp_password;
		$this->password = $this->hashPassword($temp_password, $this->salt);

		$connection = Yii::app()->db;
		$transaction = $connection->beginTransaction();

		$email_notification = new EmailWrapper;
		$email_notification->setSubject('TOYM - JCIPH | Nominee Account Log-in Credentials');
		$email_notification->setReceivers(array(
			$this->email => $this->getFullName(),
		));
		$email_notification->setMessage(Yii::app()->controller->renderPartial('application.views.email_templates.nominee_approval_notif', ['nominee'=>$this], true));
		$send_email = $email_notification->sendMessage();

		if($this->save() && $send_email) {	
			$transaction->commit();
			return true;
		} else {
			$transaction->rollback();
			return false;
		}
	}

}
