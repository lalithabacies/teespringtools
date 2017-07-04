<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "retarget_map".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $appid
 * @property string $mapname
 * @property string $maplink
 * @property string $mapdetails
 * @property integer $status
 * @property string $date
 * @property string $modifydate
 */
class DomainMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retarget_map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'appid', 'mapname', 'maplink', 'mapdetails', 'status', 'modifydate'], 'required'],
            [['userid', 'appid', 'status'], 'integer'],
            [['mapname', 'maplink', 'mapdetails'], 'string'],
            [['date', 'modifydate'], 'safe'],
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
            'appid' => 'Appid',
            'mapname' => 'Mapname',
            'maplink' => 'Maplink',
            'mapdetails' => 'Mapdetails',
            'status' => 'Status',
            'date' => 'Date',
            'modifydate' => 'Modifydate',
        ];
    }
}
