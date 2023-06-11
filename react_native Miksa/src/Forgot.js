import React, { Component } from 'react'
import { Text, View, StatusBar, SafeAreaView, TouchableOpacity, Modal, ScrollView, TextInput, Image, Keyboard, } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import Banner from "./Banner";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, validationprovider, SocialLogin } from './Provider/utilslib/Utils';
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
export default class Forgot extends Component {
    constructor(props) {
        super(props)
        this.state = {
            otppopup: false,
            minutes_Counter: '01',
            seconds_Counter: '59',
            startDisable: false,
            timer: null,
            otp: '',
            user_id: 0,
            mobile_no: '',
        }
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
        data.append('user_id', user_id)
        data.append('otp', otp)
        console.log('otp', data)
        var url = config.baseURL + 'otp_verify_forgot.php';
        apifuntion.postApi(url, data).then((obj) => {
            console.log('otp veri fy', obj)
            if (obj.success == 'true') {
                this.setState({ otppopup: false })
                this.onButtonStop()
                this.props.navigation.navigate('Forgot_change_pass', {
                    'user_id': user_id,
                })
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

        let url = config.baseURL + "forgot_password.php?mobile=" + this.state.mobile_no + "&phone_code=" + 593;
        consolepro.consolelog('Forgot data', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Forgot data', obj);
            if (obj.success == 'true') {
                var user_id = obj.user_id;
                var otp = obj.otp;
                this.setState({
                    otppopup: true,
                    user_id: user_id,
                    otp: otp,
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
            console.log('err', err);
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
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

    _submitDataForForgot = async () => {
        Keyboard.dismiss()
        var mobile_no = this.state.mobile_no;
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


        let url = config.baseURL + "forgot_password.php?mobile=" + mobile_no + "&phone_code=" + 593;
        consolepro.consolelog('Forgot data', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Forgot data', obj);
            if (obj.success == 'true') {
                var user_id = obj.user_id;
                var otp = obj.otp;
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
            console.log('err', err);
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
        });

    }
    render() {
        return (
            <View style={{ flex: 1, height: '100%', width: '100%', backgroundColor: '#fff' }}>
                <ScrollView contentContainerStyle={{ flexGrow: 1 }} keyboardDismissMode='interactive' keyboardShouldPersistTaps='handled' showsVerticalScrollIndicator={false}>
                    <KeyboardAwareScrollView>
                        <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                        <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                            networkActivityIndicatorVisible={true} />
                        <Banner />

                        <TouchableOpacity activeOpacity={0.9} style={{ position: 'absolute', top: 20, left: 20 }} onPress={() => { this.props.navigation.goBack() }}>
                            <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                        </TouchableOpacity>

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
                            <View style={styles.forgot_viewTop}>
                                <Text style={styles.forgotTitle}>{Lang_chg.txt_login_forgot_pass[config.language]}</Text>
                                <Text style={styles.forgot_p}>{Lang_chg.txt_login_forgot_pass1[config.language]}</Text>
                            </View>
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

                            <TouchableOpacity style={{ width: '90%', backgroundColor: '#0088e0', height: 50, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginTop: 20, }} activeOpacity={0.9} onPress={() => { this._submitDataForForgot() }}>
                                <Text style={styles.btn_txt}>{Lang_chg.txt_Forgot_Pass3[config.language]}</Text>
                            </TouchableOpacity>

                            {/* <View style={styles.login_btn}>
                        <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this._submitDataForForgot() }}>
                            
                        </TouchableOpacity>
                    </View> */}
                        </View>
                    </KeyboardAwareScrollView>
                </ScrollView>
            </View>
        )
    }
}
