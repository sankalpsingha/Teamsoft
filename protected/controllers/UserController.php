<?php

class UserController extends RController
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
			'rights',
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
				'actions'=>array('view', 'create', 'flagged', 'reset'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','dashboard', 'gallery','UpdateInfo','toggle','Moderator','cad'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'PowerChange'),
				'users'=>array('parry', 'sankalp'),
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
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())

				/*//This would put the default role as a member.
				$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
				$authorizer->authManager->assign('Member', $model->id);
				*/
				
				
				$this->redirect(array('site/login'));
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
		$amount = $user->moneys;
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
		$incompleteTodoCheck = $this->todoCheck();
		if(!$incompleteTodoCheck) {
			User::model()->updateByPk(Yii::app()->user->id, array('active' => 1));
			Yii::app()->user->logout();
			$this->render('/site/error', array('code' => 101, 'message' => 'You were flagged for not finishing the job on time'));
			Yii::app()->end();
		}
		$this->pageTitle = 'Welcome '.ucfirst(User::model()->findByPk(Yii::app()->user->id)->name);
		$statusLast = new Status;
		$user = User::model()->findByPk($user_id); // This would only get the specific user

		$picture = $user->profilepic;
		$picture = ProfilePicture::model()->findByPk($picture);
		$pic = 'default.png';
		if($picture != null) {
			$pic = $picture->profile_picture;
		}

		// $status = $this->createStatus();
		$status = new Status;
		$money = $this->createMoney();

		// This is the section that would get the amount of the user.
		$amount = $user->moneys;
		$sum = 0;
		if($amount != null) {
			foreach ($amount as $key) {
				$sum += $key->amount;
			}
		}
		// Fetching the todos of the logged in the user.
		$todo = $user->todos;
		$todoArray = array();
		foreach ($todo as $value) {
			if(!$value->completed) {
				$todoArray[] = $value;
			}
		}
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

		// Modules array
		$modulesArray = $this->modulesArray();

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
			'todos' => $todoArray,
			'modulesArray' => $modulesArray,
			'picture' => $pic,
		));
	}

	/**
	 * This function adds the 'money' to the money table
	 */
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
	
	public function actionCad()
	{
		$cad = Stl::model()->findAll();

		$this->render('cad',array(
			'cad' => $cad,
			));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');

		//Fetching all ToDo
		$todo = new Todo('search');
		//Fetching all Modules
		$criteria = new CDbCriteria;
		$criteria->select = 't.*, u.name';
		$criteria->join = 'LEFT JOIN user u ON u.id = t.user_id';
		$modules = Module::model()->findAll($criteria);
		$module = new CActiveDataProvider('Module');
		$module->setData($modules);

		//Fetching all complaints
		$complaints = Complaint::model()->findAll($criteria);
		$complaint = new CActiveDataProvider('Complaint');
		$complaint->setData($complaints);
		//Fetched all complaints

		$this->render('admin',array(
			// Sending the required variables.
			'model'=>$model,
			'todo' =>$todo, 
			'module' => $module,
			'complaints' => $complaint,
		));
	}

	/**
	 * Display all the pictures uploaded by the current user
	 */
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

	/**
	 * Updates about me on the dashboard page via AJAX
	 */
	public function actionUpdateInfo(){
		Yii::import('bootstrap.widgets.TbEditableSaver');
		$es = new TbEditableSaver('User'); // This is to be used for the ajax update of the 
		$es->update();
	}

	/**
	 * This is the page that is viewed by the flaged user
	 */
	public function actionFlagged() {
		$user = $this->loadModel(Yii::app()->session['flagged_id']);
		$incompleteTodos = $user->todos;
		$postTodo = null;
		foreach ($incompleteTodos as $value) {
			$daysLeft = Yii::app()->Date->daysCount($value->deadline, Yii::app()->Date->now());
			if(($value->completed == 0) && ($daysLeft < 0) && ($daysLeft >= -2)) {
				$postTodo = $value;
			} elseif($daysLeft < -3) {
				User::model()->updateByPk($user->id, array('active' => 2));
				$this->render('/site/error', array('code' => '404', 'message' => 'You are banned'));
				Yii::app()->end();
			}
		}
		if(isset($_POST['ReportTodo']))
		{
			$model = new ReportTodo;
			$model->attributes = $_POST['ReportTodo'];
			$model->user_id = Yii::app()->session['flagged_id'];
			$model->created_on = Yii::app()->Date->now();
			$model->updated_on = Yii::app()->Date->now();
			$model->todo_id = $postTodo->id;
			if($model->save()) {
				$command = Yii::app()->db->createCommand("UPDATE todo SET completed = 1 WHERE id = $postTodo->id");
				$command->execute();
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$this->render('flagged', array('user' => $user, 'todo' => $postTodo, 'reportTodo' => New ReportTodo));
	}

	/**
	 * Resets the password after validating the security answer of the passed username. AJAX
	 */
	public function actionReset() {
		if (!Yii::app()->request->isAjaxRequest) {
	        throw new CHttpException('403', 'Forbidden access.');
	    }

	    if(isset($_GET['username'])) {
	    	$username = $_GET['username'];
		    $user = User::model()->findByAttributes(array('username' => $username));
 		    if($user != null) {
 		    	unset(Yii::app()->session['user_id']);
			    Yii::app()->session['user_id'] = $user->id;
		    	echo "<div id='worefresh'><p class='lead'>".$user->sec_ques."</p>
		    	<input type='text' id='sec_ques'>
		    	<button id='sec'>Reset</button>
		    	<script type='text/javascript'>
		    		$('#sec').click(
		    			function(){
		    			var ans = $('input[id=sec_ques]').val();
		    			$.post('/user/reset',{ans : ans}, function(string){
		    				if(string == 1) {
		    					alert('Your password has been mailed to you.');
		    					$('#worefresh').html('');
		    				} else {
		    					alert('Wrong combination');
		    					window.location.reload();
		    				}
		    			}
		    			);
					}	
				);
				</script></div>";
		    } else {
		    	echo "Invalid User";
		    }
	    }

	    if(isset($_POST['ans'])) {
	    	$user_id = Yii::app()->session['user_id'];
	    	$user = User::model()->findByPk($user_id);
	    	if($user->answer == $_POST['ans']) {
	    		echo 1;
	    		unset(Yii::app()->session['user_id']);
	    	} else {
	    		echo 0;
	    	}
	    }
	}

	/**
	 * Returns an array with modules and their completion status to use with yii-charts
	 * @return array yii-charts
	 */
	public function modulesArray(){
		$modules = Module::model()->findAll();
		$array = array(
                    array(
                        "value" => 0
                    ),
            );
		foreach ($modules as $module) {
			$todos = $module->todos;
			$todosCount = $module->todosCount;
			$completedTodos = 0;
			foreach ($todos as $value) {
				if($value->completed) {
					$completedTodos++;
				}
			}
			if($completedTodos != 0) {
				$value = ($completedTodos/$todosCount) * 100;
			} else {
				$value = 0;
			}
			$array[] = array("value" => $value, "color" => "$module->color", "label" => "$module->category");
		}
		return $array;
	}




	/**
	 * This function checks if the user has any incompleted Todos with deadline over
	 * @return boolean false if incomplete and deadline over, true if incomplete and deadline not over
	 */
	protected function todoCheck() {
		$user = $this->loadModel(Yii::app()->user->id);
		$remainingTodos = $user->todos;
		foreach ($remainingTodos as $value) {
			if($value->completed == 0) {
				$daysLeft = Yii::app()->Date->daysCount($value->deadline, Yii::app()->Date->now());
				if($daysLeft < 0) {
					return false;
				}
			}
		}
		return true;
	}

	public function actionModerator() {
		//Fetches the User ID
		$user = Yii::app()->user->id;

		//
		$module = Module::model()->findAllByAttributes(array('user_id' => $user));
		$data = new CActiveDataProvider('Module');
		$users = $module['0']->users;
		$module_data = new CActiveDataProvider('Module');
		$module_data->setData($module);
		$member = null;
		$complaint = array();
		$complaint_data = new CActiveDataProvider('Complaint');
		foreach ($users as $value) {
			if($value->id != $user) {
				$member[] = $value;
				$criteria = new CDbCriteria;
				$criteria->select = 't.*, u.*';
				$criteria->join = 'LEFT JOIN user u ON u.id = t.user_id';
				$criteria->condition = 't.user_id = '.$value->id.'';
				$complaints = Complaint::model()->findAll($criteria);
			}
		}
		$data->setData($member);
		$this->render('_mod', array('module' => $module_data, 'data' => $data, 'complaints' => $complaint_data));
	}

	public function actionToggle() {
		$name = $_POST['name'];
		$value = $_POST['value'];
		$pk = $_POST['pk'];
		$user = User::model()->findByPk($pk);
		$user->$name = $value;
		$user->update();
		 /*return array(
			'toggle' => array(
				'class'=>'bootstrap.actions.TbToggleAction',
				'modelName' => 'User',
			)
		);*/
	}

	public function actionPowerChange(){
		if(isset($_POST['name'])){
			$name  = $_POST['name'];
			$value = $_POST['value'];
			$pk = $_POST['pk'];
			$user = User::model()->findByPk($pk);
			$user->$name = $value;
			$user->update();
			if($name == 'power') {
				if($value == 1) {
					$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
					$authorizer->authManager->assign('Moderator', $model->id);
				} elseif($value == 2) {
					$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
					$authorizer->authManager->assign('Admin', $model->id);
				} elseif($value == 0) {
					$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
					$authorizer->authManager->assign('Member', $model->id);
				}
			}
		}
	}

	public function actions(){
		 return array(
			'toggle' => array(
			'class'=>'bootstrap.actions.TbToggleAction',
			'modelName' => 'User',
			)
		);
	}
}
