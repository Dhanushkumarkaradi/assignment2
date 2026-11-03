
$(document).ready(function () {

    // SHOW OR HIDE CUSTOM INPUT FIELDS

    function handleOther(selectId, inputId, otherValues) {

        $(selectId).on("change", function () {

            const selectedValue = $(this).val();
            const showInput = otherValues.includes(selectedValue);

            $(inputId).prop("hidden", !showInput);
            $(inputId).prop("required", showInput);

            if (!showInput) {
                $(inputId).val("");
            }
        });
    }

    handleOther("#college", "#college_other", ["Other College"]);
    handleOther("#course", "#course_other", ["Other"]);
    handleOther("#branch", "#branch_other", ["Other"]);


    // FORM VALIDATION

    $("#registrationForm").on("submit", function (event) {

        const name = $("#fullname").val().trim();
        const email = $("#email").val().trim();
        const phone = $("#phone").val().trim();
        const dob = $("#dob").val();

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (name.length < 3) {
            alert("Please enter your full name (at least 3 characters).");
            event.preventDefault();
            return;
        }

        if (!emailPattern.test(email)) {
            alert("Please enter a valid email address.");
            event.preventDefault();
            return;
        }

        if (!/^[0-9]{10}$/.test(phone)) {
            alert("Please enter a valid 10-digit phone number.");
            event.preventDefault();
            return;
        }

        if (!dob || new Date(dob) > new Date()) {
            alert("Please enter a valid date of birth.");
            event.preventDefault();
            return;
        }

        if ($("#college").val() === "Other College" &&
            !$("#college_other").val().trim()) {
            alert("Please enter your college name.");
            event.preventDefault();
            return;
        }

        if ($("#course").val() === "Other" &&
            !$("#course_other").val().trim()) {
            alert("Please enter your course or degree.");
            event.preventDefault();
            return;
        }

        if ($("#branch").val() === "Other" &&
            !$("#branch_other").val().trim()) {
            alert("Please enter your branch or specialisation.");
            event.preventDefault();
            return;
        }

        if (!$("#course").val() || !$("#branch").val()) {
            alert("Please select your course and branch.");
            event.preventDefault();
            return;
        }

        if (!$("#terms").is(":checked")) {
            alert("Please confirm the information provided.");
            event.preventDefault();
            return;
        }

        alert("Your registration form is being submitted!");

    });


    // RESET CUSTOM INPUT FIELDS

    $("#registrationForm").on("reset", function () {

        setTimeout(function () {

            $(".other-input")
                .prop("hidden", true)
                .prop("required", false)
                .val("");

        }, 0);

    });

});
