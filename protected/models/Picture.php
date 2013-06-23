<?php

/**
 * This is the model class for table "picture".
 *
 * The followings are the available columns in table 'picture':
 * @property string $id
 * @property string $user_id
 * @property string $created_on
 * @property string $updated_on
 * @property string $name
 * @property string $size
 * @property string $file_name
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Picture extends CActiveRecord
{
	public $picture;
	public $file_name;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Picture the static model class
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
		return 'picture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, created_on, updated_on, name, size, file_name', 'required'),
			array('user_id', 'length', 'max'=>10),
			array('name, size, file_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, created_on, updated_on, name, size, file_name', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'name' => 'Name',
			'size' => 'Size',
			'file_name' => 'File Name',
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
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('file_name',$this->file_name,true);

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
}