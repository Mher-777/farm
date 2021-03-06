<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "paddock_chicken_items".
 *
 * @property integer $item_id
 * @property integer $user_id
 * @property integer $status_id
 * @property integer $level
 */
class PaddockChickenItems extends \yii\db\ActiveRecord
{
    const STATUS_NOT_AVAILABLE = 0;
    const STATUS_AVAILABLE = 1;
    const STATUS_READY= 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paddock_chicken_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status_id', 'level'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'user_id' => 'User ID',
            'status_id' => 'Status ID',
            'level' => 'Level',
        ];
    }
    public function getChicken_items()
    {
        return $this->hasOne(ChickenItems::className(),['paddock_id'=>'item_id']);
    }
}
