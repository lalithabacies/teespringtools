<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tshirt_user_meta".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $meta_key
 * @property string $meta_values
 */
class TshirtUserMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tshirt_user_meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'meta_key', 'meta_values'], 'required'],
            [['userid'], 'integer'],
            [['meta_key', 'meta_values'], 'string', 'max' => 200],
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
            'meta_key' => 'Meta Key',
            'meta_values' => 'Meta Values',
        ];
    }
}
