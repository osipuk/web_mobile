import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, TextInput, Keyboard } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, validationprovider } from './Provider/utilslib/Utils';
export default class Change_password_p extends Component {
    constructor(props) {
        super(props)
        this.state = {
            c_pass: '',
            new_pass: '',
            old_pass: '',
            HidePassword: true,
            HidePassword1: true,
            HidePassword2: true,
            isConnected: true,
            loading: false,
        }
    }
    backpress = () => {
        this.props.navigation.goBack();
    }

    _btnChangePassword = async () => {
        let result = await localStorage.getItemObject('user_arr');
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        Keyboard.dismiss()
        let { c_pass, new_pass, old_pass } = this.state;


        if (await validationprovider.spaceCheck(old_pass) != true) {
            msgProvider.toast(Lang_chg.spacePasswordoldMaxLength[config.language], 'center')
            return false
        }

        //old password==============
        if (old_pass.length <= 0) {
            msgProvider.toast(Lang_chg.emptyoldPassword[config.language], 'center');
            return false;
        }
        if (old_pass.length <= 5) {
            msgProvider.toast(Lang_chg.PasswordoldMinLength[config.language], 'center');
            return false;
        }
        if (old_pass.length >= 17) {
            msgProvider.toast(Lang_chg.PasswordoldMaxLength[config.language], 'center');
            return false;
        }



        //new password==============
        if (await validationprovider.spaceCheck(new_pass) != true) {
            msgProvider.toast(Lang_chg.spacePasswordnewMaxLength[config.language], 'center')
            return false
        }
        if (new_pass.length <= 0) {
            msgProvider.toast(Lang_chg.emptyNewPassword[config.language], 'center');
            return false;
        }
        if (new_pass.length <= 5) {
            msgProvider.toast(Lang_chg.PasswordNewMinLength[config.language], 'center');
            return false;
        }
        if (new_pass.length >= 17) {
            msgProvider.toast(Lang_chg.PasswordNewMaxLength[config.language], 'center');
            return false;
        }
        //confirm password==============
        if (await validationprovider.spaceCheck(c_pass) != true) {
            msgProvider.toast(Lang_chg.spacePasswordcMaxLength[config.language], 'center')
            return false
        }
        if (c_pass.length <= 0) {
            msgProvider.toast(Lang_chg.emptyConfirmPWD[config.language], 'center');
            return false;
        }
        if (c_pass.length <= 5) {
            msgProvider.toast(Lang_chg.ConfirmPWDMinLength[config.language], 'center');
            return false;
        }
        if (c_pass.length >= 17) {
            msgProvider.toast(Lang_chg.ConfirmPWDMaxLength[config.language], 'center');
            return false;
        }

        if (c_pass != new_pass) {
            msgProvider.toast(Lang_chg.ConfirmPWDMatch[config.language], 'center');
            return false;
        }
        //  this.props.navigation.navigate('Setting_p') 

        let url = config.baseURL + "change_password.php";
        var data = new FormData();
        data.append('password_old', old_pass)
        data.append('password_new', new_pass)
        data.append('user_id_post', user_id_post)

        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('Edit profile data', obj);
            if (obj.success == 'true') {
                localStorage.setItemString('password', new_pass.toString());
                msgProvider.toast(obj.msg[config.language], 'center')
                this.props.navigation.goBack();
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
                            <Image style={{ width: 19, height: 19, marginRight: 10 }} resizeMode="contain" source={require('./icons/lock1.png')}></Image>
                        </View>
                        <View style={styles.pass_change_middle}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.old_pass_txt[config.language]}
                                returnKeyLabel='done'
                                returnKeyType='done'
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                onChangeText={(txt) => { this.setState({ old_pass: txt }) }}
                                maxLength={16}
                                minLength={6}
                                value={this.state.old_pass}
                                keyboardType='default'
                                secureTextEntry={this.state.HidePassword}
                            />
                        </View>

                        <TouchableOpacity style={styles.pass_change_right} onPress={() => { this.setState({ HidePassword: !this.state.HidePassword }) }}>
                            {
                                this.state.HidePassword ?
                                    <Image style={styles.contact_Icon} source={require('./icons/eye.png')} resizeMode="contain" />
                                    :
                                    <Image style={styles.contact_Icon} source={require('./icons/eye_close.png')} resizeMode="contain" />

                            }
                        </TouchableOpacity>

                    </View>

                    <View style={styles.change_pass_view}>
                        <View style={styles.pass_change_left}>
                            <Image style={{ width: 19, height: 19, marginRight: 10 }} resizeMode="contain" source={require('./icons/lock1.png')}></Image>
                        </View>
                        <View style={styles.pass_change_middle}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.new_pass_txt[config.language]}
                                returnKeyLabel='done'
                                returnKeyType='done'
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                onChangeText={(txt) => { this.setState({ new_pass: txt }) }}
                                maxLength={16}
                                minLength={6}
                                value={this.state.new_pass}
                                keyboardType='default'
                                secureTextEntry={this.state.HidePassword1}
                            />
                        </View>
                        <TouchableOpacity style={styles.pass_change_right} onPress={() => { this.setState({ HidePassword1: !this.state.HidePassword1 }) }}>
                            {
                                this.state.HidePassword1 ?
                                    <Image style={styles.contact_Icon} source={require('./icons/eye.png')} resizeMode="contain" />
                                    :
                                    <Image style={styles.contact_Icon} source={require('./icons/eye_close.png')} resizeMode="contain" />

                            }
                        </TouchableOpacity>
                    </View>

                    <View style={styles.change_pass_view}>
                        <View style={styles.pass_change_left}>
                            <Image style={{ width: 19, height: 19, marginRight: 10 }} resizeMode="contain" source={require('./icons/lock1.png')}></Image>
                        </View>
                        <View style={styles.pass_change_middle}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.c_pass_txt[config.language]}
                                returnKeyLabel='done'
                                returnKeyType='done'
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                onChangeText={(txt) => { this.setState({ c_pass: txt }) }}
                                maxLength={16}
                                minLength={6}
                                value={this.state.c_pass}
                                keyboardType='default'
                                secureTextEntry={this.state.HidePassword2}
                            />
                        </View>
                        <TouchableOpacity style={styles.pass_change_right} onPress={() => { this.setState({ HidePassword2: !this.state.HidePassword2 }) }}>
                            {
                                this.state.HidePassword2 ?
                                    <Image style={styles.contact_Icon} source={require('./icons/eye.png')} resizeMode="contain" />
                                    :
                                    <Image style={styles.contact_Icon} source={require('./icons/eye_close.png')} resizeMode="contain" />

                            }
                        </TouchableOpacity>
                    </View>



                    <TouchableOpacity style={{ width: '98%', backgroundColor: '#0088e0', height: 50, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginTop: 20, marginTop: 70 }} activeOpacity={0.9} onPress={() => { this._btnChangePassword() }}>
                        <Text style={styles.btn_txt}>{Lang_chg.txt_Submit[config.language]}</Text>
                    </TouchableOpacity>

                </View>
            </View>
        )
    }
}
