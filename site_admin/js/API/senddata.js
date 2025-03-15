var senddata = function (url, method, parameters, callback , failback) {

    waitingDialog.show();

      $.ajax({
        url: url,
        type: method,
        data: parameters
    
    }).done(function (result) {
        waitingDialog.hide();
        callback(result);
    }).fail(function (result) {
        waitingDialog.hide();
        failback(result);
    })

}


var senddata_file = function (url, method, parameters, callback , failback) {

    waitingDialog.show();

      $.ajax({
        url: url,
        type: method,
        data: parameters,
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,

    }).done(function (result) {
        waitingDialog.hide();
        callback(result);
    }).fail(function (result) {
        waitingDialog.hide();
        failback(result);
    })

}



