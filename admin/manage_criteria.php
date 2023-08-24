<?php
include '../db_connect.php';
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM criteria_list where id={$_GET['id']}")->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-criteria">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div id="msg" class="form-group"></div>
		<div class="form-group">
			<label for="type" class="control-label">Type</label>
			<select name="type" id="type" class="custom-select custom-select-sm select2">
				<option value="1">Student</option>
				<option value="2">Faculty</option>
				<option value="3">Supervisor</option>
			</select>
		</div>
		<div class="form-group">
			<label for="criteria" class="control-label">Criteria</label>
			<input type="text" class="form-control form-control-sm" name="criteria" id="criteria"
				value="<?php echo isset($criteria) ? $criteria : '' ?>" required>
		</div>
	</form>
</div>
<script>
	$(document).ready(function () {
		$('#manage-criteria').submit(function (e) {
			e.preventDefault();
			start_load()
			$('#msg').html('')
			$.ajax({
				url: 'ajax.php?action=save_criteria',
				method: 'POST',
				data: $(this).serialize(),
				success: function (resp) {
					if (resp == 1) {
						alert_toast("Data successfully saved.", "success");
						setTimeout(function () {
							location.reload()
						}, 1750)
					} else if (resp == 2) {
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Criteria already exist.</div>')
						end_load()
					}
				}
			})
		})
	})

</script>