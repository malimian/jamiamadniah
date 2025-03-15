<style>
    .floatwthsapp{
    position:fixed;
    width:60px;
    height:60px;
    bottom:140px;
    right:40px;
    background-color:#25d366;
    color:#FFF;
    border-radius:50px;
    text-align:center;
    font-size:39px;
    box-shadow: 2px 2px 3px #999;
    z-index:100;
}

.floatwthsapp-float{
    margin-top:16px;
}
</style>

<a href="https://api.whatsapp.com/send?phone=<?php echo $number?>&text=<?php echo $text?>" class="floatwthsapp" target="_blank">
    <i class="bi bi-whatsapp floatwthsapp-float"></i>
</a>