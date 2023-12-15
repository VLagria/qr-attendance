<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard &mdash; Admin</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Admin</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a type="button" id="logout-btn" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="">Admin</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href=""></a>
                    </div>
                    <ul class="sidebar-menu">

                        <li class="menu-header">List</li>

                        <li class=active><a class="nav-link" href="blank.html"><i class="far fa-user"></i>
                                <span>Students</span></a></li>

                    </ul>

                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h4>Student List</h4>
                    </div>

                    <div class="section-body">
                        <div class="">

                            <div class="card">
                                <div class="card-body">

                                    <td>
                                        <div class="card-header-form">
                                            <a href="#" class="btn btn-icon btn-primary icon-left mb-2 mr-sm-2"
                                                id="modal-5"><i class="far fa-user"></i>
                                                Register Student</a>
                                            {{-- <button class="btn btn-primary mb-2 mr-sm-2" id="modal-5">Register
                                                Student</button> --}}
                                            <a href="#" class="btn btn-icon icon-left btn-dark mb-2 mr-sm-2"
                                                data-toggle="modal" data-target="#generate-reports"><i
                                                    class="far fa-file"></i> Generate Report</a>
                                            <form id="search-form">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <input type="text" id="search-input" class="form-control"
                                                        placeholder="Search">
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th>Student ID#</th>
                                                <th>Name</th>
                                                <th>Year Level</th>
                                                <th style="width: 500px">Action</th>
                                            </tr>
                                            <tbody id="student-list-container">

                                                @include('admin.student-list')
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <nav class="d-inline-block" id="pagination-container">
                                        {{ $students->links('vendor.pagination.custom') }}

                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <form class="modal-part" id="modal-login-part">
                    <div class="form-group">
                        <label>Student ID</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-list-ol"></i>
                                </div>
                            </div>
                            <input type="student_id" class="form-control" required placeholder="student id" name="student_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Year Level</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                            </div>
                            <input type="number" class="form-control" required placeholder="Year level" name="year_level">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" required placeholder="First name" name="first_name"
                                id="first_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" required placeholder="Last name" name="last_name"
                                id="last_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Middile Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" required placeholder="Middle name" name="middle_name"
                                id="middle_name">
                        </div>
                    </div>
                </form>
            </div>

            <<!-- Modal -->
                <div class="modal fade" id="update-student" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Student Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Student ID</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Student id"
                                            name="edit_studentid" id="edit_studentid">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Year Level</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-hashtag"></i>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Year level" id="edit_year_level" name="edit_year_level">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" id="id">
                                        <input type="text" class="form-control" placeholder="Email"
                                            name="edit_fname" id="edit_fname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Email"
                                            name="edit_lname" id="edit_lname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Middile Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Email"
                                            name="edit_mname" id="edit_mname">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <<!-- Modal -->
                    <div class="modal fade" id="show-qr" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Student QR Code</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="qrCodeContainer">
                                        <div data-crop-image="285">
                                            <div style="display: flex;
                                    justify-content: center;
                                    align-items: center;"
                                                class="svgImage">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="printButton">Print QR
                                        Code</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <<!-- Modal -->
                        <div class="modal fade" id="generate-reports" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Generate Reports</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <form method="POST" action="{{ route('student.reportbydate') }}"
                                                target="_blank">
                                                @csrf
                                                <label>Attendance Report by Date</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" name="date" id="date"
                                                        class="form-control">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Generate
                                                            Report</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-group">
                                            <form method="POST" action="{{ route('student.reportbymonth') }}"
                                                target="_blank">
                                                @csrf
                                                <label>Attendance Report by Month</label>
                                                <div class="input-group mb-3">
                                                    <input type="month" name="month" id="month"
                                                        class="form-control">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Generate
                                                            Report</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-group">
                                            <form method="POST" action="{{ route('student.demeritbydate') }}"
                                                target="_blank">
                                                @csrf
                                                <label>Demerit Report by Date</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" name="date" id="date"
                                                        class="form-control">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Generate
                                                            Report</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-group">
                                            <form method="POST" action="{{ route('student.demeritbymonth') }}"
                                                target="_blank">
                                                @csrf
                                                <label>Demerit Report by Month</label>
                                                <div class="input-group mb-3">
                                                    <input type="month" name="month" id="month"
                                                        class="form-control">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Generate
                                                            Report</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-group">
                                            <form method="POST" action="{{ route('student.meritbydate') }}"
                                                target="_blank">
                                                @csrf
                                                <label>Merit Report by Date</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" name="date" id="date"
                                                        class="form-control">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Generate
                                                            Report</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-group">
                                            <form method="POST" action="{{ route('student.meritbymonth') }}"
                                                target="_blank">
                                                @csrf
                                                <label>Merit Report by Month</label>
                                                <div class="input-group mb-3">
                                                    <input type="month" name="month" id="month"
                                                        class="form-control">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Generate
                                                            Report</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <<!-- Modal -->
                            <div class="modal fade" id="attendance-modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Check Attendance</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form>
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="attendance_student_id" name="attendance_student_id">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <select class="form-control" id="description" name="description">
                                                        <option value="Monthly Formation">Monthly Formation</option>
                                                        <option value="School Activity">School Activity</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <input type="date" name="attendance_date" id="attendance_date"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Datetime Local</label>
                                                    <input type="time" class="form-control" name="attendance_time"
                                                        id="attendance_time">
                                                </div>
                                                <div class="form-group">
                                                    <label>Attendance</label>
                                                    <select class="form-control" id="attendance_type"
                                                        name="attendance_type">
                                                        <option value="1">Present</option>
                                                        <option value="2">Late</option>
                                                        <option value="0">Absent</option>
                                                    </select>
                                                </div>
                                           
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"
                                                id="attendance-button">Attendance</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="grade-modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Merit / Demerit</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <input type="hidden" id="grade_student_id" name="grade_student_id">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <select class="form-control" id="grade_type" name="grade_type">
                                                        <option value="Demerit">Demerit</option>
                                                        <option value="Merit">Merit</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <input type="date" name="grade_date" id="grade_date"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Datetime Local</label>
                                                    <input type="time" class="form-control" name="grade_time"
                                                        id="grade_time">
                                                </div>
                                                <div class="form-group">
                                                    <label>Descriptions</label>
                                                    <input type="text" class="form-control" name="grade_descriptions" placeholder="Enter Description"
                                                        id="grade_descriptions">
                                                </div>
                                                <div class="form-group">
                                                    <label>Points</label>
                                                    <input type="number" class="form-control" name="points" placeholder="Enter points"
                                                        id="points">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"
                                                id="grade-button">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="track-modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Demerit Points: </h5> <p class="text-danger" id="demerit_total_points"></p> <br>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('student.attendance') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <p class="text-capitalize text-bold text-black-50">Track Student Attendance: </p>
                                                    <input type="hidden" class="track_student_id" id="track_student_id" name="track_student_id">
                                                    <button type="submit" class="form-control btn btn-primary"
                                                    id="grade-button">Generate</button>
                                                </div>
                                            </form>
                                            <form method="POST" action="{{ route('student.demerit') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <p class="text-capitalize text-bold text-black-50">Track Student Demerit: </p>
                                                    <input type="hidden" class="track_student_id" id="track_student_id" name="demerit_student_id">
                                                    <button type="submit" class="form-control btn btn-primary"
                                                    id="grade-button">Generate</button>
                                                </div>
                                            </form>
                                            <form method="POST" action="{{ route('student.merit') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <p class="text-capitalize text-bold text-black-50">Track Student Merit: </p>
                                                    <input type="hidden" class="track_student_id" id="track_student_id" name="merit_student_id">
                                                    <button type="submit" class="form-control btn btn-primary"
                                                    id="grade-button">Generate</button>
                                                </div>
                                            </form>
                                            <form method="POST" action="{{ route('track.record') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <p class="text-capitalize text-bold text-black-50">Track All Records: </p>
                                                    <input type="hidden" class="track_student_id" id="track_student_id" name="record_student_id">
                                                    <button type="submit" class="form-control btn btn-primary"
                                                    id="grade-button">Generate</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2018 <div class="bullet"></div>
            </div>
            <div class="footer-right">

            </div>
        </footer>
    </div>
    </div>


    <!-- General JS Scripts -->
    <script src="assets/modules/jquery.min.js"></script>
    <script src="assets/modules/popper.js"></script>
    <script src="assets/modules/tooltip.js"></script>
    <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/modules/moment.min.js"></script>
    <script src="assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="assets/modules/prism/prism.js"></script>
    <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>
    <!-- Page Specific JS File -->

    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('assets/js/custom_modal.js') }}"></script>

    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
