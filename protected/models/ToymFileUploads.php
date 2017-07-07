<?php

/**
 * This is the model class for table "{{toym_file_uploads}}".
 *
 * The followings are the available columns in table '{{toym_file_uploads}}':
 * @property integer $id
 * @property integer $nominator_id
 * @property integer $nominee_id
 * @property string $original_filename
 * @property string $filename
 * @property string $file_extension
 * @property string $type
 * @property string $date_uploaded
 */
class ToymFileUploads extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{toym_file_uploads}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('original_filename, filename, file_extension, type', 'required'),
			array('nominator_id, nominee_id', 'numerical', 'integerOnly'=>true),
			array('original_filename, filename', 'length', 'max'=>255),
			array('file_extension', 'length', 'max'=>10),
			array('type', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nominator_id, nominee_id, original_filename, filename, file_extension, type, date_uploaded', 'safe', 'on'=>'search'),
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
			'nominee_id' => 'Nominee',
			'original_filename' => 'Original Filename',
			'filename' => 'Filename',
			'file_extension' => 'File Extension',
			'type' => 'Type',
			'date_uploaded' => 'Date Uploaded',
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
		$criteria->compare('nominee_id',$this->nominee_id);
		$criteria->compare('original_filename',$this->original_filename,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('file_extension',$this->file_extension,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('date_uploaded',$this->date_uploaded,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getFilePath($id, $for_pdf = false)
	{
		$file = self::model()->findByPk($id);
		if($for_pdf) {
			$file_path = 'fileuploads';
		} else {
			$file_path = Yii::app()->baseUrl."/fileuploads";
		}
		

		switch($file->type) {
			case "P":
				$file_path .= "/portfolio"; 
				break;
			case "N":
				$file_path .= "/nomination";
				break;
		} 

		if($file->nominator_id != null) {
			$file_path .= "/NR_".$file->nominator_id;
		} else {
			$file_path .= "/NE_".$file->nominee_id;
		}

		$file_path .= "/".$file->filename;
		return $file_path;
	}

	public function getServerPath()
	{
		$file_path = "fileuploads";

		switch($this->type) {
			case "P":
				$file_path .= "/portfolio"; 
				break;
			case "N":
				$file_path .= "/nomination";
				break;
		} 

		if($this->nominator_id != null) {
			$file_path .= "/NR_".$this->nominator_id;
		} else {
			$file_path .= "/NE_".$this->nominee_id;
		}

		$file_path .= "/".$this->filename;
		return $file_path;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ToymFileUploads the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
