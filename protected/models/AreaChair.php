<?php

/**
 * This is the model class for table "{{area_chair}}".
 *
 * The followings are the available columns in table '{{area_chair}}':
 * @property integer $id
 * @property integer $account_id
 * @property integer $area_no
 * @property string $date_created
 * @property string $date_updated
 * @property integer $status
 */
class AreaChair extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{area_chair}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id, area_no', 'required'),
			array('account_id, area_no, status', 'numerical', 'integerOnly'=>true),
			array('date_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_id, area_no, date_created, date_updated, status', 'safe', 'on'=>'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'account_id' => 'Account',
			'area_no' => 'Area No',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'status' => 'Status',
		);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->status = 1; 
			} else {
				$this->date_updated = date('Y-m-d H:i');
			}
			return true;
		} else {
			return false;
		}
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
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('area_no',$this->area_no);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AreaChair the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function assign()
	{
		$check_ac =  AreaChair::model()->find("area_no = :area_no", [':area_no'=>$this->area_no]);
		$response = ['type'=>false];

		if($check_ac == null) {
			if($this->save()) {
				$response['type'] = true;
				$response['message'] = 'Member successfully assigned as Area Chair!';
			} else {
				$response['message'] = 'An error occurred while running the function. Please try again or contact the JCI Quadrant Team for this issue.';
			}
		} else {
			$response['message'] = 'Member cannot be assigned as Area Chair. Requested Area No. already had an existing Area Chair.';
		}

		return $response;
	}
}
