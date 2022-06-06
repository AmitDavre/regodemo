<?php
	
	if(session_id()==''){session_start();}
	ob_start();
	include('../../dbconnect/db_connect.php');
	include(DIR.'files/payroll_functions.php');

	$empIds = $_REQUEST['empid'];

	$d = $_SESSION['rego']['cur_year'].'-'.$_SESSION['rego']['curr_month'].'-01';
	$som = date('Y-m-d', strtotime($d));
	$eom = date('Y-m-t', strtotime($d));


	$sessionpayrollDbase = $_SESSION['rego']['cid'].'_payroll_'.$_SESSION['rego']['cur_year'];

	$data = array();
	$sql = "SELECT * FROM ".$cid."_employees WHERE emp_id = '".$empIds."'";
	if($res = $dbc->query($sql)){
		while($row = $res->fetch_assoc()){
			$data[] = $row;
		}
	}else{
		echo mysqli_error($dbc);
		exit;
	} 

	// print_r($data);
	// die();

	
	if($data){

		foreach($data as $k=>$v){

			$workdays = ($rego_settings['days_month'] == 0 ? 30 : $rego_settings['days_month']);
			$tmp = getEmployeeWorkedDays($v['joining_date'], $v['resign_date'], $workdays);
			if(!$tmp['started'] && !$tmp['resigned']){
				$calendar_days = $tmp['calendar_days'];
			}else{
				$calendar_days = $tmp['worked_days'];
			}

			$getMonthdata = $dbc->query("SELECT * FROM ".$sessionpayrollDbase." WHERE emp_id = '".$v['emp_id']."' AND month = '".$_SESSION['rego']['cur_month']."' ");
			if($getMonthdata->num_rows > 0){

				//nothing to do

			}else{

				$getSelmonPayrollData = getSelmonPayrollData($_SESSION['rego']['cur_month']);
				$countEmpthismonth = count($getSelmonPayrollData);
				if($countEmpthismonth == $_SESSION['rego']['max']){
					ob_clean();
					echo 'Max limit exceeded';
					exit;
				}

				$addEmpdata = "INSERT INTO ".$sessionpayrollDbase." (emp_id, month, payroll_modal_id, entity, branch, division, department, team, position, emp_name_th, emp_name_en, paid_days, paid) VALUES ('".$v['emp_id']."', '".$_SESSION['rego']['cur_month']."', '".$v['payroll_modal_value']."', '".$v['entity']."', '".$v['branch']."', '".$v['division']."', '".$v['department']."', '".$v['team']."', '".$v['position']."', '".$v['th_name']."', '".$v['en_name']."', '".$calendar_days."', 'C')";
				 $dbc->query($addEmpdata);
			}
		}
		
		ob_clean();
		echo 'success';
		
	}else{

		ob_clean();
		echo 'error';
	}

?>