/**
 * Function for activation of stories
 * @param {HTMLButtonElement} element contains the html element
 * @param {int} storyId contains the lobby id
 * @author Luca Stanger
 * @access public
 */
function activateStory(element, storyId) {
    // create ajax call
    $.ajax({
        url: `../ajax/activateStory?story=${storyId}`,
        data: storyId,
        success: function () {
            // Get all 'green' buttons
            let previousButtons = document.getElementsByClassName("btn-success");
            // Iterate over all 'green' buttons and create initial class
            [].forEach.call(previousButtons, function (p) {
                p.classList.replace("btn-success", "btn-outline-primary");
                p.innerHTML = "Set Active";
            });
            // Change class of submitted element
            element.classList.replace("btn-outline-primary", "btn-success");
            // Change Test of submitted element
            element.innerHTML = "Active";
        },
        error: function() {
            console.log("Something went wrong :(")
        }
    })
}

function vote(element) {
    console.log(element);
    console.log(`../ajax/vote?value=${encodeURIComponent(element.innerText)}`);
    // create ajax call
    $.ajax({
        url: `../ajax/vote?value=${encodeURIComponent(element.innerText)}`,
        success: function () {
            console.log("In");
        },
        error: function () {
            console.log("Something went wrong :(")
        }
    })
}

/**
 * Get all stories from github
 * @repository
 * @username
 * @author Luca Stanger
 * @access public
 */
function fetchStoriesFromGitHub() {
    let navContent = document.getElementById("nav-github");
    let url = document.getElementById("githubInput").value;
    let username = url.split("/")[3];
    let repository = url.split("/")[4];
    let curlURL = `https://api.github.com/repos/${username}/${repository}/issues`;
    let storyTable = document.createElement("table");
    storyTable.className = "table";
    let thead = document.createElement("thead");
    let thTitle = document.createElement("th");
    thTitle.setAttribute("scope", "col");
    thTitle.innerHTML = "Title";
    let thDescription = document.createElement("th");
    thDescription.setAttribute("scope", "col");
    thDescription.innerHTML = "Description";
    let thButton = document.createElement("th");
    thButton.setAttribute("scope", "col");
    thButton.innerHTML = "";
    thead.appendChild(thTitle);
    thead.appendChild(thDescription);
    thead.appendChild(thButton);
    storyTable.appendChild(thead);
    let tBody = document.createElement("tbody");

    $.getJSON(curlURL, function (data) {
        data.forEach(element => {
            $.ajax({
                url: "../ajax/storeIssue",
                data: element,
                success: function () {
                    let tr = document.createElement("tr");
                    let tdTitle = document.createElement("td");
                    let tdDescription = document.createElement("td");
                    let tdButton = document.createElement("td");
                    let activationButton = document.createElement("button");
                    tdTitle.innerHTML = element["title"];
                    tdDescription.innerHTML = element["body"];
                    activationButton.innerHTML = "Set Active";
                    activationButton.className = "btn btn-outline-primary activate text-center";
                    activationButton.addEventListener("click", function () {
                        activateStory(this, element["id"])
                    });
                    tdButton.appendChild(activationButton);
                    tr.appendChild(tdTitle);
                    tr.appendChild(tdDescription);
                    tr.appendChild(tdButton);
                    tBody.appendChild(tr);
                },
                error: function () {
                    let tr = document.createElement("tr");
                    let tdTitle = document.createElement("td");
                    let tdDescription = document.createElement("td");
                    tdTitle.innerHTML = "Error";
                    tdDescription.innerHTML = "Error";
                    tr.appendChild(tdTitle);
                    tr.appendChild(tdDescription);
                    tBody.appendChild(tr);
                }
            })
        })
    })

    storyTable.appendChild(tBody);
    navContent.innerHTML = "";
    navContent.appendChild(storyTable);
}

/**
 *
 * @param idlobby
 * @author Luca Stanger
 * @access public
 */
function getParticipants(idlobby) {
    $.ajax({
        url: `../ajax/getParticipants?idlobby=${idlobby}`,
        data: idlobby,
        success: function (response) {
            let parts = document.getElementById("participants");
            parts.innerText = "";
            JSON.parse(response).forEach(entry => {
                // console.log(entry)
                let tr = document.createElement("tr");
                let tdName = document.createElement("td");
                let tdVote = document.createElement("td");
                let tdButton = document.createElement("td");
                // TODO: Refactor array index!!!!
                tdName.innerText = entry["\u0000PlanningPoker\\Model\\User\u0000_username"];
                tdVote.innerText = 0;
                let button = document.createElement("button");
                button.type = "button";
                button.className = "btn btn-danger";
                button.innerText = "Kick";
                tdButton.appendChild(button);
                tr.appendChild(tdName);
                tr.appendChild(tdVote);
                tr.appendChild(tdButton);
                parts.appendChild(tr);
            });
        }
    })
}

/**
 *
 * @param idlobby contains the lobby id
 * @author Luca Stanger
 * @access public
 */
function getCurrentActiveIssue(idlobby) {
    $.ajax({
        url: `../ajax/getCurrentIssue?idlobby=${idlobby}`,
        data: idlobby,
        success: function (response) {
            let titleElement = document.getElementById("title");
            let description = document.getElementById("description");
            JSON.parse(response).forEach(entry => {
                titleElement.innerText = entry["\u0000PlanningPoker\\Model\\Issue\u0000title"];
                description.innerText = entry["\u0000PlanningPoker\\Model\\Issue\u0000description"];
            })
        }
    })
}
