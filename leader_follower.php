<?php

use Swoole/Timer;

//进程管理模块，用来替代php的pcntl
use Swoole/Process;

//channel 内存数据结构，用于实现高性能的进程通信
use Swoole/Channel;

$chan = new Channel(1024 * 256);

$worker_num = 4;
$workers = [];


for ($i=0; $i < $worker_num ; $i++) { 
	$Process = new Process(function ($worker) use ($chan,$i){
		while(true){
			$data = $chan->pop();
			if(empty($data)){
				usleep(200000);
				continue;
			}
			echo "worker #$i\t$data\n";
		}
	},false);
}

Timer::tick(2000,function() use ($chan){
	static $index = 0;
	$chan->push("hello-".$index++);
});


/**
 * ******************************************************

 * 1，function() use (){} : 闭包中 use用于连接闭包和外界的变量；

 * ******************************************************
*/






