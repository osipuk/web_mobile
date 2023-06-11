import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, TextInput, Keyboard, Modal } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { WebView } from 'react-native-webview';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mediaprovider, Cameragallery, Mapprovider, notification } from './Provider/utilslib/Utils';
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
global.global_call_web_service = 0;
export default class Cretae_job_detail extends Component {
    constructor(props) {
        super(props)
        this.state = {
            job_data: this.props.route.params.job_data,
            message: '',
            webviewshow: false,
            user_id: 0,
            job_number: 0,
            currency: 'USD',
            payment_url: '',
            notification_arr: '',
            job_id: 0,
            wallet_insert_id: 0,
            call_web_service: 0,
        }
    }
    backpress = () => {
        this.props.navigation.goBack();
    }

    componentDidMount() {
        this.setUserData();
    }

    setUserData = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        this.setState({ user_id: user_id_post })
    }

    btnSubmitData = (txt_id) => {
        var message = this.state.message;
        var job_data = this.state.job_data;
        var arr = [];
        var servicess = job_data.services;
        for (var i = 0; i < servicess.length; i++) {
            arr.push(servicess[i].service_id);
        }

        var data = new FormData();
        data.append('services', JSON.stringify(job_data.services))
        data.append('services1', JSON.stringify(arr))
        data.append('title', job_data.title)
        data.append('avail_date', job_data.avail_date)
        data.append('avail_time', job_data.avail_time)
        data.append('price', job_data.price)
        data.append('address', job_data.address)
        data.append('latitude', job_data.latitude)
        data.append('longitude', job_data.longitude)
        data.append('user_id_post', job_data.user_id_post)

        data.append('tot_amount', job_data.tot_amount)
        data.append('tot_service_amount', job_data.tot_service_amount)
        data.append('txt_isd_amt', job_data.txt_isd_amt)
        data.append('isd_perc', job_data.isd_perc)
        // tot_amount: this.state.tot_amount,
        //     tot_service_amount: this.state.tot_service_amount,
        //         txt_isd_amt: this.state.txt_isd_amt,
        //             isd_perc: this.state.isd_perc,


        data.append('wallet_amount', 0)
        data.append('txn_id', txt_id)
        data.append('provider_id', job_data.provider_id)
        data.append('instruction', message)
        data.append('payment_mode', job_data.payment_mode)
        data.append('online_pay_amt', job_data.online_pay_amt)
        data.append('wallet_pay_amt', job_data.wallet_pay_amt)
        data.append('landmark', job_data.landmark)
        data.append('dateArrSend', JSON.stringify(job_data.dateArrSend))
        data.append('payment_status_off_on', "on")

        if (job_data.show_img.length != 0) {
            for (let i = 0; i < job_data.show_img.length; i++) {
                if (job_data.show_img[i].id == 'local') {
                    data.append('image_arr[]', {
                        uri: job_data.show_img[i].image,
                        type: 'image/jpg', // or photo.type
                        name: 'image.jpg'
                    });
                }
            }
        }

        consolepro.consolelog("create job", data);
        let url = config.baseURL + "job_create.php";
        consolepro.consolelog("create job url", url);
        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('Customer home data', obj);
            if (obj.success == 'true') {
                var email_arr = obj.email_arr;
                if (obj.notification_arr != 'NA') {
                    notification.oneSignalNotificationSendCall(obj.notification_arr);
                }
                if (typeof email_arr !== 'undefined') {
                    if (email_arr != 'NA') {
                        this.mailsendfunction(email_arr);
                    }
                }
                setTimeout(() => {
                    this.props.navigation.navigate('Create_success', { job_number: obj.job_number, 'createtime': obj.createtime })
                    this.setState({ webviewshow: false })
                }, 1000);
                return false;
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







    btnPayPalGetUrl = async () => {
        global_call_web_service = 0;
        var message = this.state.message;
        var job_data = this.state.job_data;
        if (message.length <= 0) {
            msgProvider.toast(Lang_chg.emptyMessage[config.language], 'center')
            return false
        }
        if (message.length < 3) {
            msgProvider.toast(Lang_chg.minlenMessage[config.language], 'center')
            return false
        }
        if (message.length > 250) {
            msgProvider.toast(Lang_chg.maxlenMessage[config.language], 'center')
            return false
        }
        // this.btnSubmitData('txn123456');
        if (config.live_status == 'yes') {
            this.btnSubmitData('txn123456');
        } else {
            var payment_url = config.baseURL + "stripe_payment/payment_url_subscription.php?user_id=" + this.state.user_id + "&order_id=1&amount=700&charge_type=later";
            this.setState({
                payment_url: payment_url
            }, () => {
                setTimeout(() => {
                    this.setState({ webviewshow: true })
                }, 550);
            })
        }
    }

    mailsendfunction = (email_arr) => {
        consolepro.consolelog('url', url);
        for (let i = 0; i < email_arr.length; i++) {
            var email = email_arr[i].email;
            var mailcontent = email_arr[i].mailcontent
            var mailsubject = email_arr[i].mailsubject
            var fromName = email_arr[i].fromName
            var url = config.baseURL + 'mailFunctionsSend.php';
            var data = new FormData();
            data.append("email", email);
            data.append("mailcontent", mailcontent);
            data.append("mailsubject", mailsubject);
            data.append("fromName", fromName);
            data.append("mail_file", 'NA');

            apifuntion.postNoLoadingApi(url, data).then((obj) => {
                consolepro.consolelog('Resend otp', obj);
                if (obj.success == 'true') {
                    consolepro.consolelog('Mail send');
                } else {
                    consolepro.consolelog('Mail not send');
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
    }



    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text style={styles.map_title}>{Lang_chg.txt_instructions[config.language]}</Text>
                    <Text></Text>
                </View>
                <KeyboardAwareScrollView>
                    <View style={styles.createjob_body}>

                        <View style={{
                            flexDirection: 'row',
                            borderWidth: 1,
                            borderColor: '#ccc',
                            borderRadius: 20,
                            paddingLeft: 20,
                            paddingRight: 20,
                            marginBottom: 20,
                        }}>
                            <View style={{ marginTop: -5, width: '10%' }}>
                                <Image resizeMode="contain" style={styles.contact_msgiconedit} source={require('./icons/edit.png')}></Image>
                            </View>
                            <View style={styles.contact_right}>
                                <TextInput
                                    style={[styles.txtinput, { height: 120, textAlignVertical: 'top', fontSize: 18, }]}
                                    placeholder={Lang_chg.create_hib_msg[config.language]}
                                    placeholderTextColor="#b8b8b8"
                                    multiline={true}
                                    maxLength={250}
                                    onSubmitEditing={(e) => { consolepro.consolelog('eeeeeeee', e) }}
                                    keyboardType='default'
                                    returnKeyLabel='done'
                                    returnKeyType='done'
                                    onChangeText={(txt) => { this.setState({ message: txt }) }}
                                />
                            </View>
                        </View>
                    </View>

                    <View style={[styles.login_btn, { marginTop: 30 }]}>
                        <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnPayPalGetUrl() }}>
                            <Text style={styles.btn_txt}>{Lang_chg.txt_home_continue_btn[config.language]}</Text>
                        </TouchableOpacity>
                    </View>
                    <Modal animationType="slide" transparent visible={this.state.webviewshow}
                        onRequestClose={() => {
                            this.setState({ webviewshow: false })
                        }}>
                        <View style={{ flex: 1 }}>
                            <SafeAreaView style={{ flex: 0, backgroundColor: color1.theme_color }} />

                            <StatusBar barStyle='light-content' backgroundColor={color1.theme_color} hidden={false} translucent={false}
                                networkActivityIndicatorVisible={true} />
                            <View style={[styles.headerContainer, { paddingHorizontal: 20 }]}>
                                <View style={{ flex: 1, justifyContent: "center" }}>
                                    <TouchableOpacity style={{ flexDirection: "row", alignItems: "center" }}
                                        onPress={() => { this.setState({ webviewshow: false }) }}
                                    >
                                        <Image style={{ width: 20, height: 20, marginLeft: 5 }}
                                            source={require('./icons/back2.png')}
                                            resizeMode="contain"
                                        />
                                    </TouchableOpacity>
                                </View>
                                <View style={{ flex: 2, justifyContent: "center", }}>
                                    <Text style={{ textAlign: "center", fontFamily: "Poppins-Bold", color: "#000" }}></Text>
                                </View>
                                <View style={{ flex: 1, alignItems: 'flex-end', justifyContent: 'center' }} />

                            </View>
                            <View style={{ flex: 1, backgroundColor: 'white' }}>
                                <Text style={{ alignSelf: 'center', color: 'red', textAlign: 'center', fontFamily: 'Poppins-Medium', marginTop: 15 }}>{Lang_chg.txtpaymentpr[config.language]}</Text>
                                {
                                    this.state.webviewshow == true &&
                                    <WebView
                                        source={{ uri: this.state.payment_url }}
                                        onNavigationStateChange={this._onNavigationStateChange.bind(this)}
                                        javaScriptEnabled={true}
                                        domStorageEnabled={true}
                                        // injectedJavaScript = {this.state.cookie}
                                        startInLoadingState={false}
                                        containerStyle={{ marginTop: 20, flex: 1 }}
                                        // injectedJavaScript={runFirst}
                                        // androidHardwareAccelerationDisabled={true}
                                        // allowUniversalAccessFromFileURLs={true}
                                        // allowingReadAccessToURL={true}
                                        // keyboardDisplayRequiresUserAction={false}
                                        // allowFileAccess={true}
                                        textZoom={100}
                                    // onMessage={this.onMessage}
                                    // onNavigationStateChange={(navEvent)=> console.log(navEvent.jsEvaluationValue)}
                                    // onMessage={(event)=> console.log(event.nativeEvent.data)}
                                    />
                                }
                            </View>
                        </View>
                    </Modal>
                </KeyboardAwareScrollView>
            </View>
        )
    }

    _onNavigationStateChange(webViewState) {
        webViewState.canGoBack = false
        if (webViewState.loading == false) {
            console.log('webViewState', webViewState);
            console.log(webViewState.url)
            var t = webViewState.url.split('/').pop().split('?')[0]
            if (typeof (t) != null) {
                var p = webViewState.url.split('?').pop().split('&')
                console.log('file name', t);
                if (t == 'payment_success_final_subscription.php') {
                    var payment_id = 0;
                    console.log('p.length', p.length);
                    for (var i = 0; i < p.length; i++) {
                        var val = p[i].split('=');
                        console.log('val', val);
                        if (val[0] == 'payment_id') {
                            payment_id = val[1]
                        }
                        if (global_call_web_service == 0) {
                            this.btnSubmitData(payment_id);
                        }
                        global_call_web_service = 1;
                        return false;
                    }
                } else if (t == 'payment_cancel_subscription.php') {
                    this.setState({ webviewshow: false })
                    setTimeout(() => {
                        this.btnCancelBooking();
                    }, 1000);
                    return false;
                }
            }
        }
    }


    btnCancelBooking = async () => {
        var job_data = this.state.job_data;
        if (job_data.payment_mode == 'wallet' || job_data.payment_mode == 'wallet_online') {
            let url = config.baseURL + "wallet_cancel.php?user_id_post=" + this.state.user_id + "&wallet_id=" + this.state.wallet_insert_id;
            apifuntion.getApi(url).then((obj) => {
                consolepro.consolelog('Paypal url data', obj);
                if (obj.success == 'true') {
                    msgProvider.toast(obj.msg[config.language], 'center');
                    this.props.navigation.navigate('Home_customer')
                    return false;
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
        } else {
            msgProvider.toast("Payment Cancel", 'center');
            this.props.navigation.navigate('Home_customer')
            return false;
        }
    }

}
