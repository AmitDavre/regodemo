<?php
	if(session_id()==''){session_start(); ob_start();}
	include('../../../dbconnect/db_connect.php');
	include(DIR.'files/functions.php');
	include(DIR.'files/payroll_functions.php');

	$SSOnewcal = getSSOEmpRate($cid);
	$sso_rate_emp = $SSOnewcal['rate']/100;
	$max_sso = $SSOnewcal['max'];
	$min_sso = $SSOnewcal['min'];

	$sso_rate_com = $SSOnewcal['crate']/100;
	$max_sso_com = $SSOnewcal['cmax'];
	$min_sso_com = $SSOnewcal['cmin'];

	$getAllowandDeductInfo = getAllowandDeductInfo();
	$cur_month = $_SESSION['rego']['cur_month'];
	$remaining_months = 12 - (int)$_SESSION['rego']['cur_month'] + 1;

	//echo '<pre>';
	//print_r($_REQUEST);
	///print_r($getAllowandDeductInfo);
	//echo '</pre>';

	//die('stop');

	$totals_array = array();
	$data = array();
	$sessionpayrollDbase = $_SESSION['rego']['cid'].'_payroll_'.$_SESSION['rego']['cur_year'];

	foreach($_REQUEST['emp'] as $key => $value) {

		foreach($value['total'] as $k1 => $v1) {

			//=== Salary ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'inc_sal'){
				$totals_array[$key]['inc_sal'][] = $v1;
			}

			//=== Overtime ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'inc_ot'){
				$totals_array[$key]['inc_ot'][] = $v1;
			}

			//=== Fixed income ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'inc_fix'){
				$totals_array[$key]['inc_fix'][] = $v1;
			}

			//=== Variable income ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'inc_var'){
				$totals_array[$key]['inc_var'][] = $v1;
			}

			//=== Other income ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'inc_oth'){
				$totals_array[$key]['inc_oth'][] = $v1;
			}

			//=== Absence ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'ded_abs'){
				$totals_array[$key]['ded_abs'][] = $v1;
			}

			//=== Fixed deductions ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'ded_fix'){
				$totals_array[$key]['ded_fix'][] = $v1;
			}

			//=== Variable deductions ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'ded_var'){
				$totals_array[$key]['ded_var'][] = $v1;
			}

			//=== Other deductions ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'ded_oth'){
				$totals_array[$key]['ded_oth'][] = $v1;
			}

			//=== Legal deductions / Loans ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'ded_leg'){
				$totals_array[$key]['ded_leg'][] = $v1;
			}

			//=== Advanced payments ===//
			if($getAllowandDeductInfo[$k1]['group'] == 'ded_pay'){
				$totals_array[$key]['ded_pay'][] = $v1;
			}

			//=== Total earnings ===//
			if($getAllowandDeductInfo[$k1]['earnings'] == 1){
				$totals_array[$key]['earnings'][] = $v1;
			}

			//=== Total deductions ===//
			if($getAllowandDeductInfo[$k1]['deductions'] == 1){
				$totals_array[$key]['deductions'][] = $v1;
			}

			//=== Total PND1 ===//
			if($getAllowandDeductInfo[$k1]['pnd1'] == 1){
				$totals_array[$key]['pnd1'][] = $v1;
			}

			//=== Total SSO ===//
			if($getAllowandDeductInfo[$k1]['sso'] == 1){
				$totals_array[$key]['sso'][] = $v1;
			}

			//=== Total PVF ===//
			if($getAllowandDeductInfo[$k1]['pvf'] == 1){
				$totals_array[$key]['pvf'][] = $v1;
			}

			//=== Total PSF ===//
			if($getAllowandDeductInfo[$k1]['psf'] == 1){
				$totals_array[$key]['psf'][] = $v1;
			}

			//=== Total Tax income ===//
			if($getAllowandDeductInfo[$k1]['tax_income'] == 1){
				$totals_array[$key]['tax_income'][] = $v1;
			}

			//=== Tax base (fixpro) ===//
			if($getAllowandDeductInfo[$k1]['tax_base'] == 'fixpro'){
				$totals_array[$key]['fixpro'][] = $v1;
			}

			//=== Tax base (fix) ===//
			if($getAllowandDeductInfo[$k1]['tax_base'] == 'fix'){
				$totals_array[$key]['fix'][] = $v1;
			}

			//=== Tax base (var) ===//
			if($getAllowandDeductInfo[$k1]['tax_base'] == 'var'){
				$totals_array[$key]['var'][] = $v1;
			}

			//=== Tax base (nontax) ===//
			if($getAllowandDeductInfo[$k1]['tax_base'] == 'nontax'){
				$totals_array[$key]['nontax'][] = $v1;
			}
		}

		$salary_group_total = isset($totals_array[$key]['inc_sal']) ? array_sum($totals_array[$key]['inc_sal']) : 0;
		$overtime_group_total = isset($totals_array[$key]['inc_ot']) ? array_sum($totals_array[$key]['inc_ot']) : 0;
		$fix_income_group_total = isset($totals_array[$key]['inc_fix']) ? array_sum($totals_array[$key]['inc_fix']) : 0;
		$var_income_group_total = isset($totals_array[$key]['inc_var']) ? array_sum($totals_array[$key]['inc_var']) : 0;
		$other_income_group_total = isset($totals_array[$key]['inc_oth']) ? array_sum($totals_array[$key]['inc_oth']) : 0;
		$absence_group_total = isset($totals_array[$key]['ded_abs']) ? array_sum($totals_array[$key]['ded_abs']) : 0;
		$fix_ded_group_total = isset($totals_array[$key]['ded_fix']) ? array_sum($totals_array[$key]['ded_fix']) : 0;
		$var_ded_group_total = isset($totals_array[$key]['ded_var']) ? array_sum($totals_array[$key]['ded_var']) : 0;
		$other_ded_group_total = isset($totals_array[$key]['ded_oth']) ? array_sum($totals_array[$key]['ded_oth']) : 0;
		$legal_ded_group_total = isset($totals_array[$key]['ded_leg']) ? array_sum($totals_array[$key]['ded_leg']) : 0;
		$advance_pay_group_total = isset($totals_array[$key]['ded_pay']) ? array_sum($totals_array[$key]['ded_pay']) : 0;

		$total_earnings = isset($totals_array[$key]['earnings']) ? array_sum($totals_array[$key]['earnings']) : 0;
		$total_deductions = isset($totals_array[$key]['deductions']) ? array_sum($totals_array[$key]['deductions']) : 0;
		$total_pnd1 = isset($totals_array[$key]['pnd1']) ? array_sum($totals_array[$key]['pnd1']) : 0;
		$total_sso = isset($totals_array[$key]['sso']) ? array_sum($totals_array[$key]['sso']) : 0;
		$total_pvf = isset($totals_array[$key]['pvf']) ? array_sum($totals_array[$key]['pvf']) : 0;
		$total_psf = isset($totals_array[$key]['psf']) ? array_sum($totals_array[$key]['psf']) : 0;
		$total_tax_income = isset($totals_array[$key]['tax_income']) ? array_sum($totals_array[$key]['tax_income']) : 0;

		$total_tax_fixpro = isset($totals_array[$key]['fixpro']) ? array_sum($totals_array[$key]['fixpro']) : 0;
		$total_tax_fix = isset($totals_array[$key]['fix']) ? array_sum($totals_array[$key]['fix']) : 0;
		$total_tax_var = isset($totals_array[$key]['var']) ? array_sum($totals_array[$key]['var']) : 0;
		$total_tax_nontax = isset($totals_array[$key]['nontax']) ? array_sum($totals_array[$key]['nontax']) : 0;

		$total_of_alltax = $total_tax_fixpro + $total_tax_fix + $total_tax_var + $total_tax_nontax;

		//============ fetch payroll data for the month ================//
		$getpayroll = $dbc->query("SELECT * FROM ".$sessionpayrollDbase." WHERE emp_id = '".$key."' AND month = '".$_SESSION['rego']['cur_month']."' ");
		if($getpayroll->num_rows > 0){
			while($row = $getpayroll->fetch_assoc()){
				$data[$row['emp_id']] = $row;
			}

			$empinfo = getEmployeeInfo($cid, $key);

			$psf_emp = 0;
			$psf_com = 0;
			if($empinfo['calc_psf']){
				if($empinfo['perc_thb_psf'] == 2){
					$psf_emp = $empinfo['contri_emple_psf'];
					$psf_com = $empinfo['contri_emplyer_psf'];
				}else{
					$psf_emp = ($total_psf * $empinfo['contri_emple_psf'])/100;
					$psf_com = ($total_psf * $empinfo['contri_emplyer_psf'])/100;
				}
			}

			$pvf_emp = 0;
			$pvf_com = 0;
			if($empinfo['calc_pvf']){
				if($empinfo['perc_thb_pvf'] == 2){
					$pvf_emp = $empinfo['contri_emple_pvf'];
					$pvf_com = $empinfo['contri_emplyer_pvf'];
				}else{
					$pvf_emp = ($total_pvf * $empinfo['contri_emple_pvf'])/100;
					$pvf_com = ($total_pvf * $empinfo['contri_emplyer_pvf'])/100;
				}
			}


			$sso_emp = 0;
			$sso_com = 0;
			if($data[$key]['calc_sso']){
				$sso_emp = ($total_sso * $sso_rate_emp);
				$sso_emp = ($sso_emp > $max_sso ? $max_sso : $sso_emp);
				$sso_emp = ($sso_emp < $min_sso ? $min_sso : $sso_emp);
				$sso_emp = $sso_emp;

				$sso_com = ($total_sso * $sso_rate_com);
				$sso_com = ($sso_com > $max_sso_com ? $max_sso_com : $sso_com);
				$sso_com = ($sso_com < $min_sso_com ? $min_sso_com : $sso_com);
				$sso_com = $sso_com;
			}

			//========== Fetch all previous month data ================//

			$salary_group_total_prev = 0;
			$overtime_group_total_prev = 0;
			$fix_income_group_total_prev = 0;
			$var_income_group_total_prev = 0;
			$other_income_group_total_prev = 0;
			$absence_group_total_prev = 0;
			$fix_ded_group_total_prev = 0;
			$var_ded_group_total_prev = 0;
			$other_ded_group_total_prev = 0;
			$legal_ded_group_total_prev = 0;
			$advance_pay_group_total_prev = 0;

			$total_sso_prev = 0;
			$total_pvf_prev = 0;
			$total_psf_prev = 0;
			$total_tax_income_prev = 0;

			$total_tax_fixpro_prev = 0;
			$total_tax_fix_prev = 0;
			$total_tax_var_prev = 0;
			$total_tax_nontax_prev = 0;
			$total_of_alltax_prev = 0;

			if($cur_month > 1){

				if($result = $dbc->query("SELECT basic_salary, salary, salary_group_total, overtime_group_total, fix_income_group_total, var_income_group_total, other_income_group_total, absence_group_total, fix_ded_group_total, var_ded_group_total, other_ded_group_total, legal_ded_group_total, advance_pay_group_total, total_sso, total_pvf, total_psf, total_tax_income, total_tax_fixpro, total_tax_fix, total_tax_var, total_tax_nontax, total_of_alltax FROM ".$sessionpayrollDbase." WHERE emp_id = '".$key."' AND month < '".$cur_month."'")){
					while($prev = $result->fetch_object()){
						$total_sso_prev += $prev->total_sso;
						$total_pvf_prev += $prev->total_pvf;	
						$total_psf_prev += $prev->total_psf;	
						$total_tax_income_prev += $prev->total_tax_income;	
						$salary_group_total_prev += $prev->salary_group_total;	
						$overtime_group_total_prev += $prev->overtime_group_total;	
						$fix_income_group_total_prev += $prev->fix_income_group_total;	
						$var_income_group_total_prev += $prev->var_income_group_total;	
						$other_income_group_total_prev += $prev->other_income_group_total;	
						$absence_group_total_prev += $prev->absence_group_total;	
						$fix_ded_group_total_prev += $prev->fix_ded_group_total;	
						$var_ded_group_total_prev += $prev->var_ded_group_total;	
						$other_ded_group_total_prev += $prev->other_ded_group_total;	
						$legal_ded_group_total_prev += $prev->legal_ded_group_total;	
						$advance_pay_group_total_prev += $prev->advance_pay_group_total;	
						$total_tax_fixpro_prev += $prev->total_tax_fixpro;	
						$total_tax_fix_prev += $prev->total_tax_fix;	
						$total_tax_var_prev += $prev->total_tax_var;	
						$total_tax_nontax_prev += $prev->total_tax_nontax;	
						$total_of_alltax_prev += $prev->total_of_alltax;	
					}
				}else{
					var_dump(mysqli_error($dbc));
				}
			}

			//========== Yearly calculation =================//

			$fixed_prorated_yearly = $total_tax_fixpro * 12;
			$fixed_yearly = $fixed_prorated_yearly + $total_tax_fix;

			$fixed_actual_prorated_yearly = ($total_tax_fixpro_prev + $total_tax_fixpro) * $remaining_months;
			$fixed_actual_yearly = $fixed_actual_prorated_yearly + $total_tax_fix_prev + $total_tax_fix;

			$variable_prev = $total_tax_var_prev;
			$variable_curr = $total_tax_var;

			$income_YTD = $total_of_alltax_prev + $total_of_alltax;

			//============ Yearly Tax Deduction ================//

			$total_yearly_standard_deduction = $data[$key]['tax_standard_deduction'];
			if($data[$key]['calc_on_sd']){
				$calc_standard_deduction = ($fixed_actual_yearly * (50/100));
				if($calc_standard_deduction <= 100000){
					$total_yearly_standard_deduction = $calc_standard_deduction;
				}else{
					$total_yearly_standard_deduction = 100000;
				}
			}

			$total_yearly_personal_care = $data[$key]['tax_personal_allowance'];
			if($data[$key]['calc_on_pc']){
				$total_yearly_personal_care = ($total_pvf_prev + $total_pvf) * $remaining_months;
			}

			$total_yearly_provident_fund = $data[$key]['tax_allow_pvf'];
			if($data[$key]['calc_on_pf']){
				$calc_provident_fund = ($fixed_actual_yearly * (40/100));
				if($calc_provident_fund <= 60000){
					$total_yearly_provident_fund = $calc_provident_fund;
				}else{
					$total_yearly_provident_fund = 60000;
				}
			}

			$total_yearly_social_security_fund = $data[$key]['tax_allow_sso'];
			if($data[$key]['calc_on_ssf']){

				$calc_comming_month_sso = 0;
				$monthss = (int)$cur_month + 1;
				for ($i=$monthss; $i <= 12; $i++) { 
					$calc_comming_month_sso += $total_sso * $pperiods[$i]['sso_eRate'];
				}
				
				$total_yearly_social_security_fund = $total_sso_prev + $total_sso + $calc_comming_month_sso;
			}

			$total_other_tax_deductions = $data[$key]['total_other_tax_deductions'];
			$total_yearly_tax_deductions = ($total_yearly_standard_deduction + $total_yearly_personal_care + $total_yearly_provident_fund + $total_yearly_social_security_fund + $total_other_tax_deductions);

			$upsql = "UPDATE ".$sessionpayrollDbase." SET paid_days = '".$value['paidDays']."', paid_hours = '".$value['paidHours']."', manual_feed_data = '".serialize($value['allow_deduct'])."', manual_feed_total = '".serialize($value['total'])."' WHERE emp_id = '".$key."' AND month = '".$_SESSION['rego']['cur_month']."' ";
			/*$upsql = "UPDATE ".$sessionpayrollDbase." SET basic_salary = '".$value['basicSal']."', salary = '".$value['basicSal']."', paid_days = '".$value['paidDays']."', paid_hours = '".$value['paidHours']."', manual_feed_data = '".serialize($value['allow_deduct'])."', manual_feed_total = '".serialize($value['total'])."', `salary_group_total`='".$salary_group_total."', `overtime_group_total`='".$overtime_group_total."', `fix_income_group_total`='".$fix_income_group_total."', `var_income_group_total`='".$var_income_group_total."', `other_income_group_total`='".$other_income_group_total."', `absence_group_total`= '".$absence_group_total."', `fix_ded_group_total`='".$fix_ded_group_total."', `var_ded_group_total`='".$var_ded_group_total."', `other_ded_group_total`='".$other_ded_group_total."', `legal_ded_group_total`='".$legal_ded_group_total."', `advance_pay_group_total`='".$advance_pay_group_total."', `total_earnings`='".$total_earnings."', `total_deductions`='".$total_deductions."', `total_pnd1`='".$total_pnd1."', `total_sso`='".$total_sso."', `total_pvf`='".$total_pvf."', `total_psf`='".$total_psf."', total_tax_income = '".$total_tax_income."', `total_tax_fixpro`='".$total_tax_fixpro."', `total_tax_fix`='".$total_tax_fix."', `total_tax_var`='".$total_tax_var."', `total_tax_nontax`='".$total_tax_nontax."', `total_of_alltax`='".$total_of_alltax."', sso_rate_emp = '".$sso_emp."', sso_rate_com = '".$sso_com."', pvf_rate_emp='".$pvf_emp."', pvf_rate_com='".$pvf_com."', psf_rate_emp='".$psf_emp."', psf_rate_com='".$psf_com."', `salary_group_total_prev`='".$salary_group_total_prev."', `overtime_group_total_prev`='".$overtime_group_total_prev."', `fix_income_group_total_prev`='".$fix_income_group_total_prev."', `var_income_group_total_prev`='".$var_income_group_total_prev."', `other_income_group_total_prev`='".$other_income_group_total_prev."', `absence_group_total_prev`='".$absence_group_total_prev."', `fix_ded_group_total_prev`='".$fix_ded_group_total_prev."', `var_ded_group_total_prev`='".$var_ded_group_total_prev."', `other_ded_group_total_prev`='".$other_ded_group_total_prev."', `legal_ded_group_total_prev`='".$legal_ded_group_total_prev."', `advance_pay_group_total_prev`='".$advance_pay_group_total_prev."', `total_sso_prev`='".$total_sso_prev."', `total_pvf_prev`='".$total_pvf_prev."', `total_psf_prev`='".$total_psf_prev."', `total_tax_income_prev`='".$total_tax_income_prev."', `total_tax_fixpro_prev`='".$total_tax_fixpro_prev."', `total_tax_fix_prev`='".$total_tax_fix_prev."', `total_tax_var_prev`='".$total_tax_var_prev."', `total_tax_nontax_prev`='".$total_tax_nontax_prev."', `total_of_alltax_prev`='".$total_of_alltax_prev."', `fixed_prorated_yearly`='".$fixed_prorated_yearly."', `fixed_yearly`='".$fixed_yearly."', `fixed_actual_prorated_yearly`='".$fixed_actual_prorated_yearly."', `fixed_actual_yearly`='".$fixed_actual_yearly."', `variable_prev`='".$variable_prev."', `variable_curr`='".$variable_curr."', `income_YTD`='".$income_YTD."', total_other_tax_deductions ='".$total_other_tax_deductions."', total_yearly_tax_deductions='".$total_yearly_tax_deductions."' WHERE emp_id = '".$key."' AND month = '".$_SESSION['rego']['cur_month']."' ";*/
			$dbc->query($upsql);
		}
	}

	//die('jjjj');

	ob_clean();
	echo 'success';

?>