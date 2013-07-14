<?php

class StlController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights',
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$model=new Stl;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Stl']))
		{
			$model->attributes=$_POST['Stl'];
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

		if(isset($_POST['Stl']))
		{
			$model->attributes=$_POST['Stl'];
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Stl');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Stl('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Stl']))
			$model->attributes=$_GET['Stl'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Stl the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Stl::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Stl $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='stl-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpload()
	{
	    header('Vary: Accept');
	    if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))
	    {
	        header('Content-type: application/json');
	    } else {
	        header('Content-type: text/plain');
	    }
	    $data = array();

	    $model = new Stl();
	    $model->original_name = CUploadedFile::getInstance($model, 'file_name');
	    $fakeName = mt_rand();
	    while(glob(Yii::app()->basePath.'/../files/'.$fakeName.'.*')) {
	    	$fakeName = mt_rand();
	    }
	    $model->name = $fakeName.".stl";
	    if ($model->original_name !== null  && $model->validate(array('file_name')))
	    {
	        $model->original_name->saveAs(Yii::app()->basePath.'/../files/'.$model->name);
	        // $model->file_name = $model->picture->name;
	        // $model->user_id = Yii::app()->user->id;
	        // save picture name
	        if($model->save())
	        {
	            // return data to the fileuploader
	            $data[] = array(
	                'name' => $model->original_name->name,
	                'type' => $model->original_name->type,
	                'size' => $model->original_name->size,
	                // we need to return the place where our image has been saved
	                'url' => $this->createUrl('user/gallery'), // Should we add a helper method?
	                // we need to provide a thumbnail url to display on the list
	                // after upload. Again, the helper method now getting thumbnail.
	                //'thumbnail_url' => $model->getImageUrl(User::self::IMG_THUMBNAIL),
	                // we need to include the action that is going to delete the picture
	                // if we want to after loading 
	                'delete_url' => $this->createUrl('stl/delete',array('id' => $model->id, 'ajax' => 'ajax')),'delete_type' => 'POST');
	        } else {
	            $data[] = array('error' => 'Unable to save model after saving picture');
	        }
	    } else {
	        if ($model->hasErrors('original_name'))
	        {
	            $data[] = array('error', $model->getErrors('original_name'));
	        } else {
	            throw new CHttpException(500, "Could not upload file ".     CHtml::errorSummary($model));
	        }
	    }
	    // JQuery File Upload expects JSON data
	    echo json_encode($data);
	}
}
