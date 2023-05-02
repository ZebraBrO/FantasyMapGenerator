var stateAuth;
var stateSignUp;


auth();

function auth() {
    stateSignUp = 0;
    if (stateAuth == null) {
        stateAuth = 1;
        document.getElementById("authForm").style.display = "none";
    }
    else if (stateAuth == 1) {
        stateAuth = 0;
        document.getElementById("authForm").style.display = "";
    }
    else if (stateAuth == 0) {
        stateAuth = 1;
        document.getElementById("authForm").style.display = "none";
    }
}

function signUp() {
    if (stateSignUp == 1) {
        stateSignUp = 0;
        document.getElementById("singIn").style.display = "";
    }
    else if (stateSignUp == 0) {
        stateSignUp = 1;
        document.getElementById("singIn").style.display = "none";
        document.getElementById("singIn").style.display = "flex";
    }
}