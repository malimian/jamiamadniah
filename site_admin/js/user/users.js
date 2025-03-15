
$('.js-switch').on("change", function(){
  var id = $(this).data("id");
   
     senddata(
                'post/user/users.php' ,
                 "POST" ,
                {id:id , change_status:true} ,
               function(result){ console.log(result);} ,
              function(result){  console.log(result);}   
            );

if(!$(this).is(':checked')){
  $('#status_'+id).removeClass().addClass('badge badge-danger').html('In Active');
} 
else  {
$('#status_'+id).removeClass().addClass('badge badge-success').html('Active');
}

});


 $('[type="checkbox"]').click(function(e) {
   var isChecked = $(this).is(":checked");
   console.log('isChecked: ' + isChecked);
 });


    searchdatatable('dataTable');

