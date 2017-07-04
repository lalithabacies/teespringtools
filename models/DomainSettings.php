<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "retarget_settings".
 *
 * @property integer $id
 * @property string $userid
 * @property string $skey
 * @property string $sval
 */
class DomainSettings extends \yii\db\ActiveRecord
{
	public $publicdomainNameLinkId;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retarget_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'skey', 'sval'], 'required'],
            [['sval'], 'string'],
            [['userid'], 'string', 'max' => 11],
            [['skey'], 'string', 'max' => 220],
            [['publicdomainNameLinkId'], 'safe'],
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
            'skey' => 'Skey',
            'sval' => 'Sval',
            'publicdomainNameLinkId' => 'Access Level',
        ];
    }
}
