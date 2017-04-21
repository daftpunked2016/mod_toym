<?php

/**
 * This is the model class for table "{{toym_nominee_info}}".
 *
 * The followings are the available columns in table '{{toym_nominee_info}}':
 * @property integer $id
 * @property integer $nominee_id
 * @property string $nominator_essay_1
 * @property string $nominator_essay_2
 * @property string $nominator_essay_3
 * @property integer $citizenship
 * @property integer $civil_status
 * @property string $gender
 * @property string $birthdate
 * @property string $birthplace
 * @property string $home_address
 * @property string $province
 * @property string $city
 * @property integer $country
 * @property string $home_telephone
 * @property string $mobile_no
 * @property integer $age
 * @property string $spouse_name
 * @property string $children_name
 * @property string $grade_school
 * @property string $high_school
 * @property string $college
 * @property string $college_degree
 * @property string $post_graduate
 * @property string $post_graduate_degree
 * @property string $academic_honors
 * @property string $name_business_employer
 * @property string $business_address
 * @property string $business_phone_no
 * @property integer $length_of_service_with_business_employer
 * @property string $organization_affiliation
 * @property string $positions_held_term_office
 * @property string $derogatory_information
 * @property string $warranty_of_originality_creation
 * @property string $published_work
 * @property string $category
 * @property string $important_published_works
 * @property string $career_info_essay_1
 * @property string $career_info_essay_2
 * @property string $career_info_essay_3
 * @property string $career_info_essay_4
 * @property integer $photograph_upload_id
 * @property integer $id_birth_cert_upload_id
 */
class ToymNomineeInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{toym_nominee_info}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nominator_essay_1, nominator_essay_2, nominator_essay_3, citizenship, civil_status, gender, birthdate, birthplace, home_address, province, city, country, home_telephone, mobile_no, spouse_name, children_name, grade_school, high_school, college, college_degree, post_graduate, post_graduate_degree, academic_honors, name_business_employer, business_address, business_phone_no, length_of_service_with_business_employer, organization_affiliation, positions_held_term_office, derogatory_information, warranty_of_originality_creation, published_work, category, important_published_works, career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4, photograph_upload_id, id_birth_cert_upload_id', 'required', 'message'=>'* This field is required.'),
			array('nominee_id, country, age, length_of_service_with_business_employer, photograph_upload_id, id_birth_cert_upload_id', 'numerical', 'integerOnly'=>true),
			array('civil_status', 'length', 'max'=>1),
			array('gender', 'length', 'max'=>1),
			array('birthplace, home_address, business_address', 'length', 'max'=>155),
			array('province, city, civil_status, home_telephone, mobile_no, business_phone_no', 'length', 'max'=>50),
			array('nominator_essay_1, nominator_essay_2, nominator_essay_3, career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4', 'validateWordCount'),
			array('spouse_name, grade_school, high_school, college, college_degree, post_graduate, post_graduate_degree, name_business_employer', 'length', 'max'=>100),
			array('academic_honors, derogatory_information, warranty_of_originality_creation', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nominee_id, nominator_essay_1, nominator_essay_2, nominator_essay_3, citizenship, civil_status, gender, birthdate, birthplace, home_address, province, city, country, home_telephone, mobile_no, age, spouse_name, children_name, grade_school, high_school, college, college_degree, post_graduate, post_graduate_degree, academic_honors, name_business_employer, business_address, business_phone_no, length_of_service_with_business_employer, organization_affiliation, positions_held_term_office, derogatory_information, warranty_of_originality_creation, published_work, category, important_published_works, career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4, photograph_upload_id, id_birth_cert_upload_id', 'safe', 'on'=>'search'),
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
			'citizenship' => 'Citizenship',
			'civil_status' => 'Civil Status',
			'gender' => 'Gender',
			'birthdate' => 'Date of Birth',
			'birthplace' => 'Place of Birth',
			'home_address' => 'Home Address',
			'province' => 'Province',
			'city' => 'City',
			'country' => 'Country',
			'home_telephone' => 'Home Telephone',
			'mobile_no' => 'Mobile No',
			'age' => 'Age',
			'spouse_name' => 'Spouse Name',
			'children_name' => 'Children Name',
			'grade_school' => 'Grade School',
			'high_school' => 'High School',
			'college' => 'College',
			'college_degree' => 'College Degree',
			'post_graduate' => 'Post Graduate',
			'post_graduate_degree' => 'Post Graduate Degree',
			'academic_honors' => 'Academic Honors',
			'name_business_employer' => 'Name Business Employer',
			'business_address' => 'Business Address',
			'business_phone_no' => 'Business Phone No',
			'length_of_service_with_business_employer' => 'Length of Service with Present Business or Employer',
			'organization_affiliation' => 'Civic, Professional, Fraternal, Religious or Business Organization and Affiliation',
			'positions_held_term_office' => 'Positions Held and Term of Office',
			'derogatory_information' => 'Derogatory Information',
			'warranty_of_originality_creation' => 'Warranty of Originality of Intellectual Creation',
			'published_work' => 'Published Work',
			'category' => 'Category',
			'important_published_works' => 'List of Most Important Published Works',
			'career_info_essay_1' => 'Career Info Essay 1',
			'career_info_essay_2' => 'Career Info Essay 2',
			'career_info_essay_3' => 'Career Info Essay 3',
			'career_info_essay_4' => 'Career Info Essay 4',
			'photograph_upload_id' => 'Photograph',
			'id_birth_cert_upload_id' => 'ID/Birth Certificate',
		);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave()) {
			$this->age = date_diff(date_create($this->birthdate), date_create('now'))->y;
			return true;
		} else {
			return false;
		}
	}

	public function validateWordCount($attribute, $params)
	{	
		$word_count = str_word_count($this->$attribute);
		//print_r($word_count);exit;
		if( $word_count < 260 ) {
			 $this->addError($attribute, 'Answer is below minimum word count (250 words).');
		}
	 	
	 	if( $word_count > 700 ) {
			 $this->addError($attribute, 'Answer is exceeds maximum word count (700 words).');
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
		$criteria->compare('nominee_id',$this->nominee_id);
		$criteria->compare('nominator_essay_1',$this->nominator_essay_1,true);
		$criteria->compare('nominator_essay_2',$this->nominator_essay_2,true);
		$criteria->compare('nominator_essay_3',$this->nominator_essay_3,true);
		$criteria->compare('citizenship',$this->citizenship);
		$criteria->compare('civil_status',$this->civil_status);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('birthplace',$this->birthplace,true);
		$criteria->compare('home_address',$this->home_address,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country);
		$criteria->compare('home_telephone',$this->home_telephone,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('spouse_name',$this->spouse_name,true);
		$criteria->compare('children_name',$this->children_name,true);
		$criteria->compare('grade_school',$this->grade_school,true);
		$criteria->compare('high_school',$this->high_school,true);
		$criteria->compare('college',$this->college,true);
		$criteria->compare('college_degree',$this->college_degree,true);
		$criteria->compare('post_graduate',$this->post_graduate,true);
		$criteria->compare('post_graduate_degree',$this->post_graduate_degree,true);
		$criteria->compare('academic_honors',$this->academic_honors,true);
		$criteria->compare('name_business_employer',$this->name_business_employer,true);
		$criteria->compare('business_address',$this->business_address,true);
		$criteria->compare('business_phone_no',$this->business_phone_no,true);
		$criteria->compare('length_of_service_with_business_employer',$this->length_of_service_with_business_employer);
		$criteria->compare('organization_affiliation',$this->organization_affiliation,true);
		$criteria->compare('positions_held_term_office',$this->positions_held_term_office,true);
		$criteria->compare('derogatory_information',$this->derogatory_information,true);
		$criteria->compare('warranty_of_originality_creation',$this->warranty_of_originality_creation,true);
		$criteria->compare('published_work',$this->published_work,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('important_published_works',$this->important_published_works,true);
		$criteria->compare('career_info_essay_1',$this->career_info_essay_1,true);
		$criteria->compare('career_info_essay_2',$this->career_info_essay_2,true);
		$criteria->compare('career_info_essay_3',$this->career_info_essay_3,true);
		$criteria->compare('career_info_essay_4',$this->career_info_essay_4,true);
		$criteria->compare('photograph_upload_id',$this->photograph_upload_id);
		$criteria->compare('id_birth_cert_upload_id',$this->id_birth_cert_upload_id);

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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ToymNomineeInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
