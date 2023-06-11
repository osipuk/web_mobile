import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, ScrollView, Image, TextInput, Keyboard, BackHandler } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mediaprovider, Cameragallery, validationprovider } from './Provider/utilslib/Utils';
export default class Change_covid extends Component {

    constructor(props) {
        super(props);
        this.state = {
            covid_report_status: false,
            recomndation_latter_status: false,
            covid_report: '',
            recomndation_latter: '',
            emp_name: '',
            mobile_no: '',
            covid_report_id: 0,
        }
        this.getProfileData();
    }

    componentDidMount() {

    }



    backpress = () => {
        this.props.navigation.goBack();
    }

    getProfileData = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;

        }

        let url = config.baseURL + "provider_profile_data.php?user_id_post=" + user_id_post;
        consolepro.consolelog('Forgot change pass data', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Forgot change pass data', obj);
            if (obj.success == 'true') {
                var profile_data = obj.user_data;
                this.setState({
                    covid_report: config.img_url1 + profile_data.covid_result_img,
                    recomndation_latter: config.img_url1 + profile_data.recomadation_later_img,
                    emp_name: profile_data.employer_name,
                    mobile_no: profile_data.mobile_no,
                    covid_report_id: profile_data.covid_report_id,
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
            console.log('err', err);
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
        });
    }


    _openCamera = () => {
        mediaprovider.launchCamera().then((obj) => {
            console.log(obj.path);
            this.setState({
                covid_report: obj.path,
                covid_report_status: false,
            })
        })
    }

    _openGellery = () => {
        mediaprovider.launchGellery().then((obj) => {
            console.log(obj.path);
            this.setState({
                covid_report: obj.path,
                covid_report_status: false,
            })
        })
    }

    closeMediaPopup = () => {
        this.setState({
            covid_report_status: false,
        })
    }


    _openCamera1 = () => {
        mediaprovider.launchCamera().then((obj) => {
            console.log(obj.path);
            this.setState({
                recomndation_latter: obj.path,
                recomndation_latter_status: false,
            })
        })
    }

    _openGellery1 = () => {
        mediaprovider.launchGellery().then((obj) => {
            console.log(obj.path);
            this.setState({
                recomndation_latter: obj.path,
                recomndation_latter_status: false,
            })
        })
    }

    closeMediaPopup1 = () => {
        this.setState({
            recomndation_latter_status: false,
        })
    }

    btnSubmitCovidToServer = async () => {
        let user_id = await localStorage.getItemObject('user_id');
        var mobile_no = this.state.mobile_no;
        var emp_name = this.state.emp_name;
        var covid_report = this.state.covid_report;
        var recomndation_latter = this.state.recomndation_latter;
        var covid_report_id = this.state.covid_report_id;

        if (covid_report == '') {
            msgProvider.toast(Lang_chg.emptyCovideReport[config.language], 'center')
            return false
        }
        if (recomndation_latter == '') {
            msgProvider.toast(Lang_chg.emptyRecommendation[config.language], 'center')
            return false
        }

        if (emp_name.length <= 0) {
            msgProvider.toast(Lang_chg.emptyEmp[config.language], 'center')
            return false
        }
        if (emp_name.length <= 2) {
            msgProvider.toast(Lang_chg.EmpMinLength[config.language], 'center')
            return false
        }
        if (emp_name.length > 50) {
            msgProvider.toast(Lang_chg.EmpMaxLength[config.language], 'center')
            return false
        }
        if (await validationprovider.textCheck(emp_name) != true) {
            msgProvider.toast(Lang_chg.validEmp[config.language], 'center')
            return false
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

        var data = new FormData();
        data.append("user_id_post", user_id)
        data.append("employee_name", emp_name)
        data.append("mobile", mobile_no)
        data.append("covid_report_id", covid_report_id)
        data.append('covid_result_img', {
            uri: this.state.covid_report,
            type: 'image/jpg', // or photo.type
            name: 'image.jpg'
        })
        data.append('recomadation_latter_img', {
            uri: this.state.recomndation_latter,
            type: 'image/jpg', // or photo.type
            name: 'image.jpg'
        })
        let url = config.baseURL + "edit_covide_report.php";

        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('signup step5', obj);
            if (obj.success == 'true') {
                let user_arr = obj.user_details;
                localStorage.setItemObject('user_arr', user_arr);
                msgProvider.toast(obj.msg[config.language], 'center')
                this.props.navigation.goBack()
                return false
            } else {
                if (obj.account_active_status == "deactivate") {
                    config.checkUserDeactivate(this.props.navigation);
                    return false;
                }
                msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                return false;
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
                <Cameragallery mediamodal={this.state.covid_report_status} Camerapopen={this._openCamera} Galleryopen={this._openGellery} Canclemedia={this.closeMediaPopup} />
                <Cameragallery mediamodal={this.state.recomndation_latter_status} Camerapopen={this._openCamera1} Galleryopen={this._openGellery1} Canclemedia={this.closeMediaPopup1} />
                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text></Text>
                    <Text></Text>
                </View>

                <KeyboardAwareScrollView showsVerticalScrollIndicator={false}>
                    <View style={styles.house_sketch}>
                        <TouchableOpacity onPress={() => { this.setState({ covid_report_status: !this.state.covid_report_status }) }}>
                            <Text style={styles.selec_ro_serice}>
                                {Lang_chg.txt_uploade_covid_txt[config.language]}
                            </Text>
                            {
                                (this.state.covid_report == '') ? <Image resizeMode="cover" style={styles.housedeomo} source={require('./icons/banner_error.jpg')}></Image>
                                    :
                                    <Image resizeMode="cover" style={styles.housedeomo} source={{ uri: this.state.covid_report }}></Image>
                            }

                        </TouchableOpacity>

                        <TouchableOpacity onPress={() => { this.setState({ recomndation_latter_status: !this.state.recomndation_latter_status }) }}>
                            <Text style={styles.selec_ro_serice}>
                                {Lang_chg.txt_uploade_covid_txt1[config.language]}
                            </Text>
                            {
                                (this.state.recomndation_latter == '') ? <Image resizeMode="cover" style={styles.housedeomo} source={require('./icons/banner_error.jpg')}></Image>
                                    :
                                    <Image resizeMode="cover" style={styles.housedeomo} source={{ uri: this.state.recomndation_latter }}></Image>
                            }
                        </TouchableOpacity>
                        <View style={styles.view_input}>
                            <View style={styles.login_pass}>
                                <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/user.png')}></Image>
                            </View>
                            <View style={styles.right_view}>
                                <TextInput
                                    style={styles.input_main}
                                    placeholder={Lang_chg.txt_uploade_covid_emp_name[config.language]}
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    maxLength={50}
                                    minLength={3}
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ emp_name: txt }) }}
                                    value={this.state.emp_name}
                                />
                            </View>
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
                                    placeholder={Lang_chg.txt_uploade_covid_mob_no[config.language]}
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    keyboardType='phone-pad'
                                    maxLength={50}
                                    minLength={3}
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ mobile_no: txt }) }}
                                    value={this.state.mobile_no.toString()}
                                />
                            </View>
                        </View>


                        <View style={[styles.homebankbtn, {
                            marginBottom: 30, marginTop: 50,
                        }]}>
                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnSubmitCovidToServer() }}>
                                <Text style={styles.btn_txt}>{Lang_chg.txt_select_service_counti[config.language]}</Text>
                            </TouchableOpacity>
                        </View>
                    </View>
                </KeyboardAwareScrollView>
            </View>
        )
    }
}
