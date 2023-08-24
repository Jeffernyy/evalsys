<?php
include '../db_connect.php';
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM curr_list where id={$_GET['id']}")->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-course">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div id="msg" class="form-group"></div>


		<div class="form-group">
			<label for="course" class="control-label">Course</label>
			<select name="subject_id" id="subject_id" class="form-control form-control-sm select2">
				<option value=""></option>
				<?php
				$course = $conn->query("SELECT subject_list.id as sid,concat(code,': ',subject) as cour FROM subject_list");
				while ($row = $course->fetch_assoc()):
					?>
					<option value="<?php echo $row['sid'] ?>" <?php echo isset($subject_id) && $subject_id == $row['sid'] ? "selected" : "" ?>><?php echo $row['cour'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="class" class="control-label">Class</label>
			<select name="class_id" id="class_id" class="form-control form-control-sm select2">
				<option value=""></option>
				<?php
				$classes = $conn->query("SELECT class_id,concat(program,' ',year,' - ',section) as class FROM class_l");
				while ($row = $classes->fetch_assoc()):
					?>
					<option value="<?php echo $row['class_id'] ?>" <?php echo isset($class_id) && $class_id == $row['class_id'] ? "selected" : "" ?>><?php echo $row['class'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="faculty" class="control-label">Instructor</label>
			<select name="faculty_id" id="faculty_id" class="form-control form-control-sm select2">
				<option value=""></option>
				<?php
				$faculties = $conn->query("SELECT faculty_list.id as fid,concat(firstname,' ',lastname) as name FROM faculty_list");
				while ($row = $faculties->fetch_assoc()):
					?>
					<option value="<?php echo $row['fid'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['fid'] ? "selected" : "" ?>><?php echo $row['name'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="academic_year" class="control-label">Academic Year & Semester</label>
			<select name="academic_id" id="academic_id" class="form-control form-control-sm select2">
				<option value=""></option>
				<?php
				$acady = $conn->query("SELECT academic_list.id as aid,concat(year,' ',semester) as acad FROM academic_list");
				while ($row = $acady->fetch_assoc()):
					?>
					<option value="<?php echo $row['aid'] ?>" <?php echo isset($academic_id) && $academic_id == $row['aid'] ? "selected" : "" ?>><?php echo $row['acad'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>


	</form>
</div>
<script>
	$(document).ready(function () {
		$('#manage-course').submit(function (e) {
			e.preventDefault();
			start_load()
			$('#msg').html('')
			$.ajax({
				url: 'ajax.php?action=save_curri',
				method: 'POST',
				data: $(this).serialize(),
				success: function (resp) {
					if (resp == 1) {
						alert_toast("Data successfully saved.", "success");
						setTimeout(function () {
							location.reload()
						}, 1750)
					} else if (resp == 2) {
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Assigned Faculty in Course already exist.</div>')
						end_load()
					}
				}
			})
		})
	})

</script>