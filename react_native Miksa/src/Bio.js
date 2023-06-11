import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, Image, TouchableOpacity, TextInput, BackHandler, Keyboard } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider } from './Provider/utilslib/Utils';
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
export default class Bio extends Component {

    _didFocusSubscription;
    _willBlurSubscription;

    constructor(props) {
        super(props);
        this.state = {
            bio: '',
        }

        this._didFocusSubscription = props.navigation.addListener('focus', payload =>
            BackHandler.addEventListener('hardwareBackPress', this.handleBackPress)
        );
    }

    componentDidMount() {
        this._willBlurSubscription = this.props.navigation.addListener('blur', payload =>
            BackHandler.removeEventListener('hardwareBackPress', this.handleBackPress)
        );
    }

    handleBackPress = () => {
        this.props.navigation.navigate('Login')
        return true;
    };

    backpress = () => {
        this.props.navigation.navigate('Login');
    }

    submitBioToServer = async () => {
        let user_id = await localStorage.getItemObject('user_id');
        let bio = this.state.bio;
        if (bio.length <= 0) {
            msgProvider.toast(Lang_chg.emptyBio[config.language], 'center')
            return false
        }
        if (bio.length <= 4) {
            msgProvider.toast(Lang_chg.BioMinLength[config.language], 'center')
            return false
        }
        if (bio.length > 250) {
            msgProvider.toast(Lang_chg.BioMaxLength[config.language], 'center')
            return false
        }

        var data = new FormData();
        data.append("user_id_post", user_id)
        data.append("signup_type", "bio")
        data.append("bio", bio)

        let url = config.baseURL + "signup_step2.php";

        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('signup step5', obj);
            if (obj.success == 'true') {
                this.props.navigation.navigate('Upload_covid');
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
                <KeyboardAwareScrollView>
                    <View style={styles.map_top}>
                        <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                            <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                        </TouchableOpacity>
                        <Text></Text>
                        <Text></Text>
                    </View>

                    <View style={styles.select_servicepage}>
                        <View>
                            <Text style={styles.selec_ro_serice}>
                                {Lang_chg.txt_bio_txxt[config.language]}
                            </Text>
                            <Text style={styles.selec_ro_psg}>
                                {Lang_chg.txt_bio_txxt1[config.language]}
                            </Text>
                        </View>
                        <View style={styles.bio_self}>
                            <TextInput
                                style={[styles.txtinput, { height: 90, textAlignVertical: 'top', fontSize: 18, }]}
                                onChangeText={this.handleTextChange}
                                multiline={true}
                                placeholder={Lang_chg.txt_bio_decribe_hare[config.language]}
                                placeholderTextColor="#b8b8b8"
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                maxLength={250}
                                minLength={5}
                                ref={(input) => { this.textinput = input; }}
                                onChangeText={(txt) => { this.setState({ bio: txt }) }}
                                value={this.state.bio}
                            />
                        </View>
                    </View>

                </KeyboardAwareScrollView>
                <View style={[styles.login_btneter, { position: 'absolute', bottom: 40 }]}>
                    <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.submitBioToServer() }}>
                        <Text style={styles.btn_txt}>{Lang_chg.txt_select_service_counti[config.language]}</Text>
                    </TouchableOpacity>
                </View>
            </View>
        )
    }
}


