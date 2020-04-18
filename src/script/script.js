
function getLatestReviews() {
    $.ajax({
        type: 'POST',
        url: '../src/php/ajax/getLatestReviews.php',
        success: function (response) {
            JSON.parse(response).forEach(
                element => console.log(createReviewBracket(element.author, element.authorTitle, element.content))
            );
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
            JSON.parse(response).forEach(
                element => container.appendChild(
                    createReviewBracket(element.author, element.authorTitle, element.content)
                )
            );
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}

// TODO: Unit Test missing
/**
 *
 * @param author - contains the author's name
 * @param authorTitle - contains the position of the author
 * @param content - contains string content of the review
 * @returns {HTMLDivElement}
 */
function createReviewBracket(author, authorTitle, content) {
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
    img.classList.add('rounded-circle');
    img.src = 'assets/img/2020-04-03 14_06_50-Window.png'; // TODO: IMG SOURCE
    //
    let name = document.createElement('h5');
    name.classList.add('name');
    name.innerText = author;
    //
    let title = document.createElement('p');
    title.classList.add('title');
    title.innerText = authorTitle;

    wrapperDiv.appendChild(boxDiv);
    boxDiv.appendChild(description);
    wrapperDiv.appendChild(authorDiv);
    authorDiv.appendChild(img);
    authorDiv.appendChild(name);
    authorDiv.appendChild(title);

    return wrapperDiv;
}