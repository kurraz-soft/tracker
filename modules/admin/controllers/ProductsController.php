<?php

namespace app\modules\admin\controllers;

use app\models\ProductImages;
use Yii;
use app\models\Products;
use app\modules\admin\models\ProductsSearch;
use app\modules\admin\components\AdminController;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\validators\ImageValidator;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends AdminController
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->addFlash('admin.success', 'Запись добавлена');
            //return $this->redirect(['view', 'id' => $model->id]);
            if(Yii::$app->request->post('submit-btn') == 'apply')
            {
                return $this->redirect(['update','id' => $model->id, '#' => Yii::$app->request->post('hash')]);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->addFlash('admin.success', 'Запись обновлена');
            if(Yii::$app->request->post('submit-btn') == 'apply')
            {
                return $this->redirect(['update','id' => $model->id, '#' => Yii::$app->request->post('hash')]);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetGallery($parent_id,$tmp_id)
    {
        if($parent_id)
        {
            return $this->renderPartial('_gallery',[
                'images' => ProductImages::find()->where(['product_id' => $parent_id])->all(),
            ]);
        }else{
            return $this->renderPartial('_gallery',[
                'images' => ProductImages::find()->where(['tmp_id' => $tmp_id, 'product_id' => null])->all(),
            ]);
        }
    }

    public function actionUploadImages()
    {
        if(!\Yii::$app->request->isPost) throw new BadRequestHttpException('Only POST here');

        $parent_id = \Yii::$app->request->post('parent_id');

        $tmp_id = \Yii::$app->request->post('tmp_id');

        $files = UploadedFile::getInstancesByName('file');

        $error = '';
        try
        {
            foreach($files as $file)
            {
                $v = new ImageValidator();

                if(!$v->validate($file))
                {
                    throw new BadRequestHttpException('Only Images allowed');
                }

                $file->name = uniqid() . '.' . $file->extension;

                $img = new ProductImages();
                $img->product_id = $parent_id?$parent_id:null;
                $img->tmp_id = $tmp_id;
                $img->sort = ProductImages::getLastSort($parent_id,$tmp_id) + 1;

                if(!$file->saveAs(\Yii::getAlias($img->uploadPath).'/'.$file->name))
                {
                    throw new \ErrorException("Can't save file");
                }

                $img->file = $file->name;

                $img->save();
            }
        }catch (\Exception $e)
        {
            $error = $e->getMessage();
        }

        return Json::encode(['error' => $error,'files_uploaded' => count($files)]);
    }

    public function actionImageDelete($id)
    {
        /**
         * @var ProductImages $m
         */
        $m = ProductImages::findOne($id);

        if(!$m) throw new BadRequestHttpException('Record not found');

        $product_id = $m->product_id;
        $tmp_id = $m->tmp_id;

        $m->delete();

        return $this->actionGetGallery($product_id, $tmp_id);
    }

    public function actionImageSort()
    {

    }
}
