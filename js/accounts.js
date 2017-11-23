// POST SERVICE

function postNewAccount(email, password, name, birthday) {
    console.log("Posting new account...");
    console.log("Email: " + email + "\n Password: " + password + "\n Name: " + name + "\n Birthday: " + birthday);
    $.ajax({
        'url': 'http://10.43.45.86:8080/userms/NewUser',
        'type': 'POST',
        'data': {
            'email': email,
            'password': password,
            'name': name,
            'birthday': birthday
        },
        'success': function (data) {
            $.cookie("uid", data);
            console.log("Success");
        },
        'error': function (data) {
            console.log("Error");
            console.log(data);
        }
    });
}

function postLoginUser(email, password) {
    console.log("Posting new account...");
    console.log("Email: " + email + "\n Password: " + password);
    $.ajax({
        'url': 'http://10.43.45.86:8080/userms/LoginUser',
        'type': 'POST',
        'data': {
            'email': email,
            'password': password
        },
        'success': function (data) {
            console.log("Success");
            console.log(data);
            $.cookie("uid", data);

        },
        'error': function (data) {
            console.log("Error");
            console.log(data);
        }
    });
}