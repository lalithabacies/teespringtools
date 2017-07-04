<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blogs_comments".
 *
 * @property integer $id
 * @property integer $blog_id
 * @property string $comments
 * @property string $createddate
 * @property integer $createdby
 * @property string $status
 */
class BlogsComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blogs_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_id', 'comments'], 'required'],
            [['blog_id', 'createdby'], 'integer'],
            [['comments'], 'string'],
            [['createddate'], 'safe'],
            [['status'], 'integer', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blog_id' => 'Blog ID',
            'comments' => 'Comments',
            'createddate' => 'Createddate',
            'createdby' => 'Createdby',
            'status' => 'Status',
        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDetails()
    {
        return $this->hasOne(UserProfile::className(), ['id' => 'createdby']);
    }
	
}
