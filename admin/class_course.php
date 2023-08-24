<?php include 'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_assign" href="javascript:void(0)"><i
						class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
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
						<th>Course</th>
						<th>Class</th>
						<th>Instructor</th>
						<th>Academic Year</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$i = 1;
					$qry = $conn->query("SELECT *,curr_list.id as crid, concat(faculty_list.firstname,' ',faculty_list.lastname) as name, concat(subject_list.code,': ',subject_list.subject) as sub, concat(academic_list.year,' - ',academic_list.semester) as acady, concat(class_l.program,' ',class_l.year,'-',class_l.section) as sect FROM curr_list JOIN subject_list on curr_list.subject_id=subject_list.id
          JOIN faculty_list on curr_list.faculty_id=faculty_list.id JOIN academic_list on curr_list.academic_id=academic_list.id JOIN class_l on curr_list.class_id=class_l.class_id order by academic_id desc");
					while ($row = $qry->fetch_assoc()):
						?>
						<tr>
							<th class="text-center">
								<?php echo $i++ ?>
							</th>
							<td><b>
									<?php echo ucwords($row['sub']) ?>
								</b></td>
							<td><b>
									<?php echo ucwords($row['sect']) ?>
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