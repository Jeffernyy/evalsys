<?php
function ordinal_suffix($num)
{
	$num = $num % 100; // protect against large numbers
	if ($num < 11 || $num > 13) {
		switch ($num % 10) {
			case 1:
				return $num . 'st';
			case 2:
				return $num . 'nd';
			case 3:
				return $num . 'rd';
		}
	}
	return $num . 'th';
}
$faculty_id = '';
if (isset($_GET['fid']))
	$faculty_id = $_GET['fid'];
$curriculum = $conn->query("SELECT f.id as fid, concat(f.firstname,' ',f.lastname) as faculty FROM faculty_list f where f.id = {$_SESSION['login_id']} and f.id not in (SELECT faculty_id from fac_self_eval where academic_id ={$_SESSION['academic']['id']} and faculty_id = {$_SESSION['login_id']} )"); //and f.id not in (SELECT * from fac_self_eval where  faculty_id = {$_SESSION['login_id']} ) 

?>

<div class="col-lg-12">
	<div class="row">
		<div class="col-md-3">
			<div class="list-group">
				<?php
				while ($row = $curriculum->fetch_array()):
					if (empty($faculty_id)) {
						$faculty_id = $row['fid'];
					}
					?>
					<a class="list-group-item list-group-item-action <?php echo isset($faculty_id) && $faculty_id == $row['fid'] ? 'active' : '' ?>"
						href="./index.php?page=evaluate&fid=<?php echo $row['fid'] ?>&fid=<?php echo $row['fid'] ?>"><?php echo ucwords($row['faculty']) ?></a>
				<?php endwhile; ?>
			</div>
		</div>
		<div class="col-md-9">
			<div class="card card-outline card-info">
				<div class="card-header">
					<b>Evaluation Questionnaire for Academic:
						<?php echo $_SESSION['academic']['year'] . ' ' . (ordinal_suffix($_SESSION['academic']['semester'])) ?>
					</b>
					<div class="card-tools">
						<button class="btn btn-sm btn-flat btn-primary bg-gradient-primary mx-1" form="manage-evaluation">Submit
							Evaluation</button>
					</div>
				</div>
				<div class="card-body">
					<fieldset class="border border-info p-2 w-100">
						<legend class="w-auto">Rating Legend</legend>
						<p>5 = Strongly Agree, 4 = Agree, 3 = Uncertain, 2 = Disagree, 1 = Strongly Disagree</p>
					</fieldset>
					<form id="manage-evaluation">
						<input type="hidden" name="faculty_id" value="<?php echo $_SESSION['login_id'] ?>">
						<input type="hidden" name="academic_id" value="<?php echo $_SESSION['academic']['id'] ?>">
						<div class="clear-fix mt-2"></div>
						<?php
						$q_arr = array();
						$criteria = $conn->query("SELECT * FROM criteria_list where id in (SELECT criteria_id FROM faculty_que where academic_id = {$_SESSION['academic']['id']} ) order by abs(order_by) asc ");
						while ($crow = $criteria->fetch_assoc()):
							?>
							<table class="table table-condensed">
								<thead>
									<tr class="bg-gradient-secondary">
										<th class=" p-1"><b>
												<?php echo $crow['criteria'] ?>
											</b></th>
										<th class="text-center">1</th>
										<th class="text-center">2</th>
										<th class="text-center">3</th>
										<th class="text-center">4</th>
										<th class="text-center">5</th>
									</tr>
								</thead>
								<tbody class="tr-sortable">
									<?php
									$questions = $conn->query("SELECT * FROM faculty_que where criteria_id = {$crow['id']} and academic_id = {$_SESSION['academic']['id']} order by abs(order_by) asc ");
									while ($row = $questions->fetch_assoc()):
										$q_arr[$row['id']] = $row;
										?>
										<tr class="bg-white">
											<td class="p-1" width="40%">
												<?php echo $row['question'] ?>
												<input type="hidden" name="qid[]" value="<?php echo $row['id'] ?>">
											</td>
											<?php for ($c = 1; $c <= 5; $c++): ?>
												<td class="text-center">
													<div class="icheck-success d-inline">
														<input type="radio" name="rate[<?php echo $row['id'] ?>]" <?php echo $c == 5 ? "checked" : '' ?>
															id="qradio<?php echo $row['id'] . '_' . $c ?>" value="<?php echo $c ?>">
														<label for="qradio<?php echo $row['id'] . '_' . $c ?>">
														</label>
													</div>
												</td>
											<?php endfor; ?>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						<?php endwhile; ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		if ('<?php echo $_SESSION['academic']['status'] ?>' == 0) {
			uni_modal("Information", "<?php echo $_SESSION['login_view_folder'] ?>not_started.php")
		} else if ('<?php echo $_SESSION['academic']['status'] ?>' == 2) {
			uni_modal("Information", "<?php echo $_SESSION['login_view_folder'] ?>closed.php")
		}
		else if ('<?php echo $_SESSION['academic']['status'] ?>' == 2) {
			uni_modal("Information", "<?php echo $_SESSION['login_view_folder'] ?>closed.php")
		}
		if (<?php echo empty($faculty_id) ? 1 : 0 ?> == 1)
			uni_modal("Information", "<?php echo $_SESSION['login_view_folder'] ?>done.php")

	})
	$('#manage-evaluation').submit(function (e) {
		e.preventDefault();
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_fac_self_eval',
			method: 'POST',
			data: $(this).serialize(),
			success: function (resp) {
				if (resp == 1) {
					alert_toast("Data successfully saved.", "success");
					setTimeout(function () {
						location.reload()
					}, 1750)
				}
			}
		})
	})
</script>