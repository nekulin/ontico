<?php

/**
 * This is the model class for table "Likes".
 *
 * The followings are the available columns in table 'Likes':
 * @property string $id
 * @property string $like_id
 * @property string $liked_id
 *
 * The followings are the available model relations:
 * @property Students $liked
 * @property Students $like
 */
class Likes extends CActiveRecord
{

    /**
     * @var Students
     */
    private $_student;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Likes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('like_id, liked_id', 'required'),
			array('like_id, liked_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, like_id, liked_id', 'safe', 'on'=>'search'),
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
			'liked' => array(self::BELONGS_TO, 'Students', 'liked_id'),
			'like' => array(self::BELONGS_TO, 'Students', 'like_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'like_id' => 'Like',
			'liked_id' => 'Liked',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('like_id',$this->like_id,true);
		$criteria->compare('liked_id',$this->liked_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Likes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getLikeStudent() {
        if (is_null($this->_student)) {
            $this->_student = Students::model()->findByPk($this->like_id);
        }
    }
}
