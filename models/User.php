<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property string $password_hash
 * @property array $roles
 * @property array $rolesLabels
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';

    public $password;
    public $_roles;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login','name'], 'required'],
            [['password'], 'required', 'on' => 'create'],
            [['password'], 'string', 'min' => 6, 'max' => 255],
            [['name', 'login'], 'string', 'max' => 255],
            [['roles'],'safe'],
        ];
    }

    public function changePassword($val)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($val);
    }

    static public function rolesLabels()
    {
        return [
            self::ROLE_MANAGER => 'Менеджер',
            self::ROLE_ADMIN => 'Администратор',
        ];
    }

    public function getRolesLabels()
    {
        $ret = [];

        $roles = $this->getRoles();

        foreach($roles as $role)
        {
            $ret[] = static::rolesLabels()[$role];
        }

        return $ret;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'login' => 'Login',
            'password' => 'Password',
            'roles' => 'Роль'
        ];
    }

    static public function findByUsername($username)
    {
        return static::find()->where(['login' => $username])->one();
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return Yii::$app->security->generatePasswordHash($this->login);
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }

    public function validatePassword($pass)
    {
        return Yii::$app->security->validatePassword($pass,$this->password_hash);
    }

    public function setRoles($val)
    {
        $this->_roles = $val;
    }

    public function getRoles()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser($this->id);

        $roles_str = [];

        foreach($roles as $role)
        {
            $roles_str[] = $role->name;
        }

        return $roles_str;
    }

    public function init()
    {
        parent::init();

        $this->on(static::EVENT_BEFORE_INSERT,function(){
            $this->changePassword($this->password);
        });
        $this->on(static::EVENT_BEFORE_UPDATE, function(){
            if(!empty($this->password))
                $this->changePassword($this->password);
        });
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $auth = Yii::$app->authManager;
        $auth->revokeAll($this->id);

        foreach($this->_roles as $role)
        {
            $auth->assign($auth->getRole($role),$this->id);
        }
    }
}
