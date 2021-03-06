<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $id
 * @property string $title
 * @property string $description
 */
class Page extends CActiveRecord
{
	public $title;
	public $description;
	public $isactive;
	public $createdon;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
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
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>255),
			array('description', 'safe'),
			//array('title','unique'),
			array('title','checkTitle'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,title, description', 'safe', 'on'=>'search'),
		);
	}
	
	public function checkTitle($attribute,$params)
	{
		if (Page::model()->exists(
			array(
			      'condition'=>'title=:title AND isdeleted=:isdeleted',
			      'params'=>array(':title'=>$this->title,':isdeleted'=>'no'),
			      ))
				)
		{
			$this->addError('title','Page Title already used');
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
			'description' => 'Description',
			'isactive' => 'Isactive',
			'createdon' => 'Createdon',
			'updatedon' => 'Updatedon',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('isactive',$this->isactive,true);
        $criteria->compare('isdeleted','no',false);

		// For showing the Default Sort Icon need to replace file for yiiframework/web/CSort.php
        return new CActiveDataProvider($this, array(
                    'sort'=>array(
                        'defaultOrder'=>'title ASC',
                    ),
                    'pagination'=>array(
                        'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                    ),
                    
		    'criteria'=>$criteria,
		));
	}
}