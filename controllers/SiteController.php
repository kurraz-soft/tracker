<?php

namespace app\controllers;

use app\components\Controller;
use app\models\TrackerCategories;
use app\models\TrackerItems;
use Yii;
use app\models\ContactForm;
use yii\data\Pagination;
use yii\web\HttpException;


class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex($cat_id = null)
    {
        $pages = new Pagination();
        $pages->pageSize = 20;
        $category = null;

        $q = TrackerItems::find()->active();

        if($cat_id)
        {
            $category = TrackerCategories::findOne($cat_id);
            if(!$category) throw new HttpException(400);

            $q->andWhere(['category_id' => $cat_id]);

            $countQ = clone $q;
            $pages->totalCount = $countQ->count();

            $items = $q->limit($pages->limit)
                ->offset($pages->offset)
                ->orderBy(['date' => SORT_DESC])
                ->all();
        }else
        {
            $countQ = clone $q;
            $pages->totalCount = $countQ->count();

            $items = $q->limit($pages->limit)
                ->offset($pages->offset)
                ->orderBy(['date' => SORT_DESC])
                ->all();
        }

        return $this->render('index', [
            'items' => $items,
            'category' => $category,
            'pages' => $pages,
        ]);
    }
}
