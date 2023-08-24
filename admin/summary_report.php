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
		<div class="col-md-12 mb-1">
			<div class="d-flex justify-content-end w-100">
				<button class="btn btn-sm btn-success bg-gradient-success" style="display:none" id="print-btn"><i
						class="fa fa-print"></i> Print</button>
			</div>
		</div>
	</div>

	<div class="content-wrapper" style="min-height: 2123.31px;" id="printable">
		<!-- Main content -->

		<section class="content">

			<div class="container-fluid">

				<!-- /.row -->

				<div class="row">
					<div class="col-md-6">
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title">
									<i class="far fa-chart-bar"></i>
									Bar Chart
								</h3>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="card-body" style="display: block;">
								<div id="bar-chart" style="height: 300px; padding: 0px; position: relative;">
									<canvas class="flot-base" width="347" height="300"
										style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 347px; height: 300px;">
									</canvas>
									<canvas class="flot-overlay" width="347" height="300"
										style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 347px; height: 300px;">
									</canvas>
									<div class="flot-svg"
										style="position: absolute; top: 0px; left: 0px; height: 100%; width: 100%; pointer-events: none;">
										<svg style="width: 100%; height: 100%;">
											<g class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;">
												<text x="127.63494318181819" y="294" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">March</text>
												<text x="237.60640092329544" y="294" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">May</text>
												<text x="17.301180752840907" y="294" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">January</text>
												<text x="286.52303799715907" y="294" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">June</text>
												<text x="183.7400568181818" y="294" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">April</text>
											</g>
											<g class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;">
												<text x="8.9521484375" y="269" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">0</text>
												<text x="8.9521484375" y="205.5" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">5</text>
												<text x="1" y="15" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">20</text>
												<text x="1" y="142" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">10</text>
												<text x="1" y="78.5" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">15</text>
											</g>
										</svg>
									</div>
								</div>
							</div>
							<!-- /.card-body-->
						</div>
						<!-- /.card -->


						<!-- /.card -->

					</div>
					<!-- /.col -->

					<div class="col-md-6">
						<!-- Bar chart -->
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title">
									<i class="far fa-chart-bar"></i>
									Bar Chart
								</h3>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool" data-card-widget="remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="card-body" style="display: block;">
								<div id="bar-chart" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base"
										width="347" height="300"
										style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 347px; height: 300px;"></canvas><canvas
										class="flot-overlay" width="347" height="300"
										style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 347px; height: 300px;"></canvas>
									<div class="flot-svg"
										style="position: absolute; top: 0px; left: 0px; height: 100%; width: 100%; pointer-events: none;">
										<svg style="width: 100%; height: 100%;">
											<g class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><text
													x="127.63494318181819" y="294" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">March</text><text x="237.60640092329544"
													y="294" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">May</text><text x="17.301180752840907" y="294"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">January</text><text x="286.52303799715907"
													y="294" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">June</text><text x="183.7400568181818" y="294"
													class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">April</text>
											</g>
											<g class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><text
													x="8.9521484375" y="269" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">0</text><text x="8.9521484375" y="205.5"
													class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">5</text><text
													x="1" y="15" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">20</text><text x="1" y="142"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">10</text><text x="1" y="78.5"
													class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">15</text></g>
										</svg></div>
								</div>
							</div>
							<!-- /.card-body-->
						</div>
						<!-- /.card -->

						<!-- /.card -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-12">
						<!-- interactive chart -->
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h3 class="card-title">
									<i class="far fa-chart-bar"></i>
									Interactive Area Chart
								</h3>

								<div class="card-tools">
									Real time
									<div class="btn-group" id="realtime" data-toggle="btn-toggle">
										<button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
										<button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div id="interactive" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base"
										width="749" height="300"
										style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 749px; height: 300px;"></canvas><canvas
										class="flot-overlay" width="749" height="300"
										style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 749px; height: 300px;"></canvas>
									<div class="flot-svg"
										style="position: absolute; top: 0px; left: 0px; height: 100%; width: 100%; pointer-events: none;">
										<svg style="width: 100%; height: 100%;">
											<g class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;"><text
													x="28" y="294" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">0</text><text x="95.64008739741162" y="294"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">10</text><text x="167.25624901357324" y="294"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">20</text><text x="238.87241062973484" y="294"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">30</text><text x="310.4885722458965" y="294"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">40</text><text x="382.1047338620581" y="294"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">50</text><text x="453.7208954782197" y="294"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">60</text><text x="525.3370570943814" y="294"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">70</text><text x="596.953218710543" y="294"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: center;">80</text><text x="668.5693803267045" y="294"
													class="flot-tick-label tickLabel" style="position: absolute; text-align: center;">90</text>
											</g>
											<g class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;"><text
													x="8.9521484375" y="269" class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">0</text><text x="1" y="218.2"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">20</text><text x="1" y="167.4"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">40</text><text x="1" y="116.6"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">60</text><text x="1" y="65.8"
													class="flot-tick-label tickLabel"
													style="position: absolute; text-align: right;">80</text><text x="-6.9521484375" y="15"
													class="flot-tick-label tickLabel" style="position: absolute; text-align: right;">100</text>
											</g>
										</svg></div>
								</div>
							</div>
							<!-- /.card-body-->
						</div>
						<!-- /.card -->

					</div>
					<!-- /.col -->
				</div>
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
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
		$('#faculty_id').change(function () {
			if ($(this).val() > 0)
				window.history.pushState({}, null, './index.php?page=summary_report&fid=' + $(this).val());
			$('#print-btn').show()

		})
		if ($('#faculty_id').val() > 0)
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

	var bar_data = {
		data: [[1, 15], [2, 8], [3, 4], [4, 13], [5, 17], [6, 9]],
		bars: { show: true }
	}
	$.plot('#bar-chart', [bar_data], {
		grid: {
			borderWidth: 1,
			borderColor: '#f3f3f3',
			tickColor: '#f3f3f3'
		},
		series: {
			bars: {
				show: true, barWidth: 0.5, align: 'center',
			},
		},
		colors: ['#3c8dbc'],
		xaxis: {
			ticks: [[1, 'January'], [2, 'February'], [3, 'March'], [4, 'April'], [5, 'May'], [6, 'June']]
		}
	})

	function labelFormatter(label, series) {
		return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
			+ label
			+ '<br>'
			+ Math.round(series.percent) + '%</div>'
	}
</script>