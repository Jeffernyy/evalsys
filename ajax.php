<?php
ob_start();
date_default_timezone_set("Asia/Manila");

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if ($action == 'login') {
	$login = $crud->login();
	if ($login)
		echo $login;
}
if ($action == 'login2') {
	$login = $crud->login2();
	if ($login)
		echo $login;
}
if ($action == 'logout') {
	$logout = $crud->logout();
	if ($logout)
		echo $logout;
}
if ($action == 'logout2') {
	$logout = $crud->logout2();
	if ($logout)
		echo $logout;
}

if ($action == 'signup') {
	$save = $crud->signup();
	if ($save)
		echo $save;
}
if ($action == 'save_user') {
	$save = $crud->save_user();
	if ($save)
		echo $save;
}
if ($action == 'update_user') {
	$save = $crud->update_user();
	if ($save)
		echo $save;
}
if ($action == 'delete_user') {
	$save = $crud->delete_user();
	if ($save)
		echo $save;
}
if ($action == 'save_subject') {
	$save = $crud->save_subject();
	if ($save)
		echo $save;
}
if ($action == 'delete_subject') {
	$save = $crud->delete_subject();
	if ($save)
		echo $save;
}
if ($action == 'save_class') {
	$save = $crud->save_class();
	if ($save)
		echo $save;
}
if ($action == 'delete_class') {
	$save = $crud->delete_class();
	if ($save)
		echo $save;
}
if ($action == 'save_academic') {
	$save = $crud->save_academic();
	if ($save)
		echo $save;
}
if ($action == 'delete_academic') {
	$save = $crud->delete_academic();
	if ($save)
		echo $save;
}
if ($action == 'save_curri') {
	$save = $crud->save_curri();
	if ($save)
		echo $save;
}
if ($action == 'save_curriculum') {
	$save = $crud->save_curriculum();
	if ($save)
		echo $save;
}
if ($action == 'delete_curriculum') {
	$save = $crud->delete_curriculum();
	if ($save)
		echo $save;
}
if ($action == 'make_default') {
	$save = $crud->make_default();
	if ($save)
		echo $save;
}
if ($action == 'save_criteria') {
	$save = $crud->save_criteria();
	if ($save)
		echo $save;
}
if ($action == 'delete_criteria') {
	$save = $crud->delete_criteria();
	if ($save)
		echo $save;
}
if ($action == 'save_question') {
	$save = $crud->save_question();
	if ($save)
		echo $save;
}
if ($action == 'delete_question') {
	$save = $crud->delete_question();
	if ($save)
		echo $save;
}

if ($action == 'save_facquestion') {
	$save = $crud->save_facquestion();
	if ($save)
		echo $save;
}
if ($action == 'delete_facquestion') {
	$save = $crud->delete_facquestion();
	if ($save)
		echo $save;
}

if ($action == 'save_visquestion') {
	$save = $crud->save_visquestion();
	if ($save)
		echo $save;
}
if ($action == 'delete_visquestion') {
	$save = $crud->delete_visquestion();
	if ($save)
		echo $save;
}


if ($action == 'save_criteria_question') {
	$save = $crud->save_criteria_question();
	if ($save)
		echo $save;
}
if ($action == 'save_criteria_order') {
	$save = $crud->save_criteria_order();
	if ($save)
		echo $save;
}

if ($action == 'save_question_order') {
	$save = $crud->save_question_order();
	if ($save)
		echo $save;
}

if ($action == 'save_facquestion_order') {
	$save = $crud->save_facquestion_order();
	if ($save)
		echo $save;
}

if ($action == 'save_visquestion_order') {
	$save = $crud->save_visquestion_order();
	if ($save)
		echo $save;
}

if ($action == 'save_human_resources') {
	$save = $crud->save_human_resources();
	if ($save)
		echo $save;
}

if ($action == 'delete_human_resources') {
	$save = $crud->delete_human_resources();
	if ($save)
		echo $save;
}

if ($action == 'save_faculty') {
	$save = $crud->save_faculty();
	if ($save)
		echo $save;
}
if ($action == 'delete_faculty') {
	$save = $crud->delete_faculty();
	if ($save)
		echo $save;
}
if ($action == 'save_student') {
	$save = $crud->save_student();
	if ($save)
		echo $save;
}
if ($action == 'delete_student') {
	$save = $crud->delete_student();
	if ($save)
		echo $save;
}
if ($action == 'save_supervisor') {
	$save = $crud->save_supervisor();
	if ($save)
		echo $save;
}
if ($action == 'delete_supervisor') {
	$save = $crud->delete_supervisor();
	if ($save)
		echo $save;
}
if ($action == 'save_restriction') {
	$save = $crud->save_restriction();
	if ($save)
		echo $save;
}
if ($action == 'save_evaluation') {
	$save = $crud->save_evaluation();
	if ($save)
		echo $save;
}

if ($action == 'save_fac_eval') {
	$save = $crud->save_fac_eval();
	if ($save)
		echo $save;
}

if ($action == 'save_fac_self_eval') {
	$save = $crud->save_fac_self_eval();
	if ($save)
		echo $save;
}

if ($action == 'save_visor_eval') {
	$save = $crud->save_visor_eval();
	if ($save)
		echo $save;
}

if ($action == 'save_group') {
	$save = $crud->save_group();
	if ($save)
		echo $save;
}
if ($action == 'save_peers') {
	$save = $crud->save_peers();
	if ($save)
		echo $save;
}
if ($action == 'delete_peers') {
	$save = $crud->delete_peers();
	if ($save)
		echo $save;
}

if ($action == 'get_class2') {
	$get = $crud->get_class2();
	if ($get)
		echo $get;
}
if ($action == 'get_class') {
	$get = $crud->get_class();
	if ($get)
		echo $get;
}
if ($action == 'get_report') {
	$get = $crud->get_report();
	if ($get)
		echo $get;
}

if ($action == 'get_studclass') {
	$get = $crud->get_studclass();
	if ($get)
		echo $get;
}
if ($action == 'get_studreport') {
	$get = $crud->get_studreport();
	if ($get)
		echo $get;
}
if ($action == 'get_human_resources') {
	$get = $crud->get_human_resources();
	if ($get)
		echo $get;
}
if ($action == 'get_visor') {
	$get = $crud->get_visor();
	if ($get)
		echo $get;
}
if ($action == 'get_visor_report') {
	$get = $crud->get_visor_report();
	if ($get)
		echo $get;
}

if ($action == 'get_peers') {
	$get = $crud->get_peers();
	if ($get)
		echo $get;
}
if ($action == 'get_peer_report') {
	$get = $crud->get_peer_report();
	if ($get)
		echo $get;
}

if ($action == 'get_group') {
	$get = $crud->get_group();
	if ($get)
		echo $get;
}
if ($action == 'get_group_report') {
	$get = $crud->get_group_report();
	if ($get)
		echo $get;
}

if ($action == 'get_faceval') {
	$get = $crud->get_faceval();
	if ($get)
		echo $get;
}
if ($action == 'get_faceval_report') {
	$get = $crud->get_faceval_report();
	if ($get)
		echo $get;
}

ob_end_flush();
?>