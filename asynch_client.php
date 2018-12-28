<?php
/**
 * 异步客户端
 */

//myql
// $db = new Swoole\MySQL;
// $server = array(
// 	'host' => '127.0.0.1',
// 	'database' => 'data-admin',
// 	'user' => 'root',
// 	'password' => '',
// );

// $db->connect($server,function($db,$result){
// 	$db->query('show tables',function(Swoole\MySQL $db,$result){
// 		var_dump($result);
// 		$db->close();
// 	});
// });


//redis
$redis = new Swoole\Redis;
$redis->connect('127.0.0.1',6379,function($redis,$result){
	$redis->set('swoole_redis_set_key','swoole_val',function($redis,$result){
		$redis->get('swoole_redis_set_key',function($redis,$result){
			var_dump($result);
		});
	});
});



