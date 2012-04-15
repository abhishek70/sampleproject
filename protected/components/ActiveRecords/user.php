<?php
/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $isactive
 * @property string $createdon
 * @property string $updatedon
 */
class User extends CActiveRecord
{
	
	public $firstname;
	public $lastname;
	public $username;
	public $password;
	public $confirmpassword;
	public $email;
	public $isactive;
	public $createdon;
	
	public function rules()
	{
		return array(
			array('username, password, email, firstname, lastname', 'required'),
			array('username, password, email, firstname, lastname', 'length', 'max'=>255),
			array('username, password, confirmpassword, firstname, lastname, email', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, firstname, lastname, isactive,', 'safe', 'on'=>'search'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'isactive' => 'Isactive',
			'createdon' => 'Createdon',
			'updatedon' => 'Updatedon',
		);
	}

	public static function model($className=__CLASS__)
	{
	    return parent::model($className);
	}
	
	public function tableName()
	{
	    return 'user';
	}
	
	public function primaryKey()
	{
	    return 'id';
	}
	
	public function relations()
 	{
 		 return array( 
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

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('isactive',$this->isactive,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
?>