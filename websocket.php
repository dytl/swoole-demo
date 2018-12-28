<?php
/**
 * swoole websocket服务器
 */
$ws = new swoole_websocket_server('0.0.0.0',9501);

//监听链接打开事件
$ws->on('open',function($ws,$request){
	var_dump($request->fd,$request->get,$request->server);
	$ws->push($request->fd,"hello,welcome!\n");
});

//监听消息事件
$ws->on('message',function($ws,$frame){
	echo "message:{$frame->data}\n";
	$ws->push($frame->fd,"server:{$frame->data}");
});

//监听链接关闭事件
$ws->on('clone',function($ws,$fd){
	echo "client-{$fd} is closed\n";
});

$ws->start();
