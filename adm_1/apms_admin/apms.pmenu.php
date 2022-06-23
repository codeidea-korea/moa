<?php
if (true)
	$menu['menu888'] = array (
		array('888001', '호스트 관리', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=basic', 'apms_basic'),
		array('888001', '호스트 기본설정', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=basic', 'apms_basic'),
		array('888002', '호스트 관리', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=plist', 'apms_plist'),
		array('888006', '출금관리', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=payment', 'apms_payment', 1),
	);
	//array('888003', '마케터관리', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=mlist', 'apms_mlist'),
	if ($_extMenu) {
		$menu['menu888'][] = array('888004', '배송관리', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=delivery', 'apms_delivery', 1);
		$menu['menu888'][] = array('888005', '배송비용', ''.G5_ADMIN_URL.'/apms_admin/apms.admin.php?ap=sendcost', 'apms_sendcost', 1);
	}