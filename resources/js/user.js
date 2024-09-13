$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    console.log('User Load confirmation')
   });

window.update_test = () => {
    $.ajax({
        url: 'api/update_password',
        type: 'POST',
        data: {
            'old_password': 'newpass',
            'new_password': 'password',
            'new_password_confirmation': 'password'
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
            if (response.status === 'success'){ 
                console.log('trigger test');
                window.location.href = response.redirect;
            }
            
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
    let name = "Random Name";
    let account_type = 'Admin';
    console.log(username);
    console.log(password);

    $.ajax({
        url: 'api/add_user',
        type: 'POST',
        data: {
            'name' : name,
            'email' : username,
            'password' : password,
            'account_type': account_type,
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