<?php
/**
 * 域名解析  dns lookup
 */
//待解析域名
const DOMAIN_ADDRESS = 'www.80soho.com';

swoole_async_set(array(
	'use_async_resolver' => true,  //启用异步IO的DNS查询
    'disable_dns_cache' => true,  //关闭DNS缓存
    'dns_lookup_random' => true,  //DNS随机
    'dns_server' => '114.114.114.114',  //指定DNS服务器
));

//原生PHP写法
echo gethostbyname(DOMAIN_ADDRESS).PHP_EOL;;

//异步回调
swoole_async_dns_lookup(DOMAIN_ADDRESS,function($host,$ip){
	echo  DOMAIN_ADDRESS." resolve to {$ip}".PHP_EOL;
});

//协程
go(function(){
	echo DOMAIN_ADDRESS.':'.swoole_async_dns_lookup_coro(DOMAIN_ADDRESS).PHP_EOL;
});


