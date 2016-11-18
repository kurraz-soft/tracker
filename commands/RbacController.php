<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 20.01.2016
 * Time: 20:25
 */

namespace app\commands;


use app\models\User;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        $auth->removeAll();

        /*
        // add "adminAccess" permission
        $adminAccess = $auth->createPermission(User::RULE_ADMIN_ACCESS);
        $adminAccess->description = 'Access to admin panel';
        $auth->add($adminAccess);

        $usersAccess = $auth->createPermission(User::PERM_USER_ACCESS);
        $usersAccess->description = 'Can modify users';
        $auth->add($usersAccess);
        */

        $manager = $auth->createRole(User::ROLE_MANAGER);
        $auth->add($manager);
        //$auth->addChild($manager, $adminAccess);

        // add "admin" role and give this role the "adminAccess" permission
        $admin = $auth->createRole(User::ROLE_ADMIN);
        $auth->add($admin);
        //$auth->addChild($admin, $usersAccess);
        $auth->addChild($admin, $manager);

        $auth->assign($admin,1);
    }
}