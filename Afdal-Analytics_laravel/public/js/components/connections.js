let facebookUrl = '';
let facebookAdsUrl = '';
let twitterUrl = '';
let instagramUrl = '';
let googleAnalyticsUrl = '';
let googleAdsUrl = '';
let ifFbConnected = false;
let ifInstConnected = false;
let ifTwitterConnected = false;
let ifGoogleConnected = false;

window.fbAsyncInit = function () {
    FB.init({
        appId: '335732804788324',
        cookie: true,
        xfbml: true,
        version: 'v12.0'
    });
};

$(document).ready(() => {
    var connections = $('.connections-block .connection');
    if (ifFbConnected) {
        $('#facebook label').css({'cursor': 'default'});
    }
    connections.each(function (){
        $(this).click(function() {
            let id = $(this).attr('id');
            switch (id){
                case 'facebook': fb_login();break;
                case 'instagram': instagram_login();break;
                case 'twitter': twitter_login();break;
            }
        });
    });
})

function toggleLoader(loaderStatus) {
    const loader = document.querySelector('.loader');
    if (loaderStatus) {
        loader.removeAttribute('hidden');
    } else {
        loader.setAttribute('hidden', '');
    };
};

const list = document.querySelector('.connections-list');
let currentActive = 'facebook';

if (list) {
    for (let item of list.children) {
        item.addEventListener('click', selectHandler)
    };
}

function selectHandler(event) {
    for (let item of list.children) {
        item.children[0].classList.add('hide-element');
    };

    event.currentTarget.children[0].classList.remove('hide-element');
    currentActive = event.currentTarget.id;
};

function fb_login() {
    if (!ifFbConnected) {
        FB.login(function (response) {
            if (response.authResponse) {
                access_token = response.authResponse.accessToken;
                user_id = response.authResponse.userID;
                $.ajax({
                    url: facebookUrl,
                    method: "post",
                    data: {
                        _token: $('meta[name="_token"]').attr('content'),
                        id: user_id,
                        token: access_token,
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        toggleLoader(true);
                    },
                    success: (response) => {
                        toggleLoader(false);
                        if (window.location.pathname === '/signup/step-2') {
                            window.location.href = `${window.location.origin}/signup/step-3`;
                        } else if (window.location.pathname === '/signup/step-4') {
                            $('#facebook').html(() => {
                                let check = '<div class="connections-block__picked-icon"></div>';
                                return check + $('#facebook').html();
                            })
                        }
                    },
                    error: () => {
                        toggleLoader(false);
                        show_notification("error", "Something went wrong.");
                    }
                })
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {
            scope: 'ads_read, pages_manage_cta, email, read_insights, ads_management, pages_show_list, pages_read_engagement, pages_read_user_content, public_profile, read_insights',
        });
    }
}

function twitter_login() {
    if (!ifTwitterConnected) {
        var left = (screen.width / 2 - 225) ;
        var top = (screen.height / 2 - 350) ;
        window.open(twitterUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
    }
}

function googleAnalyticsLogin() {
    if (!ifGoogleConnected) {
        var left = (screen.width / 2 - 225) ;
        var top = (screen.height / 2 - 350) ;
        window.open(googleAnalyticsUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
    }
}

function googleAdsLogin() {
    if (!ifGoogleConnected) {
        var left = (screen.width / 2 - 225) ;
        var top = (screen.height / 2 - 350) ;
        window.open(googleAdsUrl, '_blank', `menubar=0,height=600,width=450,top=${top},left=${left}`);
    }
}

function instagram_login() {
    if (!ifInstConnected) {
        FB.login(function (response) {
            if (response.authResponse) {
                access_token = response.authResponse.accessToken;
                user_id = response.authResponse.userID;
                $.ajax({
                    url: instagramUrl,
                    method: "post",
                    data: {
                        _token: $('meta[name="_token"]').attr('content'),
                        id: user_id,
                        token: access_token,
                    },
                    beforeSend: function () {
                        toggleLoader(true);
                    },
                    dataType: 'json',
                    success: (response) => {
                        toggleLoader(false);
                        if (window.location.pathname === '/signup/step-2') {
                            window.location.href = `${window.location.origin}/signup/step-4`;
                        } else if (window.location.pathname === '/signup/step-4') {
                            $('#instagram').html(() => {
                                let check = '<div class="connections-block__picked-icon"></div>';
                                return check + $('#instagram').html();
                            })
                        }
                    },
                    error: () => {
                        toggleLoader(false);
                        show_notification("error", "Something went wrong.");
                    }
                })
            } else {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {
            scope: 'email,  public_profile, instagram_basic, instagram_manage_insights, pages_show_list, pages_read_engagement',
        });
    }
}

function facebook_ads_login() {
    FB.login(function (response) {
        if (response.authResponse) {
            console.log(response);
            access_token = response.authResponse.accessToken;
            user_id = response.authResponse.userID;
            // $.ajax({
            //     url: facebookAdsUrl,
            //     method: "post",
            //     data: {
            //     _token: $('meta[name="_token"]').attr('content'),
            //         id: user_id,
            //         token: access_token,
            //     },
            //     dataType: 'json',
            //         success: (response) => {
            //         window.location.href = '{{url('/instagram/overview')}}'
            //     },
            //         error: () => {
            //         show_notification("error", "Something went wrong.");
            //     }
            // })
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {
        scope: 'email,  public_profile, ads_management,ads_read',
    });
}

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
