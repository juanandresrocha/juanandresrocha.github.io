// POST SERVICES

function postNewAccount(email, password, name, birthday) {
    console.log("Posting new account...");
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
            if (data == "success") {
                alert('Account created successfully!');
            }
        }
    });
}