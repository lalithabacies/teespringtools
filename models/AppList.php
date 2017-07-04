<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tshirt_app".
 *
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property string $description
 * @property string $image_link
 * @property string $created_date
 */
class AppList extends \yii\db\ActiveRecord
{
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tshirt_app';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'link', 'description'], 'required'],
			[['image_link'], 'required','on' => ['create_app']],
            [['link', 'description'], 'string'],
			[['image_link'], 'file','extensions' => 'jpg,png', 'skipOnEmpty' => true],
            [['created_date'], 'safe'],
		
            [['name'], 'string', 'max' => 150],
        ];
    }

	public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create_app'] = ['name','link','description','image_link' ];//Scenario Values Only Accepted
        return $scenarios;
    }
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'link' => 'Link',
            'description' => 'Description',
            'image_link' => 'Image Link',
            'created_date' => 'Created Date',
        ];	
    }
	
	public function uploadImage(){
			$this->image_link->saveAs('uploads/appimage/'.time().$this->image_link->baseName.'.' .$this->image_link->extension);
			$this->image_link = 'uploads/appimage/'.time().$this->image_link->baseName.'.'.$this->image_link->extension;
			return true;
	}
	
}
