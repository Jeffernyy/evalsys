<?php include'db_connect.php' ?>

<div class="container-fluid">
	<div class="row"> <!-- class="row"-->
		<div class="col-md-4"> <!--class="col-md-4"-->
			<div class="card card-info card-primary">
				<div class="card-header">
					<b>Add Peers</b>
				</div>
				<div class="card-body">
					<form action="" id="manage-peers">
						<input type="hidden" name="academic_id" value="<?php echo isset($id) ? $id : '' ?>">
						<input type="hidden" name="id" value="">
						<div class="form-group">
							<label for="">Group Number</label>
							<select name="group_num" id="group_num" class="custom-select custom-select-sm select2">
								<option value=""></option>
							<?php 
								$criteria = $conn->query("SELECT *, faculty_peers.id as fpid FROM faculty_peers order by abs(group_num) asc ");
								while($row = $criteria->fetch_assoc()):
							?>
							<option value="<?php echo $row['fpid'] ?>" <?php echo isset($group_num) && $group_num == $row['fpid'] ? "selected" : "" ?>><?php echo $row['group_num'] ?></option>
							<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Faculty</label>
							<select name="faculty_id" id="faculty_id" class="custom-select custom-select-sm select2">
								<option value=""></option>
							<?php 
								$faculty = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM faculty_list order by concat(firstname,' ',lastname) asc");
								$f_arr = array();
								while($row=$faculty->fetch_assoc()):
								$f_arr[$row['id']]= $row;
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['id'] ? "selected" : "" ?>><?php echo ucwords($row['name']) ?></option>
							<?php endwhile; ?>
							</select>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-end w-100">
						<button class="btn btn-sm btn-primary btn-flat bg-gradient-primary mx-1" form="manage-peers">Save</button>
						<button class="btn btn-sm btn-flat btn-secondary bg-gradient-secondary mx-1" form="manage-peers" type="reset">Cancel</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8"> <!--class="col-md-8"-->
			<div class="card card-outline card-info">
				<div class="card-header">
					<b></b>
					<div class="card-tools">
						<!--<button class="btn btn-sm btn-flat btn-primary bg-gradient-primary mx-1" id="eval_restrict" type="button">Evaluation Restriction</button>-->
						<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_group" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New Group</a>
					</div>
				</div>
				<div class="card-body">
					<form id="order-peers">
					<div class="clear-fix mt-2"></div>
					<?php 
							$q_arr = array();
						$peers = $conn->query("SELECT * FROM faculty_peers order by abs(group_num) asc ");
						while($crow = $peers->fetch_assoc()):
					?>
					<table class="table table-condensed">
						<thead>
							<tr class="bg-gradient-secondary">
								<th colspan="2" class=" p-1"><b>Group <?php echo $crow['group_num'] ?></b></th>
								<th class="text-center"></th>
								<th class="text-center"></th>
								<th class="text-center"></th>
								<th class="text-center"></th>
								<th class="text-center"></th>
							</tr>
						</thead>
						<tbody class="tr-sortable">
							<?php 
							$faculty = $conn->query("SELECT *,concat(f.firstname,' ',f.lastname) as name FROM facpeer_list p JOIN faculty_list f ON  p.faculty_id = f.id WHERE group_num = {$crow['id']}");
							while($row=$faculty->fetch_assoc()):
							$q_arr[$row['id']] = $row;
							?>
							<tr class="bg-white">
								<td class="p-1 text-center" width="5px">
									<span class="btn-group dropright">
									  <span type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									   <i class="fa fa-ellipsis-v"></i>
									  </span>
									  <div class="dropdown-menu">
									     <!--<a class="dropdown-item edit_peers" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>-->
					                      <div class="dropdown-divider"></div>
					                     <a class="dropdown-item delete_peers" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete  </a>
									  </div>
									</span>
								</td>
								<td class="p-1" width="40%">
									<?php echo $row['name'] ?>
									<input type="hidden" name="faid" value="<?php echo $row['id'] ?>">
								</td>
								<?php for($c=0;$c<5;$c++): ?>
								<td class="text-center">
	
								</td>
								<?php endfor; ?>
							</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
					<?php endwhile; ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function(){
		$('.new_group').click(function(){
			uni_modal("New Group","<?php echo $_SESSION['login_view_folder'] ?>manage_group.php")
		})
     $('.select2').select2({
	    placeholder:"Please select here",
	    width: "100%"
	  });
     })
	$('.delete_peers').click(function(){
		_conf("Are you sure to delete this from the group?","delete_peers",[$(this).attr('data-id')])
		})
	$('.tr-sortable').sortable()
	$('#manage-peers').on('reset',function(){
			$(this).find('input[name="id"]').val('')
			$('#manage-peers').find("[name='group_num']").val('').trigger('change')
		})
     $('#manage-peers').submit(function(e){
    	e.preventDefault()
    	start_load()
    	if($('#faculty_id').val() == ''){
    		alert_toast("Please fill the form first",'error');
    		end_load();
    		return false;
    	}
    	$.ajax({
    		url:'ajax.php?action=save_peers',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
    	})
    })
    
    function delete_peers($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_peers',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>