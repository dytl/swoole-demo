<?php
/**
 * 原子计数操作
 */

$atomic = new swoole_atomic(123);

echo $atomic->add(12).PHP_EOL;  //135

echo $atomic->sub(11).PHP_EOL;  //124

echo $atomic->cmpset(122,999).PHP_EOL;  // empty

echo $atomic->cmpset(124,999).PHP_EOL;  //1

echo $atomic->get().PHP_EOL;  //999
