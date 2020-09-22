		</div>

		<script type="text/javascript">
			$(document).ready(function() {
			   var table = $('#example').DataTable({
			      order: [],
			      columnDefs: [
			      	{ 
			        	targets: [3], 
			         	render: function(data, type, full, meta){
			            	if(type === 'filter' || type === 'sort'){
			               		var api = new $.fn.dataTable.Api(meta.settings);
			               		var td = api.cell({row: meta.row, column: meta.col}).node();
			                    var $input = $('select, input', td);
			                    if($input.length && $input.is('select')){
			                       data = $('option:selected', $input).text();
			                    } else {                   
			                       data = $input.val();
			                    }
			            	}

			            	return data;
			         	}
			        }
			      ],
			      "columns": [
				    null,
				    null,
				    null,
				    null,
				    { "orderable": false },
				    { "orderable": false },
				  ]     
			   });
			   
			   $('tbody select, tbody input', table.table().node()).on('change', function(){
			      table.row($(this).closest('tr')).invalidate();
			   });

			   $("select.status").on('change',function() {
					    var title,id; 
					    status = $(this).val();
					    id = $(this).data('id');
					    if(!id) { return falses }
					    $.ajax({
					        url: 'news/update_status/'+id,
					        data: ({ status: status }),
					        dataType: 'json', 
					        type: 'post',
					        success: function(data) {
					            response = jQuery.parseJSON(data);
					            console.log(response);
					        },
					        error: function(argument) {
					        	alert('error');
					        }         
					    });

					});
			 }); // Ready Closer 

		</script>

	</body>
</html>