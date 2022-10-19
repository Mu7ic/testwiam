<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vote_images".
 *
 * @property int $id
 * @property int $id_image
 * @property string $url_image
 * @property bool|null $vote
 */
class VoteImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vote_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_image', 'url_image'], 'required'],
            [['id_image'], 'default', 'value' => null],
            [['id_image'], 'integer'],
            [['vote'], 'boolean'],
            [['url_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_image' => 'Id Image',
            'url_image' => 'Url Image',
            'vote' => 'Vote',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
