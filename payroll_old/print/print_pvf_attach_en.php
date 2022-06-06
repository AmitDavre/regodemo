<?php

	if(session_id()==''){session_start();}
	ob_start();
	include('../../dbconnect/db_connect.php');
	include(DIR.'files/functions.php');
	include(DIR.'files/arrays_'.$lang.'.php');
	include(DIR.'files/payroll_functions.php');
	
	$edata = getEntityData($_SESSION['rego']['gov_entity']);
	$entityBranches = getEntityBranches($_SESSION['rego']['gov_entity']);
	//$branchCode = getBranchCode($_SESSION['rego']['gov_entity']);
	
	$branch = sprintf("%06d",$entityBranches[$_SESSION['rego']['gov_branch']]['code']);
	$data = getPVFattach($_SESSION['rego']['payroll_dbase'],$_SESSION['rego']['gov_month'],'th');
	$c = count($data['d']);
	//var_dump($data); exit;
	$nr=1; 
	
$style = '
	<style>
		@page {
			margin: 10px 10px 10px 10px;
		}
		body, html, table {
			font-family: "leelawadee", "garuda";
			font-family: "leelawadee";
			font-size:11px;
		}
		table.wrap {
			border-collapse:collapse;
			width:100%;
			margin:6px 0 0px 0;
			table-layout:fixed;
			overflow: wrap;
		}
		table.header {
			border-collapse:collapse;
			width:100%;
			overflow: wrap;
		}
		table.header td {
			padding:0;
			vertical-align:center;
			white-space:nowrap;
			font-weight:normal;
			overflow:hidden;
			white-space:nowrap;
			line-height:200%;
		}
		table.toptable {
			border-collapse:collapse;
			border:0.01em solid #000;
			width:100%;
		}
		table.toptable td, table.toptable th {
			padding:3px 6px;
			vertical-align: baseline;
			white-space:nowrap;
			font-weight:normal;
			white-space:normal;
			line-height:140%;
			text-align:left;
		}
		table.taxtable {
			border-collapse:collapse;
			border:0;
			width:100%;
			line-height:normal;
		}
		table.taxtable th, table.taxtable td {
			border:0.01em solid #000;
			padding:4px 6px;
			color:#111;
			font-family: inherit;
			vertical-align:middle;
			text-align:center;
			font-size:12px;
			white-space:nowrap;
			font-weight:normal;
		}
		table.taxtable td {
			text-align:center;
			vertical-align:bottom;
		}
		table.taxtable th {
			padding:5px;
		}
		table.taxtable td.amt {
			vertical-align:baseline;
			text-align:right;
		}
		i.fa {
			font-family: fontawesome;
			font-style:normal;
		}
		.pnr {
			font-size:12px;
			font-weight:normal;
			text-align:right;
			float:right;
			width:250px;
			padding-top:4px;
		}
		.footer {
			font-size:10px;
			font-weight:normal;
			text-align:right;
			float:right;
			color:#ccc;
			width:300px;
		}
	</style>';

$header = '<div style="width:50%;font-size:16px;border:0px solid red"><b>Attachment remittance incomes members</b></div>
			
			<table class="toptable" border="0">
				<thead>
				<tr>
					<th style="width:65%">
						Company name : <span style="font-size:14px"><b>'.$edata[$lang.'_compname'].'</b></span><br>
						Company registration number : <b>'.$edata['tax_id'].'</b><br />
						Branch : <b>'.$branch.'</b>
						
						
					</th>	
					<th style="">
						Page {PAGENO} from {nbpg} pages<br>
						Month : <b>'.$_SESSION['rego']['formdate']['m'].' '.$_SESSION['rego']['formdate']['eny'].'</b><br>
						Date : <b>'.$_SESSION['rego']['formdate'][$lang.'date'].'</span></b>
					</th>
				</tr>
				</thead>
			</table>';
				
$footer = '<div class="footer">Form generated by : Xray HR</div>';
	
$html = '<html><body>';
		
$html .= '
			<table style="margin-top:10px" class="taxtable" border="0">
				<thead>
				<tr>
					<th style="vertical-align:middle; width:10px">Item</th>
					<th style="text-align:left; width:30px">Tax ID</th>
					<th style="text-align:left">Name employee</th>
					<th style="vertical-align:middle; width:110px">PVF employee</th>
					<th style="vertical-align:middle; width:110px">PVF employer</th>
					<th style="vertical-align:middle; width:110px">Total</th>
				</tr>
				</thead>
				<tbody>';
				
				foreach($data['d'] as $k=>$v){ 
$html .= '	<tr>
					<td style="text-align:right">'.$k.'&nbsp;</td>
					<td style="text-align:left">'.$v['tax_id'].'</td>
					<td style="text-align:left">'.$v['title'].' '.$v['th_name'].'</td>
					<td style="text-align:right">'.$v['pvf_employee'].'</td>
					<td style="text-align:right">'.$v['pvf_employer'].'</td>
					<td style="text-align:right">'.$v['tot_pvf'].'</td>
				</tr>';
				}
				
$html .= '	<tr>
					<th colspan="3" style="text-align:right"><b>Total</th>
					<th style="text-align:right; vertical-align:bottom; width:100px"><b>'.$data['total_employee'].'</b></th>
					<th style="text-align:right; vertical-align:bottom; width:10px"><b>'.$data['total_employer'].'</b></th>
					<th style="text-align:right; vertical-align:bottom; width:100px"><b>'.$data['total_pvf'].'</b></th>
				</tr>
				</tbody>
			</table>';
		
	$html .= '</body></html>';	
			
	//echo $style.$header.$html.$footer; exit;	
	
	require_once("../../mpdf7/vendor/autoload.php");
	//class mPDF ($mode, $format , $default_font_size , $default_font , $margin_left , $margin_right , $margin_top , $margin_bottom , $margin_header , $margin_footer , string $orientation ]]]]]])
	$mpdf=new mPDF('utf-8', 'A4-P', 9, '', 8, 8, 29.5, 8, 8, 5);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->SetFontSize(9);
	$mpdf->SetTitle($edata[$lang.'_compname'].' ('.strtoupper($_SESSION['rego']['cid']).') - Provident Fund - '.$months[(int)$_SESSION['rego']['gov_month']].' '.$_SESSION['rego']['cur_year']);
	$mpdf->WriteHTML($style,1);
	$mpdf->SetHTMLHeader($header);
	//$mpdf->SetHTMLFooter($footer);
	$mpdf->WriteHTML($html);
	//$mpdf->Output($_SESSION['rego']['cid'].'_PVF attachment_'.$_SESSION['rego']['cur_year'].'_'.$_SESSION['rego']['gov_month'].'.pdf',$action);
	
	$dir = DIR.$_SESSION['rego']['cid'].'/archive/';
	$root = ROOT.$_SESSION['rego']['cid'].'/archive/';
	$baseName = $_SESSION['rego']['cid'].'_pvf_attachment_'.$_SESSION['rego']['curr_month'].'_'.$_SESSION['rego']['year_'.$lang];
	$extension = 'pdf';		
	$filename = getFilename($baseName, $extension, $dir);
	$doc = $lng['PVF Attachment'].' '.$_SESSION['rego']['curr_month'].'-'.$_SESSION['rego']['year_'.$lang];
	
	$mpdf->Output($filename,'I');
	
	if(isset($_REQUEST['a'])){
		$mpdf->Output($dir.$filename,'F');
		include('save_to_documents.php');
	}
	
	exit;
	










