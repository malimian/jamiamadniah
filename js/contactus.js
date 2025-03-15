
$('#send_GNT').on("click", function() { 
    

    var GnTName_ = $('#GnTName').val();
    var GnTPhone_ = $('#GnTPhone').val();
    var GnTemail_ = $('#GnTemail').val();
    var GnTcomment_ = $('#GnTcomment').val();
    var GnTService_ = $('#GnTService').val();

    
    if(GnTName_ == ""){
            $('#GNT_status').empty().html("<div class=\"alert alert-danger\" role=\"alert\"> Please add your name </div>");
        return;
    }
    
    
        if(GnTPhone_ == ""){
            $('#GNT_status').empty().html("<div class=\"alert alert-danger\" role=\"alert\"> Please add your Phone number </div>");
        return;
    }
    
    
    if(GnTcomment_ == ""){
            $('#GNT_status').empty().html("<div class=\"alert alert-danger\" role=\"alert\"> Please add your Message </div>");
        return;
    }
    
    
    

    $.ajax({
        url: "post/contactus.php",
        data: {
            GnTName: GnTName_,
            GnTemail: GnTemail_,
            GnTPhone: GnTPhone_,
            GnTcomment: GnTcomment_,
            GnTService:GnTService_,
            send_GNT:true
        },
        type: "POST",
        success: function(data_) {

            console.log(data_);
            data_ = data_.replace(/ /g,'');
            
            if (data_ == "1") {

                $('#GNT_status').empty().html("<div class=\"alert alert-success\" role=\"alert\">Dear " + GnTName_ + " Your Request have been received </div>");

                $('#GnTName').val('');
                $('#GnTPhone').val('');
                $('#GnTemail').val('');
                $('#GnTcomment').val('');

            } else {
                $('#GNT_status').empty().html("<div class=\"alert alert-danger\" role=\"alert\"> Please Try Again </div>");
            }

        },
        error: function(data_) {

            console.log(data_);


        }
    });


});