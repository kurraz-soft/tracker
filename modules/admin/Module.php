<?php

namespace app\modules\admin;

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public $defaultRoute = 'dashboard/index';

    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'access' => [
                'class' => AccessControl::class,
                'rules' => require(__DIR__.'/access_rules.php'),
            ]
        ]);
    }
}
