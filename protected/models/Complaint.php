<?php

/**
 * This is the model class for table "complaint".
 *
 * The followings are the available columns in table 'complaint':
 * @property string $id
 * @property string $complaint
 * @property string $created_on
 * @property string $updated_on
 * @property string $user_agent
 * @property string $ip
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Complaint extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Complaint the static model class
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
		return 'complaint';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('complaint', 'required'),
			array('user_agent', 'length', 'max'=>100),
			array('ip', 'length', 'max'=>45),
			array('user_id', 'length', 'max'=>10),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, complaint, created_on, updated_on, user_agent, ip, user_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'complaint' => 'Complaint',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'user_agent' => 'User Agent',
			'ip' => 'Ip',
			'user_id' => 'User',
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
		$criteria->compare('complaint',$this->complaint,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('user_id',$this->user_id,true);

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
		));
	}

	protected function afterValidate(){
		parent::afterValidate(); // This would give the application the chance to take over if something goes wrong.
		if(!$this->hasErrors()){
			$this->ip = $_SERVER['REMOTE_ADDR'];
			$this->user_agent = $_SERVER['HTTP_USER_AGENT']; 
			$this->user_id = Yii::app()->user->id;
		}
	}
}