
// POST FUNCTIONS

function postNewTask(userID, title, description, dueDate, reminder) {
    $.ajax({
        'url': 'https://us-central1-architecture-project-2017.cloudfunctions.net/task/new',
        'type': 'POST',
        'data': {
            'uid': userID,
            'title': title,
            'description': description,
            'dueDate': dueDate,
            'reminder': reminder
        },
        'success': function (data) {
            if (data == "success") {
                alert('Task created successfully!');
            }
        }
    });
}
function postEditTask(userID, title, description, dueDate, reminder) {
    $.ajax({
        'url': 'https://us-central1-architecture-project-2017.cloudfunctions.net/task/edit',
        'type': 'POST',
        'data': {
            'uid': userID,
            'title': title,
            'description': description,
            'dueDate': dueDate,
            'reminder': reminder
        },
        'success': function (data) {
            if (data == "success") {
                alert('Task updated successfully!');
            }
        }
    });
}

function postDeleteTask(userID, taskID) {
    $.ajax({
        'url': 'https://us-central1-architecture-project-2017.cloudfunctions.net/task/delete',
        'type': 'POST',
        'data': {
            'uid': userID,
            'tid': taskID,
        },
        'success': function (data) {
            if (data == "success") {
                alert('Task deleted successfully!');
            }
        }
    });
}
function postCompleteTask(userID, taskID) {
    $.ajax({
        'url': 'https://us-central1-architecture-project-2017.cloudfunctions.net/task/complete',
        'type': 'POST',
        'data': {
            'uid': userID,
            'tid': taskID,
        },
        'success': function (data) {
            if (data == "success") {
                alert('Task marked completed successfully!');
            }
        }
    });
}


// GET FUNCTIONS

function getTasksDueToday(userID) {
    $.ajax({
        'url': 'https://us-central1-architecture-project-2017.cloudfunctions.net/task/dueToday?uid="' + userID + '"',
        'type': 'GET',
        'data': {
        },
        'success': function (data) {
            if (data == "success") {
                alert('request sent!');
            }
        }
    });
}
function getDelayedTasks(userID) {
    $.ajax({
        'url': 'https://us-central1-architecture-project-2017.cloudfunctions.net/task/delayed?uid="' + userID + '"',
        'type': 'GET',
        'data': {
        },
        'success': function (data) {
            if (data == "success") {
                alert('request sent!');
            }
        }
    });
}
function getAllTasks(userID) {
    $.ajax({
        'dataType' : 'json',
        'url': 'https://us-central1-architecture-project-2017.cloudfunctions.net/task/all?uid=' + userID,
        'type': 'GET',
        error: function(returnval) {
            console.log("Error: " + returnval)
        },
        success: function (returnval) {
            console.log("Success: " + returnval)
        }
    });
}
