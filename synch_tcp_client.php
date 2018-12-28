<?php
/**
 * 同步TCP客户端
 */

$client = new swoole_client(SWOOLE_SOCK_TCP);

//链接服务器
if(!$client->connect('127.0.0.1',9501,0.5)){
	die('connect failed');
}

//向服务器发送数据
if(!$client->send('hello word')){
	die('send failed');
}

$data = $client->recv();
if(!$data){
	die('recv failed');
}

echo $data;

//关闭链接
$client->close();


