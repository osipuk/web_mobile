import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, Image, TextInput, TouchableOpacity, Dimensions } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js"
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileW, mobileH, notification } from './Provider/utilslib/Utils';
import StarRating from 'react-native-star-rating';
const screenWidth = Dimensions.get('window').width;
const screenHeight = Dimensions.get('window').height;
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
export default class Cancel_job extends Component {
    constructor(props) {
        super(props)
        this.state = {
            job_id: this.props.route.params.job_id,
            message: '',
            report_modal: false
        }
    }

    btnReportUser = async () => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        if (this.state.message.length == 0) {
            msgProvider.toast(Lang_chg.cancelResonTextErr[config.language], 'center')
            return false
        }

        let url = config.baseURL + "cancel_job.php?user_id_post=" + user_id_post + "&message=" + this.state.message + "&job_id=" + this.state.job_id;
        consolepro.consolelog('other user url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Other user data', obj);
            if (obj.success == 'true') {
                setTimeout(() => {
                    this.setState({ report_modal: false, message: '' })
                    this.props.navigation.goBack();
                }, 800);
                if (obj.notification_arr != 'NA') {
                    notification.oneSignalNotificationSendCall(obj.notification_arr)
                }
                msgProvider.toast(obj.msg[config.language], 'center')
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
            setTimeout(() => {
                this.setState({ report_modal: false })
            }, 500);
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
        });
    }

    backpress = () => {
        this.props.navigation.goBack();
    }

    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                <KeyboardAwareScrollView>
                    <View style={styles.map_top}>
                        <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                            <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                        </TouchableOpacity>
                        <Text style={styles.map_title}>Cancel Job</Text>
                        <Text></Text>
                    </View>


                    <View style={[styles.reportp_body, { flex: 1 }]}>

                        <View style={styles.contact_box}>
                            {/* <View style={styles.contact_Left}>
                            <Image resizeMode="contain" style={styles.contact_msgicon} source={require('./icons/edit.png')}></Image>
                        </View> */}
                            <View style={styles.contact_right}>
                                <TextInput
                                    style={[styles.txtinput, { height: 120, textAlignVertical: 'top', fontSize: 18, }]}
                                    onChangeText={(txt) => { this.setState({ message: txt }) }}
                                    multiline={true}
                                    placeholder="Enter Cancel Reason"
                                    placeholderTextColor="#b8b8b8"
                                    maxLength={250}
                                />
                            </View>
                        </View>

                        <View style={styles.login_btn, { marginTop: 10, width: '100%', marginTop: 30 }}>
                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnReportUser() }}>
                                <Text style={styles.btn_txt}>Submit</Text>
                            </TouchableOpacity>
                        </View>

                    </View>
                </KeyboardAwareScrollView>
            </View>
        )
    }
}