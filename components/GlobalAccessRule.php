<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 21.01.2016
 * Time: 18:54
 */

namespace app\components;


use yii\filters\AccessRule;

class GlobalAccessRule extends AccessRule
{
    public $roles_only = [];

    public function allows($action, $user, $request)
    {
        $parent = parent::allows($action, $user, $request);

        if(!$parent) return $parent;

        if(empty($this->roles_only)) return true;

        $this->roles = $this->roles_only;
        return $this->matchRole($user);
    }
}