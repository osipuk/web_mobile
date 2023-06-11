import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, TextInput, FlatList, ScrollView, Keyboard, Modal, ImageBackground } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { RadioButton } from 'react-native-paper';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, Mapprovider, validationprovider, mediaprovider, Cameragallery } from './Provider/utilslib/Utils';
import { firebaseprovider } from './Provider/FirebaseProvider'
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
export default class Edit_profile_p extends Component {
    constructor(props) {
        super(props)
        this.state = {
            show_popup_account_type: false,
            mapmodal: false,
            account_type: 2,
            bank_name: '',
            account_no: '',
            b_identification_no: '',
            bank_id: 0,
            f_name: '',
            surname: '',
            identification_no: '',
            address: '',
            latitude: '',
            longitude: '',
            mobile_no: '',
            email: '',
            bio: '',
            user_id: '',
            user_type: '',
            profile_image: 'NA',
            media_pop_up: false,
            acount_type_modal: false,
            types_of_dwelling_popup: false,
            dwelling_type_status: 0,
            landmark: "",
        }
        this.setProfiledata();
    }
    backpress = () => {
        this.props.navigation.goBack();
    }

    componentDidMount() {

    }
    _openCamera = () => {
        mediaprovider.launchCamera().then((obj) => {
            console.log(obj.path);
            this.setState({
                profile_image: obj.path,
                media_pop_up: false,
            })
        })
    }

    _openGellery = () => {
        mediaprovider.launchGellery().then((obj) => {
            console.log(obj.path);
            this.setState({
                profile_image: obj.path,
                media_pop_up: false,
            })
        })
    }

    closeMediaPopup = () => {
        this.setState({
            media_pop_up: false,
        })
    }




    setProfiledata = async () => {
        let result = await localStorage.getItemObject('user_arr')
        consolepro.consolelog('result', result)
        if (result != null) {
            var pic = 'NA';
            if (result.image != 'NA') {
                pic = config.img_url1 + result.image;
            }
            this.setState({
                user_id: result.user_id,
                user_type: result.user_type,
                f_name: result.f_name,
                surname: result.l_name,
                identification_no: result.identification_number,
                address: result.address,
                latitude: result.latitude,
                longitude: result.longitude,
                mobile_no: result.mobile,
                email: result.email,
                bio: result.bio,
                profile_image: pic,
                landmark: result.landmark,
            })
        }
    }

    locationget = async (data) => {
        //    alert(JSON.stringify(data))
        this.setState({
            address: data.address,
            latitude: data.latitude,
            longitude: data.longitude,
        })
    }
    CloseMap = () => {
        this.setState({
            mapmodal: false,
        })
    }

    changeAccountType = async (acc_type) => {
        this.setState({
            show_popup_account_type: false,
            account_type: parseInt(acc_type)
        });
    }



    submitDataToServer = async () => {
        Keyboard.dismiss()
        let { f_name, surname, identification_no, address, latitude, longitude, mobile_no, email, user_type, account_type, bank_name, account_no, b_identification_no, bio, landmark } = this.state;

        //firs name===================
        if (f_name.length <= 0) {
            msgProvider.toast(Lang_chg.emptyFirstName[config.language], 'center')
            return false
        }
        if (f_name.length <= 2) {
            msgProvider.toast(Lang_chg.FirstNameMinLength[config.language], 'center')
            return false
        }
        if (f_name.length > 50) {
            msgProvider.toast(Lang_chg.FirstNameMaxLength[config.language], 'center')
            return false
        }
        if (await validationprovider.textCheck(f_name) != true) {
            msgProvider.toast(Lang_chg.validFirstName[config.language], 'center')
            return false
        }

        //ssirname===================
        if (surname.length <= 0) {
            msgProvider.toast(Lang_chg.emptyLastName[config.language], 'center')
            return false
        }
        if (surname.length <= 2) {
            msgProvider.toast(Lang_chg.LastNameMinLength[config.language], 'center')
            return false
        }
        if (surname.length > 50) {
            msgProvider.toast(Lang_chg.LastNameMaxLength[config.language], 'center')
            return false
        }

        if (await validationprovider.textCheck(surname) != true) {
            msgProvider.toast(Lang_chg.validLastName[config.language], 'center')
            return false
        }

        // address===============
        if (address.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }
        if (address.length <= 2) {
            msgProvider.toast(Lang_chg.minlenaddress[config.language], 'center')
            return false
        }
        if (address.length > 250) {
            msgProvider.toast(Lang_chg.maxlenaddress[config.language], 'center')
            return false
        }
        if (latitude.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }

        if (longitude.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }

        // loand mark================================
        if (landmark.length <= 0) {
            msgProvider.toast(Lang_chg.emptyLandmark[config.language], 'center')
            return false
        }
        if (landmark.length <= 2) {
            msgProvider.toast(Lang_chg.minlenLandmark[config.language], 'center')
            return false
        }
        if (landmark.length > 250) {
            msgProvider.toast(Lang_chg.maxlenLandmark[config.language], 'center')
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
        data.append('name', f_name)
        data.append('surname', surname)
        data.append('identification_no', identification_no)
        data.append('address', address)
        data.append('latitude', latitude)
        data.append('longitude', longitude)
        data.append('mobile_no', mobile_no)
        data.append('email', email)
        data.append('account_type', account_type)
        data.append('bank_name', bank_name)
        data.append('account_no', account_no)
        data.append('b_identification_no', b_identification_no)
        data.append('bio', bio)
        data.append('phone_code', 593)
        data.append('landmark', landmark)
        data.append('bank_id', this.state.bank_id)
        data.append('user_id_post', this.state.user_id)
        if (this.state.profile_image != 'NA') {
            data.append('profile_img', {
                uri: this.state.profile_image,
                type: 'image/jpg', // or photo.type
                name: 'image.jpg'
            })
        }
        let url = config.baseURL + "edit_profile_vendor.php";
        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('Edit profile data', obj);
            if (obj.success == 'true') {
                let user_arr = obj.user_details;
                localStorage.setItemObject('user_arr', user_arr);
                msgProvider.toast(obj.msg[config.language], 'center')
                this.props.navigation.goBack();
                setTimeout(() => {
                    firebaseprovider.firebaseUserCreate();
                }, 1500);
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
                <Cameragallery mediamodal={this.state.media_pop_up} Camerapopen={this._openCamera} Galleryopen={this._openGellery} Canclemedia={this.closeMediaPopup} />

                <Mapprovider mapmodal={this.state.mapmodal} locationget={this.locationget} address_arr="NA" canclemap={this.CloseMap} comingPageName="edit" />



                {/* <Modal
                    animationType="slide"
                    transparent={true}
                    visible={this.state.acount_type_modal}
                    onRequestClose={() => { this.setState({ acount_type_modal: !this.state.acount_type_modal }) }}
                >
                    <View style={{ backgroundColor: "#00000030", flex: 1, alignItems: "center", justifyContent: "center", paddingHorizontal: 20 }}>
                        <StatusBar backgroundColor={color1.theme_color} barStyle='default' hidden={false} translucent={false}
                            networkActivityIndicatorVisible={true} />
                        <View style={{ width: "100%", position: 'absolute', bottom: 20 }}>

                            <View style={{ backgroundColor: "#ffffff", width: "100%", height: 100 }}>
                                <TouchableOpacity
                                    style={(this.state.account_type == 0) ? styles.dropDown1 : styles.dropDown}
                                    onPress={() => { this.setState({ account_type: 0, acount_type_modal: !this.state.acount_type_modal }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>Personal</Text>
                                </TouchableOpacity>
                                <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 2 }}></View>
                                <TouchableOpacity
                                    style={(this.state.account_type == 1) ? styles.dropDown1 : styles.dropDown}
                                    onPress={() => { this.setState({ account_type: 1, acount_type_modal: !this.state.acount_type_modal }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>Business</Text>
                                </TouchableOpacity>
                            </View>
                        </View>
                    </View>
                </Modal> */}

                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text style={styles.map_title}>{Lang_chg.txt_settings_edit_pro[config.language]}</Text>
                    <Text></Text>
                </View>


                <KeyboardAwareScrollView showsVerticalScrollIndicator={false}>

                    <TouchableOpacity style={styles.image_profile_top} onPress={() => { this.setState({ media_pop_up: !this.state.media_pop_up }) }}>
                        {
                            (this.state.profile_image == 'NA') && <Image style={styles.profile_main_userimg} source={require('./icons/user_error.png')}></Image>
                        }
                        {
                            (this.state.profile_image != 'NA') && <Image style={styles.profile_main_userimg} source={{ uri: this.state.profile_image }}></Image>
                        }

                        <Image source={require('./icons/camera1.png')} style={{ width: 30, height: 30, position: "absolute", tintColor: '#000000', bottom: 0, right: 0 }}></Image>
                    </TouchableOpacity>


                    <View style={styles.upcoming_main}>
                        <View>

                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/user.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        placeholder={Lang_chg.txt_fname[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        maxLength={50}
                                        minLength={3}
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ f_name: txt }) }}
                                        value={this.state.f_name}
                                    />
                                </View>
                            </View>

                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/user.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        placeholder={Lang_chg.txt_surname[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ surname: txt }) }}
                                        maxLength={50}
                                        minLength={3}
                                        value={this.state.surname}
                                    />
                                </View>
                            </View>

                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/voter.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        keyboardType='default'
                                        placeholder={Lang_chg.txt_identification_no[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        ref={(input) => { this.textinput = input; }}
                                        minLength={5}
                                        maxLength={20}
                                        onChangeText={(txt) => { this.setState({ identification_no: txt }) }}
                                        value={this.state.identification_no.toString()}
                                    />
                                </View>
                            </View>
                            <View>
                                <TouchableOpacity style={{
                                    flexDirection: 'row', borderBottomWidth: 1,
                                    borderBottomColor: '#0088e0',
                                    width: '90%',
                                    alignItems: 'center',
                                    alignSelf: 'center',
                                    marginTop: 10,
                                }} activeOpacity={0.9}>
                                    <View style={styles.login_pass}>
                                        <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/location4.png')}></Image>
                                    </View>
                                    <View style={styles.right_view}>
                                        <Text style={styles.signup_addres}>{(this.state.address != '') ? this.state.address : Lang_chg.txt_address[config.language]}</Text>
                                    </View>
                                </TouchableOpacity>
                                <TouchableOpacity onPress={() => { this.setState({ mapmodal: true }) }} style={{ width: "50%", alignSelf: 'flex-end', marginRight: '5%', marginTop: 3 }}><Text style={{ color: '#0088e0', fontFamily: 'Poppins-Medium', textDecorationLine: 'underline', textDecorationStyle: 'solid', textAlign: 'right' }}>{Lang_chg.txt_edit_p_change_add[config.language]}</Text></TouchableOpacity>
                            </View>

                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/location4.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        keyboardType='default'
                                        placeholder={Lang_chg.txt_c_landmark_txt[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        ref={(input) => { this.textinput = input; }}
                                        minLength={3}
                                        maxLength={250}
                                        onChangeText={(txt) => { this.setState({ landmark: txt }) }}
                                        value={this.state.landmark}
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
                                        placeholder={Lang_chg.txt_mobile_no[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ mobile_no: txt }) }}
                                        keyboardType='phone-pad'
                                        minLength={8}
                                        maxLength={12}
                                        value={this.state.mobile_no.toString()}
                                        editable={false}
                                    />
                                </View>
                            </View>

                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/mail.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        placeholder={Lang_chg.txt_emails[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        keyboardType="email-address"
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ email: txt }) }}
                                        maxLength={50}
                                        value={this.state.email}
                                    />
                                </View>
                            </View>


                            <View style={styles.select_servicepage}>
                                <View>
                                    <Text style={styles.selec_ro_serice}>
                                        Bio
                                    </Text>
                                </View>
                                <View style={styles.bio_self}>
                                    <TextInput
                                        style={[styles.txtinput, { height: 90, textAlignVertical: 'top', fontSize: 18, }]}
                                        multiline={true}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        placeholder={Lang_chg.txt_bio_decribe_hare[config.language]}
                                        placeholderTextColor="#b8b8b8"
                                        maxLength={250}
                                        minLength={5}
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ bio: txt }) }}
                                        value={this.state.bio}
                                    />
                                </View>
                            </View>



                            {/* <View style={styles.login_btn, { marginBottom: 20, width: '90%', alignSelf: 'center' }}>
                                <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.submitDataToServer()}}>
                                    <Text style={styles.btn_txt}>{Lang_chg.txt_edit_pro_update[config.language]}</Text>
                                </TouchableOpacity>
                            </View> */}

                            <TouchableOpacity style={{ width: '90%', backgroundColor: '#0088e0', height: 20, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginTop: 20, height: 45, marginBottom: 40 }} activeOpacity={0.9} onPress={() => { this.submitDataToServer() }}>
                                <Text style={styles.btn_txt}>{Lang_chg.txt_edit_pro_update[config.language]}</Text>
                            </TouchableOpacity>


                        </View>
                    </View>

                </KeyboardAwareScrollView>
            </View>
        )
    }
}
