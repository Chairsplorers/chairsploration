function calculate(){
    var usernameCheck = /^[A-Za-z][0-9a-zA-Z]{0,99}$/;
    var passwordCheck = /^[A-Za-z][0-9a-zA-Z]{5,99}$/;
    var username = document.information.username.value;
    var password = document.information.pass.value;
    var repassword = document.information.repass.value;
    var email = document.information.email.value;

    if(email.includes('@')){
        if (password == repassword){
            if(usernameCheck.test(username)){
                if(passwordCheck.test(password)){
                    window.alert('User Created');
                }else{
                    window.alert('Please make your password alphanumeric and between 6 and 100 characters inclusive.');
    
                }
            }else{
                window.alert('Please make your username alphanumeric and between 1 and 100 characters inclusive.');
    
            }
        }else{
            window.alert('Passwords do not match');
    
        }
    } else{
        window.alert('Please Enter a valid E-mail, Password, and Username');
    }
}
    


    

function login(){

    var username = document.information.username.value;
    var password = document.information.pass.value;
    if((password == 1) && (username == 1)){
        window.alert('logged in!');
    }else{
        window.alert('Invalid Username or Password. (not working yet, user:1 pass:1 is the only valid input)');
    }
}