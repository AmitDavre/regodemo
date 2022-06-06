<?php
	
	if(session_id()==''){session_start();}
	ob_start();
	include('../../dbconnect/db_connect.php');
	include(DIR.'files/functions.php');
	include(DIR.'files/payroll_functions.php');
	include(DIR.'files/arrays_'.$lang.'.php');


	$empid = $_REQUEST['empid'];
	$sessionpayrollDbase = $_SESSION['rego']['cid'].'_payroll_'.$_SESSION['rego']['cur_year'];

	$data=array();
	$getMonthdata = $dbc->query("SELECT * FROM ".$sessionpayrollDbase." WHERE emp_id = '".$empid."' AND month = '".$_SESSION['rego']['cur_month']."' ");
	if($getMonthdata->num_rows > 0){
		while ($row = $getMonthdata->fetch_assoc()) {
			$data[] = $row;
			$data['position'] = $positions[$row['position']][$lang];
			$data['department'] = $departments[$row['department']][$lang];
			$data['team'] = $teams[$row['team']][$lang];
			$data['calc_base'] = $row['calc_base'];
			$data['contract_type'] = $row['contract_type'];
			$data['calc_pvf'] = $row['calc_pvf'] ? 'Yes' : 'No';
			$data['calc_psf'] = $row['calc_psf'] ? 'Yes' : 'No';
			$data['calc_sso'] = $row['calc_sso'] ? 'Yes' : 'No';
			$data['calc_tax'] = $row['calc_tax'] ? 'Yes' : 'No';
			$data['calc_on_sd'] = $row['calc_on_sd'] ? 'Calc' : 'THB';
			$data['calc_on_pc'] = $row['calc_on_pc'] ? 'Calc' : 'THB';
			$data['calc_on_pf'] = $row['calc_on_pf'] ? 'Calc' : 'THB';
			$data['calc_on_ssf'] = $row['calc_on_ssf'] ? 'Calc' : 'THB';


			$data['manual_feed_data'] = unserialize($row['manual_feed_data']);
			$data['manual_feed_total'] = unserialize($row['manual_feed_total']);
			
			$data['fix_allow_from_emp'] = unserialize($row['fix_allow_from_emp']);
			$data['fix_deduct_from_emp'] = unserialize($row['fix_deduct_from_emp']);
		}
		ob_clean();
		echo json_encode($data);
	}else{
		ob_clean();
		echo 'error';
	}

?>