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
	<form action="" id="manage-question">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div id="msg" class="form-group"></div>
		<div class="form-group">
			<label for="">Criteria</label>
			<select name="criteria_id" id="criteria_id" class="custom-select custom-select-sm select2">
				<option value=""></option>
				<?php
				$criteria = $conn->query("SELECT * FROM criteria_list order by abs(order_by) asc ");
				while ($row = $criteria->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>"><?php echo $row['criteria'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="">Question</label>
			<textarea name="question" id="question" cols="30" rows="4" class="form-control"
				required=""><?php echo isset($question) ? $question : '' ?></textarea>
		</div>

	</form>
</div>
<script>
	$(document).ready(function () {


	})
	$('#manage-question').on('reset', function () {
		$(this).find('input[name="id"]').val('')
		$('#manage-question').find("[name='criteria_id']").val('').trigger('change')
	})
	$('#manage-question').submit(function (e) {
		e.preventDefault()
		start_load()
		if ($('#question').val() == '') {
			alert_toast("Please fill the question description first", 'error');
			end_load();
			return false;
		}
		$.ajax({
			url: 'ajax.php?action=save_question',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function (resp) {
				if (resp == 1) {
					alert_toast('Data successfully saved', "success");
					setTimeout(function () {
						location.reload()
					}, 1500)
				}
			}
		})
	})

</script>