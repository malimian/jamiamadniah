// $('#modal_open').on('click', function() {
//     $('section').css('filter', 'blur(5px)');

// });


// $('#myModal').on('hidden.bs.modal', function() {
//     $('section').css('filter', '');
// })


$('#get_consult_btn').click(function() {

    var services = [];

    $.each($(".services_chk:checked"), function() {
        services.push($(this).val());
    });


    $.ajax({

        url: "post/consulatation.php",
        type: "POST",
        data: {
            Name_consult_: $('#Name_consult').val(),
            Email_consult_: $('#Email_consult').val(),
            Phone_consult_: $('#Phone_consult').val(),
            services_: services,
            submit: true
        },
        success:function(success) {

            console.log(success);

            $('#consult_status').empty().html("<div class=\"alert alert-success\" role=\"alert\">Dear " + $('#Name_consult').val() + " Your Request have been received </div>");

            $('#Name_consult').val('');
            $('#Email_consult').val('');
            $('#Phone_consult').val('');


        },
        error:function(faliure) {

            console.log(faliure);

        }




    });




});



$('#send_GNT').on("click", function() {
    var GnTName = $('#GnTName').val();
    var GnTemail = $('#GnTemail').val();
    var GnTPhone = $('#GnTPhone').val();
    var GnTcomment = $('#GnTcomment').val();

    $.ajax({
        url: "post/gnt_mail.php",
        data: {
            GnTName_: GnTName,
            GnTemail_: GnTemail,
            GnTPhone_: GnTPhone,
            GnTcomment_: GnTcomment
        },
        type: "POST",
        success: function(data) {

            console.log(data);
            if (data == "1") {

                $('#GNT_status').empty().html("<div class=\"alert alert-success\" role=\"alert\">Dear " + GnTName + " Your Request have been received </div>");

                $('#GnTName').val('');
                $('#GnTemail').val('');
                $('#GnTPhone').val('');
                $('#GnTcomment').val('');

            } else {
                $('#GNT_status').empty().html("<div class=\"alert alert-danger\" role=\"alert\"> Please Try Again </div>");
            }

        },
        error: function(data) {

            console.log(data);


        }
    });


});