<?php
//!defined('APP_ROOT') && exit('Access Denied');
ini_set('memory_limit', '128M');
ini_set('max_execution_time', 0);
include '../config.inc.php';

//组织字段及表头
//客户信息
$cols[]='user_affiliation';
$cols[]='user_name';
$cols[]='realname';
$cols[]='user_classify';
$cols[]='user_attribute';
$cols[]='email';
$cols[]='phone';
$cols[]='register_time';
$cols[]='mt4';
$cols[]='mt4_real';
$cols[]='pay_time';
$cols[]='pay_out';
$cols[]='status';
$cols[]='url_from';

foreach ($cols as $col)
{
  echo "{name:'$col',index:'$col', width:50},\n";     
}
                            
echo array_keys($newarr);                            



?>