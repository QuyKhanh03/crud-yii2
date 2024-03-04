<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image
 * @property int|null $price
 * @property string $created_at
 * @property string $deleted_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'integer'],
            [['created_at', 'deleted_at'], 'required'],
            [['created_at', 'deleted_at'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'price' => 'Price',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
        ];
    }
    public function getImageUrl()
    {
        return Yii::getAlias('@web') . '/uploads/' . $this->image;
    }


}
