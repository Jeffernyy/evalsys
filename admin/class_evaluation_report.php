<?php include 'db_connect.php' ?>
<?php $faculty_id = isset($_GET['fid']) ? $_GET['fid'] : ''; ?>
<?php $academic_id = isset($_GET['aid']) ? $_GET['aid'] : ''; ?>
<?php

function getAverageRate($faculty_id, $academic_id)
{

	global $conn;
	$query = "SELECT AVG(rate) AS average FROM evaluation_answers a join evaluation_list l on a.evaluation_id = l.evaluation_id WHERE faculty_id = '$faculty_id' AND academic_id = '$academic_id'";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row['average'];
	} else {
		return 'N/A';
	}
}

?>


<div class="col-lg-12">
	<div class="callout callout-info">
		<div class="d-flex w-100 justify-content-center align-items-center">
			<label for="faculty">Select Academic Year & Semester</label>
			<div class=" mx-2 col-md-4">
				<select name="" id="faculty_id" class="form-control form-control-sm select2">
					<option value=""></option>
					<?php
					$acady = $conn->query("SELECT *,academic_list.id as aid, concat(year,' - ',semester) as acad FROM academic_list order by concat(year,' - ',semester) asc");
					$f_arr = array();
					$fname = array();
					while ($row = $acady->fetch_assoc()):
						$f_arr[$row['id']] = $row;
						$fname[$row['id']] = ucwords($row['acad']);
						?>
						<option value="<?php echo $row['aid'] ?>" <?php echo isset($academic_id) && $academic_id == $row['aid'] ? "selected" : "" ?>><?php echo ucwords($row['acad']) ?></option>
					<?php endwhile; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="card card-outline card-primary">
		<div class="card-body table-responsive">
			<table class="table table-head-fixed table-bordered" id="list"> <!-- tabe-hover table-bordered -->
				<colgroup>
					<col width="5%">
					<col width="35%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Faculty</th>
						<th>Average</th>
						<th>Class</th>
						<th>Respondent</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$i = 1;
					$qry = $conn->query("SELECT *, concat(firstname,' ',lastname) as name FROM evaluation_list e join faculty_list f on e.faculty_id = f.id");
					while ($row = $qry->fetch_assoc()):
						?>
						<tr>
							<th class="text-center">
								<?php echo $i++ ?>
							</th>
							<td><b>
									<?php echo ucwords($row['name']) ?>
								</b></td>
							<td><b>
									<?php echo $averageRate ?>
								</b></td>
							<td><b>
									<?php echo ucwords($row['name']) ?>
								</b></td>
							<td><b>
									<?php echo ucwords($row['acady']) ?>
								</b></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="javascript:void(0)" data-id='<?php echo $row['crid'] ?>'
										class="btn btn-primary btn-flat manage_course">
										<i class="fas fa-edit"></i>
									</a>
									<button type="button" class="btn btn-danger btn-flat delete_curriculum"
										data-id="<?php echo $row['crid'] ?>">
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
		$('.new_assign').click(function () {
			uni_modal("Assign Course", "<?php echo $_SESSION['login_view_folder'] ?>manage_course.php")
		})
		$('.manage_course').click(function () {
			uni_modal("Assign on Course", "<?php echo $_SESSION['login_view_folder'] ?>manage_course.php?id=" + $(this).attr('data-id'))
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