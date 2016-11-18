<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 16.01.2016
 * Time: 21:33
 */

namespace app\modules\admin\components;

use app\components\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class AdminController extends Controller
{
    public $layout = 'main';

    /*
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'access' => [
                'class' => AccessControl::class,
                'rules' => require(__DIR__.'/../access_rules.php'),
            ]
        ]);
    }*/
}