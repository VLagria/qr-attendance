<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin &mdash; Registration</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
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
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register Student</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('pubic.register') }}" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Student ID</label>
                                        <input id="student_id" type="text" class="form-control" name="student_id"
                                            tabindex="1" required autofocus placeholder="Enter student id" required>
                                        <div class="invalid-feedback">
                                            Please fill in your Student ID
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Year Level</label>
                                        <input id="year_lvl" type="text" class="form-control" name="year_level"
                                            tabindex="1" required autofocus placeholder="Enter year level" required>
                                        <div class="invalid-feedback">
                                            Please fill in your Year Level
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">First Name</label>
                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                            tabindex="1" required autofocus placeholder="Enter first name" required>
                                        <div class="invalid-feedback">
                                            Please fill in your First Name
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Last Name</label>
                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                            tabindex="1" required autofocus placeholder="Enter last name" required>
                                        <div class="invalid-feedback">
                                            Please fill in your Last Name
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Middle Name</label>
                                        <input id="middle_name" type="text" class="form-control" name="middle_name"
                                            tabindex="1" required autofocus placeholder="Enter middle name" required>
                                        <div class="invalid-feedback">
                                            Please fill in your Middle Name
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" id="login" class="btn btn-primary btn-lg btn-block"
                                            tabindex="4">
                                            Register
                                        </button>
                                    </div>
                                </form>
                                <div class="text-center mt-4 mb-3">

                                </div>
                                <div class="row sm-gutters">

                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Already have an account?  <a href="{{ route('auth.login') }}">login here</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
