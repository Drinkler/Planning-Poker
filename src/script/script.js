function getLatestReviews() {
    $.ajax({
        type: 'POST',
        url: '../src/php/ajax/getLatestReviews.php',
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}