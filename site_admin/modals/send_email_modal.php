<style>
.emclick {
width: 16%;
float: right;
margin-top: 11px;
}

.closeemclick{
    width: 16%;
    float: left;
    margin-top: 11px; 
}
</style>
<!-- SEND_EMAIL_MODAL START-->
<div class="modal fade" id="modal_send_email">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body">
                    <div class="modal-body" style="padding: 5px;">
                          <div id="modal_email_result"></div>
                                <form action="" onsubmit="return form_email_send()">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                        <select class="form-control" name="modal_email_type" id="modal_email_type" required >
                                            <option value="1">Empty HTML Email</option>
                                            <option value="2">Default Template Email</option>
                                            <option value="3">txt Email</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                        <input class="form-control" name="modal_email" id="modal_email" placeholder="E-mail" type="text" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                        <input class="form-control" name="subject" id="modal_subject"  placeholder="Subject" type="text" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <textarea class="form-control"  style="width: 100%; height: 200px;" id="modal_message" placeholder="Message..." name="comment" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 addemailclick">
                                        <button class="form-control btn btn-primary emclick" name="send_modal_email_btn" id="send_modal_email_btn">Send Email</button>
                                        <button class="form-control btn btn-danger closeemclick" data-dismiss="modal" >Close</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>  
        </div>
        
      </div>
    </div>
  </div>
<!-- SEND_EMAIL_MODAL END -->


<script>
    
    $(window).on('load', function (){
        
            CKEDITOR.replace( 'modal_message' );
            CKEDITOR.config.fullPage = false;
            CKEDITOR.config.resize_enabled = false;
            CKEDITOR.config.removePlugins = 'resize,autogrow';
    });


    
    function send_email(to , subject , message , email_type = 0){
        
        email_type = email_type || 0;

        if(email_type != 0){
             
             $('#modal_email_type option[value="'+email_type+'"] ').attr("selected", "selected");

        }
        
        $('#modal_email').val(to);
        $('#modal_subject').val(subject);
      
          CKEDITOR.instances.modal_message.setData(message);
      
        $('#modal_send_email').modal('toggle');
        
    }
    
    
    
    
 function form_email_send(){


     var modal_email = $('#modal_email').val();              
     var modal_subject = $('#modal_subject').val();
     var modal_email_type = $('#modal_email_type').val();
     var message = CKEDITOR.instances['modal_message'].getData();
     
        
    senddata
    ('post/email/post_email.php' ,"POST", {
        to_email:modal_email,
        subject:modal_subject,
        message:message,
        email_type:modal_email_type,
        submit_btn:true
    },
    function(result){
     
      console.log(result);
     
     if(result == 1){
        $('#modal_email_result').empty().html('<div class="alert alert-success alert-dismissible fade show" role="alert"> Email Sent <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>');
     }
      
    },function(result){
      
      console.log('faliure');
      console.log(result);
      
    });

    
    return false;
        
        
}
    
</script>