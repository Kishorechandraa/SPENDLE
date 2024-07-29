const container = document.getElementById('container');
const signupBtn = document.getElementById('signup');
const loginBtn = document.getElementById('login');

signupBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

function validate_password() {
 
    let pass = document.getElementById('regPassword').value;
    let confirm_pass = document.getElementById('confirm_password').value;
    if (pass != confirm_pass) {
        document.getElementById('alert').style.color = 'red';
        document.getElementById('alert').innerHTML = 'X Use same password';
        document.getElementById('create').disabled = true;
        document.getElementById('create').style.opacity = (0.3);
    } else {
        document.getElementById('alert').style.color = 'green';
        document.getElementById('alert').innerHTML = '✔ Password Matched';
        document.getElementById('create').disabled = false;
        document.getElementById('create').style.opacity = (1);
        const id = Math.floor(Math.random() * 100000);
        document.getElementById('id').value = id;
    }
}

function log() {
    var pass = document.getElementById("logPassword");
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}

function reg() {
    var password = document.getElementById("regPassword");
    var confirm_password = document.getElementById("confirm_password");
    if (
        password.type === "password" ||
        confirm_password.type === "password"
    ) {
        password.type = "text";
        confirm_password.type = "text";
    } else {
        password.type = "password";
        confirm_password.type = "password";
    }
}