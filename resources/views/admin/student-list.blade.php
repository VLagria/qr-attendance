@foreach ($students as $value)
    <tr id="student-list-container">

        <td hidden id="stud-id">{{ $value->id }}</td>
        <td>{{ $value->student_id }}</td>
        <td>{{ $value->first_name }} {{ $value->middle_name }} {{ $value->last_name }}</td>
        <td>{{ $value->year_lvl }}</td>
        <td> <a href="#" class="btn btn-icon icon-left btn-primary update-student" data-toggle="modal"
                data-target="#update-student" data-student-id="{{ $value->id }}"><i class="far fa-edit"></i>
                Edit</a>
            <a href="#" class="btn btn-icon icon-left btn-info show-qr-button" data-toggle="show-qr"
                data-target="#show-qr" data-student-id="{{ $value->id }}"><i class="fas fa-info-circle"></i>
                QR</a>
            <a href="#" class="btn btn-icon icon-left btn-warning student-attendance" data-toggle="modal"
                data-target="#attendance-modal" data-student-id="{{ $value->id }}"><i
                    class="fas fa-check"></i>
                Logs</a>
            <a href="#" class="btn btn-icon icon-left btn-dark grade-attendance" data-toggle="modal"
            data-target="#grade-modal" data-student-id="{{ $value->id }}"><i class="fas fa-hand-point-up"></i>
                Points</a>
            <a href="#" class="btn btn-icon icon-left btn-success track-modal" data-toggle="modal"
            data-target="#track-modal" data-student-id="{{ $value->id }}"><i class="fas fa-search"></i>
                Track</a>
        </td>
    </tr>
@endforeach
