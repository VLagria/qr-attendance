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

                        <li class=active><a class="nav-link" href="blank.html"><i class="far fa-square"></i>
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
                                            <a href="#" class="btn btn-icon icon-left btn-dark mb-2 mr-sm-2"><i
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
                                                <th style="width: 200px">Action</th>
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
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <input type="student_id" class="form-control" placeholder="student id" name="student_id">
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
                            <input type="text" class="form-control" placeholder="First name" name="first_name"
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
                            <input type="text" class="form-control" placeholder="Last name" name="last_name"
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
                            <input type="text" class="form-control" placeholder="Middle name" name="middle_name"
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
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Student id"
                                            name="edit_studentid" id="edit_studentid">
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
                                    <button type="button" class="btn btn-primary" id="printButton">Generate QR
                                        Code</button>
                                </div>
                            </div>
                        </div>
                    </div>

        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                    Nauval Azhar</a>
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