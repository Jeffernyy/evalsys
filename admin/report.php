<?php $faculty_id = isset($_GET['fid']) ? $_GET['fid'] : ''; ?>
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
?>
<div class="col-lg-12">
	<div class="callout callout-info">
		<div class="d-flex w-100 justify-content-center align-items-center">
			<label for="faculty">Select Faculty</label>
			<div class=" mx-2 col-md-4">
				<select name="" id="faculty_id" class="form-control form-control-sm select2">
					<option value=""></option>
					<?php
					$faculty = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM faculty_list order by concat(firstname,' ',lastname) asc");
					$f_arr = array();
					$fname = array();
					while ($row = $faculty->fetch_assoc()):
						$f_arr[$row['id']] = $row;
						$fname[$row['id']] = ucwords($row['name']);
						?>
						<option value="<?php echo $row['id'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['id'] ? "selected" : "" ?>><?php echo ucwords($row['name']) ?></option>
					<?php endwhile; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 mb-1">
			<div class="d-flex justify-content-end w-100">
				<button class="btn btn-sm btn-success bg-gradient-success" style="display:none" id="print-btn"><i
						class="fa fa-print"></i> Print</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="callout callout-info">
				<div class="list-group" id="class-list">
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="callout callout-info" id="printable">
				<div>
					<h3 class="text-center">Evaluation Report</h3>
					<hr>
					<table width="100%">
						<tr>
							<td width="50%">
								<p><b>Faculty: <span id="fname"></span></b></p>
							</td>
							<td width="50%">
								<p><b>Academic Year: <span id="ay">
											<?php echo $_SESSION['academic']['year'] . ' ' . (ordinal_suffix($_SESSION['academic']['semester'])) ?>
											Semester
										</span></b></p>
							</td>
						</tr>
						<tr>
							<td width="50%">
								<p><b>Class: <span id="classField"></span></b></p>
							</td>
							<td width="50%">
								<p><b>Subject: <span id="subjectField"></span></b></p>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<p><b>Total Average: <span id="overallAverage"></span></b></p>
							</td>
						</tr>
					</table>
					<p class=""><b>Total Student Respondent: <span id="tse"></span></b></p>
				</div>
				<fieldset class="border border-info p-2 w-100">
					<legend class="w-auto">Rating Legend</legend>
					<p>5 = Most Frequently, 4 = Frequently, 3 = Sometimes, 2 = Seldom, 1 = Rarely</p>
				</fieldset>
				<?php
				$q_arr = array();
				$criteria = $conn->query("SELECT * FROM criteria_list where id in (SELECT criteria_id FROM question_list where academic_id = {$_SESSION['academic']['id']} ) order by abs(order_by) asc ");
				while ($crow = $criteria->fetch_assoc()):
					?>
					<table class="table table-condensed wborder">
						<thead>
							<tr class="bg-gradient-secondary">
								<th class=" p-1"><b>
										<?php echo $crow['criteria'] ?>
									</b></th>
								<th width="5%" class="text-center">1</th>
								<th width="5%" class="text-center">2</th>
								<th width="5%" class="text-center">3</th>
								<th width="5%" class="text-center">4</th>
								<th width="5%" class="text-center">5</th>
							</tr>
						</thead>
						<tbody class="tr-sortable">
							<?php
							$questions = $conn->query("SELECT * FROM question_list where criteria_id = {$crow['id']} and academic_id = {$_SESSION['academic']['id']} order by abs(order_by) asc ");
							while ($row = $questions->fetch_assoc()):
								$q_arr[$row['id']] = $row;
								?>
								<tr class="bg-white">
									<td class="p-1" width="40%">
										<?php echo $row['question'] ?>
									</td>
									<?php for ($c = 1; $c <= 5; $c++): ?>
										<td class="text-center">
											<span class="rate_<?php echo $c . '_' . $row['id'] ?> rates"></span>
										</td>
									<?php endfor; ?>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				<?php endwhile; ?>
				<div class="card-footer card-comments" style="display: block;">
					<div style="border: 1px solid black;">
						<h5 class="bg-gradient-secondary"><b>Comments</b></h5>
						<div class="card-comment">
							<div class="comment-text" style="color:black;">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- style -->
<style>
	.list-group-item:hover {
		color: black !important;
		font-weight: 700 !important;
	}
</style>

<!-- noscript -->
<noscript>
	<style>
		table {
			width: 100%;
			border-collapse: collapse;
		}

		table.wborder tr,
		table.wborder td,
		table.wborder th {
			border: 1px solid gray;
			padding: 3px
		}

		table.wborder thead tr {
			background: #6c757d linear-gradient(180deg, #828a91, #6c757d) repeat-x !important;
			color: #fff;
		}

		.text-center {
			text-align: center;
		}

		.text-right {
			text-align: right;
		}

		.text-left {
			text-align: left;
		}
	</style>
</noscript>

<script>
	/* document ready function */
	$(document).ready(function () {
		$('#faculty_id').change(function () {
			if ($(this).val() > 0)
				window.history.pushState({}, null, './index.php?page=report&fid=' + $(this).val());
			load_class()
		})
		if ($('#faculty_id').val() > 0)
			load_class()
	})

	/* load class function */
	function load_class() {
		start_load()
		var fname = <?php echo json_encode($fname) ?>;
		$('#fname').text(fname[$('#faculty_id').val()])
		$.ajax({
			url: "ajax.php?action=get_class",
			method: 'POST',
			data: { fid: $('#faculty_id').val() },
			error: function (err) {
				console.log(err)
				alert_toast("An error occured", 'error')
				end_load()
			},
			success: function (resp) {
				if (resp) {
					resp = JSON.parse(resp)
					if (Object.keys(resp).length <= 0) {
						$('#class-list').html('<a href="javascript:void(0)" class="list-group-item list-group-item-action disabled">No data to be display.</a>')
					} else {
						$('#class-list').html('')
						Object.keys(resp).map(k => {
							$('#class-list').append('<a href="javascript:void(0)" data-json=\'' + JSON.stringify(resp[k]) + '\' data-id="' + resp[k].id + '" class="list-group-item list-group-item-action show-result">' + resp[k].class + ' - ' + resp[k].subj + '</a>')
						})
					}
				}
			},
			complete: function () {
				end_load()
				anchor_func()
				if ('<?php echo isset($_GET['cid']) ?>' == 1) {
					$('.show-result[data-id="<?php echo isset($_GET['cid']) ? $_GET['cid'] : '' ?>"]').trigger('click')
				} else {
					$('.show-result').first().trigger('click')
				}
			}
		})
	}

	/* anchor function */
	function anchor_func() {
		$('.show-result').click(function () {
			var vars = [], hash;
			var data = $(this).attr('data-json')
			data = JSON.parse(data)
			var _href = location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for (var i = 0; i < _href.length; i++) {
				hash = _href[i].split('=');
				vars[hash[0]] = hash[1];
			}
			window.history.pushState({}, null, './index.php?page=report&fid=' + vars.fid + '&cid=' + data.class_id);
			load_report(vars.fid, data.sid, data.class_id);
			$('#subjectField').text(data.subj)
			$('#classField').text(data.class)
			$('.show-result.active').removeClass('active')
			$(this).addClass('active')
		})
	}

	/* calculate overall average function */
	function calculateOverallAverage() {
		var total = 0;
		var count = 0;
		$('.tr-sortable').each(function () {
			$(this).find('.rates').each(function () {
				var rate = parseInt($(this).text());
				if (!isNaN(rate)) {
					total += rate;
					count++;
				}
			});
		});
		var overallAverage = count > 0 ? total / count : 0;
		var displayAverage = overallAverage.toFixed(1);
		// Remove decimal if it's '.0'
		if (displayAverage.endsWith('.0')) {
			displayAverage = displayAverage.slice(0, -2);
		}
		// Append '%' symbol
		displayAverage += '%';
		$('#overallAverage').text(displayAverage);
	}

	/* load report function */
	function load_report($faculty_id, $subject_id, $class_id) {
		if ($('#preloader2').length <= 0)
			start_load()
		$.ajax({
			url: 'ajax.php?action=get_report',
			method: "POST",
			data: { faculty_id: $faculty_id, subject_id: $subject_id, class_id: $class_id },
			error: function (err) {
				console.log(err)
				alert_toast("An Error Occured.", "error");
				end_load()
			},
			success: function (resp) {
				if (resp) {
					resp = JSON.parse(resp)
					if (Object.keys(resp).length <= 0) {
						$('.rates').text('')
						$('#tse').text('')
						$('#print-btn').hide()
					} else {
						$('#print-btn').show()
						$('#tse').text(resp.tse)
						$('.rates').text('-')
						var data = resp.data
						Object.keys(data).map(q => {
							Object.keys(data[q]).map(r => {
								console.log($('.rate_' + r + '_' + q), data[q][r])
								$('.rate_' + r + '_' + q).text(data[q][r] + '%')
							})
						})
						calculateOverallAverage();
						var comments = resp.comments;
						var commentHtml = '';
						comments.forEach(comment => {
							commentHtml += '<div class="card-comment">';
							commentHtml += '<div class="comment-text">';
							commentHtml += comment;
							commentHtml += '</div>';
							commentHtml += '</div>';
						});
						$('.comment-text').html(commentHtml);
					}
				}
			},
			complete: function () {
				end_load()
			}
		})
	}

	/* print function */
	$('#print-btn').click(function () {
		start_load()
		var ns = $('noscript').clone()
		var content = $('#printable').html()
		ns.append(content)
		var nw = window.open("Report", "_blank", "width=900,height=700")
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(function () {
			nw.close()
			end_load()
		}, 750)
	})
</script>