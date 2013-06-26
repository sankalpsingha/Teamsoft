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

	public $defaultAction = 'dashboard';

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
				'actions'=>array('update','dashboard', 'gallery'),
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

				// This would put the default role as a member.
				$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
				$authorizer->authManager->assign('Member', $model->id);
				//-------
				
				
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($slug)
	{
		$something = User::model()->findByAttributes(array('slug'=>$slug));
		$id = $something->id;
		$this->pageTitle = ucfirst(User::model()->findByPk($id)->name).'\'s'.' Home';
		$statusLast = new Status;
		$user = User::model()->findByPk($id);

		// This is the section that would get the amount of the user.
		// I think we can make a function for this.. But Oh well... :O
		$amount = $user->money;
		$sum = 0;
		if($amount != null) {
			foreach ($amount as $key) {
				$sum += $key->amount;
			}
		}
		//-----
		//
		//
		// Putting the pagination data :
		$criteria = new CDbCriteria;
		$criteria->order = 'created_on DESC';
		$pages = new CPagination(Status::model()->count()); 
		// set the page limit :
		$pages->pageSize =	3;
		$pages->applyLimit($criteria);
		$statuses = Status::model()->findAll($criteria);

		// Pagination data done!

		
		$modules = $user->modules;

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'statuses' => $statuses, // This is using Relational AR
			'lastStatus' => $statusLast->getLastStatus(), // This would get the last status for the Last Status
			'modules' => $modules,
			'amount' => $sum, // This would send the amount.
			'pages' => $pages,

		));
	}

	/**
	 * This is the main page where all the spice happens.
	 */
	public function actionDashboard()
	{
		$user_id = Yii::app()->user->id;
		$this->pageTitle = 'Welcome '.ucfirst(User::model()->findByPk(Yii::app()->user->id)->name);
		$statusLast = new Status;
		$user = User::model()->findByPk($user_id); // This would only get the specific user
		$status = $this->createStatus();
		$money = $this->createMoney();

		// This is the section that would get the amount of the user.
		$amount = $user->money;
		$sum = 0;
		if($amount != null) {
			foreach ($amount as $key) {
				$sum += $key->amount;
			}
		}
		// Fetching the todos of the logged in the user.
		$todo = $user->todos;
		//-----
		
		// Putting the pagination data :
		$criteria = new CDbCriteria;
		$criteria->order = 'created_on DESC';
		$pages = new CPagination(Status::model()->count()); 
		// set the page limit :
		$pages->pageSize =	2;
		$pages->applyLimit($criteria);
		$statuses = Status::model()->findAll($criteria);

		// Pagination data done!

		$modules = $user->modules;
		//$dataProvider=new CActiveDataProvider('User');  // As this is not actuallly required.
		$this->render('index',array(
			//'dataProvider'=>$dataProvider,
			'status' => $status, // sending the variable to the view file.
			'model' => $user,
			'statuses' => $statuses, // This is using Relational AR
			'lastStatus' => $statusLast->getLastStatus(), // This would get the last status for the Last Status
			'money' => $money,
			'modules' => $modules,
			'amount' => $sum, // This would send the amount.
			'pages' => $pages,
			'todos' => $todo,
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

	public function actionGallery() {
		$model = new User;

		$images = Picture::model()->getImages(Yii::app()->user->id);

		$this->render('gallery', array(
				'model' => $model,
				'images' => $images,
			)
		);
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
