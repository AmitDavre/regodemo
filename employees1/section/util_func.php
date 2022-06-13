			var div_data_id=['#personal_div_data','#country_div_data','#work_div_data','#time_div_data','#leave_div_data','#organization_div_data','#financial_div_data','#benefits_div_data'];

			function hide_div_data(g){
				div_data.forEach(function(idx){
					$(idx).css('display','none');
				});
				if(g>0&&g<9)div_data[g+1].css('display','none');
			}

			
			var datatables=[dtable,dtable3,dtable5,dtable7,dtable9,dtable11,dtable13,dtable15];

			datatables.foreach(function(v1,idx){
				$('#datatables'+(idx*2+11).show(function(){setTimeout(function(){
					dtable.columns.adjust();dtable2.columns.adjust();
				}, 1000); });
			});