<?php
error_reporting(E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);
define('APP_ROOT', realpath(dirname(__FILE__)));
define('LOG_DIR', '/home/weblog/');
define('FRAMEWORK', APP_ROOT . '/framework');
define('MODEL', APP_ROOT . '/model');

$GLOBALS['THRIFT_ROOT'] = FRAMEWORK . '/thrift';

//定义模块类型
define('SERVER_ID',1);
define('MODEL_ADMIN_USER', 'admin_user');
define('MODEL_TIGER_USER', 'tiger.user');

//错误码定义
define('ERROR_MEMCACHE', 21);
define('ERROR_MODULE_NOT_FOUND',22);




//业务逻辑开始
require_once FRAMEWORK. '/common.func.php';
require_once APP_ROOT. '/common.func.php';
require_once FRAMEWORK . '/config/AppConfig.class.php';
require_once FRAMEWORK . '/log/LogFactory.class.php';
require_once FRAMEWORK . '/db/RequestFactory.class.php';
?>