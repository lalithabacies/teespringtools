<?php

namespace app\models;

use Yii;

use app\models\UserProfile;
use app\models\BlogsComments;

/**
 * This is the model class for table "blogs".
 *
 * @property integer $id
 * @property string $blogname
 * @property string $blogdescription
 * @property string $blogimage
 * @property string $createddate
 * @property integer $createdby
 * @property string $modifieddate
 * @property integer $modifiedby
 * @property string $status
 */
class Blogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blogs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blogname', 'blogdescription' ], 'required'],
			[['blogimage'], 'required','on' => ['create_blog']],
            [['blogname', 'blogdescription', 'blogimage'], 'string'],
            [['createddate', 'modifieddate'], 'safe'],
            [['createdby', 'modifiedby'], 'integer'],
            [['status'], 'string', 'max' => 10],
        ];
    }

	
	public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create_blog'] = ['blogname','blogdescription','blogimage','status' ];//Scenario Values Only Accepted
        return $scenarios;
    }
	
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blogname' => 'Blog Name',
            'blogdescription' => 'Blog Description',
            'blogimage' => 'Blog Image',
            'createddate' => 'Createddate',
            'createdby' => 'Createdby',
            'modifieddate' => 'Modifieddate',
            'modifiedby' => 'Modifiedby',
            'status' => 'Status',
        ];
    }
	
	public function uploadImage(){
			$this->blogimage->saveAs('uploads/blogimage/'.time().$this->blogimage->baseName.'.' .$this->blogimage->extension);
			$this->blogimage = 'uploads/blogimage/'.time().$this->blogimage->baseName.'.'.$this->blogimage->extension;
			return true;
	}
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDetails()
    {
        return $this->hasOne(UserProfile::className(), ['id' => 'createdby']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogsComments()
    {
        return $this->hasMany(BlogsComments::className(), ['blog_id' => 'id']);
    }
	
	
}
