<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 14:04
 */
if(function_exists('getRandCode')){
    /**
     * 生成随机数
     * @param $len int 长度
     * @param int $type 类型 1 数字 2 字母 3 数字+字母
     * @return string
     */
    function getRandCode($len, $type = 1) {
        srand((double)microtime() * 1000000);//create a random number feed.
        $arr = array();
        $number = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        if ($type == 1) {
            $arr = array_merge($arr, $number);
        } elseif ($type == 2) {
            $arr = array_merge($arr, $_code);
        } elseif ($type == 3) {
            $arr = array_merge($arr, $number, $_code);
        }
        $arr_len = count($arr);
        $authnum = '';
        for ($i = 0; $i < $len; $i++) {
            $randnum = rand(0, $arr_len - 1); // 10+26;
            $authnum .= $arr[$randnum];
        }
        return $authnum;
    }
}

