			var datatables=[dtable,dtable2,dtable3,dtable4,dtable5,dtable6,dtable7,dtable8,dtable9,dtable10,dtable11,dtable12,dtable13,dtable14,dtable15];
			function adjust_columns(){
				datatables.forEach(function(v1,idx){
					$('#datatables'+(idx*2+11)).show(function(){setTimeout(function(){
						datatables[idx*2].columns.adjust();datatables[idx*2+1].columns.adjust();
					}, 1000); });
				});
			}

			

			var sections=['personal','contacts','work_data','time','leave','organisation','financial','benefits'];
			
			function show_div_data(g){
			if(g==1){
			$('#showHideclm2').prop("disabled",false);
			$('#showHideClmss2').removeClass('displayNone');
			}
			sections.forEach(function(element){
				$('#div_'+element).css("display","none");
				$('#'+element+'_old_data').css("display","none");
			});
			
			$('#div_'+sections[g-1]).css("display","");
			$('#'+sections[g-1]+'_old_data').css("display","");


			var hideAllcolumn = [3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
			$.each(hideAllcolumn, function(key,val) {    
				datatables[(g-1)*2].column(val).visible(true);
				datatables[(g-1)*2+1].column(val).visible(true);
			});


			for(let i=2;i<=9;i++)
				$("#showHideclm"+(i+1)).closest("div").css('display','none');
			
			$('#showHideclm'+(g+1)).closest("div").css('display','');
			
			$(".commonhidebutton").css('display','');

			datatables[(g-1)*2].columns.adjust();
			datatables[(g-1)*2+1].columns.adjust();
			}