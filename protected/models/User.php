<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $name
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property string $about
 * @property string $created_on
 * @property string $updated_on
 * @property string $ip
 * @property integer $active
 * @property integer $power
 * @property integer $ban
 * @property string $sec_ques
 * @property string $answer
 * @property string $course
 * @property string $profilepic
 * @property string $thumbnail
 * @property string $email
 *
 * The followings are the available model relations:
 * @property BugFeature[] $bugFeatures
 * @property Comment[] $comments
 * @property Complaint[] $complaints
 * @property Feedback[] $feedbacks
 * @property Money[] $moneys
 * @property Post[] $posts
 * @property Report[] $reports
 * @property Resource[] $resources
 * @property Status[] $statuses
 * @property StatusComment[] $statusComments
 * @property Todo[] $todos
 * @property Module[] $modules
 */

class User extends CActiveRecord
{

	// This is the password repeat attribute.
	
	public $password_repeat;

	/**
	* This is the attribute holding the uploaded picture
	* @var CUploadedFile
	*/

	public $picture;


	// Defining the user powers
	const USER_MEMBER = 0;
	const USER_MODERATOR = 1;
	const USER_ADMIN = 2;

	//Defining the Active and tagged status
	const USER_CLEAN = 0;
	const USER_TAGGED = 1;
	const USER_BANNED = 2;

	//Defining the if the user has been activated via Email
	const USER_ACTIVE = 1;
	const USER_INACTIVE = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, username, password,  email, course, password_repeat', 'required'),
			array('password','compare'),
			array('active, power, ban', 'numerical', 'integerOnly'=>true),
			array('email','email'), // Validation for the Email
			array('username, email','unique'), // The email and the username has to be unique.
			array('name, lastname, username, password, ip, sec_ques, answer, course', 'length', 'max'=>45),
			array('profilepic, thumbnail', 'length', 'max'=>255),
			array('email', 'length', 'max'=>100),
			array('about, created_on, updated_on', 'safe'),
			// Below are the rules defined for the picture upload
			array('picture', 'length', 'max' => 255, 'tooLong' => '{attribute} is too long (max {max} chars).', 'on' => 'upload'),
    		array('picture', 'file', 'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!', 'on' => 'upload'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, lastname, username, password, about, created_on, updated_on, ip, active, power, ban, sec_ques, answer, course, profilepic, thumbnail, email', 'safe', 'on'=>'search'),
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
			'bugFeatures' => array(self::HAS_MANY, 'BugFeature', 'user_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
			'complaints' => array(self::HAS_MANY, 'Complaint', 'user_id'),
			'feedbacks' => array(self::HAS_MANY, 'Feedback', 'user_id'),
			'moneys' => array(self::HAS_MANY, 'Money', 'user_id'),
			'posts' => array(self::HAS_MANY, 'Post', 'user_id'),
			'reports' => array(self::HAS_MANY, 'Report', 'user_id'),
			'resources' => array(self::HAS_MANY, 'Resource', 'user_id'),
			'status' => array(self::HAS_MANY, 'Status', 'user_id'),
			'statusComments' => array(self::HAS_MANY, 'StatusComment', 'user_id'),
			'todos' => array(self::HAS_MANY, 'Todo', 'user_id'),
			'modules' => array(self::MANY_MANY, 'Module', 'user_has_module(user_id, module_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'lastname' => 'Lastname',
			'username' => 'Username',
			'password' => 'Password',
			'about' => 'About',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'ip' => 'Ip',
			'active' => 'Active',
			'power' => 'Power',
			'ban' => 'Ban',
			'sec_ques' => 'Sec Ques',
			'answer' => 'Answer',
			'course' => 'Course',
			'profilepic' => 'Profilepic',
			'thumbnail' => 'Thumbnail',
			'email' => 'Email',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('power',$this->power);
		$criteria->compare('ban',$this->ban);
		$criteria->compare('sec_ques',$this->sec_ques,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('course',$this->course,true);
		$criteria->compare('profilepic',$this->profilepic,true);
		$criteria->compare('thumbnail',$this->thumbnail,true);
		$criteria->compare('email',$this->email,true);

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
			$this->password = md5($this->password); // This would save the md5 of the user
			// These are the default values that would be given to the user by default
			$this->power = self::USER_MEMBER; // This has to be changed in the DB
			$this->active = self::USER_INACTIVE; // The user can activate the account via email
			$this->ban = self::USER_ACTIVE; // The tagging and the banning of the user takes place in the logic of the application.
			
		}
	}

	public function validatePassword($password){
		return md5($password) === $this->password;
	}

	public function getActiveState(){
		return array(self::USER_ACTIVE=>'Active',self::USER_INACTIVE=>'Inactive');
	}

	public function getUserPower(){
		return array(self::USER_MEMBER=>'Member',self::USER_MODERATOR=>'Moderator',self::USER_ADMIN=>'Admin');
	}

	public function getBannedStatus(){
		return array(self::USER_CLEAN=>'Clean',self::USER_TAGGED=>'Tagged',self::USER_BANNED=>'Banned');
	}

}