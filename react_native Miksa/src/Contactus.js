import React, { Component } from 'react'
import { Text, View, SafeAreaView, TouchableOpacity, Image, StatusBar, TextInput, Keyboard, } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider } from './Provider/utilslib/Utils';
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
export default class Contactus extends Component {
    constructor(props) {
        super(props)
        this.state = {
            user_name: '',
            email: '',
            user_id: '',
            message: '',
        }
        this._setUserProfile();
    }
    backpress = () => {
        this.props.navigation.goBack();
    }

    _setUserProfile = async () => {
        let result = await localStorage.getItemObject('user_arr');
        console.log('result', result);
        if (result != null) {
            var email = '';
            if (result.email != null) {
                email = result.email;
            }
            this.setState({
                user_name: result.name,
                email: email,
                user_id: result.user_id,
            })
        }
    }

    _btnSubmitContact = () => {
        Keyboard.dismiss()
        let { user_name, email, user_id, message } = this.state;
        //name===================
        if (user_name.length <= 0) {
            msgProvider.toast(Lang_chg.emptyName[config.language], 'center')
            return false
        }
        if (user_name.length <= 2) {
            msgProvider.toast(Lang_chg.minlenName[config.language], 'center')
            return false
        }
        if (user_name.length > 50) {
            msgProvider.toast(Lang_chg.maxlenName[config.language], 'center')
            return false
        }

        //email============================
        if (email.length <= 0) {
            msgProvider.toast(Lang_chg.emptyEmail[config.language], 'center')
            return false
        }
        if (email.length > 50) {
            msgProvider.toast(Lang_chg.emailMaxLength[config.language], 'center')
            return false
        }
        const reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (reg.test(email) !== true) {
            msgProvider.toast(Lang_chg.validEmail[config.language], 'center')
            return false
        }

        //message==================
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
        let url = config.baseURL + "contact_us.php";
        console.log(url);
        var data = new FormData();
        data.append('contact_us_name', user_name)
        data.append('contact_email', email)
        data.append('contact_message', message)
        data.append('user_id_post', user_id)

        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('contact us', obj);
            if (obj.success == 'true') {
                msgProvider.toast(obj.msg[config.language], 'center')
                this.props.navigation.goBack();
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
                    <Text style={styles.map_title}>{Lang_chg.txt_contact_txt1[config.language]}</Text>
                    <Text></Text>
                </View>
                <KeyboardAwareScrollView>
                    <View style={styles.contact_body}>
                        <View>
                            <Text style={styles.contact_title}>{Lang_chg.txt_contact_txt2[config.language]}</Text>
                            <Text style={styles.contact_support_title}>‘Support.Android@wordown.com’</Text>
                        </View>


                        <View style={styles.contact_box}>
                            <View style={styles.contact_Left}>
                                <Image resizeMode="contain" style={{ width: 17, height: 17 }} source={require('./icons/user.png')}></Image>
                            </View>
                            <View style={styles.contact_right}>
                                <TextInput
                                    style={[styles.input_main, { fontSize: 18 }]}
                                    placeholder={Lang_chg.txt_contact_txt_name[config.language]}
                                    returnKeyLabel='done'
                                    returnKeyType='done'
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    onChangeText={(txt) => { this.setState({ user_name: txt }) }}
                                    maxLength={50}
                                    minLength={6}
                                    value={this.state.user_name}
                                    keyboardType='default'
                                />

                            </View>
                        </View>
                        <View style={styles.contact_box}>
                            <View style={styles.contact_Left}>
                                <Image resizeMode="contain" style={{ width: 19, height: 19, marginTop: 2 }} source={require('./icons/mail.png')}></Image>
                            </View>
                            <View style={styles.contact_right}>
                                <TextInput
                                    style={[styles.input_main, { fontSize: 18 }]}
                                    placeholder={Lang_chg.txt_contact_txt_emeil[config.language]}
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    onChangeText={this.handleEmail}
                                    keyboardType="email-address"
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ email: txt }) }}
                                    maxLength={50}
                                    value={this.state.email}
                                />
                            </View>
                        </View>

                        <View style={styles.contact_box}>
                            <View style={styles.contact_Left}>
                                <Image resizeMode="contain" style={{ width: 18, height: 18, position: 'absolute', bottom: 33 }} source={require('./icons/edit.png')}></Image>
                            </View>
                            <View style={styles.contact_right}>
                                <TextInput
                                    style={[styles.txtinput, { height: 120, textAlignVertical: 'top', fontSize: 18, paddingLeft: 15, }]}
                                    onChangeText={this.handleTextChange}
                                    multiline={true}
                                    placeholder={Lang_chg.txt_message[config.language]}
                                    returnKeyLabel='done'
                                    returnKeyType='done'
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    onChangeText={(txt) => { this.setState({ message: txt }) }}
                                    maxLength={250}
                                    minLength={3}
                                    value={this.state.message}
                                    keyboardType='default'
                                />
                            </View>
                        </View>

                        <TouchableOpacity style={{ width: '98%', backgroundColor: '#0088e0', height: 50, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginTop: 20, }} activeOpacity={0.9} onPress={() => { this._btnSubmitContact('Setting') }}>
                            <Text style={styles.btn_txt}>{Lang_chg.txt_send[config.language]}</Text>
                        </TouchableOpacity>


                        {/* <View style={styles.login_btn, { marginTop: 10, width: '100%' }}>
                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} >
                                
                            </TouchableOpacity>
                        </View> */}
                    </View>
                </KeyboardAwareScrollView>
            </View>
        )
    }
}