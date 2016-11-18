<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 20.01.2016
 * Time: 23:29
 */

namespace app\modules\admin\controllers;


use app\models\Storage;
use app\modules\admin\components\AdminController;
use app\modules\admin\models\StorageForm;
use yii\web\BadRequestHttpException;

class StorageController extends AdminController
{
    public function actionIndex()
    {
        $model = new StorageForm();

        if($model->load(\Yii::$app->request->post()) && $model->validate())
        {
            $model->save();
            \Yii::$app->session->addFlash('admin.success','Данные сохранены');

            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $model,
            'records' => Storage::findAll(),
        ]);
    }

    public function actionDelete($key)
    {
        if(!\Yii::$app->request->isPost) throw new BadRequestHttpException('Only post here');

        Storage::delete($key);

        \Yii::$app->session->addFlash('admin.success','Запись удалена');

        return $this->redirect(['index']);
    }
}