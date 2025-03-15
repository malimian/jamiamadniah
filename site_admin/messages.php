<?php include 'includes/header.php';?>

<body id="page-top">

     <?php include 'setting/company_name.php';?>

     <?php include 'includes/navbar_search.php';?>

      <?php include 'includes/notification.php';?>
   

  <div id="wrapper">

  <?php include'includes/sidebar.php'; ?>
    
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo $_SESSION['user']['dashboard'];?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Blank Page</li>
        </ol>

        <!-- Page Content -->
        <h1>Blank Page</h1>
        <hr>
<style type="text/css">
    .chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
    font-size: larger;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 433px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}


</style>

<script type="text/javascript">

var message_id = 0;

var sid = <?php echo $_GET['sid'];?>;
var fid = <?php echo $_GET['fid'];?>;
var isStudent = 1;


function reload_chat(){

$.get("sms_service.php?sid="+sid+"&fid="+fid+"&sms_id="+message_id+"&show_message" , function(data, status){

    var obj = JSON.parse(data);
    console.log(obj);

    var html ="";

    for (i = 0; i < obj['sms'].length - 1 ; i++) {
    
        html +='  <li class="right clearfix">';
        html +='   <div class="chat-body clearfix">';
        html +='<div class="header">';
        html +='<small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'+obj['sms'][i].sms_time+'</small>';

        html +='</div>';
        html +='<p>'+obj['sms'][i].message+'</p>';
        html +='</div>';
        html +='</li>';

        message_id = obj['sms'][i].sms_id;

    }
    
    $('#chat_system').append(html);

  });

}


window.setInterval(function(){
  /// call your function here

  reload_chat();


}, 500);

</script>

      <div class="container-fluid">
    <div class="row">
        <div class="container-fluid">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                </div>
                <div class="panel-body">
                    <ul class="chat" id="chat_system">
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat">
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
$('#btn-chat').on('click' , function(){


    var message = $('#btn-input').val();


    $.get("sms_service.php?sid="+sid+"&fid="+fid+"&insert_message&message="+encodeURI(message) , 

        function(data, status){

            $('#btn-input').val('');

    });



});
</script>        
      </div>
      <!-- /.container-fluid -->

         <?php include 'includes/footer_copyright.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

 <?php //include 'modals.php';?>
 <?php include 'includes/footer.php';?>
