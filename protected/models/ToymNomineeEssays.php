<?php

/**
 * This is the model class for table "{{toym_nominee_essays}}".
 *
 * The followings are the available columns in table '{{toym_nominee_essays}}':
 * @property integer $id
 * @property integer $nominee_id
 * @property string $nominator_essay_1
 * @property string $nominator_essay_2
 * @property string $nominator_essay_3
 * @property string $career_info_essay_1
 * @property string $career_info_essay_2
 * @property string $career_info_essay_3
 * @property string $career_info_essay_4
 */
class ToymNomineeEssays extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{toym_nominee_essays}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nominator_essay_1, nominator_essay_2, nominator_essay_3, career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4', 'required', 'message'=>'* This field is required.'),
			array('nominee_id', 'numerical', 'integerOnly'=>true),
			array('nominator_essay_1, nominator_essay_2, nominator_essay_3, career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4', 'validateWordCount'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nominee_id, nominator_essay_1, nominator_essay_2, nominator_essay_3, career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4', 'safe', 'on'=>'search'),
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
			'nominee_id' => 'Nominee',
			'nominator_essay_1' => 'Nominator Essay 1',
			'nominator_essay_2' => 'Nominator Essay 2',
			'nominator_essay_3' => 'Nominator Essay 3',
			'career_info_essay_1' => 'Career Info Essay 1',
			'career_info_essay_2' => 'Career Info Essay 2',
			'career_info_essay_3' => 'Career Info Essay 3',
			'career_info_essay_4' => 'Career Info Essay 4',
		);
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
		$criteria->compare('nominator_essay_1',$this->nominator_essay_1,true);
		$criteria->compare('nominator_essay_2',$this->nominator_essay_2,true);
		$criteria->compare('nominator_essay_3',$this->nominator_essay_3,true);
		$criteria->compare('career_info_essay_1',$this->career_info_essay_1,true);
		$criteria->compare('career_info_essay_2',$this->career_info_essay_2,true);
		$criteria->compare('career_info_essay_3',$this->career_info_essay_3,true);
		$criteria->compare('career_info_essay_4',$this->career_info_essay_4,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ToymNomineeEssays the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
