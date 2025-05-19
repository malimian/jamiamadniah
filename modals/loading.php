<!-- Spinner Start -->
<div id="spinner-loader" class="d-none w-100 vh-100 position-fixed top-0 start-0 d-flex align-items-center justify-content-center" style="z-index: 1055;">
    <div class="spinner-grow text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<script type="text/javascript">
   function loader(show = true) {
    if (show) {
        $('#spinner-loader').removeClass('d-none');
    } else {
        $('#spinner-loader').addClass('d-none');
    }
}

</script>