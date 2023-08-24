<?php
include '../db_connect.php';
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM curriculum where id={$_GET['id']}")->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-class">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div id="msg" class="form-group"></div>
		<div class="form-group">
			<label for="">Course</label>
			<select name="course" id="course" class="custom-select custom-select-sm select2">
				<option value=""></option>
				<?php
				$class = $conn->query("SELECT * FROM subject_list ");
				while ($row = $class->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>"><?php echo $row['subject'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="">Instructor</label>
			<select name="course" id="course" class="custom-select custom-select-sm select2">
				<option value=""></option>
				<?php
				$class = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM faculty_list order by concat(firstname,' ',lastname) asc ");
				while ($row = $class->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>

	</form>
</div>
<script>
	$(document).ready(function () {
		$('#manage_curriculum').submit(function (e) {
			e.preventDefault();
			start_load()
			$('#msg').html('')
			$.ajax({
				url: 'ajax.php?action=save_curriculum',
				method: 'POST',
				data: $(this).serialize(),
				success: function (resp) {
					if (resp == 1) {
						alert_toast("Data successfully saved.", "success");
						setTimeout(function () {
							location.reload()
						}, 1750)
					} else if (resp == 2) {
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Class already exist.</div>')
						end_load()
					}
				}
			})
		})
	})

</script>