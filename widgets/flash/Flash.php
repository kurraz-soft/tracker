<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 18.01.2016
 * Time: 14:08
 */

namespace app\widgets\flash;

use yii\base\Widget;

class Flash extends Widget
{
    const TYPE_NOTIFICATION = 1;
    const TYPE_ALERT = 2;

    public $var = 'admin.success';
    public $type = self::TYPE_NOTIFICATION;

    public function run()
    {
        if(!\Yii::$app->session->hasFlash($this->var)) return null;

        return $this->render($this->type == self::TYPE_NOTIFICATION?'notification':'alert', [
            'var' => $this->var,
            'message' => is_array(\Yii::$app->session->getFlash($this->var))?\Yii::$app->session->getFlash($this->var)[0]:\Yii::$app->session->getFlash($this->var),
        ]);
    }
}