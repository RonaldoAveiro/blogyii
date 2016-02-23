<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property string $roles_name
 * @property integer $roles_value
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roles_name', 'roles_value'], 'required'],
            [['roles_value'], 'integer'],
            [['roles_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'roles_name' => Yii::t('app', 'Roles Name'),
            'roles_value' => Yii::t('app', 'Roles Value'),
        ];
    }

    public function getRole()
    {
        return $this->hasOne(Role::className(), ['role_value' => 'role_id']);
    }

    public function getRoleName()
    {
        return $this->role ? $this->role->role_name : '- no role -';
    }

     /**
      * * get list of roles for dropdown
      * */

     public static function getRoleList()
    {
        $droptions = Role::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'role_value', 'role_name');
    }

    public function getUsers()
    {
      return $this->hasMany(User::className(), ['role_id' => 'role_value']);
    }
}
