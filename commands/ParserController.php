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
        $parser->login(getenv('RUTRACKER_LOGIN'),getenv('RUTRACKER_PASS'));

        $items = $parser->crawlerCategory(2366); //Зарубежные сериалы

        $cnt = $this->saveCrawlerItems($items,1);

        sleep(5);

        $items = $parser->crawlerCategory(842); //Новинки и сериалы в стадии показа

        $cnt += $this->saveCrawlerItems($items,1);

        sleep(5);

        $items = $parser->crawlerCategory(635); //Игры
        $cnt += $this->saveCrawlerItems($items,2);

        sleep(5);

        $items = $parser->crawlerCategory(921); //Мультсериалы
        $cnt += $this->saveCrawlerItems($items,3);

        sleep(5);

        $items = $parser->crawlerCategory(1389); //Аниме
        $cnt += $this->saveCrawlerItems($items,4);

        sleep(5);

        $items = $parser->crawlerCategory(1605); //Игры switch
        $cnt += $this->saveCrawlerItems($items,5);

        sleep(5);

        $items = $parser->crawlerSearch('vr only'); //Игры VR
        $cnt += $this->saveCrawlerItems($items,6);

        echo "DONE. {$cnt} processed\n";
    }

    public function actionParseGames()
    {
        $parser = new Rutracker();
        $items = $parser->crawlerCategory(52,10);
        $this->saveCrawlerItems($items,2);

        sleep(5);

        while($this->actionSpider()) {sleep(5);}
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

    public function actionSpider($limit = 50)
    {
        $parser = new Rutracker();
        //$parser->login('shounen123qwe','123qwe');

        $cnt = 0;
        foreach(TrackerItems::find()->where(['spider_processed' => 0])->limit($limit)->each() as $item)
        {
            /**
             * @var TrackerItems $item
             */
            $item->spider_processed = 1;
            $data = $parser->spider($item->url);
            $item->image_src = $data['image_src'];
            $item->magnet_link = $data['magnet_link'];
            if(!$item->save()) throw new ErrorException(VarDumper::dumpAsString($item->errors));
            $cnt++;
        }

        echo "DONE. {$cnt} processed\n";

        return $cnt;
    }
}