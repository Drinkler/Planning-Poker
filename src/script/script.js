class Review {
    constructor(username, content) {
        this.username = username;
        this.content = content;
    }

    getUsername() {
        return this.username;
    }

    getContent() {
        return this.content;
    }
}

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

function createReviewRows() {
    let container = document.getElementById('reviewContainer');

    $.ajax({
        type: 'POST',
        url: '../src/php/ajax/getLatestReviews.php',
        success: function (response) {
            for (let resp in response) {

            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

function createReviewBracket(author, authorTitle, content) {
    //<div class="col-md-6 col-lg-4 item">
    //    <div class="box">
    //      <p class="description">Super Tool! Hilft uns beim Planen unserer User-Storys immer wieder aufs neue!</p>
    //    </div>
    //    <div class="author"><img class="rounded-circle" src="assets/img/1.jpg">
    //      <h5 class="name">Ben Johnson</h5>
    //      <p class="title">CEO von camos Software &amp; Beratung GmbH.</p>
    //    </div>
    //</div>
    let wrapperDiv = document.createElement('div');
    wrapperDiv.classList.add('col-md-6', 'col-lg-4', 'item');
    //
    let boxDiv = document.createElement('div');
    boxDiv.classList.add('box');
    //
    let description = document.createElement('p');
    description.classList.add('description');
    description.innerText = content;
    //
    let authorDiv = document.createElement('div');
    authorDiv.classList.add('author');
    //
    let img = document.createElement('img');
    //
    let name = document.createElement('h5');
    name.classList.add('name');
    name.innerText = author;
    //
    let title = document.createElement('p');
    title.classList.add('title');
    title.innerText = authorTitle;

    wrapperDiv.appendChild(boxDiv);
    wrapperDiv.appendChild()


}