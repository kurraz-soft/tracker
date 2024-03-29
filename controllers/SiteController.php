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


            $this->jsonld = [
                '@context' => 'http://schema.org',
                '@type' => 'Thing',
                'name' => $category->name,
                'image' => 'http://'. $_SERVER['SERVER_NAME'] . '/img/tracker_logo.png',
            ];

        }else
        {
            $countQ = clone $q;
            $pages->totalCount = $countQ->count();

            $items = $q->limit($pages->limit)
                ->offset($pages->offset)
                ->orderBy(['date' => SORT_DESC])
                ->all();

            $this->jsonld = [
                '@context' => 'http://schema.org',
                '@type' => 'Thing',
                'name' => 'Latest',
                'image' => 'http://'. $_SERVER['SERVER_NAME'] . '/img/tracker_logo.png',
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
        return json_encode(
            TrackerItems::find()
                ->limit(5)
                ->active()
                ->andWhere(['like','name',$q])
                ->select('name AS value')
                ->orderBy(['date' => SORT_DESC])
                ->asArray()
                ->all()
        );
    }

    public function actionTest($action)
    {
        $cache = \Yii::$app->cache;

        switch ($action)
        {
            case 'save':
                $cache->set('a', 'abc');
                die('saved');
                break;
            case 'load':
                var_dump($cache->get('a'));
                die('loaded');
                break;
        }
    }
}
