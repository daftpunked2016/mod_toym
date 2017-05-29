<?php

/**
 * This is the model class for table "{{toym_portfolio}}".
 *
 * The followings are the available columns in table '{{toym_portfolio}}':
 * @property integer $id
 * @property integer $nominee_id
 * @property integer $nominator_id
 * @property integer $nomination_id
 * @property string $career_info_essay_1
 * @property string $career_info_essay_2
 * @property string $career_info_essay_3
 * @property string $career_info_essay_4
 * @property integer $supporting_photo_1
 * @property integer $supporting_photo_2
 * @property integer $supporting_photo_3
 * @property integer $supporting_photo_4
 * @property integer $photograph_upload_id
 * @property integer $id_birth_cert_upload_id
 * @property integer $nbi_clearance_upload_id
 * @property integer $status_id
 * @property string $date_created
 * @property string $date_updated
 * @property string $created_by
 * @property string $updated_by
 */
class ToymPortfolio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{toym_portfolio}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('nominee_id, nominator_id, nomination_id, career_info_essay_1, status_id', 'required'),
			array('nominee_id, nominator_id, nomination_id, supporting_photo_1, supporting_photo_2, supporting_photo_3, supporting_photo_4, photograph_upload_id, id_birth_cert_upload_id, nbi_clearance_upload_id, status_id', 'numerical', 'integerOnly'=>true),
			array('created_by, updated_by', 'length', 'max'=>10),
			array('career_info_essay_2, career_info_essay_3, career_info_essay_4, date_created, date_updated', 'safe'),
			array('career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4', 'validateWordCount'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nominee_id, nominator_id, nomination_id, career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4, supporting_photo_1, supporting_photo_2, supporting_photo_3, supporting_photo_4, photograph_upload_id, id_birth_cert_upload_id, nbi_clearance_upload_id, status_id, date_created, date_updated, created_by, updated_by', 'safe', 'on'=>'search'),
		);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				$this->status_id = 2; 
			} else {
				$this->date_updated = date('Y-m-d H:i');
			}
			
			return true;
		} else {
			return false;
		}
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'nominator' => array(self::BELONGS_TO, 'ToymNominator', 'nominator_id'),
			'nominee' => array(self::BELONGS_TO, 'ToymNominee', 'nominee_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nominee_id' => 'Nominee',
			'nominator_id' => 'Nominator',
			'nomination_id' => 'Nomination',
			'career_info_essay_1' => 'Career Info Essay 1',
			'career_info_essay_2' => 'Career Info Essay 2',
			'career_info_essay_3' => 'Career Info Essay 3',
			'career_info_essay_4' => 'Career Info Essay 4',
			'supporting_photo_1' => 'Supporting Photo 1',
			'supporting_photo_2' => 'Supporting Photo 2',
			'supporting_photo_3' => 'Supporting Photo 3',
			'supporting_photo_4' => 'Supporting Photo 4',
			'photograph_upload_id' => 'Photograph (Head & Shoulder)',
			'id_birth_cert_upload_id' => 'ID/Birth Certificate',
			'nbi_clearance_upload_id' => 'NBI Clearance',
			'status_id' => 'Status',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
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
		$criteria->compare('nominee_id',$this->nominee_id);
		$criteria->compare('nominator_id',$this->nominator_id);
		$criteria->compare('nomination_id',$this->nomination_id);
		$criteria->compare('career_info_essay_1',$this->career_info_essay_1,true);
		$criteria->compare('career_info_essay_2',$this->career_info_essay_2,true);
		$criteria->compare('career_info_essay_3',$this->career_info_essay_3,true);
		$criteria->compare('career_info_essay_4',$this->career_info_essay_4,true);
		$criteria->compare('supporting_photo_1',$this->supporting_photo_1);
		$criteria->compare('supporting_photo_2',$this->supporting_photo_2);
		$criteria->compare('supporting_photo_3',$this->supporting_photo_3);
		$criteria->compare('supporting_photo_4',$this->supporting_photo_4);
		$criteria->compare('photograph_upload_id',$this->photograph_upload_id);
		$criteria->compare('id_birth_cert_upload_id',$this->id_birth_cert_upload_id);
		$criteria->compare('nbi_clearance_upload_id',$this->nbi_clearance_upload_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function addFileToAttr($file, $attribute_name, $nominator_id = null, $nominee_id = null,  $type = ImageFileHandler::NOMINATION_FILES)
	{
		$filehandler = new ImageFileHandler($file, $type, $nominator_id, $nominee_id);
		
		if($filehandler->saveUpload())
			$this->$attribute_name = $filehandler->_id;
		// else {
		// 	echo "<pre>";
		// 	print_r($filehandler->_errors);
		// 	echo "</pre>";
		// 	exit;
		// }
			

		return $this->$attribute_name;
	}

	public function validateWordCount($attribute, $params)
	{	
		$word_count = str_word_count($this->$attribute);
		//print_r($word_count);exit;
		if( $word_count < 260 ) {
			 $this->addError($attribute, 'Answer is below minimum word count (250 words).');
		}
	 	
	 	// if( $word_count > 700 ) {
		// 	 $this->addError($attribute, 'Answer is exceeds maximum word count (700 words).');
		// }
	}

	public function getUpdator()
	{
		$updated_by = json_decode($this->updated_by);

		switch(key($updated_by)) {
			case "AC":
				$updator = AreaChair::getAccount($updated_by->AC);
				$position = "AC";
				break;
			case "NR":
				$updator = ToymNominator::model()->findByPk($updated_by->NR);
				$position = "Nominator";
				break;
			case "NE":
				$updator = ToymNominee::model()->findByPk($updated_by->NE);
				$position = "Nominee";
				break;
		}

		return $updator->getFullName()." <small class='text-muted'>{$position}</small>";
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ToymPortfolio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
