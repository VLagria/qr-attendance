"use strict";

$("#modal-1").fireModal({ body: "Modal body text goes here." });
$("#modal-2").fireModal({ body: "Modal body text goes here.", center: true });

let modal_3_body =
    '<p>Object to create a button on the modal.</p><pre class="language-javascript"><code>';
modal_3_body += "[\n";
modal_3_body += " {\n";
modal_3_body += "   text: 'Login',\n";
modal_3_body += "   submit: true,\n";
modal_3_body += "   class: 'btn btn-primary btn-shadow',\n";
modal_3_body += "   handler: function(modal) {\n";
modal_3_body += "     alert('Hello, you clicked me!');\n";
modal_3_body += "   }\n";
modal_3_body += " }\n";
modal_3_body += "]";
modal_3_body += "</code></pre>";
$("#modal-3").fireModal({
    title: "Register Student",
    body: $("#modal-update-part"),
    footerClass: "bg-whitesmoke",
    autoFocus: false,
    onFormSubmit: function (modal, e, form) {
        // Form Data
        let form_data = $(e.target).serialize();

        // DO AJAX HERE
        $.ajax({
            type: "POST",
            url: "api/add-students", // Replace with the actual URL
            data: form_data,
            success: function (response) {
                form.stopProgress();
                modal
                    .find(".modal-body")
                    .prepend(
                        '<div class="alert alert-success">' +
                            response.msg +
                            "</div>"
                    );
                updateStudentList();

                // Close the modal (Optional)
                modal.modal("hide");
            },
            error: function (error) {
                form.stopProgress();
                modal
                    .find(".modal-body")
                    .prepend(
                        '<div class="alert alert-danger">All input required</div>'
                    );
                console.error("Error:", error);
            },
        });

        e.preventDefault();
    },
    shown: function (modal, form) {
        console.log(form);
    },
    buttons: [
        {
            text: "Register",
            submit: true,
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {},
        },
    ],
});

// $("#modal-4").on("click", function () {
//     var studentId = $(this).data("student-id");
//     console.log(studentId);
//     showQR(studentId);

// });

// $("#modal-4").fireModal({
//     title: "",
//     body: $("#modal-qr-part"),
//     footerClass: "bg-whitesmoke",
//     autoFocus: false,
//     onShown: function (modal, form) {
//         // Form Data
//         let studentId = $(this).data("student-id");

//         console.log(studentId);
//         // AJAX to get QR code
//         $.ajax({
//             type: "GET",
//             url: "/generate-qrcode/" + studentId,
//             success: function (response) {
//                 // Display QR code in modal
//                 $("#svgImage").attr(
//                     "src",
//                     "data:image/svg+xml;charset=utf-8," +
//                         encodeURIComponent(response)
//                 );
//             },
//             error: function (error) {
//                 console.error("Error:", error);
//             },
//         });

//         e.preventDefault();
//     },
//     shown: function (modal, form) {
//         console.log(form);
//     },
//     buttons: [
//         {
//             text: "Download QR",
//             submit: true,
//             class: "btn btn-primary btn-shadow",
//             handler: function (modal) {},
//         },
//     ],
// });

// $("#modal-qr-part").on("hidden.bs.modal", function () {
//     console.log("Modal hidden!");
//     // You can perform additional cleanup here if needed
// });

function showQR(studentId) {
    console.log("Modal shown!");

    $.ajax({
        type: "GET",
        url: "api/generate-qrcode/" + studentId,
        success: function (response) {
            $("#svgImage").attr(
                "src",
                "data:image/svg+xml;charset=utf-8," +
                    encodeURIComponent(response)
            );

            // Show the modal once the QR code is loaded
            $("#qrModal").modal("show");
        },
        error: function (error) {
            console.error("Error fetching QR code:", error);
        },
    });
}

$("#modal-5").fireModal({
    title: "Register Student",
    body: $("#modal-login-part"),
    footerClass: "bg-whitesmoke",
    autoFocus: false,
    onFormSubmit: function (modal, e, form) {
        // Form Data
        let form_data = $(e.target).serialize();
        var accessToken = localStorage.getItem("access_token");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        console.log(form_data);
        
        $.ajax({
            type: "POST",
            url: "add-students", 
            data: form_data,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Authorization: "Bearer " + accessToken,
            },
            success: function (response) {
                form.stopProgress();
                modal
                    .find(".modal-body")
                    .prepend(
                        '<div class="alert alert-success">' +
                            response.msg +
                            "</div>"
                    );
                location.reload();
                updateStudentList(accessToken);
                // Close the modal (Optional)
                modal.modal("hide");
            },
            error: function (error) {
                form.stopProgress();
                modal
                    .find(".modal-body")
                    .prepend(
                        '<div class="alert alert-danger">Please fill up all inputs</div>'
                    );
                console.error("Error:", error);
            },
        });

        e.preventDefault();
    },
    shown: function (modal, form) {
        console.log(form);
    },
    buttons: [
        {
            text: "Register",
            submit: true,
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {},
        },
    ],
});

function clearModalInputs() {
    // Replace "student-form" with the actual ID of your form
    $("#first_name").val("");
    $("#last_name").val("");
    $("#middle_name").val("");
}

function updateStudentList(accessToken) {
    // Fetch and replace the student list section
    $.ajax({
        type: "GET",
        url: "/get-student-list",
        headers: {
            Authorization: "Bearer " + accessToken,
        },
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
            console.log("Clearing input fields...");
            $("#first_name").val("");
            $("#last_name").val("");
            $("#middle_name").val("");
        },
        error: function (error) {
            console.error("Error fetching student list:", error);
        },
    });
}

$("#modal-6").fireModal({
    body: "<p>Now you can see something on the left side of the footer.</p>",
    created: function (modal) {
        modal
            .find(".modal-footer")
            .prepend(
                '<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>'
            );
    },
    buttons: [
        {
            text: "No Action",
            submit: true,
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {},
        },
    ],
});

$(".oh-my-modal").fireModal({
    title: "My Modal",
    body: "This is cool plugin!",
});
