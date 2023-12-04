/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$("#login").on("click", function () {
    // Get form data

    var formData = {
        email: $("#email").val(),
        password: $("#password").val(),
        _token: $('meta[name="csrf-token"]').attr("content"),
    };

    console.log(formData);

    // Make AJAX request
    $.ajax({
        type: "POST",
        url: "login", // Replace with your actual login endpoint
        data: formData,
        success: function (response) {
            var accessToken = response.token;
            localStorage.setItem("access_token", accessToken);

            // Redirect to the admin dashboard or perform other actions
            window.location.href = "admin-dashboard";
        },
        error: function (xhr, status, error) {
            // Display error message
            var errorMessage = JSON.parse(xhr.responseText).message;
            $("#error-message").text(errorMessage);
        },
    });


});

// function fetchList(){

// }
