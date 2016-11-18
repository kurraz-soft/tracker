<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 16.01.2016
 * Time: 22:11
 */

namespace app\commands;


use app\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    /**
     * Creates new user
     *
     * @param string $login
     * @param string $password
     * @param string|null $name
     * @throws \ErrorException
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionNew($login, $password, $name = null)
    {
        if(!$name) $name = $login;

        $user = new User();
        $user->login = $login;
        $user->changePassword($password);
        $user->name = $name;
        if(!$user->save())
        {
            throw new \ErrorException($user->errors);
        }

        echo "Done!\n";
    }
}