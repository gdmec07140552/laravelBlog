<?php

function redis()
{
    //实例化Redis类
    $redis = new Redis();
    //链接Redis数据库
    $redis->connect('127.0.0.1', 6379);
    //Redis数据库密码登录
    $redis->auth('kansz');
    //选择数据库1
    $redis->select(1);
    return $redis;
}