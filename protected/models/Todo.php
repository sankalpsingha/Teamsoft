<?php

/**
 * This is the model class for table "todo".
 *
 * The followings are the available columns in table 'todo':
 * @property string $id
 * @property string $todocol
 * @property string $created_on
 * @property string $updated_on
 * @property string $deadline
 * @property string $module_id
 * @property string $description
 * @property integer $completed
 *
 * The followings are the available model relations:
 * @property BugFeature[] $bugFeatures
 * @property ReportTodo[] $reportTodos 
 * @property Module $module
 * @property User[] $users
 */
class Todo extends CActiveRecord
{
	public $user_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Todo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'todo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('todocol, module_id, users', 'required'),
			array('completed', 'numerical', 'integerOnly'=>true),
			array('todocol', 'length', 'max'=>255),
			array('module_id', 'length', 'max'=>10),
			array('created_on, updated_on, deadline, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, todocol, created_on, updated_on, deadline, module_id, description, completed', 'safe', 'on'=>'search'),
			array('deadline', 'authenticateDate'),
		);
	}

	public function authenticateDate($attribute, $params) {
		$todayDate = Yii::app()->Date->now();
		$interval = Yii::app()->Date->daysCount($this->deadline, $todayDate);
		if($interval <= 1) {
			$this->addError('deadline', 'Deadline shoud be greater than or equal to 1 day\'s time');
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
			'bugFeatures' => array(self::HAS_MANY, 'BugFeature', 'todo_id'),
			'reportTodos' => array(self::HAS_MANY, 'ReportTodo', 'todo_id'),
			'module' => array(self::BELONGS_TO, 'Module', 'module_id'),
			'users' => array(self::MANY_MANY, 'User', 'todo_has_user(todo_id,user_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'todocol' => 'Name',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'deadline' => 'Deadline',
			'module_id' => 'Module',
			'user_id' => 'User',
			'description' => 'Description',
			'completed' => 'Completed',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('todocol',$this->todocol,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('deadline',$this->deadline,true);
		$criteria->compare('module_id',$this->module_id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('completed',$this->completed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function behaviors(){
		return array('CTimestampBehavior'=>array(
			'class' => 'zii.behaviors.CTimestampBehavior',
			'createAttribute' => 'created_on',
			'updateAttribute' => 'updated_on',
			'setUpdateOnCreate' => true,
			),
			'CAdvancedArBehavior' => array(
        	    'class' => 'application.extensions.CAdvancedArBehavior'),
		);
	}

	public function afterValidate() {
		parent::afterValidate();
		if(!$this->hasErrors()) {
			$this->completed = 0;
		}
	}

	public function getUsers($id){
		$user =  Module::model()->findByPk($id)->users; // This would give all the users.
		$usersArray = CHtml::listData($user,'id','name'); 
		return $usersArray; // This would return the array of the users in the 'id' and the 'username'
	}

	public function getTodoStatus() {
		return array('Incomplete', 'Complete');
	}
}