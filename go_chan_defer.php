<?php
/**
 * 协程：go + chan + defer
 */

//== GO
//Swoole\Runtime::enableCoroutine()作用是将PHP提供的stream、sleep、pdo、mysqli、redis等功能从同步阻塞切换为协程的异步IO
// Swoole\Runtime::enableCoroutine();

// go(function(){
// 	sleep(1);
// 	echo 'hello ';
// });

// go(function(){
// 	sleep(2);
// 	echo 'world';
// });



//== CHAN
//协程通信
// $chan = new chan(2);

// //协程1
// go(function() use ($chan){
// 	$result = [];
// 	for ($i=0; $i < 2; $i++) { 
// 		$result += $chan->pop();
// 	}
// 	var_dump($result);
// });

// //协程2
// go(function() use ($chan) {
// 	$cli = new Swoole\Coroutine\Http\Client('www.qq.com',80);
// 	$cli->set(['timeout'=>10]);
// 	$cli->setHeaders([
// 		'Host' => "www.qq.com",
//        	"User-Agent" => 'Chrome/49.0.2587.3',
//        	'Accept' => 'text/html,application/xhtml+xml,application/xml',
//        	'Accept-Encoding' => 'gzip',
// 	]);
// 	$ret = $cli->get('/');
// 	$chan->push(['www.qq.com' => $cli->statusCode]);
// });

// //协程3
// go(function() use ($chan){
// 	$cli = new Swoole\Coroutine\Http\Client('www.163.com',80);
// 	$cli->set(['timeout'=>10]);
// 	$cli->setHeaders([
// 		'Host' => "www.163.com",
//        	"User-Agent" => 'Chrome/49.0.2587.3',
//        	'Accept' => 'text/html,application/xhtml+xml,application/xml',
//        	'Accept-Encoding' => 'gzip',
// 	]);
// 	$ret = $cli->get('/');
// 	$chan->push(['www.163.com' => $cli->statusCode]);
// });



//== DEFER
//延迟任务
/**
 * 代码输出：abc-b-a
 * 结构是栈么？
 */
Swoole\Runtime::enableCoroutine();

go(function(){
	echo "a";
	defer(function(){
		echo '-a';
	});

	echo 'b';
	defer(function(){
		echo '-b';
	});
	sleep(2);
	echo 'c';
});






