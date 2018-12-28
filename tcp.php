<?php
/**
 * swoole tcp服务器
 */

$serv = new swoole_server("127.0.0.1",9501);

$serv->on('connect',function($serv,$fd){
	echo "Client:Connect.\n";
});

$serv->on('receive',function($serv,$fd,$from_id,$data){
	$serv->send($fd,"server: ".$data);
});

$serv->on('close',function($serv,$fd){
	echo "Client:clone.\n";
});

$serv->start();
