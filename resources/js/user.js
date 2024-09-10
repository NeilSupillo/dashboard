$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    console.log('User Load confirmation')
   });

window.login = () => {
    console.log('Request made.');
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    console.log(username);
    console.log(password);

    $.ajax({
        url: 'api/login',
        type: 'POST',
        data: {
            'email' : username,
            'password' : password,
        },
        success:function(response){
            console.log(response);
        },
        error:function (code, status, error){
            console.log(code);
            console.log(status);
            console.log(error);
            var errors = code.responseJSON.errors;
            console.log(errors);

        }
    });
}

window.register = () => {
    console.log('Request made.');
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    let name = "Random Name"
    console.log(username);
    console.log(password);

    $.ajax({
        url: 'api/register',
        type: 'POST',
        data: {
            'name' : name,
            'email' : username,
            'password' : password
        },
        success:function(response){
            let response_test = response;

            console.log(response_test.message);
        },
        error:function (code, status, error){

            console.log(code);
            console.log(status);
            console.log(error);
        }
    });

}