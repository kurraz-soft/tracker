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
    const LOGIN_URL = 'http://rutracker.org/forum/login.php';
    const TRACKER_URL = 'http://rutracker.org/forum/tracker.php';

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

        if(strpos(iconv('cp1251','UTF-8',$curl->result),'Вы зашли как') === false) throw new ErrorException("Can't login");
    }

    public function crawlerCategory($cat_id)
    {
        $curl = new Curl();
        $curl->cookieFile($this->cookieFile())->cookie($this->cookieFile());

        $curl->url(self::TRACKER_URL.'?f='.$cat_id)->execute();

        $doc = \phpQuery::newDocument(iconv('cp1251','UTF-8',$curl->result));

        $data = [];
        $rows = $doc->find('.tCenter.hl-tr');
        foreach ($rows as $row)
        {
            $data[] = [
                'name' => trim(pq($row)->find('.row4.t-title')->text()),
                'url' => 'http://rutracker.org/forum/' . trim(pq($row)->find('.row4.t-title a')->attr('href')),
                'timestamp' => trim(pq($row)->find('.row4.small.nowrap:not(.tor-size) u')->text()),
            ];
        }

        return $data;
    }

    public function spider($url)
    {
        $curl = new Curl();
        //$curl->cookieFile($this->cookieFile())->cookie($this->cookieFile());

        $curl->url($url)->execute();

        $doc = \phpQuery::newDocument($curl->result);

        $img_src = $doc->find('.post_body .postImg.postImgAligned.img-right')->attr('title');

        $data = [
            'image_src' => $img_src,
            'magnet_link' => $doc->find('.attach_link.guest a')->attr('href'),
        ];

        return $data;
    }
}