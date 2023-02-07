var state;
function auth() {
    if (state == null) {
        state = 1;
        document.getElementById("authForm").style.display = "none";
    }
    else if (state == 1) {
        state = 0;
        document.getElementById("authForm").style.display = "";
    }
    else if (state == 0) {
        state = 1;
        document.getElementById("authForm").style.display = "none";
    }
}

