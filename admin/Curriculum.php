<?php include 'db_connect.php' ?>
<div class="container-fluid">
	<div class="row"> <!-- class="row"-->
		<div class="col-md-4"> <!--class="col-md-4"-->

			<div class="card card-info card-primary">
				<div class="card-header">
					<b>Department</b>
				</div>
				<div class="card-body">
					<form action="" id="manage-curriculum">

						<input type="hidden" name="id" value="">
						<div class="form-group">
							<label for="" class="control-label">Class</label>
							<select name="class_id" id="class_id" class="form-control form-control-sm select2"
								value="<?php echo isset($class_id) ? $class_id : '' ?>">
								<option value=""></option>
								<?php
								$classes = $conn->query("SELECT class_id,concat(program,' ',year,' - ',section) as class FROM class_l");
								while ($row = $classes->fetch_assoc()):
									?>
									<option value="<?php echo $row['class_id'] ?>" <?php echo isset($class_id) && $class_id == $row['class_id'] ? "selected" : "" ?>><?php echo $row['class'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<!--<div class="form-group">
									<label for="">Year Level</label>
											<select id="yrlevel" name="yearlevel" onchange="showUser(this.value)" class="custom-select custom-select-sm select2">
																<option value="1">1st</option>
																<option value="2">2nd</option>
																<option value="3">3rd</option>
												<option value="4">4th</option>
														</select>
												</div>-->
						<div class="form-group">
							<label for="" class="control-label">Semester</label> &nbsp;
							<select id="semester" name="semester" onchange="showUser(this.value)"
								class="custom-select custom-select-sm select2" value="<?php echo isset($semester) ? $semester : '' ?>">
								<option value="1">1st</option>
								<option value="2">2nd</option>
								<option value="2">Summer</option>
							</select>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-end w-100">
						<button class="btn btn-sm btn-primary btn-flat bg-gradient-primary mx-1" id="searchBtn"
							type="button">Search</button>
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
							if (isset($_POST['class_id']) && isset($_POST['semester'])) {
								$class_id = $_POST['class_id'];
								$semester = $_POST['semester'];
								$qry = $conn->query("SELECT * FROM curr_list JOIN subject_list on curr_list.subject_id=subject_list.id
							JOIN faculty_list on curr_list.faculty_id=faculty_list.id where class_id = '$class_id' and semester = '$semester'"); //where class_id = $class_id and semester = $semester
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
												<?php echo ucwords($row['firstname']) ?>&nbsp;
												<?php echo ucwords($row['lastname']) ?>
											</b></td>
										<td class="text-center">
											<button type="button"
												class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
												data-toggle="dropdown" aria-expanded="true">
												Action
											</button>
											<div class="dropdown-menu" style="">
												<a class="dropdown-item manage_curriculum" href="">Edit</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item delete_curriculum" href="javascript:void(0)"
													data-id="<?php echo $row['id'] ?>">Delete</a>
											</div>
										</td>
									</tr>
								<?php endwhile;
							} ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#searchBtn').click(function (event) {
			event.preventDefault(); // Prevent the default form submission

			// Get the selected class_id value from the dropdown box
			var selectedClassId = $('#class_id').val();

			// Set the selected class_id as the value of the hidden input field
			$('#class_id').val(selectedClassId);

			// Submit the form
			$('#manage-curriculum').submit();
		})
		$('.new_subj').click(function () {
			uni_modal("New Course", "<?php echo $_SESSION['login_view_folder'] ?>manage_curriculum.php")
		})
		$('.manage_curriculum').click(function () {
			uni_modal("Manage Curriculum", "<?php echo $_SESSION['login_view_folder'] ?>manage_curriculum.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_curriculum').click(function () {
			_conf("Are you sure to delete?", "delete_curriculum", [$(this).attr('data-id')])
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