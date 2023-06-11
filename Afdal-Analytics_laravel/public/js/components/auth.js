var left = (screen.width / 2 - 225);
var top = (screen.height / 2 - 350);

$('#googleAuth').click(e => {
    e.preventDefault();

    let auth_window = window.open(googleAuthUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
    let timer = setInterval(function () {
        if (auth_window.closed) {
            clearInterval(timer);
            redirectAfterAuth();
        }
    }, 500);
})
$('#linkedIn').click(e => {
    e.preventDefault();

    let auth_window = window.open(linkedInAuthUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
    let timer = setInterval(function () {
        if (auth_window.closed) {
            clearInterval(timer);
            redirectAfterAuth();
        }
    }, 500);
})
$('#apple').click(e => {
    e.preventDefault();
    let auth_window = window.open(appleAuthUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
    let timer = setInterval(function () {
        if (auth_window.closed) {
            clearInterval(timer);
            redirectAfterAuth();
        }
    }, 500);
})

function redirectAfterAuth() {
    let url = window.location.origin;
    $.ajax({
        url: url + '/get-process',
        success: res => {
            console.log(res);
            if (res.process == 'login') {
                window.location.href = url + '/dashboard';
            }
            else if(res.process == 'signup'){
                window.location.href = url + '/demo-dashboard';
            }
        }
    })
}
