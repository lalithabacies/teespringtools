<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tshirt_videos".
 *
 * @property integer $id
 * @property string $videotitle
 * @property string $emdedurl
 * @property string $createdon
 * @property integer $status
 */
class TshirtVideos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tshirt_videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdon'], 'safe'],
            [['status'], 'integer'],
            [['videotitle', 'emdedurl'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'videotitle' => 'Videotitle',
            'emdedurl' => 'Emdedurl',
            'createdon' => 'Createdon',
            'status' => 'Status',
        ];
    }
}
