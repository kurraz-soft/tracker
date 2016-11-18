<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 18.11.2016
 * Time: 13:07
 */

namespace app\commands;


use app\components\parser\Rutracker;
use app\models\TrackerCategories;
use app\models\TrackerItems;
use yii\base\ErrorException;
use yii\console\Controller;
use yii\helpers\VarDumper;

class ParserController extends Controller
{
    public function actionCrawler()
    {
        $parser = new Rutracker();
        $parser->login('shounen123qwe','123qwe');

        $items = $parser->crawlerCategory(2366); //Зарубежные сериалы

        $cnt = $this->saveCrawlerItems($items,1);

        sleep(5);

        $items = $parser->crawlerCategory(635); //Игры
        $cnt += $this->saveCrawlerItems($items,2);

        echo "DONE. {$cnt} processed\n";
    }

    public function saveCrawlerItems($items, $cat_id)
    {
        /**
         * @var TrackerCategories $cat
         */
        $cat = TrackerCategories::findOne($cat_id);
        $cnt = 0;
        foreach ($items as $item) {
            /**
             * @var TrackerItems $model
             */
            $model = TrackerItems::find()->where(['url' => $item['url']])->one();
            if(!$model)
            {
                $model = new TrackerItems();
                $model->category_id = $cat->id;
                $model->url = $item['url'];
            }elseif(strtotime($model->date) == $item['timestamp'])
            {
                //Nothing changed, skip
                continue;
            }
            $cnt++;
            $model->name = $item['name'];
            $model->date = date('Y-m-d H:i:s', $item['timestamp']);
            $model->spider_processed = 0;
            if(!$model->save()) throw new ErrorException(VarDumper::dumpAsString($model->errors));
        }

        return $cnt;
    }

    public function actionSpider()
    {
        $parser = new Rutracker();
        //$parser->login('shounen123qwe','123qwe');

        $cnt = 0;
        foreach(TrackerItems::find()->where(['spider_processed' => 0])->limit(25)->each() as $item)
        {
            /**
             * @var TrackerItems $item
             */
            $item->spider_processed = true;
            $data = $parser->spider($item->url);
            $item->image_src = $data['image_src'];
            $item->magnet_link = $data['magnet_link'];
            if(!$item->save()) throw new ErrorException(VarDumper::dumpAsString($item->errors));
            $cnt++;
        }

        echo "DONE. {$cnt} processed\n";
    }
}