// ajax.js

function thumbUpIcon(question_id, user_id , like_id_status) {

    if(like_id_status != null){
        // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Specify the request type, URL, and asynchronous flag
    xhr.open('POST', 'ServerSend/thumb_up_up.php', true);

    // Set the request header to send data as form-urlencoded
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define a callback function to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response, if needed
            console.log(xhr.responseText);
            const obj = JSON.parse(xhr.responseText);
            console.log(obj);
            if(obj.status == 'already_liked'){
                console.log('already liked');
            }
            else if(obj.status == 'success'){
                console.log(obj.q_id);
                $(`#thumbup_${obj.q_id}`).css('color', 'blue');
                $(`#thumbdown_${obj.q_id}`).css('color', '#000');
            }
            // {"status":"success","q_id":4,"u_id":35}
            // {"status":"already_liked","already_liked":true}
        }
    };

    // Prepare the data to be sent
    var data = 'question_id=' + question_id + '&user_id=' + user_id + '&like_id=' + like_id_status;

    // Send the request with the data
    xhr.send(data);
    }

    else {
        // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Specify the request type, URL, and asynchronous flag
    xhr.open('POST', 'ServerSend/thumb_up.php', true);

    // Set the request header to send data as form-urlencoded
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define a callback function to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response, if needed
            console.log(xhr.responseText);
            const obj = JSON.parse(xhr.responseText);
            console.log(obj);
            if(obj.status == 'already_liked'){
                console.log('already liked');
            }
            else if(obj.status == 'success'){
                console.log(obj.q_id);
                $(`#thumbup_${obj.q_id}`).css('color', 'blue');
                $(`#thumbdown_${obj.q_id}`).css('color', '#000');
            }
            // {"status":"success","q_id":4,"u_id":35}
            // {"status":"already_liked","already_liked":true}
        }
    };

    // Prepare the data to be sent
    var data = 'question_id=' + question_id + '&user_id=' + user_id;

    // Send the request with the data
    xhr.send(data);
    }
    
}




function thumbDownIcon(question_id, user_id , like_id_status) {

    

    if(like_id_status != null){
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Specify the request type, URL, and asynchronous flag
    xhr.open('POST', 'ServerSend/thumb_down_up.php', true);

    // Set the request header to send data as form-urlencoded
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define a callback function to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response, if needed
            console.log(xhr.responseText);
            const obj = JSON.parse(xhr.responseText);
            console.log(obj);
            if(obj.status == 'already_liked'){
                console.log('already downed');
            }
            else if(obj.status == 'success'){
                console.log(obj.q_id);
                $(`#thumbup_${obj.q_id}`).css('color', '#000');
                $(`#thumbdown_${obj.q_id}`).css('color', 'blue');
            }
            // {"status":"success","q_id":4,"u_id":35}
            // {"status":"already_liked","already_liked":true}
        }
    };

    // Prepare the data to be sent
    var data = 'question_id=' + question_id + '&user_id=' + user_id  + '&like_id=' + like_id_status;

    // Send the request with the data
    xhr.send(data);
}
else {
        // Create an XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Specify the request type, URL, and asynchronous flag
        xhr.open('POST', 'ServerSend/thumb_down.php', true);
    
        // Set the request header to send data as form-urlencoded
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
        // Define a callback function to handle the response
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response, if needed
                console.log(xhr.responseText);
                const obj = JSON.parse(xhr.responseText);
                console.log(obj);
                if(obj.status == 'already_liked'){
                    console.log('already downed');
                }
                else if(obj.status == 'success'){
                    console.log(obj.q_id);
                    $(`#thumbup_${obj.q_id}`).css('color', '#000');
                    $(`#thumbdown_${obj.q_id}`).css('color', 'blue');
                }
                // {"status":"success","q_id":4,"u_id":35}
                // {"status":"already_liked","already_liked":true}
            }
        };
    
        // Prepare the data to be sent
        var data = 'question_id=' + question_id + '&user_id=' + user_id;
    
        // Send the request with the data
        xhr.send(data);
}
}


