<?php
/**
 * 异步TCP客户端
 */

$client = new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC);

//注册链接成功回调
$client->on('connect',function($cli){
	$cli->send("hello world\n");
});

//注册数据接受回调
$client->on('receive',funciton($cli,$data){
	echo 'receive data';
});

//注册链接失败回调
$client->on('error',function($cli){
	echo "Received: ".$data."\n";
});

//注册链接关闭回调
$client->on('close',function($cli){
	echo 'connect close'.PHP_EOL;
});

//发起链接
$client->connect('127.0.0.1',9501,0.5);

