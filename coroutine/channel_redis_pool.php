<?php
/**
 * 使用 Channel 可以方便得实现连接池功能。
 */

class RedisPool
{
	protected $pool;

	function __construct($size = 100)
	{
		$this->pool = new co\Channel($size);
		for ($i=0; $i < $size ; $i++) { 
			$redis = new Swoole\Coroutine\Redis();
			$res = $redis->connect('127.0.0.1',6379);
			if($res == false){
				throw new RuntimeException("connect redis server failed", 1);
			}else{
				$this->put($redis);
			}
		}
	}

	function put($redis){
		$this->pool->push($redis);
	}

	function get(){
		return $this->pool->pop();
	}
}
