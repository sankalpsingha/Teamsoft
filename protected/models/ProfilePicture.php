<?php

/**
 * This is the model class for table "profile_picture".
 *
 * The followings are the available columns in table 'profile_picture':
 * @property string $id
 * @property string $profile_picture
 * @property string $user_id
 * @property string $created_on
 * @property string $updated_on
 */
class ProfilePicture extends CActiveRecord
{
	public $picture;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProfilePicture the static model class
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
		return 'profile_picture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('profile_picture', 'required'),
			array('profile_picture', 'length', 'max'=>100),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, profile_picture, user_id, created_on, updated_on', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'profile_picture' => 'Profile Picture',
			'user_id' => 'User',
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
		$criteria->compare('profile_picture',$this->profile_picture,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function behaviors() {
		return array(
			'CTimestampBehavior'=>array(
			'class' => 'zii.behaviors.CTimestampBehavior',
			'createAttribute' => 'created_on',
			'updateAttribute' => 'updated_on',
			'setUpdateOnCreate' => true,
		));
	}

	protected function afterValidate() {
		parent::afterValidate();
		if(!$this->hasErrors()) {
			$this->user_id = Yii::app()->user->id;
		}
	}
}