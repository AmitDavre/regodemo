<?php
	
	if(session_id()==''){session_start();}
	ob_start();
	include('../../dbconnect/db_connect.php');
	include(DIR.'files/payroll_functions.php');

	$empIds = $_REQUEST['empid'];
	$implodeids = implode(',', $empIds);
	$strempids = str_replace(',', "','", $implodeids);
	$sessionpayrollDbase = $_SESSION['rego']['cid'].'_payroll_'.$_SESSION['rego']['cur_year'];

	$data = array();
	$res = $dbc->query("SELECT * FROM ".$_SESSION['rego']['cid']."_employees WHERE emp_id IN('".$strempids."')");
	while($row = $res->fetch_assoc()){
		$data[] = $row;
	}

	if($data){

		foreach($data as $key => $row) {

			$getAllowances = getEmployeeAllowances($row['emp_id'],$_SESSION['rego']['curr_month']);
			$salary = $getAllowances[0]['salary'];
			$position = $getAllowances[0]['position'];

			$fix_allow_from_emp = $getAllowances[0]['fix_allow'];
			$fix_deduct_from_emp = $getAllowances[0]['fix_deduct'];

			if($row['calc_on_sd']==1){$tsd='';}else{$tsd=$row['tax_standard_deduction'];}
			if($row['calc_on_pc']==1){$tpa='';}else{$tpa=$row['tax_personal_allowance'];}
			if($row['calc_on_pf']==1){$tpf='';}else{$tpf=$row['tax_allow_pvf'];}
			if($row['calc_on_ssf']==1){$tsf='';}else{$tsf=$row['tax_allow_sso'];}
			$total_other_tax_deductions = $row['emp_tax_deductions'];

			$sql = "UPDATE ".$sessionpayrollDbase." SET position='".$position."', basic_salary='".$salary."', salary='".$salary."', fix_allow_from_emp='".$fix_allow_from_emp."', fix_deduct_from_emp='".$fix_deduct_from_emp."', calc_tax='".$row['calc_tax']."', calc_sso='".$row['calc_sso']."', sso_by='".$row['sso_by']."', calc_pvf='".$row['calc_pvf']."', calc_psf='".$row['calc_psf']."', calc_method='".$row['calc_method']."', perc_thb_pvf='".$row['perc_thb_pvf']."', pvf_rate_emp='".$row['contri_emple_pvf']."', pvf_rate_com='".$row['contri_emplyer_pvf']."', perc_thb_psf='".$row['perc_thb_psf']."', psf_rate_emp='".$row['contri_emple_psf']."', psf_rate_com='".$row['contri_emplyer_psf']."', contract_type='".$row['contract_type']."', calc_base='".$row['calc_base']."', other_income='".$row['other_income']."', severance='".$row['severance']."', notice_payment='".$row['notice_payment']."', remaining_salary='".$row['remaining_salary']."', gov_house_banking='".$row['gov_house_banking']."', savings='".$row['savings']."', legal_execution='".$row['legal_execution']."', kor_yor_sor='".$row['kor_yor_sor']."', paid_leave='".$row['paid_leave']."', modify_tax='".$row['modify_tax']."', calc_on_sd='".$row['calc_on_sd']."', calc_on_pc='".$row['calc_on_pc']."', calc_on_pf='".$row['calc_on_pf']."', calc_on_ssf='".$row['calc_on_ssf']."', tax_standard_deduction='".$tsd."', tax_personal_allowance='".$tpa."', tax_allow_pvf='".$tpf."', tax_allow_sso='".$tsf."', total_other_tax_deductions='".$total_other_tax_deductions."', paid='C' WHERE emp_id = '".$row['emp_id']."' AND month = '".$_SESSION['rego']['cur_month']."' ";
			$upEmpdata = $dbc->query($sql);

		}
		
		
		ob_clean();
		echo 'success';
	}else{
		ob_clean();
		echo 'error';
	}
?>






























































