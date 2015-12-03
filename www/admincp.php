<?php
include '../config.inc.php';
include './admins.php';
include FRAMEWORK . '/mvc/Template.class.php';
define('ADMIN_CONTROL', APP_ROOT.'/admincp/control');
//note 定义Cache、Block、Templates等缓存数据的目录
define('TEMPLATE_DATA_DIR', APP_ROOT.'/cache/templates');
//定义多语言文件路径
define('TEMPLATE_MESSAGE_DIR', APP_ROOT.'/language');
//note 定义Templates模板路径
define('TEMPLATE_DIR', APP_ROOT.'/admincp/view');
define ('TEMPLATE_EXT','.htm');
$admin_audit_logger = LogFactory::getLogger(array(
    'prefix' => LogFactory::LOG_MODULE_ADMINCP,
    'storage' => 'local',
    'log_level' => 1
));
date_default_timezone_set("Asia/Shanghai");

$ip = get_ip();
$admin_audit_logger->writeDebug("\n[$ip]:".json_encode($_REQUEST));


$module = getGPC("mod", "string");
$action = getGPC('act', "string");

if ($module != 'product' || $action != 'customreport') {
	$invalid = invalid();
	if($module=='user'&& ($action=='playercomplain' || $action=='playerappeal' || $action=='playerrecruit'|| $action=='playersurvey')) {
		$invalid = array('username'=>'playercomplain');
	}
	if($invalid===true){
		$module = 'user';
		$action = 'login';
	}
} else {
	$invalid = invalid2();
}
if (is_array($invalid) && !isset($invalid['language']))
{
	$invalid['language'] = 'zh_CN';
}
$admin_language = $invalid['language'];
$admin_language ='zh_CN';
$lang = require_once APP_ROOT . '/admincp/language/' . $admin_language . '.php';

if(empty($module) || empty($action)){
	$module = 'user';
	$action = 'index';
}
//$servers = load(MODEL_SERVER)->getServers('zh-CN');
$actions = load(MODEL_ADMIN_USER)->getAllowedActions($invalid['username']);
if($module=='user' && ($action=='playercomplain' || $action=='playerappeal' || $action=='playerrecruit'|| $action=='playersurvey')) {
	$actions = array('user'=>array($action));
}
$allow_action = array('index','quit','search','save','login');
if(empty($actions)) {
	$actions = array('user' => array('index'));
}
/**
if(!in_array($action, $allow_action) && !in_array($action, $actions[$module])) {
	$action = 'limiterror';
	$GLOBALS['TEMPLATE_FILE'] = TEMPLATE_DIR.'/limiterror.htm';
	$error = '您没有权限访问该页面，请及时跟管理员联系。';
	include renderTemplate($module, $action);
	return;
}
**/
if(in_array('remove', $actions[$module])){
	$has_remove=true;
}
if(in_array('modify', $actions[$module])){
	$has_modify=true;
}

require ADMIN_CONTROL.'/base.php';
$view_datas = array();
$control_file = ADMIN_CONTROL."/{$module}.php";
if (file_exists($control_file)) {
	require $control_file;
} else {
	$view_file = TEMPLATE_DIR.'/'.$module.'/'.$action. TEMPLATE_EXT;
	if(file_exists($view_file)) {
		include renderTemplate($module, $action);
		return;
	}
}

try{
	$classname = $module.'control';
	$control = new $classname();
	$method = 'on'.$action;
	if(method_exists($control, $method) && $action{0} != '_') {
		$data = $control->$method();
	} elseif(method_exists($control, '_call')) {
		$data = $control->_call('on'.$action, '');
	} else {
		exit('Action not found!');
	}
	if (isset($data)) {
		ob_clean();
		header('Content-Type: application/json; charset=UTF-8');
		$ret = json_encode($data);
	}
	else
	{
		header('Content-type: text/html; charset=UTF-8');
	}
}catch (Exception $e){
	$error_msg = $e->__toString();
	$ret = json_encode(array('status'=>'ERROR', 'error_code'=>$e->getCode(), 'error_msg' => $e->getMessage()));
}
$callback = getGPC('callback', 'string');
if (!empty($callback)) $ret = "$callback($ret);";
if (!empty($ret)) die($ret);
if (!empty($view_datas)) {
	extract($view_datas, EXTR_SKIP);
}

include (renderTemplate($module, $action));
?>