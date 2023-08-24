<?php $academic_id = isset($_GET['aid']) ? $_GET['aid'] : ''; ?>
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
			<label for="faculty">Select Academic Year</label>
			<div class=" mx-2 col-md-4">
				<select name="" id="academic_id" class="form-control form-control-sm select2">
					<option value=""></option>
					<?php
					$academ = $conn->query("SELECT *, concat(year,' - ',semester) as acad FROM academic_list order by concat(year,' - ',semester) asc");
					$f_arr = array();
					$fname = array();
					while ($row = $academ->fetch_assoc()):
						$f_arr[$row['id']] = $row;
						$fname[$row['id']] = ucwords($row['acad']);
						?>
						<option value="<?php echo $row['id'] ?>" <?php echo isset($academic_id) && $academic_id == $row['id'] ? "selected" : "" ?>><?php echo ucwords($row['acad']) ?></option>
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
					<h3 class="text-center">Course</h3>
					<hr>
					<table width="100%">
						<tr>
							<td width="50%">
								<p><b>Class: <span id="nameField"></span></b></p>
							</td>
							<td width="50%">
								<p><b>Academic Year: <span id="fname"></span></b></p>
							</td>
						</tr>
						<!--<tr>
						<td width="50%"><p><b>Evaluator: <span id="nameField"></span></b></p></td>
					</tr>-->
					</table>
				</div>


				<table class="table table-condensed wborder">
					<thead>
						<tr class="bg-gradient-secondary">
							<!--<th class="text-center">#</th>-->
							<th>Course Code</th>
							<th>Course Description</th>
							<th>Instructor</th>
							<!--<th>Action</th>-->
						</tr>
					</thead>
					<tbody class="tr-sortable">




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
		$('#academic_id').change(function () {
			if ($(this).val() > 0)
				window.history.pushState({}, null, './index.php?page=aacurr&aid=' + $(this).val());
			load_class()
		})
		if ($('#academic_id').val() > 0)
			load_class()
	})
	function load_class() {
		start_load()
		var fname = <?php echo json_encode($fname) ?>;
		$('#fname').text(fname[$('#academic_id').val()])
		$.ajax({
			url: "ajax.php?action=get_class2",
			method: 'POST',
			data: { aid: $('#academic_id').val() },
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
							$('#class-list').append('<a href="javascript:void(0)" data-json=\'' + JSON.stringify(resp[k]) + '\' data-id="' + resp[k].id + '" class="list-group-item list-group-item-action show-result">' + resp[k].class)
						})

					}
				}
			},
			complete: function () {
				end_load()
				anchor_func()
				if ('<?php echo isset($_GET['class_id']) ?>' == 1) {
					$('.show-result[data-id="<?php echo isset($_GET['class_id']) ? $_GET['class_id'] : '' ?>"]').trigger('click')
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
			window.history.pushState({}, null, './index.php?page=aacurr&aid=' + vars.aid + '&cid=' + data.class_id);
			load_report(vars.aid, data.class_id);
			$('#nameField').text(data.class)
			$('.show-result.active').removeClass('active')
			$(this).addClass('active')
		})
	}
	function load_report($academic_id, $class_id) {
		if ($('#preloader2').length <= 0)
			start_load()

		$.ajax({
			url: 'ajax.php?action=get_curri',
			method: "POST",
			data: { academic_id: $academic_id, class_id: $class_id },
			error: function (err) {
				console.log(err)
				alert_toast("An Error Occured.", "error");
				end_load()
			},
			success: function (resp) {
				if (resp) {
					resp = JSON.parse(resp);
					if (Object.keys(resp).length <= 0) {
						$('.tr-sortable').empty(); // Clear the table body
						// Display a message or perform any necessary actions when there is no class information
					} else {
						$('.tr-sortable').empty(); // Clear the table body before populating it again
						resp.forEach(function (infoObj) {
							var row = $('<tr></tr>');
							var codeCell = $('<td></td>').text(infoObj.code);
							var descriptionCell = $('<td></td>').text(infoObj.description);
							var facultyNameCell = $('<td></td>').text(infoObj.firstname + ' ' + infoObj.lastname);

							row.append(codeCell, descriptionCell, facultyNameCell);
							$('.tr-sortable').append(row);
						});
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