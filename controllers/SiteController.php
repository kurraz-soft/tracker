<?php

namespace app\controllers;

use app\components\Controller;
use app\models\TrackerCategories;
use app\models\TrackerItems;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;


class SiteController extends Controller
{
    public $jsonld = [];

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

            $item_list = [];
            foreach ($items as $item)
            {
                $item_list[] = $item->name;
            }

            $this->jsonld = [
                '@context' => 'http://schema.org',
                '@type' => 'ItemList',
                'name' => $category->name,
                'image' => 'http://'. $_SERVER['SERVER_NAME'] . '/img/tracker_logo.png',
                'itemListElement' => $item_list,
            ];

        }else
        {
            $countQ = clone $q;
            $pages->totalCount = $countQ->count();

            $items = $q->limit($pages->limit)
                ->offset($pages->offset)
                ->orderBy(['date' => SORT_DESC])
                ->all();

            $item_list = [];
            foreach ($items as $item)
            {
                $item_list[] = $item->name;
            }

            $this->jsonld = [
                '@context' => 'http://schema.org',
                '@type' => 'ItemList',
                'name' => 'Latest',
                'image' => 'http://'. $_SERVER['SERVER_NAME'] . '/img/tracker_logo.png',
                'itemListElement' => $item_list,
            ];
        }

        return $this->render('index', [
            'items' => $items,
            'category' => $category,
            'pages' => $pages,
        ]);
    }

    public function actionSearch($q)
    {
        $pages = new Pagination();
        $pages->pageSize = 20;
        $category = null;

        $query = TrackerItems::find()->active()->andWhere(['like','name',$q]);


        $countQ = clone $query;
        $pages->totalCount = $countQ->count();

        $items = $query->limit($pages->limit)
            ->offset($pages->offset)
            ->orderBy(['date' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'items' => $items,
            'category' => $category,
            'pages' => $pages,
        ]);
    }

    public function actionSearchTypeahead($q)
    {
        return json_encode(TrackerItems::find()->limit(5)->active()->andWhere(['like','name',$q])->select('name AS value')->asArray()->all());
    }
}
