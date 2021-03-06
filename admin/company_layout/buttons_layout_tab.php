<style>
button.but-filter:hover, button.but-filter.activ {
	background:#000;
	border:1px #000 solid;
	border-radius:3px;
}
button.abutRJ {
	background:#c00;
}
button.abutRJ:before {
	font-family:'fontawesome';
	content: '\f088';
	padding-right:5px;
}
button.abutRQ {
	background: #9966FF;
}
button.abutRQ:before {
	font-family:'fontawesome';
	content: '\f059';
	padding-right:5px;
}
button.abutPE {
	background: #9966FF;
	background: #CC6633;
}
button.abutPE:before {
	font-family:'fontawesome';
	content: '\f252';
	padding-right:5px;
}
button.abutAP {
	background: #009900;
}
button.abutAP:before {
	font-family:'fontawesome';
	content: '\f087';
	padding-right:5px;
}
button.abutCA {
	background: #FF6633;
}
button.abutCA:before {
	font-family:'fontawesome';
	content: '\f057';
	padding-right:5px;
}
button.abutALL {
	background: #999;
}
button.abutTA {
	background: #3399CC;
}
.btn-default1 {
  color: #333;
  background: linear-gradient(to bottom, #eee, #ddd);
  border-color: #ccc;
	border-radius:2px;
	font-size:12px;
}

.btn-default1:hover {
  color: #333;
	background: linear-gradient(to bottom, #ddd, #eee);
  border-color: #999;
}

.btn-default1.disabled, .btn-default1:disabled {
  color: #fff;
	background: linear-gradient(to bottom, #eee, #ddd);
  border-color: #ddd;
}

.btn-default1:not(:disabled):not(.disabled):active, .btn-default1:not(:disabled):not(.disabled).active,
.show > .btn-default1.dropdown-toggle {
  color: #333;
	background: linear-gradient(to bottom, #eee, #ddd);
  border-color: #ddd;
}
</style>
<div style="position:absolute; left:24px; top:57px; right:70%; bottom:0; background:#fff;">
<!--  	<?php 

	echo '<pre>';
	print_r($buttons_tab_array);
	echo '</pre>';

	?>  -->
	<div id="leftTable" style="left:10px; top:45px; right:10px; bottom:15px; background:#fff; overflow-Y:auto; padding:0; display:xnone; overflow-X:hidden">
		<table class="basicTable inputs" border="0">
			<thead >
				<tr>
					<th colspan="2">
						<i class="fa fa-arrow-circle-down"></i>&nbsp; <!-- <?=$lng['Buttons Layout']?> -->Buttons Layout
					</th>
				</tr>
			</thead>
			<tbody class="" id="buttonsetheader1" style="display: none;">
				<tr>
					<th style="vertical-align:top">Button Color</th>
					<td> 
						<select id="buttons_color_select"  style="width:71%" >
							<?php foreach ($selectedColorsValName as $keyColor => $valueColor){ ?>
								<option value="<?php echo $keyColor;?>"><?php echo $valueColor?></option><?php } ?>
						</select>	
						<i id="buttons_color_select_circle" style="width:10%" class="green fa fa-circle" aria-hidden="true"></i>									
					</td>
				</tr>					
				<tr>
					<th style="vertical-align:top">Button Hoover Color </th>
					<td> 
						<select id="button_hoover_select"  style="width:71%" >
							<?php foreach ($selectedColorsValName as $keyColor => $valueColor){ ?>
								<option  value="<?php echo $keyColor;?>"><?php echo $valueColor?></option><?php } ?>
						</select>	
						<i id="button_hoover_select_circle" style="width:10%" class="green fa fa-circle" aria-hidden="true"></i>									
					</td>
				</tr>					
				<tr class="hidetrforbuttons" style="display: none;">
					<th style="vertical-align:top;">Button On Change Color 1</th>
					<td> 

						<select id="button_onchange_color_select"  style="width:71%">
							<?php foreach ($selectedColorsValName as $keyColor => $valueColor){ ?>
								<option value="<?php echo $keyColor;?>"><?php echo $valueColor?></option><?php } ?>
						</select>	
						<i id="button_onchange_color_select_circle" style="width:10%" class="green fa fa-circle" aria-hidden="true"></i>									
					</td>
				</tr>					
				<tr class="hidetrforbuttons" style="display: none;">
					<th style="vertical-align:top;">Button On Change Color 2</th>
					<td> 

						<select id="button_onchange_color_select_2"  style="width:71%">
							<?php foreach ($selectedColorsValName as $keyColor => $valueColor){ ?>
								<option value="<?php echo $keyColor;?>"><?php echo $valueColor?></option><?php } ?>
						</select>	
						<i id="button_onchange_color_select_circle_2" style="width:10%" class="green fa fa-circle" aria-hidden="true"></i>									
					</td>
				</tr>					
				<tr>
					<th style="vertical-align:top">Button Text Color </th>
					<td> 

						<select id="button_text_color"  style="width:71%">
							<?php foreach ($selectedColorsValName as $keyColor => $valueColor){ ?>
								<option  value="<?php echo $keyColor;?>"><?php echo $valueColor?></option><?php } ?>
						</select>	
						<i id="button_text_color_circle" style="width:10%" class="green fa fa-circle" aria-hidden="true"></i>									
					</td>
				</tr>					
				<tr class="hidetrforbuttons" style="display: none;">
					<th style="vertical-align:top;">Test Button Color Change Event  </th>
					<td> 
						<input type="text" id="testcolorchangeevent" value = "" placeholder="Type Here">								
					</td>
				</tr>												
			</tbody>
		</table>
		<div style="height:15px"></div>

	</div>
</div>


<!---- --->
<div style="position:absolute; left:30%; top:57px; right:0; bottom:0; background: #f6f6f6; border-left:1px solid #ddd">
			
	<div id="rightTable" style="position: absolute; left: 15px; top: 0px; right: 15px; bottom: 15px; background: #fff;overflow-y: auto; padding: 15px 15px 100px; padding-top: 0px!important;">
		<div class="dash-left" style="width:100%!important;">
			<div  style="position: relative!important;top: 25px!important;">

				<input type="hidden" name="hiddenButtonValue" id="hiddenButtonValue" value="">
				<input type="hidden" name="hiddenButtonValueNumeric" id="hiddenButtonValueNumeric" value="">
				<input type="hidden" name="hiddenButtonValueSpan" id="hiddenButtonValueSpan" value="">
				<table class="table">
					<thead  data-toggle="collapse" data-target="#buttonLayoutheader1" >
						<tr>
							<th colspan="8">
								<i class="fa fa-arrow-circle-down"></i>&nbsp; General Buttons
							</th>
						</tr>
					</thead>
					<tr class="collapse" id="buttonLayoutheader1">
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout1]" value="" id="buttonLayout1_hidden">
							<button name="buttons_layout[buttonLayout1]" style="" onmouseenter="getHooverColor('buttonLayout1');" onmouseleave ="removeHooverColor('buttonLayout1');" onclick="onclickActions('buttonLayout1','1')"; class="btn btn-primary" id="buttonLayout1" type="button"><span id="buttonLayout1span"><i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['OK']?></span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout2]" value="" id="buttonLayout2_hidden">
							<button  name="buttons_layout[buttonLayout2]" onmouseenter="getHooverColor('buttonLayout2');" onmouseleave ="removeHooverColor('buttonLayout2');" onclick="onclickActions('buttonLayout2','2')"; class="btn btn-primary" id="buttonLayout2" type="button"><span id="buttonLayout2span"><i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Cancel']?></span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout3]" value="" id="buttonLayout3_hidden">
							<button name="buttons_layout[buttonLayout3]" onmouseenter="getHooverColor('buttonLayout3');" onmouseleave ="removeHooverColor('buttonLayout3');" onclick="onclickActions('buttonLayout3','3')"; class="btn btn-primary" id="buttonLayout3" type="button"><span id="buttonLayout3span"><i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Update']?></span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout4]" value="" id="buttonLayout4_hidden">
							<button  name="buttons_layout[buttonLayout4]" onmouseenter="getHooverColor('buttonLayout4');" onmouseleave ="removeHooverColor('buttonLayout4');" onclick="onclickActions('buttonLayout4','4')"; class="btn btn-primary" id="buttonLayout4" type="button"><span id="buttonLayout4span"><i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Export']?></span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout5]" value="" id="buttonLayout5_hidden">
							<button  name="buttons_layout[buttonLayout5]" onmouseenter="getHooverColor('buttonLayout5');" onmouseleave ="removeHooverColor('buttonLayout5');" onclick="onclickActions('buttonLayout5','5')"; class="btn btn-primary" id="buttonLayout5" type="button"><span id="buttonLayout5span"><i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Import']?></span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout6]" value="" id="buttonLayout6_hidden">
							<button name="buttons_layout[buttonLayout6]"  onmouseenter="getHooverColor('buttonLayout6');" onmouseleave ="removeHooverColor('buttonLayout6');" onclick="onclickActions('buttonLayout6','6')"; class="btn btn-primary" id="buttonLayout6" type="button"><span id="buttonLayout6span"><i class="fa fa-arrow"></i>&nbsp;&nbsp;Go Back </span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout7]" value="" id="buttonLayout7_hidden">
							<button  name="buttons_layout[buttonLayout7]" onmouseenter="getHooverColor('buttonLayout7');" onmouseleave ="removeHooverColor('buttonLayout7');" onclick="onclickActions('buttonLayout7','7')"; class="btn btn-primary" id="buttonLayout7" type="button"><span id="buttonLayout7span"><i class="fa fa-check"></i>&nbsp;&nbsp;Clear Selection</span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout8]" value="" id="buttonLayout8_hidden">
							<button  name="buttons_layout[buttonLayout8]" onmouseenter="getHooverColor('buttonLayout8');" onmouseleave ="removeHooverColor('buttonLayout8');" onclick="onclickActions('buttonLayout8','8')"; class="btn btn-primary" id="buttonLayout8" type="button"><span id="buttonLayout8span"><i class="fa fa-check"></i>&nbsp;&nbsp;Button 8</span></button>
						</td>
					</tr>	
					<thead  data-toggle="collapse" data-target="#buttonLayoutheader2">
						<tr>
							<th colspan="8">
								<i class="fa fa-arrow-circle-down"></i>&nbsp; Employee Module 
							</th>
						</tr>
					</thead>		
					<tr class="collapse" id="buttonLayoutheader2">
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout9]" value="" id="buttonLayout9_hidden">
							<button onmouseenter="getHooverColor('buttonLayout9');" onmouseleave ="removeHooverColor('buttonLayout9');" onclick="onclickActions('buttonLayout9','9')" name="buttons_layout[buttonLayout9]" class="btn btn-primary" id="buttonLayout9" type="button"><span id="buttonLayout9span"><i class="fa fa-check"></i>&nbsp;&nbsp;Add Employee</span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout10]" value="" id="buttonLayout10_hidden">
							<button onmouseenter="getHooverColor('buttonLayout10');" onmouseleave ="removeHooverColor('buttonLayout10');" onclick="onclickActions('buttonLayout10','10')" name="buttons_layout[buttonLayout10]" class="btn btn-primary" id="buttonLayout10" type="button"><span id="buttonLayout10span"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Import Employee</span></button>
						</td>						
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout11]" value="" id="buttonLayout11_hidden">
							<button onmouseenter="getHooverColor('buttonLayout11');" onmouseleave ="removeHooverColor('buttonLayout11');" onclick="onclickActions('buttonLayout11','11')" name="buttons_layout[buttonLayout11]" class="btn btn-primary" id="buttonLayout11" type="button"><span id="buttonLayout11span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Export Employee</span></button>
						</td>					
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout12]" value="" id="buttonLayout12_hidden">
							<button onmouseenter="getHooverColor('buttonLayout12');" onmouseleave ="removeHooverColor('buttonLayout12');" onclick="onclickActions('buttonLayout12','12')" name="buttons_layout[buttonLayout12]" class="btn btn-primary" id="buttonLayout12" type="button"><span id="buttonLayout12span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Ping Employee</span></button>
						</td>	<!--  -->
						
						<td style="text-align: left;">
							<button onmouseenter="getHooverColor('buttonLayout102');" onmouseleave ="removeHooverColor('buttonLayout102');" onclick="onclickActions('buttonLayout102','102')" name="buttons_layout[buttonLayout102]" id="buttonLayout102" type="button" class="btn btn-primary " onclick="">Next</button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout14]" value="" id="buttonLayout14_hidden">
							<button onmouseenter="getHooverColor('buttonLayout14');" onmouseleave ="removeHooverColor('buttonLayout14');" onclick="onclickActions('buttonLayout14','14')" name="buttons_layout[buttonLayout14]" class="btn btn-primary" id="buttonLayout14" type="button"><span id="buttonLayout14span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Add  Discipline</span></button>
						</td>
						
					</tr>					
					<tr class="collapse" id="buttonLayoutheader2">
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout17]" value="" id="buttonLayout17_hidden">
							<button onmouseenter="getHooverColor('buttonLayout17');" onmouseleave ="removeHooverColor('buttonLayout17');" onclick="onclickActions('buttonLayout17','17')" name="buttons_layout[buttonLayout17]" class="btn btn-primary" id="buttonLayout17" type="button"><span id="buttonLayout17span"><i class="fa fa-check"></i>&nbsp;&nbsp;Select Picture</span></button>
						</td>						
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout18]" value="" id="buttonLayout18_hidden">
							<button onmouseenter="getHooverColor('buttonLayout18');" onmouseleave ="removeHooverColor('buttonLayout18');" onclick="onclickActions('buttonLayout18','18')" name="buttons_layout[buttonLayout18]" class="btn btn-primary" id="buttonLayout18" type="button"><span id="buttonLayout18span"><i class="fa fa-check"></i>&nbsp;&nbsp;Modify Data</span></button>
						</td>						
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout20]" value="" id="buttonLayout20_hidden">
							<button onmouseenter="getHooverColor('buttonLayout20');" onmouseleave ="removeHooverColor('buttonLayout20');" onclick="onclickActions('buttonLayout20','20')" name="buttons_layout[buttonLayout20]" class="btn btn-primary" id="buttonLayout20" type="button"><span id="buttonLayout20span"><i class="fa fa-check"></i>&nbsp;&nbsp;Archive Employee</span></button>
						</td>						
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout21]" value="" id="buttonLayout21_hidden">
							<button onmouseenter="getHooverColor('buttonLayout21');" onmouseleave ="removeHooverColor('buttonLayout21');" onclick="onclickActions('buttonLayout21','21')" name="buttons_layout[buttonLayout21]" class="btn btn-primary" id="buttonLayout21" type="button"><span id="buttonLayout21span"><i class="fa fa-check"></i>&nbsp;&nbsp;Delete Employee</span></button>
						</td>
							<!--  -->	
							
						<td style="text-align: left;">
							<button onmouseenter="getHooverColor('buttonLayout103');" onmouseleave ="removeHooverColor('buttonLayout103');" onclick="onclickActions('buttonLayout103','103')" name="buttons_layout[buttonLayout103]" id="buttonLayout103" type="button" class="btn btn-primary " onclick="">Prev</button>
						</td>					
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout22]" value="" id="buttonLayout22_hidden">
							<button onmouseenter="getHooverColor('buttonLayout22');" onmouseleave ="removeHooverColor('buttonLayout22');" onclick="onclickActions('buttonLayout22','22')" name="buttons_layout[buttonLayout22]" class="btn btn-primary" id="buttonLayout22" type="button"><span id="buttonLayout22span"><i class="fa fa-check"></i>&nbsp;&nbsp;Use Employee</span></button>
						</td>
					</tr>
					<tr class="collapse" id="buttonLayoutheader2">
						<td style="text-align: left;">
						<button onmouseenter="getHooverColor('buttonLayout95');" onmouseleave ="removeHooverColor('buttonLayout95');" onclick="onclickActions('buttonLayout95','95')" name="buttons_layout[buttonLayout95]" class="btn btn-primary" type="button" id="buttonLayout95"><i class="fa fa-retweet fa-mr"></i>Switch Layout</button>
						</td>
						<td style="text-align: left;">
						<button onmouseenter="getHooverColor('buttonLayout96');" onmouseleave ="removeHooverColor('buttonLayout96');" onclick="onclickActions('buttonLayout95','96')" name="buttons_layout[buttonLayout96]" class="btn btn-primary" type="button" id="buttonLayout96"><i class="fa fa-arrow-right  fa-mr"></i>Continue selection</button>
						</td>
						
						<td style="text-align: left;">
						<button onmouseenter="getHooverColor('buttonLayout99');" onmouseleave ="removeHooverColor('buttonLayout99');" onclick="onclickActions('buttonLayout99','99')" name="buttons_layout[buttonLayout99]" id="buttonLayout99" type="button" class="btn btn-primary"><i class="fa fa-trash fa-mr"></i> Clear Selection</button>
						</td>
						<td style="text-align: left;">
						<button onmouseenter="getHooverColor('buttonLayout100');" onmouseleave ="removeHooverColor('buttonLayout100');" onclick="onclickActions('buttonLayout100','100')" name="buttons_layout[buttonLayout100]" id="buttonLayout100" class="btn btn-primary " type="button">Save to Employee Register</button>
						</td>
						<td style="text-align: left;">
						<button onmouseenter="getHooverColor('buttonLayout97');" onmouseleave ="removeHooverColor('buttonLayout97');" onclick="onclickActions('buttonLayout97','97')" name="buttons_layout[buttonLayout97]" class="btn btn-primary" type="button" id="buttonLayout97"><i class="fa fa-download fa-mr"></i>Import</button>
						</td>
						<td style="text-align: left;">
						<button onmouseenter="getHooverColor('buttonLayout98');" onmouseleave ="removeHooverColor('buttonLayout98');" onclick="onclickActions('buttonLayout98','98')" name="buttons_layout[buttonLayout98]" class="btn btn-primary" type="button" id="buttonLayout98"><i class="fa fa-upload fa-mr"></i>Export</button>
						</td>
					</tr>		
					<tr class="collapse" id="buttonLayoutheader2">
						<td style="text-align: left;">
							<button onmouseenter="getHooverColor('buttonLayout101');" onmouseleave ="removeHooverColor('buttonLayout101');" onclick="onclickActions('buttonLayout101','101')" name="buttons_layout[buttonLayout101]" id="buttonLayout101" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
						</td>
										
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout13]" value="" id="buttonLayout13_hidden">
							<button onmouseenter="getHooverColor('buttonLayout13');" onmouseleave ="removeHooverColor('buttonLayout13');" onclick="onclickActions('buttonLayout13','13')" name="buttons_layout[buttonLayout13]" class="btn btn-primary" id="buttonLayout13" type="button"><span id="buttonLayout13span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Add Medical</span></button>
						</td>			
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout16]" value="" id="buttonLayout16_hidden">
							<button onmouseenter="getHooverColor('buttonLayout16');" onmouseleave ="removeHooverColor('buttonLayout16');" onclick="onclickActions('buttonLayout16','16')" name="buttons_layout[buttonLayout16]" class="btn btn-primary" id="buttonLayout16" type="button"><span id="buttonLayout16span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Add Asset</span></button>
						</td>	
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout15]" value="" id="buttonLayout15_hidden">
							<button onmouseenter="getHooverColor('buttonLayout15');" onmouseleave ="removeHooverColor('buttonLayout15');" onclick="onclickActions('buttonLayout15','15')" name="buttons_layout[buttonLayout15]" class="btn btn-primary" id="buttonLayout15" type="button"><span id="buttonLayout15span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Add  History</span></button>
						</td>	
						<td style="text-align: left;">
						</td>
						<td style="text-align: left;">
						</td>
					</tr>			
					<thead  data-toggle="collapse" data-target="#buttonLayoutheader3">
						<tr>
							<th colspan="8">
								<i class="fa fa-arrow-circle-down"></i>&nbsp; Payroll Module 
							</th>
						</tr>
					</thead>		
					<tr class="collapse" id="buttonLayoutheader3">
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout23]" value="" id="buttonLayout23_hidden">
							<button onmouseenter="getHooverColor('buttonLayout23');" onmouseleave ="removeHooverColor('buttonLayout23');" onclick="onclickActions('buttonLayout23','23')" name="buttons_layout[buttonLayout23]" class="btn btn-primary" id="buttonLayout23" type="button"><span id="buttonLayout23span"><i class="fa fa-check"></i>&nbsp;&nbsp;Add Payroll</span></button>
						</td>					
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout24]" value="" id="buttonLayout24_hidden">
							<button onmouseenter="getHooverColor('buttonLayout24');" onmouseleave ="removeHooverColor('buttonLayout24');" onclick="onclickActions('buttonLayout24','24')" name="buttons_layout[buttonLayout24]" class="btn btn-primary" id="buttonLayout24" type="button"><span id="buttonLayout24span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Fetch Employee Data</span></button>
						</td>					
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout25]" value="" id="buttonLayout25_hidden">
							<button onmouseenter="getHooverColor('buttonLayout25');" onmouseleave ="removeHooverColor('buttonLayout25');" onclick="onclickActions('buttonLayout25','25')" name="buttons_layout[buttonLayout25]" class="btn btn-primary" id="buttonLayout25" type="button"><span id="buttonLayout25span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Upload File</span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout26]" value="" id="buttonLayout26_hidden">
							<button onmouseenter="getHooverColor('buttonLayout26');" onmouseleave ="removeHooverColor('buttonLayout26');" onclick="onclickActions('buttonLayout26','26')" name="buttons_layout[buttonLayout26]" class="btn btn-primary" id="buttonLayout26" type="button"><span id="buttonLayout26span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Export</span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout27]" value="" id="buttonLayout27_hidden">
							<button onmouseenter="getHooverColor('buttonLayout27');" onmouseleave ="removeHooverColor('buttonLayout27');" onclick="onclickActions('buttonLayout27','27')" name="buttons_layout[buttonlayout26]" class="btn btn-primary" id="buttonLayout27" type="button"><span id="buttonLayout27span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Import</span></button>
						</td>	
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout87]" value="" id="buttonLayout87_hidden">
						<a type="button" class="btn btn-primary" onmouseenter="getHooverColor('buttonLayout87');" onmouseleave ="removeHooverColor('buttonLayout87');" onclick="onclickActions('buttonLayout87','87')" id="buttonLayout87" name="buttons_layout[buttonLayout87]">
						<i class="fa fa-plus"></i> Add Form					</a>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout88]" value="" id="buttonLayout88_hidden">
						<button name="buttons_layout[buttonLayout88]" class="btn btn-primary" type="button" onmouseenter="getHooverColor('buttonLayout88');" onmouseleave ="removeHooverColor('buttonLayout88');" onclick="onclickActions('buttonLayout88','88')" id="buttonLayout88">Go back</button>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout89]" value="" id="buttonLayout89_hidden">
						<button name="buttons_layout[buttonLayout89]" class="btn btn-primary" type="button"><i class="fa fa-save fa-mr" onmouseenter="getHooverColor('buttonLayout89');" onmouseleave ="removeHooverColor('buttonLayout89');" onclick="onclickActions('buttonLayout89','89')" id="buttonLayout89"></i>Update</button>
						</td>
					</tr>
					<tr class="collapse" id="buttonLayoutheader3">
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout90]" value="" id="buttonLayout90_hidden">
							<button name="buttons_layout[buttonLayout90]" type="button" class="print btn btn-primary" onmouseenter="getHooverColor('buttonLayout90');" onmouseleave ="removeHooverColor('buttonLayout90');" onclick="onclickActions('buttonLayout90','90')" id="buttonLayout90"><i class="fa fa-print"></i>&nbsp; Print</button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout91]" value="" id="buttonLayout91_hidden">
							<button type="button" class="print btn btn-primary" onmouseenter="getHooverColor('buttonLayout91');" onmouseleave ="removeHooverColor('buttonLayout91');" onclick="onclickActions('buttonLayout91','91')" id="buttonLayout91" name="buttons_layout[buttonLayout91]"><i class="fa fa-print"></i>&nbsp; Print & Archive</button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout92]" value="" id="buttonLayout92_hidden">
							<a type="button" class="btn btn-primary" onmouseenter="getHooverColor('buttonLayout92');" onmouseleave ="removeHooverColor('buttonLayout92');" onclick="onclickActions('buttonLayout92','92')" id="buttonLayout92" name="buttons_layout[buttonLayout92]">
						<i class="fa fa-plus"></i> Add Payroll					</a>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout93]" value="" id="buttonLayout93_hidden">
							<button class="btn btn-primary mr-1" type="button" onmouseenter="getHooverColor('buttonLayout93');" onmouseleave ="removeHooverColor('buttonLayout93');" onclick="onclickActions('buttonLayout93','93')" id="buttonLayout93" name="buttons_layout[buttonLayout93]"><i class="fa fa-times"></i>&nbsp; Cancel</button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout94]" value="" id="buttonLayout94_hidden">
							<button class="btn btn-primary mr-2" type="button" onmouseenter="getHooverColor('buttonLayout94');" onmouseleave ="removeHooverColor('buttonLayout94');" onclick="onclickActions('buttonLayout94','94')" id="buttonLayout94" name="buttons_layout[buttonLayout94]"><i class="fa fa-save"></i>&nbsp; Save</button>
						</td>
						<td style="text-align: left;">
						
						</td>
						<td style="text-align: left;">
						
						</td>
						<td style="text-align: left;">
						
						</td>
					</tr>
					<thead  data-toggle="collapse" data-target="#buttonLayoutheader4">
						<tr>
							<th colspan="8">
								<i class="fa fa-arrow-circle-down"></i>&nbsp; Settings Module 
							</th>
						</tr>
					</thead>		
					<tr class="collapse" id="buttonLayoutheader4">
											
						
										
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout31]" value="" id="buttonLayout31_hidden">
							<button onmouseenter="getHooverColor('buttonLayout31');" onmouseleave ="removeHooverColor('buttonLayout31');" onclick="onclickActions('buttonLayout31','31')" name="buttons_layout[buttonLayout31]" class="btn btn-primary" id="buttonLayout31" type="button"><span id="buttonLayout31span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Add new user</span></button>
						</td>
						
												
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout30]" value="" id="buttonLayout30_hidden">
							<button onmouseenter="getHooverColor('buttonLayout30');" onmouseleave ="removeHooverColor('buttonLayout30');" onclick="onclickActions('buttonLayout30','30')" name="buttons_layout[buttonLayout30]" class="btn btn-primary" id="buttonLayout30" type="button"><span id="buttonLayout30span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Show Chart</span></button>
						</td>	
						
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout34]" value="" id="buttonLayout34_hidden">
							<button onmouseenter="getHooverColor('buttonLayout34');" onmouseleave ="removeHooverColor('buttonLayout34');" onclick="onclickActions('buttonLayout34','34')" name="buttons_layout[buttonLayout34]" class="btn btn-primary" id="buttonLayout34" type="button"><span id="buttonLayout34span"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add  Model</span></button>
						</td>	
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout35]" value="" id="buttonLayout35_hidden">
							<button onmouseenter="getHooverColor('buttonLayout35');" onmouseleave ="removeHooverColor('buttonLayout35');" onclick="onclickActions('buttonLayout35','35')" name="buttons_layout[buttonLayout35]" class="btn btn-primary" id="buttonLayout35" type="button"><span id="buttonLayout35span"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Holiday</span></button>
						</td>
						
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout33]" value="" id="buttonLayout33_hidden">
							<button onmouseenter="getHooverColor('buttonLayout33');" onmouseleave ="removeHooverColor('buttonLayout33');" onclick="onclickActions('buttonLayout33','33')" name="buttons_layout[buttonLayout33]" class="btn btn-primary" id="buttonLayout33_hidden" type="button"><span id="buttonLayout33span"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Item </span></button>
						</td>
						
						
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout80]" value="" id="buttonLayout80_hidden">
						<button onmouseenter="getHooverColor('buttonLayout80');" onmouseleave ="removeHooverColor('buttonLayout80');" onclick="onclickActions('buttonLayout80','80')" type="button" class="btn btn-primary" id="buttonLayout80">Prev</button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout32]" value="" id="buttonLayout32_hidden">
							<button onmouseenter="getHooverColor('buttonLayout32');" onmouseleave ="removeHooverColor('buttonLayout32');" onclick="onclickActions('buttonLayout32','32')" name="buttons_layout[buttonLayout32]" class="btn btn-primary" id="buttonLayout32" type="button"><span id="buttonLayout32span"><i class="fa fa-trash"></i>&nbsp;&nbsp;Get default SSO PND3</span></button>
						</td>
						<td style="text-align: left;">
						</td>
					</tr>					
					<tr class="collapse" id="buttonLayoutheader4">			
						
						
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout69]" value="" id="buttonLayout69_hidden">
						<button onmouseenter="getHooverColor('buttonLayout69');" onmouseleave ="removeHooverColor('buttonLayout69');" onclick="onclickActions('buttonLayout69','69')" name="buttons_layout[buttonLayout69]" class="btn btn-primary " type="button" id="buttonLayout69"><i class="fa fa-save"></i>&nbsp; Update activity</button>
						</td>					
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout37]" value="" id="buttonLayout37_hidden">
							<button onmouseenter="getHooverColor('buttonLayout37');" onmouseleave ="removeHooverColor('buttonLayout37');" onclick="onclickActions('buttonLayout37','37')" name="buttons_layout[buttonLayout37]" class="btn btn-primary" id="buttonLayout37" type="button"><span id="buttonLayout37span"><i class="fa fa-cog"></i>&nbsp;&nbsp;Get Defaults</span></button>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout67]" value="" id="buttonLayout67_hidden">
						<button onmouseenter="getHooverColor('buttonLayout67');" onmouseleave ="removeHooverColor('buttonLayout67');" onclick="onclickActions('buttonLayout67','67')" name="buttons_layout[buttonLayout67]" class="btn btn-primary" type="button" id="buttonLayout67"><i class="fa fa-save fa-mr"></i>Update</button>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout68]" value="" id="buttonLayout68_hidden">
						<button onmouseenter="getHooverColor('buttonLayout68');" onmouseleave ="removeHooverColor('buttonLayout68');" onclick="onclickActions('buttonLayout68','68')" name="buttons_layout[buttonLayout68]" class="btn btn-primary btn-xs" type="button" id="buttonLayout68"><i class="fa fa-plus fa-mr"></i>Add row</button>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout72]" value="" id="buttonLayout72_hidden">
						<button onmouseenter="getHooverColor('buttonLayout72');" onmouseleave ="removeHooverColor('buttonLayout72');" onclick="onclickActions('buttonLayout72','72')" name="buttons_layout[buttonLayout72]" class="btn btn-primary" type="button" data-dismiss="modal" id="buttonLayout72"><i class="fa fa-times"></i>&nbsp; Cancel</button>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout70]" value="" id="buttonLayout70_hidden">
						<button onmouseenter="getHooverColor('buttonLayout70');" onmouseleave ="removeHooverColor('buttonLayout70');" onclick="onclickActions('buttonLayout70','70')" class="btn btn-primary btn-sm" name="buttons_layout[buttonLayout70]" type="button" id="buttonLayout70"><i class="fa fa-plus"></i></button>
						</td>
						<td style="text-align: left;" colspan='2'>
							<input type="hidden" name="buttons_layout[buttonLayout36]" value="" id="buttonLayout36_hidden">
							<button onmouseenter="getHooverColor('buttonLayout36');" onmouseleave ="removeHooverColor('buttonLayout36');" onclick="onclickActions('buttonLayout36','36')" name="buttons_layout[buttonLayout36]" class="btn btn-primary" id="buttonLayout36" type="button"><span id="buttonLayout36span"><i class="fa fa-download"></i>&nbsp;&nbsp;Import holidays from REGO admin</span></button>
						</td>	
					</tr>
					<tr class="collapse" id="buttonLayoutheader4">
    					
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout74]" value="" id="buttonLayout74_hidden">
						<button onmouseenter="getHooverColor('buttonLayout74');" onmouseleave ="removeHooverColor('buttonLayout74');" onclick="onclickActions('buttonLayout74','74')" name="buttons_layout[buttonLayout74]" class="btn btn-primary" id="buttonLayout74"><i class="fa fa-save"></i>&nbsp; Update Access</button>
						</td>
						
						<td  style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout78]" value="" id="buttonLayout78_hidden">
						<button onmouseenter="getHooverColor('buttonLayout78');" onmouseleave ="removeHooverColor('buttonLayout78');" onclick="onclickActions('buttonLayout78','78')" name="buttons_layout[buttonLayout78]" type="button" class="btn btn-primary btn-xs" id="buttonLayout78"><i class="fa fa-user"></i>&nbsp;&nbsp;Select picture</button>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout75]" value="" id="buttonLayout75_hidden">
						<a onmouseenter="getHooverColor('buttonLayout75');" onmouseleave ="removeHooverColor('buttonLayout75');" onclick="onclickActions('buttonLayout75','75')" name="buttons_layout[buttonLayout75]" class="h-100 d-flex align-items-center btn btn-success text-white w-75" id="buttonLayout75" style='border-radius:0 2px 2px 0'>Cancel</a>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout76]" value="" id="buttonLayout76_hidden">
						<a onmouseenter="getHooverColor('buttonLayout76');" onmouseleave ="removeHooverColor('buttonLayout76');" onclick="onclickActions('buttonLayout76','76')" name="buttons_layout[buttonLayout76]" class="h-100 d-flex align-items-center btn btn-danger text-white w-75" id="buttonLayout76" style='border-radius:2px 0 0 2px'>Delete</a>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout77]" value="" id="buttonLayout77_hidden">
						<button onmouseenter="getHooverColor('buttonLayout77');" onmouseleave ="removeHooverColor('buttonLayout77');" onclick="onclickActions('buttonLayout77','77')" name="buttons_layout[buttonLayout77]" class="btn btn-primary" type="button" id="buttonLayout77">Go back</button>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout79]" value="" id="buttonLayout79_hidden">
						<button onmouseenter="getHooverColor('buttonLayout79');" onmouseleave ="removeHooverColor('buttonLayout79');" onclick="onclickActions('buttonLayout79','79')" name="buttons_layout[buttonLayout79]" type="button" class="btn btn-primary" id="buttonLayout79">Next</button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout28]" value="" id="buttonLayout28_hidden">
							<button onmouseenter="getHooverColor('buttonLayout28');" onmouseleave ="removeHooverColor('buttonLayout28');" onclick="onclickActions('buttonLayout28','28')" name="buttons_layout[buttonLayout28]" class="btn btn-primary" id="buttonLayout28" type="button"><span id="buttonLayout28span"><i class="fa fa-check"></i>&nbsp;&nbsp;Change Subscription</span></button>
    					</td>
    					<td style="text-align: left;">
    					</td>
					</tr>
					<tr class="collapse" id="buttonLayoutheader4">
						
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout84]" value="" id="buttonLayout84_hidden">
						<a onmouseenter="getHooverColor('buttonLayout84');" onmouseleave ="removeHooverColor('buttonLayout84');" onclick="onclickActions('buttonLayout84','84')" name="buttons_layout[buttonLayout84]" type="button" class="btn btn-primary" id="buttonLayout84">
						<i class="fa fa-plus pr-2"></i> New Text block					</a>
						</td>
						
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout82]" value="" id="buttonLayout82_hidden">
						<a onmouseenter="getHooverColor('buttonLayout82');" onmouseleave ="removeHooverColor('buttonLayout82');" onclick="onclickActions('buttonLayout82','82')" name="buttons_layout[buttonLayout82]" type="button" class="btn btn-primary " id="buttonLayout82">
						<i class="fa fa-plus pr-2"></i> New Header					</a>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout83]" value="" id="buttonLayout83_hidden">
						<a onmouseenter="getHooverColor('buttonLayout83');" onmouseleave ="removeHooverColor('buttonLayout83');" onclick="onclickActions('buttonLayout83','83')" name="buttons_layout[buttonLayout83]" type="button" class="btn btn-primary" id="buttonLayout83">
						<i class="fa fa-plus pr-2"></i> New Footer					</a>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout81]" value="" id="buttonLayout81_hidden">
						<button onmouseenter="getHooverColor('buttonLayout81');" onmouseleave ="removeHooverColor('buttonLayout81');" onclick="onclickActions('buttonLayout81','81')" name="buttons_layout[buttonLayout81]" class="btn btn-info" type="button" id="buttonLayout81">Show Chart</button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout29]" value="" id="buttonLayout29_hidden">
							<button onmouseenter="getHooverColor('buttonLayout29');" onmouseleave ="removeHooverColor('buttonLayout29');" onclick="onclickActions('buttonLayout29','29')" name="buttons_layout[buttonLayout29]" class="btn btn-primary" id="buttonLayout29" type="button"><span id="buttonLayout29span"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Add Row</span></button>
						</td>	
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout71]" value="" id="buttonLayout71_hidden">
						<button onmouseenter="getHooverColor('buttonLayout71');" onmouseleave ="removeHooverColor('buttonLayout71');" onclick="onclickActions('buttonLayout71','71')" name="buttons_layout[buttonLayout71]" class="btn btn-primary btn-sm" type="button" id="buttonLayout71"><i class="fa fa-pencil-square-o"></i></button>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout73]" value="" id="buttonLayout73_hidden">
						<button onmouseenter="getHooverColor('buttonLayout73');" onmouseleave ="removeHooverColor('buttonLayout73');" onclick="onclickActions('buttonLayout73','73')" name="buttons_layout[buttonLayout73]" type="button" class="btn btn-primary" id="buttonLayout73"><i class="fa fa-save"></i>&nbsp; Update permissions</button>
						</td>
						<td style="text-align: left;"></td>
					</tr>
					<thead data-toggle="collapse" data-target="#buttonLayoutheader5">
						<tr>
							<th colspan="8">
								<i class="fa fa-arrow-circle-down"></i>&nbsp; Communication Center
							</th>
						</tr>
					</thead>		
					<tr class="collapse" id="buttonLayoutheader5">
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout38]" value="" id="buttonLayout38_hidden">
							<button onmouseenter="getHooverColor('buttonLayout38');" onmouseleave ="removeHooverColor('buttonLayout38');" onclick="onclickActions('buttonLayout38','38')" name="buttons_layout[buttonLayout38]" class="btn btn-primary" id="buttonLayout38" type="button"><span id="buttonLayout38span"><i class="fa fa-check"></i>&nbsp;&nbsp;New Header</span></button>
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout39]" value="" id="buttonLayout39_hidden">
							<button onmouseenter="getHooverColor('buttonLayout39');" onmouseleave ="removeHooverColor('buttonLayout39');" onclick="onclickActions('buttonLayout39','39')" name="buttons_layout[buttonLayout39]" class="btn btn-primary" id="buttonLayout39" type="button"><span id="buttonLayout39span"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;New Footer</span></button>
						</td>						
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout40]" value="" id="buttonLayout40_hidden">
							<button onmouseenter="getHooverColor('buttonLayout40');" onmouseleave ="removeHooverColor('buttonLayout40');" onclick="onclickActions('buttonLayout40','40')" name="buttons_layout[buttonLayout40]" class="btn btn-primary" id="buttonLayout40" type="button"><span id="buttonLayout40span"><i class="fa fa-trash"></i>&nbsp;&nbsp;New Text Block </span></button>
						</td>					
						
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout85]" value="" id="buttonLayout85_hidden">
						<a type="button" class="btn btn-primary" onmouseenter="getHooverColor('buttonLayout85');" onmouseleave ="removeHooverColor('buttonLayout85');" onclick="onclickActions('buttonLayout85','85')" name="buttons_layout[buttonLayout85]" id="buttonLayout85">
						<i class="fa fa-plus pr-2"></i> Add Communication					</a>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout86]" value="" id="buttonLayout86_hidden">
						<button type="button" class="btn btn-primary" onmouseenter="getHooverColor('buttonLayout86');" onmouseleave ="removeHooverColor('buttonLayout86');" onclick="onclickActions('buttonLayout94','86')" name="buttons_layout[buttonLayout86]" id="buttonLayout86"><i class="fa fa-save"></i> Save</button>
						</td>
						<td style="text-align: left;">
						<input type="hidden" name="buttons_layout[buttonLayout87]" value="" id="buttonLayout87_hidden">
						<a type="button" class="btn btn-default1" onmouseenter="getHooverColor('buttonLayout87');" onmouseleave ="removeHooverColor('buttonLayout87');" onclick="onclickActions('buttonLayout87','87')" name="buttons_layout[buttonLayout87]" id="buttonLayout87">
						 	<i class="fa fa-angle-double-left fa-lg"></i>&nbsp;Back 
					  	</a>
						</td>
						<td style="text-align: left;"></td>
						<td style="text-align: left;"></td>
					</tr>
					<thead data-toggle="collapse" data-target="#buttonLayoutheader6">
						<tr>
							<th colspan="8">
								<i class="fa fa-arrow-circle-down"></i>&nbsp; Leave
							</th>
						</tr>
					</thead>
					<tr class="collapse" id="buttonLayoutheader6">
						
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout42]" value="" id="buttonLayout42_hidden">
						<button onmouseenter="getHooverColor('buttonLayout42');" onmouseleave ="removeHooverColor('buttonLayout42');" onclick="onclickActions('buttonLayout42','42')" name='buttons_layout[buttonLayout42]' id="buttonLayout42" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Add Leave</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout43]" value="" id="buttonLayout43_hidden">
							<button onmouseenter="getHooverColor('buttonLayout43');" onmouseleave ="removeHooverColor('buttonLayout43');" onclick="onclickActions('buttonLayout43','43')" name='buttons_layout[buttonLayout43]' id="buttonLayout43" type="button" class="abutALL but-filter">All leaves</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout44]" value="" id="buttonLayout44_hidden">
							<button onmouseenter="getHooverColor('buttonLayout44');" onmouseleave ="removeHooverColor('buttonLayout44');" onclick="onclickActions('buttonLayout41','44')" name='buttons_layout[buttonLayout44]' id="buttonLayout44" type="button" class="abutPE but-filter">Pending</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout45]" value="" id="buttonLayout45_hidden">
							<button onmouseenter="getHooverColor('buttonLayout45');" onmouseleave ="removeHooverColor('buttonLayout45');" onclick="onclickActions('buttonLayout45','45')" name='buttons_layout[buttonLayout45]' id="buttonLayout45" type="button" class="abutRQ but-filter">Requested</button>		
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout46]" value="" id="buttonLayout46_hidden">
							<button onmouseenter="getHooverColor('buttonLayout46');" onmouseleave ="removeHooverColor('buttonLayout46');" onclick="onclickActions('buttonLayout46','46')" name='buttons_layout[buttonLayout46]' id="buttonLayout46" type="button" class="abutAP but-filter">Approved</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout47]" value="" id="buttonLayout47_hidden">
							<button onmouseenter="getHooverColor('buttonLayout47');" onmouseleave ="removeHooverColor('buttonLayout47');" onclick="onclickActions('buttonLayout47','47')" name='buttons_layout[buttonLayout47]' id="buttonLayout47" type="button" class=" abutRJ but-filter">Rejected</button>	
						</td>
						<td style="text-align: left;">
							<input type="hidden" name="buttons_layout[buttonLayout41]" value="" id="buttonLayout41_hidden">
							<button onmouseenter="getHooverColor('buttonLayout41');" onmouseleave ="removeHooverColor('buttonLayout41');" onclick="onclickActions('buttonLayout41','41')" name="buttons_layout[buttonLayout41]" class="btn btn-primary" id="buttonLayout41" type="button"><span id="buttonLayout41span"><i class="fa fa-check"></i>&nbsp;&nbsp;New Header</span></button>
						</td>	
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout54]" value="" id="buttonLayout54_hidden">
							<button onmouseenter="getHooverColor('buttonLayout54');" onmouseleave ="removeHooverColor('buttonLayout54');" onclick="onclickActions('buttonLayout54','54')" type="button" class="btn btn-primary" name='buttons_layout[buttonLayout54]' id="buttonLayout54">&nbsp;<i class="fa fa-chevron-left"></i>&nbsp;</button>
						</td>
						
						</tr><tr class="collapse" id="buttonLayoutheader6">
						
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout48]" value="" id="buttonLayout48_hidden">
							<button onmouseenter="getHooverColor('buttonLayout48');" onmouseleave ="removeHooverColor('buttonLayout48');" onclick="onclickActions('buttonLayout48','48')" name='buttons_layout[buttonLayout48]' id="buttonLayout48" type="button" class=" abutCA but-filter">Cancelled</button>
						</td>
						
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout51]" value="" id="buttonLayout51_hidden">
							<button onmouseenter="getHooverColor('buttonLayout51');" onmouseleave ="removeHooverColor('buttonLayout51');" onclick="onclickActions('buttonLayout51','51')" type="button" class="btn btn-primary" name='buttons_layout[buttonLayout51]' id="buttonLayout51">Month</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout49]" value="" id="buttonLayout49_hidden">
							<button onmouseenter="getHooverColor('buttonLayout49');" onmouseleave ="removeHooverColor('buttonLayout49');" onclick="onclickActions('buttonLayout49','49')" name='buttons_layout[buttonLayout49]' id="buttonLayout49" type="button" class=" abutTA but-filter">Taken</button>
						</td>

						 
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout56]" value="" id="buttonLayout56_hidden">
							<button onmouseenter="getHooverColor('buttonLayout56');" onmouseleave ="removeHooverColor('buttonLayout56');" onclick="onclickActions('buttonLayout56','56')" type="button" class="btn btn-primary" name='buttons_layout[buttonLayout56]' id="buttonLayout56"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</button>
						</td>
						<td style='text-align:left'>		
						<input type="hidden" name="buttons_layout[buttonLayout53]" value="" id="buttonLayout53_hidden">
							<button onmouseenter="getHooverColor('buttonLayout53');" onmouseleave ="removeHooverColor('buttonLayout53');" onclick="onclickActions('buttonLayout53','53')" type="button" class="btn btn-primary" name='buttons_layout[buttonLayout53]' id="buttonLayout53">Today</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout52]" value="" id="buttonLayout52_hidden">
							<button onmouseenter="getHooverColor('buttonLayout52');" onmouseleave ="removeHooverColor('buttonLayout52');" onclick="onclickActions('buttonLayout52','52')" type="button" class="btn btn-primary" name='buttons_layout[buttonLayout52]' id="buttonLayout52">List</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout50]" value="" id="buttonLayout50_hidden">
							<button onmouseenter="getHooverColor('buttonLayout50');" onmouseleave ="removeHooverColor('buttonLayout50');" onclick="onclickActions('buttonLayout50','50')" name='buttons_layout[buttonLayout50]' id="buttonLayout50" class="btn btn-primary" type="button"><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;Approve leave period</button>
						</td>
						<td style='text-align:left'>		
						<input type="hidden" name="buttons_layout[buttonLayout55]" value="" id="buttonLayout55_hidden">
							<button onmouseenter="getHooverColor('buttonLayout55');" onmouseleave ="removeHooverColor('buttonLayout55');" onclick="onclickActions('buttonLayout55','55')" type="button" class="btn btn-primary" name='buttons_layout[buttonLayout55]' id="buttonLayout55">&nbsp;<i class="fa fa-chevron-right"></i>&nbsp;</button>
						</td>
						
					</tr><tr class="collapse" id="buttonLayoutheader6">
						
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout58]" value="" id="buttonLayout58_hidden">
						<button onmouseenter="getHooverColor('buttonLayout58');" onmouseleave ="removeHooverColor('buttonLayout58');" onclick="onclickActions('buttonLayout58','58')" name="buttons_layout[buttonLayout58]" class="btn btn-primary" type="button" id="buttonLayout58"><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;Approve</button>
						</td>
						
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout60]" value="" id="buttonLayout60_hidden">
						<button onmouseenter="getHooverColor('buttonLayout60');" onmouseleave ="removeHooverColor('buttonLayout60');" onclick="onclickActions('buttonLayout60','60')" name="buttons_layout[buttonLayout60]" type="button" class="btn btn-primary" id="buttonLayout60"><i class="fa fa-times"></i>&nbsp; Close</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout61]" value="" id="buttonLayout61_hidden">
						<button onmouseenter="getHooverColor('buttonLayout61');" onmouseleave ="removeHooverColor('buttonLayout61');" onclick="onclickActions('buttonLayout61','61')" name="buttons_layout[buttonLayout61]" type="button" class="btn btn-primary" id="buttonLayout61"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout62]" value="" id="buttonLayout62_hidden">
						<a onmouseenter="getHooverColor('buttonLayout62');" onmouseleave ="removeHooverColor('buttonLayout62');" onclick="onclickActions('buttonLayout62','62')" name="buttons_layout[buttonLayout62]" class="h-100 d-flex align-items-center btn btn-danger text-white w-75" id="buttonLayout62" style='border-radius:2px 0 0 2px'>Delete</a>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout63]" value="" id="buttonLayout63_hidden">
						<a onmouseenter="getHooverColor('buttonLayout63');" onmouseleave ="removeHooverColor('buttonLayout63');" onclick="onclickActions('buttonLayout63','63')" name="buttons_layout[buttonLayout63]" class="h-100 d-flex align-items-center btn btn-success text-white w-75" id="buttonLayout63" style='border-radius:0 2px 2px 0'>Cancel</a>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout64]" value="" id="buttonLayout64_hidden">
						<button onmouseenter="getHooverColor('buttonLayout64');" onmouseleave ="removeHooverColor('buttonLayout64');" onclick="onclickActions('buttonLayout64','64')" name="buttons_layout[buttonLayout64]" type="button" class="btn btn-outline-secondary btn-xs butCancel" id="buttonLayout64">Cancel</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout57]" value="" id="buttonLayout57_hidden">
						<button onmouseenter="getHooverColor('buttonLayout57');" onmouseleave ="removeHooverColor('buttonLayout57');" onclick="onclickActions('buttonLayout57','57')" name="buttons_layout[buttonLayout57]" class="btn btn-primary" type="button" id="buttonLayout57"><i class="fa fa-feed"></i>&nbsp;&nbsp;Request</button>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout59]" value="" id="buttonLayout59_hidden">
						<button onmouseenter="getHooverColor('buttonLayout59');" onmouseleave ="removeHooverColor('buttonLayout59');" onclick="onclickActions('buttonLayout59','59')" name="buttons_layout[buttonLayout59]" class="btn btn-primary" type="button" id="buttonLayout59"><i class="fa fa-envelope"></i>&nbsp;&nbsp;</button>
						</td>
						
						
						
					</tr><tr class="collapse" id="buttonLayoutheader6">
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout66]" value="" id="buttonLayout66_hidden">
						<a onmouseenter="getHooverColor('buttonLayout66');" onmouseleave ="removeHooverColor('buttonLayout66');" onclick="onclickActions('buttonLayout66','66')" name="buttons_layout[buttonLayout66]" class="h-100 d-flex align-items-center btn btn-danger text-white w-75" id="buttonLayout66" style='border-radius:2px 0 0 2px'>Approve</a>
						</td>
						<td style='text-align:left'>
						<input type="hidden" name="buttons_layout[buttonLayout65]" value="" id="buttonLayout65_hidden">
						<button onmouseenter="getHooverColor('buttonLayout65');" onmouseleave ="removeHooverColor('buttonLayout65');" onclick="onclickActions('buttonLayout65','65')" name="buttons_layout[buttonLayout65]" type="button" class="btn btn-outline-secondary btn-xs butReject" id="buttonLayout65"><i class="fa fa-thumbs-down-o"></i>&nbsp;Submit</button>
						</td>
						
						<td style='text-align:left'></td>
						<td style='text-align:left'></td>
						<td style='text-align:left'></td>
						<td style='text-align:left'></td>
						<td style='text-align:left'></td>
						<td style='text-align:left'></td>
					</tr>
				</table>
			</div>



		</div>

	
	
	</div>
	
</div>