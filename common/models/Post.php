<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property integer $created_by
 * @property string $title
 * @property string $excerpt
 * @property string $body
 * @property string $category_id
 * @property integer $status
 * @property integer $comment_status
 * @property integer $comment_count
 * @property integer $views
 * @property string $publish_up
 * @property string $publish_down
 *
 * @property Comments[] $comments
 * @property Categories $category
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'category_id'], 'required'],
            [['id', 'created_by', 'category_id', 'status', 'comment_status', 'comment_count', 'views'], 'integer'],
            [['title', 'excerpt', 'body'], 'string'],
            [['publish_up', 'publish_down'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'title' => Yii::t('app', 'Title'),
            'excerpt' => Yii::t('app', 'Excerpt'),
            'body' => Yii::t('app', 'Body'),
            'category_id' => Yii::t('app', 'Category ID'),
            'status' => Yii::t('app', 'Status'),
            'comment_status' => Yii::t('app', 'Comment Status'),
            'comment_count' => Yii::t('app', 'Comment Count'),
            'views' => Yii::t('app', 'Views'),
            'publish_up' => Yii::t('app', 'Publish Up'),
            'publish_down' => Yii::t('app', 'Publish Down'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
