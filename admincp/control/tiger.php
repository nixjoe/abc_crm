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
    /**        
        //以下组织分页数据
        $type = $this->input('type');
		if($type == 'list') {
			$page = $_GET['page'];
			if($_GET['rows'] == '') {
				$limit = 10;
			} else {
				$limit = $_GET['rows']; 
			}
			$sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
			$sord = $_GET['sord']; // get the direction 
			if(!$sidx) $sidx =1; // connect to the database 

			$count = count($transactions); 
			if($count >0) {
				$total_pages = ceil($count/$limit);
			} else {
				$total_pages = 0; 
			} 
			if ($page > $total_pages) $page=$total_pages; 
			$start = $limit*$page - $limit; // do not put $limit*($page - 1)
			if($start < 0) $start = 0;
				$SQL = "SELECT * FROM user WHERE  ORDER BY $sidx $sord LIMIT $start , $limit"; 
				$transactions = $this->load(MODEL_TIGER_USER)->executeQuery($SQL);
			$response['page'] = $page; 
			$response['total'] = $total_pages;
			$response['records'] = $count; 
			$i=0; 
			foreach ($transactions as $transaction) {
			 	$response['rows'][$i]['cell']=array($transaction['order_id'], $transaction['user_id'], $transaction['channel'], $transaction['channel_trans_id'],
			 										$transaction['channel_user_id'], $transaction['credits'], $transaction['order_credits'],$transaction['money'], 
			 										$transaction['currency'], $transaction['order_money'], $transaction['status'],
			 										date('Y-m-d H:i:s', $transaction['timestamp']), date('Y-m-d H:i:s', $transaction['last_update']), time_to_day($transaction['timestamp'] - $useridvalid['createtime'])); 
			 	$i++; 
			}
			return $response;
			**/
    }
}
?>