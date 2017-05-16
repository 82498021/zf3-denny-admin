<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/8
 * Time: 10:33
 */

namespace System\Helper;


class ArrayHelper
{
    /**
     * 字符转数组
     * @param $str
     * @param string $symbol
     * @return array
     */
    public static function stringToArray($str,$symbol=','){

        return explode($symbol,$str);
    }


}