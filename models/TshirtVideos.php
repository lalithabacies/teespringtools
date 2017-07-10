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
            [['videotitle'], 'string', 'max' => 150],
            [[ 'emdedurl'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'videotitle' => 'Video Title',
            'emdedurl' => 'Embed Url',
            'createdon' => 'Created on',
            'status' => 'Status',
        ];
    }
}
