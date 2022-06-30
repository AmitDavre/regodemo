<?
	for($i=(date('Y')-1); $i <= (date('Y')+1); $i++){
		$years[$i] = $i;
	}
?>
	
	<h2><i class="fa fa-rebel"></i>&nbsp;&nbsp;<?=$lng['Public holidays']?> 
		<span style="display:none; font-style:italic; color:#b00; padding-left:30px" id="sAlert"><i class="fa fa-exclamation-triangle fa-mr"></i><?=$lng['Data is not updated to last changes made']?></span>
	</h2>
	<div class="main">
		<div style="padding:0 0 0 20px" id="dump"></div>
		
		<div id="showTable" class="holidays-list" style="display:none">
			
			<select class="button" id="selYear">
				<? foreach($years as $v){
						echo '<option ';
						if($_SESSION['rego']['cur_year'] == $v){echo 'selected';}
						echo ' value="'.$v.'">'.$lng['Holidays'].' '.$v.'</option>';
					} ?>
			</select>
			<button id="getHolidays" class="btn btn-primary" type="button"><i class="fa fa-download"></i>&nbsp; <?=$lng['Import holidays from REGO admin']?></button>
			<button id="addHoliday" class="btn btn-primary" type="button"><i class="fa fa-plus"></i>&nbsp; <?=$lng['Add holiday']?></button>
			<div style="clear:both"></div>

			<table id="holidayTable" class="dataTable inputs xnowrap" border="0">
				<thead>
					<tr>
						<th style="width:130px;" class="tal"><?=$lng['Date']?></th>
						<th data-sortable="false" style="width:130px"><?=$lng['Company date']?></th>
						<th data-sortable="false" style="width:50%"><?=$lng['Thai']?></th>
						<th data-sortable="false" style="width:50%"><?=$lng['English']?></th>
						<th data-sortable="false"><i class="fa fa-edit fa-lg"></i></th>
						<th data-sortable="false"><i class="fa fa-trash fa-lg"></i></th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
		
	</div>
	
	<!-- Modal ADD HOLIDAY -->
	<div class="modal fade" id="modalHoliday" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="fa fa-plus"></i>&nbsp; <?=$lng['Add holiday']?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="sform" id="holiForm">
						<input name="id" type="hidden" value="0" />
						<label><?=$lng['Date']?><i class="man"></i></label>
						<input readonly class="holiday_date_month nofocus" style="cursor:pointer" name="date" type="text" />
						<label><?=$lng['Company date']?><i class="man"></i></label>
						<input readonly class="holiday_date_month nofocus" style="cursor:pointer" name="cdate" type="text" />
						<label><?=$lng['Thai']?><i class="man"></i></label>
						<input name="th" type="text" />
						<label><?=$lng['English']?><i class="man"></i></label>
						<input name="en" type="text" />
						<div style="height:10px"></div>
						<button class="btn btn-primary btn-fr" type="button" data-dismiss="modal"><i class="fa fa-times fa-mr"></i><?=$lng['Cancel']?></button>
						<button class="btn btn-primary btn-fr" type="submit"><i class="fa fa-save fa-mr"></i><?=$lng['Update']?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
<script>

	var headerCount = 1;

	$(document).ready(function() {
		
		var dtable = $('#holidayTable').DataTable({
			scrollX:       'auto',
			scrollY:       false,
			scrollCollapse:false,
			fixedColumns:  false,
			lengthChange:  false,
			searching: 		false,
			ordering: 		true,
			paging: 			true,
			pageLength: 	16,
			filter: 			false,
			info: 			false,
			autoWidth:		true,
			<?=$dtable_lang?>
			processing: 	false,
			serverSide: 	true,
			order: [[0, 'asc']],
			ajax: {
				url: "ajax/server_get_holidays.php",
				data: function(d){
					d.year = $('#selYear').val();
				}
			},
			columnDefs: [
				{ targets: [4,5], class: 'tac',},
				//{ targets: [0,1,4,5], "width": '1px',},
			],	
			initComplete : function( settings, json ) {
				$('#showTable').fadeIn(400)
				dtable.columns.adjust().draw()
			}
		});
		
		$('#selYear').on('change', function(){
			dtable.ajax.reload(null, false);
		})
		
		$('#addHoliday').on('click', function(){
			$('input[name="id"]').val(0)
			$('#modTitle').html('<?=$lng['Add holiday']?>')
			$('#modalHoliday').modal('toggle')
		})
		
		$(document).on('click', '.editHoliday', function(){
			var id = $(this).data('id');
			$.ajax({
				url: "ajax/get_holiday.php",
				data: {id: id},
				dataType: 'json',
				success: function(data){
					//$("#dump").html(data);
					$('#modTitle').html('<?=$lng['Edit holiday']?>')
					$('input[name="id"]').val(data.id)
					$('input[name="date"]').val(data.date)
					$('input[name="cdate"]').val(data.cdate)
					$('input[name="th"]').val(data.th)
					$('input[name="en"]').val(data.en)
					
					$('#modalHoliday').modal('toggle')
				},
				error:function (xhr, ajaxOptions, thrownError){
					$("#message").html('<div class="msg_error nomargin"><?=$lng['Sorry but someting went wrong']?> Error : ' + thrownError + '</div>').fadeIn(200);
					setTimeout(function(){$("#message").fadeOut(200);},4000);
				}
			});
		})
		
		$('#modalHoliday').on('hidden.bs.modal', function () {
			$("#holiForm").trigger('reset');
			$("#modMessage").hide()
		});

		$("#holiForm").submit(function(e){ 
			e.preventDefault();
			$("#modMessage").hide()
			if($('input[name="date"]').val()=='' || $('input[name="cdate"]').val()=='' || $('input[name="th"]').val()=='' || $('input[name="en"]').val()==''){
				$("body").overhang({
					type: "error",
					message: '<i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Please fill in all the fields']?>',
					duration: 2,
				})
				return false;
			}
			var data = $(this).serialize();
			$.ajax({
				url: "ajax/update_holidays.php",
				data: data,
				success: function(result){
					if(result == 'success'){
						$("body").overhang({
							type: "success",
							message: '<i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Data updated successfuly']?>',
							duration: 2,
						})
						dtable.ajax.reload(null, false);
						setTimeout(function(){$('#modalHoliday').modal('toggle');},300);
					}else{
						$("body").overhang({
							type: "error",
							message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Error']?> : '+result,
							duration: 4,
							//closeConfirm: true
						})
					}
				},
				error:function (xhr, ajaxOptions, thrownError){
					$("body").overhang({
						type: "error",
						message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Sorry but someting went wrong']?> <b><?=$lng['Error']?></b> : '+thrownError,
						duration: 8,
						closeConfirm: "true",
					})
				}
			});
		});
		
		$(document).ajaxComplete(function( event,request, settings ) {
			$('.delHoliday').confirmation({
				container: 'body',
				rootSelector: '.delHoliday',
				singleton: true,
				animated: 'fade',
				placement: 'left',
				popout: true,
				html: true,
				title: '<?=$lng['Are you sure']?>',
				btnOkClass: 'btn btn-danger',
				btnOkLabel: '<?=$lng['Delete']?>',
				btnOkIconContent: '',
				btnCancelClass: 'btn btn-success',
				btnCancelLabel: '<?=$lng['Cancel']?>',
				onConfirm: function() {
					$.ajax({
						url: "ajax/delete_holiday.php",
						data: {id: $(this).data('id')},
						success: function(result){
							//$('#dump').html(result);
							dtable.ajax.reload(null, false);
						},
						error:function (xhr, ajaxOptions, thrownError){
							$("body").overhang({
								type: "error",
								message: '<?=$lng['Sorry but someting went wrong']?> <b><?=$lng['Error']?></b> : '+thrownError,
								duration: 4,
								//closeConfirm: "true",
							})
						}
					});
				}
			});
		});
		
		$('.holiday_date_month').datepicker({
			format: "D dd-mm-yyyy",
			autoclose: true,
			inline: true,
			language: '<?=$lang?>-en',//lang+'-th',
			//viewMode: 'years',
			startView: 'year',
			todayHighlight: true,
			//startDate : startYear,
			//endDate   : endYear
		})

		/////////////////
		$('#getHolidays').on('click',function(){
			/*
			$('#import_holidays').click();
		})
		$(document).on("change", "#import_holidays", function(e){
			e.preventDefault();
			var cid = <?=json_encode($_SESSION['rego']['cid'])?>;
		});
		$(document).on("submit", "form#import", function(e){
			e.preventDefault();*/
			var data=new FormData();
			data.append('year',$('#selYear').find(":selected").val());
			for (var input of data.entries())
			console.log(input[0]+' '+input[1]);
			$.ajax({
				url: 'ajax/import_holidays_from_admin.php',
				type: 'POST',
				data: data,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(result){
					if($.trim(result) == 'success'){
						$("body").overhang({
							type: "success",
							message: '<i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Data imported successfuly. Please wait for page reload']?> . . .',
							duration: 1,
						})

						setTimeout(function(){
							location.reload();
						}, 1000);
					}else{
						$("body").overhang({
							type: "warn",
							message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;'+result,
							closeConfirm: "true",
							duration: 5,
						})
					}
				},
				error:function (xhr, ajaxOptions, thrownError){
					$("body").overhang({
						type: "error",
						message: '<i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;<?=$lng['Sorry but someting went wrong']?> <b><?=$lng['Error']?></b> : '+thrownError,
						duration: 8,
						closeConfirm: "true",
					});
				}
			});
		});
		//////////////////
		
	});

</script>	













