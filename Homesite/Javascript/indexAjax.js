// console.log('user_id:', encrypted_user_id);



function setStarColor(question_id, starredQuestions) {
    var starIconSpan = document.getElementById('starIcon_' + question_id).getElementsByTagName('span')[0];
    if (starredQuestions.includes(question_id)) {
        starIconSpan.style.color = 'blue';
    } else {
        starIconSpan.style.color = 'initial';
    }
}

function toggleStarred(question_id) {
    var xhrCheck = new XMLHttpRequest();
    xhrCheck.open('POST', 'ServerSend/starredsend.php', true);
    xhrCheck.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhrCheck.onreadystatechange = function () {
        if (xhrCheck.readyState == 4 && xhrCheck.status == 200) {
            var response = JSON.parse(xhrCheck.responseText);
            if (response.error) {
                console.error(response.error);
            } else {
                toggleStar(question_id);
            }
        }
    };

    var paramsCheck = 'user_id=' +encrypted_user_id + '&question_id=' + question_id + '&check=true';
    xhrCheck.send(paramsCheck);
}

function toggleStar(question_id) {
    var starIconSpan = document.getElementById('starIcon_' + question_id).getElementsByTagName('span')[0];
    starIconSpan.style.color = 'blue';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ServerSend/starredsend.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   

    var params = 'user_id=' + encrypted_user_id + '&question_id=' + question_id + '&clicked=true';
    xhr.send(params);
}

function toggleDropdown(containerId) {
    var dropdownContainer = document.getElementById(containerId);
    dropdownContainer.classList.toggle("show");
}

window.onclick = function (event) {
    if (!event.target.matches('.ellipsis-icon')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

var xhrStarred = new XMLHttpRequest();
xhrStarred.open('POST', 'ServerSend/starredreceived.php', true);
xhrStarred.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhrStarred.onreadystatechange = function () {
    if (xhrStarred.readyState == 4 && xhrStarred.status == 200) {
        var response = JSON.parse(xhrStarred.responseText);
        if (response.success) {
            var starredQuestions = response.starredQuestions;
            starredQuestions.forEach(function (question_id) {
                setStarColor(question_id, starredQuestions);
            });
        } else {
            console.error(response.error);
        }
    }
};

var paramsStarred = 'user_id=' +encrypted_user_id;
xhrStarred.send(paramsStarred);
