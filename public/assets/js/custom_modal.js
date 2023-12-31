$(document).ready(function () {
    // Attach click event to show QR button

    $(".show-qr-button").on("click", function () {
        var studentId = $(this).data("student-id");
        console.log(studentId);
        loadAndDisplayQR(studentId);
    });

    $(".update-student").on("click", function () {
        var studentId = $(this).data("student-id");
        console.log(studentId);
        displayStudentDetail(studentId);
    });

    $("#update-student").on("click", ".btn-primary", function () {
        // Gather data from input fields
        var id = $("#id").val();
        var student_id = $("#edit_studentid").val();
        var year_level = $('#edit_year_level').val();
        var firstName = $("#edit_fname").val();
        var lastName = $("#edit_lname").val();
        var middleName = $("#edit_mname").val();
        console.log(id);

        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        const formData = {
            id: id,
            year_level: year_level,
            student_id: student_id,
            first_name: firstName,
            last_name: lastName,
            middle_name: middleName,
            _token: csrfToken,
        };

        updateStudent(formData);
        console.log(formData, csrfToken);
        // Perform AJAX request to update student details
    });

    $("#search-input").on("input", function (e) {
        e.preventDefault();
        var accessToken = localStorage.getItem("access_token");
        var query = $("#search-input").val();
        if (query === "") {
            updateStudentList();
        } else {
            $.ajax({
                type: "GET",
                url: "search-student/" + query,
                headers: {
                    Authorization: "Bearer " + accessToken,
                },
                data: { query: query },
                success: function (data) {
                    console.log(data);
                    $("#student-list-container").html(data);
                },
            });
        }
    });

    $("#logout-btn").click(".btn-primary", function (e) {
        e.preventDefault();
        var accessToken = localStorage.getItem("access_token");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        // console.log(accessToken);
        const formData = {
            access_token: accessToken,
        };
        $.ajax({
            type: "POST",
            url: "logout",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Authorization: "Bearer " + accessToken,
            },
            data: formData,
            success: function (data) {
                window.location.href = "/";
            },
        });
    });

    $(".student-attendance").on("click", function (e) {
        e.preventDefault();

        $("#attendance_student_id").val($(this).data("student-id"));
    });

    $(".grade-attendance").on("click", function (e) {
        e.preventDefault();

        $("#grade_student_id").val($(this).data("student-id"));
    });

    $(".track-modal").on("click", function (e) {
        e.preventDefault();
        // console.log($(this).data("student-id"))
        $(".track_student_id").val($(this).data("student-id"));
        var id = $(this).data("student-id");
        getPoints(id);
    });

    $("#attendance-button").on("click", function (e) {
        e.preventDefault();
        var accessToken = localStorage.getItem("access_token");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        console.log($("#attendance_student_id").val());
        const formData = {
            description: $("#description").val(),
            student_id: $("#attendance_student_id").val(),
            attendance_type: $("#attendance_type").val(),
            attendance_date: $("#attendance_date").val(),
            attendance_time: $("#attendance_time").val(),
        };
        console.log(formData);
        $.ajax({
            type: "POST",
            url: "attendance-student-manual",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Authorization: "Bearer " + accessToken,
            },
            data: formData,
            success: function (data) {
                if (data.url) {
                    // Redirect to the receipt blade with the ID parameter
                    window.open(data.url, '_blank');
                    location.reload();
                } else {
                    console.error('Invalid response data:', data);
                }
            },
        });
    });

    $("#grade-button").on("click", function (e) {
        e.preventDefault();
        var accessToken = localStorage.getItem("access_token");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        console.log($("#grade_student_id").val());
        const formData = {
            grade_type: $("#grade_type").val(),
            grade_descriptions: $("#grade_descriptions").val(),
            student_id: $("#grade_student_id").val(),
            points: $("#points").val(),
            grade_date: $("#grade_date").val(),
            grade_time: $("#grade_time").val(),
        };
        console.log(formData);
        $.ajax({
            type: "POST",
            url: "performance-student-manual",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Authorization: "Bearer " + accessToken,
            },
            data: formData,
            success: function (data) {
                if (data.url) {
                    // Redirect to the receipt blade with the ID parameter
                    window.open(data.url, '_blank');
                    location.reload();
                } else {
                    console.error('Invalid response data:', data);
                }
            },
        });
    });
});

function updateStudent(formData, csrfToken) {
    var accessToken = localStorage.getItem("access_token");

    $.ajax({
        type: "POST", 
        url: "update-student", 
        data: formData,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            Authorization: "Bearer " + accessToken,
        },
        success: function (response) {
            console.log(response);
            updateStudentList();
            $("#update-student").modal("hide");
        },
        error: function (error) {
            $('.modal-body').prepend('<div class="alert alert-danger">Please fill up all inputs</div>');
            console.error(error);
        },
    });
}

function displayStudentDetail(studentId) {
    var accessToken = localStorage.getItem("access_token");

    console.log(studentId);
    $.ajax({
        type: "GET",
        headers: {
            Authorization: "Bearer " + accessToken,
        },
        url: "get-student-by-id/" + studentId,
        success: function (response) {
            console.log(response.data.first_name);
            $("#edit_studentid").val(response.data.student_id);
            $("#edit_year_level").val(response.data.year_lvl);
            $("#edit_fname").val(response.data.first_name);
            $("#edit_lname").val(response.data.last_name);
            $("#edit_mname").val(response.data.middle_name);
            $("#id").val(response.data.id);
            $("#student-update").modal("show");
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}

function loadAndDisplayQR(studentId) {
    // AJAX to get QR code
    var accessToken = localStorage.getItem("access_token");
    $.ajax({
        type: "GET",
        headers: {
            Authorization: "Bearer " + accessToken,
        },
        url: "generate-qrcode/" + studentId,
        success: function (response) {
            $(".svgImage").html(response);
            $("#show-qr").modal("show");
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}

function updateStudentList() {
    // Fetch and replace the student list section
    var accessToken = localStorage.getItem("access_token");
    $.ajax({
        type: "GET",
        headers: {
            Authorization: "Bearer " + accessToken,
        },
        url: "/get-student-list",
        success: function (data) {
            // Update the content of the student list container
            // Replace the content of the tbody with the updated content
            // console.log("Received response:", data);

            var studentListContainer = $("#student-list-container");
            studentListContainer.html(data);

            // Update the pagination links
            var paginationContainer = $("#pagination-container");
            paginationContainer.html(
                $(data).find("#pagination-container").html()
            );

            $("#first_name").val("");
            $("#last_name").val("");
            $("#middle_name").val("");
            location.reload();
        },
        error: function (error) {
            console.error("Error fetching student list:", error);
        },
    });
}

function getPoints(id){
    var accessToken = localStorage.getItem("access_token");
    $.ajax({
        type: "GET",
        headers: {
            Authorization: "Bearer " + accessToken,
        },
        url: "get-points/"+ id,
        success: function (data) {
            $('#demerit_total_points').html(data.demerit_sum - data.merit_sum)
            console.log(data);
        },
        error: function (error) {
            console.error("Error fetching student list:", error);
        },
    }); 
}

function printSvg() {
    // Clone the SVG content
    var svgElement = $(".svgImage").find("svg");

    // Create a new window for printing
    var printWindow = window.open("", "_blank");
    printWindow.document.open();
    printWindow.document.write(
        "<html><head><title>Print</title></head><body style='display: flex; align-items: center; justify-content: center;'>"
    );

    // Append the cloned SVG to the new window
    printWindow.document.write(svgElement[0].outerHTML);

    // Close the HTML document
    printWindow.document.write("</body></html>");
    printWindow.document.close();

    // Trigger the print dialog
    printWindow.print();
}

$("#printButton").on("click", function () {
    printSvg();
});
