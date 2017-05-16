<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 2017/5/8
 * Time: 10:14
 */

namespace System\Helper;


class StringHelper
{
    /**
     * 数组转字符
     * @param $arr
     * @param $symbol
     * @return string
     */
    public static function arrayToString($arr,$symbol=','){

        if(empty($arr))
            return null;

        return implode($symbol,$arr);
    }




}