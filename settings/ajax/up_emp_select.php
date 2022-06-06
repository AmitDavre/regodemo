<?
	if(session_id()==''){session_start(); ob_start();}
	include('../../dbconnect/db_connect.php');

	$sbranches = str_replace(',', "','", implode(',', $_REQUEST['locations']));
	$sdivisions = str_replace(',', "','", implode(',', $_REQUEST['divisions']));
	$sdepartments = str_replace(',', "','", implode(',', $_REQUEST['departments']));
	$steams = str_replace(',', "','", implode(',', $_REQUEST['teams']));


	if($_SESSION['RGadmin']['id'])
	{
		$sesssionUserId = $_SESSION['RGadmin']['id'];
	}
	else
	{
		$sesssionUserId = $_SESSION['rego']['id'];
	}



	if($_REQUEST['empStatus'] == 7){
		$where = "title = '' OR joining_date = '' OR firstname = '' OR lastname = '' OR base_salary = 0 ";
	}else{
		$where = "emp_status = '".$_REQUEST['empStatus']."'";
	}

	if($sbranches != ''){ $where .= " AND branch IN ('".$sbranches."')"; }
	if($sdivisions != ''){ $where .= " AND division IN ('".$sdivisions."')"; }
	if($sdepartments != ''){ $where .= " AND department IN ('".$sdepartments."')"; }
	if($steams != ''){ $where .= " AND team IN ('".$steams."')"; }

	$trData = '';
	if($sbranches && $sdivisions && $sdepartments && $steams == ''){ ob_clean(); echo 'success';;}

	$data = array();
	$res1 = "SELECT * FROM ".$_SESSION['rego']['cid']."_employees WHERE ".$where." "; 
	$res = $dbc->query($res1);
	while($row = $res->fetch_assoc()){
		$data[] = $row;
	}

	$dbc->query("DELETE FROM ".$_SESSION['rego']['cid']."_temp_employee_data WHERE user_id = '".$sesssionUserId."'");


	foreach ($data as $key => $row) {

		$checkEmpid = $dbc->query("SELECT * FROM ".$_SESSION['rego']['cid']."_temp_employee_data WHERE emp_id = '".$row['emp_id']."' AND user_id = '".$sesssionUserId."'");
		if($checkEmpid->num_rows > 0){

			$dbc->query("UPDATE ".$_SESSION['rego']['cid']."_temp_employee_data SET `position`='".$row['position']."', `company`='".$row['entity']."', `location`='".$row['branch']."', `division`='".$row['division']."', `department`='".$row['department']."', `team`='".$row['team']."', `organization`='".$row['organization']."', `groups`='".$row['groups']."', `sid`='".$row['sid']."', `title`='".$row['title']."', `firstname`='".$row['firstname']."', `lastname`='".$row['lastname']."', `th_name`='".$row['th_name']."', `en_name`='".$row['en_name']."', `birthdate`='".$row['birthdate']."', `nationality`='".$row['nationality']."', `gender`='".$row['gender']."' ,`maritial`='".$row['maritial']."',`religion`='".$row['religion']."',`military_status`='".$row['military_status']."' ,`height`='".$row['height']."' ,`weight`='".$row['weight']."' ,`bloodtype`='".$row['bloodtype']."' ,`drvlicense_nr`='".$row['drvlicense_nr']."' ,`drvlicense_exp`='".$row['drvlicense_exp']."',`idcard_nr`='".$row['idcard_nr']."',`idcard_exp`='".$row['idcard_exp']."',`tax_id`='".$row['tax_id']."',`reg_address`='".$row['reg_address']."',`sub_district`='".$row['sub_district']."',`district`='".$row['district']."',`province`='".$row['province']."' ,`postnr`='".$row['postnr']."' ,`country`='".$row['country']."',`latitude`='".$row['latitude']."',`longitude`='".$row['longitude']."',`cur_address`='".$row['cur_address']."',`personal_phone`='".$row['personal_phone']."',`work_phone`='".$row['work_phone']."' ,`personal_email`='".$row['personal_email']."',`work_email`='".$row['work_email']."' ,`username_option`='".$row['username_option']."',`username`='".$row['username']."' ,`joining_date`='".$row['joining_date']."',`probation_date`='".$row['probation_date']."',`emp_type`='".$row['emp_type']."',`account_code`='".$row['account_code']."',`groups_work_data`='".$row['groups']."',`time_reg`='".$row['time_reg']."' ,`selfie`='".$row['selfie']."',`workFromHome`='".$row['workFromHome']."' ,`annual_leave`='".$row['annual_leave']."',`contract_type`='{$row['contract_type']}', `calc_base`='{$row['calc_base']}',`bank_code`='{$row['bank_code']}',`bank_name`='{$row['bank_name']}',`bank_branch`='{$row['bank_branch']}',`bank_account`='{$row['bank_account']}',`bank_account_name`='{$row['bank_account_name']}',`pay_type`='{$row['pay_type']}',`calc_method`='{$row['calc_method']}',`calc_tax`='{$row['calc_tax']}',`tax_residency_status`='{$row['tax_residency_status']}',`income_section`='{$row['income_section']}',`modify_tax`='{$row['modify_tax']}',`calc_sso`='{$row['calc_sso']}',`sso_by`='{$row['sso_by']}',`gov_house_banking`='{$row['gov_house_banking']}',`savings`='{$row['savings']}',`legal_execution`='{$row['legal_execution']}',`kor_yor_sor`='{$row['kor_yor_sor']}' WHERE emp_id = '".$row['emp_id']."' AND user_id = '".$sesssionUserId."' ");
		}else{
			$sql = "INSERT INTO ".$_SESSION['rego']['cid']."_temp_employee_data (`user_id`, `emp_id`, `position`, `company`, `location`, `division`, `department`, `team`, `organization`, `groups`, `sid`, `title`, `firstname`, `lastname`, `th_name`, `en_name`, `birthdate`, `nationality`, `gender`, `maritial`, `religion`, `military_status`, `height`, `weight`, `bloodtype`, `drvlicense_nr`, `drvlicense_exp`, `idcard_nr`, `idcard_exp`, `tax_id`, `reg_address`, `sub_district`, `district`, `province`, `postnr`, `country`, `latitude`, `longitude`, `cur_address`, `personal_phone`, `work_phone`, `personal_email`, `work_email`, `username_option`, `username`,`joining_date`, `probation_date`, `emp_type`, `account_code`, `groups_work_data`, `time_reg`, `selfie`, `workFromHome`, `annual_leave`,`contract_type`,`calc_base`, `bank_code`, `bank_name`, `bank_branch`, `bank_account`, `bank_account_name`, `pay_type`, `calc_method`, `calc_tax`, `tax_residency_status`, `income_section`, `modify_tax`, `calc_sso`, `sso_by`, `gov_house_banking`, `savings`, `legal_execution`, `kor_yor_sor`) VALUES ('".$sesssionUserId."', '".$row['emp_id']."', '".$row['position']."', '".$row['entity']."', '".$row['branch']."', '".$row['division']."', '".$row['department']."', '".$row['team']."', '".$row['organization']."', '".$row['groups']."', '".$row['sid']."', '".$row['title']."', '".$row['firstname']."', '".$row['lastname']."', '".$row['th_name']."', '".$row['en_name']."', '".$row['birthdate']."', '".$row['nationality']."', '".$row['gender']."', '".$row['maritial']."', '".$row['religion']."', '".$row['military_status']."', '".$row['height']."', '".$row['weight']."', '".$row['bloodtype']."', '".$row['drvlicense_nr']."', '".$row['drvlicense_exp']."', '".$row['idcard_nr']."', '".$row['idcard_exp']."', '".$row['tax_id']."', '".$row['reg_address']."', '".$row['sub_district']."', '".$row['district']."', '".$row['province']."', '".$row['postnr']."', '".$row['country']."', '".$row['latitude']."', '".$row['longitude']."', '".$row['cur_address']."', '".$row['personal_phone']."', '".$row['work_phone']."', '".$row['personal_email']."', '".$row['work_email']."', '".$row['username_option']."', '".$row['username']."', '".$row['joining_date']."', '".$row['probation_date']."', '".$row['emp_type']."', '".$row['account_code']."', '".$row['groups']."', '".$row['time_reg']."', '".$row['selfie']."', '".$row['workFromHome']."', '".$row['annual_leave']."','{$row['contract_type']}', '{$row['calc_base']}','{$row['bank_code']}','{$row['bank_name']}','{$row['bank_branch']}','{$row['bank_account']}','{$row['bank_account_name']}','{$row['pay_type']}','{$row['calc_method']}','{$row['calc_tax']}','{$row['tax_residency_status']}','{$row['income_section']}','{$row['modify_tax']}','{$row['calc_sso']}','{$row['sso_by']}','{$row['gov_house_banking']}','{$row['savings']}','{$row['legal_execution']}','{$row['kor_yor_sor']}' ) ";
			$dbc->query($sql);
		}


	}

	
	ob_clean();
	echo 'success';
	
?>