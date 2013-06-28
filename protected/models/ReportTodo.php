<?php

/**
 * This is the model class for table "report_todo".
 *
 * The followings are the available columns in table 'report_todo':
 * @property string $id
 * @property string $user_id
 * @property string $todo_id
 * @property string $report_data
 * @property string $created_on
 * @property string $updated_on
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Todo $todo
 */
class ReportTodo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportTodo the static model class
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
		return 'report_todo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('todo_id, report_data', 'required'),
			array('user_id, todo_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, todo_id, report_data, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'todo' => array(self::BELONGS_TO, 'Todo', 'todo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'todo_id' => 'Todo',
			'report_data' => 'Report Data',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('todo_id',$this->todo_id,true);
		$criteria->compare('report_data',$this->report_data,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Default behaviours for created_on and updated_on columns
	 */
	public function behaviors(){
		return array('CTimestampBehavior'=>array(
			'class' => 'zii.behaviors.CTimestampBehavior',
			'createAttribute' => 'created_on',
			'updateAttribute' => 'updated_on',
			'setUpdateOnCreate' => true,
			),
		);
	}

	protected function afterValidate() {
		parent::afterValidate();
		if(!$this->hasErrors()) {
			if($this->user_id == null) {
				$this->user_id = Yii::app()->user->id;
			}
		}
	}

}