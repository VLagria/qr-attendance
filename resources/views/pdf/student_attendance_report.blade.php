<!DOCTYPE html>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Report</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <div class="card">
        <div class="card-header">
           <table>
            <thead>
                <tr>
                    <td> <img src="{{ public_path('assets/img/hcdc-logo.png') }}" style="width: 100px; height: 100px" alt="Your Image"></td>
                    <td style="text-align: center"> 
                        <p style="font-size: 10px; line-height: 1em; margin-left: 90px">Holy Cross of Davao College</p>
                        <p style="font-size: 12px; line-height: 1em; margin-left: 90px"><strong>COLLEGE OF CRIMINAL JUSTICE EDUCATION</strong></p>
                        <p style="font-size: 10px; line-height: 1em; margin-left: 90px">Sta. Ana Avenue, corner C. de Guzman</p>
                        <p style="font-size: 10px; line-height: 1em; margin-left: 90px">Brgy. 14-B, Davao City, Philippines</p>
                    </td>
                    <td> 
                        <div style="text-align: right">
                            <img src="{{ public_path('assets/img/hcdc-crim-logo.png') }}" style="width: 110px; height: 110px; display: inline; padding-left: 100px" alt="Your Image">
                        </div>
                    </td>
                </tr>
            </thead>
           </table>
          </div>
        </div>
        <div class="card-body">
          <p style="font-size: 10px;"><strong>Date: {{ date("F-d-Y") }}</strong></p>
          <table class="table" style="font-size: 10px;">
            <thead>
              <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">Remarks</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $val)
              <tr>
                <td>{{ $val->display_id }}</td>
                <td>{{ $val->last_name }}, {{ $val->first_name }} {{ $val->middle_name }}</td>
                @if ($val->is_present === 1)
                <td>Present</td>
                @elseif ($val->is_absent === 1)    
                <td>Absent</td>
                @elseif ($val->is_late === 1)
                <td>Late</td>
                @endif
                <td>{{ $val->date }}</td>
                <td>{{ date("h:i A", strtotime($val->time)) }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
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

<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<script src="assets/js/custom.js"></script>


