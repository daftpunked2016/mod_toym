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
	use BasicHelper;

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
			array('career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4, supporting_photo_1, supporting_photo_2, supporting_photo_3, supporting_photo_4,  photograph_upload_id, id_birth_cert_upload_id, nbi_clearance_upload_id', 'required', 'on'=>'submit'),
			array('career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4', 'required', 'on'=>'page1', 'message'=>'* This field is required '),
			array('supporting_photo_1, supporting_photo_2, supporting_photo_3, supporting_photo_4', 'required', 'on'=>'page2', 'message'=>'* At least 1 image file is required '),
			array('photograph_upload_id, id_birth_cert_upload_id, nbi_clearance_upload_id', 'required', 'on'=>'page3', 'message'=>'* This field is required '),
			array('nominee_id, nominator_id, nomination_id, photograph_upload_id, id_birth_cert_upload_id, nbi_clearance_upload_id, status_id', 'numerical', 'integerOnly'=>true),
			array('created_by, updated_by', 'length', 'max'=>20),
			array('career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4, date_created, date_updated, date_submitted', 'safe'),
			array('career_info_essay_1, career_info_essay_2, career_info_essay_3, career_info_essay_4', 'validateWordCount', 'on'=>['page1', 'submit']),
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
			'supporting_photo_1' => 'Supporting Photos 1',
			'supporting_photo_2' => 'Supporting Photos 2',
			'supporting_photo_3' => 'Supporting Photos 3',
			'supporting_photo_4' => 'Supporting Photos 4',
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

	public function addFileToAttr($file, $attribute_name, $nominator_id = null, $nominee_id = null,  $type = ImageFileHandler::PORTFOLIO_FILES)
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

	public function uploadEachFileToAttr($files, $attribute_name, $nominator_id = null, $nominee_id = null,  $type = ImageFileHandler::PORTFOLIO_FILES)
	{
		$mapped_files = $this->mapFileInputArray($files);
		$file_ids = [];

		foreach($mapped_files as $file) {
			$filehandler = new ImageFileHandler($file, $type, $nominator_id, $nominee_id);
			
			if($filehandler->saveUpload())
				$file_ids[] = $filehandler->_id;
		}

		if($this->$attribute_name != null || $this->$attribute_name != "") {
			$this->$attribute_name = json_encode(array_merge(json_decode($this->$attribute_name), $file_ids));
		} else {
			$this->$attribute_name = json_encode($file_ids);
		}

		return $this->$attribute_name;
	}

	public function validateWordCount($attribute, $params)
	{	
		$input = strip_tags($this->$attribute);
		$input = str_replace('/', ' ', $input);
		$input = str_replace(',', ' ', $input);
		$word_count = str_word_count(strip_tags($input));
		//print_r($word_count);exit;
		if( $word_count < 250 ) {
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

	public function printSupportingPhotosInput($attribute)
	{
		$labels = $this->attributeLabels();

		for($x = 0; $x < 4; $x++){
	        $supporting_photos = json_decode($this->$attribute); 
	      	

	        echo "<div class='form-group has-feedback'>";
	        if($x == 0) {
	          echo "<label class='col-sm-2 control-label' id='{$attribute}'>".$labels[$attribute]."</label>";
	        } else {
	          echo "<div class='col-sm-2' id='{$attribute}'></div>";
	        }

	        if(isset($supporting_photos[$x])) {
	        	$file_path = ToymFileUploads::getFilePath( $supporting_photos[$x] );
		        echo "	
				<div class='col-sm-1'>
					<a href='{$file_path}' target='_blank'>
						<div class='img-prev-container'>
							<img src='{$file_path}' />
						</div>
					</a>						
				</div>
				<div class='col-sm-9'>
					<div class='btn-group btn-block' role='group' style='margin-top:8px;'>
						<a href='{$file_path}' target='_blank' class='btn btn-info' data-toggle='tooltip' data-placement='top' title='Click to Load/View File Uploaded..'><i class='fa fa-search' style='margin-right:10px'></i><span style='margin-right:20px;'> View Image </span></a>
	              		<span class='btn btn-danger delete-supporting-image' data-fid='{$supporting_photos[$x]}' data-attribute='{$attribute}' data-toggle='tooltip' data-placement='top' title='Click to Delete File Uploaded..'><i class='fa fa-trash' style='margin-right:10px'></i><span style='margin-right:20px;'> Delete Image </span></span>
	            	</div>
	            </div>";
	        } else {
	          echo "
	          <input type='file' name='{$attribute}[]' class='file' data-allowed=\"{'jpg','jpeg','png'}\">
	          <div class='input-group col-sm-8' style='padding:0 20px;'>
	            <span class='input-group-btn'>
	              <button class='browse btn btn-default' type='button'><i class='glyphicon glyphicon-plus'></i> Select File </button>
	            </span>
	            <input type='text' class='form-control filename-upload-container' disabled placeholder='No file selected..'>
	          </div>";
	        }

	        echo "</div>";
	      } 
	}

	public function generatePdf()
	{
		$nominator = $this->nominator;
		$nominee = $this->nominee;
		$nominee_info = ToymNomineeInfo::model()->find("nominee_id = {$this->nominee_id}");
		$nominee_essays = ToymNomineeEssays::model()->find("nominee_id = {$this->nominee_id}");
		$chapters = Chapter::model()->findAll(['order'=>'chapter ASC','condition'=>'id != 334 AND id != 338 AND id != 339 AND id != 340 AND id != 341']);
		$chapters_indexed = CHtml::listData($chapters, 'id', 'chapter');
		$additional_files = "";

		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		spl_autoload_register(array('YiiBase','autoload'));

		// set document information
		$pdf->SetCreator(PDF_CREATOR);  
		$pdf->SetTitle("JCI TOYM PORTFOLIO");                
		$pdf->SetHeaderData('');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetFont('helvetica', '', 9);
		$pdf->SetTextColor("Black"); 
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
	
	
		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_1',['nominator'=>$nominator, 'nominee'=>$nominee, 'chapters_indexed'=>$chapters_indexed],true) , true, false, true, false, '');
		$pdf->setPage(1);

		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_2',['nominee'=>$nominee,'nominee_info'=>$nominee_info,],true) , true, false, true, false, '');
		$pdf->setPage(2);

		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_3',['nominee_info'=>$nominee_info,],true) , true, false, true, false, '');

		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_4',['portfolio'=>$this, 'nominee_essays'=>$nominee_essays],true) , true, false, true, false, '');

		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_images',['images'=>$this->supporting_photo_1, 'set'=>1],true) , true, false, true, false, '');

		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_images',['images'=>$this->supporting_photo_2, 'set'=>2],true) , true, false, true, false, '');

		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_images',['images'=>$this->supporting_photo_3, 'set'=>3],true) , true, false, true, false, '');

		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_images',['images'=>$this->supporting_photo_4, 'set'=>4],true) , true, false, true, false, '');

		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_5',['nominator'=>$nominator],true) , true, false, true, false, '');

		// PAGE
		$pdf->addPage();
		$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_documents',['portfolio'=>$this],true) , true, false, true, false, '');

		if($this->id_birth_cert_upload_id != "") {
			$file = ToymFileUploads::model()->findByPk($this->id_birth_cert_upload_id);

			if(strtolower($file->file_extension) != "pdf") {
				$pdf->addPage();
				$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_documents2',['file_upload_id'=>$this->id_birth_cert_upload_id],true) , true, false, true, false, '');
			} else {
				$additional_files .= " ".ToymFileUploads::getFilePath($file->id, true)." ";
			}
		}

		if($this->nbi_clearance_upload_id != "") {
			$file = ToymFileUploads::model()->findByPk($this->nbi_clearance_upload_id);

			if(strtolower($file->file_extension) != "pdf") {
				$pdf->addPage();
				$pdf->writeHTML(Yii::app()->controller->renderPartial('_portfolio_page_documents2',['file_upload_id'=>$this->nbi_clearance_upload_id],true) , true, false, true, false, '');
			} else {
				$additional_files .= " ".ToymFileUploads::getFilePath($file->id, true)." ";
			}
		}
 
		$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)'); //TODO:you can change this Header information according to your need.Also create a Dynamic Header.
 
		// data loading
		$data = $pdf->LoadData(Yii::getPathOfAlias('ext.tcpdf').DIRECTORY_SEPARATOR.'table_data_demo.txt'); //This is the example to load a data from text file. You can change here code to generate a Data Set from your model active Records. Any how we need a Data set Array here.
		// print colored table
		
		// set style for barcode
		$style = array(
			'border' => false,
			'vpadding' => 'auto',
			'hpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255)
			'module_width' => 1, // width of a single module in points
			'module_height' => 1 // height of a single module in points
		);
			
		$pdf->lastPage();

		$pdf_filename = $this->id.time().'_TOYM_PORTFOLIO.pdf';
		$pdf_portfolio_path = '/home/quadrant/public_html/2017TOYMmod/page_assets/pdfs/'.$pdf_filename;

		if($additional_files != "") {
			$pdf->Output($pdf_portfolio_path, 'F');
			$current_pdf_portfolio_path = "page_assets/pdfs/{$pdf_filename}";
			$pdfs_filepath = "{$current_pdf_portfolio_path} {$additional_files}";
			$new_pdf_filename = $this->id.time().'b_TOYM_PORTFOLIO.pdf';
			$pdf_output_filepath = "page_assets/pdfs/{$new_pdf_filename}";
			$this->mergePdfs($pdfs_filepath, $pdf_output_filepath);
			unlink($current_pdf_portfolio_path);

			return $new_pdf_filename;
		} else {
			$pdf->Output($pdf_portfolio_path, 'F');
			return $pdf_filename;
		}
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
