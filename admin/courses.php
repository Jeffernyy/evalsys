<?php $class_id = isset($_GET['class_id']) ? $_GET['class_id'] : ''; ?>
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
			<label for="faculty">Select Class</label>
			<div class=" mx-2 col-md-4">
				<select name="class_id" id="class_id" class="form-control form-control-sm select2"
					value="<?php echo isset($class_id) ? $class_id : '' ?>">
					<option value=""></option>
					<?php
					$classes = $conn->query("SELECT class_id,concat(program,' ',year,' - ',section) as class FROM class_l");
					while ($row = $classes->fetch_assoc()):
						?>
						<option value="<?php echo $row['class_id'] ?>" <?php echo isset($class_id) && $class_id == $row['class_id'] ? "selected" : "" ?>><?php echo $row['class'] ?></option>
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
					<!--<h3 class="text-center">Evaluation Report</h3>-->
					<hr>
					<table width="100%">
						<table class="table table-condensed wborder">
							<thead>
								<tr class="bg-gradient-secondary">
									<th class="text-center">#</th>
									<th>Course Code</th>
									<th>Course Description</th>
									<th>Instructor</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="tr-sortable">
								<?php
								$i = 1;

								$qry = $conn->query("SELECT * FROM curr_list JOIN subject_list on curr_list.subject_id=subject_list.id
							JOIN faculty_list on curr_list.faculty_id=faculty_list.id where class_id = '$class_id'"); //where class_id = $class_id and semester = $semester
								while ($row = $qry->fetch_assoc()):
									$q_arr[$row['id']] = $row;
									?>
									<tr>
										<th class="text-center">
											<?php echo $i++ ?>
										</th>
										<td><b>
												<?php echo $row['code'] ?>
											</b></td>
										<td><b>
												<?php echo $row['description'] ?>
											</b></td>
										<td><b>
												<?php echo ucwords($row['firstname']) ?>&nbsp;
												<?php echo ucwords($row['lastname']) ?>
											</b></td>
										<td class="text-center">
											<button type="button"
												class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle"
												data-toggle="dropdown" aria-expanded="true">
												Action
											</button>
											<div class="dropdown-menu" style="">
												<a class="dropdown-item manage_curriculum" href="">Edit</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item delete_curriculum" href="javascript:void(0)"
													data-id="<?php echo $row['id'] ?>">Delete</a>
											</div>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
	<style>
		.list-group-item:hover {
			color: black !important;
			font-weight: 700 !important;
		}
	</style>
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
		$(document).ready(function () {
			$('#class_id').change(function () {
				if ($(this).val() > 0)
					window.history.pushState({}, null, './index.php?page=courses&class_id=' + $(this).val());
				load_class()
			})
			if ($('#class_id').val() > 0)
				load_class()
		})
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
						}

					}
				},
				complete: function () {
					end_load()
				}
			})
		}
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