function fetchParticipants() {
    $.ajax({
        type: 'POST',
        url: '../assets/script/fetchParticipants.php',
        data: {
        },
        success: function (response) {
            console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {

        }
    })
}

