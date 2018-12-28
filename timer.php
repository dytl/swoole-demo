<?php
/**
 * 定时器
 */

swoole_timer_tick(1000,function($timer_id){
	echo "tick-1000\n";
});

swoole_timer_after(3000,function(){
	echo "after 3000ms.\n";
});
