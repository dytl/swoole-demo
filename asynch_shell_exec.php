<?php
/**
 * 协程：并发shell_exec
 */

$c = 10;
while ($c -- ) {
	go(function(){
		//var_dump(co::exec("sleep 5"));
		var_dump(shell_exec("sleep 5"));
	});
}


