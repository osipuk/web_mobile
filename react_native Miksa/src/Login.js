import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, Image, ScrollView, BackHandler, Modal, TouchableOpacity, Keyboard, TextInput, Alert } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import Banner from "./Banner";
import { CommonActions } from '@react-navigation/native';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, validationprovider, SocialLogin, Currentltlg, notification, firebaseprovider } from './Provider/utilslib/Utils';
import OneSignal from 'react-native-onesignal';
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
export default class Login extends Component {
    _didFocusSubscription;
    _willBlurSubscription;
    constructor(props) {
        super(props)
        this.state = {
            remember_me: false,
            isConnected: true,
            HidePassword: true,
            mobile_no: '',
            password: '',
            player_id: '123456',
            otppopup: false,
            minutes_Counter: '01',
            seconds_Counter: '59',
            startDisable: false,
            timer: null,
            otp: '',
            user_id: 0,
            live_status: 'no',
        }
        this._didFocusSubscription = props.navigation.addListener('focus', payload =>
            BackHandler.addEventListener('hardwareBackPress', this.handleBackPress)
        );
        OneSignal.init(config.onesignalappid, {
            kOSSettingsKeyAutoPrompt: true,
        });
        OneSignal.setLogLevel(6, 0);
    }

    componentDidMount() {
        // this.getcurrentlatlogn();
        this.checkRememberMe();
        OneSignal.setLocationShared(true);
        OneSignal.inFocusDisplaying(2);
        OneSignal.addEventListener('ids', this.onIds.bind(this));
        this.checkSocsialData();
        this.focusListener = this.props.navigation.addListener('focus', () => {
            this.checkSocsialData();
        });
        this._willBlurSubscription = this.props.navigation.addListener('blur', payload =>
            BackHandler.removeEventListener('hardwareBackPress', this.handleBackPress)
        );
    }

    checkSocsialData = async () => {
        var socialdata = await localStorage.getItemObject('socialdata');
        if (socialdata != null) {
            consolepro.consolelog('social--', socialdata);
            let social_type = socialdata.social_type;
            config.AppLogoutSplash(this.props.navigation, social_type)
        }
    }

    // localStorage.removeItem('socialdata')

    componentWillUnmount() {

        OneSignal.removeEventListener('ids', this.onIds.bind(this));
    }


    getcurrentlatlogn = async () => {
        let data = await Currentltlg.requestLocation()
        let latitude = data.coords.latitude;
        let longitude = data.coords.longitude;
        config.latitude = latitude;
        config.longitude = longitude;
    }

    onIds(device) {
        console.log('Device info: ', device);
        this.setState({
            player_id: device.userId
        });
        config.player_id_me = device.userId;
    }
    handleBackPress = () => {
        Alert.alert(
            Lang_chg.titleexitapp[config.language],
            Lang_chg.exitappmessage[config.language], [{
                text: Lang_chg.No[config.language],
                onPress: () => console.log('Cancel Pressed'),
                style: Lang_chg.cancel[config.language],
            }, {
                text: Lang_chg.Yes[config.language],
                onPress: () => BackHandler.exitApp()
            }], {
            cancelable: false
        }
        ); // works best when the goBack is async
        return true;
    };

    checkRememberMe = async () => {
        var remember_me = await localStorage.getItemString('remember_me');
        consolepro.consolelog('rememberme', remember_me);
        if (remember_me == 'yes') {
            let mobile = await localStorage.getItemString('mobile');
            let password = await localStorage.getItemString('password');
            consolepro.consolelog('mobile123123', mobile);
            consolepro.consolelog('password', password);
            this.setState({
                mobile_no: mobile,
                password: password,
                remember_me: true,
            });
        }
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

    Otpveryfication = () => {
        Keyboard.dismiss()
        var user_id = this.state.user_id;
        var otp = this.state.otp;
        if (otp.length <= 0) {
            msgProvider.alert(Lang_chg.information[config.language], 'We have sent you a One Time Password to the email details provided.Please check and enter the code to complete registration', false);
            return false
        }

        var data = new FormData();
        data.append("user_id_post", user_id);
        data.append("user_otp", otp);
        data.append("player_id", 123456);
        data.append("device_type", config.device_type)
        data.append("user_type", this.state.user_type);
        this.setState({ loading: true })
        console.log('otp', data)
        var url = config.baseURL + 'otp_verify.php';
        apifuntion.postApi(url, data).then((obj) => {
            console.log('otp veri fy', obj)
            if (obj.success == 'true') {
                var user_arr = obj.user_details;
                var user_type = user_arr.user_type;
                var signup_step = user_arr.signup_step;
                var user_id = user_arr.user_id;
                var mobile = user_arr.mobile;
                var otp = user_arr.otp;
                if (user_type == 1) {
                    if (signup_step == 0) {
                        this.setState({
                            otppopup: true,
                            user_id: user_id,
                            otp: otp,
                        })
                        this.onButtonStart();
                    }
                    if (signup_step == 1) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        localStorage.setItemObject('user_arr', user_arr);
                        this.setState({ otppopup: false })
                        firebaseprovider.firebaseUserCreate();
                        firebaseprovider.getMyInboxAllData();
                        if (obj.notification_arr != 'NA') {
                            notification.oneSignalNotificationSendCall(obj.notification_arr)
                        }
                        setTimeout(() => {
                            this.goCustomerHomePage();
                        }, 800);
                    }
                }
                if (user_type == 2) {
                    if (signup_step == 0) {
                        this.setState({ otppopup: true, user_id: user_id, mobile_no: mobile, otp: otp })
                        this.onButtonStart();
                    }
                    if (signup_step == 1) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('Bank_dt');
                    }
                    if (signup_step == 2) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('House_profile');
                    }
                    if (signup_step == 3) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('Select_service_p');
                    }
                    if (signup_step == 4) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('House_sketch');
                    }
                    if (signup_step == 5) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('Bio');
                    }
                    if (signup_step == 6) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('Upload_covid');
                    }
                    if (signup_step == 7) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        localStorage.setItemObject('user_arr', user_arr);
                        this.setState({ otppopup: false })
                        firebaseprovider.firebaseUserCreate();
                        firebaseprovider.getMyInboxAllData();
                        this.goProviderHomePage();
                    }
                }

            } else {
                setTimeout(() => {
                    if (obj.account_active_status == "deactivate") {
                        config.checkUserDeactivate(this.props.navigation);
                        return false;
                    }
                    msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                    return false;
                }, 600);
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

    Resendotpbtn = () => {
        Keyboard.dismiss()
        var user_id = this.state.user_id;
        clearInterval(this.state.timer);
        this.setState({
            timer: null,
            minutes_Counter: '01',
            seconds_Counter: '59',
            startDisable: false
        })

        var data = new FormData();
        data.append("user_id_post", user_id);
        var url = config.baseURL + 'resend_otp.php';
        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('Resend otp', obj);
            if (obj.success == 'true') {
                var user_arr = obj.user_details;
                let user_id = user_arr.user_id;
                let otp = user_arr.otp;
                this.setState({
                    otp: otp,
                    user_id: user_id,
                })
                this.onButtonStart();
            } else {
                setTimeout(() => {
                    if (obj.account_active_status == "deactivate") {
                        config.checkUserDeactivate(this.props.navigation);
                        return false;
                    }
                    msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                    return false;
                }, 600);
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

    onButtonStart = () => {
        let timer = setInterval(() => {
            if (this.state.minutes_Counter == '00' && this.state.seconds_Counter == '01') {
                this.onButtonStop()
            }
            var num = (Number(this.state.seconds_Counter) - 1).toString(),
                count = this.state.minutes_Counter;
            if ((this.state.seconds_Counter) == '00') {
                count = (Number(this.state.minutes_Counter) - 1).toString();
                num = 59
            }
            if (count != -1) {
                this.setState({
                    minutes_Counter: count.length == 1 ? '0' + count : count,
                    seconds_Counter: num.length == 1 ? '0' + num : num
                });
            }
            else {
                this.onButtonStop()
            }
        }, 1000);
        this.setState({ timer });
        this.setState({ startDisable: true })
    }

    onButtonStop = () => {
        clearInterval(this.state.timer);
        this.setState({ startDisable: false })
    }

    _loginBtn = async () => {
        Keyboard.dismiss()
        this.textinput.clear();
        let { mobile_no, password, player_id, user_id } = this.state;

        // mobile_no=====================
        if (mobile_no.length <= 0) {
            msgProvider.toast(Lang_chg.emptyMobile[config.language], 'center')
            return false
        }
        if (mobile_no.length < 8) {
            msgProvider.toast(Lang_chg.MobileMinLength[config.language], 'center')
            return false
        }
        if (mobile_no.length > 12) {
            msgProvider.toast(Lang_chg.MobileMaxLength[config.language], 'center')
            return false
        }

        if (await validationprovider.digitCheck(mobile_no) != true) {
            msgProvider.toast(Lang_chg.validMobile[config.language], 'center')
            return false
        }


        //password===================
        if (password.length <= 0) {
            msgProvider.toast(Lang_chg.emptyPassword[config.language], 'center')
            return false
        }
        if (password.length <= 5) {
            msgProvider.toast(Lang_chg.PasswordMinLength[config.language], 'center')
            return false
        }
        if (password.length > 16) {
            msgProvider.toast(Lang_chg.PasswordMaxLength[config.language], 'center')
            return false
        }


        var data = new FormData();
        data.append('mobile', mobile_no)
        data.append('password', password)
        data.append("action_type", 'normal_login')
        data.append("player_id", player_id)
        data.append("device_type", config.device_type)
        data.append("phone_code", 593)
        data.append("login_type", 0)
        data.append("user_id_post", user_id)
        consolepro.consolelog('data', data);
        let url = config.baseURL + "login.php";
        consolepro.consolelog('login data', url);
        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('login data', obj);
            if (obj.success == 'true') {

                var user_arr = obj.user_details;
                var user_type = user_arr.user_type;
                var mobile = user_arr.mobile;
                var signup_step = user_arr.signup_step;
                var user_id = user_arr.user_id;
                var otp = user_arr.otp;
                this.setState({ password: '', mobile_no: '' })
                if (this.state.remember_me) {
                    localStorage.setItemString('remember_me', 'yes');
                } else {
                    localStorage.setItemString('remember_me', 'no');
                }

                consolepro.consolelog('password', password);
                consolepro.consolelog('mobile', mobile);
                localStorage.setItemString('password', password);
                localStorage.setItemString('mobile', this.state.mobile_no.toString());

                if (user_type == 1) {
                    if (signup_step == 0) {
                        const timer = setTimeout(() => {
                            this.setState({
                                otppopup: true,
                                user_id: user_id,
                                mobile_no: mobile_no,
                                otp: otp,
                            })
                            this.onButtonStart();
                        }, 1000);
                        return () => clearTimeout(timer);
                    }
                    if (signup_step == 1) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        localStorage.setItemObject('user_arr', user_arr);
                        this.setState({ otppopup: false })
                        if (obj.notification_arr != 'NA') {
                            notification.oneSignalNotificationSendCall(obj.notification_arr)
                        }
                        setTimeout(() => {
                            this.goCustomerHomePage();
                        }, 800);
                    }
                }
                if (user_type == 2) {
                    if (signup_step == 0) {
                        const timer = setTimeout(() => {
                            this.setState({
                                otppopup: true,
                                user_id: user_id,
                                mobile_no: mobile_no,
                                otp: otp,
                            })
                            this.onButtonStart();
                        }, 500);
                        return () => clearTimeout(timer);
                    }
                    if (signup_step == 1) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        firebaseprovider.firebaseUserCreate();
                        firebaseprovider.getMyInboxAllData();
                        if (obj.notification_arr != 'NA') {
                            notification.oneSignalNotificationSendCall(obj.notification_arr)
                        }
                        this.props.navigation.navigate('Bank_dt');
                    }
                    if (signup_step == 2) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('House_profile');
                    }
                    if (signup_step == 3) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('Select_service_p');
                    }
                    if (signup_step == 4) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('House_sketch');
                    }
                    if (signup_step == 5) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('Bio');
                    }
                    if (signup_step == 6) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
                        this.props.navigation.navigate('Upload_covid');
                    }
                    if (signup_step == 7) {
                        if (obj.notification_arr != 'NA') {
                            notification.oneSignalNotificationSendCall(obj.notification_arr)
                        }
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        localStorage.setItemObject('user_arr', user_arr);
                        this.setState({ otppopup: false })
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
                setTimeout(() => {
                    msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                }, 900);
                return false;
            }
        }).catch(err => {
            console.log('err', err);
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
        });
    }




    FacebookLogin = (navigation) => {
        SocialLogin.Socialfunction(navigation, 1, 'fb');
    }
    GoogleLogin = (navigation) => {
        SocialLogin.Socialfunction(navigation, 2, 'google');
    }
    AppleLogin = (navigation) => {
        SocialLogin.Socialfunction(navigation, 5, 'apple');
    }



    render() {
        return (
            <View style={{ flex: 1, height: '100%', width: '100%', backgroundColor: '#fff' }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: color1.theme_color }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />

                <KeyboardAwareScrollView showsVerticalScrollIndicator={false}>
                    <Banner />
                    {/* start otp pop up */}
                    <Modal
                        animationType="slide"
                        transparent
                        visible={this.state.otppopup}
                        onRequestClose={() => {
                        }}>
                        <View
                            style={{
                                flex: 1,
                                backgroundColor: '#00000090',
                                alignItems: 'center',
                                justifyContent: 'center',
                                borderRadius: 0,
                            }}>

                            <View style={{ backgroundColor: "#ffffff", width: '90%', borderRadius: 15, }}>
                                <View style={{ marginHorizontal: 15 }}>
                                    <Text style={styles.otptitle}>{Lang_chg.otp_verification[config.language]}</Text>
                                    <Text style={styles.optTxt}>{Lang_chg.otp_verification1[config.language]}
                                        {"\n"}<Text style={{ color: '#0088e0' }} onPress={() => { this.setState({ otppopup: false, timer: null, minutes_Counter: '01', seconds_Counter: '59', startDisable: false }); clearInterval(this.state.timer); }}> {Lang_chg.txt_edit[config.language]} </Text>{Lang_chg.txt_mobile_no[config.language]} : +{config.phone_code} {this.state.mobile_no}</Text>

                                </View>
                                <View style={styles.OtpInput}>
                                    <TextInput
                                        style={styles.otpInpoutType}
                                        placeholder={Lang_chg.txt_otp[config.language]}
                                        maxLength={6}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        value={this.state.otp.toString()}
                                        keyboardType='number-pad'
                                        returnKeyLabel='done'
                                        returnKeyType='done'
                                        onChangeText={(txt) => { this.setState({ otp: txt }) }}
                                    />
                                </View>

                                <View style={styles.verifyBox}>
                                    {this.state.startDisable == true && <View style={[styles.resendboxLeft, { flexDirection: 'row', alignItems: 'center', color: "red" }]}>
                                        <Text style={{ color: "red" }}>{this.state.minutes_Counter}</Text>
                                        <Text style={{ color: "red" }}>:</Text>
                                        <Text style={{ color: "red" }}>{this.state.seconds_Counter}</Text>
                                    </View>}
                                    {this.state.startDisable == false &&
                                        <TouchableOpacity activeOpacity={0.9} style={styles.resendboxLeft} onPress={() => { this.Resendotpbtn() }}>
                                            <View>
                                                <Text style={{ color: "red" }}>{Lang_chg.txt_RESEND[config.language]}</Text>
                                            </View>
                                        </TouchableOpacity>
                                    }

                                    <TouchableOpacity onPress={() => { this.Otpveryfication() }} activeOpacity={0.9} style={styles.resendbox}>
                                        <View>
                                            <Text style={styles.OTpLeftverify}>{Lang_chg.txt_VERIFY[config.language]}</Text>
                                        </View>
                                    </TouchableOpacity>
                                </View>
                            </View>
                        </View>

                    </Modal>
                    {/* end otp pop up */}

                    <View style={styles.loginParent}>

                        <View style={styles.view_input}>
                            <View style={{ flexDirection: 'row', alignItems: 'center', justifyContent: 'space-around' }}>
                                <Image style={{ height: 18, width: 18 }} resizeMode="contain" source={require('./icons/call.png')}></Image>
                                <Text style={styles.textleft}>+593</Text>
                                <Image style={{ height: 18, width: 10, marginLeft: 4, tintColor: '#ccc' }} resizeMode="cover" source={require('./icons/vertical_line.png')}></Image>
                            </View>
                            <View style={styles.right_view}>
                                <TextInput
                                    style={styles.input_main}
                                    placeholder={Lang_chg.txt_mobile_no[config.language]}
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    keyboardType='phone-pad'
                                    maxLength={12}
                                    minLength={8}
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ mobile_no: txt }) }}
                                    value={this.state.mobile_no}
                                />
                            </View>
                        </View>

                        <View style={styles.view_input}>
                            <View style={styles.login_pass}>
                                <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/lock1.png')}></Image>
                            </View>
                            <View style={styles.right_view}>
                                <TextInput
                                    style={styles.input_main}
                                    placeholder={Lang_chg.txt_password[config.language]}
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    secureTextEntry={this.state.HidePassword}
                                    maxLength={16}
                                    minLength={6}
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ password: txt }) }}
                                    value={this.state.password}
                                />
                            </View>
                            <TouchableOpacity style={styles.passEye}
                                onPress={() => { this.setState({ HidePassword: !this.state.HidePassword }) }}
                            >
                                {
                                    this.state.HidePassword
                                        ?
                                        <Image style={styles.downArrow}
                                            source={require('./icons/eye.png')}
                                            resizeMode="contain"
                                        />
                                        :
                                        <Image style={styles.downArrow}
                                            source={require('./icons/eye_close.png')}
                                            resizeMode="contain"
                                        />

                                }
                            </TouchableOpacity>
                        </View>

                        <View style={styles.forgot_view}>
                            <View style={styles.forgot_left}>
                                <View style={{ paddingBottom: 15, paddingLeft: 0, paddingRight: 20 }}>
                                    <TouchableOpacity onPress={() => { this.setState({ remember_me: !this.state.remember_me }) }} activeOpacity={0.9}>
                                        <View style={{ flexDirection: 'row' }}>
                                            {this.state.remember_me == true &&
                                                <Image style={styles.login_email} resizeMode="contain" source={require('./icons/checkboxcheck.png')}></Image>
                                            }
                                            {this.state.remember_me == false &&
                                                <Image style={styles.login_email} resizeMode="contain" source={require('./icons/checkbox.png')}></Image>
                                            }
                                            <Text style={{ marginLeft: 10, color: '#848484', fontSize: 14, fontFamily: "Poppins-Regular", marginTop: 2 }}>{Lang_chg.txt_login_remember_me[config.language]}</Text>
                                        </View>
                                    </TouchableOpacity>
                                </View>
                            </View>

                            <View style={styles.forgot_right}>
                                <Text style={styles.forgot_txt} onPress={() => { this.props.navigation.navigate('Forgot') }}>
                                    {Lang_chg.txt_login_forgot_pass[config.language]}
                                </Text>
                            </View>
                        </View>

                        {/* login btn */}
                        <TouchableOpacity style={{ width: '90%', backgroundColor: '#0088e0', height: 50, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginTop: 20, }} activeOpacity={0.9} onPress={() => { this._loginBtn() }}>
                            <Text style={styles.btn_txt}>{Lang_chg.txt_Login[config.language]}</Text>
                        </TouchableOpacity>
                        {
                            config.live_status == 'no' &&

                            <>
                                <View>
                                    <Text style={styles.loginAnd}>{Lang_chg.txt_login_or_l_w[config.language]}</Text>
                                </View>
                                <View style={[styles.loginMedia, { width: (config.device_type == 'android') ? "44%" : "55%" }]}>
                                    <TouchableOpacity activeOpacity={0.9} style={styles.login_apple} onPress={() => { this.FacebookLogin(this.props.navigation) }}>
                                        <Image style={styles.media_img} resizeMode="contain" source={require('./icons/f.png')}></Image>
                                    </TouchableOpacity>
                                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.GoogleLogin(this.props.navigation) }}>
                                        <Image style={styles.media_img} resizeMode="contain" source={require('./icons/g.png')}></Image>
                                    </TouchableOpacity>
                                    {
                                        // (config.device_type != 'android') &&
                                        // <TouchableOpacity activeOpacity={0.9}>
                                        //     <Image style={styles.media_img} resizeMode="contain" source={require('./icons/a.png')}></Image>
                                        // </TouchableOpacity>
                                    }

                                </View>
                            </>
                        }

                        <View style={{ marginBottom: 10 }}>
                            <Text style={styles.login_signt_text}>{Lang_chg.txt_login_do_not_have_acc[config.language]} <Text style={styles.sign_color_Txt} onPress={() => { this.props.navigation.navigate('Signup') }}>{Lang_chg.txt_signup[config.language]}</Text></Text>
                        </View>
                    </View>
                </KeyboardAwareScrollView>
            </View>
        )
    }
}
