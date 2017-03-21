<?php
	header('Content-Type:application/json');	
	@$uid = $_REQUEST['uid'] or die('{"code":-2,"msg":"用户编号不能为空"}');
	require ('init_jd.php');
	
	$sql = "select * from jd_order where userId = $uid";
	$result = mysqli_query($conn,$sql);
	$orderList = mysqli_fetch_all($result,MYSQLI_ASSOC);
	foreach ($orderList as $i => $order) {
		$orderId = $order['orderId'];
		$sql = "select * from jd_product where orderId = $orderId";
		$result = mysqli_query($conn,$sql);
		$orderList = mysqli_fetch_all($result,MYSQLI_ASSOC);
	}
	echo json_encode($orderList);
?>