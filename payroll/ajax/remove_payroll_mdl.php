<?php
	
	if(session_id()==''){session_start();}
	ob_start();
	include('../../dbconnect/db_connect.php');

	$mdlid = $_REQUEST['mdlid'];
	$month = $_REQUEST['month'];
	
	//Remove payroll
	$result = $dbc->query("DELETE FROM ".$_SESSION['rego']['cid']."_payroll_".$_SESSION['rego']['cur_year']." WHERE payroll_modal_id='".$mdlid."' AND month='".$month."'");

	//Remove payroll_overview
	$result1 = $dbc->query("DELETE FROM ".$_SESSION['rego']['cid']."_payroll_overview_".$_SESSION['rego']['cur_year']." WHERE payroll_model_id='".$mdlid."' AND month='".$month."'");

	ob_clean();
	echo 'success';

?>

