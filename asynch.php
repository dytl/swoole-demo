<?php
/**
 * 异步任务
 */

$serv = new swoole_server('127.0.0.1',9501);

//工作进程数
$serv->set(array('task_worker_num'=>4));

$serv->on('receive',function($serv,$fd,$from_id,$data){
	//投递异步任务
	$task_id = $serv->task($data);
	echo "Dispath AsyncTask: id=$task_id\n";
});

$serv->on('task',function($serv,$task_id,$from_id,$data){
	echo "New AsyncTask[id=$task_id]".PHP_EOL;
    //返回任务执行的结果
    $serv->finish("$data");
});


$serv->on('finish',function($serv,$task_id,$data){
	echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
});

$serv->start();

