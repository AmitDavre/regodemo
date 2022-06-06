<?php
	if(session_id()==''){session_start(); ob_start();}
	include('../../../dbconnect/db_connect.php');
	include(DIR.'files/functions.php');
	include(DIR.'files/payroll_functions.php');

	$sessionpayrollDbase = $_SESSION['rego']['cid'].'_payroll_'.$_SESSION['rego']['cur_year'];

	if(!empty($_REQUEST)){

		$upsql = "UPDATE ".$sessionpayrollDbase." SET calc_sso = '".$_REQUEST['sss_calc_sso']."', sso_by = '".$_REQUEST['sss_paidby_sso']."', sso_emp_calc = '".$_REQUEST['sso_calculate_sso_emp']."', sso_emp_manual = '".$_REQUEST['sso_manual_emp']."', sso_employee = '".$_REQUEST['sso_emp_sso']."', sso_by_company = '".$_REQUEST['sso_sso_by_company']."', sso_comp_calc = '".$_REQUEST['sso_calculate_sso_comp']."', sso_comp_manual = '".$_REQUEST['sso_manual_comp']."', sso_company = '".$_REQUEST['sso_sso_employerss']."' WHERE emp_id = '".$_REQUEST['empids']."' AND month = '".$_SESSION['rego']['cur_month']."' ";
		$dbc->query($upsql);

		ob_clean();
		echo 'success';
	}else{
		ob_clean();
		echo 'error';
	}

?>