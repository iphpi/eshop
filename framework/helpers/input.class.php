<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/28
 * Time: 20:33
 */
//批量实体转义
function deepspecialchars($data){
    if(empty($data)){
        return $data;
    }
    return is_array($data) ? array_map('deepspecialchars',$data) : htmlspecialchars($data);
}