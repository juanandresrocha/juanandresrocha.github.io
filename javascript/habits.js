
// POST SERVICES

function postNewHabit(userID, habitName, habitDifficulty) {
    $.ajax({
        'url': 'http://67.205.133.19/habit/' + userID + '/new',
        'type': 'POST',
        'data': {
            'uid': userID,
            'name': habitName,
            'difficulty': habitDifficulty
        },
        'success': function (data) {
            if (data == "success") {
                alert('Habit created successfully!');
            }
        }
    });
}

function postEditHabit(userID, habitID, habitName, habitDifficulty, habitScore, habitRange) {
    $.ajax({
        'url': 'http://67.205.133.19/habit/update/' + userID + '/' + habitID,
        'type': 'POST',
        'data': {
            'userID': userID,
            'id': habitID,
            'name': habitName,
            'difficulty': habitDifficulty,
            'score': habitScore,
            'range': habitRange
        },
        'success': function (data) {
            if (data == "success") {
                alert('Habit updated successfully!');
            }
        }
    });
}

function postDeleteTask(userID, taskID) {
    $.ajax({
        'url': 'http://67.205.133.19/habit/delete/' + userID + '/' + habitID,
        'type': 'POST',
        'data': {
            'uid': userID,
            'tid': habitID,
        },
        'success': function (data) {
            if (data == "success") {
                alert('Habit deleted successfully!');
            }
        }
    });
}

function postCompleteTask(userID, taskID) {
    $.ajax({
        'url': 'http://67.205.133.19/habit/',
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

// GET SERVICE

function getHabitsByUser(userID) {
    $.ajax({
        'dataType': 'json',
        'url': 'http://67.205.133.19/habit/' + userID,
        'type': 'GET',
        error: function (returnval) {
            console.log("Error: " + returnval)
        },
        success: function (returnval) {
            console.log("Success: " + JSON.stringify(returnval))
        }
    });
}
function getHabitByID(userID, habitID) {
    $.ajax({
        'dataType': 'json',
        'url': 'http://67.205.133.19/habit/' + userID + '/' + habitID,
        'type': 'GET',
        error: function (returnval) {
            console.log("Error: " + returnval)
        },
        success: function (returnval) {
            console.log("Success: " + JSON.stringify(returnval))
        }
    });
}


// ADMIN GET SERVICES


function getHabitsPerRange() {
    $.ajax({
        'dataType': 'json',
        'url': 'http://67.205.133.19/admin/habits/perRange',
        'type': 'GET',
        error: function (returnval) {
            console.log("Error: " + returnval)
        },
        success: function (returnval) {
            console.log("Success: " + JSON.stringify(returnval))
        }
    });
}

function getWorstHabits() {
    $.ajax({
        'dataType': 'json',
        'url': 'http://67.205.133.19/admin/habits/getWorst',
        'type': 'GET',
        error: function (returnval) {
            console.log("Error: " + returnval)
        },
        success: function (returnval) {
            console.log("Success: " + JSON.stringify(returnval))
        }
    });
}

function getHighestHabits() {
    $.ajax({
        'dataType': 'json',
        'url': 'http://67.205.133.19/admin/habits/getHighest',
        'type': 'GET',
        error: function (returnval) {
            console.log("Error: " + returnval)
        },
        success: function (returnval) {
            console.log("Success: " + JSON.stringify(returnval))
        }
    });
}
