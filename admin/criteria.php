<?php include 'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_criteria" href="javascript:void(0)"><i
						class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="45%">
					<col width="35%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th>Criteria</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM criteria_list");
					while ($row = $qry->fetch_assoc()):
						?>
						<tr>
							<td><b>
									<?php echo $row['criteria'] ?>
								</b></td>
							<td class="text-center">
								<?php if ($row['type'] == 1): ?>
									<span>Student</span>
								<?php elseif ($row['type'] == 2): ?>
									<span>Faculty</span>
								<?php elseif ($row['type'] == 3): ?>
									<span>Supervisor</span>
								<?php endif; ?>
							</td>

							<td class="text-center">
								<div class="btn-group">
									<a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'
										class="btn btn-primary btn-flat manage_criteria">
										<i class="fas fa-edit"></i>
									</a>
									<button type="button" class="btn btn-danger btn-flat delete_criteria"
										data-id="<?php echo $row['id'] ?>">
										<i class="fas fa-trash"></i>
									</button>
								</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('.new_criteria').click(function () {
			uni_modal("New criteria", "<?php echo $_SESSION['login_view_folder'] ?>manage_criteria.php")
		})
		$('.manage_criteria').click(function () {
			uni_modal("Manage criteria", "<?php echo $_SESSION['login_view_folder'] ?>manage_criteria.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_criteria').click(function () {
			_conf("Are you sure to delete this criteria?", "delete_criteria", [$(this).attr('data-id')])
		})
		$('.make_default').click(function () {
			_conf("Are you sure to make this academic year as the system default?", "make_default", [$(this).attr('data-id')])
		})
		$('#list').dataTable()
	})
	function delete_criteria($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_criteria',
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