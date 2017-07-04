<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "retarget_apps".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $domainid
 * @property string $appname
 * @property string $applink
 * @property string $appdetails
 * @property integer $status
 * @property string $date
 * @property string $modifydate
 */
class DomainApps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retarget_apps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'domainid', 'appname', 'applink', 'appdetails', 'status', 'modifydate'], 'required'],
            [['userid', 'domainid', 'status'], 'integer'],
            [['appname', 'applink', 'appdetails'], 'string'],
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
            'domainid' => 'Domainid',
            'appname' => 'Appname',
            'applink' => 'Applink',
            'appdetails' => 'Appdetails',
            'status' => 'Status',
            'date' => 'Date',
            'modifydate' => 'Modifydate',
        ];
    }
}
