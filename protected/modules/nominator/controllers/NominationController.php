<?php

class NominationController extends Controller
{
  public $layout = '/layouts/main';

  public function actionIndex()
  {
    $this->redirect('info');
  }

  public function actionInfo()
  {
    $nominator_id = Yii::app()->getModule('nominator')->user->id;
    $nominator = ToymNominator::model()->findByPk($nominator_id);
    $nominee =  ToymNominee::model()->find("nominator_id = {$nominator_id}");
    $nominee_essays = ToymNomineeEssays::model()->find("nominee_id = {$nominee->id}");
    $nominee_info = ToymNomineeInfo::model()->find("nominee_id = {$nominee->id}");

    if($nominee_info == null) {
      $nominee_info = new ToymNomineeInfo();
    }

    if(!empty($_POST)) {
      $nominator->attributes = $_POST['ToymNominator'];
      $nominee->attributes = $_POST['ToymNominee'];
      $nominee_essays->attributes = $_POST['ToymNomineeEssays'];
      $nominee_info->attributes = $_POST['ToymNomineeInfo'];

      $valid = $nominator->validate();
      $valid = $nominee->validate() && $valid;
      $valid = $nominee_info->validate() && $valid;
      $valid = $nominee_essays->validate() && $valid;

      if ($valid) {
        $transaction = Yii::app()->db->beginTransaction();

        try {
          if ($nominator->save() && $nominee->save()) {
           
            $nominee_info->nominee_id = $nominee->id;

            if($nominee_info->save() && $nominee_essays->save()) {
              $transaction->commit();
              Yii::app()->user->setFlash('success', 'Changes have been successfully saved!');
            }
            
          }
        } catch (Exception $e) {
          $transaction->rollback();
          Yii::app()->user->setFlash('error', 'Saving Failed! Please try again later or contact the System Administrator if it happened repeatedly.');
        }
      } else {
        // echo "<pre>";
        // print_r($nominator->getErrors());
        // echo "<hr />";
        // print_r($nominee->getErrors());
        // echo "<hr />";
        // print_r($nominee_info->getErrors());
        // echo "</pre>";
        Yii::app()->user->setFlash('error', '<li> Validation Failed! Please double check the required fields and rules. </li>');
      }
    }
  
    $this->render("information_sheet", [
      'nominator'=>$nominator, 
      'nominee'=>$nominee,
      'nominee_info'=>$nominee_info,
      'nominee_essays'=>$nominee_essays,
      'categories'=>ToymCategory::model()->findAll(['order'=>'catname ASC']),
      'subcategories'=>ToymSubcategory::model()->findAll(['order'=>'catdesc ASC']),
      'chapters'=>Chapter::model()->findAll(['order'=>'chapter ASC','condition'=>'id != 334 AND id != 338 AND id != 339 AND id != 340 AND id != 341']),
      'countries'=>Countries::model()->findAll(['order'=>'country_name ASC'])
    ]);
  }

  
}