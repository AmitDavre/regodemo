<?php
	
	if(session_id()==''){session_start();}
	ob_start();
	include('../../dbconnect/db_connect.php');

	$id = $_REQUEST['row_id'];
	//$result = "DELETE FROM ".$_SESSION['rego']['payroll_dbase']." WHERE id='".$id."' AND month='".$_SESSION['rego']['cur_month']."'";
	$result = "DELETE FROM ".$_SESSION['rego']['cid']."_payroll_".$_SESSION['rego']['cur_year']." WHERE id='".$id."'";
	$dbc->query($result);

	ob_clean();
	echo 'success';

?>