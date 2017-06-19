			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number">
								 1349
							</div>
							<div class="desc">
								 New Feedbacks
							</div>
						</div>
						<a class="more" href="#">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number">
								 12,5M$
							</div>
							<div class="desc">
								 Total Profit
							</div>
						</div>
						<a class="more" href="#">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<div class="details">
							<div class="number">
								 549
							</div>
							<div class="desc">
								 New Orders
							</div>
						</div>
						<a class="more" href="#">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
							<div class="number">
								 +89%
							</div>
							<div class="desc">
								 Brand Popularity
							</div>
						</div>
						<a class="more" href="#">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-bar-chart font-green-sharp hide"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Leave Request</span>
							</div>
							<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Employee Name</th>
							<th>No Of Days</th>
							<th class="actions"><?= __('Actions') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach ($leaves as $requestLeave): $i++; 
						
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td>
							<a href="#" role="button" employee_id='<?php echo $requestLeave->employee_id; ?>' req_id='<?php echo $requestLeave->id; ?>' class="pull-right onhover" >
							<?php echo $requestLeave->employee->name; ?> </a>
							
							
							</td>
							<td><?php echo $requestLeave->no_of_days; ?></td>
							
							<td><?php echo $this->Html->link('Approve',['controller'=>'RequestLeaves','action' => 'approveLeaves', $requestLeave->id],array('escape'=>false,'employee_id'=>$requestLeave->employee_id,'class'=>'btn btn-sm default ','data-original-title'=>'Edit','req_id'=>$requestLeave->id)); 
							echo $this->Html->link('<i class="fa fa-minus-circle">Cancle</i> ',['controller'=>'RequestLeaves','action' => 'cancleLeaves', $requestLeave->id],array('escape'=>false,'class'=>'btn btn-xs red'));
						
							?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				
							
							
						</div>
						<?php ?>
					</div>
					<!-- END PORTLET-->
				</div>
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-red-sunglo hide"></i>
								<span class="caption-subject font-red-sunglo bold uppercase">Revenue</span>
								<span class="caption-helper">monthly stats...</span>
							</div>
							<div class="actions">
								<div class="btn-group">
									
									
								</div>
							</div>
						</div>
						
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
			<div class="clearfix">
	</div>
	
	
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() { 

    $('.onhover').die().live("click",function() { 
		
		var employee_id=$(this).attr('employee_id');
		var id=$(this).attr('req_id');
		open_details(employee_id,id);
	}); 
	
	function open_details(employee_id,id){
		
		$("#result_ajax").html('<div align="center"><?php echo $this->Html->image('/img/wait.gif', ['alt' => 'wait']); ?> Loading</div>');
		var url="<?php echo $this->Url->build(['controller'=>'RequestLeaves','action'=>'showDetails']); ?>";
		url=url+'/'+id+'/'+employee_id,
		
		$("#myModal12").show();
		$.ajax({
			url: url,
		}).done(function(response) {  
			$("#result_ajax").html(response);
		});
    }
	
	$('.closebtn').on("click",function() { 
		$("#myModal12").hide();
    });

});

</script>
<div id="myModal12" class="modal fade in" tabindex="-1"  style="display: none; padding-right: 12px;"><div class="modal-backdrop fade in" ></div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="result_ajax">
				
			</div>
			<div class="modal-footer">
				<button class="btn default closebtn">Close</button>
			</div>
		</div>
	</div>
</div>
