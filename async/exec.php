<?php
/**
异步执行Shell命令。相当于shell_exec函数，执行后底层会fork一个子进程，并执行对应的command命令。

function swoole_async::exec(string $command, callable $callback);

$command为执行的终端指令，如ls

执行成功后返回子进程的PID

命令执行完毕子进程退出后会回调指定的$callback函数，回调函数接收2个参数，第一个参数为命令执行后的屏幕输出内容$result，第二个参数为进程退出的状态信息$status
 */

//Swoole\Async::exec

// $pid = Swoole\Async::exec("ps aux",function($resutl,$status){
// 	var_dump($resutl,$status);
// });


//Swoole_Async::exec

$pid = Swoole_Async::exec("php -m",function($resutl,$status){
	var_dump($resutl,$status);
});

var_dump($pid);


