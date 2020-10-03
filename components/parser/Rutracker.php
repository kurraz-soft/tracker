<?php
/**
 * Created by PhpStorm.
 * User: Kurraz
 * Date: 18.11.2016
 * Time: 12:52
 */

namespace app\components\parser;

use app\components\Curl;
use yii\base\ErrorException;

require_once(__DIR__.'/../phpQuery.php');

class Rutracker
{
    const LOGIN_URL = 'https://rutracker.org/forum/login.php';
    const TRACKER_URL = 'https://rutracker.org/forum/tracker.php';

    public function cookieFile()
    {
        return __DIR__ . '/../../web/upload/cookie.txt';
    }

    public function login($login, $pass)
    {
        $curl = new Curl();
        $curl->url(self::LOGIN_URL)->post([
            'login_username' => $login,
            'login_password' => $pass,
            'login' => 'вход',
        ])
            ->cookieFile($this->cookieFile())
            ->cookie($this->cookieFile())
            ->execute();

        if(strpos(iconv('cp1251','UTF-8',$curl->result),$login) === false) throw new ErrorException("Can't login");
    }

    public function crawlerCategory($cat_id, $pages = 1)
    {
        /**
         * @var \phpQueryObject $doc
         */
        $doc = null;

        $data = $this->_parseCrawlerUrl(self::TRACKER_URL.'?f='.$cat_id, false, $doc);

        $href = $doc->find('.pg:first')->attr('href');

        $doc->unloadDocument();

        $matches = [];
        if(preg_match('#tracker\.php\?search_id=(.+)&#',$href,$matches))
        {
            $search_id = $matches[1];
            for($i = 1; $i < $pages; $i++)
            {
                $url = self::TRACKER_URL.'?search_id='.$search_id.'&start='.$i*50;
                $data = array_merge($data, $this->_parseCrawlerUrl($url));
            }
        }

        return $data;
    }

    private function _parseCrawlerUrl($url, $unload = true, &$doc = null)
    {
        $curl = new Curl();
        $curl->cookieFile($this->cookieFile())->cookie($this->cookieFile())->ignoreSsl();

        $curl->url($url)->execute();

        $doc = \phpQuery::newDocument(iconv('cp1251','UTF-8',$curl->result));

        $data = [];
        $rows = $doc->find('.tCenter.hl-tr');
        foreach ($rows as $row)
        {
            $data[] = [
                'name' => trim(pq($row)->find('.row4 .t-title')->text()),
                'url' => 'https://rutracker.org/forum/' . trim(pq($row)->find('.row4 .t-title a')->attr('href')),
                'timestamp' => pq($row)->find('.row4.small.nowrap[data-ts_text]:not(.tor-size)')->attr('data-ts_text'),
            ];
        }

        if($unload) $doc->unloadDocument();

        return $data;
    }

    public function spider($url)
    {
        $curl = new Curl();
        //$curl->cookieFile($this->cookieFile())->cookie($this->cookieFile());

        $curl->url($url)->execute();

        $doc = \phpQuery::newDocument($curl->result);

        $img_src = $doc->find('.post_body .postImg.postImgAligned')->attr('title');

        $data = [
            'image_src' => $img_src,
            'magnet_link' => $doc->find('.attach_link.guest a')->attr('href'),
        ];

        return $data;
    }
}