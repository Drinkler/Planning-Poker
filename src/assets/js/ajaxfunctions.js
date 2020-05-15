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
    thDescription.innerHTML = "Title";
    thead.appendChild(thTitle);
    thead.appendChild(thDescription);
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
                    tdTitle.innerHTML = element["title"];
                    tdDescription.innerHTML = element["body"];
                    tr.appendChild(tdTitle);
                    tr.appendChild(tdDescription);
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
