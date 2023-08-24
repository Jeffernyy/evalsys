<?php include 'db_connect.php' ?>
<div class="container-fluid">
	<div class="row"> <!-- class="row"-->
		<div class="col-md-4"> <!--class="col-md-4"-->

			<div class="card card-info card-primary">
				<div class="card-header">
					<b>Department</b>
				</div>
				<div class="card-body">
					<form action="" id="manage-question">
						<input type="hidden" name="academic_id" value="<?php echo isset($id) ? $id : '' ?>">
						<input type="hidden" name="id" value="">
						<div class="form-group">
							<label for="">Department</label>
							<select name="prog_code" id="prog_code" class="custom-select custom-select-sm select2">
								<?php
								$class = $conn->query("SELECT * FROM class ");
								while ($row = $class->fetch_assoc()):
									?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['prog_code'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Year Level</label>
							<select id="yrlevel" name="yearlevel" onchange="showUser(this.value)"
								class="custom-select custom-select-sm select2">
								<option value="1">1st</option>
								<option value="2">2nd</option>
								<option value="3">3rd</option>
								<option value="4">4th</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Semester</label> &nbsp;
							<select id="sem" name="semester" onchange="showUser(this.value)"
								class="custom-select custom-select-sm select2">
								<option value="1">1st</option>
								<option value="2">2nd</option>
							</select>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-end w-100">
						<button class="btn btn-sm btn-primary btn-flat bg-gradient-primary mx-1" type="submit">Search</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8"> <!--class="col-md-8"-->
			<div class="card card-outline card-info">
				<div class="card-body">

					<table class="table table-condensed">
						<thead>
							<tr class="bg-gradient-secondary">
								<th class="text-center">#</th>
								<th>Course Code</th>
								<th>Course Description</th>
								<th>Instructor</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody class="tr-sortable">
							<?php
							$i = 1;
							$qry = $conn->query("SELECT * FROM curriculum JOIN subject_list on curriculum.subject_id=subject_list.id
							JOIN faculty_list on curriculum.faculty_id=faculty_list.id");
							while ($row = $qry->fetch_assoc()):
								$q_arr[$row['id']] = $row;
								?>
								<tr>
									<th class="text-center">
										<?php echo $i++ ?>
									</th>
									<td><b>
											<?php echo $row['code'] ?>
										</b></td>
									<td><b>
											<?php echo $row['description'] ?>
										</b></td>
									<td><b>
											<?php echo $row['firstname'] ?>&nbsp;
											<?php echo $row['lastname'] ?>
										</b></td>
									<td class="text-center">
										<button type="button"
											class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
											data-toggle="dropdown" aria-expanded="true">
											Action
										</button>
										<div class="dropdown-menu" style="">
											<a class="dropdown-item" href="./index.php?page=edit_faculty&id=<?php echo $row['id'] ?>">Edit</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item delete_faculty" href="javascript:void(0)"
												data-id="<?php echo $row['id'] ?>">Delete</a>
										</div>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('.new_subj').click(function () {
			uni_modal("New Course", "<?php echo $_SESSION['login_view_folder'] ?>manage_curriculum.php")
		})
		$('.manage_curriculum').click(function () {
			uni_modal("Manage Curriculum", "<?php echo $_SESSION['login_view_folder'] ?>manage_curriculum.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_curriculum').click(function () {
			_conf("Are you sure to delete this course?", "delete_curriculum", [$(this).attr('data-id')])
		})
		$('#list').dataTable()
	})
	function delete_curriculum($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_curriculum',
			method: 'POST',
			data: { id: $id },
			success: function (resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					setTimeout(function () {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>