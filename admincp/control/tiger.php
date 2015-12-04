<?php
!defined('APP_ROOT') && exit('Access Denied');
class tigercontrol extends base {
    public function __construct() {
        parent::__construct();
        $server_id = intval($_COOKIE['sid']);//指向tiger库
		$this -> db = "`tiger`";
    }

    public function onuser() {
        $sql = 'select * from user limit 200';
        $res = load(MODEL_TIGER_USER) -> executeQuery($sql);
        $GLOBALS['view_datas'] = array('res' => $res);
    }

    public function onuser3(){

    }
    
    public function onuser2() {
        //以下组织分页数据
        $type = $this->input('type');
		if($type == 'list') {
			$page = $_GET['page'];
			if(!isset($_GET['rows'])) {
				$limit = 10;
			} else {
				$limit = $_GET['rows']; 
			}
			$sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
			$sord = $_GET['sord']; // get the direction 
			if(!$sidx) $sidx =1; // connect to the database 

			$SQL = 'SELECT count(mt4_real) as count FROM custorm'; 
			$res = $this->load(MODEL_TIGER_USER)->execute($SQL,null,null,true,true);	
			$count = $res['count']; 
			if($count >0) {
				$total_pages = ceil($count/$limit);
			} else {
				$total_pages = 0; 
			} 
			if ($page > $total_pages) $page=$total_pages; 
			$start = $limit*$page - $limit; // do not put $limit*($page - 1)
			if($start < 0) $start = 0;
			$SQL = "SELECT user_affiliation,user_name,realname,user_classify,user_attribute,email,phone,register_time,mt4,mt4_real,pay_time,pay_out,status,url_from FROM custorm ORDER BY $sidx $sord LIMIT $start , $limit"; 
			$results = $this->load(MODEL_TIGER_USER)->executeQuery($SQL);
			$response['page'] = $page; 
			$response['total'] = $total_pages;
			$response['records'] = $count; 
			$i=0; 
			foreach ($results as $result) {
			 	$response['rows'][$i]['cell']=array($result['user_affiliation'],$result['user_name'],$result['realname'],$result['user_classify'],$result['user_attribute'],$result['email'],$result['phone'],$result['register_time'],$result['mt4'],$result['mt4_real'],$result['pay_time'],$result['pay_out'],$result['status'],$result['url_from']); 
			 	$i++; 
			}
			return $response;
			
		}
    }
}
?>