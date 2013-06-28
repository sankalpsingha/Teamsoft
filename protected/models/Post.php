<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $created_on
 * @property string $updated_on
 * @property integer $status
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property PostComment[] $postComments
 * @property Tag[] $tags
 */
class Post extends CActiveRecord
{
	public $tag;

	// Defining the general terms for the post items.
	const ARCHIVE  = 0;
	const DRAFT = 1;
	const PUBLISH = 2;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
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
		return 'blog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, status, tag', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('user_id', 'length', 'max'=>10),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, created_on, updated_on, status, user_id', 'safe', 'on'=>'search'),
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
			'postComments' => array(self::HAS_MANY, 'PostComment', 'post_id'),
			'tags' => array(self::MANY_MANY, 'Tag', 'tag_has_post(post_id, tag_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'status' => 'Status',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('status',$this->status);
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
		),
		
		'CAdvancedArBehavior' => array(
            'class' => 'application.extensions.CAdvancedArBehavior')

	
		);
	}

	protected function afterValidate(){
		parent::afterValidate(); // This would give the application the chance to take over if something goes wrong.
		if(!$this->hasErrors()){
			
			$this->user_id = Yii::app()->user->id;
		}
	}

	public function getPostStatus(){		
		return array(self::DRAFT =>'Draft',self::ARCHIVE => 'Archive', self::PUBLISH => 'Publish');
	}

	public function getAllTags(){
		$tags = Tag::model()->findAll(); // Get all the tags
		$tagArray = CHtml::listData($tags,'id','tag');
		return $tagArray; // This would return all the tags. 

	}

}