<?php

/**
 * This is the model class for table "module".
 *
 * The followings are the available columns in table 'module':
 * @property string $id
 * @property string $category
 * @property string $description
 * @property string $color
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Todo[] $todos
 * @property User[] $users
 */
class Module extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Module the static model class
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
		return 'module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, description, color', 'required'),
			array('category', 'length', 'max'=>100),
			array('color', 'length', 'max'=>10),
			array('description, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category, description, color, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'module_id'),
			'todos' => array(self::HAS_MANY, 'Todo', 'module_id'),
			'todosCount' => array(self::STAT, 'Todo', 'module_id'),
			'users' => array(self::MANY_MANY, 'User', 'user_has_module(module_id, user_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'description' => 'Description',
			'color' => 'Color',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'user_id' => 'Add users to the module',
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
		$criteria->compare('category',$this->category,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);

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

		//------ You may remove this if this is not required. ------
		// Adding the extension of Advanced AR. It would be used for the many to many relation.
		// Possible use : 
		// $module = new Module;
		// $module->users = array(5,6,7,8); // You have to get the user id's from the view and pass it here.
		// $module->save();
		// 
		// What the above code should do is : The user's with the respective id's given above be added to the module.

		'CAdvancedArBehavior' => array(
            'class' => 'application.extensions.CAdvancedArBehavior')

		);

		//-----------------------------------------------------------
	}

	/**
	 * This would return all the users in the form of an array of 'id' and the 'username'
	 * @return array $userArray
	 */
	public function getAllUser(){
		$user = User::model()->findAll(); // This would give all the users.
		$usersArray = CHtml::listData($user,'id','name'); 
		return $usersArray; // This would return the array of the users in the 'id' and the 'username'
	}



}