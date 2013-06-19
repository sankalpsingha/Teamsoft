<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view', 'create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','index'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * This is the main page where all the spice happens.
	 */
	public function actionIndex()
	{
		$this->pageTitle = 'Welcome '.ucfirst(Yii::app()->user->name);

		$statusLast = new Status;


		$user = User::model()->findByPk(Yii::app()->user->id); // This would only get the specific user
		$status = $this->createStatus();
		$money = $this->createMoney();
		//$dataProvider=new CActiveDataProvider('User');  // As this is not actuallly required.
		$this->render('index',array(
			//'dataProvider'=>$dataProvider,
			'status' => $status, // sending the variable to the view file.
			'model' => $user,
			'statuses' => $user->status, // This is using Relational AR
			'lastStatus' => $statusLast->getLastStatus(), // This would get the last status for the Last Status
			'money' => $money,

		));
	}

	public function createStatus(){
		$status = new Status; // This would create a new instance of the status.
		if(isset($_POST['Status'])){
			$status->attributes = $_POST['Status']; // This would give a massive assign
			if($status->validate()){
			$status->save();
			Yii::app()->user->setFlash('statusCreated','Your status has been submitted.');
			$this->refresh(); 
			}
		}

		return $status;
	}

	public function createMoney(){
		$money = new Money;
		if(isset($_POST['Money'])){
			$money->attributes = $_POST['Money']; // Massive assignment
			if($money->validate()){
				$money->save();
				Yii::app()->user->setFlash('moneyCreated','Your amount has been added. Please note that the moderator can edit or remove it.');
				$this->refresh();
			}
		}

		return $money;
	}


	/**
	* Handles resource upload
	* @throws CHttpException
	*/
	public function actionUpload()
	{
    header('Vary: Accept');
    if (isset($_SERVER['HTTP_ACCEPT']) && 
        (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))
    {
        header('Content-type: application/json');
    } else {
        header('Content-type: text/plain');
    }
    $data = array();
 
    $model = new User('upload');
    $model->picture = CUploadedFile::getInstance($model, 'picture');
    if ($model->picture !== null  && $model->validate(array('picture')))
    {
        $model->picture->saveAs(
        Yii::getPathOfAlias('application.uploads').'/'.$model->picture->name);
        $model->file_name = $model->picture->name;
        // save picture name
        if( $model->save())
        {
            // return data to the fileuploader
            $data[] = array(
                'name' => $model->picture->name,
                'type' => $model->picture->type,
                'size' => $model->picture->size,
                // we need to return the place where our image has been saved
                //'url' => $model->getImageUrl(), // Should we add a helper method?
                // we need to provide a thumbnail url to display on the list
                // after upload. Again, the helper method now getting thumbnail.
                //'thumbnail_url' => $model->getImageUrl(User::IMG_THUMBNAIL),
                // we need to include the action that is going to delete the picture
                // if we want to after loading 
                'delete_url' => $this->createUrl('my/delete', 
                    array('id' => $model->id, 'method' => 'uploader')),
                'delete_type' => 'POST');
        } else {
            $data[] = array('error' => 'Unable to save model after saving picture');
        }
    } else {
        if ($model->hasErrors('picture'))
        {
            $data[] = array('error', $model->getErrors('picture'));
        } else {
            throw new CHttpException(500, "Could not upload file ".     CHtml::errorSummary($model));
        }
    }
    // JQuery File Upload expects JSON data
    echo json_encode($data);
}
 

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
