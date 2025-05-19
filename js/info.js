        
         senddata('get/desc/info.php',
                  "POST",
                  {

                    pageid:pageid

                  },
                  function(result_sucess) {
                  
       
                   // console.log(result_sucess);

                   var obj = JSON.parse(result_sucess);

                    $('#div_content').empty().html(obj.page_desc);


                      },
                        function(result_fail) {
                        
                         console.log(result_fail);

                        }
              );