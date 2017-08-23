<?php

/**
 * This is the model class for table "{{toym_nominator}}".
 *
 * The followings are the available columns in table '{{toym_nominator}}':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property integer $account_id
 * @property integer $is_jci_member
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property string $home_address
 * @property string $home_telephone
 * @property string $mobile_no
 * @property string $business_address
 * @property integer $endorsing_chapter
 * @property string $date_created
 * @property string $date_updated
 * @property integer $status_id
 */
class ToymNominator extends CActiveRecord
{
	public $new_password;
	public $confirm_password;
	public $current_password;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{toym_nominator}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, firstname, lastname, middlename, home_address, home_telephone, mobile_no, business_address, endorsing_chapter, password', 'required', 'message'=>'* This field is required.'),
			array('account_id, is_jci_member, endorsing_chapter, status_id, salt', 'numerical', 'integerOnly'=>true),
			array('email','unique'),
			array('email','validateEmail'),
			array('email, firstname, lastname, middlename', 'length', 'max'=>40),
			array('new_password, confirm_password', 'required', 'on' => 'resetPwd'),
			array('current_password, confirm_password, new_password', 'required', 'message'=>'* This field is required.', 'on' => 'changePassword'),
			array('current_password', 'findPasswords', 'on' => 'changePassword'),
			array('confirm_password', 'compare', 'compareAttribute'=>'new_password', 'message'=>'New password doesn\'t match!', 'on'=>'resetPwd'),
			array('confirm_password', 'compare', 'compareAttribute'=>'new_password', 'message'=>'New password doesn\'t match!', 'on'=>'changePassword'),
			array('new_password', 'length', 'min'=>8, 'max'=>16),
			array('password', 'length', 'min'=>8, 'max'=>16, 'on' => 'createNominator'),
			array('home_address, business_address', 'length', 'max'=>155),
			array('additional_endorsing_chapter', 'length', 'max'=>255),
			array('home_telephone, mobile_no', 'length', 'max'=>15),
			array('date_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, account_id, is_jci_member, firstname, lastname, middlename, home_address, home_telephone, mobile_no, business_address, endorsing_chapter, date_created, date_updated, status_id', 'safe', 'on'=>'search'),
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'chapter' => array(self::BELONGS_TO, 'Chapter', 'endorsing_chapter'),
		);
	}

	public function onArea($area_no)
    {
        $this->getDbCriteria()->mergeWith(array(
        	'condition'=> "chapter.area_no = {$area_no}",
            'join' => "INNER JOIN jci_chapter AS chapter ON nominator.endorsing_chapter = chapter.id",
        ));

        return $this;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'E-mail',
			'password' => 'Password',
			'account_id' => 'Account',
			'is_jci_member' => 'Is Jci Member',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'middlename' => 'Middle Name',
			'home_address' => 'Home Address',
			'home_telephone' => 'Home Telephone',
			'mobile_no' => 'Mobile No',
			'business_address' => 'Business Address',
			'endorsing_chapter' => 'Endorsing Chapter',
			'additional_endorsing_chapter' => 'Additional Endorsing Chapter',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'status_id' => 'Status',
		);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->salt = $this->generateSalt();
				$this->status_id = 3; //AC Pending
				$this->password = $this->hashPassword($this->password,$this->salt);
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

	//comparing current password
	public function findPasswords($attribute, $params)
    {
        if (!$this->validatePassword($this->current_password))
            $this->addError($attribute, 'Old password is incorrect.');
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('is_jci_member',$this->is_jci_member);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('middlename',$this->middlename,true);
		$criteria->compare('home_address',$this->home_address,true);
		$criteria->compare('home_telephone',$this->home_telephone,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('business_address',$this->business_address,true);
		$criteria->compare('endorsing_chapter',$this->endorsing_chapter);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('status_id',$this->status_id);

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
				// else {
				// 	$nominator_account=self::model()->find(array(
				// 		'condition'=>'email=:email',
				// 		'params'=>array(
				// 			':email'=>$this->email
				// 		)
				// 	));

				// 	$nominator_account2 = self::model()->findByPk($id);
					
				// 	if($nominator_account !== null) {
				// 		if($nominator_account->email !== $nominator_account2->email) {
				// 			$this->addError('username','Email address is already in use.');
				// 		}
				// 	}
				// } 
			//}
		}
	}

	public function getRegionCount($rid)
	{
		$count = self::model()
						->with(array(
							'chapter'=>array(
								'condition'=>'region_id = :rid', 
									'params'=>array(
										':rid'=>$rid,
						))))->count();
		return $count;
	}

	public function getAreaCount($aid)
	{
		$count = self::model()
						->with(array(
							'chapter'=>array(
								'condition'=>'area_no = :aid', 
									'params'=>array(
										':aid'=>$aid,
						))))->count();
		return $count;
	}

	public function getChapterPresident()
	{
		$pres_account = Account::model()
			->with([
				'user'=>[
					'condition'=>'chapter_id = '.$this->endorsing_chapter.' AND position_id = 11',
				]])->find('status_id = 1');
		
		return ($pres_account) ? $pres_account->user->getFullName() : 'N/A';
	}



	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt) === $this->password;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ToymNominator the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getFullName()
	{
		return $this->firstname.' '.$this->lastname;
	}
}
