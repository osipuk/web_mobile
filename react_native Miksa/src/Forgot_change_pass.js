import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, TextInput, Keyboard } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, validationprovider, SocialLogin } from './Provider/utilslib/Utils';
export default class Forgot_change_pass extends Component {
    constructor(props) {
        super(props)
        this.state = {
            password: '',
            cpassword: '',
            HidePassword: true,
            HidePassword1: true,
            user_id: this.props.route.params.user_id,
        }
    }



    backpress = () => {
        this.props.navigation.goBack();
    }

    btnSubmitData = async () => {
        var password = this.state.password;
        var cpassword = this.state.cpassword;
        var user_id = this.state.user_id;
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
        //cpassword===================
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

        let url = config.baseURL + "forget_password_reset.php?password=" + password + "&user_id=" + user_id;
        consolepro.consolelog('Forgot change pass data', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Forgot change pass data', obj);
            if (obj.success == 'true') {
                msgProvider.toast(obj.msg[config.language], 'center')
                this.props.navigation.navigate('Login')
                return false
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
                    <Text style={styles.map_title}>{Lang_chg.change_language_txt[config.language]}</Text>
                    <Text></Text>
                </View>

                <View style={styles.change_pass_body}>



                    <View style={styles.change_pass_view}>
                        <View style={styles.pass_change_left}>
                            <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/lock1.png')}></Image>
                        </View>
                        <View style={styles.pass_change_middle}>
                            <TextInput
                                style={styles.input_main}
                                placeholder="New Password"
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                secureTextEntry={this.state.HidePassword}
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

                    <View style={styles.change_pass_view}>
                        <View style={styles.pass_change_left}>
                            <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/lock1.png')}></Image>
                        </View>
                        <View style={styles.pass_change_middle}>
                            <TextInput
                                style={styles.input_main}
                                placeholder="Confirm New Password"
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                secureTextEntry={this.state.HidePassword1}
                                onChangeText={(txt) => { this.setState({ cpassword: txt }) }}
                                minLength={6}
                                maxLength={16}
                            />
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

                    <View style={styles.login_btn, { marginTop: 30, width: '100%' }}>
                        <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnSubmitData() }}>
                            <Text style={styles.btn_txt}>{Lang_chg.txt_Submit[config.language]}</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </View>
        )
    }
}
