import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Modal, Dimensions, Image, Switch, ScrollView, Alert } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileW } from './Provider/utilslib/Utils';
import { contents } from './Contents'
import { firebaseprovider } from './Provider/FirebaseProvider'
const screenwidth = Dimensions.get('window').width;
export default class Setting_p extends Component {
    constructor(props) {
        super(props)
        this.state = {
            user_id: 0,
            notification: false,
            otppopup: false,
            user_type: 0,
            signup_type: 0
        }
        this.setProfileData();
    }

    backpress = () => {
        this.props.navigation.goBack();
    }

    componentDidMount() {

    }

    setProfileData = async () => {
        let result = await localStorage.getItemObject('user_arr')
        consolepro.consolelog('result', result)
        if (result != null) {
            var notification_status = result.notification_status;
            if (notification_status == 0) {
                notification_status = false;
            } else {
                notification_status = true;
            }
            this.setState({
                user_id: result.user_id,
                user_type: result.user_type,
                notification: notification_status,
                signup_type: result.login_type_first,
            })
        }
    }

    _appLogout = (navigation) => {
        Alert.alert(Lang_chg.Confirm[config.language], Lang_chg.msgConfirmTextLogoutMsg[config.language], [
            {
                text: Lang_chg.cancel[config.language],
                onPress: () => { console.log('nothing') },
                style: "cancel"
            },
            { text: Lang_chg.Yes[config.language], onPress: () => { config.AppLogout(navigation) } }
        ], { cancelable: false });
        // config.checkUserDeactivate(navigation);
    }

    notificaionOnOff = async (value) => {
        var notification = 0;
        if (value == false) {
            notification = 0;
        } else {
            notification = 1;
        }

        let userdata = await localStorage.getItemObject('user_arr')
        let user_id = 0
        if (userdata != null) {
            user_id = userdata.user_id
        }

        let url = config.baseURL + "notification_on_off.php?user_id_post=" + user_id + "&notification_status=" + notification;
        consolepro.consolelog('Notification on off', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Notification on off', obj);
            if (obj.success == 'true') {
                let user_details = obj.user_details;
                localStorage.setItemObject('user_arr', user_details);
                this.setState({ notification: value })
                setTimeout(() => {
                    firebaseprovider.firebaseUserCreate();
                }, 1500);
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
            <View style={{ flex: 1, height: '100%', backgroundColor: '#ffffff', }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />


                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text style={styles.map_title}>{Lang_chg.txt_settings[config.language]}</Text>
                    <Text></Text>
                </View>

                <View style={styles.setting_body}>
                    <ScrollView showsVerticalScrollIndicator={false}>
                        <View style={{ width: '90%', alignSelf: 'center' }}>
                            <View>
                                <Text style={styles.setting_Account}>{Lang_chg.txt_settings_acc[config.language]}</Text>
                            </View>
                            <View style={styles.setting_toggles}>
                                <Text style={styles.setting_pust}>{Lang_chg.txt_settings_push[config.language]}</Text>
                                <View>
                                    <Switch
                                        style={styles.push_onof}
                                        trackColor={{ false: '#a4a2a1', true: '#00aff0' }}
                                        thumbColor={"#fff"}
                                        ios_backgroundColor="#00aff0"
                                        onValueChange={(txt) => { this.notificaionOnOff(txt) }}
                                        value={this.state.notification}
                                    />
                                </View>
                            </View>
                            <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { (this.state.user_type == 2) ? this.props.navigation.navigate('Edit_profile_p') : this.props.navigation.navigate('Edit_profile') }}>
                                <Text style={styles.setting_pust}>{Lang_chg.txt_settings_edit_pro[config.language]}</Text>
                            </TouchableOpacity>
                            {
                                (this.state.user_type == 2) &&
                                <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this.props.navigation.navigate('Edit_bank_details') }}>
                                    <Text style={styles.setting_pust}>{Lang_chg.txt_settings_edit_bank_edit[config.language]}</Text>
                                </TouchableOpacity>
                            }
                            {
                                (this.state.signup_type == 0) &&
                                <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this.props.navigation.navigate('Change_password_p') }}>
                                    <Text style={styles.setting_pust}>{Lang_chg.change_language_txt[config.language]}</Text>
                                </TouchableOpacity>
                            }

                            {
                                (this.state.user_type == 1) &&
                                <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this.props.navigation.navigate('Wallet_p') }}>
                                    <Text style={styles.setting_pust}>{Lang_chg.txt_settings_wallet[config.language]}</Text>
                                </TouchableOpacity>
                            }

                            {
                                (this.state.user_type == 2) &&
                                <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this.props.navigation.navigate('Earnings_p') }}>
                                    <Text style={styles.setting_pust}>{Lang_chg.txt_settings_Earnings[config.language]}</Text>
                                </TouchableOpacity>
                            }


                            {
                                (this.state.user_type == 2)
                                &&
                                <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this.props.navigation.navigate('Change_user_services') }}>
                                    <Text style={styles.setting_pust}>{Lang_chg.txt_settings_chn_services[config.language]}</Text>
                                </TouchableOpacity>
                            }
                            {
                                (this.state.user_type == 2)
                                &&
                                <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this.props.navigation.navigate('Change_covid') }}>
                                    <Text style={styles.setting_pust}>{Lang_chg.txt_settings_chn_covid[config.language]}</Text>
                                </TouchableOpacity>
                            }
                            {
                                (this.state.user_type == 2)
                                &&
                                <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this.props.navigation.navigate('House_sketch_change') }}>
                                    <Text style={styles.setting_pust}>{Lang_chg.txt_settings_chn_house_ske[config.language]}</Text>
                                </TouchableOpacity>
                            }
                        </View>
                        <View style={{ width: mobileW, borderColor: '#dedad9', borderWidth: 0.5 }}></View>
                        <View style={{ width: '90%', alignSelf: 'center' }}>

                            <View>
                                <Text style={styles.setting_Account}>{Lang_chg.txt_settings_support[config.language]}</Text>
                            </View>
                            <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { contents.btnTermCondi(this.props.navigation) }}>
                                <Text style={styles.setting_pust}>{Lang_chg.txt_term_condi[config.language]}</Text>
                            </TouchableOpacity>
                            <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { contents.btnPrivacyPolicy(this.props.navigation) }}>
                                <Text style={styles.setting_pust}>{Lang_chg.txt_pri_poli[config.language]}</Text>
                            </TouchableOpacity>
                            <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { contents.btnAboutUs(this.props.navigation) }}>
                                <Text style={styles.setting_pust}>{Lang_chg.txt_settings_about[config.language]}</Text>
                            </TouchableOpacity>
                            <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this.props.navigation.navigate('Faq') }}>
                                <Text style={styles.setting_pust}>{Lang_chg.txt_settings_faq[config.language]}</Text>
                            </TouchableOpacity>
                            {/* <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt}>
                <Text style={styles.setting_pust}>FAQ</Text>
                </TouchableOpacity> */}
                            <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this.props.navigation.navigate('Contactus') }}>
                                <Text style={styles.setting_pust}>{Lang_chg.txt_contact_txt1[config.language]}</Text>
                            </TouchableOpacity>
                            <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { contents.btnShareApp(this.props.navigation) }}>
                                <Text style={styles.setting_pust}>{Lang_chg.txt_settings_share_app[config.language]}</Text>
                            </TouchableOpacity>
                            <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { contents.btnRateApp(this.props.navigation) }}>
                                <Text style={styles.setting_pust}>{Lang_chg.txt_settings_rate_app[config.language]}</Text>
                            </TouchableOpacity>
                            <TouchableOpacity activeOpacity={1} style={styles.setting_btn_txt} onPress={() => { this._appLogout(this.props.navigation) }}>
                                <Text style={styles.setting_logout}>{Lang_chg.txt_settings_logout[config.language]}</Text>
                            </TouchableOpacity>
                        </View>
                    </ScrollView>
                </View>
            </View>
        )
    }
}
