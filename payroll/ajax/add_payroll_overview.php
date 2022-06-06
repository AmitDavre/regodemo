<?php
	
	if(session_id()==''){session_start();}
	ob_start();
	include('../../dbconnect/db_connect.php');
	include(DIR.'files/functions.php');
	include(DIR.'files/payroll_functions.php');

	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	if(isset($_REQUEST['chooseMdl'][0])){

		$selectMdl = $dbc->query("SELECT * FROM ".$cid."_payroll_overview_".$_SESSION['rego']['cur_year']." WHERE month = '".$_REQUEST['month']."' AND payroll_model_id ='".$_REQUEST['chooseMdl'][0]."'");
		if($selectMdl->num_rows > 0){
			ob_clean();
			echo 'Model already exist for this month';

		}else{

			$sql = "INSERT INTO ".$cid."_payroll_overview_".$_SESSION['rego']['cur_year']." (`payroll_id`, `month`, `payroll_model_id`, `status`) VALUES ('".$_REQUEST['payroll_id']."', '".$_REQUEST['month']."', '".$_REQUEST['chooseMdl'][0]."','".$_REQUEST['status']."')";
			$res = $dbc->query($sql);


			//====== save payroll parameters for month =======//
			$resED = $dbc->query("SELECT * FROM ".$_SESSION['rego']['cid']."_sys_settings");
			$rowED = $resED->fetch_assoc();
			$tab_default = unserialize($rowED['tab_default']);
			$manualrates_default = unserialize($rowED['manualrates_default']);

			$mid = $_REQUEST['chooseMdl'][0];

			$mdl_data = array();
			$pay_mdl = $dbc->query("SELECT * FROM ".$_SESSION['rego']['cid']."_payroll_models WHERE id = '".$mid."'");
			if($pay_mdl->num_rows > 0){
				$mdl_data = $pay_mdl->fetch_assoc();
			}
			
			
			$getAttendAllowDeduct = getAttendAllowDeduct();
			$getEmployeeFixedCalc = getEmployeeFixedCalc();
			$getEmployeeAllowDeduct = getEmployeeAllowDeduct();


			//=== Fixed allowances & Deductions Employee Register Fixed
			if(isset($getAttendAllowDeduct) && is_array($getAttendAllowDeduct)){ 
				foreach($getAttendAllowDeduct as $row){

						$value = $row['id'];

						if(isset($manualrates_default['allowopt'][$value])){ $allowopt = implode(',',$manualrates_default['allowopt'][$value]); }else{ $allowopt = '';}
						if(isset($manualrates_default['calcOpt'][$value])){ $calcOpt = $manualrates_default['calcOpt'][$value]; }else{ $calcOpt = '';}
						if(isset($manualrates_default['nrhrs'][$value])){ $nrhrs = $manualrates_default['nrhrs'][$value]; }else{ $nrhrs = '';}
						if(isset($manualrates_default['income_base'][$value])){ $income_base = $manualrates_default['income_base'][$value]; }else{ $income_base = '';}
						if(isset($manualrates_default['thbunit'][$value])){ $thbunit = $manualrates_default['thbunit'][$value]; }else{ $thbunit = '';}
						if(isset($manualrates_default['unitarr'][$value])){ $unitarr = $manualrates_default['unitarr'][$value]; }else{ $unitarr = '';}
						if(isset($manualrates_default['nrdays'][$value])){ $nrdays = $manualrates_default['nrdays'][$value]; }else{ $nrdays = '';}
						if(isset($manualrates_default['multiplicator'][$value])){ $multiplicator = $manualrates_default['multiplicator'][$value]; }else{ $multiplicator = '';}
						
						$checkrowdf = $dbc->query("SELECT * FROM ".$cid."_payroll_parameters_".$_SESSION['rego']['cur_year']." WHERE month='".$_SESSION['rego']['cur_month']."' AND itemid='".$row['id']."' AND pr_modal_id='".$mid."' ");
						if($checkrowdf->num_rows > 0){

							$sql112 = "UPDATE ".$cid."_payroll_parameters_".$_SESSION['rego']['cur_year']." SET `pr_modal_id`='".$mid."', `month`='".$_SESSION['rego']['cur_month']."', `itemid`='".$row['id']."', `groups`='".$row['groups']."', `tax_base`='".$row['tax_base']."', `pnd`='".$row['pnd1']."', `sso`='".$row['sso']."', `pvfpsf`='".$row['pvf']."', `allowopt`='".$allowopt."', `calcOpt`='".$calcOpt."', multiplicator='".$multiplicator."', `nrdays`='".$nrdays."', `nrhrs`='".$nrhrs."', `income_base`='".$income_base."', `thbunit`='".$thbunit."', `unitarr`='".$unitarr."' WHERE month='".$_SESSION['rego']['cur_month']."' AND itemid='".$row['id']."' AND pr_modal_id='".$mid."'";
							$dbc->query($sql112);

						}else{

							$sql11 = "INSERT INTO ".$cid."_payroll_parameters_".$_SESSION['rego']['cur_year']." (`pr_modal_id`, `month`, `itemid`, `groups`, `tax_base`, `pnd`, `sso`, `pvfpsf`, `allowopt`, `calcOpt`, `multiplicator`, `nrdays`, `nrhrs`, `income_base`, `thbunit`, `unitarr`) VALUES ('".$mid."', '".$_SESSION['rego']['cur_month']."', '".$row['id']."', '".$row['groups']."', '".$row['tax_base']."', '".$row['pnd1']."', '".$row['sso']."', '".$row['pvf']."', '".$allowopt."', '".$calcOpt."', '".$multiplicator."', '".$nrdays."', '".$nrhrs."', '".$income_base."', '".$thbunit."', '".$unitarr."')";
							$dbc->query($sql11);
						}
				}
			}

			//=== Fixed Allowances & Deductions Emp. Register Man
			if(isset($getEmployeeAllowDeduct) && is_array($getEmployeeAllowDeduct)){ 
				foreach($getEmployeeAllowDeduct as $row){
					
					$checkrowdf = $dbc->query("SELECT * FROM ".$cid."_payroll_parameters_".$_SESSION['rego']['cur_year']." WHERE month='".$_SESSION['rego']['cur_month']."' AND itemid='".$row['id']."' AND pr_modal_id='".$mid."' ");
					if($checkrowdf->num_rows > 0){

						$sql112 = "UPDATE ".$cid."_payroll_parameters_".$_SESSION['rego']['cur_year']." SET `pr_modal_id`='".$mid."', `month`='".$_SESSION['rego']['cur_month']."', `itemid`='".$row['id']."', `groups`='".$row['groups']."', `tax_base`='".$row['tax_base']."', `pnd`='".$row['pnd1']."', `sso`='".$row['sso']."', `pvfpsf`='".$row['pvf']."' WHERE month='".$_SESSION['rego']['cur_month']."' AND itemid='".$row['id']."' AND pr_modal_id='".$mid."'";
						$dbc->query($sql112);
						
					}else{

						$sql11 = "INSERT INTO ".$cid."_payroll_parameters_".$_SESSION['rego']['cur_year']." (`pr_modal_id`, `month`, `itemid`, `groups`, `tax_base`, `pnd`, `sso`, `pvfpsf`) VALUES ('".$mid."', '".$_SESSION['rego']['cur_month']."', '".$row['id']."', '".$row['groups']."', '".$row['tax_base']."', '".$row['pnd1']."', '".$row['sso']."', '".$row['pvf']."')";
						$dbc->query($sql11);
					}
				}
			}


			//============== Save data in Payroll Month table ======================//
			$checkSqllpm = $dbc->query("SELECT * FROM ".$cid."_payroll_months WHERE month='".$_SESSION['rego']['cur_year'].'_'.$_SESSION['rego']['cur_month']."'");
			if($checkSqllpm->num_rows > 0){
				$pmdata = $checkSqllpm->fetch_assoc();

				$allowDeductEmpRegFixed = serialize($getEmployeeFixedCalc);		
				$allowDeductEmpRegManual = serialize($getEmployeeAllowDeduct);
				
				$upsql = "UPDATE ".$cid."_payroll_months SET payroll_opt='".$mdl_data['payroll_opt']."', salary_split= '".$mdl_data['salary_split']."', allowDeductEmpRegFixed='".$allowDeductEmpRegFixed."', allowDeductEmpRegManual= '".$allowDeductEmpRegManual."' WHERE month='".$_SESSION['rego']['cur_year'].'_'.$_SESSION['rego']['cur_month']."' ";
				$dbc->query($upsql);
			}
			//====== save payroll parameters for month =======//


			ob_clean();
			echo 'success';
		}

	}else{
		ob_clean();
		echo 'Please choose model';
	}
?>
