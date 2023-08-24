<?php include 'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_academic" href="javascript:void(0)"><i
						class="fa fa-plus"></i> Add New</a>
			</div>
		</div>

		<div>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

				<select id="cmbInitial" name="initial" onchange="showUser(this.value)">
					<option value="0">Student Questionnaire</option>
					<option value="1">Faculty Questionnaire</option>
					<option value="2">Supervisor Questionnaire</option>
				</select> <br><br>
			</form>

			<?php
			$initial = filter_input(INPUT_POST, "initial"); //GET the input in post method
			if ($initial == 0) {
				$initial_value = "Mr.";
			} elseif ($initial == 1) {
				$initial_value = "Mrs.";
			} elseif ($initial == 2) {
				$initial_value = "Ms.";
			}
			?>

		</div>

		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Year</th>
						<th>Semester</th>
						<th>System Default</th>
						<th>Evaluation Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM academic_list order by abs(year) desc,abs(semester) desc ");
					while ($row = $qry->fetch_assoc()):
						?>
						<tr>
							<th class="text-center">
								<?php echo $i++ ?>
							</th>
							<td><b>
									<?php echo $row['year'] ?>
								</b></td>
							<td><b>
									<?php echo $row['semester'] ?>
								</b></td>
							<td class="text-center">
								<?php if ($row['is_default'] == 0): ?>
									<button type="button"
										class="btn btn-secondary bg-gradient-secondary col-sm-4 btn-flat btn-sm px-1 py-0 make_default"
										data-id="<?php echo $row['id'] ?>">No</button>
								<?php else: ?>
									<button type="button"
										class="btn btn-primary bg-gradient-primary col-sm-4 btn-flat btn-sm px-1 py-0">Yes</button>
								<?php endif; ?>
							</td>
							<td class="text-center">
								<?php if ($row['status'] == 0): ?>
									<span class="badge badge-secondary">Not yet Started</span>
								<?php elseif ($row['status'] == 1): ?>
									<span class="badge badge-success">Starting</span>
								<?php elseif ($row['status'] == 2): ?>
									<span class="badge badge-primary">Closed</span>
								<?php endif; ?>
							</td>

							<td class="text-center">
								<button type="button"
									class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
									data-toggle="dropdown" aria-expanded="true">
									Action
								</button>
								<div class="dropdown-menu" style="">
									<a href="index.php?page=manage_questionnaire&id=<?php echo $row['id'] ?>">Student</a>
									<div class="dropdown-divider"></div>
									<a href="index.php?page=faculty_evaluation&id=<?php echo $row['id'] ?>">Faculty</a>
									<div class="dropdown-divider"></div>
									<a href="index.php?page=manage_questionnaire&id=<?php echo $row['id'] ?>">Supervisor</a>
								</div>
							</td>

							<!--<td class="text-center">
												<div class="btn-group">
														<a href="index.php?page=quest2&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat manage_academic">
															<i class="fas fa-edit"></i>
														</a>
														<button type="button" class="btn btn-danger btn-flat delete_academic" data-id="<?php echo $row['id'] ?>">
															<i class="fas fa-trash"></i>
														</button>
												</div>
						</td>-->
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('.new_academic').click(function () {
			uni_modal("New academic", "<?php echo $_SESSION['login_view_folder'] ?>manage_academic.php")
		})
		$('.manage_academic').click(function () {
			uni_modal("Manage academic", "<?php echo $_SESSION['login_view_folder'] ?>manage_academic.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_academic').click(function () {
			_conf("Are you sure to delete this academic?", "delete_academic", [$(this).attr('data-id')])
		})
		$('.make_default').click(function () {
			_conf("Are you sure to make this academic year as the system default?", "make_default", [$(this).attr('data-id')])
		})
		$('#list').dataTable()
	})
	function delete_academic($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_academic',
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
	function make_default($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=make_default',
			method: 'POST',
			data: { id: $id },
			success: function (resp) {
				if (resp == 1) {
					alert_toast("Dafaut Academic Year Updated", 'success')
					setTimeout(function () {
						location.reload()
					}, 1500)
				}
			}
		})
	}
</script>