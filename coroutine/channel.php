<?php
/**
 * 通道 channel
 */

$chan = new co\Channel(1);
//生产者
co::create(function() use ($chan){
	for ($i=0; $i < 100000 ; $i++) { 
		co::sleep(1.0);
		echo "$i:";
		$chan->push(['rand'=>rand(1000,9999),'index'=>$i]);
		
	}
});

//消费者
co::create(function() use ($chan){
	while (1) {
		$data = $chan->pop();
		print_r($data);
	}
});

/*
PHP5.4之前的版本没有在ZendAPI中加入注册shutdown函数。所以swoole无法在脚本结尾处自动进行事件轮询。所以低于5.4的版本，需要在你的PHP脚本结尾处加swoole_event_wait函数。使脚本开始进行事件轮询。
 */
swoole_event::wait();


