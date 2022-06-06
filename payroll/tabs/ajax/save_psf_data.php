<?php
	if(session_id()==''){session_start(); ob_start();}
	include('../../../dbconnect/db_connect.php');
	include(DIR.'files/functions.php');
	include(DIR.'files/payroll_functions.php');

	$sessionpayrollDbase = $_SESSION['rego']['cid'].'_payroll_'.$_SESSION['rego']['cur_year'];

	if(!empty($_REQUEST)){

		$upsql = "UPDATE ".$sessionpayrollDbase." SET calc_psf = '".$_REQUEST['psfss_calc_sso']."', psf_emp_calc = '".$_REQUEST['psf_calculate_emp']."', psf_emp_manual = '".$_REQUEST['psf_manual_emp']."', psf_employee = '".$_REQUEST['psf_psf_emp']."', psf_comp_calc = '".$_REQUEST['psf_calculate_comp']."', psf_comp_manual = '".$_REQUEST['psf_manual_comp']."', psf_company = '".$_REQUEST['psf_psf_comp']."' WHERE emp_id = '".$_REQUEST['empids']."' AND month = '".$_SESSION['rego']['cur_month']."' ";
		$dbc->query($upsql);

		ob_clean();
		echo 'success';
	}else{
		ob_clean();
		echo 'error';
	}

?>