<?
	if(session_id()==''){session_start();}
	ob_start();

	$emp_db['emp_id'] = $lng['Rego ID'];
	$emp_db['emp_id_editable'] = $lng['Employee ID'];
	$emp_db['sid'] = 'Scan ID';
	$emp_db['title'] = $lng['Title'];
	$emp_db['firstname'] = $lng['First name'];
	$emp_db['lastname'] = $lng['Last name'];
	$emp_db['en_name'] = $lng['Name in English'];
	$emp_db['birthdate'] = $lng['Birthdate'];
	$emp_db['nationality'] = $lng['Nationality'];
	$emp_db['gender'] = $lng['Gender'];
	$emp_db['maritial'] = $lng['Maritial status'];
	$emp_db['religion'] = $lng['Religion'];
	$emp_db['military_status'] = $lng['Military status'];
	$emp_db['height'] = $lng['Height'];
	$emp_db['weight'] = $lng['Weight'];
	$emp_db['bloodtype'] = $lng['Blood group'];
	$emp_db['drvlicense_nr'] = $lng['Driving license No.'];
	$emp_db['drvlicense_exp'] = $lng['License expiry date'];
	$emp_db['idcard_nr'] = $lng['ID card'];
	$emp_db['idcard_exp'] = $lng['ID card expiry date'];
	$emp_db['tax_id'] = $lng['Tax ID no.'];
	$emp_db['reg_address'] = $lng['Registered address'];
	$emp_db['sub_district'] = $lng['Sub district'];
	$emp_db['district'] = $lng['District'];
	$emp_db['province'] = $lng['Province'];
	$emp_db['postnr'] = $lng['Postal code'];
	$emp_db['country'] = $lng['Country'];
	$emp_db['cur_address'] = $lng['Current address'];
	$emp_db['personal_phone'] = $lng['Personal phone'];
	$emp_db['work_phone'] = $lng['Work phone'];
	$emp_db['personal_email'] = $lng['Personal email'];
	$emp_db['work_email'] = $lng['Work email'];
	$emp_db['workFromHome'] = $lng['Work From Home'];
	$emp_db['username_option'] = $lng['Username Options'];
	$emp_db['username'] = $lng['Username'];
	$emp_db['joining_date'] = $lng['Joining date'];
	$emp_db['probation_date'] = $lng['Probation due date'];
	$emp_db['entity'] = $lng['Company'];
	$emp_db['company'] = $lng['Company'];
	$emp_db['branch'] = $lng['location'];
	$emp_db['location'] = $lng['Location'];
	$emp_db['division'] = $lng['Division'];
	$emp_db['department'] = $lng['Department'];
	$emp_db['groups'] = $lng['Groups'];
	$emp_db['teams'] = $lng['Team'];
	$emp_db['team'] = $lng['Team'];
	$emp_db['emp_type'] = $lng['Employee type'];
	$emp_db['resign_date'] = $lng['Resign date'];
	$emp_db['resign_reason'] = $lng['Resign reason'];
	$emp_db['emp_status'] = $lng['Employee status'];
	$emp_db['account_code'] = $lng['Accounting code'];
	$emp_db['position'] = $lng['Position'];
	$emp_db['head_branch'] = $lng['Head of branch'];
	$emp_db['head_division'] = $lng['Head of division'];
	$emp_db['head_department'] = $lng['Head of department'];
	$emp_db['team_supervisor'] = $lng['Team supervisor'];
	$emp_db['date_position'] = $lng['Date start Position'];
	$emp_db['shiftplan'] = $lng['Shift schedule'];
	$emp_db['time_reg'] = $lng['Time registration'];
	$emp_db['selfie'] = $lng['Take selfie'];
	$emp_db['selfie'] = $lng['Take selfie'];
	$emp_db['annual_leave'] = $lng['Annual leave (days)'];
	$emp_db['leave_approve'] = $lng['Leave approved by'];
	
	

	$emp_db['contract_type'] = $lng['Contract type'];
	$emp_db['calc_base'] = $lng['Calculation base'];
	$emp_db['bank_code'] = $lng['Bank code'];
	$emp_db['bank_name'] = $lng['Bank name'];
	$emp_db['bank_branch'] = $lng['Bank branch'];
	$emp_db['bank_account'] = $lng['Bank account no.'];
	$emp_db['bank_account_name'] = $lng['Bank account name'];
	$emp_db['pay_type'] = $lng['Payment type'];
	$emp_db['calc_method'] = $lng['Tax calculation method'];
	$emp_db['calc_tax'] = $lng['Calculate Tax'];
	$emp_db['modify_tax'] = $lng['Modify Tax amount'];
	$emp_db['calc_sso'] = $lng['Calculate SSO'];
	$emp_db['sso_by'] = $lng['SSO paid by'];
	$emp_db['gov_house_banking'] = $lng['Government house banking'];
	$emp_db['savings'] = $lng['Savings'];
	$emp_db['legal_execution'] = $lng['Legal execution deduction'];
	$emp_db['kor_yor_sor'] = $lng['Kor.Yor.Sor (Student loan)'];
	
	$emp_db['tax_residency_status']='Tax Residency Status';
	$emp_db['income_section']='Income Section';
	
	
	$emp_db['start_date'] = $lng['Start Date'];
	$emp_db['unit_base'] = $lng['Unit Base'];
	$emp_db['base_salary'] = $lng['Basic salary'];
	$emp_db['calc_psf'] = $lng['Calculate PSF'];
	$emp_db['perc_thb_psf'] = $lng['% or THB'];
	$emp_db['contri_emple_psf'] = $lng['Contribution'].' Emp';
	$emp_db['contri_emplyer_psf'] = $lng['Contribution'].' Com';
	$emp_db['calc_pvf'] = $lng['Calculate PVF'];
	$emp_db['perc_thb_pvf'] = $lng['% or THB'];
	$emp_db['contri_emple_pvf'] = $lng['Contribution'].' Emp';
	$emp_db['contri_emplyer_pvf'] = $lng['Contribution'].' Com';
	$emp_db['pro_fndNo_pvf'] = $lng['Provident fund no.'];
	$emp_db['reg_date_pvf'] = $lng['PVF registration date'];


	$emp_db['tax_spouse'] = $lng['Spouse care'];
	$emp_db['tax_allow_spouse'] = $lng['allowance'];
	$emp_db['tax_parents'] = $lng['Parents care'];
	$emp_db['tax_allow_parents'] = $lng['allowance'];
	$emp_db['tax_parents_inlaw'] = $lng['Parents in law care'];
	$emp_db['tax_allow_parents_inlaw'] = $lng['allowance'];
	$emp_db['tax_child_bio'] = $lng['Child care - biological'];
	$emp_db['tax_allow_child_bio'] = $lng['allowance'];
	$emp_db['tax_child_bio_2018'] = $lng['Child care - biological 2018/19/20'];
	$emp_db['tax_allow_child_bio_2018'] = $lng['allowance'];
	$emp_db['tax_child_adopted'] = $lng['Child care - adopted'];
	$emp_db['tax_allow_child_adopted'] = $lng['allowance'];
	$emp_db['tax_allow_child_birth'] = $lng['Child birth (Baby bonus)'];
	$emp_db['tax_disabled_person'] = $lng['Care disabled person'];
	$emp_db['tax_allow_disabled_person'] = $lng['allowance'];
	$emp_db['tax_allow_home_loan_interest'] = $lng['Home loan interest'];	
	$emp_db['tax_allow_first_home'] = $lng['First home buyer'];
	$emp_db['tax_allow_donation_charity'] = $lng['Donation charity'];
	$emp_db['tax_allow_donation_education'] = $lng['Donation education'];	
	$emp_db['tax_allow_donation_flood'] = $lng['Donation flooding'];
	$emp_db['tax_allow_own_health'] = $lng['Own health insurance'];
	$emp_db['tax_allow_health_parents'] = $lng['Health insurance parents'];
	$emp_db['tax_allow_own_life_insurance'] = $lng['Own life insurance'];
	$emp_db['tax_allow_life_insurance_spouse'] = $lng['Life insurance spouse'];
	$emp_db['tax_allow_pension_fund'] = $lng['Pension fund'];	
	$emp_db['tax_allow_rmf'] = $lng['RMF'];
	$emp_db['tax_allow_ltf'] = $lng['LTF'];
	$emp_db['tax_exemp_disabled_under'] = $lng['Exemption disabled person <65 yrs'];
	$emp_db['tax_allow_exemp_disabled_under'] = $lng['allowance'].' (THB)';	
	$emp_db['tax_exemp_payer_older'] = $lng['Exemption tax payer => 65yrs'];	
	$emp_db['tax_allow_exemp_payer_older'] = $lng['allowance'].' (THB)';	
	$emp_db['tax_allow_domestic_tour'] = $lng['Domestic tour'];
	$emp_db['tax_allow_year_end_shopping'] = $lng['Year-end shopping'];
	$emp_db['tax_allow_other'] = $lng['Other allowance'];
	$emp_db['tax_health_parents'] = $lng['Health insurance parents'];
	$emp_db['tax_allow_nsf'] = $lng['NSF'];
	
	$emp_db['att_idcard'] = $lng['ID card'];
	$emp_db['att_housebook'] = $lng['Housebook'];
	$emp_db['att_bankbook'] = $lng['Bankbook'];
	$emp_db['att_contract'] = $lng['Contract'];
	$emp_db['attach1'] = $lng['Additional file'];
	$emp_db['attach2'] = $lng['Additional file'];