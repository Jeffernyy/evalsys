<?php include 'db_connect.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      border-width: 7px 6px 0 6px;
      margin-left: -7.795px;
    }

    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
      border-width: 0 6px 7px 6px;
    }

    .select2-search--dropdown {
      padding: 10px 10px 0px;
    }

    .select2-results__options::-webkit-scrollbar,
    .select2-results__options::-webkit-scrollbar-track {
      width: 10px;
    }

    .select2-results__options::-webkit-scrollbar-thumb {
      border-radius: 10px;
      background-color: #d9d4d4;
    }
  </style>
</head>

<body>
  <div class="col-lg-12">
    <div class="card card-outline card-success">
      <style>
        th,
        tr,
        td,
        thead,
        tbody {
          border: 3px double #999 !important;
        }

        .form-control {
          display: block;
          width: 100%;
          height: calc(2.25rem + 2px);
          padding: 0;
          font-size: 1rem;
          font-weight: 400;
          line-height: 1.5;
          color: #495057;
          background-color: #fff;
          background-clip: padding-box;
          border-width: 1px;
          border-top: 0px;
          border-left: 0px;
          border-right: 0px;
          border-radius: unset;
          box-shadow: inset 0 0 0 transparent;
          transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .cstm-form-control:focus {
          padding: 18px 0 0 !important;
        }

        .select2-selection__rendered {
          color: #a1a1a1 !important;
        }

        .select2 .select2-selection--single {
          border-radius: unset !important;
          border-top: 0px !important;
          border-left: 0px !important;
          border-right: 0px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
          border-width: 7px 6px 0 6px;
          margin-left: -7.795px;
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
          border-width: 0 6px 7px 6px;
        }

        .select2-search--dropdown {
          padding: 10px 10px 0px;
        }

        .select2-results__options::-webkit-scrollbar,
        .select2-results__options::-webkit-scrollbar-track {
          width: 10px;
        }

        .select2-results__options::-webkit-scrollbar-thumb {
          border-radius: 10px;
          background-color: #d9d4d4;
        }

        .select2-container--default .select2-dropdown .select2-search__field,
        .select2-container--default .select2-search--inline .select2-search__field,
        .select2-container--default .select2-results__option[aria-disabled=true] {
          display: none;
        }
      </style>
      <div class="card-body">
        <form method="post" enctype="multipart/form-data" novalidate class="needs-validation">
          <!-- first table -->
          <table class="table table-bordered" style="border-radius: 20px;">
            <thead>
              <tr style="background: #87CEEB;">
                <th scope="col" colspan="6">PERSONAL INFORMATION</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['formSubmit'])) {
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                $middlename = $_POST['middlename'];
                $date_of_birth = $_POST['date_of_birth'];
                $place_of_birth = $_POST['place_of_birth'];
                $address = $_POST['address'];
                $email_address = $_POST['email_address'];
                $contact_number = $_POST['contact_number'];
                $religion = $_POST['religion'];
                $citizenship = $_POST['citizenship'];
                $height = $_POST['height'];
                $weight = $_POST['weight'];
                $gender = $_POST['gender'];
                $civil_status = $_POST['civil_status'];
                $pag_ibig_number = $_POST['pag_ibig_number'];
                $philhealth_number = $_POST['philhealth_number'];
                $sss_number = $_POST['sss_number'];
                $tin_number = $_POST['tin_number'];
                $mother_name = $_POST['mother_name'];
                $father_name = $_POST['father_name'];
                $spouse_name = $_POST['spouse_name'];
                $spouse_occupation = $_POST['spouse_occupation'];
                $name_of_child_1 = $_POST['name_of_child_1'];
                $name_of_child_2 = $_POST['name_of_child_2'];
                $name_of_child_3 = $_POST['name_of_child_3'];
                $name_of_child_4 = $_POST['name_of_child_4'];
                if (isset($_FILES['profile'])) {
                  $profile = $_FILES['profile'];
                  $profile_name = $profile['name'];
                  $profile_error = $profile['error'];
                  $profile_temp = $profile['tmp_name'];
                  $filename_separator = explode('.', $profile_name);
                  $profile_extension = strtolower(end($filename_separator));
                  $allowed_extensions = array('jpeg', 'jpg', 'png');
                  $blood_type = '';
                  if (isset($_POST['blood_type'][0])) {
                    $blood_type = $_POST['blood_type'][0];
                  }
                  if (in_array($profile_extension, $allowed_extensions) && $profile_error === 0) {
                    $hashed_filename = md5($profile_name . time()) . '.' . $profile_extension;
                    $profile_upload = './faculty/profiling/' . $hashed_filename;
                    move_uploaded_file($profile_temp, $profile_upload);
                    $sql = "INSERT INTO `pds_personal_information` (lastname, firstname, middlename, profile, date_of_birth, place_of_birth, address, email_address, contact_number, religion, citizenship, height, weight, blood_type, gender, civil_status, pag_ibig_number, philhealth_number, sss_number, tin_number, mother_name, father_name, spouse_name, spouse_occupation, name_of_child_1, name_of_child_2, name_of_child_3, name_of_child_4) VALUES ('$lastname', '$firstname', '$middlename', '$hashed_filename', '$date_of_birth', '$place_of_birth', '$address', '$email_address', '$contact_number', '$religion', '$citizenship', '$height', '$weight', '$blood_type', '$gender', '$civil_status', '$pag_ibig_number', '$philhealth_number', '$sss_number', '$tin_number', '$mother_name', '$father_name', '$spouse_name', '$spouse_occupation', '$name_of_child_1', '$name_of_child_2', '$name_of_child_3', '$name_of_child_4')";
                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                      echo '
                        <script>
                          swal({
                            title: "Good Job!",
                            text: "Data inserted successfully",
                            icon: "success",
                            buttons: ["Close", "Okay"]
                          }).then(() => {
                            window.location.href = "index.php?page=manage_employee_filing";
                          })
                        </script> ';
                    } else {
                      echo "Error: " . mysqli_connect_error();
                    }
                  }
                }
              }
              ?>
              <tr>
                <td style="padding: 10px 10px 0;"><small>LAST NAME</small>
                  <div class="form-group">
                    <input type="text" name="lastname" placeholder="Enter your last name" autofocus required
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>FIRST NAME</small>
                  <div class="form-group">
                    <input type="text" name="firstname" placeholder="Enter your first name" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>MIDDLE NAME</small>
                  <div class="form-group">
                    <input type="text" name="middlename" placeholder="Enter your middle name" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td rowspan="4" class="m-0" width="305" style="padding: 160px 10px 0;">
                  <div class="custom-file d-flex align-items-center justify-content-center pb-2"
                    style="width: 100%; height: 100%;">
                    <input type="file" name="profile" class="custom-file-input" id="inputGroupFile"
                      aria-describedby="inputGroupFile">
                    <label class="custom-file-label text-uppercase" for="inputGroupFile"
                      style="color: #a1a1a1 !important;">Choose file</label>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding: 10px 10px 0;"><small>DATE OF BIRTH &nbsp;(MM/DD/YYYY)</small>
                  <div class="form-group">
                    <input type="text" name="date_of_birth" placeholder="Enter your date of birth" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="4"><small>PLACE OF BIRTH</small>
                  <div class="form-group">
                    <input type="text" name="place_of_birth" placeholder="Enter your place of birth"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding: 10px 10px 0;" colspan="5"><small>ADDRESS</small>
                  <div class="form-group">
                    <input type="text" name="address" placeholder="Enter your full address" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding: 10px 10px 0;"><small>EMAIL ADDRESS</small>
                  <div class="form-group">
                    <input type="text" name="email_address" placeholder="Enter your valid email" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>CONTACT NUMBER/S</small>
                  <div class="form-group">
                    <input type="text" name="contact_number" placeholder="Enter your contact number"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>RELIGION</small>
                  <div class="form-group">
                    <input type="text" name="religion" placeholder="Enter your religion" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding: 10px 10px 0;"><small>CITIZENSHIP</small>
                  <div class="form-group">
                    <input type="text" name="citizenship" placeholder="Enter your citizenship" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" width="175"><small>HEIGHT &nbsp;(CENTIMETER)</small>
                  <div class="form-group">
                    <input type="text" name="height" placeholder="" id="inputMiddleName"
                      class="form-control text-lowercase">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" width="175"><small>WEIGHT &nbsp;(KILOGRAM)</small>
                  <div class="form-group">
                    <input type="text" name="weight" placeholder="" id="inputMiddleName"
                      class="form-control text-lowercase">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" width="175">
                  <small>BLOOD TYPE</small>
                  <div class="form-group">
                    <select class="custom-select browser-default select2" name="blood_type[]" id="employee-select">
                      <option hidden disabled selected>SELECT TYPE</option>
                      <option>A+</option>
                      <option>O+</option>
                      <option>B+</option>
                      <option>AB+</option>
                      <option>A-</option>
                      <option>O-</option>
                      <option>B-</option>
                      <option>AB-</option>
                    </select>
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" width="175"><small>GENDER</small>
                  <div class="form-group">
                    <input type="text" name="gender" placeholder="" id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;"><small>CIVIL STATUS</small>
                  <div class="form-group">
                    <input type="text" name="civil_status" placeholder="Enter your civil status" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding: 10px 10px 0;"><small>PAG-IBIG NO.</small>
                  <div class="form-group">
                    <input type="text" name="pag_ibig_number" placeholder="Enter your pag-ibig number"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>PHILHEALTH NO.</small>
                  <div class="form-group">
                    <input type="text" name="philhealth_number" placeholder="Enter your philhealth number"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>SSS NO.</small>
                  <div class="form-group">
                    <input type="text" name="sss_number" placeholder="Enter your sss number" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>TIN NO.</small>
                  <div class="form-group">
                    <input type="text" name="tin_number" placeholder="Enter your tin number" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding: 10px 10px 0;"><small>MOTHER'S NAME</small>
                  <div class="form-group">
                    <input type="text" name="mother_name" placeholder="Enter your mother's name" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>FATHER'S NAME</small>
                  <div class="form-group">
                    <input type="text" name="father_name" placeholder="Enter your father's name" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>SPOUSE'S NAME &nbsp;(IF MARRIED)</small>
                  <div class="form-group">
                    <input type="text" name="spouse_name" placeholder="Enter your spouse's name" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>SPOUSE'S OCCUPATION</small>
                  <div class="form-group">
                    <input type="text" name="spouse_occupation" placeholder="Enter your spouse's occupation"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding: 10px 10px 0;"><small>NAME OF CHILD / BIRTHDATE</small>
                  <div class="form-group">
                    <input type="text" name="name_of_child_1" placeholder="Enter your child name & birthdate"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>NAME OF CHILD / BIRTHDATE</small>
                  <div class="form-group">
                    <input type="text" name="name_of_child_2" placeholder="Enter your child name & birthdate"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2"><small>NAME OF CHILD / BIRTHDATE</small>
                  <div class="form-group">
                    <input type="text" name="name_of_child_3" placeholder="Enter your child name & birthdate"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" colspan="2" width="192"><small>NAME OF CHILD / BIRTHDATE</small>
                  <div class="form-group">
                    <input type="text" name="name_of_child_4" placeholder="Enter your child name & birthdate"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- second table -->
          <table class="table table-bordered mt-5">
            <thead>
              <tr style="background: #87CEEB;">
                <th colspan="6">EDUCATIONAL BACKGROUND / QUALIFICATIONS</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['formSubmit'])) {
                $educationalData = [
                  [
                    'level' => $_POST['elementary'],
                    'name_of_school' => $_POST['elem_name_of_school'],
                    'degree_course' => $_POST['elem_degree_course'],
                    'year_graduated' => $_POST['elem_year_graduated']
                  ],
                  [
                    'level' => $_POST['secondary'],
                    'name_of_school' => $_POST['secon_name_of_school'],
                    'degree_course' => $_POST['secon_degree_course'],
                    'year_graduated' => $_POST['secon_year_graduated']
                  ],
                  [
                    'level' => $_POST['vocational'],
                    'name_of_school' => $_POST['voc_name_of_school'],
                    'degree_course' => $_POST['voc_degree_course'],
                    'year_graduated' => $_POST['voc_year_graduated']
                  ],
                  [
                    'level' => $_POST['college'],
                    'name_of_school' => $_POST['coll_name_of_school'],
                    'degree_course' => $_POST['coll_degree_course'],
                    'year_graduated' => $_POST['coll_year_graduated']
                  ],
                  [
                    'level' => $_POST['grad_studies'],
                    'name_of_school' => $_POST['grad_studies_name_of_school'],
                    'degree_course' => $_POST['grad_studies_degree_course'],
                    'year_graduated' => $_POST['grad_studies_year_graduated']
                  ],
                  [
                    'level' => $_POST['post_graduate'],
                    'name_of_school' => $_POST['post_grad_name_of_school'],
                    'degree_course' => $_POST['post_grad_degree_course'],
                    'year_graduated' => $_POST['post_grad_year_graduated']
                  ],
                  [
                    'level' => $_POST['others'],
                    'name_of_school' => $_POST['others_name_of_school'],
                    'degree_course' => $_POST['others_degree_course'],
                    'year_graduated' => $_POST['others_year_graduated']
                  ],
                ];
                $educational_background = [];
                foreach ($educationalData as $data) {
                  if (!empty($data['level']) && !empty($data['name_of_school']) && !empty($data['degree_course']) && !empty($data['year_graduated'])) {
                    $educational_background[] = "('" . mysqli_real_escape_string($conn, $data['level']) . "', '" . mysqli_real_escape_string($conn, $data['name_of_school']) . "', '" . mysqli_real_escape_string($conn, $data['degree_course']) . "', '" . mysqli_real_escape_string($conn, $data['year_graduated']) . "')";
                  }
                }
                if (!empty($educational_background)) {
                  $sql = "INSERT INTO `pds_educational_background` (level, name_of_school, degree_course, year_graduated) VALUES " . implode(', ', $educational_background);
                  $res = mysqli_query($conn, $sql);
                  if ($res) {
                    echo '
                <script>
                    swal({
                        title: "Good Job!",
                        text: "Data inserted successfully",
                        icon: "success",
                        buttons: ["Close", "Okay"]
                    }).then(() => {
                        window.location.href = "index.php?page=manage_employee_filing";
                    });
                </script>';
                  }
                }
              }
              ?>
              <tr style="background: #87CEEB;">
                <td class="align-middle" width="200">
                  <center>LEVEL</center>
                </td>
                <td class="align-middle" colspan="2" width="220">
                  <center>NAME OF SCHOOL</center>
                </td>
                <td class="align-middle" colspan="2" width="225">
                  <center>DEGREE COURSE</center>
                </td>
                <td class="align-middle" width="140">
                  <center>YEAR GRADUATED</center>
                </td>
              </tr>
              <!-- elementary -->
              <tr>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="elementary" value="elementary" id="" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="elem_name_of_school" placeholder="Enter the name of your school" id=""
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="elem_degree_course" placeholder="Enter your degree course" id=""
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="elem_year_graduated" placeholder="Year graduated" id=""
                      class="form-control">
                  </div>
                </td>
              </tr>
              <!-- secondary -->
              <tr>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="secondary" value="secondary" id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="secon_name_of_school" placeholder="Enter the name of your school"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="secon_degree_course" placeholder="Enter your degree course"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="secon_year_graduated" placeholder="Year graduated" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
              </tr>
              <!-- vocational -->
              <tr>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="vocational" value="vocational" id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="voc_name_of_school" placeholder="Enter the name of your school"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="voc_degree_course" placeholder="Enter your degree course"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="voc_year_graduated" placeholder="Year graduated" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
              </tr>
              <!-- college -->
              <tr>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="college" value="college" id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="coll_name_of_school" placeholder="Enter the name of your school"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="coll_degree_course" placeholder="Enter your degree course"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="coll_year_graduated" placeholder="Year graduated" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
              </tr>
              <!-- grad_studies -->
              <tr>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="grad_studies" value="graduate studies" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="grad_studies_name_of_school" placeholder="Enter the name of your school"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="grad_studies_degree_course" placeholder="Enter your degree course"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="grad_studies_year_graduated" placeholder="Year graduated"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
              </tr>
              <!-- post_graduate -->
              <tr>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="post_graduate" value="post graduate" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="post_grad_name_of_school" placeholder="Enter the name of your school"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="post_grad_degree_course" placeholder="Enter your degree course"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="post_grad_year_graduated" placeholder="Year graduated" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
              </tr>
              <!-- others -->
              <tr>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="others" value="others" id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="others_name_of_school" placeholder="Enter the name of your school"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle" colspan="2">
                  <div class="form-group">
                    <input type="text" name="others_degree_course" placeholder="Enter your degree course"
                      id="inputMiddleName" class="form-control">
                  </div>
                </td>
                <td style="padding: 16px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="others_year_graduated" placeholder="Year graduated" id="inputMiddleName"
                      class="form-control">
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- third table -->
          <table class="table table-bordered mt-5">
            <thead>
              <tr style="background: #87CEEB;">
                <th colspan="7">CERTIFICATES OF ELIGIBILITY, TRAININGS, ATTENDANCE TO SEMINARS, WORKSHOPS AND
                  CONFERENCES
                </th>
              </tr>
            </thead>
            <tbody>
              <tr style="background: #87CEEB;">
                <td class="align-middle" width="370">
                  <center>TITLE</center>
                </td>
                <td class="align-middle" width="120">
                  <center>DATE</center>
                </td>
                <td class="align-middle" width="200">
                  <center>CERTIFICATE NUMBER</center>
                </td>
                <td class="align-middle" width="155">
                  <center>GIVEN BY</center>
                </td>
                <td class="align-middle" width="100">
                  <center>RATING</center>
                </td>
              </tr>
              <?php
              if (isset($_POST['formSubmit'])) {
                $certificates_of_eligibility_data = [
                  [
                    'title' => $_POST['title_01'],
                    'date' => $_POST['date_01'],
                    'certificate_number' => $_POST['certificate_number_01'],
                    'given_by' => $_POST['given_by_01'],
                    'rating' => $_POST['rating_01']
                  ],
                  [
                    'title' => $_POST['title_02'],
                    'date' => $_POST['date_02'],
                    'certificate_number' => $_POST['certificate_number_02'],
                    'given_by' => $_POST['given_by_02'],
                    'rating' => $_POST['rating_02']
                  ],
                  [
                    'title' => $_POST['title_03'],
                    'date' => $_POST['date_03'],
                    'certificate_number' => $_POST['certificate_number_03'],
                    'given_by' => $_POST['given_by_03'],
                    'rating' => $_POST['rating_03']
                  ],
                  [
                    'title' => $_POST['title_04'],
                    'date' => $_POST['date_04'],
                    'certificate_number' => $_POST['certificate_number_04'],
                    'given_by' => $_POST['given_by_04'],
                    'rating' => $_POST['rating_04']
                  ],
                  [
                    'title' => $_POST['title_05'],
                    'date' => $_POST['date_05'],
                    'certificate_number' => $_POST['certificate_number_05'],
                    'given_by' => $_POST['given_by_05'],
                    'rating' => $_POST['rating_05']
                  ],
                ];
                $certificates_of_eligibility = [];
                foreach ($certificates_of_eligibility_data as $certificates) {
                  if (!empty($certificates['title']) && !empty($certificates['date']) && !empty($certificates['certificate_number']) && !empty($certificates['given_by'] && !empty($certificates['rating']))) {
                    $certificates_of_eligibility[] = "('" . mysqli_real_escape_string($conn, $certificates['title']) . "', '" . mysqli_real_escape_string($conn, $certificates['date']) . "', '" . mysqli_real_escape_string($conn, $certificates['certificate_number']) . "', '" . mysqli_real_escape_string($conn, $certificates['given_by']) . "', '" . mysqli_real_escape_string($conn, $certificates['rating']) . "')";
                  }
                }
                if (!empty($certificates_of_eligibility)) {
                  $sql = "INSERT INTO `pds_certificates_of_eligibility` (title, date, certificate_number, given_by, rating) VALUES " . implode(', ', $certificates_of_eligibility);
                  $res = mysqli_query($conn, $sql);
                  if ($res) {
                    echo '
                <script>
                    swal({
                        title: "Good Job!",
                        text: "Data inserted successfully",
                        icon: "success",
                        buttons: ["Close", "Okay"]
                    }).then(() => {
                        window.location.href = "index.php?page=manage_employee_filing";
                    });
                </script>';
                  }
                }
              }
              ?>
              <!-- first certificate -->
              <tr>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="title_01" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="date_01" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="certificate_number_01" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="given_by_01" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="rating_01" class="form-control">
                  </div>
                </td>
              </tr>
              <!-- second certificate -->
              <tr>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="title_02" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="date_02" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="certificate_number_02" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="given_by_02" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="rating_02" class="form-control">
                  </div>
                </td>
              </tr>
              <!-- third certificate -->
              <tr>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="title_03" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="date_03" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="certificate_number_03" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="given_by_03" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="rating_03" class="form-control">
                  </div>
                </td>
              </tr>
              <!-- fourth certificate -->
              <tr>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="title_04" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="date_04" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="certificate_number_04" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="given_by_04" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="rating_04" class="form-control">
                  </div>
                </td>
              </tr>
              <!-- fifth certificate -->
              <tr>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="title_05" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="date_05" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="certificate_number_05" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="given_by_05" class="form-control">
                  </div>
                </td>
                <td style="padding: 10px 10px 0;" class="align-middle">
                  <div class="form-group">
                    <input type="text" name="rating_05" class="form-control">
                  </div>
                </td>
              </tr>
              <!-- i hereby certify the correctness of the above information -->
              <tr>
                <td style="width: 100%; height: 440px;" colspan="6">
                  <p style="margin: 60px 0;" class="text-center">I hereby certify the correctness of the above
                    information.</p>
                  <div style="gap: 20px" class="d-flex align-items-start justify-content-center">
                    <?php
                    if (isset($_POST['formSubmit'])) {
                      $datetime = $_POST['datetime'];
                      $right_thumbmark = $_FILES['right_thumbmark'];
                      if (isset($_FILES['signature'])) {
                        $signature = $_FILES['signature'];
                        $signature_name = $signature['name'];
                        $signature_error = $signature['error'];
                        $signature_temp = $signature['tmp_name'];
                        $filename_separator = explode('.', $signature_name);
                        $signature_extension = strtolower(end($filename_separator));
                        $allowed_extensions = array('jpeg', 'jpg', 'png');
                        if (in_array($signature_extension, $allowed_extensions) && $signature_error === 0) {
                          $signature_filename = md5($signature_name . time()) . '.' . $signature_extension;
                          $thumbmark_filename = md5($right_thumbmark['name'] . time()) . '.' . pathinfo($right_thumbmark['name'], PATHINFO_EXTENSION);
                          $signature_upload = './faculty/signature/' . $signature_filename;
                          move_uploaded_file($signature_temp, $signature_upload);
                          $thumbmark_upload = './faculty/thumbmark/' . $thumbmark_filename;
                          move_uploaded_file($right_thumbmark['tmp_name'], $thumbmark_upload);
                          $sql = "INSERT INTO `pds_signature_datetime_thumbmark` (signature, date_time, right_thumbmark) VALUES ('$signature_filename', '$datetime', '$thumbmark_filename')";
                          $res = mysqli_query($conn, $sql);
                          if ($res) {
                            echo '
                              <script>
                                swal({
                                  title: "Good Job!",
                                  text: "Data inserted successfully",
                                  icon: "success",
                                  buttons: ["Close", "Okay"]
                                }).then(() => {
                                  window.location.href = "index.php?page=manage_employee_filing";
                                })
                              </script> ';
                          } else {
                            echo "Error: " . mysqli_connect_error();
                          }
                        }
                      }
                    }
                    ?>
                    <div class="form-group d-flex align-items-center justify-content-start m-0 p-0"
                      style="width: 500px; flex-direction: column;">
                      <div class="custom-file" style="height: 100px; border: 3px double #999;">
                        <!-- signature -->
                        <input type="file" name="signature" class="custom-file-input" id="inputGroupFile"
                          aria-describedby="inputGroupFile">
                        <label class="custom-file-label text-uppercase" for="inputGroupFile"
                          style="color: #a1a1a1 !important;">choose file</label>
                        <div class="text-signature d-flex align-items-center justify-content-center"
                          style="background: #b0b0b0; padding: 18px 0 0">
                          <p class="text-uppercase text-center">signature</p>
                        </div>
                      </div>
                      <div class="custom-file" style="height: 102px; border: 3px double #999;">
                        <!-- date & time -->
                        <input type="datetime-local" name="datetime" class="form-control" id="inputGroupFile"
                          style="color: #999; padding: 0 10px;">
                        <div class="text-signature d-flex align-items-center justify-content-center"
                          style="background: #b0b0b0; padding: 18px 0 0">
                          <p class="text-uppercase text-center">date & time accomplished</p>
                        </div>
                      </div>
                    </div>
                    <div
                      style="display: flex; flex-direction: column; align-items: center; justif-content: center; gap: 10px; border: 3px double #999;">
                      <div class="custom-file" style="height: 196px;">
                        <!-- right thumbmark -->
                        <input type="file" name="right_thumbmark" class="custom-file-input" id="inputGroupFile"
                          aria-describedby="inputGroupFile">
                        <label class="custom-file-label text-uppercase" for="inputGroupFile"
                          style="color: #a1a1a1 !important;">choose file</label>
                        <div class="text-signature d-flex align-items-center justify-content-center"
                          style="background: #b0b0b0; padding: 18px 0 0; margin: 100px 0 0;">
                          <p class="text-uppercase text-center">right thumbmark</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="form-group" style="margin: 20px 0 0;">
            <button type="submit" name="formSubmit" class="btn btn-lg btn-primary"
              style="display: block; width: 100%; height: 100%;">Submit Profile</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>