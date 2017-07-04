<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "retarget_domain".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $date
 */
class Domain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retarget_domain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'status'], 'required'],
            [['userid', 'status'], 'integer'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 220],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }
}
