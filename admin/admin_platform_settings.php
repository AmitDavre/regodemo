<?php
 	
	$tickets = getSupportTickets();
	$checkHolidays = '';
	if(date('n') == 12){
		if(!checkHolidaysDB((date('Y')+1))){
			$checkHolidays = '<b><a href="index.php?mn=54">Add holidays for the year '.(date('Y')+1).'</a></b>';
		}
	}else{
		if(!checkHolidaysDB((date('Y')))){
			$checkHolidays = '<b><a href="index.php?mn=54">Add holidays for the year '.(date('Y')).'</a></b>';
		}
	}
	$new_tickets = $tickets['new'];
	$open_tickets = $tickets['open'];

	
?>
	
			<div class="dash-left">							

				<div class="dashbox <? if($_SESSION['RGadmin']['access']['def_settings']['access'] == 1){}else{echo 'disabled';}?>">
					<div class="inner" onclick="window.location.href='index.php?mn=51';"
						<? 
						if($_SESSION['RGadmin']['access']['def_settings']['access'] == 1){
							echo "style=background:".$savedAdminColors[$savedAdminDashboardlayout['colorSelect1']]['code']."";
						}else{ 
							echo "style=background:fff";
						}
					?>
					> <!--51-->
					<i class="fa fa-cogs"></i>
						<div class="parent">
							<div class="child">
								<p
								<?php 
									echo "style=font-family:".$savedDefaultFonts[$savedAdminDashboardlayout['font_settings']]."!important;color:".$savedAdminColors[$savedAdminDashboardlayout['fontColor']]['code']."!important"; 
								?>
								><?=$lng['Default settings']?></p>
							</div>
						</div>
					</div>
				</div>
		
				<div class="dashbox <? if($_SESSION['RGadmin']['access']['language']['access'] == 1){}else{echo 'disabled';}?>">
					<div class="inner" onclick="window.location.href='index.php?mn=99';"
					<? 
						if($_SESSION['RGadmin']['access']['language']['access'] == 1){
							echo "style=background:".$savedAdminColors[$savedAdminDashboardlayout['colorSelect2']]['code']."";
						}else{ 
							echo "style=background:fff";
						}
					?>
					>
					<i class="fa fa-language"></i>
						<div class="parent">
							<div class="child">
								<p
								<?php 
									echo "style=font-family:".$savedDefaultFonts[$savedAdminDashboardlayout['font_settings']]."!important;color:".$savedAdminColors[$savedAdminDashboardlayout['fontColor']]['code']."!important"; 
								?>
								><?=$lng['Language list']?></p>
							</div>
						</div>
					</div>
				</div>		
				<div class="dashbox <? if($_SESSION['RGadmin']['access']['email_templates_settings']['access'] == 1){}else{echo 'disabled';}?>">
					<div class="inner" onclick="window.location.href='index.php?mn=57';"
					<? 
						if($_SESSION['RGadmin']['access']['email_templates_settings']['access'] == 1){
							echo "style=background:".$savedAdminColors[$savedAdminDashboardlayout['colorSelect3']]['code']."";
						}else{ 
							echo "style=background:fff";
						}
					?>
					> 
					<i class="fa fa-envelope"></i>
						<div class="parent">
							<div class="child">
								<p
								<?php 
									echo "style=font-family:".$savedDefaultFonts[$savedAdminDashboardlayout['font_settings']]."!important;color:".$savedAdminColors[$savedAdminDashboardlayout['fontColor']]['code']."!important"; 
								?>
								><?=$lng['Email Templates']?></p>
							</div>
						</div>
					</div>
				</div>				

				<div class="dashbox <? if($_SESSION['RGadmin']['access']['parameters_tab']['access'] == 1){}else{echo 'disabled';}?>">
					<div class="inner" onclick="window.location.href='index.php?mn=3004';"
					<? 
						if($_SESSION['RGadmin']['access']['parameters_tab']['access'] == 1){
							echo "style=background:".$savedAdminColors[$savedAdminDashboardlayout['colorSelect4']]['code']."";
						}else{ 
							echo "style=background:fff";
						}
					?>
					> 
					<i class="fa fa-info"></i>
						<div class="parent">
							<div class="child">
								<p
								<?php 
									echo "style=font-family:".$savedDefaultFonts[$savedAdminDashboardlayout['font_settings']]."!important;color:".$savedAdminColors[$savedAdminDashboardlayout['fontColor']]['code']."!important"; 
								?>
								><?=$lng['Parameter Settings']?></p>
							</div>
						</div>
					</div>
				</div>

	
			</div>
			
			<div class="dash-right">
		
				<div class="notify_box">
					<h2 
					<?php 
						echo "style=background:".$savedAdminColors[$savedAdminDashboardlayout['colorSelect15']]['code']."!important"; 

					?>

					><i class="fa fa-bell"></i>&nbsp; 
						<span 
						<?php 
							echo "style=font-family:".$savedDefaultFonts[$savedAdminDashboardlayout['font_settings_box']]."!important"; 
						?>
						>
					<?=$lng['Notification box']?> </span></h2>
					<div class="inner">
						<span 

						<?php
							echo "style=font-family:".$savedDefaultFonts[$savedAdminDashboardlayout['font_settings_box_content']]."!important";
						?>
						>
						<?=$lng['New support tickets']?> : <b><?=$new_tickets?></b><br>
						<?=$lng['Open support tickets']?> : <b><?=$open_tickets?></b><br>
						<?=$checkHolidays?>
						<span>
	
					</div>
				</div>
		
			</div>
   
						
















