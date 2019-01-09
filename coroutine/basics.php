<?php
/**
 * 协程的常用方法
 */

/**
 * 创建新的协程
 */
go(function(){
	$db = new co\mysql();
	$server = array(
		'host' => '127.0.0.1',
		'user' => 'root',
		'password' => '',
		'database' => 'data-admin'
	);

	$db->connect($server);
	$res = $db->query('select * from admin_users');
	print_r($res);
});


/**
 * 协程的挂起（yield/suspend），恢复(resume)  成对使用；
 */

$cid = go(function(){
	echo 'co 1 start'.PHP_EOL;
	co::yield();
	echo 'co 1 end'.PHP_EOL;
});

go(function() use ($cid){
	echo 'co 2 start'.PHP_EOL;
	co::sleep(0.5);
	co::resume($cid);
	echo 'co 2 end'.PHP_EOL;
});

/*
 * ******************************************************
 * print result:
	co 1 start
	co 2 start
	co 1 end
	co 2 end
 * ******************************************************
 */



/**
 * 获取协程函数调用栈  getBackTrace
 */
function test1(){
	test2();
}
function test2(){
	while (true) {
		co::sleep(1);
		echo __FUNCTION__.PHP_EOL;
	}
}

$cid = go(function(){
	test1();
});

go(function() use ($cid) {
	while (true) {
		echo "BackTrace[$cid]:\n-----------------------------------------------\n";
		var_dump(co::getBackTrace($cid)).PHP_EOL;
		co::sleep(1);
	}
});







