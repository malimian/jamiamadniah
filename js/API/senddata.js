var senddata = function (url, method, parameters, callback, failback) {
    loader(true); // Show loader before starting AJAX

    $.ajax({
        url: url,
        type: method,
        data: parameters
    })
    .done(function (result) {
        loader(false); // Hide loader on success
        callback(result);
    })
    .fail(function (result) {
        loader(false); // Hide loader on failure
        failback(result);
    });
}


var senddata_file = function (url, method, parameters, callback , failback) {

      $.ajax({
        url: url,
        type: method,
        data: parameters,
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,

    }).done(function (result) {
        callback(result);
    }).fail(function (result) {
        failback(result);
    })

}



