<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "sell".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $creation_date
 *
 * @property User $user
 */
class Sell extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','transactionid','delivery_id','billing_id'], 'integer'],
            [['creation_date','user_id','transactionid','delivery_id','billing_id'], 'required'],
            ['status', 'in', 'range' => ['COMPLETE','INCOMPLETE']],
            [['creation_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
             public function getProducts()
    {
        return $this->hasMany(Product::className(),['id' => 'product_id'])->viaTable('detail',['sell_id' => 'id']);
    } 
        public function getDetails()
    {
        return $this->hasMany(Detail::className(), ['sell_id' => 'id']);
    }

}
