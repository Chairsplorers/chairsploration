function calculate(){
    var usernameCheck = /^[A-Za-z][0-9a-zA-Z]{5,9}$/;
    var passwordCheck = /(?=.*[A-Z])(?=.*\d)(?!.*[^a-zA-Z0-9]).{6,10}$/;
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
                    window.alert('Please enter a valid Username and Password');
    
                }
            }else{
                window.alert('Please enter a valid Username and Password');
    
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
        window.alert('Invalid Username or Password');
    }
}