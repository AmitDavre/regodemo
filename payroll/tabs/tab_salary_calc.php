<style type="text/css">
	
	#tab_SalaryCalc table.salcal tbody th, table.salcal tbody td, table.salcal thead th{
		font-size:12px;
		padding: 3px !important;
	}

	#modalTAXDeduction input[type=text], #modalTAXDeduction input[type=text]:hover {
	    width: 80px!important;
	}

	#modalTAXDeduction table.basicTable tbody td{
	    padding: 4px 4px !important;
	}
	.overhang-close{
		display: none;
	}

	.borderCls{
		background: #ffff004a !important;
	}

	table.dataTable thead .sorting_asc:after {
	    content: "";
	}


</style>

<div style="height:100%; border:0px solid red; position:relative;">
	<div>
		<div class="smallNav">
			<ul>
				<li>
					<div class="searchFilter" style="margin:0">
						<input placeholder="Filter" id="searchFiltersc" class="sFilter" type="text">
						<button id="clearSearchboxsc" type="button" class="clearFilter btn btn-default btn-sm"><i class="fa fa-times"></i></button>
					</div>
				</li>	

			</ul>
		</div>
	</div>
	
	<table id="SalaryCalc" class="dataTable hoverable selectable">
		<thead>
			<tr>
				<th colspan="5" class="tac"><?=$lng['Employee']?></th>
				<th colspan="4" class="tac"><?=$lng['Income']?></th>				
				<th colspan="6" class="tac"><?=$lng['Calculations']?></th>
				<th colspan="4" class="tac"><?=$lng['Income Totals For']?></th>		
				<!-- <th colspan="11" class="tac"><?=$lng['Income groups']?></th>	 -->	
				
			</tr>
			<tr>
				<th class="tal"><?=$lng['Emp. ID']?></th>
				<th class="tal" style="width: 130px;"><?=$lng['Employee name']?></th>
				<th class="tal" style="cursor: pointer;">
					<i data-toggle="tooltip" title="Select all" class="Selallemp fa fa-thumbs-up fa-lg"></i>
					<i data-toggle="tooltip" title="Unselect all" class="unSelallemp fa fa-thumbs-down fa-lg" style="display:none;"></i>
				</th>
				<th class="tal" style="cursor: pointer;">
					<i data-toggle="tooltip" title="Calculator" class="fa fa-calculator fa-lg" ></i>
				</th>
				<th class="tac"><?=$lng['Paid'].'<br>'.$lng['days']?></th>

				<th class="tac"><?=$lng['Earnings']?></th>
				<th class="tac"><?=$lng['Deductions']?></th>
				<th class="tac"><?=$lng['Net Income']?></th>
				<th class="tac"><?=$lng['Net pay']?></th>

				<th class="tac"><?=$lng['SSO Employee']?></th>
				<th class="tac"><?=$lng['Tax']?></th>
				<th class="tac"><?=$lng['PVF']?></th>
				<th class="tac"><?=$lng['PSF']?></th>
				<th class="tac"><?=$lng['SSO by company']?></th>
				<th class="tac"><?=$lng['Tax by company']?></th>

				<th class="tac"><?=$lng['PVF']?></th>
				<th class="tac"><?=$lng['PSF']?></th>
				<th class="tac"><?=$lng['SSO']?></th>
				<th class="tac"><?=$lng['PND']?></th>

			</tr>
		</thead>
		<tbody>
			<? foreach($getSelmonPayrollDatass as $key => $row){
					if($row['contract_type'] == 'month'){$pd=$row['paid_days'];}elseif($row['contract_type'] == 'day'){
						$pdHrs = $row['mf_paid_hour'];
						if($pdHrs !=''){
							$pdHrstot = decimalHours($pdHrs);
							$pds = $row['paid_days'] + ($pdHrstot/24);
							$pd = round($pds,2);
						}else{
							$pd=$row['paid_days'];
						}
					}else{$pd='';}
			?>

				<tr data-empid="<?=$row['emp_id']?>">
					<td class="pad010 pl-2 font-weight-bold" style="cursor: pointer;color:#900"><?=$row['emp_id']?></td>
					<td class="pad010 pl-2 font-weight-bold" style="cursor: pointer;color:#900"><?=$row['emp_name_'.$lang]?></td>
					<td class="tac">
						<input type="checkbox" class="checkbox-custom-blue empchkbox" name="sel_all[]" value="<?=$row['emp_id']?>" style="left:0px !important;">
					</td>
					<td>
						<a onclick="Opencalculationpopups(this)" id="<?=$row['emp_id']?>"><i class="fa fa-calculator fa-lg" ></i></a>
					</td>
					<td><?=$pd?></td>
					<td class="tar"><?=number_format($row['total_earnings'],2);?></td>
					<td class="tar"><?=number_format($row['total_deductions'],2);?></td>
					<td class="tar"><?=number_format($row['total_net_income'],2);?></td>
					<td class="tar"><?=number_format($row['total_net_pay'],2);?></td>

					<td class="tar"><?=number_format($row['sso_employee'],2);?></td>
					<td class="tar"><?=number_format($row['tax_this_month'],2);?></td>
					<td class="tar"><?=number_format($row['pvf_employee'],2);?></td>
					<td class="tar"><?=number_format($row['psf_employee'],2);?></td>
					<td class="tar"><?=number_format($row['sso_by_company'],2);?></td>
					<td class="tar"><?=number_format($row['tax_by_company'],2);?></td>

					<td class="tar"><?=number_format($row['total_pvf'],2);?></td>
					<td class="tar"><?=number_format($row['total_psf'],2);?></td>
					<td class="tar"><?=number_format($row['total_sso'],2);?></td>
					<td class="tar"><?=number_format($row['total_pnd1'],2);?></td>
					
				</tr>

			<? } ?>
		</tbody>
	</table>

	<div class="row">
		<div class="col-md-2" style="margin: -30px 0px 0px 0px;margin-left: auto;margin-right: auto;">
			<select id="pageLengthsc" class="button btn-fl">
				<option selected value="">Rows / page</option>
				<option value="10">10 Rows / page</option>
				<option value="15">15 Rows / page</option>
				<option value="20">20 Rows / page</option>
				<option value="30">30 Rows / page</option>
				<option value="40">40 Rows / page</option>
				<option value="50">50 Rows / page</option>
			</select>
		</div>
	</div>
</div>

<div class="modal fade" id="Salarycalculator" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="top: 0px;">
	<div class="modal-dialog modal-xl" role="document" style="min-width: 1350px !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 5px 13px">
				<h5 class="modal-title" style="padding: 0px;"><i class="fa fa-calculator"></i>&nbsp; <?=$lng['Calculate Payroll']?></h5>
				<div style=" position:absolute; right:40px; padding:3px 0">
					<a title="Print" href="#" style="margin-right:5px"><i class="fa fa-print fa-lg" style="margin-top: 5px;"></i></a>
				</div>
				<a title="Close" type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times text-danger"></i></a>
			</div>
			<div class="modal-body mb-4" style="padding: 5px 20px 5px !important;overflow: hidden;overflow-y: scroll;">

				<table class="basicTable salcal" border="0" style="width: 100%;">
					<tbody>
						<tr>
							<th class="pl-2"><?=$lng['Emp. ID']?></th>
							<td class="pl-2" id="empids"></td>
							<th class="pl-2"><?=$lng['Department']?></th>
							<td class="pl-2" id="deptval"></td>
							<th class="pl-2"><?=$lng['Contract type']?></th>
							<td class="pl-2" id="contract_type"></td>
							<th class="pl-2"><?=$lng['Calculate Tax']?></th>
							<td class="pl-2" id="calc_tax"></td>
							
						</tr>
						<tr>
							<th class="pl-2"><?=$lng['Employee name']?></th>
							<td class="pl-2" id="emp_name"></td>
							<th class="pl-2"><?=$lng['Teams']?></th>
							<td class="pl-2" id="teamval"></td>
							<th class="pl-2"><?=$lng['Tax calculation method']?></th>
							<td class="pl-2" id="tax_calc_method"></td>
							<th class="pl-2"><?=$lng['Calculate SSO']?></th>
							<td class="pl-2" id="calc_sso"></td>
							
														
						</tr>
						<tr>
							<th class="pl-2"><?=$lng['Position']?></th>
							<td class="pl-2" id="position_val"></td>
							<th class="pl-2"></th>
							<td class="pl-2"></td>
							<th class="pl-2"><?=$lng['Calculation base']?></th>
							<td class="pl-2" id="calc_base"></td>

							<th class="pl-2" id="pvfpsfLbl"></th>
							<td class="pl-2" id="calc_pvf"></td>
							<!-- <th class="pl-2"><?=$lng['Calculate PSF']?></th>
							<td class="pl-2" id="calc_psf"></td> -->
						</tr>
					</tbody>
				</table>

				<div class="row">
					<div class="col-md-4" style="padding-right: 0px;max-width:41%;">
						<table id="getlinkeddata" class="basicTable salcal" border="0" style="width: 100%;">
							<thead>
								<tr>
									<th class="tac text-danger"><?=strtoupper($lng['Summary'])?></th>
									<th colspan="6" class="tac text-danger"><?=strtoupper($lng['Click amount to see detail'])?></th>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Description']?></th>
									<th class="tal"><?=$lng['Calc']?></th>
									<th class="tal"><?=$lng['Curr'].' '.$lng['Calc']?></th>
									<th class="tal"><?=$lng['Prev'].' '.$lng['Calc']?></th>
									<th class="tal"><?=$lng['Curr'].' '.$lng['Month']?></th>
									<th class="tal"><?=$lng['Prev'].' '.$lng['Month']?></th>
									<th class="tal"><?=$lng['Full year']?></th>
								</tr>
							</thead>
							<thead>
								<tr>
									<th colspan="7" class="tal"><?=strtoupper($lng['Total income'])?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th class="tal"><?=$lng['Earnings']?></th>
									<td></td>
									<td class="tar" id="ear_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="ear_curr_mnth"></td>
									<td class="tar" id="ear_prev_mnth"></td>
									<td class="tar" id="ear_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Deductions']?></th>
									<td></td>
									<td class="tar" id="ded_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="ded_curr_mnth"></td>
									<td class="tar" id="ded_prev_mnth"></td>
									<td class="tar" id="ded_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Income'].' '.$lng['PND']?></th>
									<td></td>
									<td class="tar" id="pnd_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="pnd_curr_mnth"></td>
									<td class="tar" id="pnd_prev_mnth"></td>
									<td class="tar" id="pnd_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Income'].' '.$lng['SSO']?></th>
									<td></td>
									<td class="tar" id="sso_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="sso_curr_mnth"></td>
									<td class="tar" id="sso_prev_mnth"></td>
									<td class="tar" id="sso_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Income'].' '.$lng['PVF']?></th>
									<td></td>
									<td class="tar" id="pvf_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="pvf_curr_mnth"></td>
									<td class="tar" id="pvf_prev_mnth"></td>
									<td class="tar" id="pvf_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Income'].' '.$lng['PSF']?></th>
									<td></td>
									<td class="tar" id="psf_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="psf_curr_mnth"></td>
									<td class="tar" id="psf_prev_mnth"></td>
									<td class="tar" id="psf_full_year"></td>
								</tr>
								
							</tbody>
							<thead>
								<tr>
									<th colspan="7" class="tal"><?=strtoupper($lng['Total']).' '.strtoupper($lng['Taxable income'])?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th class="tal"><?=$lng['Fixed pro rated']?></th>
									<td></td>
									<td class="tar" id="fixpro_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="fixpro_curr_mnth"></td>
									<td class="tar" id="fixpro_prev_mnth"></td>
									<td class="tar" id="fixpro_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Fixed']?></th>
									<td></td>
									<td class="tar" id="fix_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="fix_curr_mnth"></td>
									<td class="tar" id="fix_prev_mnth"></td>
									<td class="tar" id="fix_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Variable']?></th>
									<td></td>
									<td class="tar" id="var_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="var_curr_mnth"></td>
									<td class="tar" id="var_prev_mnth"></td>
									<td class="tar" id="var_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Total all taxable income']?></th>
									<td></td>
									<td class="tar" id="totalffv_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="totalffv_curr_mnth"></td>
									<td class="tar" id="totalffv_prev_mnth"></td>
									<td class="tar" id="totalffv_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Non-taxable']?></th>
									<td></td>
									<td class="tar" id="nontax_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="nontax_curr_mnth"></td>
									<td class="tar" id="nontax_prev_mnth"></td>
									<td class="tar" id="nontax_full_year"></td>
								</tr>
							</tbody>
							<thead>
								<tr>
									<th colspan="7" class="tal"><?=strtoupper($lng['Calculations'])?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th class="tal"><?=$lng['SSO Employee']?></th>
									<td>
										<a onclick="modal_sso();"><i class="fa fa-calculator fa-lg text-primary" ></i></a>
									</td>
									<td class="tar" id="sso_emp_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="sso_emp_curr_mnth"></td>
									<td class="tar" id="sso_emp_prev_mnth"></td>
									<td class="tar" id="sso_emp_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['PVF Employee']?></th>
									<td>
										<a onclick="modal_pvf();"><i class="fa fa-calculator fa-lg text-primary" ></i></a>
									</td>
									<td class="tar" id="pvf_emp_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="pvf_emp_curr_mnth"></td>
									<td class="tar" id="pvf_emp_prev_mnth"></td>
									<td class="tar" id="pvf_emp_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['PSF Employee']?></th>
									<td>
										<a onclick="modal_psf();"><i class="fa fa-calculator fa-lg text-primary"></i></a>
									</td>
									<td class="tar" id="psf_emp_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="psf_emp_curr_mnth"></td>
									<td class="tar" id="psf_emp_prev_mnth"></td>
									<td class="tar" id="psf_emp_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Tax']?></th>
									<td>
										<a onclick="modal_tax();"><i class="fa fa-calculator fa-lg text-primary" ></i></a>
									</td>
									<td class="tar" id="tax_emp_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="tax_emp_curr_mnth"></td>
									<td class="tar" id="tax_emp_prev_mnth"></td>
									<td class="tar" id="tax_emp_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Tax deductions']?></th>
									<td>
										<a onclick="modal_tax_deduction();"><i class="fa fa-calculator fa-lg text-primary" ></i></a>
									</td>
									<td class="tar" id="td_emp_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="td_emp_curr_mnth"></td>
									<td class="tar" id="td_emp_prev_mnth"></td>
									<td class="tar" id="td_emp_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Tax by company']?></th>
									<td></td>
									<td class="tar" id="taxbycom_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="taxbycom_curr_mnth"></td>
									<td class="tar" id="taxbycom_prev_mnth"></td>
									<td class="tar" id="taxbycom_full_year"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['SSO by company']?></th>
									<td></td>
									<td class="tar" id="ssobycom_curr_calc"></td>
									<td class="tar" ></td>
									<td class="tar" id="ssobycom_curr_mnth"></td>
									<td class="tar" id="ssobycom_prev_mnth"></td>
									<td class="tar" id="ssobycom_full_year"></td>
								</tr>
								<tr style="pointer-events: none;">
									<th class="tal"><?=$lng['Net Income']?></th>
									<td></td>
									<td class="tar" id="total_net_income_cur_cal"></td>
									<td class="tar" ></td>
									<td class="tar" id="total_net_income_cur_mnth"></td>
									<td class="tar" id="total_net_income_prev_mnth"></td>
									<td class="tar" id="total_net_income_fullyear"></td>
								</tr>
								<tr style="pointer-events: none;">
									<th class="tal"><?=$lng['Net pay']?></th>
									<td></td>
									<td class="tar" id="total_net_pay_cur_cal"></td>
									<td class="tar" ></td>
									<td class="tar" id="total_net_pay_cur_mnth"></td>
									<td class="tar" id="total_net_pay_prev_mnth"></td>
									<td class="tar" id="total_net_pay_fullyear"></td>
								</tr>
							</tbody>

						</table>
					</div>

					<div id="Bothtable" class="col-md-8 table-responsive" style="padding-left: 0px;max-width:58%;border-left: 1px solid #ccc;">
						<table id="linkedcolumnsSC" class="basicTable salcal" border="0" style="width: 100%;">
							
						</table>

						<!-- <div class="row ml-1" id="hidediv2" style="background-color: #fff;margin-bottom: 11px;padding-bottom: 12px;">
							<table class="table-responsive" id="scrolltable">
								<tbody><tr>
									<td style="visibility: hidden;">
										 aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
									</td>
								</tr>
							</tbody></table>
						</div> -->

						<table id="linkedcolumnsSCD" class="basicTable salcal" border="0" style="width: 100%;">
							
						</table>
					</div>

				</div>

			</div>
			<!--<div class="modal-footer">
				<button class="btn btn-primary btn-fr" type="button" data-dismiss="modal"><?=$lng['Cancel']?></button>
				 <button class="btn btn-primary ml-1 " type="button"><i class="fa fa-save mr-1"></i> <?=$lng['Save']?></button>
			</div>-->
		</div>
	</div>
</div>


<!-------------------- modalSSO --------------------->
<div class="modal fade" id="modalSSO" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document" style="min-width: 700px !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 5px 13px;background: darkgray;">
				<h5 class="modal-title" style="padding: 0px;"><i class="fa fa-calculator"></i>&nbsp; <?=$lng['Calculate SSO']?></h5>
				<a title="Close" type="button" class="close closebtn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times text-danger"></i></a>
			</div>
			<div class="modal-body" style="padding: 5px 20px 5px !important;background: #efe;">
				
				<table class="basicTable" border="0" style="width: 100%;">
					<thead>
						<tr>
							<th colspan="6" class="tac text-danger p-1"><?=$lng['SSO CALCULATION']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['Emp. ID']?></th>
							<td id="sso_empid"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['Calculate SSO']?></th>
							<td id="sso_calc_sso" style="background:#fdf4bd;padding: 0px !important;">
								<select name="ss_calc_sso" id="sss_calc_sso" style="padding: 0px !important;background:#fdf4bd;" onchange="SSO_calc(this)">
									<? foreach($noyes01 as $k => $v){?>
										<option value="<?=$k?>"><?=$v?></option>
									<? } ?>
								</select>
							</td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Employee name']?></th>
							<td id="sso_empname"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['SSO paid by']?></th>
							<td id="sso_sso_paidby" style="background:#fdf4bd;padding: 0px !important;">
								<select name="ss_paidby_sso" id="sss_paidby_sso" style="padding: 0px !important;background:#fdf4bd;" onchange="SSO_calc(this)">
									<? foreach($sso_paidby as $k => $v){ ?>
										<option value="<?=$k?>"><?=$v?></option>
									<? } ?>
								</select>
							</td>
						</tr>
					</tbody>

					<thead class="mt-3">
						<tr>
							<th colspan="6" class="tal text-danger p-1"><?=$lng['Calculation employee contribution']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['SSO'].' '.$lng['Income']?></th>
							<td id="sso_total_sso_emp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['SSO rate employee']?></th>
							<td id="sso_rate_emp"><?=$SSOnewcal['rate']?>%</td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['SSO'].' '.$lng['Calculated']?></th>
							<td id="sso_calculate_sso_emp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['Minimum rate']?></th>
							<td id="sso_min_emp"><?=$SSOnewcal['min']?></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Manual correction']?></th>
							<td id="sso_memp" style="background:#fdf4bd;padding: 0px !important;">
								<input type="text" id="sso_manual_emp" class="float72" onchange="SSO_calc(this)" style="background:#fdf4bd;">
							</td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['Maximum rate']?></th>
							<td id="sso_max_emp"><?=$SSOnewcal['max']?></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['SSO Employee']?></th>
							<td id="sso_emp_sso"></td>
							<td colspan="4"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['SSO by company']?></th>
							<td id="sso_sso_by_company"></td>
							<td colspan="4"></td>
						</tr>
					</tbody>
					<thead class="mt-3">
						<tr>
							<th colspan="6" class="tal text-danger p-1"><?=$lng['Calculation Employer contribution']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['SSO'].' '.$lng['Income']?></th>
							<td id="sso_total_sso_comp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['SSO rate Employer']?></th>
							<td id="sso_rate_comp"><?=$SSOnewcal['crate']?>%</td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['SSO'].' '.$lng['Calculated']?></th>
							<td id="sso_calculate_sso_comp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['Minimum rate']?></th>
							<td id="sso_min_comp"><?=$SSOnewcal['cmin']?></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Manual correction']?></th>
							<td style="background:#fdf4bd;padding: 0px !important;">
								<input type="text" id="sso_manual_comp" onchange="SSO_calc(this)" name="manual_emplyr" class="float72" style="background:#fdf4bd;">
							</td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['Maximum rate']?></th>
							<td id="sso_max_comp"><?=$SSOnewcal['cmax']?></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['SSO Employer']?></th>
							<td id="sso_sso_employerss"></td>
							<td colspan="4"></td>
						</tr>
						
					</tbody>
				</table>
			</div>
			<div class="modal-footer" style="background: darkgray;">
				<button class="btn btn-danger closebtn" type="button" data-dismiss="modal"><?=$lng['Cancel']?></button>
				<button class="btn btn-primary ml-1" id="SaveSSOdata" type="button"><?=$lng['Confirm']?></button>
			</div>
		</div>
	</div>
</div>
<!-------------------- modalSSO --------------------->

<!-------------------- modalPVF --------------------->
<div class="modal fade" id="modalPVF" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document" style="min-width: 700px !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 5px 13px;background: darkgray;">
				<h5 class="modal-title" style="padding: 0px;"><i class="fa fa-calculator"></i>&nbsp; <?=$lng['Calculate PVF']?></h5>
				<a title="Close" type="button" class="close closebtn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times text-danger"></i></a>
			</div>
			<div class="modal-body" style="padding: 5px 20px 5px !important;background: #efe;">
				<table class="basicTable" border="0" style="width: 100%;">
					<thead>
						<tr>
							<th colspan="6" class="tac text-danger p-1"><?=$lng['PVF CALCULATION']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['Emp. ID']?></th>
							<td id="pvf_empid"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['Calculate PVF']?></th>
							<td id="pvfs_calc_pvf" style="background:#fdf4bd;padding: 0px !important;">
								<select name="pvf_calc_pvf" id="pvfss_calc_pvf" onchange="PVF_calc(this)" style="padding: 0px !important;background:#fdf4bd;">
									<? foreach($noyes01 as $k => $v){?>
										<option value="<?=$k?>"><?=$v?></option>
									<? } ?>
								</select>
							</td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Employee name']?></th>
							<td id="pvf_empname"></td>
							<td colspan="4"></td>
							
						</tr>
					</tbody>

					<thead class="mt-3">
						<tr>
							<th colspan="6" class="tal text-danger p-1"><?=$lng['Calculation employee contribution']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['PVF'].' '.$lng['Income']?></th>
							<td id="pvf_income_pvf_emp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['PVF rate employee']?></th>
							<td id="pvf_rate_pvf_emp"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['PVF'].' '.$lng['Calculated']?></th>
							<td id="pvf_calculate_emp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['PVF amount THB']?></th>
							<td id="pvf_amt_thb_emp"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Manual correction']?></th>
							<td style="background:#fdf4bd;padding: 0px !important;">
								<input type="text" id="pvf_manual_emp" onchange="PVF_calc(this)" name="manual_emp" class="float72" style="background:#fdf4bd;">
							</td>
							<td colspan="4"></td>
							
						</tr>
						<tr>
							<th class="tal"><?=$lng['PVF Employee']?></th>
							<td id="pvf_pvfemp_emp"></td>
							<td colspan="4"></td>
						</tr>
					</tbody>

					<thead class="mt-3">
						<tr>
							<th colspan="6" class="tal text-danger p-1"><?=$lng['Calculation Employer contribution']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['PVF'].' '.$lng['Income']?></th>
							<td id="pvf_income_pvf_comp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['PVF rate employer']?></th>
							<td id="pvf_rate_pvf_comp"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['PVF'].' '.$lng['Calculated']?></th>
							<td id="pvf_calculate_comp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['PVF amount THB']?></th>
							<td id="pvf_amt_thb_comp"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Manual correction']?></th>
							<td style="background:#fdf4bd;padding: 0px !important;">
								<input type="text" id="pvf_manual_comp" onchange="PVF_calc(this)" name="manual_emplyr" class="float72" style="background:#fdf4bd;">
							</td>
							<td colspan="4"></td>
							
						</tr>
						<tr>
							<th class="tal"><?=$lng['PVF Employer']?></th>
							<td id="pvf_pvfcom_comp"></td>
							<td colspan="4"></td>
						</tr>
					</tbody>

				</table>
			</div>
			<div class="modal-footer" style="background: darkgray;">
				<button class="btn btn-danger closebtn" type="button" data-dismiss="modal"><?=$lng['Cancel']?></button>
				<button class="btn btn-primary ml-1" id="SavePVFdata" type="button"><?=$lng['Confirm']?></button>
			</div>
		</div>
	</div>
</div>
<!-------------------- modalPVF --------------------->

<!-------------------- modalPSF --------------------->
<div class="modal fade" id="modalPSF" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document" style="min-width: 700px !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 5px 13px;background: darkgray;">
				<h5 class="modal-title" style="padding: 0px;"><i class="fa fa-calculator"></i>&nbsp; <?=$lng['Calculate PSF']?></h5>
				<a title="Close" type="button" class="close closebtn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times text-danger"></i></a>
			</div>
			<div class="modal-body" style="padding: 5px 20px 5px !important;background: #efe;">
				<table class="basicTable" border="0" style="width: 100%;">
					<thead>
						<tr>
							<th colspan="6" class="tac text-danger p-1"><?=$lng['PSF CALCULATION']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['Emp. ID']?></th>
							<td id="psf_empid"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['Calculate PSF']?></th>
							<td id="psfs_calc_sso" style="background:#fdf4bd;padding: 0px !important;">
								<select name="psf_calc_sso" id="psfss_calc_sso" onchange="PSF_calc(this)" style="padding: 0px !important;background:#fdf4bd;">
									<? foreach($noyes01 as $k => $v){?>
										<option value="<?=$k?>"><?=$v?></option>
									<? } ?>
								</select>
							</td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Employee name']?></th>
							<td id="psf_empname"></td>
							<td colspan="4"></td>
							
						</tr>
					</tbody>
					<thead class="mt-3">
						<tr>
							<th colspan="6" class="tal text-danger p-1"><?=$lng['Calculation employee contribution']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['PSF'].' '.$lng['Income']?></th>
							<td id="psf_income_emp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['PSF rate employee']?></th>
							<td id="psf_rate_psf_emp"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['PSF'].' '.$lng['Calculated']?></th>
							<td id="psf_calculate_emp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['PSF amount THB']?></th>
							<td id="psf_amt_thb_emp"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Manual correction']?></th>
							<td style="background:#fdf4bd;padding: 0px !important;">
								<input type="text" id="psf_manual_emp" onchange="PSF_calc(this)" name="manual_emp" class="float72" style="background:#fdf4bd;">
							</td>
							<td colspan="4"></td>
							
						</tr>
						<tr>
							<th class="tal"><?=$lng['PSF Employee']?></th>
							<td id="psf_psf_emp"></td>
							<td colspan="4"></td>
						</tr>
					</tbody>

					<thead class="mt-3">
						<tr>
							<th colspan="6" class="tal text-danger p-1"><?=$lng['Calculation Employer contribution']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['PSF'].' '.$lng['Income']?></th>
							<td id="psf_income_comp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['PSF rate employer']?></th>
							<td id="psf_rate_psf_comp"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['PSF'].' '.$lng['Calculated']?></th>
							<td id="psf_calculate_comp"></td>
							<td colspan="2"></td>
							<th class="tal"><?=$lng['PSF amount THB']?></th>
							<td id="psf_amt_thb_comp"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Manual correction']?></th>
							<td style="background:#fdf4bd;padding: 0px !important;">
								<input type="text" id="psf_manual_comp" onchange="PSF_calc(this)" name="manual_emplyr" class="float72" style="background:#fdf4bd;">
							</td>
							<td colspan="4"></td>
							
						</tr>
						<tr>
							<th class="tal"><?=$lng['PSF Employer']?></th>
							<td id="psf_psf_comp"></td>
							<td colspan="4"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer" style="background: darkgray;">
				<button class="btn btn-danger closebtn" type="button" data-dismiss="modal"><?=$lng['Cancel']?></button>
				<button class="btn btn-primary ml-1" id="SavePSFdata" type="button"><?=$lng['Confirm']?></button>
			</div>
		</div>
	</div>
</div>
<!-------------------- modalPVF --------------------->

<!-------------------- modalTAX --------------------->
<div class="modal fade" id="modalTAX" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document" style="min-width: 800px !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 5px 13px;background: darkgray;">
				<h5 class="modal-title" style="padding: 0px;"><i class="fa fa-calculator"></i>&nbsp; <?=$lng['Calculate Tax']?></h5>
				<a title="Close" type="button" class="close closebtn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times text-danger"></i></a>
			</div>
			<div class="modal-body" style="padding: 5px 20px 5px !important;background: #efe;max-height: calc(100vh - 30vh);overflow-y: auto;">
				
				<table class="basicTable" border="0" style="width: 100%;">
					<thead>
						<tr>
							<th colspan="6" class="tac text-danger p-1"><?=$lng['Tax calculation']?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal" colspan="2"><?=$lng['Spread variable income']?></th>
							<td id="tx_spread_var_income"></td>
							<th class="tal" colspan="2"><?=$lng['Calculation base']?></th>
							<td id="tx_calc_base"></td>
						</tr>
						<tr>
							<th class="tal" colspan="2"><?=$lng['Calculate Tax']?></th>
							<td id="tx_calc_tax"></td>
							<th class="tal" colspan="2"><?=$lng['Tax calculation method']?></th>
							<td id="tx_tax_calc_method" style="background:#fdf4bd;padding: 0px !important;">
								<select id="tx_calc_method" style="padding: 0px !important;background:#fdf4bd;">
									<option value="cam">CAM</option>
									<option value="acm">ACM</option>
									<option value="ytd">YTD</option>
								</select>
							</td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<th colspan="6" class="tac text-danger p-1">ACM</th>
						</tr>
						<tr>
							<th class="tal p-1 pl-2"><?=$lng['Year income']?></th>
							<td></td>
							<th class="tal p-1"><?=$lng['Tax calculation']?></th>
							<td></td>
							<th class="tal p-1"><?=$lng['Tax summary']?></th>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['Tax deductions']?></th>
							<td class="tar" id="tx_tax_deduction"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Total tax year']?></th>
							<td class="tar" id="tx_tot_tax_year_acm"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Fixed actual']?></th>
							<td class="tar" id="tx_fixed_actual"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Total Prev Mths']?></th>
							<td class="tar" id="tx_tot_prev_mnth_acm"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Variable Prev']?></th>
							<td class="tar" id="tx_var_prev"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Tax remaining']?></th>
							<td class="tar" id="tx_tax_remaining_acm"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Variable Cur']?></th>
							<td class="tar" id="tx_var_curr"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Tax Fix this mth']?></th>
							<td class="tar" id="tx_fix_this_mnth_acm"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['ACM fix']?></th>
							<td class="tar" id="tx_acm_fix1"></td>
							<th class="tal"><?=$lng['ACM fix']?></th>
							<td class="tar" id="tx_acm_fix2"></td>
							<th class="tal"><?=$lng['Tax Var this mth']?></th>
							<td class="tar" id="tx_var_this_mnth_acm"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['ACM fix prev']?></th>
							<td class="tar" id="tx_acm_fix_prev1"></td>
							<th class="tal"><?=$lng['ACM fix'].' + '.$lng['Prev']?></th>
							<td class="tar" id="tx_acm_fix_prev2"></td>
							<th class="tal"><?=$lng['Tax this month']?></th>
							<td class="tar" id="tx_tax_this_mnth_acm"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['ACM fix prev var']?></th>
							<td class="tar" id="tx_acm_fix_prev_var1"></td>
							<th class="tal"><?=$lng['ACM fix'].' + '.$lng['Var']?></th>
							<td class="tar" id="tx_acm_fix_prev_var2"></td>
							<th class="tal"><?=$lng['Total tax next mths']?></th>
							<td class="tar" id="tx_tot_tax_next_mnth_acm"></td>
						</tr>
						<tr>
							<th colspan="4"></th>
							<th class="tal"><?=$lng['Tax next month']?></th>
							<td class="tar" id="tx_tax_next_mnth_acm"></td>
						</tr>
						<tr>
							<th colspan="4"></th>
							<th class="tal"><?=$lng['Tax by company']?></th>
							<td class="tar" id="tx_tax_by_company_acm"></td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<th colspan="6" class="tac text-danger p-1">YTD</th>
						</tr>
						<tr>
							<th class="tal p-1 pl-2"><?=$lng['Year income']?></th>
							<td></td>
							<th class="tal p-1"><?=$lng['Tax calculation']?></th>
							<td></td>
							<th class="tal p-1"><?=$lng['Tax summary']?></th>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['Tax deductions']?> YTD</th>
							<td class="tar" id="tx_tax_deduction_ytd"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Total tax year']?></th>
							<td class="tar" id="tx_tot_tax_year_ytd"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Income']?> YTD</th>
							<td class="tar" id="tx_income_ytd"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Total Prev Mths']?></th>
							<td class="tar" id="tx_tot_prev_mnth_ytd"></td>
						</tr>
						<tr>
							<th colspan="4"></th>
							<th class="tal"><?=$lng['Tax this month']?></th>
							<td class="tar" id="tx_tax_this_mnth_ytd"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Taxable income']?> YTD</th>
							<td class="tar" id="tx_taxincome_ytd"></td>
							<th class="tal"><?=$lng['YTD. Tax']?></th>
							<td class="tar" id="tx_tax_ytd"></td>
							<th class="tal"><?=$lng['Tax by company']?></th>
							<td class="tar" id="tx_tax_by_company_ytd"></td>
						</tr>
						
					</tbody>
					<thead>
						<tr>
							<th colspan="6" class="tac text-danger p-1">CAM</th>
						</tr>
						<tr>
							<th class="tal p-1 pl-2"><?=$lng['Year income']?></th>
							<td></td>
							<th class="tal p-1"><?=$lng['Tax calculation']?></th>
							<td></td>
							<th class="tal p-1"><?=$lng['Tax summary']?></th>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th class="tal"><?=$lng['Tax deductions']?></th>
							<td class="tar" id="tx_tax_deduction_cam"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Total tax year']?></th>
							<td class="tar" id="tx_tot_tax_year_cam"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Fixed']?> x12</th>
							<td class="tar" id="tx_fixedx12_cam"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Total Prev Mths']?></th>
							<td class="tar" id="tx_tot_prev_mnth_cam"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Variable Prev']?></th>
							<td class="tar" id="tx_var_prev_cam"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Tax remaining']?></th>
							<td class="tar" id="tx_tax_remaining_cam"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['Variable Cur']?></th>
							<td class="tar" id="tx_var_curr_cam"></td>
							<th class="tal"></th>
							<td></td>
							<th class="tal"><?=$lng['Tax Fix this mth']?></th>
							<td class="tar" id="tx_fix_this_mnth_cam"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['CAM'].' '.$lng['Fix']?></th>
							<td class="tar" id="tx_cam_fix1"></td>
							<th class="tal"><?=$lng['CAM'].' '.$lng['Fix']?></th>
							<td class="tar" id="tx_cam_fix2"></td>
							<th class="tal"><?=$lng['Tax Var this mth']?></th>
							<td class="tar" id="tx_var_this_mnth_cam"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['CAM'].' '.$lng['Fix'].' '.$lng['Prev']?></th>
							<td class="tar" id="tx_cam_fix_prev1"></td>
							<th class="tal"><?=$lng['CAM'].' '.$lng['Fix'].' + '.$lng['Prev']?></th>
							<td class="tar" id="tx_cam_fix_prev2"></td>
							<th class="tal"><?=$lng['Tax this month']?></th>
							<td class="tar" id="tx_tax_this_mnth_cam"></td>
						</tr>
						<tr>
							<th class="tal"><?=$lng['CAM'].' '.$lng['Fix'].' '.$lng['Prev'].' '.$lng['Var']?></th>
							<td class="tar" id="tx_cam_fix_prev_var1"></td>
							<th class="tal"><?=$lng['CAM'].' '.$lng['Fix'].' + '.$lng['Var']?></th>
							<td class="tar" id="tx_cam_fix_prev_var2"></td>
							<th class="tal"><?=$lng['Total tax next mths']?></th>
							<td class="tar" id="tx_tot_tax_next_mnth_cam"></td>
						</tr>
						<tr>
							<th colspan="4"></th>
							<th class="tal"><?=$lng['Tax next month']?></th>
							<td class="tar" id="tx_tax_next_mnth_cam"></td>
						</tr>
						<tr>
							<th colspan="4"></th>
							<th class="tal"><?=$lng['Tax by company']?></th>
							<td class="tar" id="tx_tax_by_company_cam"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer" style="background: darkgray;">
				<button class="btn btn-danger closebtn" type="button" data-dismiss="modal"><?=$lng['Cancel']?></button>
				<button class="btn btn-primary ml-1" id="SaveTAXdata" type="button"><?=$lng['Confirm']?></button>
			</div> 
		</div>
	</div>
</div>
<!-------------------- modalTAX --------------------->

<!-------------------- modalTAXDeduction --------------------->
<div class="modal fade" id="modalTAXDeduction" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="top:0px;">
	<div class="modal-dialog" role="document" style="min-width: 1052px !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 5px 13px;background: darkgray;">
				<h5 class="modal-title" style="padding: 0px;"><i class="fa fa-calculator"></i>&nbsp; <?=$lng['Calculate'].' '.$lng['Tax deductions']?></h5>
				<a title="Close" type="button" class="close closebtn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times text-danger"></i></a>
			</div>
			<div class="modal-body" style="padding: 5px 20px 5px !important;background: #efe;">
				<table class="basicTable" border="0" style="width: 101%;">
					<thead>
						<tr>
							<th colspan="6" class="tac text-danger p-1"><?=$lng['Tax deductions']?></th>
						</tr>
					</thead>
				</table>

				<div class="row">
					<div class="col-md-7" style="padding-right: 0px;max-width: 59.5%;">
						<table class="basicTable" border="0" style="width: 100%;border-right: 1px solid #ccc;">
							<tbody>
								<tr>
									<th class="tal"><?=$lng['Emp. ID']?></th>
									<td id="td_empid"></td>
									<td colspan="3"></td>
								</tr>
								<tr>
									<th class="tal"><?=$lng['Employee name']?></th>
									<td id="td_empname"></td>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<th class="tal"><?=$lng['Standard deduction']?></th>
									<td class="tar" id="td_std_deduction"></td>
									<td class="tar" id="td_std_clcthb"></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<th class="tal"><?=$lng['Personal care']?></th>
									<td class="tar" id="td_pers_care"></td>
									<td class="tar" id="td_pcare_clcthb"></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<th class="tal"><?=$lng['PVF Employee']?></th>
									<td class="tar" id="td_pvf_empsss"></td>
									<td class="tar" id="td_pvf_clcthb"></td>
								</tr>
								
								<tr>
									<td colspan="2"></td>
									<th class="tal"><?=$lng['SSO Employee']?></th>
									<td class="tar" id="td_sso_empsss"></td>
									<td class="tar" id="td_sso_clcthb"></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<th class="tal"><?=$lng['Other deductions']?></th>
									<td class="tar" id="td_other_deduct"></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<th class="tal text-danger"><?=$lng['Total tax deductions']?></th>
									<td id="td_total_tax_deduct" class="tar text-danger font-weight-bold"></td>
									<td></td>
								</tr>
							</tbody>

							<tbody>
								<tr>
									<th colspan="2" class="tac text-primary"><?=$lng['Calculation Standard deduction']?></th>
									<th colspan="3" class="tac text-primary" style="border-right: 1px solid #ccc;"><?=$lng['Calculation Personal Care']?></th>
								</tr>
								<tr>
									<td colspan="2" class="tac small">Assessed income *50% max 100,000</td>
									<td colspan="3" class="tac small">Assessed income *40% max 60,000</td>
								</tr>
								<tr>
									<td class="tal"><?=$lng['Fixed actual income']?></td>
									<td class="tar" id="fixed_actual_income_std"></td>
									<td></td>
									<td class="tar"><?=$lng['Fixed actual income']?></td>
									<td class="tar" id="fixed_actual_income_pcare"></td>
								</tr>
								<tr>
									<td class="tal"><?=$lng['Subtotal']?></td>
									<td class="tar" id="subtotal_std"></td>
									<td></td>
									<td class="tal"><?=$lng['Subtotal']?></td>
									<td class="tar" id="subtotal_pcare"></td>
								</tr>
								<tr>
									<td class="tal"><?=$lng['Manual correction']?></td>
									<td style="background:#fdf4bd;padding: 0px !important;">
										<input type="text" id="td_manual_std" onchange="tax_deduct_calc(this)" class="tar float72" style="background:#fdf4bd;">
									</td>
									<td></td>
									<td class="tal"><?=$lng['Manual correction']?></td>
									<td style="background:#fdf4bd;padding: 0px !important;">
										<input type="text" id="td_manual_pcare" onchange="tax_deduct_calc(this)" class="tar float72" style="background:#fdf4bd;">
									</td>
								</tr>
								<tr>
									<td class="tal"><?=$lng['Standard deduction']?></td>
									<td class="tar" id="td_std_deduct"></td>
									<td></td>
									<td class="tal"><?=$lng['Personal care'].' '.$lng['Deduction']?></td>
									<td class="tar" id="td_pcare_deduct"></td>
								</tr>
								
								<tr>
									<th colspan="2" class="tac text-primary"><?=$lng['Calculation SSO deduction']?></th>
									<th colspan="3" class="tac text-primary" style="border-right: 1px solid #ccc;"><?=$lng['Calculation PVF deduction']?></th>
								</tr>
								<tr>
									<td class="tal"><?=$lng['Income SSO Cur Mth']?></td>
									<td class="tar" id="th_income_sso_mnth"></td>
									<td></td>
									<td class="tal"><?=$lng['Income PVF cur mth']?></td>
									<td class="tar" id="th_income_pvf_mnth"></td>
								</tr>
								<tr>
									<td class="tal"><?=$lng['Subtotal']?></td>
									<td class="tar" id="td_subtotal_sso"></td>
									<td></td>
									<td class="tal"><?=$lng['Subtotal']?></td>
									<td class="tar" id="td_subtotal_pvf"></td>
								</tr>
								<tr>
									<td class="tal"><?=$lng['Manual correction']?></td>
									<td style="background:#fdf4bd;padding: 0px !important;">
										<input type="text" id="td_manual_ssod" onchange="tax_deduct_calc(this)" class="tar float72" style="background:#fdf4bd;">
									</td>
									<td></td>
									<td class="tal"><?=$lng['Manual correction']?></td>
									<td style="background:#fdf4bd;padding: 0px !important;">
										<input type="text" id="td_manual_pvfd" onchange="tax_deduct_calc(this)" class="tar float72" style="background:#fdf4bd;">
									</td>
								</tr>
								<tr>
									<td class="tal"><?=$lng['SSO'].' '.$lng['Deduction']?></td>
									<td class="tar" id="td_sso_deduct"></td>
									<td></td>
									<td class="tal"><?=$lng['PVF'].' '.$lng['Deduction']?></td>
									<td class="tar" id="td_pvf_deduct"></td>
								</tr>

							</tbody>
						</table>

					</div>
					<div class="col-md-5" style="padding-left: 0px;max-width: 40%;">
						<table class="basicTable" border="0" style="width: 100%;">
							<thead>
								<tr>
									<th colspan="6" class="tac text-danger p-1"><?=$lng['Calculations Full Year']?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="2"></td>
									<th><?=$lng['PVF rate']?></th>
									<th id="td_pvf_emp"></th>
									<td colspan="2"></td>
								</tr>
							</tbody>

							<thead class="mt-4">
								<tr>
									<th class="tac"><?=$lng['Month']?></th>
									<th class="tac"><?=$lng['SSO']?>%</th>
									<th class="tac"><?=$lng['SSO'].' '.$lng['Min']?></th>
									<th class="tac"><?=$lng['SSO'].' '.$lng['Max']?></th>
									<th class="tac"><?=$lng['SSO'].' '.$lng['THB']?></th>
									<th class="tac"><?=$lng['PVF'].' '.$lng['THB']?></th>
								</tr>
							</thead>
							<tbody id="append_full_table">
								
							</tbody>

						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer" style="background: darkgray;">
				<button class="btn btn-danger closebtn" type="button" data-dismiss="modal"><?=$lng['Cancel']?></button>
				<button class="btn btn-primary ml-1" id="SaveTDdata" type="button"><?=$lng['Confirm']?></button>
			</div>
		</div>
	</div>
</div>

<!-------------------- modalTAXDeduction --------------------->


<script type="text/javascript">

	function Opencalculationpopups(that){

		var empid = that.id;
		var currmnth = <?=$_SESSION['rego']['cur_month']?>;
		
		var get_prev_months_allowancesdeductss = '';
		if(currmnth > 1){
			get_prev_months_allowancesdeductss = get_prev_months_allowancesdeduct(empid);
		}

		$.ajax({
			type: 'post',
			url: "ajax/get_payroll_data.php",
			data: {empid: empid},
			success: function(result){

				if(result == 'error'){
					$("body").overhang({
						type: "error",
						message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
						duration: 3,
						callback: function(v){
							window.location.reload();
						}
					})
				}else{

					var data = JSON.parse(result);

					//===================== Right side table data start (Allowances) ======================//
					var eColsMdlA = <?=$eColsMdlA?>;
					var eColsMdlD = <?=$eColsMdlD?>;
					
					var pperiods = <?=json_encode($pperiods)?>;
					var short_months = <?=json_encode($short_months)?>;
					var payrollparametersformonth = <?=json_encode(array_values($payrollparametersformonth))?>;
					var allowance_deduct_name = <?=json_encode($allowDdt)?>;
					var allowDdtEmp_name = <?=json_encode($allowDdtEmp)?>;
					var curryear = <?=substr($_SESSION['rego']['cur_year'], -2)?>;
					var remaining_mnth = 12 - currmnth + 1;
					//console.log(pperiods);


					var countAllown = 0;
					var countDeduct = 0;
					$.each(payrollparametersformonth, function(k,v){

						if(v['classification'] == 0){
							countAllown++;
						}else if(v['classification'] == 1){
							countDeduct++;
						}
					});

					var defclm = 1;
					var tot_count = parseFloat(countAllown) + parseFloat(defclm);

					var manual_feed_total = data.manual_feed_total;
					var fix_allow_from_emp = data.fix_allow_from_emp;
					var fix_deduct_from_emp = data.fix_deduct_from_emp;
					//console.log(fix_allow_from_emp);
					$('#Salarycalculator #linkedcolumnsSC thead').remove();
					$('#Salarycalculator #linkedcolumnsSC tbody').remove();

					var allow_and_deduct_data = '<thead>';
						allow_and_deduct_data +='<tr><th colspan="'+tot_count+'" class="tal text-danger"><?=$lng['DETAILS ALLOWANCES & DEDUCTIONS']?></th></tr>';
						allow_and_deduct_data +='<tr>';
						allow_and_deduct_data +='<th class="tac"><?=$lng['Month']?></th>';

						var countClm = 0;
						var clmnval;
						$.each(payrollparametersformonth, function(k1,v){
							var k = v['id'];
							if(v['classification'] == 0){
								countClm++;

								if(allowance_deduct_name[k] == undefined){ clmnval = allowDdtEmp_name[k];}else{ clmnval = allowance_deduct_name[k];}
								allow_and_deduct_data +='<th class="tac '+v['groups']+'">'+clmnval+'</th>';
							}
						})
						
						allow_and_deduct_data +='</tr>';
						allow_and_deduct_data +='</thead>';

						allow_and_deduct_data +='<tbody>';
							var i;
							for(i=1; i <=12 ; i++){
								allow_and_deduct_data +='<tr><td class="tac font-weight-bold">'+short_months[i]+'-'+curryear+'</td>';
								
								var currMnths = '';
								var crmth_manual_feed = 0.00;
								var prmth_manual_feed = 0.00;
								var pnd1 = '';
								var sso = '';
								var pvf = '';
								var psf = '';
								var tax_basefp = '';
								var tax_basef = '';
								var tax_basev = '';
								var tax_basent = '';
								var taxbycom = '';
								
								$.each(payrollparametersformonth, function(k1,v){
									var k = v['id'];
									if(v['classification'] == 0){
										if(currmnth == i){ 
											currMnths = 'currMnths'; 
											
											if(fix_allow_from_emp.hasOwnProperty(k)){
												crmth_manual_feed = (fix_allow_from_emp[k] > 0) ? fix_allow_from_emp[k] : 0.00; 
											}else{
												crmth_manual_feed = (manual_feed_total[k] > 0) ? manual_feed_total[k] : 0.00; 
											}
											
											/*if(v['groups'] == 'inc_sal'){
												crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].salary);
											}*/

											if(k == 27){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].tax_by_company); taxbycom="taxbycom";}else{ taxbycom="";}
											if(k == 28){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].sso_by_company); }
											if(k == 29){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].severance); }
											if(k == 31){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].remaining_salary); }
											if(k == 32){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].notice_payment); }
											if(k == 33){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].paid_leave); }
											
											if(k == 56){ 
												if(data[0].contract_type == 'day'){var dsaly=data[0].mf_salary;}else{var dsaly=data[0].salary;}
												crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(dsaly); 
											}

										
											if(v['pnd'] == 1){ pnd1 = 'pnd1';}else{ pnd1 = '';}
											if(data[0].calc_sso == 1 && v['sso'] == 1){ sso = 'sso';}else{ sso = '';}
											if(data[0].calc_pvf == 1 && v['pvf'] == 1){ pvf = 'pvf';}else{ pvf = '';}
											if(data[0].calc_psf == 1 && v['psf'] == 1){ psf = 'psf';}else{ psf = '';}
											if(v['tax_base'] == 'fixpro'){ tax_basefp = 'fixpro';}else{ tax_basefp = '';}
											if(v['tax_base'] == 'fix'){ tax_basef = 'fix';}else{ tax_basef = '';}
											if(v['tax_base'] == 'var'){ tax_basev = 'var';}else{ tax_basev = '';}
											if(v['tax_base'] == 'nontax'){ tax_basent = 'nontax';}else{ tax_basent = '';}

											allow_and_deduct_data +='<td class="tar '+currMnths+' '+pnd1+' '+sso+' '+pvf+' '+psf+' '+tax_basefp+' '+tax_basef+' '+tax_basev+' '+tax_basent+' '+taxbycom+' '+v['groups']+'">'+number_format(crmth_manual_feed)+'</td>';
											
										}else if(currmnth > i){ 
											
											if(get_prev_months_allowancesdeductss[i] == '[object Object]'){
												prmth_manual_feed = (get_prev_months_allowancesdeductss[i][k] > 0) ? get_prev_months_allowancesdeductss[i][k] : 0;
												if(v['groups'] == 'inc_sal'){
													prmth_manual_feed = parseFloat(prmth_manual_feed) + parseFloat(data[0].salary);
												}
											}


											if(v['pnd'] == 1){ pnd1 = 'pnd1';}else{ pnd1 = '';}
											if(data[0].calc_sso == 1 && v['sso'] == 1){ sso = 'sso';}else{ sso = '';}
											if(data[0].calc_pvf == 1 && v['pvf'] == 1){ pvf = 'pvf';}else{ pvf = '';}
											if(data[0].calc_psf == 1 && v['psf'] == 1){ psf = 'psf';}else{ psf = '';}
											if(v['tax_base'] == 'fixpro'){ tax_basefp = 'fixpro';}else{ tax_basefp = '';}
											if(v['tax_base'] == 'fix'){ tax_basef = 'fix';}else{ tax_basef = '';}
											if(v['tax_base'] == 'var'){ tax_basev = 'var';}else{ tax_basev = '';}
											if(v['tax_base'] == 'nontax'){ tax_basent = 'nontax';}else{ tax_basent = '';}

											allow_and_deduct_data +='<td class="tar prevMnth '+pnd1+' '+sso+' '+pvf+' '+psf+' '+tax_basefp+' '+tax_basef+' '+tax_basev+' '+tax_basent+' '+v['groups']+'">'+number_format(prmth_manual_feed)+'</td>';
										}else{

											if(v['pnd'] == 1){ pnd1 = 'pnd1';}else{ pnd1 = '';}
											if(data[0].calc_sso == 1 && v['sso'] == 1){ sso = 'sso';}else{ sso = '';}
											if(data[0].calc_pvf == 1 && v['pvf'] == 1){ pvf = 'pvf';}else{ pvf = '';}
											if(data[0].calc_psf == 1 && v['psf'] == 1){ psf = 'psf';}else{ psf = '';}
											if(v['tax_base'] == 'fixpro'){ tax_basefp = 'fixpro';}else{ tax_basefp = '';}
											if(v['tax_base'] == 'fix'){ tax_basef = 'fix';}else{ tax_basef = '';}
											if(v['tax_base'] == 'var'){ tax_basev = 'var';}else{ tax_basev = '';}
											if(v['tax_base'] == 'nontax'){ tax_basent = 'nontax';}else{ tax_basent = '';}
											currMnths = 'upcommMnths'; 

											if(v['tax_base'] == 'fixpro'){

												if(fix_allow_from_emp.hasOwnProperty(k)){
													crmth_manual_feed = (fix_allow_from_emp[k] > 0) ? fix_allow_from_emp[k] : 0.00; 
												}else{
													crmth_manual_feed = (manual_feed_total[k] > 0) ? manual_feed_total[k] : 0.00; 
												}

												if(k == 27){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].tax_by_company); }
												if(k == 28){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].sso_by_company); }
												if(k == 29){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].severance); }
												if(k == 31){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].remaining_salary); }
												if(k == 32){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].notice_payment); }
												if(k == 33){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].paid_leave); }
												if(k == 56){ 
													if(data[0].contract_type == 'day'){var dsaly=data[0].mf_salary;}else{var dsaly=data[0].salary;}
													crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(dsaly); 
												}
												//crmth_manual_feed = (manual_feed_total[k] > 0) ? manual_feed_total[k] : 0; 
												/*if(v['groups'] == 'inc_sal'){
													crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].salary);
												}*/
												allow_and_deduct_data +='<td class="tar '+currMnths+' '+pnd1+' '+sso+' '+pvf+' '+psf+' '+tax_basefp+' '+tax_basef+' '+tax_basev+' '+tax_basent+' '+v['groups']+'">'+number_format(crmth_manual_feed)+'</td>';
											}else{
												allow_and_deduct_data +='<td class="tar '+currMnths+' '+pnd1+' '+sso+' '+pvf+' '+psf+' '+tax_basefp+' '+tax_basef+' '+tax_basev+' '+tax_basent+' '+v['groups']+'">0.00</td>';
											}
										}
									}
								})

								allow_and_deduct_data +='</tr>';
							}
						allow_and_deduct_data +='</tbody>';
									
					$('#Salarycalculator #linkedcolumnsSC').append(allow_and_deduct_data);
					//===================== Right side table data end ======================//

					//===================== Right side table data Start (Deduction) ======================//
					var defclmd = 1;
					var tot_countd = parseFloat(countDeduct) + parseFloat(defclmd);
					$('#Salarycalculator #linkedcolumnsSCD thead').remove();
					$('#Salarycalculator #linkedcolumnsSCD tbody').remove();

					var deduct_data = '<thead>';
						//deduct_data +='<tr><th colspan="'+tot_countd+'" class="tac text-danger"><?=$lng['DETAILS ALLOWANCES & DEDUCTIONS']?></th></tr>';
						deduct_data +='<tr>';
						deduct_data +='<th class="tac"><?=$lng['Month']?></th>';

						var countClm = 0;
						$.each(payrollparametersformonth, function(k1,v){
							var k = v['id'];
							if(v['classification'] == 1){
								countClm++;
								if(allowance_deduct_name[k] == undefined){ clmnval = allowDdtEmp_name[k];}else{ clmnval = allowance_deduct_name[k];}
								deduct_data +='<th class="tac '+v['groups']+'">'+clmnval+'</th>';
							}
						})
						
						deduct_data +='</tr>';
						deduct_data +='</thead>';

						deduct_data +='<tbody>';
							var i;
							for(i=1; i <=12 ; i++){
								deduct_data +='<tr><td class="tac font-weight-bold">'+short_months[i]+'-'+curryear+'</td>';
								
								var currMnths = '';
								var crmth_manual_feed = '';
								var prmth_manual_feed = '';
								var pnd1 = '';
								var sso = '';
								var pvf = '';
								var psf = '';
								var tax_basefp = '';
								var tax_basef = '';
								var tax_basev = '';
								var tax_basent = '';
								var extracls = '';
								var extraTax = '';
								
								$.each(payrollparametersformonth, function(k1,v){
									var k = v['id'];
									if(v['classification'] == 1){
										if(currmnth == i){ 
											currMnths = 'currMnths'; 

											if(fix_deduct_from_emp.hasOwnProperty(k)){
												crmth_manual_feed = (fix_deduct_from_emp[k] > 0) ? fix_deduct_from_emp[k] : 0; 
											}else{
												crmth_manual_feed = (manual_feed_total[k] > 0) ? manual_feed_total[k] : 0; 
											}

											if(k == 47){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].savings); }
											if(k == 48){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].legal_execution); }
											if(k == 49){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].kor_yor_sor); }
											if(k == 57){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].sso_employee); extracls="ssocurr";}else{ extracls="";}
											if(k == 58){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].pvf_employee); }
											if(k == 59){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].psf_employee); }
											if(k == 60){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].tax_this_month); extraTax="exTax";}else{ extraTax="";}
											
											if(v['pnd'] == 1){ pnd1 = 'pnd1';}else{ pnd1 = '';}
											if(data[0].calc_sso == 1 && v['sso'] == 1){ sso = 'sso';}else{ sso = '';}
											if(data[0].calc_pvf == 1 && v['pvf'] == 1){ pvf = 'pvf';}else{ pvf = '';}
											if(data[0].calc_psf == 1 && v['psf'] == 1){ psf = 'psf';}else{ psf = '';}
											if(v['tax_base'] == 'fixpro'){ tax_basefp = 'fixpro';}else{ tax_basefp = '';}
											if(v['tax_base'] == 'fix'){ tax_basef = 'fix';}else{ tax_basef = '';}
											if(v['tax_base'] == 'var'){ tax_basev = 'var';}else{ tax_basev = '';}
											if(v['tax_base'] == 'nontax'){ tax_basent = 'nontax';}else{ tax_basent = '';}

											deduct_data +='<td class="tar '+currMnths+' '+pnd1+' '+sso+' '+pvf+' '+psf+' '+tax_basefp+' '+tax_basef+' '+tax_basev+' '+tax_basent+' '+extracls+' '+extraTax+' '+v['groups']+'">'+number_format(crmth_manual_feed)+'</td>';
											
										}else if(currmnth > i){ 

											if(get_prev_months_allowancesdeductss[i] == '[object Object]'){
												prmth_manual_feed = (get_prev_months_allowancesdeductss[i][k] > 0) ? get_prev_months_allowancesdeductss[i][k] : 0;
											}

											if(v['pnd'] == 1){ pnd1 = 'pnd1';}else{ pnd1 = '';}
											if(data[0].calc_sso == 1 && v['sso'] == 1){ sso = 'sso';}else{ sso = '';}
											if(data[0].calc_pvf == 1 && v['pvf'] == 1){ pvf = 'pvf';}else{ pvf = '';}
											if(data[0].calc_psf == 1 && v['psf'] == 1){ psf = 'psf';}else{ psf = '';}
											if(v['tax_base'] == 'fixpro'){ tax_basefp = 'fixpro';}else{ tax_basefp = '';}
											if(v['tax_base'] == 'fix'){ tax_basef = 'fix';}else{ tax_basef = '';}
											if(v['tax_base'] == 'var'){ tax_basev = 'var';}else{ tax_basev = '';}
											if(v['tax_base'] == 'nontax'){ tax_basent = 'nontax';}else{ tax_basent = '';}

											deduct_data +='<td class="tar prevMnth '+pnd1+' '+sso+' '+pvf+' '+psf+' '+tax_basefp+' '+tax_basef+' '+tax_basev+' '+tax_basent+' '+v['groups']+'">'+number_format(prmth_manual_feed)+'</td>';
										}else{

											if(v['pnd'] == 1){ pnd1 = 'pnd1';}else{ pnd1 = '';}
											if(data[0].calc_sso == 1 && v['sso'] == 1){ sso = 'sso';}else{ sso = '';}
											if(data[0].calc_pvf == 1 && v['pvf'] == 1){ pvf = 'pvf';}else{ pvf = '';}
											if(data[0].calc_psf == 1 && v['psf'] == 1){ psf = 'psf';}else{ psf = '';}
											if(v['tax_base'] == 'fixpro'){ tax_basefp = 'fixpro';}else{ tax_basefp = '';}
											if(v['tax_base'] == 'fix'){ tax_basef = 'fix';}else{ tax_basef = '';}
											if(v['tax_base'] == 'var'){ tax_basev = 'var';}else{ tax_basev = '';}
											if(v['tax_base'] == 'nontax'){ tax_basent = 'nontax';}else{ tax_basent = '';}
											currMnths = 'upcommMnths'; 

											if(v['tax_base'] == 'fixpro'){
												if(fix_deduct_from_emp.hasOwnProperty(k)){
													crmth_manual_feed = (fix_deduct_from_emp[k] > 0) ? fix_deduct_from_emp[k] : 0; 
												}else{
													crmth_manual_feed = (manual_feed_total[k] > 0) ? manual_feed_total[k] : 0; 
												}

												if(k == 47){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].savings); }
												if(k == 48){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].legal_execution); }
												if(k == 49){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].kor_yor_sor); }

												if(k == 57){ 
													var sso_thb = (data[0].total_sso * pperiods[i]['sso_eRate']);
													if(sso_thb > pperiods[i]['sso_eMax']){ sso_thb = pperiods[i]['sso_eMax'];}
													else if(sso_thb < pperiods[i]['sso_eMin']){ sso_thb = pperiods[i]['sso_eMin'];}
													crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(sso_thb); 
												}

												if(k == 58){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].pvf_employee); }
												if(k == 59){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].psf_employee); }
												if(k == 60){ crmth_manual_feed = parseFloat(crmth_manual_feed) + parseFloat(data[0].tax_this_month); }
												//crmth_manual_feed = (manual_feed_total[k] > 0) ? manual_feed_total[k] : 0; 
												deduct_data +='<td class="tar '+currMnths+' '+pnd1+' '+sso+' '+pvf+' '+psf+' '+tax_basefp+' '+tax_basef+' '+tax_basev+' '+tax_basent+' '+v['groups']+'">'+number_format(crmth_manual_feed)+'</td>';
											}else{
												deduct_data +='<td class="tar '+currMnths+' '+pnd1+' '+sso+' '+pvf+' '+psf+' '+tax_basefp+' '+tax_basef+' '+tax_basev+' '+tax_basent+' '+v['groups']+'">0.00</td>';
											}
										}
									}
								})

								deduct_data +='</tr>';
							}
						deduct_data +='</tbody>';
									
					$('#Salarycalculator #linkedcolumnsSCD').append(deduct_data);
					//===================== Right side table data end ======================//

					$('#Salarycalculator #empids').text(data[0].emp_id);
					$('#Salarycalculator #deptval').text(data.department);
					$('#Salarycalculator #contract_type').text(data.contract_type);
					$('#Salarycalculator #calc_tax').text(data.calc_tax);
					$('#Salarycalculator #calc_sso').text(data.calc_sso);


					$('#Salarycalculator #emp_name').text(data[0].emp_name_en);
					$('#Salarycalculator #teamval').text(data.team);
					$('#Salarycalculator #tax_calc_method').text(data[0].calc_method);

					if(data.calc_pvf == 'Yes'){
						$('#Salarycalculator #pvfpsfLbl').text('<?=$lng['Calculate PVF']?>');
						$('#Salarycalculator #calc_pvf').text(data.calc_pvf);
					}else if(data.calc_psf == 'Yes'){
						$('#Salarycalculator #pvfpsfLbl').text('<?=$lng['Calculate PSF']?>');
						$('#Salarycalculator #calc_pvf').text(data.calc_psf);
					}else{
						$('#Salarycalculator #pvfpsfLbl').text('');
						$('#Salarycalculator #calc_pvf').text('');
					}

					//$('#Salarycalculator #calc_pvf').text(data.calc_pvf);
					//$('#Salarycalculator #calc_psf').text(data.calc_psf);

					$('#Salarycalculator #position_val').text(data.position);
					$('#Salarycalculator #calc_base').text(data.calc_base);

					
					$('#Salarycalculator #ear_curr_calc').text(number_format(data[0].total_earnings));
					$('#Salarycalculator #ear_curr_mnth').text(number_format(data[0].total_earnings));
					$('#Salarycalculator #ear_prev_mnth').text(number_format(data[0].total_earnings_prev));
					$('#Salarycalculator #ear_full_year').text(number_format(data[0].full_year_earnings));

					$('#Salarycalculator #ded_curr_calc').text(number_format(data[0].total_deductions));
					$('#Salarycalculator #ded_curr_mnth').text(number_format(data[0].total_deductions));
					$('#Salarycalculator #ded_prev_mnth').text(number_format(data[0].total_deductions_prev));
					$('#Salarycalculator #ded_full_year').text(number_format(data[0].full_year_deductions));

					$('#Salarycalculator #pnd_curr_calc').text(number_format(data[0].total_pnd1));
					$('#Salarycalculator #pnd_curr_mnth').text(number_format(data[0].total_pnd1));
					$('#Salarycalculator #pnd_prev_mnth').text(number_format(data[0].total_pnd1_prev));
					$('#Salarycalculator #pnd_full_year').text(number_format(data[0].full_year_pnd));

					$('#Salarycalculator #sso_curr_calc').text(number_format(data[0].total_sso));
					$('#Salarycalculator #sso_curr_mnth').text(number_format(data[0].total_sso));
					$('#Salarycalculator #sso_prev_mnth').text(number_format(data[0].total_sso_prev));
					$('#Salarycalculator #sso_full_year').text(number_format(data[0].full_year_sso));

					$('#Salarycalculator #pvf_curr_calc').text(number_format(data[0].total_pvf));
					$('#Salarycalculator #pvf_curr_mnth').text(number_format(data[0].total_pvf));
					$('#Salarycalculator #pvf_prev_mnth').text(number_format(data[0].total_pvf_prev));
					$('#Salarycalculator #pvf_full_year').text(number_format(data[0].full_year_pvf));

					$('#Salarycalculator #psf_curr_calc').text(number_format(data[0].total_psf));
					$('#Salarycalculator #psf_curr_mnth').text(number_format(data[0].total_psf));
					$('#Salarycalculator #psf_prev_mnth').text(number_format(data[0].total_psf_prev));
					$('#Salarycalculator #psf_full_year').text(number_format(data[0].full_year_psf));

					$('#Salarycalculator #fixpro_curr_calc').text(number_format(data[0].total_tax_fixpro));
					$('#Salarycalculator #fixpro_curr_mnth').text(number_format(data[0].total_tax_fixpro));
					$('#Salarycalculator #fixpro_prev_mnth').text(number_format(data[0].total_tax_fixpro_prev));
					$('#Salarycalculator #fixpro_full_year').text(number_format(data[0].full_year_fixprorated));

					$('#Salarycalculator #fix_curr_calc').text(number_format(data[0].total_tax_fix));
					$('#Salarycalculator #fix_curr_mnth').text(number_format(data[0].total_tax_fix));
					$('#Salarycalculator #fix_prev_mnth').text(number_format(data[0].total_tax_fix_prev));
					$('#Salarycalculator #fix_full_year').text(number_format(data[0].full_year_fixed));

					$('#Salarycalculator #var_curr_calc').text(number_format(data[0].total_tax_var));
					$('#Salarycalculator #var_curr_mnth').text(number_format(data[0].total_tax_var));
					$('#Salarycalculator #var_prev_mnth').text(number_format(data[0].total_tax_var_prev));
					$('#Salarycalculator #var_full_year').text(number_format(data[0].full_year_var));

					$('#Salarycalculator #totalffv_curr_calc').text(number_format(data[0].total_of_alltax));
					$('#Salarycalculator #totalffv_curr_mnth').text(number_format(data[0].total_of_alltax));
					$('#Salarycalculator #totalffv_prev_mnth').text(number_format(data[0].total_of_alltax_prev));
					$('#Salarycalculator #totalffv_full_year').text(number_format(data[0].full_year_taxableincome));

					$('#Salarycalculator #nontax_curr_calc').text(number_format(data[0].total_tax_nontax));
					$('#Salarycalculator #nontax_curr_mnth').text(number_format(data[0].total_tax_nontax));
					$('#Salarycalculator #nontax_prev_mnth').text(number_format(data[0].total_tax_nontax_prev));
					$('#Salarycalculator #nontax_full_year').text(number_format(data[0].full_year_non_taxable));

					$('#Salarycalculator #sso_emp_curr_calc').text(number_format(data[0].sso_employee));
					$('#Salarycalculator #sso_emp_curr_mnth').text(number_format(data[0].sso_employee));
					$('#Salarycalculator #sso_emp_prev_mnth').text(number_format(data[0].sso_employee_prev));
					$('#Salarycalculator #sso_emp_full_year').text(number_format(data[0].full_year_sso_employee));

					$('#Salarycalculator #pvf_emp_curr_calc').text(number_format(data[0].pvf_employee));
					$('#Salarycalculator #pvf_emp_curr_mnth').text(number_format(data[0].pvf_employee));
					$('#Salarycalculator #pvf_emp_prev_mnth').text(number_format(data[0].pvf_employee_prev));
					$('#Salarycalculator #pvf_emp_full_year').text(number_format(data[0].full_year_pvf_employee));

					$('#Salarycalculator #psf_emp_curr_calc').text(number_format(data[0].psf_employee));
					$('#Salarycalculator #psf_emp_curr_mnth').text(number_format(data[0].psf_employee));
					$('#Salarycalculator #psf_emp_prev_mnth').text(number_format(data[0].psf_employee_prev));
					$('#Salarycalculator #psf_emp_full_year').text(number_format(data[0].full_year_psf_employee));

					$('#Salarycalculator #tax_emp_curr_calc').text(number_format(data[0].tax_this_month));
					$('#Salarycalculator #tax_emp_curr_mnth').text(number_format(data[0].tax_this_month));
					$('#Salarycalculator #tax_emp_prev_mnth').text(number_format(data[0].tax_previous));
					$('#Salarycalculator #tax_emp_full_year').text(number_format(data[0].full_year_psf_employee));

					$('#Salarycalculator #td_emp_curr_calc').text(0);
					$('#Salarycalculator #td_emp_curr_mnth').text(0);
					$('#Salarycalculator #td_emp_prev_mnth').text(0);
					$('#Salarycalculator #td_emp_full_year').text(0);

					$('#Salarycalculator #ssobycom_curr_calc').text(number_format(data[0].sso_by_company));
					$('#Salarycalculator #ssobycom_curr_mnth').text(number_format(data[0].sso_by_company));
					$('#Salarycalculator #ssobycom_prev_mnth').text(number_format(data[0].sso_by_company_prev));
					$('#Salarycalculator #ssobycom_full_year').text(number_format(data[0].total_tax_year));

					$('#Salarycalculator #taxbycom_curr_calc').text(number_format(data[0].tax_by_company));
					$('#Salarycalculator #taxbycom_curr_mnth').text(number_format(data[0].tax_by_company));
					$('#Salarycalculator #taxbycom_prev_mnth').text(number_format(data[0].tax_previous));
					$('#Salarycalculator #taxbycom_full_year').text(number_format(data[0].total_tax_year));

					$('#Salarycalculator #total_net_income_cur_cal').text(number_format(data[0].total_net_income));
					$('#Salarycalculator #total_net_income_cur_mnth').text(number_format(data[0].total_net_income));
					$('#Salarycalculator #total_net_income_prev_mnth').text(number_format(data[0].total_net_income_prev));
					$('#Salarycalculator #total_net_income_fullyear').text(number_format(data[0].fullyear_net_income));


					$('#Salarycalculator #total_net_pay_cur_cal').text(number_format(data[0].total_net_pay));
					$('#Salarycalculator #total_net_pay_cur_mnth').text(number_format(data[0].total_net_pay));
					$('#Salarycalculator #total_net_pay_prev_mnth').text(number_format(data[0].total_net_pay_prev));
					$('#Salarycalculator #total_net_pay_fullyear').text(number_format(data[0].fullyear_net_pay));

				
					$('#Salarycalculator').modal('toggle');

					$('#linkedcolumnsSC').DataTable().destroy();
					$('#linkedcolumnsSCD').DataTable().destroy();


					var dtablesmdl = $('#linkedcolumnsSC').DataTable({
						
						lengthChange: false,
						searching: false,
						ordering: false,
						paging: false,
						pageLength: 12,
						filter: false,
						info: false,
						responsive: false,
						<?=$dtable_lang?>
						columnDefs: [
							{"targets": eColsMdlA, "visible": false, "searchable": false},
						],
					});

					var dtablesmdld = $('#linkedcolumnsSCD').DataTable({
						
						lengthChange: false,
						searching: false,
						ordering: false,
						paging: false,
						pageLength: 12,
						filter: false,
						info: false,
						responsive: false,
						<?=$dtable_lang?>
						columnDefs: [
							{"targets": eColsMdlD, "visible": false, "searchable": false}
						],
					});


				}
			}
		})		
	}

	

	function get_prev_months_allowancesdeduct(empid){
		// alert(empid);
		var data;
		if(empid !=''){
			$.ajax({
				type: 'post',
				url: "ajax/get_prev_allow_deduct.php",
				async: false,
				data: {empid: empid},
				success: function(result){
					data = JSON.parse(result);
				}
			})
		}
		return data;
	}
	
	function modal_tax(){

		var empids = $('#Salarycalculator #empids').text();
		if(empids !=''){

			$.ajax({
				type: 'post',
				url: "ajax/get_payroll_data.php",
				async: false,
				data: {empid: empids},
				success: function(result){

					if(result == 'error'){
						$("body").overhang({
							type: "error",
							message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
							duration: 3,
							callback: function(v){
								window.location.reload();
							}
						})
					}else{

						var data = JSON.parse(result);

						$('#modalTAX #tx_spread_var_income').text('-');
						$('#modalTAX #tx_calc_base').text(data.calc_base);
						$('#modalTAX #tx_calc_tax').text(data.calc_tax);
						$('#modalTAX select#tx_calc_method option[value="'+data[0].calc_method+'"]').attr('selected',true);

						$('#modalTAX #tx_tax_deduction').text(number_format(data[0].total_deductions));
						$('#modalTAX #tx_tax_deduction_ytd').text(number_format(data[0].total_deductions));
						$('#modalTAX #tx_tax_deduction_cam').text(number_format(data[0].total_deductions));

						$('#modalTAX #tx_fixed_actual').text(number_format(data[0].fixed_actual_yearly));

						$('#modalTAX #tx_var_prev').text(number_format(data[0].variable_prev));
						$('#modalTAX #tx_var_prev_cam').text(number_format(data[0].variable_prev));
						
						$('#modalTAX #tx_var_curr').text(number_format(data[0].variable_curr));
						$('#modalTAX #tx_var_curr_cam').text(number_format(data[0].variable_curr));


						$('#modalTAX #tx_acm_fix1').text(data[0].acm_fix);
						$('#modalTAX #tx_acm_fix_prev1').text(data[0].acm_fix_prev);
						$('#modalTAX #tx_acm_fix_prev_var1').text(data[0].acm_fix_prev_var);

						$('#modalTAX #tx_acm_fix2').text(number_format(data[0].acm_fix_tax_calc));
						$('#modalTAX #tx_acm_fix_prev2').text(number_format(data[0].acm_fix_prev_tax_calc));
						$('#modalTAX #tx_acm_fix_prev_var2').text(number_format(data[0].acm_fix_prev_var_tax_calc));


						$('#modalTAX #tx_income_ytd').text(number_format(data[0].income_YTD));
						$('#modalTAX #tx_taxincome_ytd').text(data[0].ytd_income);
						$('#modalTAX #tx_tax_ytd').text(number_format(data[0].tax_ytd));

						$('#modalTAX #tx_fixedx12_cam').text(number_format(data[0].fixed_yearly));

						$('#modalTAX #tx_cam_fix1').text(data[0].cam_fix);
						$('#modalTAX #tx_cam_fix_prev1').text(data[0].cam_fix_prev);
						$('#modalTAX #tx_cam_fix_prev_var1').text(data[0].cam_fix_prev_var);

						$('#modalTAX #tx_cam_fix2').text(number_format(data[0].cam_fix_tax_calc));
						$('#modalTAX #tx_cam_fix_prev2').text(number_format(data[0].cam_fix_prev_tax_calc));
						$('#modalTAX #tx_cam_fix_prev_var2').text(number_format(data[0].cam_fix_prev_var_tax_calc));


						$('#modalTAX #tx_tot_tax_year_'+data[0].calc_method).text(number_format(data[0].total_tax_year));
						$('#modalTAX #tx_tot_prev_mnth_'+data[0].calc_method).text(number_format(data[0].tax_previous));
						$('#modalTAX #tx_tax_remaining_'+data[0].calc_method).text(number_format(data[0].tax_remaining));
						$('#modalTAX #tx_fix_this_mnth_'+data[0].calc_method).text(number_format(data[0].tax_fix_month));
						$('#modalTAX #tx_var_this_mnth_'+data[0].calc_method).text(number_format(data[0].tax_var_month));
						$('#modalTAX #tx_tax_this_mnth_'+data[0].calc_method).text(number_format(data[0].tax_this_month));
						$('#modalTAX #tx_tot_tax_next_mnth_'+data[0].calc_method).text(number_format(data[0].tax_tot_next_month));
						$('#modalTAX #tx_tax_next_mnth_'+data[0].calc_method).text(number_format(data[0].tax_next_month));
						$('#modalTAX #tx_tax_by_company_'+data[0].calc_method).text(number_format(data[0].tax_by_company));


						$('#modalTAX').modal('toggle');

					}
				}
			})

		}else{
			$("body").overhang({
				type: "error",
				message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: Error in employee id',
				duration: 3,
			})
		}
	}


	function modal_tax_deduction(){

		var empids = $('#Salarycalculator #empids').text();

		if(empids !=''){

			var get_sso_pvf_full_year_thbss = get_sso_pvf_full_year_thb(empids);

			$.ajax({
				type: 'post',
				url: "ajax/get_payroll_data.php",
				async: false,
				data: {empid: empids},
				success: function(result){

					if(result == 'error'){
						$("body").overhang({
							type: "error",
							message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
							duration: 3,
							callback: function(v){
								window.location.reload();
							}
						})
					}else{
						var data = JSON.parse(result);
						//console.log(data);

						//===================== SSO & PVF full year ================================//
						if(get_sso_pvf_full_year_thbss != 'error'){

							var pperiods = <?=json_encode($pperiods)?>;
							var short_months = <?=json_encode($short_months)?>;
							var curryear = <?=substr($_SESSION['rego']['cur_year'], -2)?>;

							//console.log(get_sso_pvf_full_year_thbss);
							//console.log(pperiods);
							// console.log(short_months);

							//append_full_table
							var tbl = '';
							var total_sso = 0.00;
							var total_pvf = 0.00;
							$.each(pperiods, function(k,v){

								var sso_thb=0.00;
								var pvf_thb=0.00;
								
								if(get_sso_pvf_full_year_thbss[k] == '[object Object]'){ 
									
									if(get_sso_pvf_full_year_thbss[k]['sso_employee'] > 0){
										sso_thb = get_sso_pvf_full_year_thbss[k]['sso_employee'];
									}

									if(get_sso_pvf_full_year_thbss[k]['pvf_employee'] > 0){
										pvf_thb = get_sso_pvf_full_year_thbss[k]['pvf_employee'];
									} 

								}else{
									sso_thb = (data[0].total_sso * v['sso_eRate']);

									if(sso_thb > v['sso_eMax']){ sso_thb = v['sso_eMax'];}
									else if(sso_thb < v['sso_eMin']){ sso_thb = v['sso_eMin'];}

									
									pvf_thb = data[0].pvf_employee;
								}

								sso_thb = parseFloat(sso_thb).toFixed(2);
								pvf_thb = parseFloat(pvf_thb).toFixed(2);

								total_sso = parseFloat(total_sso) + parseFloat(sso_thb);
								total_pvf = parseFloat(total_pvf) + parseFloat(pvf_thb);

								tbl += '<tr>';
								tbl += '<th class="tac">'+short_months[k]+'-'+curryear+'</th>';
								tbl += '<td class="tar" >'+v['sso_eRate']+'</td>';
								tbl += '<td class="tar" >'+v['sso_eMin']+'</td>';
								tbl += '<td class="tar" >'+v['sso_eMax']+'</td>';
								tbl += '<td class="tar" >'+sso_thb+'</td>';
								tbl += '<td class="tar" >'+pvf_thb+'</td>';
								tbl += '</tr>';

							});

							total_sso = parseFloat(total_sso).toFixed(2);
							total_pvf = parseFloat(total_pvf).toFixed(2);

							tbl += '<tr>';
							tbl += '<th class="tac">Total</th>';
							tbl += '<td></td>';
							tbl += '<td></td>';
							tbl += '<td></td>';
							tbl += '<td class="tar font-weight-bold">'+number_format(total_sso)+'</td>';
							tbl += '<td class="tar font-weight-bold">'+number_format(total_pvf)+'</td>';
							tbl += '</tr>';

							$('#append_full_table tr').remove();
							$('#append_full_table').append(tbl);
						}
						//===================== SSO & PVF full year ================================//

						$('#modalTAXDeduction #td_empid').text(data[0].emp_id);
						$('#modalTAXDeduction #td_empname').text(data[0].emp_name_en);

						$('#modalTAXDeduction #td_std_clcthb').text(data.calc_on_sd);
						$('#modalTAXDeduction #td_pcare_clcthb').text(data.calc_on_pc);
						$('#modalTAXDeduction #td_pvf_clcthb').text(data.calc_on_pf);
						$('#modalTAXDeduction #td_sso_clcthb').text(data.calc_on_ssf);

						$('#modalTAXDeduction #fixed_actual_income_std').text(data[0].fixed_actual_yearly);
						$('#modalTAXDeduction #fixed_actual_income_pcare').text(data[0].fixed_actual_yearly);

						//Calculation Standard deduction
						var std_fixed_actual = $('#fixed_actual_income_std').text();
						var multiply_bys = (std_fixed_actual * 0.5);

						var subtotal_std = std_fixed_actual;
						if(multiply_bys > 100000){
							subtotal_std = 100000;
						}
						$('#modalTAXDeduction #subtotal_std').text(subtotal_std);

						$('#modalTAXDeduction #td_manual_std').val(data[0].standard_deduction_manual);

						var td_manual_std = $('#td_manual_std').val();
						var td_std_deduct = subtotal_std;
						if(td_manual_std > 0){
							td_std_deduct = parseFloat(subtotal_std) + parseFloat(td_manual_std);
						}
						$('#modalTAXDeduction #td_std_deduct').text(td_std_deduct);

						//Calculation Personal Care
						var pcare_fixed_actual = $('#fixed_actual_income_pcare').text();
						var multiply_byp = (pcare_fixed_actual * 0.4);

						var subtotal_pcare = pcare_fixed_actual;
						if(multiply_byp > 60000){
							subtotal_pcare = 60000;
						}
						$('#modalTAXDeduction #subtotal_pcare').text(subtotal_pcare);
						$('#modalTAXDeduction #td_manual_pcare').val(data[0].personal_care_manual);

						var td_manual_pcare = $('#td_manual_pcare').val();
						var td_pcare_deduct = subtotal_pcare;
						if(td_manual_pcare > 0){
							td_pcare_deduct = parseFloat(subtotal_pcare) + parseFloat(td_manual_pcare);
						}
						$('#modalTAXDeduction #td_pcare_deduct').text(td_pcare_deduct);


						$('#modalTAXDeduction #th_income_sso_mnth').text(data[0].total_sso);
						$('#modalTAXDeduction #th_income_pvf_mnth').text(data[0].total_pvf);

						var td_subtotal_sso = total_sso;
						var td_subtotal_pvf = total_pvf;

						$('#modalTAXDeduction #td_subtotal_sso').text(td_subtotal_sso);
						$('#modalTAXDeduction #td_subtotal_pvf').text(td_subtotal_pvf);

						$('#modalTAXDeduction #td_manual_ssod').val(data[0].allow_sso_manual);
						var td_manual_ssod = $('#td_manual_ssod').val();
						var td_sso_deduct = td_subtotal_sso;
						if(td_manual_ssod > 0){
							td_sso_deduct = parseFloat(td_subtotal_sso) + parseFloat(td_manual_ssod);
						}

						$('#modalTAXDeduction #td_sso_deduct').text(td_sso_deduct);
						$('#modalTAXDeduction #td_manual_pvfd').val(data[0].allow_pvf_manual);

						var td_manual_pvfd = $('#td_manual_pvfd').val();
						var td_pvf_deduct = td_subtotal_pvf;
						if(td_manual_pvfd > 0){
							td_pvf_deduct = parseFloat(td_subtotal_pvf) + parseFloat(td_manual_pvfd);
						}

						$('#modalTAXDeduction #td_pvf_deduct').text(td_pvf_deduct);

						/*var td_std_deduct1 = 0; 
						if(data[0].tax_standard_deduction > 0){
							td_std_deduct1 = data[0].tax_standard_deduction;
						}
						var td_pcare_deduct1 = 0; 
						if(data[0].tax_personal_allowance > 0){
							td_pcare_deduct1 = data[0].tax_personal_allowance;
						}
						var td_pvf_deduct1 = 0; 
						if(data[0].tax_allow_pvf > 0){
							td_pvf_deduct1 = data[0].tax_allow_pvf;
						}
						var td_sso_deduct1 = 0; 
						if(data[0].tax_allow_sso > 0){
							td_sso_deduct1 = data[0].tax_allow_sso;
						}*/

						$('#modalTAXDeduction #td_std_deduction').text(td_std_deduct);
						$('#modalTAXDeduction #td_pers_care').text(td_pcare_deduct);
						$('#modalTAXDeduction #td_pvf_empsss').text(td_pvf_deduct);
						$('#modalTAXDeduction #td_sso_empsss').text(td_sso_deduct);

						$('#modalTAXDeduction #td_other_deduct').text(data[0].total_other_tax_deductions);

						var sum_all_deduction = parseFloat(td_std_deduct) + parseFloat(td_pcare_deduct) + parseFloat(td_sso_deduct) + parseFloat(td_pvf_deduct) + parseFloat(data[0].total_other_tax_deductions);
						var tb_sum_all = parseFloat(sum_all_deduction).toFixed(2);
						$('#modalTAXDeduction #td_total_tax_deduct').text(tb_sum_all);

						$('#modalTAXDeduction #td_pvf_emp').text(data[0].pvf_rate_emp);

						$('#modalTAXDeduction').modal('toggle');
					}
				}
			})

		}else{
			$("body").overhang({
				type: "error",
				message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: Error in employee id',
				duration: 3,
			})
		}
	}

	function get_sso_pvf_full_year_thb(empid){
		// alert(empid);
		var data;
		if(empid !=''){
			$.ajax({
				type: 'post',
				url: "ajax/get_sso_pvf_data.php",
				async: false,
				data: {empid: empid},
				success: function(result){
					data = JSON.parse(result);
				}
			})
		}
		return data;
	}

	function tax_deduct_calc(that){

		//Calculation Standard deduction
		var std_fixed_actual = $('#fixed_actual_income_std').text();
		var multiply_bys = (std_fixed_actual * 0.5);

		var subtotal_std = std_fixed_actual;
		if(multiply_bys > 100000){
			subtotal_std = 100000;
		}
		$('#modalTAXDeduction #subtotal_std').text(subtotal_std);

		var td_manual_std = $('#td_manual_std').val();
		var td_std_deduct = subtotal_std;
		if(td_manual_std > 0){
			td_std_deduct = parseFloat(subtotal_std) + parseFloat(td_manual_std);
		}
		$('#modalTAXDeduction #td_std_deduct').text(td_std_deduct);

		//Calculation Personal Care
		var pcare_fixed_actual = $('#fixed_actual_income_pcare').text();
		var multiply_byp = (pcare_fixed_actual * 0.4);

		var subtotal_pcare = pcare_fixed_actual;
		if(multiply_byp > 60000){
			subtotal_pcare = 60000;
		}
		$('#modalTAXDeduction #subtotal_pcare').text(subtotal_pcare);

		var td_manual_pcare = $('#td_manual_pcare').val();
		var td_pcare_deduct = subtotal_pcare;
		if(td_manual_pcare > 0){
			td_pcare_deduct = parseFloat(subtotal_pcare) + parseFloat(td_manual_pcare);
		}
		$('#modalTAXDeduction #td_pcare_deduct').text(td_pcare_deduct);


		var td_subtotal_sso = $('#modalTAXDeduction #td_subtotal_sso').text();
		var td_subtotal_pvf = $('#modalTAXDeduction #td_subtotal_pvf').text();

		$('#modalTAXDeduction #td_subtotal_sso').text(td_subtotal_sso);
		$('#modalTAXDeduction #td_subtotal_pvf').text(td_subtotal_pvf);

		var td_manual_ssod = $('#td_manual_ssod').val();
		var td_sso_deduct = td_subtotal_sso;
		if(td_manual_ssod > 0){
			td_sso_deduct = parseFloat(td_subtotal_sso) + parseFloat(td_manual_ssod);
		}

		$('#modalTAXDeduction #td_sso_deduct').text(td_sso_deduct);

		var td_manual_pvfd = $('#td_manual_pvfd').val();
		var td_pvf_deduct = td_subtotal_pvf;
		if(td_manual_pvfd > 0){
			td_pvf_deduct = parseFloat(td_subtotal_pvf) + parseFloat(td_manual_pvfd);
		}

		$('#modalTAXDeduction #td_pvf_deduct').text(td_pvf_deduct);

		$('#modalTAXDeduction #td_std_deduction').text(td_std_deduct);
		$('#modalTAXDeduction #td_pers_care').text(td_pcare_deduct);
		$('#modalTAXDeduction #td_pvf_empsss').text(td_pvf_deduct);
		$('#modalTAXDeduction #td_sso_empsss').text(td_sso_deduct);
		//$('#modalTAXDeduction #td_other_deduct').text(data[0].total_other_tax_deduction);

		var total_other_tax_deduction = $('#td_other_deduct').text();
		var sum_all_deduction = parseFloat(td_std_deduct) + parseFloat(td_pcare_deduct) + parseFloat(td_sso_deduct) + parseFloat(td_pvf_deduct) + parseFloat(total_other_tax_deduction);
		var tb_sum_all = parseFloat(sum_all_deduction).toFixed(2);
		$('#modalTAXDeduction #td_total_tax_deduct').text(tb_sum_all);
	}

	function modal_pvf(){

		var empids = $('#Salarycalculator #empids').text();
		if(empids !=''){
			$.ajax({
				type: 'post',
				url: "ajax/get_payroll_data.php",
				data: {empid: empids},
				success: function(result){

					if(result == 'error'){
						$("body").overhang({
							type: "error",
							message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
							duration: 3,
							callback: function(v){
								window.location.reload();
							}
						})
					}else{
						var data = JSON.parse(result);
						//console.log(data);

						$('#modalPVF #pvf_empid').text(data[0].emp_id);
						$('#modalPVF #pvf_empname').text(data[0].emp_name_en);

						$('#modalPVF select[name="pvf_calc_pvf"] option[value="'+data[0].calc_pvf+'"]').attr('selected',true);

						$('#modalPVF #pvf_income_pvf_emp').text(data[0].total_pvf);


						if(data[0].perc_thb_pvf == 1){
							$('#modalPVF #pvf_rate_pvf_emp').text(data[0].pvf_rate_emp+'%');
							$('#modalPVF #pvf_amt_thb_emp').text('0');
						}else{
							$('#modalPVF #pvf_rate_pvf_emp').text('0');
							$('#modalPVF #pvf_amt_thb_emp').text(data[0].pvf_rate_emp);
						}

						if(data[0].perc_thb_pvf == 1){
							$('#modalPVF #pvf_rate_pvf_comp').text(data[0].pvf_rate_com+'%');
							$('#modalPVF #pvf_amt_thb_comp').text('0');
						}else{
							$('#modalPVF #pvf_rate_pvf_comp').text('0');
							$('#modalPVF #pvf_amt_thb_comp').text(data[0].pvf_rate_emp);
						}

						$('#modalPVF #pvf_manual_emp').val(data[0].pvf_emp_manual);
						$('#modalPVF #pvf_manual_comp').val(data[0].pvf_comp_manual);

						$('#modalPVF #pvf_income_pvf_comp').text(data[0].total_pvf);
						

						//pvf_calculate_emp
						var pvf_calc_pvf = $('select[name="pvf_calc_pvf"]').val();

						var pvf_income_pvf_emp = $('#pvf_income_pvf_emp').text();
						var pvf_rate_pvf_emp = $('#pvf_rate_pvf_emp').text();
						var rate_pvf_emp = pvf_rate_pvf_emp.replace('%','');
						var getvalueEmp = rate_pvf_emp / 100;

						var pvf_calc_emp = 0;
						if(pvf_calc_pvf == 1){
							if(getvalueEmp > 0){
								pvf_calc_emp = parseFloat(pvf_income_pvf_emp) + parseFloat(getvalueEmp);
							}else{
								pvf_calc_emp = $('#pvf_amt_thb_emp').text();
							}
						}

						$('#modalPVF #pvf_calculate_emp').text(pvf_calc_emp);

						var pvf_manual_emp = $('#pvf_manual_emp').val();
						var pvf_pvfemp_empss = pvf_calc_emp;
						if(pvf_manual_emp > 0){
							pvf_pvfemp_empss = parseFloat(pvf_calc_emp) + parseFloat(pvf_manual_emp);
						}

						$('#modalPVF #pvf_pvfemp_emp').text(pvf_pvfemp_empss);


						//pvf_calculate_comp
						var pvf_income_pvf_comp = $('#pvf_income_pvf_comp').text();
						var pvf_rate_pvf_comp = $('#pvf_rate_pvf_comp').text();
						var rate_pvf_comp = pvf_rate_pvf_comp.replace('%','');
						var getvalueComp = rate_pvf_comp / 100;

						var pvf_calc_comp = 0;
						if(pvf_calc_pvf == 1){
							if(getvalueComp > 0){
								pvf_calc_comp = parseFloat(pvf_income_pvf_comp) + parseFloat(getvalueComp);
							}else{
								pvf_calc_comp = $('#pvf_amt_thb_emp').text();
							}
						}

						$('#modalPVF #pvf_calculate_comp').text(pvf_calc_comp);

						var pvf_manual_comp = $('#pvf_manual_comp').val();
						var pvf_pvfcom_comp = pvf_calc_comp;
						if(pvf_manual_comp > 0){
							pvf_pvfcom_comp = parseFloat(pvf_calc_comp) + parseFloat(pvf_manual_comp);
						}

						$('#modalPVF #pvf_pvfcom_comp').text(pvf_pvfcom_comp);

						$('#modalPVF').modal('toggle');
					}
				}
			})

		}else{
			$("body").overhang({
				type: "error",
				message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: Error in employee id',
				duration: 3,
			})
		}
	}

	function PVF_calc(that){

		var pvf_calc_pvf = $('select[name="pvf_calc_pvf"]').val();
		var pvf_manual_emp = $('#pvf_manual_emp').val();
		var pvf_manual_comp = $('#pvf_manual_comp').val();

		//pvf_calculate_emp	
		var pvf_income_pvf_emp = $('#pvf_income_pvf_emp').text();
		var pvf_rate_pvf_emp = $('#pvf_rate_pvf_emp').text();
		var rate_pvf_emp = pvf_rate_pvf_emp.replace('%','');
		var getvalueEmp = rate_pvf_emp / 100;

		var pvf_calc_emp = 0;
		if(pvf_calc_pvf == 1){
			if(getvalueEmp > 0){
				pvf_calc_emp = parseFloat(pvf_income_pvf_emp) + parseFloat(getvalueEmp);
			}else{
				pvf_calc_emp = $('#pvf_amt_thb_emp').text();
			}
		}

		$('#modalPVF #pvf_calculate_emp').text(pvf_calc_emp);

	
		var pvf_pvfemp_empss = pvf_calc_emp;
		if(pvf_manual_emp > 0){
			pvf_pvfemp_empss = parseFloat(pvf_calc_emp) + parseFloat(pvf_manual_emp);
		}

		$('#modalPVF #pvf_pvfemp_emp').text(pvf_pvfemp_empss);


		//pvf_calculate_comp
		var pvf_income_pvf_comp = $('#pvf_income_pvf_comp').text();
		var pvf_rate_pvf_comp = $('#pvf_rate_pvf_comp').text();
		var rate_pvf_comp = pvf_rate_pvf_comp.replace('%','');
		var getvalueComp = rate_pvf_comp / 100;

		var pvf_calc_comp = 0;
		if(pvf_calc_pvf == 1){
			if(getvalueComp > 0){
				pvf_calc_comp = parseFloat(pvf_income_pvf_comp) + parseFloat(getvalueComp);
			}else{
				pvf_calc_comp = $('#pvf_amt_thb_emp').text();
			}
		}

		$('#modalPVF #pvf_calculate_comp').text(pvf_calc_comp);

		var pvf_pvfcom_comp = pvf_calc_comp;
		if(pvf_manual_comp > 0){
			pvf_pvfcom_comp = parseFloat(pvf_calc_comp) + parseFloat(pvf_manual_comp);
		}

		$('#modalPVF #pvf_pvfcom_comp').text(pvf_pvfcom_comp);

	}

	function modal_psf(){

		var empids = $('#Salarycalculator #empids').text();
		if(empids !=''){
			$.ajax({
				type: 'post',
				url: "ajax/get_payroll_data.php",
				data: {empid: empids},
				success: function(result){

					if(result == 'error'){
						$("body").overhang({
							type: "error",
							message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
							duration: 3,
							callback: function(v){
								window.location.reload();
							}
						})
					}else{
						var data = JSON.parse(result);
						//console.log(data);

						$('#modalPSF #psf_empid').text(data[0].emp_id);
						$('#modalPSF #psf_empname').text(data[0].emp_name_en);

						$('#modalPSF #psf_income_emp').text(data[0].total_psf);
						$('#modalPSF #psf_income_comp').text(data[0].total_psf);

						$('#modalPSF select[name="psf_calc_sso"] option[value="'+data[0].calc_psf+'"]').attr('selected',true);

						if(data[0].perc_thb_psf == 1){
							$('#modalPSF #psf_rate_psf_emp').text(data[0].psf_rate_emp+'%');
							$('#modalPSF #psf_amt_thb_emp').text('0');
						}else{
							$('#modalPSF #psf_rate_psf_emp').text('0');
							$('#modalPSF #psf_amt_thb_emp').text(data[0].psf_rate_emp);
						}

						if(data[0].perc_thb_psf == 1){
							$('#modalPSF #psf_rate_psf_comp').text(data[0].psf_rate_com+'%');
							$('#modalPSF #psf_amt_thb_comp').text('0');
						}else{
							$('#modalPSF #psf_rate_psf_comp').text('0');
							$('#modalPSF #psf_amt_thb_comp').text(data[0].psf_rate_com);
						}

						$('#modalPSF #psf_manual_emp').val(data[0].psf_emp_manual);
						$('#modalPSF #psf_manual_comp').val(data[0].psf_comp_manual);
						

						//psf_calculate_emp
						var psf_calc_sso = $('select[name="psf_calc_sso"]').val();
						var psf_income_emp = $('#psf_income_emp').text();

						var psf_rate_psf_emp = $('#psf_rate_psf_emp').text();
						var rate_psf_emp = psf_rate_psf_emp.replace('%','');
						var getvaluepsfEmp = rate_psf_emp / 100;

						var psf_calc_emp = 0;
						if(psf_calc_sso == 1){
							if(getvaluepsfEmp > 0){
								psf_calc_emp = parseFloat(psf_income_emp) + parseFloat(getvaluepsfEmp);
							}else{
								psf_calc_emp = $('#psf_amt_thb_emp').text();
							}
						}

						var psf_calc_emp_twodig = parseFloat(psf_calc_emp).toFixed(2);
						$('#modalPSF #psf_calculate_emp').text(psf_calc_emp_twodig);

						var psf_manual_emp = $('#psf_manual_emp').val();
						var psf_psf_emp = psf_calc_emp;
						if(psf_manual_emp > 0){
							psf_psf_emp = parseFloat(psf_calc_emp) + parseFloat(psf_manual_emp);
						}

						var psf_psf_emp_twodig = parseFloat(psf_psf_emp).toFixed(2);
						$('#modalPSF #psf_psf_emp').text(psf_psf_emp_twodig);

						//psf_income_comp
						var psf_income_comp = $('#psf_income_comp').text();
						var psf_rate_psf_comp = $('#psf_rate_psf_comp').text();
						var rate_psf_comp = psf_rate_psf_comp.replace('%','');
						var getvaluepsfCom = rate_psf_comp / 100;

						var psf_calc_comp = 0;
						if(psf_calc_sso == 1){
							if(getvaluepsfCom > 0){
								psf_calc_comp = parseFloat(psf_income_comp) + parseFloat(getvaluepsfCom);
							}else{
								psf_calc_comp = $('#psf_amt_thb_comp').text();
							}
						}

						var psf_calc_comp_twodig = parseFloat(psf_calc_comp).toFixed(2);
						$('#modalPSF #psf_calculate_comp').text(psf_calc_comp_twodig);

						var psf_manual_comp = $('#psf_manual_comp').val();
						var psf_psf_comp = psf_calc_comp;
						if(psf_manual_comp > 0){
							psf_psf_comp = parseFloat(psf_calc_comp) + parseFloat(psf_manual_comp);
						}

						var psf_psf_comp_twodig = parseFloat(psf_psf_comp).toFixed(2);
						$('#modalPSF #psf_psf_comp').text(psf_psf_comp_twodig);


						$('#modalPSF').modal('toggle');
					}
				}
			})

		}else{
			$("body").overhang({
				type: "error",
				message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: Error in employee id',
				duration: 3,
			})
		}
	}

	function PSF_calc(that){

		var psf_calc_sso = $('select[name="psf_calc_sso"]').val();
		var psf_manual_emp = $('#psf_manual_emp').val();
		var psf_manual_comp = $('#psf_manual_comp').val();

		//psf_calculate_emp
		var psf_income_emp = $('#psf_income_emp').text();

		var psf_rate_psf_emp = $('#psf_rate_psf_emp').text();
		var rate_psf_emp = psf_rate_psf_emp.replace('%','');
		var getvaluepsfEmp = rate_psf_emp / 100;

		var psf_calc_emp = 0;
		if(psf_calc_sso == 1){
			if(getvaluepsfEmp > 0){
				psf_calc_emp = parseFloat(psf_income_emp) + parseFloat(getvaluepsfEmp);
			}else{
				psf_calc_emp = $('#psf_amt_thb_emp').text();
			}
		}

		var psf_calc_emp_twodig = parseFloat(psf_calc_emp).toFixed(2);

		$('#modalPSF #psf_calculate_emp').text(psf_calc_emp_twodig);

		
		var psf_psf_emp = psf_calc_emp;
		if(psf_manual_emp > 0){
			psf_psf_emp = parseFloat(psf_calc_emp) + parseFloat(psf_manual_emp);
		}

		var psf_psf_emp_twodig = parseFloat(psf_psf_emp).toFixed(2);
		$('#modalPSF #psf_psf_emp').text(psf_psf_emp_twodig);

		//psf_income_comp
		var psf_income_comp = $('#psf_income_comp').text();
		var psf_rate_psf_comp = $('#psf_rate_psf_comp').text();
		var rate_psf_comp = psf_rate_psf_comp.replace('%','');
		var getvaluepsfCom = rate_psf_comp / 100;

		var psf_calc_comp = 0;
		if(psf_calc_sso == 1){
			if(getvaluepsfCom > 0){
				psf_calc_comp = parseFloat(psf_income_comp) + parseFloat(getvaluepsfCom);
			}else{
				psf_calc_comp = $('#psf_amt_thb_comp').text();
			}
		}

		var psf_calc_comp_twodig = parseFloat(psf_calc_comp).toFixed(2);
		$('#modalPSF #psf_calculate_comp').text(psf_calc_comp_twodig);

		var psf_psf_comp = psf_calc_comp;
		if(psf_manual_comp > 0){
			psf_psf_comp = parseFloat(psf_calc_comp) + parseFloat(psf_manual_comp);
		}

		var psf_psf_comp_twodig = parseFloat(psf_psf_comp).toFixed(2);
		$('#modalPSF #psf_psf_comp').text(psf_psf_comp_twodig);

	}


	function modal_sso(){
		var empids = $('#Salarycalculator #empids').text();
		if(empids !=''){
			$.ajax({
				type: 'post',
				url: "ajax/get_payroll_data.php",
				data: {empid: empids},
				success: function(result){

					if(result == 'error'){
						$("body").overhang({
							type: "error",
							message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
							duration: 3,
							callback: function(v){
								window.location.reload();
							}
						})
					}else{
						var data = JSON.parse(result);
						//console.log(data);

						$('#modalSSO #sso_empid').text(data[0].emp_id);
						$('#modalSSO #sso_empname').text(data[0].emp_name_en);

						$('#modalSSO select[name="ss_calc_sso"] option[value="'+data[0].calc_sso+'"]').attr('selected',true);
						$('#modalSSO select[name="ss_paidby_sso"] option[value="'+data[0].sso_by+'"]').attr('selected',true);

						$('#modalSSO #sso_total_sso_emp').text(data[0].total_sso);
						$('#modalSSO #sso_total_sso_comp').text(data[0].total_sso);

						$('#modalSSO #sso_manual_emp').val(data[0].sso_emp_manual);
						$('#modalSSO #sso_manual_comp').val(data[0].sso_comp_manual);

						//sso_calculate_sso_emp
						var ss_calc_sso = $('select[name="ss_calc_sso"]').val();

						var sso_rate_emp = $('#sso_rate_emp').text();
						var replace_percent = sso_rate_emp.replace('%','');

						var min_emp = $('#sso_min_emp').text();
						var max_emp = $('#sso_max_emp').text();

						var calculate_sso_emp = 0;
						if(ss_calc_sso == 1){
							var calcforemp = (data[0].total_sso * replace_percent) / 100;
							//calcforemp = (calcforemp > max_emp ? max_emp : calcforemp);
							//calcforemp = (calcforemp < min_emp ? min_emp : calcforemp);

							var calcforempv;
							if(calcforemp > max_emp){
								calcforempv = max_emp;
							}else if(calcforemp < min_emp){
								calcforempv = min_emp;
							}else{
								calcforempv = calcforemp;
							}

							calculate_sso_emp = calcforempv;
							calculate_sso_emp = parseFloat(calculate_sso_emp).toFixed(2);
							//alert(calculate_sso_emp);
						}

						
						$('#modalSSO #sso_calculate_sso_emp').text(calculate_sso_emp);

						var manual_emp = $('#sso_manual_emp').val();
						if(manual_emp > 0){
							var sso_emp_sso = parseFloat(calculate_sso_emp) + parseFloat(manual_emp);
						}else{
							var sso_emp_sso = calculate_sso_emp;
						}
						
						$('#modalSSO #sso_emp_sso').text(sso_emp_sso);

						var ss_paidby_sso = $('select[name="ss_paidby_sso"]').val();
						var sso_by_company = 0;	
						if(ss_paidby_sso == 1){
							sso_by_company = sso_emp_sso;
							sso_by_company = parseFloat(sso_by_company).toFixed(2);
						}
						
						$('#modalSSO #sso_sso_by_company').text(sso_by_company);

						//sso_calculate_sso_employer
						var sso_total_sso_comp = $('#sso_total_sso_comp').text();

						var sso_rate_comp = $('#sso_rate_comp').text();
						var replace_percent_comp = sso_rate_comp.replace('%','');

						var min_comp = $('#sso_min_comp').text();
						var max_comp = $('#sso_max_comp').text();

						var calculate_sso_comp = 0;
						if(ss_calc_sso == 1){
							var calcforcomp = (sso_total_sso_comp * replace_percent_comp) / 100;
							//calcforcomp = (calcforcomp > max_comp ? max_comp : calcforcomp);
							//calcforcomp = (calcforcomp < min_comp ? min_comp : calcforcomp);

							var calcforempc;
							if(calcforcomp > max_comp){
								calcforempc = max_comp;
							}else if(calcforcomp < min_comp){
								calcforempc = min_comp;
							}else{
								calcforempc = calcforcomp;
							}

							calculate_sso_comp = calcforempc;
							calculate_sso_comp = parseFloat(calculate_sso_comp).toFixed(2);
						}
						
						 
						$('#modalSSO #sso_calculate_sso_comp').text(calculate_sso_comp);

						var manual_comp = $('#sso_manual_comp').val(); 
						//alert(manual_comp);
						var sso_sso_employer = calculate_sso_comp;
						if(manual_comp > 0){
							sso_sso_employer = parseFloat(calculate_sso_comp) + parseFloat(manual_comp);
						}
						//alert(sso_sso_employer);
						$('#sso_sso_employerss').text(sso_sso_employer);
						
						$('#modalSSO').modal('toggle');
					}
				}
			})

		}else{
			$("body").overhang({
				type: "error",
				message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: Error in employee id',
				duration: 3,
			})
		}
	}

	function SSO_calc(that){

		var ss_calc_ssos = $('#sss_calc_sso').val();
		var ss_paidby_ssos = $('#sss_paidby_sso').val();
		var sso_manual_emp = $('#sso_manual_emp').val();
		var sso_manual_comp = $('#sso_manual_comp').val();

		/*alert(ss_calc_sso);
		alert(ss_paidby_sso);
		alert(sso_manual_emp);
		alert(sso_manual_comp);*/

		//sso_calculate_sso_emp
		var ss_calc_sso = ss_calc_ssos;

		var sso_rate_emp = $('#sso_rate_emp').text();
		var replace_percent = sso_rate_emp.replace('%','');

		var min_emp = $('#sso_min_emp').text();
		var max_emp = $('#sso_max_emp').text();

		var sso_total_sso_emp = $('#sso_total_sso_emp').text();

		var calculate_sso_emp = 0;
		if(ss_calc_sso == 1){
			var calcforemp = (sso_total_sso_emp * replace_percent) / 100;
			//calcforemp = (calcforemp > max_emp ? max_emp : calcforemp);
			//calcforemp = (calcforemp < min_emp ? min_emp : calcforemp);

			var calcforempv;
			if(calcforemp > max_emp){
				calcforempv = max_emp;
			}else if(calcforemp < min_emp){
				calcforempv = min_emp;
			}else{
				calcforempv = calcforemp;
			}

			calculate_sso_emp = calcforempv;
			calculate_sso_emp = parseFloat(calculate_sso_emp).toFixed(2);
		}

		
		$('#modalSSO #sso_calculate_sso_emp').text(calculate_sso_emp);

		var manual_emp = sso_manual_emp;
		if(manual_emp > 0){
			var sso_emp_sso = parseFloat(calculate_sso_emp) + parseFloat(manual_emp);
		}else{
			var sso_emp_sso = calculate_sso_emp;
			sso_emp_sso = parseFloat(sso_emp_sso).toFixed(2);
		}
		
		
		$('#modalSSO #sso_emp_sso').text(sso_emp_sso);

		var ss_paidby_sso = ss_paidby_ssos;
		var sso_by_company = 0;	
		if(ss_paidby_sso == 1){
			sso_by_company = sso_emp_sso;
			sso_by_company = parseFloat(sso_by_company).toFixed(2);
		}

		$('#modalSSO #sso_sso_by_company').text(sso_by_company);

		//sso_calculate_sso_employer
		var sso_total_sso_comp = $('#sso_total_sso_comp').text();

		var sso_rate_comp = $('#sso_rate_comp').text();
		var replace_percent_comp = sso_rate_comp.replace('%','');

		var min_comp = $('#sso_min_comp').text();
		var max_comp = $('#sso_max_comp').text();

		var calculate_sso_comp = 0;
		if(ss_calc_sso == 1){
			var calcforcomp = (sso_total_sso_comp * replace_percent_comp) / 100;
			//calcforcomp = (calcforcomp > max_comp ? max_comp : calcforcomp);
			//calcforcomp = (calcforcomp < min_comp ? min_comp : calcforcomp);

			var calcforempc;
			if(calcforcomp > max_comp){
				calcforempc = max_comp;
			}else if(calcforcomp < min_comp){
				calcforempc = min_comp;
			}else{
				calcforempc = calcforcomp;
			}

			calculate_sso_comp = parseFloat(calcforempc);
		}
		$('#modalSSO #sso_calculate_sso_comp').text(calculate_sso_comp);

		var manual_comp = sso_manual_comp; 
		//alert(manual_comp);
		var sso_sso_employer = calculate_sso_comp;
		if(manual_comp > 0){
			sso_sso_employer = parseFloat(calculate_sso_comp) + parseFloat(manual_comp);
		}
		//alert(sso_sso_employer);
		$('#sso_sso_employerss').text(sso_sso_employer);
	}
	
	$(document).ready(function(){

		//=========== Two table scroll using one scroll bar =======//

		/*var oldRst2 = 0;
		$('table#linkedcolumnsSC').on('scroll', function () {
		  l2 = $('table#linkedcolumnsSC');
		  var lst2 = l2.scrollLeft();
		  var rst2 = $(this).scrollLeft();

		  l2.scrollLeft(lst2+(rst2-oldRst2));
		  
		  oldRst2 = rst2;
		});

		var oldRst13 = 0;
		$('div#Bothtable').on('scroll', function () {
		  l13 = $('div#Bothtable');
		  var lst13 = l13.scrollLeft();
		  var rst13 = $(this).scrollLeft();
		  
		  l13.scrollLeft(lst13+(rst13-oldRst13));
		  
		  oldRst13 = rst13;
		});        

		var oldRst14 = 0;
		$('div#hidediv2 table#scrolltable').on('scroll', function () {

		  l14 = $('div#Bothtable');
		  var lst14 = l14.scrollLeft();
		  var rst14 = $(this).scrollLeft();
		  l14.scrollLeft(lst14+(rst14-oldRst14));
		  
		  oldRst14 = rst14;
		}); */

		// var oldRst15 = 0;
		// $('div#hidediv2 table#scrolltable').on('scroll', function () {

		//   l15 = $('table#linkedcolumnsSCD');
		//   var lst15 = l15.scrollLeft();
		//   var rst15 = $(this).scrollLeft();
		//   l15.scrollLeft(lst15+(rst15-oldRst15));
		  
		//   oldRst15 = rst15;
		// });

		//=========== Two table scroll using one scroll bar =======//

		

		

		//============== Save SSO DATA =============//

		function calculate_payroll_again(empid){
			 $.ajax({
				type: 'POST',
				url: "ajax/calculate_payroll.php",
				data: {empid: empid},
				success: function(result){

					if(result == 'success'){
						
						$("body").overhang({
							type: "success",
							message: '<i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Payroll calculated successfuly']?>',
							duration: 3,
							callback: function(v){
								window.location.reload();
							}
						})

					}else{

						$("body").overhang({
							type: "error",
							message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
							duration: 3,
							callback: function(v){
								window.location.reload();
							}
						})
					}
				}
			})
		}

		$('#SaveSSOdata').click(function(){
			var empids = $('#sso_empid').text();
			if(empids !=''){

				var sss_calc_sso = $('#sss_calc_sso').val();
				var sss_paidby_sso = $('#sss_paidby_sso').val();

				var sso_calculate_sso_emp = $('#sso_calculate_sso_emp').text();
				var sso_manual_emp = $('#sso_manual_emp').val();
				var sso_emp_sso = $('#sso_emp_sso').text();
				var sso_sso_by_company = $('#sso_sso_by_company').text();

				var sso_calculate_sso_comp = $('#sso_calculate_sso_comp').text();
				var sso_manual_comp = $('#sso_manual_comp').val();
				var sso_sso_employerss = $('#sso_sso_employerss').text();

				$.ajax({
					type: 'post',
					url: "tabs/ajax/save_sso_data.php",
					data: {empids: empids, sss_calc_sso: sss_calc_sso, sss_paidby_sso: sss_paidby_sso, sso_calculate_sso_emp: sso_calculate_sso_emp, sso_manual_emp: sso_manual_emp, sso_emp_sso:sso_emp_sso, sso_sso_by_company: sso_sso_by_company, sso_calculate_sso_comp: sso_calculate_sso_comp, sso_manual_comp: sso_manual_comp, sso_sso_employerss: sso_sso_employerss},
					success: function(result){

						if(result == 'success'){
							calculate_payroll_again(empids);							
						}else{

							$("body").overhang({
								type: "error",
								message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
								duration: 3,
								callback: function(v){
									window.location.reload();
								}
							})
						}
					}
				})
			}
		});


		//============== Save PVF DATA =============//
		$('#SavePVFdata').click(function(){
			var empids = $('#pvf_empid').text();
			if(empids !=''){

				var pvfss_calc_pvf = $('#pvfss_calc_pvf').val();
				var pvf_calculate_emp = $('#pvf_calculate_emp').text();
				var pvf_manual_emp = $('#pvf_manual_emp').val();
				var pvf_pvfemp_emp = $('#pvf_pvfemp_emp').text();

				var pvf_calculate_comp = $('#pvf_calculate_comp').text();
				var pvf_manual_comp = $('#pvf_manual_comp').val();
				var pvf_pvfcom_comp = $('#pvf_pvfcom_comp').text();

				$.ajax({
					type: 'post',
					url: "tabs/ajax/save_pvf_data.php",
					data: {empids: empids, pvfss_calc_pvf: pvfss_calc_pvf, pvf_calculate_emp: pvf_calculate_emp, pvf_manual_emp: pvf_manual_emp, pvf_pvfemp_emp: pvf_pvfemp_emp, pvf_calculate_comp: pvf_calculate_comp, pvf_manual_comp: pvf_manual_comp, pvf_pvfcom_comp: pvf_pvfcom_comp},
					success: function(result){

						if(result == 'success'){
							calculate_payroll_again(empids);							
						}else{

							$("body").overhang({
								type: "error",
								message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
								duration: 3,
								callback: function(v){
									window.location.reload();
								}
							})
						}
					}
				})
			}
		});

		

		//============== Save PSF DATA =============//
		$('#SavePSFdata').click(function(){
			var empids = $('#psf_empid').text();
			if(empids !=''){

				var psfss_calc_sso = $('#psfss_calc_sso').val();
				var psf_calculate_emp = $('#psf_calculate_emp').text();
				var psf_manual_emp = $('#psf_manual_emp').val();
				var psf_psf_emp = $('#psf_psf_emp').text();

				var psf_calculate_comp = $('#psf_calculate_comp').text();
				var psf_manual_comp = $('#psf_manual_comp').val();
				var psf_psf_comp = $('#psf_psf_comp').text();

				$.ajax({
					type: 'post',
					url: "tabs/ajax/save_psf_data.php",
					data: {empids: empids, psfss_calc_sso: psfss_calc_sso, psf_calculate_emp: psf_calculate_emp, psf_manual_emp: psf_manual_emp, psf_psf_emp: psf_psf_emp, psf_calculate_comp: psf_calculate_comp, psf_manual_comp: psf_manual_comp, psf_psf_comp: psf_psf_comp},
					success: function(result){

						if(result == 'success'){
							calculate_payroll_again(empids);							
						}else{

							$("body").overhang({
								type: "error",
								message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
								duration: 3,
								callback: function(v){
									window.location.reload();
								}
							})
						}
					}
				})
			}
		});


		//============== Save TAX DATA =============//
		$('#SaveTAXdata').click(function(){
			var empids = $('#Salarycalculator #empids').text(); 
			//alert(empids);
			
			if(empids !=''){

				var tx_calc_method = $('#tx_calc_method').val();

				$.ajax({
					type: 'post',
					url: "tabs/ajax/save_tax_data.php",
					data: {empids: empids, tx_calc_method: tx_calc_method},
					success: function(result){

						if(result == 'success'){
							calculate_payroll_again(empids);							
						}else{

							$("body").overhang({
								type: "error",
								message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
								duration: 3,
								callback: function(v){
									window.location.reload();
								}
							})
						}
					}
				})
			}
		});

		
		//============== Save Tax Deduction DATA =============//
		$('#SaveTDdata').click(function(){
			var empids = $('#td_empid').text();
			if(empids !=''){

				var subtotal_std = $('#subtotal_std').text();
				var td_manual_std = $('#td_manual_std').val();
				var td_std_deduct = $('#td_std_deduct').text();

				var subtotal_pcare = $('#subtotal_pcare').text();
				var td_manual_pcare = $('#td_manual_pcare').val();
				var td_pcare_deduct = $('#td_pcare_deduct').text();

				var td_subtotal_sso = $('#td_subtotal_sso').text();
				var td_manual_ssod = $('#td_manual_ssod').val();
				var td_sso_deduct = $('#td_sso_deduct').text();

				var td_subtotal_pvf = $('#td_subtotal_pvf').text();
				var td_manual_pvfd = $('#td_manual_pvfd').val();
				var td_pvf_deduct = $('#td_pvf_deduct').text();

				$.ajax({
					type: 'post',
					url: "tabs/ajax/save_tax_deduction_data.php",
					data: {empids: empids, subtotal_std: subtotal_std, td_manual_std: td_manual_std, td_std_deduct: td_std_deduct, subtotal_pcare: subtotal_pcare, td_manual_pcare: td_manual_pcare, td_pcare_deduct: td_pcare_deduct, td_subtotal_sso: td_subtotal_sso, td_manual_ssod: td_manual_ssod, td_sso_deduct: td_sso_deduct, td_subtotal_pvf: td_subtotal_pvf, td_manual_pvfd: td_manual_pvfd, td_pvf_deduct: td_pvf_deduct},
					success: function(result){

						if(result == 'success'){
							calculate_payroll_again(empids);							
						}else{

							$("body").overhang({
								type: "error",
								message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: '+ result,
								duration: 3,
								callback: function(v){
									window.location.reload();
								}
							})
						}
					}
				})
			}
		});


		$('#getlinkeddata tbody td').click(function(){

			$('#getlinkeddata tbody td').removeClass('borderCls');
			$('#linkedcolumnsSC tbody td').removeClass('borderCls');
			$('#linkedcolumnsSCD tbody td').removeClass('borderCls');

			if(this.id !=''){

				$('#getlinkeddata tbody td#'+this.id).addClass('borderCls');

				if(this.id == 'ded_curr_calc' || this.id == 'ded_curr_mnth'){
					$('#linkedcolumnsSCD tbody td.currMnths.ded_abs').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_fix').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_var').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_oth').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_leg').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_pay').addClass('borderCls');
				}
				if(this.id == 'pnd_curr_calc' || this.id == 'pnd_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.pnd1').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.pnd1').addClass('borderCls');
				}
				if(this.id == 'sso_curr_calc' || this.id == 'sso_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.sso').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.sso').addClass('borderCls');
				}
				if(this.id == 'pvf_curr_calc' || this.id == 'pvf_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.pvf').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.pvf').addClass('borderCls');
				}
				if(this.id == 'psf_curr_calc' || this.id == 'psf_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.psf').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.psf').addClass('borderCls');
				}
				if(this.id == 'fixpro_curr_calc' || this.id == 'fixpro_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.fixpro').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.fixpro').addClass('borderCls');
				}
				if(this.id == 'fix_curr_calc' || this.id == 'fix_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.fix').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.fix').addClass('borderCls');
				}
				if(this.id == 'var_curr_calc' || this.id == 'var_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.var').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.var').addClass('borderCls');
				}
				if(this.id == 'nontax_curr_calc' || this.id == 'nontax_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.nontax').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.nontax').addClass('borderCls');
				}
				if(this.id == 'totalffv_curr_calc' || this.id == 'totalffv_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.fixpro').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.fix').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.var').addClass('borderCls');

					$('#linkedcolumnsSCD tbody td.currMnths.fixpro').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.fix').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.var').addClass('borderCls');
				}

				if(this.id == 'ear_curr_calc' || this.id == 'ear_curr_mnth'){
					$('#linkedcolumnsSC tbody td.currMnths.inc_sal').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.inc_fix').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.inc_ot').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.inc_var').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.inc_oth').addClass('borderCls');
				}

				if(this.id == 'sso_emp_curr_calc' || this.id == 'sso_emp_curr_mnth'){ 
					$('#linkedcolumnsSCD tbody td.currMnths.ssocurr').addClass('borderCls');
				}

				if(this.id == 'tax_emp_curr_calc' || this.id == 'tax_emp_curr_mnth'){ 
					$('#linkedcolumnsSCD tbody td.currMnths.exTax').addClass('borderCls');
				}

				if(this.id == 'taxbycom_curr_calc' || this.id == 'taxbycom_curr_mnth'){ 
					$('#linkedcolumnsSC tbody td.currMnths.taxbycom').addClass('borderCls');
				}


				//========= prev month highlight ==========//
				if(this.id == 'ded_prev_mnth'){
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_abs').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_fix').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_var').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_oth').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_leg').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_pay').addClass('borderCls');
				}
				if(this.id == 'pnd_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.pnd1').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.pnd1').addClass('borderCls');
				}
				if(this.id == 'sso_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.sso').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.sso').addClass('borderCls');
				}
				if(this.id == 'pvf_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.pvf').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.pvf').addClass('borderCls');
				}
				if(this.id == 'psf_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.psf').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.psf').addClass('borderCls');
				}
				if(this.id == 'fixpro_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.fixpro').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.fixpro').addClass('borderCls');
				}
				if(this.id == 'fix_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.fix').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.fix').addClass('borderCls');
				}
				if(this.id == 'var_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.var').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.var').addClass('borderCls');
				}
				if(this.id == 'nontax_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.nontax').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.nontax').addClass('borderCls');
				}
				if(this.id == 'totalffv_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.fixpro').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.fix').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.var').addClass('borderCls');

					$('#linkedcolumnsSCD tbody td.prevMnth.fixpro').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.fix').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.var').addClass('borderCls');
				}

				if(this.id == 'ear_prev_mnth'){
					$('#linkedcolumnsSC tbody td.prevMnth.inc_sal').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.inc_fix').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.inc_ot').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.inc_var').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.inc_oth').addClass('borderCls');
				}

				//=============== Full year ================//
				if(this.id == 'ded_full_year'){
					$('#linkedcolumnsSCD tbody td.currMnths.ded_pay').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_abs').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_fix').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_var').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_oth').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_leg').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.currMnths.ded_pay').addClass('borderCls');

					$('#linkedcolumnsSCD tbody td.prevMnth.ded_pay').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_abs').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_fix').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_var').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_oth').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_leg').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.ded_pay').addClass('borderCls');

					$('#linkedcolumnsSCD tbody td.upcommMnths.ded_pay').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.upcommMnths.ded_abs').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.upcommMnths.ded_fix').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.upcommMnths.ded_var').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.upcommMnths.ded_oth').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.upcommMnths.ded_leg').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.upcommMnths.ded_pay').addClass('borderCls');
				}

				if(this.id == 'ear_full_year'){
					$('#linkedcolumnsSC tbody td.currMnths.inc_sal').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.inc_fix').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.inc_ot').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.inc_var').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.currMnths.inc_oth').addClass('borderCls');

					$('#linkedcolumnsSC tbody td.prevMnth.inc_sal').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.inc_fix').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.inc_ot').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.inc_var').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.inc_oth').addClass('borderCls');

					$('#linkedcolumnsSC tbody td.upcommMnths.inc_sal').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.upcommMnths.inc_fix').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.upcommMnths.inc_ot').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.upcommMnths.inc_var').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.upcommMnths.inc_oth').addClass('borderCls');
				}

				if(this.id == 'pnd_full_year'){
					$('#linkedcolumnsSC tbody td.currMnths.pnd1').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.pnd1').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.upcommMnths.pnd1').addClass('borderCls');

					$('#linkedcolumnsD tbody td.currMnths.pnd1').addClass('borderCls');
					$('#linkedcolumnsD tbody td.prevMnth.pnd1').addClass('borderCls');
					$('#linkedcolumnsD tbody td.upcommMnths.pnd1').addClass('borderCls');
				}

				if(this.id == 'sso_full_year'){
					$('#linkedcolumns tbody td.currMnths.sso').addClass('borderCls');
					$('#linkedcolumns tbody td.prevMnth.sso').addClass('borderCls');
					$('#linkedcolumns tbody td.upcommMnths.sso').addClass('borderCls');

					$('#linkedcolumnsSCD tbody td.currMnths.sso').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.sso').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.upcommMnths.sso').addClass('borderCls');
				}

				if(this.id == 'pvf_full_year'){
					$('#linkedcolumnsSC tbody td.currMnths.pvf').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.pvf').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.upcommMnths.pvf').addClass('borderCls');

					$('#linkedcolumnsSCD tbody td.currMnths.pvf').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.pvf').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.upcommMnths.pvf').addClass('borderCls');
				}

				if(this.id == 'psf_full_year'){
					$('#linkedcolumnsSC tbody td.currMnths.psf').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.prevMnth.psf').addClass('borderCls');
					$('#linkedcolumnsSC tbody td.upcommMnths.psf').addClass('borderCls');

					$('#linkedcolumnsSCD tbody td.currMnths.psf').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.prevMnth.psf').addClass('borderCls');
					$('#linkedcolumnsSCD tbody td.upcommMnths.psf').addClass('borderCls');
				}


				//========== Check total both side ===========//
				var lhs = $(this).text();
				var lhss = lhs.replace("-", "");
				var lhsss = lhss.replace(",", "");
				//setTimeout(function() { checkTotalsBothSideSC(lhs) }, 1000);
				checkTotalsBothSideSC(lhsss);
				
			}

		});

		function checkTotalsBothSideSC(lhs){

			var currTot = 0.00;
			var currTotD = 0.00;
			$('#linkedcolumnsSC tbody td.borderCls').each(function(){
				var currVal = $(this).text();
				var str2 = currVal.replace(",", "");
				currTot += parseFloat(str2);
			})

			$('#linkedcolumnsSCD tbody td.borderCls').each(function(){
				var currValD = $(this).text(); 
				var str21 = currValD.replace(",", ""); 
				currTotD += parseFloat(str21);
			})

			//alert(lhs);
			// alert(currTotD);
			var rhs = parseFloat(currTot) + parseFloat(currTotD);

			if(lhs != rhs){
				$("body").overhang({
					type: "error",
					message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?>: Both side totals are not equal<br> LHS = '+lhs+'<br> RHS = '+rhs+'',
					duration: 1,
				})
			}
		}

		$('.closebtn').click(function(){
			
			setTimeout(function(){
				$('body').addClass('modal-open');
			}, 1000);
			
		});

		$('.Selallemp').click(function(){
			$('.empchkbox').prop('checked',false);
			$('.empchkbox').removeClass('selEmpChk');

			$('.empchkbox').prop('checked',true);
			$('.empchkbox').addClass('selEmpChk');

			$('.unSelallemp').css('display','block');
			$('.Selallemp').css('display','none');
		});

		$('.unSelallemp').click(function(){
			$('.empchkbox').prop('checked',false);
			$('.empchkbox').removeClass('selEmpChk');

			$('.unSelallemp').css('display','none');
			$('.Selallemp').css('display','block');

		});

		$('.empchkbox').click(function(){

			if(this.checked){
				$(this).attr('checked',true);
				$(this).addClass('selEmpChk');
			}else{
				$(this).attr('checked',false);
				$(this).removeClass('selEmpChk');
			}
		});


		
	})
</script>