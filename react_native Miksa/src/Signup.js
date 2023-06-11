import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, Modal, ScrollView, TextInput, ImageBackground, Keyboard } from 'react-native'
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, Mapprovider, validationprovider, firebaseprovider, notification } from './Provider/utilslib/Utils';
import { CommonActions } from '@react-navigation/native';
import { RadioButton } from 'react-native-paper';
import { CheckBox } from 'react-native-elements'
import OneSignal from 'react-native-onesignal';
import color1 from './Colors'
import styles from "./Style.js";
import Banner from "./Banner";
import { contents } from './Contents'
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
import { set } from 'react-native-reanimated';

export default class Signup extends Component {
    backpress = () => {
        this.props.navigation.goBack();
    }

    constructor(props) {
        super(props)
        this.state = {
            on: true,
            up: false,
            user_type: 1,
            selecthoursh: false,
            country: false,
            termsmain: false,
            privacymain: false,
            mapmodal: false,
            f_name: '',
            surname: '',
            identification_no: '',
            address: '',
            latidude: '',
            longitude: '',
            type_of_twelling: Lang_chg.txt_edit_pro_p_edit_House[config.language],
            no_of_bedroom: "",
            basement: 0,
            rooftop: 0,
            garden: 0,
            members: '',
            no_of_adults: '',
            no_of_kids: '',
            mobile_no: '',
            email: '',
            password: '',
            cpassword: '',
            HidePassword: true,
            HidePassword1: true,
            timer: null,
            minutes_Counter: '01',
            seconds_Counter: '59',
            startDisable: false,
            player_id: '123456',
            otppopup: false,
            otp: "",
            user_id: 0,
            email_edit: true,
            fname_edit: true,
            lname_edit: true,
            password_hide: false,
            social_data: 'NA',
            landmark: '',
            address_arr: "NA",
            types_of_dwelling_popup: false,
            dwelling_type_status: 0,
            landmark: "",
        }
        OneSignal.init(config.onesignalappid, {
            kOSSettingsKeyAutoPrompt: true,
        });
        OneSignal.setLogLevel(6, 0);
    }



    componentDidMount() {
        this.setProfileData();
        OneSignal.setLocationShared(true);
        OneSignal.inFocusDisplaying(2);
        OneSignal.addEventListener('ids', this.onIds.bind(this));
    }

    componentWillUnmount() {
        OneSignal.removeEventListener('ids', this.onIds.bind(this));
    }

    onIds(device) {
        console.log('Device info: ', device);
        this.setState({
            player_id: device.userId
        });
        config.player_id_me = device.userId;
    }

    setProfileData = async () => {
        var result = await localStorage.getItemObject('socialdata');
        consolepro.consolelog('setProfileData', result);
        if (result != null) {
            let email = result.social_email;
            let fname = result.social_first_name;
            let lname = result.social_last_name;
            if (email != null) {
                this.setState({ email: email, social_data: result, password_hide: true })
            }
            if (fname != null) {
                this.setState({ f_name: fname, social_data: result, password_hide: true })
            }
            if (lname != null) {
                this.setState({ surname: lname, social_data: result, password_hide: true })
            }
        }
    }
    setChecked = (value) => {
        this.setState({ checked: value });
    }
    locationget = async (data) => {
        this.setState({
            address: data.address,
            latidude: data.latitude,
            longitude: data.longitude,
        })
    }
    CloseMap = () => {
        this.setState({
            mapmodal: false,
        })
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
            msgProvider.alert(Lang_chg.information[config.language], 'Please enter otp', false);
            return false
        }

        var data = new FormData();
        data.append("user_id_post", user_id);
        data.append("user_otp", otp);
        data.append("player_id", this.state.player_id);
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

    _submitSignupData = async () => {
        Keyboard.dismiss()
        let { f_name, surname, identification_no, address, latidude, longitude, type_of_twelling, no_of_bedroom, members, basement, garden, rooftop, no_of_adults, no_of_kids, mobile_no, password, cpassword, user_type, player_id, email, landmark } = this.state;

        //firs name===================
        if (f_name.length <= 0) {
            msgProvider.toast(Lang_chg.emptyFirstName[config.language], 'center')
            return false
        }
        if (f_name.length <= 2) {
            msgProvider.toast(Lang_chg.FirstNameMinLength[config.language], 'center')
            return false
        }
        if (f_name.length > 50) {
            msgProvider.toast(Lang_chg.FirstNameMaxLength[config.language], 'center')
            return false
        }
        if (await validationprovider.textCheck(f_name) != true) {
            msgProvider.toast(Lang_chg.validFirstName[config.language], 'center')
            return false
        }

        //ssirname===================
        if (surname.length <= 0) {
            msgProvider.toast(Lang_chg.emptyLastName[config.language], 'center')
            return false
        }
        if (surname.length <= 2) {
            msgProvider.toast(Lang_chg.LastNameMinLength[config.language], 'center')
            return false
        }
        if (surname.length > 50) {
            msgProvider.toast(Lang_chg.LastNameMaxLength[config.language], 'center')
            return false
        }

        if (await validationprovider.textCheck(surname) != true) {
            msgProvider.toast(Lang_chg.validLastName[config.language], 'center')
            return false
        }

        //identification no===================
        if (identification_no.length <= 0) {
            msgProvider.toast(Lang_chg.emptyIdentification[config.language], 'center')
            return false
        }
        if (identification_no.length <= 4) {
            msgProvider.toast(Lang_chg.identificationMinLength[config.language], 'center')
            return false
        }
        if (identification_no.length > 20) {
            msgProvider.toast(Lang_chg.identificationMaxLength[config.language], 'center')
            return false
        }

        // if (await validationprovider.digitCheck(identification_no) != true) {
        //     msgProvider.toast(Lang_chg.vailidIdentification[config.language], 'center')
        //     return false
        // }

        // address===============
        if (address.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }
        if (address.length <= 2) {
            msgProvider.toast(Lang_chg.minlenaddress[config.language], 'center')
            return false
        }
        if (address.length > 250) {
            msgProvider.toast(Lang_chg.maxlenaddress[config.language], 'center')
            return false
        }
        if (latidude.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }

        if (longitude.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }

        // loand mark================================
        if (landmark.length <= 0) {
            msgProvider.toast(Lang_chg.emptyLandmark[config.language], 'center')
            return false
        }
        if (landmark.length <= 2) {
            msgProvider.toast(Lang_chg.minlenLandmark[config.language], 'center')
            return false
        }
        if (landmark.length > 250) {
            msgProvider.toast(Lang_chg.maxlenLandmark[config.language], 'center')
            return false
        }

        if (user_type == 1) {
            //  types of dwellingss================
            if (type_of_twelling.length <= 0) {
                msgProvider.toast(Lang_chg.emptytype_of_twelling[config.language], 'center')
                return false
            }
            if (type_of_twelling.length <= 2) {
                msgProvider.toast(Lang_chg.minlentype_of_twelling[config.language], 'center')
                return false
            }
            if (type_of_twelling.length > 50) {
                msgProvider.toast(Lang_chg.maxlentype_of_twelling[config.language], 'center')
                return false
            }

            //no_of_bedroom===================
            if (no_of_bedroom.length <= 0) {
                msgProvider.toast(Lang_chg.emptyno_of_bedroom[config.language], 'center')
                return false
            }
            if (no_of_bedroom.length < 1) {
                msgProvider.toast(Lang_chg.no_of_bedroomMinLength[config.language], 'center')
                return false
            }
            if (no_of_bedroom.length > 3) {
                msgProvider.toast(Lang_chg.no_of_bedroomMaxLength[config.language], 'center')
                return false
            }

            if (await validationprovider.digitCheck(no_of_bedroom) != true) {
                msgProvider.toast(Lang_chg.vailidno_of_bedroom[config.language], 'center')
                return false
            }

            // members=============
            if (members.length <= 0) {
                msgProvider.toast(Lang_chg.emptymembers[config.language], 'center')
                return false
            }
            if (members.length < 1) {
                msgProvider.toast(Lang_chg.membersMinLength[config.language], 'center')
                return false
            }
            if (members.length > 3) {
                msgProvider.toast(Lang_chg.membersMaxLength[config.language], 'center')
                return false
            }

            if (await validationprovider.digitCheck(members) != true) {
                msgProvider.toast(Lang_chg.vailidmembers[config.language], 'center')
                return false
            }

            // no_of_adults=============
            if (no_of_adults.length <= 0) {
                msgProvider.toast(Lang_chg.emptyno_of_adults[config.language], 'center')
                return false
            }
            if (no_of_adults.length < 1) {
                msgProvider.toast(Lang_chg.no_of_adultsMinLength[config.language], 'center')
                return false
            }
            if (no_of_adults.length > 3) {
                msgProvider.toast(Lang_chg.no_of_adultsMaxLength[config.language], 'center')
                return false
            }

            if (await validationprovider.digitCheck(no_of_adults) != true) {
                msgProvider.toast(Lang_chg.vailidno_of_adults[config.language], 'center')
                return false
            }

            // no_of_kids=============
            if (no_of_kids.length <= 0) {
                msgProvider.toast(Lang_chg.emptyno_of_kids[config.language], 'center')
                return false
            }
            if (no_of_kids.length < 1) {
                msgProvider.toast(Lang_chg.no_of_kidsMinLength[config.language], 'center')
                return false
            }
            if (no_of_kids.length > 3) {
                msgProvider.toast(Lang_chg.no_of_kidsMaxLength[config.language], 'center')
                return false
            }

            if (await validationprovider.digitCheck(no_of_kids) != true) {
                msgProvider.toast(Lang_chg.vailidno_of_kids[config.language], 'center')
                return false
            }
        }

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

        if (user_type == 2) {
            //email============================
            if (email.length <= 0) {
                msgProvider.toast(Lang_chg.emptyEmail[config.language], 'center')
                return false
            }
            if (email.length > 50) {
                msgProvider.toast(Lang_chg.emailMaxLength[config.language], 'center')
                return false
            }
            if (await validationprovider.emailCheck(email) != true) {
                msgProvider.toast(Lang_chg.validEmail[config.language], 'center')
                return false
            }
        }

        //password===================
        if (await validationprovider.spaceCheck(password) != true) {
            msgProvider.toast(Lang_chg.spacePasswordpassMaxLength[config.language], 'center')
            return false
        }
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
        //cpassword===================
        if (await validationprovider.spaceCheck(cpassword) != true) {
            msgProvider.toast(Lang_chg.spacePasswordcMaxLength[config.language], 'center')
            return false
        }
        if (cpassword.length <= 0) {
            msgProvider.toast(Lang_chg.emptyConfirmPWD[config.language], 'center')
            return false
        }
        if (cpassword.length <= 5) {
            msgProvider.toast(Lang_chg.ConfirmPWDMinLength[config.language], 'center')
            return false
        }
        if (cpassword.length > 16) {
            msgProvider.toast(Lang_chg.ConfirmPWDMaxLength[config.language], 'center')
            return false
        }
        if (cpassword !== password) {
            msgProvider.toast(Lang_chg.ConfirmPWDMatch[config.language], 'center')
            return false
        }

        // let { f_name,surname,identification_no,address,latidude,longitude,type_of_twelling,no_of_bedroom,members,basement,garden,rooftop,no_of_adults,no_of_kids,mobile_no,password,cpassword,user_type } = this.state;

        var data = new FormData();
        data.append('name', f_name)
        data.append('surname', surname)
        data.append('identification_no', identification_no)
        data.append('address', address)
        data.append('latitude', latidude)
        data.append('longitude', longitude)
        data.append('types_of_dewlling', type_of_twelling)
        data.append('no_of_bedroom', no_of_bedroom)
        data.append('members', members)
        data.append('basement', basement)
        data.append('garden', garden)
        data.append('rooftop', rooftop)
        data.append('no_of_adults', no_of_adults)
        data.append('no_of_kids', no_of_kids)
        data.append('password', password)
        data.append('user_type', user_type)
        data.append('mobile_no', mobile_no)
        if (user_type == 2) {
            data.append('email', email)
        }
        data.append('phone_code', 593)
        data.append('login_type', 0)
        data.append('player_id', player_id)
        data.append("device_type", config.device_type)
        data.append("landmark", landmark)
        let url = config.baseURL + "signup.php";
        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('signup otp', obj);

            if (obj.success == 'true') {
                var user_arr = obj.user_details;
                var user_type = user_arr.user_type;
                var mobile = user_arr.mobile;
                var signup_step = user_arr.signup_step;
                var user_id = user_arr.user_id;
                var otp = user_arr.otp;

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
                                mobile_no: mobile,
                                otp: otp,
                            })
                            this.onButtonStart();
                        }, 500);
                        return () => clearTimeout(timer);
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
                        const timer = setTimeout(() => {
                            this.setState({
                                otppopup: true,
                                user_id: user_id,
                                mobile_no: mobile,
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
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
            console.log('err', err);
        });
    }

    _btnSocialDataSubmit = async () => {
        Keyboard.dismiss()
        let { f_name, surname, identification_no, address, latidude, longitude, type_of_twelling, no_of_bedroom, members, basement, garden, rooftop, no_of_adults, no_of_kids, mobile_no, user_type, player_id, email, landmark } = this.state;

        //firs name===================
        if (f_name.length <= 0) {
            msgProvider.toast(Lang_chg.emptyFirstName[config.language], 'center')
            return false
        }
        if (f_name.length <= 2) {
            msgProvider.toast(Lang_chg.FirstNameMinLength[config.language], 'center')
            return false
        }
        if (f_name.length > 50) {
            msgProvider.toast(Lang_chg.FirstNameMaxLength[config.language], 'center')
            return false
        }
        if (await validationprovider.textCheck(f_name) != true) {
            msgProvider.toast(Lang_chg.validFirstName[config.language], 'center')
            return false
        }

        //ssirname===================
        if (surname.length <= 0) {
            msgProvider.toast(Lang_chg.emptyLastName[config.language], 'center')
            return false
        }
        if (surname.length <= 2) {
            msgProvider.toast(Lang_chg.LastNameMinLength[config.language], 'center')
            return false
        }
        if (surname.length > 50) {
            msgProvider.toast(Lang_chg.LastNameMaxLength[config.language], 'center')
            return false
        }

        if (await validationprovider.textCheck(surname) != true) {
            msgProvider.toast(Lang_chg.validLastName[config.language], 'center')
            return false
        }

        //identification no===================
        if (identification_no.length <= 0) {
            msgProvider.toast(Lang_chg.emptyIdentification[config.language], 'center')
            return false
        }
        if (identification_no.length <= 4) {
            msgProvider.toast(Lang_chg.identificationMinLength[config.language], 'center')
            return false
        }
        if (identification_no.length > 20) {
            msgProvider.toast(Lang_chg.identificationMaxLength[config.language], 'center')
            return false
        }

        // if (await validationprovider.digitCheck(identification_no) != true) {
        //     msgProvider.toast(Lang_chg.vailidIdentification[config.language], 'center')
        //     return false
        // }

        // address===============
        if (address.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }
        if (address.length <= 2) {
            msgProvider.toast(Lang_chg.minlenaddress[config.language], 'center')
            return false
        }
        if (address.length > 250) {
            msgProvider.toast(Lang_chg.maxlenaddress[config.language], 'center')
            return false
        }
        if (latidude.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }

        if (longitude.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }

        // loand mark================================
        if (landmark.length <= 0) {
            msgProvider.toast(Lang_chg.emptyLandmark[config.language], 'center')
            return false
        }
        if (landmark.length <= 2) {
            msgProvider.toast(Lang_chg.minlenLandmark[config.language], 'center')
            return false
        }
        if (landmark.length > 250) {
            msgProvider.toast(Lang_chg.maxlenLandmark[config.language], 'center')
            return false
        }

        if (user_type == 1) {
            //  types of dwellingss================
            if (type_of_twelling.length <= 0) {
                msgProvider.toast(Lang_chg.emptytype_of_twelling[config.language], 'center')
                return false
            }
            if (type_of_twelling.length <= 2) {
                msgProvider.toast(Lang_chg.minlentype_of_twelling[config.language], 'center')
                return false
            }
            if (type_of_twelling.length > 50) {
                msgProvider.toast(Lang_chg.maxlentype_of_twelling[config.language], 'center')
                return false
            }

            //no_of_bedroom===================
            if (no_of_bedroom.length <= 0) {
                msgProvider.toast(Lang_chg.emptyno_of_bedroom[config.language], 'center')
                return false
            }
            if (no_of_bedroom.length < 1) {
                msgProvider.toast(Lang_chg.no_of_bedroomMinLength[config.language], 'center')
                return false
            }
            if (no_of_bedroom.length > 3) {
                msgProvider.toast(Lang_chg.no_of_bedroomMaxLength[config.language], 'center')
                return false
            }

            if (await validationprovider.digitCheck(no_of_bedroom) != true) {
                msgProvider.toast(Lang_chg.vailidno_of_bedroom[config.language], 'center')
                return false
            }

            // members=============
            if (members.length <= 0) {
                msgProvider.toast(Lang_chg.emptymembers[config.language], 'center')
                return false
            }
            if (members.length < 1) {
                msgProvider.toast(Lang_chg.membersMinLength[config.language], 'center')
                return false
            }
            if (members.length > 3) {
                msgProvider.toast(Lang_chg.membersMaxLength[config.language], 'center')
                return false
            }

            if (await validationprovider.digitCheck(members) != true) {
                msgProvider.toast(Lang_chg.vailidmembers[config.language], 'center')
                return false
            }

            // no_of_adults=============
            if (no_of_adults.length <= 0) {
                msgProvider.toast(Lang_chg.emptyno_of_adults[config.language], 'center')
                return false
            }
            if (no_of_adults.length < 1) {
                msgProvider.toast(Lang_chg.no_of_adultsMinLength[config.language], 'center')
                return false
            }
            if (no_of_adults.length > 3) {
                msgProvider.toast(Lang_chg.no_of_adultsMaxLength[config.language], 'center')
                return false
            }

            if (await validationprovider.digitCheck(no_of_adults) != true) {
                msgProvider.toast(Lang_chg.vailidno_of_adults[config.language], 'center')
                return false
            }

            // no_of_kids=============
            if (no_of_kids.length <= 0) {
                msgProvider.toast(Lang_chg.emptyno_of_kids[config.language], 'center')
                return false
            }
            if (no_of_kids.length < 1) {
                msgProvider.toast(Lang_chg.no_of_kidsMinLength[config.language], 'center')
                return false
            }
            if (no_of_kids.length > 3) {
                msgProvider.toast(Lang_chg.no_of_kidsMaxLength[config.language], 'center')
                return false
            }

            if (await validationprovider.digitCheck(no_of_kids) != true) {
                msgProvider.toast(Lang_chg.vailidno_of_kids[config.language], 'center')
                return false
            }
        }

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

        if (user_type == 2) {
            //email============================
            if (email.length <= 0) {
                msgProvider.toast(Lang_chg.emptyEmail[config.language], 'center')
                return false
            }
            if (email.length > 50) {
                msgProvider.toast(Lang_chg.emailMaxLength[config.language], 'center')
                return false
            }
            if (await validationprovider.emailCheck(email) != true) {
                msgProvider.toast(Lang_chg.validEmail[config.language], 'center')
                return false
            }
        }


        var data = new FormData();
        data.append('name', f_name)
        data.append('surname', surname)
        data.append('identification_no', identification_no)
        data.append('address', address)
        data.append('latitude', latidude)
        data.append('longitude', longitude)
        data.append('types_of_dewlling', type_of_twelling)
        data.append('no_of_bedroom', no_of_bedroom)
        data.append('members', members)
        data.append('basement', basement)
        data.append('garden', garden)
        data.append('rooftop', rooftop)
        data.append('no_of_adults', no_of_adults)
        data.append('no_of_kids', no_of_kids)
        data.append('user_type', user_type)
        data.append('mobile_no', mobile_no)
        if (user_type == 2) {
            data.append('email', email)
        }
        data.append('phone_code', config.phone_code)
        data.append("login_type", this.state.social_data.login_type)
        data.append("social_id", this.state.social_data.social_id)
        data.append('player_id', player_id)
        data.append("device_type", config.device_type)
        data.append("landmark", landmark)

        let url = config.baseURL + "signup.php";
        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('signup otp', obj);

            if (obj.success == 'true') {
                var user_arr = obj.user_details;
                var user_type = user_arr.user_type;
                var mobile = user_arr.mobile;
                var signup_step = user_arr.signup_step;
                var user_id = user_arr.user_id;
                var otp = user_arr.otp;

                consolepro.consolelog('mobile', mobile);
                localStorage.setItemString('mobile', this.state.mobile_no.toString());

                if (user_type == 1) {

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
                    if (signup_step == 1) {
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        this.setState({ otppopup: false })
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
                        localStorage.setItemString('user_type', user_type.toString());
                        localStorage.setItemString('user_id', JSON.stringify(user_id));
                        localStorage.setItemObject('user_arr', user_arr);
                        firebaseprovider.firebaseUserCreate();
                        firebaseprovider.getMyInboxAllData();
                        this.setState({ otppopup: false })
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
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
            console.log('err', err);
        });

    }







    render() {
        return (
            <View style={{ flex: 1, height: '100%', width: '100%', backgroundColor: '#fff' }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                <Mapprovider mapmodal={this.state.mapmodal} locationget={this.locationget} address_arr="NA" identify="age" canclemap={this.CloseMap} comingPageName="signup" />
                {/* <Mapprovider mapmodal={this.state.mapmodal} locationget={this.locationget} address_arr={{ 'address': this.state.address, latitude: this.state.latidude, longitude: this.state.longitude }} canclemap={this.CloseMap} /> */}



                <Modal
                    animationType="slide"
                    transparent={true}
                    visible={this.state.types_of_dwelling_popup}
                    onRequestClose={() => { this.setState({ types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }}
                >
                    <View style={{ backgroundColor: "#00000030", flex: 1, alignItems: "center", justifyContent: "center", paddingHorizontal: 20 }}>
                        <StatusBar backgroundColor={color1.theme_color} barStyle='default' hidden={false} translucent={false}
                            networkActivityIndicatorVisible={true} />
                        <View style={{ width: "100%", position: 'absolute', bottom: 20 }}>

                            <View style={{ backgroundColor: "#ffffff", width: "100%", height: 120 }}>
                                <TouchableOpacity
                                    style={(this.state.dwelling_type_status == 0) ? styles.dropDown11 : styles.dropDown12}
                                    onPress={() => { this.setState({ dwelling_type_status: 0, type_of_twelling: Lang_chg.txt_edit_pro_p_edit_House[config.language], types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>{Lang_chg.txt_edit_pro_p_edit_House[config.language]}</Text>
                                </TouchableOpacity>
                                <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 2 }}></View>
                                <TouchableOpacity
                                    style={(this.state.dwelling_type_status == 1) ? styles.dropDown11 : styles.dropDown12}
                                    onPress={() => { this.setState({ dwelling_type_status: 1, type_of_twelling: Lang_chg.txt_edit_pro_p_edit_Apartment[config.language], types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>{Lang_chg.txt_edit_pro_p_edit_Apartment[config.language]}</Text>
                                </TouchableOpacity>
                                <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 2 }}></View>
                                <TouchableOpacity
                                    style={(this.state.dwelling_type_status == 2) ? styles.dropDown11 : styles.dropDown12}
                                    onPress={() => { this.setState({ dwelling_type_status: 2, type_of_twelling: Lang_chg.txt_edit_pro_p_edit_Office[config.language], types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>{Lang_chg.txt_edit_pro_p_edit_Office[config.language]}</Text>
                                </TouchableOpacity>
                            </View>
                        </View>
                    </View>
                </Modal>
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


                    <View style={styles.signup_main}>
                        <View style={styles.signup_tab}>

                            <TouchableOpacity onPress={() => { this.setState({ user_type: 1 }) }} style={styles.btn_left} activeOpacity={0.9}>
                                {
                                    (this.state.user_type == 1) ? <Text style={styles.customerbtn_select}>{Lang_chg.txt_customer[config.language]}</Text> : <Text style={styles.customerbtn}>{Lang_chg.txt_customer[config.language]}</Text>
                                }

                            </TouchableOpacity>

                            <TouchableOpacity onPress={() => { this.setState({ user_type: 2 }) }} style={styles.btn_right} activeOpacity={0.9}>
                                {
                                    (this.state.user_type == 2) ? <Text style={styles.customerbtn_select}>{Lang_chg.txt_provider[config.language]}</Text> : <Text style={styles.customerbtn}>{Lang_chg.txt_provider[config.language]}</Text>
                                }

                            </TouchableOpacity>

                        </View>
                    </View>


                    <View>
                        <View style={styles.view_input}>
                            <View style={styles.login_pass}>
                                <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/user.png')}></Image>
                            </View>
                            <View style={styles.right_view}>
                                <TextInput
                                    style={styles.input_main}
                                    placeholder={Lang_chg.txt_fname[config.language]}
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    maxLength={50}
                                    minLength={3}
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ f_name: txt }) }}
                                    value={this.state.f_name}
                                />
                            </View>
                        </View>

                        <View style={styles.view_input}>
                            <View style={styles.login_pass}>
                                <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/user.png')}></Image>
                            </View>
                            <View style={styles.right_view}>
                                <TextInput
                                    style={styles.input_main}
                                    placeholder={Lang_chg.txt_surname[config.language]}
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ surname: txt }) }}
                                    maxLength={50}
                                    minLength={3}
                                    value={this.state.surname}
                                />
                            </View>
                        </View>

                        <View style={styles.view_input}>
                            <View style={styles.login_pass}>
                                <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/voter.png')}></Image>
                            </View>
                            <View style={styles.right_view}>
                                <TextInput
                                    style={styles.input_main}
                                    keyboardType='default'
                                    placeholder={Lang_chg.txt_identification_no[config.language]}
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    ref={(input) => { this.textinput = input; }}
                                    minLength={5}
                                    maxLength={20}
                                    onChangeText={(txt) => { this.setState({ identification_no: txt }) }}
                                />

                            </View>
                        </View>
                        <View>
                            <TouchableOpacity onPress={() => { this.setState({ mapmodal: true }) }} style={styles.map_View_new} activeOpacity={0.9}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/location4.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <Text style={styles.signup_addres}>{(this.state.address != '') ? this.state.address : Lang_chg.txt_address[config.language]}</Text>
                                </View>
                            </TouchableOpacity>
                        </View>

                        <View style={styles.view_input}>
                            <View style={styles.login_pass}>
                                <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/location4.png')}></Image>
                            </View>
                            <View style={styles.right_view}>
                                <TextInput
                                    style={styles.input_main}
                                    keyboardType='default'
                                    placeholder={Lang_chg.txt_c_landmark_txt[config.language]}
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    ref={(input) => { this.textinput = input; }}
                                    minLength={3}
                                    maxLength={250}
                                    onChangeText={(txt) => { this.setState({ landmark: txt }) }}
                                />

                            </View>
                        </View>




                        {
                            (this.state.user_type == 1) &&
                            <View>
                                <TouchableOpacity onPress={() => { this.setState({ types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }} style={styles.view_input}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/type.png')}></Image>
                                    </View>
                                    <View style={{ width: '80%', height: 50, justifyContent: "center", paddingLeft: 15 }}>

                                        <Text style={{ fontSize: 18 }}>{this.state.type_of_twelling}</Text>

                                    </View>
                                    <View style={[styles.passEye]}>
                                        <Image style={{ height: 10, width: 10, alignSelf: 'center' }} resizeMode="contain" source={require('./icons/downarrow.png')}></Image>
                                    </View>
                                </TouchableOpacity>

                                <View style={styles.view_input}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/bedroom.png')}></Image>
                                    </View>
                                    <View style={styles.right_view}>
                                        <TextInput
                                            style={styles.input_main}
                                            placeholder={Lang_chg.txt_n_o_bedroom[config.language]}
                                            onSubmitEditing={() => { Keyboard.dismiss() }}
                                            returnKeyLabel='done'
                                            minLength={1}
                                            maxLength={3}
                                            ref={(input) => { this.textinput = input; }}
                                            onChangeText={(txt) => { this.setState({ no_of_bedroom: txt }) }}
                                            keyboardType='decimal-pad'
                                        />
                                    </View>
                                </View>

                                <View style={styles.baseMentBox}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/basement.png')}></Image>
                                    </View>
                                    <View style={styles.sign_select_ttle}>
                                        <Text style={styles.radio_title}>{Lang_chg.txt_basement[config.language]}</Text>
                                    </View>

                                    <View style={styles.right_yesNo}>
                                        <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>
                                            <CheckBox
                                                center
                                                containerStyle={{ elevation: 0 }}
                                                checkedIcon='dot-circle-o'
                                                uncheckedIcon='circle-o'
                                                checked={this.state.basement === 0 ? true : false}
                                                onPress={() => { this.setState({ basement: 0 }) }}
                                            />
                                            <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.Yes[config.language]}</Text>
                                        </TouchableOpacity>

                                        <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>

                                            <CheckBox
                                                center
                                                containerStyle={{ elevation: 0 }}
                                                checkedIcon='dot-circle-o'
                                                uncheckedIcon='circle-o'
                                                checked={this.state.basement === 1 ? true : false}
                                                onPress={() => { this.setState({ basement: 1 }) }}
                                            />
                                            <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.No[config.language]}</Text>
                                        </TouchableOpacity>
                                    </View>
                                </View>

                                <View style={styles.baseMentBox}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/rooftop.png')}></Image>
                                    </View>
                                    <View style={styles.sign_select_ttle}>
                                        <Text style={styles.radio_title}>{Lang_chg.txt_rooftop[config.language]}</Text>
                                    </View>

                                    <View style={styles.right_yesNo}>
                                        <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>

                                            <CheckBox
                                                center
                                                containerStyle={{ elevation: 0 }}
                                                checkedIcon='dot-circle-o'
                                                uncheckedIcon='circle-o'
                                                checked={this.state.rooftop === 0 ? true : false}
                                                onPress={() => { this.setState({ rooftop: 0 }) }}
                                            />

                                            <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.Yes[config.language]}</Text>
                                        </TouchableOpacity>

                                        <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: "center" }}>

                                            <CheckBox
                                                center
                                                containerStyle={{ elevation: 0 }}
                                                checkedIcon='dot-circle-o'
                                                uncheckedIcon='circle-o'
                                                checked={this.state.rooftop === 1 ? true : false}
                                                onPress={() => { this.setState({ rooftop: 1 }) }}
                                            />

                                            <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.No[config.language]}</Text>
                                        </TouchableOpacity>
                                    </View>
                                </View>


                                <View style={styles.baseMentBox}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/garden.png')}></Image>
                                    </View>
                                    <View style={styles.sign_select_ttle}>
                                        <Text style={styles.radio_title}>{Lang_chg.txt_gardern[config.language]}</Text>
                                    </View>

                                    <View style={styles.right_yesNo}>
                                        <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>

                                            <CheckBox
                                                center
                                                containerStyle={{ elevation: 0 }}
                                                checkedIcon='dot-circle-o'
                                                uncheckedIcon='circle-o'
                                                checked={this.state.garden === 0 ? true : false}
                                                onPress={() => { this.setState({ garden: 0 }) }}
                                            />

                                            <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.Yes[config.language]}</Text>

                                        </TouchableOpacity>

                                        <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>

                                            <CheckBox
                                                center
                                                containerStyle={{ elevation: 0 }}
                                                checkedIcon='dot-circle-o'
                                                uncheckedIcon='circle-o'
                                                checked={this.state.garden === 1 ? true : false}
                                                onPress={() => { this.setState({ garden: 1 }) }}
                                            />

                                            <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.No[config.language]}</Text>
                                        </TouchableOpacity>
                                    </View>
                                </View>

                                <View style={styles.view_input}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/howmany.png')}></Image>
                                    </View>
                                    <View style={styles.right_view}>
                                        <TextInput
                                            style={styles.input_main}
                                            placeholder={Lang_chg.txt_Members[config.language]}
                                            onSubmitEditing={() => { Keyboard.dismiss() }}
                                            returnKeyLabel='done'
                                            ref={(input) => { this.textinput = input; }}
                                            onChangeText={(txt) => { this.setState({ members: txt }) }}
                                            minLength={1}
                                            maxLength={3}
                                            keyboardType='decimal-pad'
                                        ></TextInput>
                                    </View>
                                </View>

                                <View style={styles.view_input}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/howmany.png')}></Image>
                                    </View>
                                    <View style={styles.right_view}>
                                        <TextInput
                                            style={styles.input_main}
                                            placeholder={Lang_chg.txt_n_o_adults[config.language]}
                                            onSubmitEditing={() => { Keyboard.dismiss() }}
                                            returnKeyLabel='done'
                                            ref={(input) => { this.textinput = input; }}
                                            onChangeText={(txt) => { this.setState({ no_of_adults: txt }) }}
                                            minLength={1}
                                            maxLength={3}
                                            keyboardType='decimal-pad'
                                        ></TextInput>
                                    </View>
                                </View>

                                <View style={styles.view_input}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/user.png')}></Image>
                                    </View>
                                    <View style={styles.right_view}>
                                        <TextInput
                                            style={styles.input_main}
                                            placeholder={Lang_chg.txt_n_o_kids[config.language]}
                                            onSubmitEditing={() => { Keyboard.dismiss() }}
                                            returnKeyLabel='done'
                                            ref={(input) => { this.textinput = input; }}
                                            onChangeText={(txt) => { this.setState({ no_of_kids: txt }) }}
                                            minLength={1}
                                            maxLength={3}
                                            keyboardType='decimal-pad'
                                        ></TextInput>
                                    </View>
                                </View>
                            </View>
                        }


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
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ mobile_no: txt }) }}
                                    keyboardType='phone-pad'
                                    minLength={8}
                                    maxLength={12}
                                />
                            </View>
                        </View>
                        {
                            (this.state.user_type == 2) &&
                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/mail.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        placeholder={Lang_chg.txt_emails[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        keyboardType="email-address"
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ email: txt }) }}
                                        maxLength={50}
                                        value={this.state.email}
                                    />
                                </View>
                            </View>
                        }


                        {
                            (!this.state.password_hide) &&
                            <View>
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
                                            ref={(input) => { this.textinput = input; }}
                                            onChangeText={(txt) => { this.setState({ password: txt }) }}
                                            minLength={6}
                                            maxLength={16}
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

                                <View style={styles.view_input}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/lock1.png')}></Image>
                                    </View>
                                    <View style={styles.right_view}>
                                        <TextInput
                                            style={styles.input_main}
                                            placeholder={Lang_chg.txt_cpassword[config.language]}
                                            onSubmitEditing={() => { Keyboard.dismiss() }}
                                            returnKeyLabel='done'
                                            secureTextEntry={this.state.HidePassword1}
                                            ref={(input) => { this.textinput = input; }}
                                            onChangeText={(txt) => { this.setState({ cpassword: txt }) }}
                                            minLength={6}
                                            maxLength={16}
                                        ></TextInput>
                                    </View>
                                    <TouchableOpacity style={styles.passEye}
                                        onPress={() => { this.setState({ HidePassword1: !this.state.HidePassword1 }) }}
                                    >

                                        {
                                            this.state.HidePassword1
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
                            </View>
                        }

                        <View style={styles.sign_term}>
                            <Text style={styles.terms_txt}>{Lang_chg.txt_term_condi1[config.language]} <Text style={styles.termsMainSign} onPress={() => { contents.btnTermCondi(this.props.navigation) }}>{Lang_chg.txt_term_condi[config.language]}</Text>
                                {"\n"} {Lang_chg.txt_and[config.language]} <Text style={styles.termsMainSign} onPress={() => { contents.btnPrivacyPolicy(this.props.navigation) }}>{Lang_chg.txt_pri_poli[config.language]}</Text></Text>
                        </View>

                        {/* <View style={styles.login_btn}>
                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9}
                                onPress={() => { (this.state.social_data == 'NA') ? this._submitSignupData() : this._btnSocialDataSubmit() }}
                            >
                                <Text style={styles.btn_txt}>{Lang_chg.txt_signup[config.language]}</Text>
                            </TouchableOpacity>
                        </View> */}

                        <TouchableOpacity style={{ width: '90%', backgroundColor: '#0088e0', height: 20, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginTop: 20, marginTop: 70, height: 45, marginBottom: 20 }} activeOpacity={0.9} onPress={() => { (this.state.social_data == 'NA') ? this._submitSignupData() : this._btnSocialDataSubmit() }}>
                            <Text style={styles.btn_txt}>{Lang_chg.txt_signup[config.language]}</Text>
                        </TouchableOpacity>

                        <View style={{ paddingBottom: 40 }}>
                            <Text style={styles.login_signt_text}>{Lang_chg.txt_do_have_acc[config.language]} <Text style={styles.sign_color_Txt} onPress={() => { this.props.navigation.navigate('Login') }}>{Lang_chg.txt_Login[config.language]}</Text></Text>
                        </View>
                    </View>
                </KeyboardAwareScrollView>
            </View>
        )
    }
}
