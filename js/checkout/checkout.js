$(document).ready(function () {

    $('#submit_btn').click(function (e) {
        e.preventDefault();

        var payment_method = $('#payment_method').children("option:selected").val();
        var tx_id = $('#tx_id').val();
        var amount_sent = $('#amount_sent').val();
        var username_dh = $('#username_dh').val();
        var useremail_dh = $('#user_email').val();
        var userphoneno_dh = $('#userphoneno_dh').val();
        var order_id = $('#order_id').val(); // Ensure this input exists
        var file_data = $('#files').prop('files')[0];

        var form_data = new FormData();
        form_data.append('order_id', order_id);
        form_data.append('file', file_data);
        form_data.append('payment_method', payment_method);
        form_data.append('tx_id', tx_id);
        form_data.append('amount_sent', amount_sent);
        form_data.append('username_dh', username_dh);
        form_data.append('useremail_dh', useremail_dh);
        form_data.append('userphoneno_dh', userphoneno_dh);
        form_data.append('submit_order', true);

        senddata_file('post/checkout.php', "POST", form_data,
            function (result) {

                $("#error_id").fadeIn(300).delay(1500);

                if (result > 0) {
                    $('#error_id').empty().html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Thanks,</strong> Your Order has been placed.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`);

                    location.reload();
                    // Or: location.href = "thankyou.php?order_id=" + order_id;

                } else {
                    $('#error_id').empty().html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Alert!</strong> Something went wrong. Try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`);
                }
            },
            function (result) {
                console.log('failure', result);
                $('#error_id').empty().html(`
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Alert!</strong> Something went wrong. Double-check and try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`).fadeIn(300).delay(3000).fadeOut(500);
            }
        );
    });

});
