import React, { Component } from 'react'
import { View, Image, StyleSheet, StatusBar, SafeAreaView, Text } from 'react-native'
import { CommonActions } from '@react-navigation/native';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, firebaseprovider } from './Provider/utilslib/Utils';
import OneSignal from 'react-native-onesignal';
import { LoginManager } from 'react-native-fbsdk'
import { GoogleSignin } from 'react-native-google-signin';
export default class Splash extends Component {
    constructor(props) {
        super(props);
        this.state = {
            loading: false,
            player_id: '123456',
        }
        OneSignal.init(config.onesignalappid, {
            kOSSettingsKeyAutoPrompt: true,
        });
        OneSignal.setLogLevel(6, 0);
    }

    goCustomerHomePage = () => {
        this.props.navigation.dispatch(
            CommonActions.reset({
                index: 1,
                routes: [
                    { name: 'Home_customer' },
                ],
            })
        );
    }
    goProviderHomePage = () => {
        this.props.navigation.dispatch(
            CommonActions.reset({
                index: 1,
                routes: [
                    { name: 'Home_p' },
                ],
            })
        );
    }

    componentDidMount() {
        this.props.navigation.addListener('focus', () => {
            this.getLiveStatus()
        });
        OneSignal.setLocationShared(true);
        OneSignal.inFocusDisplaying(2);
        OneSignal.addEventListener('ids', this.onIds.bind(this));
        const timer = setTimeout(() => {
            this.authenticateSession();
        }, 4000);
        return () => clearTimeout(timer);
    }

    componentWillUnmount() {
        OneSignal.removeEventListener('ids', this.onIds.bind(this));
    }
    getLiveStatus = () => {
        var url = config.baseURL + 'get_live_status.php?user_id=54565';
        apifuntion.getApi(url, 1).then((obj) => {
            if (obj.success == 'true') {
                if (obj.live_status == 'yes') {
                    config.live_status = obj.live_status;
                } else {
                    config.live_status = obj.live_status;
                }
                consolepro.consolelog('Live status', obj.live_status);
            }
        }).catch(err => {
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
            console.log('err', err);
        });
    }
    onIds(device) {
        console.log('Device info: ', device);
        this.setState({
            player_id: device.userId
        });
        config.player_id_me = device.userId;
        config.player_id_me = device.userId;
        config.player_id_me1 = device.userId;
        config.GetPlayeridfunctin(device.userId)
    }
    // authenticateSession = async () => {
    //     this.props.navigation.navigate('Login')
    // }

    authenticateSession = async () => {
        //this.props.navigation.navigate('Login');
        let result = await localStorage.getItemObject('user_arr');
        consolepro.consolelog('splash data', result);
        if (result != null) {
            let mobile = result.mobile;
            let user_type = result.user_type;
            if (result.login_type == 0) {
                let pass = await localStorage.getItemString('password');
                this._loginBTN(mobile, pass, 0, user_type);
            }
            if (result.login_type == 1) {
                this._loginBTN(mobile, null, 1, user_type);
            }
            if (result.login_type == 2) {
                this._loginBTN(mobile, null, 2, user_type);
            }
        } else {
            this.props.navigation.navigate('Login')
        }
    }

    _loginBTN = (mobile, password, login_type, user_type) => {
        let url = config.baseURL + 'login.php';
        var data = new FormData();
        data.append("mobile", mobile);
        data.append("phone_code", 593);
        data.append("login_type", login_type);
        data.append("password", password);
        data.append("language_id", config.language);
        data.append("device_type", config.device_type);
        data.append("player_id", this.state.player_id);
        data.append("action_type", 'auto_login');
        data.append("user_type", user_type)
        //api calling-----------------    
        apifuntion.postNoLoadingApi(url, data).then((obj) => {
            consolepro.consolelog('login data', obj);
            if (obj.success == 'true') {
                var user_arr = obj.user_details;
                let user_type = user_arr.user_type;
                let login_type = user_arr.login_type;
                let signup_step = user_arr.signup_step;
                let user_id = user_arr.user_id;
                if (user_type == 1) {
                    if (signup_step == 0) {
                        this.props.navigation.navigate('Login');
                    }
                    if (signup_step == 1) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        localStorage.setItemObject('user_arr', user_arr);
                        firebaseprovider.firebaseUserCreate();
                        firebaseprovider.getMyInboxAllData();
                        setTimeout(() => {
                            this.goCustomerHomePage();
                        }, 800);
                    }
                }
                if (user_type == 2) {

                    if (signup_step == 0) {
                        this.props.navigation.navigate('Login')
                    }
                    if (signup_step == 1) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.props.navigation.navigate('Bank_dt');
                    }
                    if (signup_step == 2) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.props.navigation.navigate('House_profile');
                    }
                    if (signup_step == 3) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.props.navigation.navigate('Select_service_p');
                    }
                    if (signup_step == 4) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.props.navigation.navigate('House_sketch');
                    }
                    if (signup_step == 5) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.props.navigation.navigate('Bio');
                    }
                    if (signup_step == 6) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.props.navigation.navigate('Upload_covid');
                    }
                    if (signup_step == 7) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        localStorage.setItemObject('user_arr', user_arr);
                        firebaseprovider.firebaseUserCreate();
                        firebaseprovider.getMyInboxAllData();
                        this.goProviderHomePage();
                    }
                }
            } else {
                if (obj.account_active_status == "deactivate") {
                    config.checkUserDeactivate(this.props.navigation);
                    return false;
                }

                this.props.navigation.navigate('Login')
            }
        }).catch(err => {
            console.log('err', err);
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
                this.props.navigation.navigate('Login')
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
                this.props.navigation.navigate('Login')
            }
        });
    }



    render() {
        return (
            <View style={styles.splashContainer}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar barStyle='light-content' backgroundColor={"#0088e0"} hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                <View style={styles.container}>
                    <View
                        style={styles.splashLogoo}
                    >
                        <Image
                            style={{ height: 150, width: 150 }}
                            source={require('../src/icons/logo.png')} />
                    </View>
                </View>
                <View style={{ position: 'absolute', bottom: 0, width: '100%', backgroundColor: 'green' }}>
                    <Text>skdjlgjl</Text>
                </View>
            </View>
        )
    }
}

const styles = StyleSheet.create({

    splashContainer: {
        flex: 1,
        backgroundColor: "#0088e0",
        alignItems: "center",
        justifyContent: 'center',
        marginBottom: -20,
    },
    splashLogoo: {
        width: '100%',
        height: '100%',
        justifyContent: 'center',
        alignItems: 'center',
    },
});