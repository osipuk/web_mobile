import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, Modal, TouchableOpacity, Image, Keyboard, TextInput, BackHandler } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, validationprovider } from './Provider/utilslib/Utils';
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
import HideWithKeyboard from 'react-native-hide-with-keyboard';
export default class Edit_bank_details extends Component {

    constructor(props) {
        super(props);
        this.state = {
            show_popup_account_type: false,
            account_type: 0,
            bank_name: '',
            account_no: '',
            identification_no: '',
            acount_type_modal: false,
            phone_no: '',
            email: '',
            surname: '',
            second_surname: '',
            name: '',
            bank_id: 0,
        }

    }

    backpress = () => {
        this.props.navigation.goBack();
    }

    componentDidMount() {
        setTimeout(() => {
            this.getProfileData();
        }, 200);
    }


    getProfileData = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;

        }

        let url = config.baseURL + "bank_details.php?user_id_post=" + user_id_post;
        consolepro.consolelog('bank data', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('bank data', obj);
            if (obj.success == 'true') {
                if (obj.bank_details != 'NA') {
                    this.setState({
                        account_type: obj.bank_details.account_type,
                        bank_name: obj.bank_details.bank_name,
                        account_no: obj.bank_details.account_number,
                        identification_no: obj.bank_details.identification_number,
                        bank_id: obj.bank_details.bank_id,
                        phone_no: obj.bank_details.bank_phone_no,
                        email: obj.bank_details.bank_email,
                        surname: obj.bank_details.bank_surname,
                        second_surname: obj.bank_details.second_surname,
                        name: obj.bank_details.bank_name1,
                    })
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
            console.log('err', err);
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
        });
    }

    changeAccountType = async (acc_type) => {
        this.setState({
            show_popup_account_type: false,
            account_type: parseInt(acc_type)
        });
    }

    submitBankDetails = async () => {

        let user_id = await localStorage.getItemObject('user_id');

        Keyboard.dismiss()
        let { account_type, bank_name, account_no, identification_no, phone_no, email, surname, second_surname, name, bank_id } = this.state;

        if (bank_name.length <= 0) {
            msgProvider.toast(Lang_chg.emptyBank_name[config.language], 'center')
            return false
        }


        // if (bank_name.length < 3) {
        //     msgProvider.toast(Lang_chg.BanknameMinLength[config.language], 'center')
        //     return false
        // }

        // if (bank_name.length > 50) {
        //     msgProvider.toast(Lang_chg.BanknameMaxLength[config.language], 'center')
        //     return false
        // }
        //name ===================
        if (name.length <= 0) {
            msgProvider.toast(Lang_chg.emptyFirstName1[config.language], 'center')
            return false
        }
        if (name.length <= 2) {
            msgProvider.toast(Lang_chg.FirstNameMinLength1[config.language], 'center')
            return false
        }
        if (name.length > 50) {
            msgProvider.toast(Lang_chg.FirstNameMaxLength1[config.language], 'center')
            return false
        }


        //surname ===================
        if (surname.length <= 0) {
            msgProvider.toast(Lang_chg.emptyFirstName12[config.language], 'center')
            return false
        }
        if (surname.length <= 2) {
            msgProvider.toast(Lang_chg.FirstNameMinLength12[config.language], 'center')
            return false
        }
        if (surname.length > 50) {
            msgProvider.toast(Lang_chg.FirstNameMaxLength12[config.language], 'center')
            return false
        }

        //2surname ===================
        if (second_surname.length <= 0) {
            msgProvider.toast(Lang_chg.emptyFirstName123[config.language], 'center')
            return false
        }
        if (second_surname.length <= 2) {
            msgProvider.toast(Lang_chg.FirstNameMinLength123[config.language], 'center')
            return false
        }
        if (second_surname.length > 50) {
            msgProvider.toast(Lang_chg.FirstNameMaxLength123[config.language], 'center')
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
        if (await validationprovider.emailCheck(email) != true) {
            msgProvider.toast(Lang_chg.validEmail[config.language], 'center')
            return false
        }


        // mobile_no=====================
        if (phone_no.length <= 0) {
            msgProvider.toast(Lang_chg.emptyMobile1[config.language], 'center')
            return false
        }
        if (phone_no.length < 8) {
            msgProvider.toast(Lang_chg.MobileMinLength1[config.language], 'center')
            return false
        }
        if (phone_no.length > 12) {
            msgProvider.toast(Lang_chg.MobileMaxLength1[config.language], 'center')
            return false
        }

        if (await validationprovider.digitCheck(phone_no) != true) {
            msgProvider.toast(Lang_chg.validMobile1[config.language], 'center')
            return false
        }


        if (account_type == 2) {
            msgProvider.toast(Lang_chg.emptyAccountType[config.language], 'center')
            return false
        }
        // acc number=====================
        if (account_no.length <= 0) {
            msgProvider.toast(Lang_chg.emptyAccNo[config.language], 'center')
            return false
        }

        // if (account_no.length < 14) {
        //     msgProvider.toast(Lang_chg.AccNoMinLength[config.language], 'center')
        //     return false
        // }

        // if (account_no.length > 20) {
        //     msgProvider.toast(Lang_chg.AccNoMaxLength[config.language], 'center')
        //     return false
        // }

        // if (await validationprovider.digitCheck(account_no) != true) {
        //     msgProvider.toast(Lang_chg.AccNoVailidLength[config.language], 'center')
        //     return false
        // }

        //identification no===================
        if (identification_no.length <= 0) {
            msgProvider.toast(Lang_chg.emptyIdentification[config.language], 'center')
            return false
        }
        // if (identification_no.length <= 4) {
        //     msgProvider.toast(Lang_chg.identificationMinLength[config.language], 'center')
        //     return false
        // }
        // if (identification_no.length > 20) {
        //     msgProvider.toast(Lang_chg.identificationMaxLength[config.language], 'center')
        //     return false
        // }

        // if (await validationprovider.digitCheck(identification_no) != true) {
        //     msgProvider.toast(Lang_chg.vailidIdentification[config.language], 'center')
        //     return false
        // }
        var data = new FormData();
        data.append("user_id_post", user_id)
        data.append("account_number", account_no)
        data.append("bank_name", bank_name)
        data.append("account_type", account_type)
        data.append("identification_number", identification_no)
        data.append("phone_no", phone_no)
        data.append("email", email)
        data.append("surname", surname)
        data.append("second_surname", second_surname)
        data.append("name", name)
        data.append("bank_id", bank_id)

        consolepro.consolelog('data', data);
        let url = config.baseURL + "edit_bank.php";
        consolepro.consolelog('signup step', url);
        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('signup step', obj);
            if (obj.success == 'true') {
                this.textinput.clear();
                msgProvider.toast(obj.msg[config.language], 'center')
                this.props.navigation.goBack();
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
                <Modal
                    animationType="slide"
                    transparent={true}
                    visible={this.state.acount_type_modal}
                    onRequestClose={() => { this.setState({ acount_type_modal: !this.state.acount_type_modal }) }}
                >
                    <View style={{ backgroundColor: "#00000030", flex: 1, alignItems: "center", justifyContent: "center", paddingHorizontal: 20 }}>
                        <StatusBar backgroundColor={color1.theme_color} barStyle='default' hidden={false} translucent={false}
                            networkActivityIndicatorVisible={true} />
                        <View style={{ width: "100%", position: 'absolute', bottom: 20 }}>

                            <View style={{ backgroundColor: "#ffffff", width: "100%", height: 110 }}>
                                <TouchableOpacity activeOpacity={1}
                                    style={styles.dropDown}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, alignSelf: 'center' }}>{Lang_chg.txt_bank_Check12[config.language]}</Text>
                                </TouchableOpacity>
                                <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 2 }}></View>
                                <TouchableOpacity
                                    style={(this.state.account_type == 0) ? styles.dropDown1 : styles.dropDown}
                                    onPress={() => { this.setState({ account_type: 0, acount_type_modal: !this.state.acount_type_modal }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>{Lang_chg.txt_bank_Check[config.language]}</Text>
                                </TouchableOpacity>
                                <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 2 }}></View>
                                <TouchableOpacity
                                    style={(this.state.account_type == 1) ? styles.dropDown1 : styles.dropDown}
                                    onPress={() => { this.setState({ account_type: 1, acount_type_modal: !this.state.acount_type_modal }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>{Lang_chg.txt_bank_Saving[config.language]}</Text>
                                </TouchableOpacity>
                            </View>
                        </View>
                    </View>
                </Modal>
                <KeyboardAwareScrollView>
                    <View style={styles.map_top}>
                        <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                            <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                        </TouchableOpacity>
                        <Text style={styles.map_title}>{Lang_chg.txt_settings_edit_bank_edit[config.language]}</Text>
                        <Text></Text>
                    </View>

                    <View style={styles.bankody}>
                        <View style={{ marginBottom: 15 }}>
                            <Text style={styles.bankdt}>{Lang_chg.txt_edit_pro_p_edit_bank_details[config.language]}</Text>
                            <Text style={styles.bankenter}>{Lang_chg.txt_enter_bank_details1[config.language]}</Text>
                        </View>

                        {/* ==================Bank Name =================== */}
                        <View style={styles.bankname}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.txt_bank_name[config.language]}
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                minLength={3}
                                ref={(input) => { this.textinput = input; }}
                                onChangeText={(txt) => { this.setState({ bank_name: txt }) }}
                                value={this.state.bank_name}
                            />
                        </View>
                        {/* ==================Bank Name =================== */}


                        {/* ================== Names =================== */}
                        <View style={styles.bankname}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.name_txt12[config.language]}
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                minLength={3}
                                maxLength={50}
                                ref={(input) => { this.textinput = input; }}
                                onChangeText={(txt) => { this.setState({ name: txt }) }}
                                value={this.state.name}
                            />
                        </View>
                        {/* ================== Names =================== */}

                        {/* ================== Names =================== */}
                        <View style={styles.bankname}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.txt_surname[config.language]}
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                minLength={3}
                                maxLength={50}
                                ref={(input) => { this.textinput = input; }}
                                onChangeText={(txt) => { this.setState({ surname: txt }) }}
                                value={this.state.surname}
                            />
                        </View>
                        {/* ================== Names =================== */}
                        {/* ==================Second Names =================== */}
                        <View style={styles.bankname}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.txt_2_surname[config.language]}
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                minLength={3}
                                ref={(input) => { this.textinput = input; }}
                                onChangeText={(txt) => { this.setState({ second_surname: txt }) }}
                                value={this.state.second_surname}
                            />
                        </View>
                        {/* ==================Second Names =================== */}

                        {/* ==================Email=================== */}
                        <View style={styles.bankname}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.txt_contact_txt_emeil[config.language]}
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                minLength={3}
                                keyboardType="email-address"
                                ref={(input) => { this.textinput = input; }}
                                onChangeText={(txt) => { this.setState({ email: txt }) }}
                                value={this.state.email}
                            />
                        </View>
                        {/* ==================Email=================== */}

                        {/* ================== Phone Number =================== */}
                        <View style={styles.bankname}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.txt_phone_numer[config.language]}
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                minLength={3}
                                keyboardType="phone-pad"
                                ref={(input) => { this.textinput = input; }}
                                onChangeText={(txt) => { this.setState({ phone_no: txt }) }}
                                value={this.state.phone_no}
                            />
                        </View>
                        {/* ================== Phone Number =================== */}


                        <View>
                            <TouchableOpacity activeOpacity={1} style={styles.typeofaccount} onPress={() => { this.setState({ acount_type_modal: !this.state.acount_type_modal }) }}>
                                {
                                    (this.state.account_type == 2) &&
                                    <Text style={styles.banktypename}>{Lang_chg.txt_bank_types_off_acc[config.language]}</Text>
                                }
                                {
                                    (this.state.account_type == 0) &&
                                    <Text style={styles.banktypename}>{Lang_chg.txt_bank_Check[config.language]}</Text>
                                }
                                {
                                    (this.state.account_type == 1) &&
                                    <Text style={styles.banktypename}>{Lang_chg.txt_bank_Saving[config.language]}</Text>
                                }
                                <Image resizeMode="contain" style={{ width: 20, height: 15 }} source={require('./icons/down3.png')}></Image>
                            </TouchableOpacity>
                        </View>
                        <View style={styles.bankname}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.txt_bank_acc_number[config.language]}
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                minLength={5}
                                ref={(input) => { this.textinput = input; }}
                                onChangeText={(txt) => { this.setState({ account_no: txt }) }}
                                value={this.state.account_no}
                            />
                        </View>
                        <View style={styles.bankname}>
                            <TextInput
                                style={styles.input_main}
                                placeholder={Lang_chg.txt_identification_no[config.language]}
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                minLength={5}
                                ref={(input) => { this.textinput = input; }}
                                onChangeText={(txt) => { this.setState({ identification_no: txt }) }}
                                value={this.state.identification_no}
                            />
                        </View>
                    </View>
                    <View style={{
                        width: '90%',
                        alignSelf: 'center', marginTop: 20, marginBottom: 20
                    }}>
                        <TouchableOpacity style={[styles.btn_login]} activeOpacity={0.9} onPress={() => { this.submitBankDetails() }}>
                            <Text style={styles.btn_txt}>{Lang_chg.txt_edit_pro_update[config.language]}</Text>
                        </TouchableOpacity>
                    </View>
                </KeyboardAwareScrollView>
            </View>
        )
    }
}
