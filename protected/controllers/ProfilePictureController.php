<?php

class ProfilePictureController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload','delete','crop','ajaxcrop'),
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
		$model=new ProfilePicture;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProfilePicture']))
		{
			$model->attributes=$_POST['ProfilePicture'];
			if($model->save()) {
				$user = User::model()->findByPk(Yii::app()->user->id);
				$user->profilepic = (int)$model->id;
				if($user->update())
					$this->redirect(array('view','id'=>$model->id));
			}
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

		if(isset($_POST['ProfilePicture']))
		{
			$model->attributes=$_POST['ProfilePicture'];
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
		$dataProvider=new CActiveDataProvider('ProfilePicture');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProfilePicture('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProfilePicture']))
			$model->attributes=$_GET['ProfilePicture'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProfilePicture the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProfilePicture::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProfilePicture $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-picture-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * This is the upload definition for the file upload. It is used with the usage of the TbFileUpload.
	 * @return [type] [description]
	 */
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

	    $model = new ProfilePicture();
	    $model->picture = CUploadedFile::getInstance($model, 'picture');
	    $ext = substr($model->picture->name, strrpos($model->picture->name, '.')+1);
	    $fakeName = mt_rand();
	    while(glob(Yii::app()->basePath.'/../files/'.$fakeName.'.*')) {
	    	$fakeName = mt_rand();
	    }
	    $model->profile_picture = $fakeName.".".$ext;
	    if ($model->picture !== null  && $model->validate(array('picture')))
	    {
	        $model->picture->saveAs(Yii::app()->basePath.'/../files/'.$model->profile_picture);
	        // save picture name
	        if($model->save())
	        {
	        	$user = User::model()->findByPk(Yii::app()->user->id);
	        	$user->profilepic = $model->id;
	        	$user->update();
	            // return data to the fileuploader
	            $data[] = array(
	                'name' => $model->picture->name,
	                'type' => $model->picture->type,
	                'size' => $model->picture->size,
	                // we need to return the place where our image has been saved
	                'url' => $this->createUrl('user/gallery'), // Should we add a helper method?
	                'test' => $model->profile_picture,
	                // we need to provide a thumbnail url to display on the list
	                // after upload. Again, the helper method now getting thumbnail.
	                //'thumbnail_url' => $model->getImageUrl(User::self::IMG_THUMBNAIL),
	                // we need to include the action that is going to delete the picture
	                // if we want to after loading 
	                'delete_url' => $this->createUrl('profilePicture/delete',array('id' => $model->id, 'ajax' => 'ajax')),'delete_type' => 'POST');
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

	public function actionCrop() {
		$this->render('crop', array('model' => new ProfilePicture));
	}

	public function actionAjaxCrop() {
		Yii::import('ext.jcrop.EJCropper');
		$jcropper = new EJCropper();
		$jcropper->thumbPath = 'files';

		// some settings ...
		$jcropper->jpeg_quality = 95;
		$jcropper->png_compression = 8;
		
		// get the image cropping coordinates (or implement your own method)
		$coords = $jcropper->getCoordsFromPost('imageId');

		// returns the path of the cropped image, source must be an absolute path.
		$url = $this->createAbsoluteUrl('/files/802669506.png');
		$thumbnail = $jcropper->crop($url, $coords);
		// echo $url;
	}
}
