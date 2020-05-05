
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
            let tr = document.createElement("tr");
            let tdTitle = document.createElement("td");
            let tdDescription = document.createElement("td");
            tdTitle.innerHTML = element["title"];
            tdDescription.innerHTML = element["body"];
            tr.appendChild(tdTitle);
            tr.appendChild(tdDescription);
            tBody.appendChild(tr);
        })
    })

    storyTable.appendChild(tBody);
    navContent.innerHTML = "";
    navContent.appendChild(storyTable);
}
