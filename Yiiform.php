<?php

namespace app\modules\yiiform\models;

use Yii;

/**
 * This is the model class for table "yiiform".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $gender
 * @property int $employee_number
 * @property string $website
 */
class Yiiform extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yiiform';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email','mobile_number','hobby', 'gender', 'employee_number', 'website','gender','DOB','textarea','country','state'],'required'],
            [['employee_number'], 'integer'],
			['name', 'unique'  ],
			['email', 'unique' ],
            [['name', 'email', 'gender', 'website','textarea'], 'string', 'max' => 255],
			[['mobile_number'],'integer','max'=>9999999999],
			
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'employee_number' => 'Employee Number',
            'website' => 'Website',
			'gender' => 'Gender',
			'textarea' => 'Text Area',
			'movies' => 'Movies',
			'image' => 'Image',
			'hobby' => 'Hobby',
			'country' => 'Country',
			'state' => 'State',
			'mobile_number'=>'Mobile_Number',
			'resume'=>'Resume',
        ];
    }
	
	public function upload() {
        if ($this->validate()) {
				$this->image->saveAs('../uploads/'  . $this->image->baseName . '.' .$this->image->extension);
				$this->resume->saveAs('../uploads/resume/'  . $this->resume->baseName . '.' .$this->resume->extension);
            return true;
         } else {
            return false;
         }
     }  



}
