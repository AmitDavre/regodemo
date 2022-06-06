<?php
	if(session_id()==''){session_start(); ob_start();}
	include('../../../dbconnect/db_connect.php');
	include(DIR.'files/functions.php');
	include(DIR.'files/payroll_functions.php');

	$sessionpayrollDbase = $_SESSION['rego']['cid'].'_payroll_'.$_SESSION['rego']['cur_year'];

	if(!empty($_REQUEST)){

		$upsql = "UPDATE ".$sessionpayrollDbase." SET calc_pvf = '".$_REQUEST['pvfss_calc_pvf']."', pvf_emp_calc = '".$_REQUEST['pvf_calculate_emp']."', pvf_emp_manual = '".$_REQUEST['pvf_manual_emp']."', pvf_employee = '".$_REQUEST['pvf_pvfemp_emp']."', pvf_comp_calc = '".$_REQUEST['pvf_calculate_comp']."', pvf_comp_manual = '".$_REQUEST['pvf_manual_comp']."', pvf_company = '".$_REQUEST['pvf_pvfcom_comp']."' WHERE emp_id = '".$_REQUEST['empids']."' AND month = '".$_SESSION['rego']['cur_month']."' ";
		$dbc->query($upsql);

		ob_clean();
		echo 'success';
	}else{
		ob_clean();
		echo 'error';
	}

?>