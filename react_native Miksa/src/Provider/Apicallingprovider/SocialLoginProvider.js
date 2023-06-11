import React, { Component } from 'react'
import { Alert } from 'react-native'
import { CommonActions } from '@react-navigation/native';
// import { appleAuth, AppleButton } from '@invertase/react-native-apple-authentication';
import { msgProvider, msgText, msgTitle, config, localStorage, apifuntion, Lang_chg, consolepro, notification, firebaseprovider } from '../utilslib/Utils'
import { GoogleSignin, GoogleSigninButton, statusCodes, } from 'react-native-google-signin';
import { LoginManager, AccessToken, GraphRequest, GraphRequestManager, } from 'react-native-fbsdk'
global.navigatefunction = '';
class SocialLoginProvider extends Component {
    constructor(props) {
        super(props);
        GoogleSignin.configure({
            webClientId: '403745672953-q276rh17g4vkbcu7nea181jgctfa0t4p.apps.googleusercontent.com',

        });
    }
    goCustomerHomePage = (navigation) => {
        navigation.dispatch(
            CommonActions.reset({
                index: 1,
                routes: [
                    { name: 'Home_customer' },
                ],
            })
        );
    }
    goProviderHomePage = (navigation) => {
        navigation.dispatch(
            CommonActions.reset({
                index: 1,
                routes: [
                    { name: 'Home_p' },
                ],
            })
        );
    }

    Socialfunction = async (navigation, social_type, type) => {

        if (type == 'normal') {
            var social_type = social_type;
            var login_type = social_type;
            var social_id = '001942.7f1a8d2b59354833977cc59e439459a3.0507';
            var social_name = 'UploadingApp';
            var social_first_name = 'UploadingApp';
            var social_middle_name = '';
            var social_last_name = 'YoungDecade';
            var social_email = 'uploadingapp.youngdecade@gmail.com';
            // var social_image_url = 'img/no_image_found.png';
            var social_image_url = 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=200';
            var result = {
                social_id: social_id,
                social_type: social_type,
                login_type: login_type,
                social_name: social_name,
                social_first_name: social_first_name,
                social_last_name: social_last_name,
                social_middle_name: social_middle_name,
                social_email: social_email,
                social_image: social_image_url,
            }
            this.callsocailweb(result, navigation)
        }
        else {
            if (social_type == 1) {//for facebook------------
                this.faceBookLogin(navigation)
            }
            else if (social_type == 2) {//for google-------------
                this.GoogleLogin(navigation)
            }
            else if (social_type == 5) {//for apple-------------
                this.Applelogin(navigation)
            }
        }
    }

    /////////////////////////FACEBOOK LOGIN//////////////////////////////////
    faceBookLogin = async (navigation) => {

        navigatefunction = navigation;
        LoginManager.logInWithPermissions([
            'public_profile', "email"
        ]).then((result) => {
            if (result.isCancelled) {
                // console.log('Login cancelled');
            } else {
                AccessToken.getCurrentAccessToken().then(data => {
                    const processRequest = new GraphRequest(
                        '/me?fields=id,name,email,first_name,middle_name,last_name,picture.type(large)',
                        null,
                        this.get_Response_Info
                    );
                    new GraphRequestManager().addRequest(processRequest).start();
                });
            }
        })
    }

    get_Response_Info = (error, result) => {
        if (error) {
            Alert.alert('Error fetching data: ' + error.toString());
        } else {
            var socaildata = {
                'social_id': result.id,
                'social_name': result.name,
                'social_first_name': result.first_name,
                'social_last_name': result.last_name,
                'social_middle_name': '',
                'social_email': result.email,
                'social_image': result.picture.data.url,
                'social_type': 1,
                'login_type': 1,
            }
            this.callsocailweb(socaildata, navigatefunction)
        }
    };

    /////////////////////////GOOGLE LOGIN//////////////////////////////////
    GoogleLogin = async (navigation) => {
        try {
            await GoogleSignin.hasPlayServices({
                showPlayServicesUpdateDialog: true,
            });
            const userInfo = await GoogleSignin.signIn();
            console.log('User Info --> ', userInfo);
            var result = {
                'social_name': userInfo.user.name,
                'social_first_name': userInfo.user.givenName,
                'social_last_name': userInfo.user.familyName,
                'social_email': userInfo.user.email,
                'social_image': userInfo.user.photo,
                'social_type': 2,
                'login_type': 2,
                'social_id': userInfo.user.id
            }
            // alert(JSON.stringify(result))
            this.callsocailweb(result, navigation)

        } catch (error) {
            // alert('Message'+error.message)
            console.log('Message', error.message);
            if (error.code === statusCodes.SIGN_IN_CANCELLED) {
                console.log('User Cancelled the Login Flow');
            } else if (error.code === statusCodes.IN_PROGRESS) {
                console.log('Signing In');
            } else if (error.code === statusCodes.PLAY_SERVICES_NOT_AVAILABLE) {
                console.log('Play Services Not Available or Outdated');
            } else {
                console.log('Some Other Error Happened');
            }
        }
    }
    /////////////////////////APPLE LOGIN//////////////////////////////////
    Applelogin = async (navigation) => {
        await appleAuth.performRequest({
            requestedOperation: appleAuth.Operation.LOGIN,
            requestedScopes: [appleAuth.Scope.EMAIL, appleAuth.Scope.FULL_NAME]
        }).then(
            res => {
                var result = {
                    'social_name': res.fullName.familyName,
                    'social_first_name': res.fullName.givenName,
                    'social_last_name': res.fullName.familyName,
                    'social_email': res.email,
                    'social_image': 'NA',
                    'social_type': 'apple',
                    'login_type': 'apple',
                    'social_id': userInfo.user
                }
                this.callsocailweb(result, navigation)
            },
            error => {
                console.log(error);
            }
        );
    }

    callsocailweb = (result, navigation) => {

        console.log('callsocailweb result', result)
        console.log('result', navigation)
        var data = new FormData();
        data.append("social_email", result.social_email);
        data.append("social_id", result.social_id);
        data.append("device_type", config.device_type);
        data.append("player_id", player_id_me1);
        data.append("social_type", result.social_type);
        localStorage.setItemObject('socialdata', result);
        var url = config.baseURL + 'social_login.php';
        console.log('home', data)
        console.log('url', url);
        apifuntion.postApi(url, data).then((obj) => {
            console.log(obj);
            if (obj.success == 'true') {
                if (obj.user_exist == 'yes') {
                    let user_details = obj.user_details;
                    var user_id = user_details.user_id;
                    var mobile = user_details.mobile;
                    var signup_step = user_details.signup_step;
                    var login_type = user_details.login_type;
                    var user_type = user_details.user_type;

                    if (user_type == 1) {
                        if (signup_step == 0) {
                            navigation.navigate('Login');
                        }
                        if (signup_step == 1) {
                            localStorage.setItemString('user_type', user_type.toString());
                            localStorage.setItemString('user_id', JSON.stringify(user_id));
                            localStorage.setItemObject('user_arr', user_details);
                            firebaseprovider.firebaseUserCreate();
                            firebaseprovider.getMyInboxAllData();
                            setTimeout(() => {
                                this.goCustomerHomePage(navigation);
                            }, 800);
                        }
                    }
                    if (user_type == 2) {
                        if (signup_step == 0) {
                            navigation.navigate('Login')
                        }
                        if (signup_step == 1) {
                            localStorage.setItemString('user_type', user_type.toString());
                            localStorage.setItemString('user_id', JSON.stringify(user_id));
                            navigation.navigate('Bank_dt');
                        }
                        if (signup_step == 2) {
                            localStorage.setItemString('user_type', user_type.toString());
                            localStorage.setItemString('user_id', JSON.stringify(user_id));
                            navigation.navigate('House_profile');
                        }
                        if (signup_step == 3) {
                            localStorage.setItemString('user_type', user_type.toString());
                            localStorage.setItemString('user_id', JSON.stringify(user_id));
                            navigation.navigate('Select_service_p');
                        }
                        if (signup_step == 4) {
                            localStorage.setItemString('user_type', user_type.toString());
                            localStorage.setItemString('user_id', JSON.stringify(user_id));
                            navigation.navigate('House_sketch');
                        }
                        if (signup_step == 5) {
                            localStorage.setItemString('user_type', user_type.toString());
                            localStorage.setItemString('user_id', JSON.stringify(user_id));
                            navigation.navigate('Bio');
                        }
                        if (signup_step == 6) {
                            localStorage.setItemString('user_type', user_type.toString());
                            localStorage.setItemString('user_id', JSON.stringify(user_id));
                            navigation.navigate('Upload_covid');
                        }
                        if (signup_step == 7) {
                            localStorage.setItemString('user_id', JSON.stringify(user_id));
                            localStorage.setItemObject('user_arr', user_details);
                            localStorage.setItemString('mobile', mobile.toString());
                            localStorage.setItemString('user_type', user_type.toString());
                            consolepro.consolelog('LLLLL')
                            firebaseprovider.firebaseUserCreate();
                            firebaseprovider.getMyInboxAllData();
                            this.goProviderHomePage(navigation);
                        }
                    }

                }
                else {
                    navigation.navigate('Signup');
                }
            } else {
                if (obj.account_active_status == "deactivate") {
                    config.checkUserDeactivate(navigation);
                    return false;
                }
                msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                return false;
            }
        }).catch((error) => {
            console.log("-------- error ------- " + error);
            if (error == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
        });
    }
}


export const SocialLogin = new SocialLoginProvider();
