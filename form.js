$(document).ready(function () {
    $('#admissionForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'submit_form.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert('Form submitted successfully!');
                $('#admissionForm')[0].reset();
            },
            error: function (response) {
                alert('There was an error submitting the form.');
            }
        });
    });
});
