function comomonEmploymentModal(field,valueCheck){


	var fieldToUpdate =field;
	var allfieldsArray = <?=json_encode($allfieldsArray)?>;

 	if(valueCheck == 'dropdown')
	{
		$('#employment_data_dropdown_field_span').html(allfieldsArray[fieldToUpdate]);
		$('#employment_data_hidden_field_to_update_edit').val(fieldToUpdate);

		$('#modalEdit_employment_data_drop_down').modal('toggle');


	}else if(valueCheck == 'text'){
		$('#employment_data_text_field_span').html(allfieldsArray[fieldToUpdate]);
		$('#employment_data_hidden_field_to_update').val(fieldToUpdate);
		$('#modal_employment_data_common_text').modal('toggle');
	}else if(valueCheck == 'date'){
		$('#employment_data_date_field_span').html(allfieldsArray[fieldToUpdate]);
		$('#employment_data_hidden_date_field_to_update').val(fieldToUpdate);
		$('#modal_employment_data_common_date').modal('toggle');
	}


}


function submitPopupModalEditEmployment(valueCheck){


	if(valueCheck == 'date')
	{

		var work_data_hidden_dropdown_field_to_update = $('#employment_data_hidden_date_field_to_update').val();
		var modal_edit_date_value_work_data = $('#modal_edit_employment_data_date_value').val();

		$.ajax({
			url: "ajax/update_batch_data/update_employment_data.php",
			data:{fieldToUpdate:work_data_hidden_dropdown_field_to_update,dataToUpdate:modal_edit_date_value_work_data},
			success: function(result){

					$("body").overhang({
						type: "success",
						message: '<i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Data updated successfully']?>',
						duration: 1,
					})
					setTimeout(function(){location.reload();}, 1000);

				
					$('#modal_employment_data_common_date').modal('toggle');
					

			},
		});
	}
	else if(valueCheck == 'dropdown')
	{
		var work_data_hidden_dropdown_field_to_update = $('#work_data_hidden_field_to_update_dropdown').val();

		if(work_data_hidden_dropdown_field_to_update == 'emp_type')
		{
			var modal_edit_date_value_work_data = $('#modal_edit_dropdown_value_work_data').val();
		}
		else if(work_data_hidden_dropdown_field_to_update == 'account_code'){

			var modal_edit_date_value_work_data = $('#modal_edit_dropdown_value_account_work_data').val();
		}		
		else if(work_data_hidden_dropdown_field_to_update == 'groups'){

			var modal_edit_date_value_work_data = $('#modal_edit_dropdown_value_groups_work_data').val();
			var work_data_hidden_dropdown_field_to_update = 'groups';
		}



		$.ajax({
			url: "ajax/update_batch_data/update_batch_date_data_work_data.php",
			data:{fieldToUpdate:work_data_hidden_dropdown_field_to_update,dataToUpdate:modal_edit_date_value_work_data},
			success: function(result){

					$("body").overhang({
						type: "success",
						message: '<i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Data updated successfully']?>',
						duration: 1,
					})
					setTimeout(function(){location.reload();}, 1000);

				
					$('#modalEdit_dropdown_field_work_data').modal('toggle');
					

			},
		});
	}
}

$(document).on("click", ".commonEditColumnEmployment", function(e){

	var dropdownFieldArray = <?=json_encode($dropdownFieldEmployment)?>;
	var allfieldsArray = <?=json_encode($allfieldsArray)?>;/*
	var time_regArray = <?=json_encode($time_regArray)?>;
	var selfieArray = <?=json_encode($selfieArray)?>;
	var workFromHomeArray = <?=json_encode($workFromHomeArray)?>;*/


	var classNameString = $(this).closest('td.commonEditColumnEmployment').attr('class');
	var avoid = "commonEditColumnEmployment";
	var fieldToUpdate = $.trim(classNameString.replace(avoid,''));

	var oldvalue = $(this).closest('td.commonEditColumnEmployment').html();
	var rowId = $(this).closest('tr').children('td:first').find('span#rowIdDatatableSpan').html();


	$('#employment_hidden_row_id').val(rowId);
	$('#employment_hidden_field_to_update_dropdown').val(fieldToUpdate);

	// open modal here

	// check field type if drop down , text field or date and open common modal according to that 

	if(jQuery.inArray(fieldToUpdate, dropdownFieldArray) !== -1)
	{
		// append option to drop down 
		// first empty the previous values
		$('#modal_edit_employment_dropdown_value').empty();

		// // select array to show 
		if(fieldToUpdate == 'time_reg')
		{
			var loopArray = time_regArray;
		} 
		else if(fieldToUpdate == 'selfie')
		{
			var loopArray = selfieArray;
		}		
		else if(fieldToUpdate == 'workFromHome')
		{
			var loopArray = workFromHomeArray;
		}



		// Common append 
		 var mySelect = $('#modal_edit_employment_dropdown_value');
         mySelect.append(
                $('<option></option>').val('select').html('Select')
            );
        $.each(loopArray, function(val, text) {

        	if(text == oldvalue)
        	{
        		var selected = "selected";
        	}

            mySelect.append(
                $('<option  '+selected+'></option>').val(val).html(text)
            );
        });


        // open modal 
		$('#employment_dropdown_field_span').html(allfieldsArray[fieldToUpdate]);
		$('#modalEdit_employment_drop_down').modal('toggle');
	}


});

function submitPopupModalCommonEmploymentOnclick(valueCheck){

	var rowId = $('#employment_hidden_row_id').val();
	var fieldToUpdate = $('#employment_hidden_field_to_update_dropdown').val();

 	if(valueCheck == 'dropdown')
	{
		var dataToUpdate = $('#modal_edit_employment_dropdown_value').val();
	}

	$.ajax({
		url: "ajax/update_on_field_edit/update_temp_employee_data_for_employment_on_click.php",
		data:{rowId:rowId,fieldToUpdate:fieldToUpdate,dataToUpdate:dataToUpdate},
		success: function(result){


				if(valueCheck == 'dropdown')
				{
					$('#modalEdit_employment_drop_down').modal('toggle');
				}


				$("body").overhang({
					type: "success",
					message: '<i class="fa fa-check"></i>&nbsp;&nbsp;<?=$lng['Data updated successfully']?>',
					duration: 1,
				})
				setTimeout(function(){location.reload();}, 1000);




		},
	});

}



