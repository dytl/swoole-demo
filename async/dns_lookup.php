<?php
/**
 * 域名解析  dns lookup
 */
const DOMAIN_ADDRESS = 'www.80soho.com';

swoole_async_set(array(
	'use_async_resolver' => true,
    'disable_dns_cache' => true,
    'dns_lookup_random' => true,
    'dns_server' => '114.114.114.114',
));

dns_lookup("www.sina.com.cn",function($host,$ip){
	echo "{$host} resolve to {$ip}";
});

//异步回调
swoole_async_dns_lookup(DOMAIN_ADDRESS,function($host,$ip){
	echo  DOMAIN_ADDRESS." resolve to {$ip}".PHP_EOL;
});

//协程
go(function(){
	echo DOMAIN_ADDRESS.':'.swoole_async_dns_lookup_coro(DOMAIN_ADDRESS).PHP_EOL;
});


