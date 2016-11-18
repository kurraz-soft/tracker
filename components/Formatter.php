<?php
/**
 * Created by
 * User: Kurraz
 * Date: 19.01.2015
 */

namespace app\components;


class Formatter
{
    static public function money($m)
    {
        $str = '';

        $m = floatval($m);

        $v = $m * 10000;

        $g = floor($v / 10000);
        $v  = ($v - $g * 10000);
        $sil = floor($v / 100);
        $v -= $sil * 100;
        $copper = $v;

        if($g > 0)
        {
            $str .= number_format((int)$g,0,'.',' ') . ' <span class="coin-g">G</span> ';
        }
        if($sil > 0)
        {
            $str .= $sil . ' <span class="coin-s">S</span> ';
        }
        if($copper > 0 || $m == 0)
        {
            $str .= floor($copper) . ' <span class="coin-c">C</span> ';
        }

        return $str;
    }

    static public function getNewDateInterval($str_date)
    {
        $date = new \DateTime($str_date);
        $diff = $date->diff(new \DateTime(\Yii::$app->user->identity->cur_date));
        return $diff->days;
    }

    static public function date($d)
    {
        return self::formatData($d);
    }

    static function formatData($date)
    {

        $day = self::getDateCountDay($date,date('d.m.Y'),'d.m.Y');

        $date = date('H:i',strtotime($date));
        if($day == 0)
        {
            return 'Сегодня в '.$date;
        }
        elseif($day == 1)
        {
            return 'Вчера в '.$date;
        }
        elseif($day == -1)
        {
            return 'Завтра в'.$date;
        }
        elseif($day < -1)
        {
            return 'через '.abs($day).' '.self::get_date($day,'день','дней','дня');
        }
        elseif($day > 1)
        {
            return $day.' '.self::get_date($day,'день','дней','дня').' назад';
        }
        return '';
    }

    static function getDateCountDay($date1,$date2 ='',$format='d.m.Y')
    {

        if(empty($date2))
        {
            $date2 = date($format);
        }
        $date1 = date($format,strtotime($date1));
        $date2 = date($format,strtotime($date2));


        $datetime1 = date_create($date1);
        $datetime2 = date_create($date2);
        $interval = date_diff($datetime1, $datetime2);
        return intval($interval->format('%R%a'));
    }

    static public function get_date($date,$first,$second,$third){
        if((($date % 10) > 4 && ($date % 10) < 10) || ($date > 10 && $date < 20)){
            return $second;
        }
        if(($date % 10) > 1 && ($date % 10) < 5){
            return $third;
        }
        if(($date%10) == 1){
            return $first;
        }
        else{
            return $second;
        }
    }
} 