import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, TextInput, Keyboard, Modal } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { RadioButton } from 'react-native-paper';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, Mapprovider, validationprovider, mediaprovider, Cameragallery } from './Provider/utilslib/Utils';
import { KeyboardAwareScrollView } from 'react-native-keyboard-aware-scroll-view';
import { CheckBox } from 'react-native-elements'
import { firebaseprovider } from './Provider/FirebaseProvider'
export default class Edit_profile extends Component {

    constructor(props) {
        super(props)
        this.state = {
            show_popup_account_type: false,
            mapmodal: false,
            f_name: '',
            surname: '',
            identification_no: '',
            address: '',
            latitude: '',
            longitude: '',
            mobile_no: '',
            user_id: '',
            user_type: '',
            profile_image: 'NA',
            media_pop_up: false,
            checked: 'first',
            type_of_twelling: '',
            no_of_bedroom: "",
            basement: 0,
            rooftop: 0,
            garden: 0,
            members: '',
            no_of_adults: '',
            no_of_kids: '',
            mobile_no: '',
            types_of_dwelling_popup: false,
            dwelling_type_status: 0,
            landmark: "",
        }
        this.setProfiledata();
    }

    setProfiledata = async () => {
        let result = await localStorage.getItemObject('user_arr')
        consolepro.consolelog('result', result)
        if (result != null) {
            var pic = 'NA';
            if (result.image != 'NA') {
                pic = config.img_url1 + result.image;
            }
            let type_of_twelling = result.types_of_dwelling;
            var dwelling_type_status = 0;
            if (type_of_twelling == "House") {
                dwelling_type_status = 0
            }

            if (type_of_twelling == "Apartment") {
                dwelling_type_status = 1
            }

            if (type_of_twelling == "Office") {
                dwelling_type_status = 2
            }
            var landmark = "";
            if (result.landmark != null) {
                landmark = result.landmark;
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
                profile_image: pic,
                landmark: landmark,
                type_of_twelling: result.types_of_dwelling,
                dwelling_type_status: dwelling_type_status,
                no_of_bedroom: result.no_of_bedroom,
                basement: result.basement,
                rooftop: result.rooftop,
                garden: result.garden,
                members: result.members,
                no_of_adults: result.no_of_adult,
                no_of_kids: result.no_of_child,
                mobile_no: result.mobile,
            })
        }
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

    locationget = async (data) => {
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

    submitDataToServer = async () => {
        Keyboard.dismiss()
        let { f_name, surname, identification_no, address, latitude, longitude, type_of_twelling, no_of_bedroom, members, basement, garden, rooftop, no_of_adults, no_of_kids, mobile_no, user_id, landmark } = this.state;

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

        //identification no===================
        if (identification_no.length <= 0) {
            msgProvider.toast(Lang_chg.emptyIdentification[config.language], 'center')
            return false
        }
        if (identification_no.length <= 4) {
            msgProvider.toast(Lang_chg.identificationMinLength[config.language], 'center')
            return false
        }
        if (identification_no.length > 20) {
            msgProvider.toast(Lang_chg.identificationMaxLength[config.language], 'center')
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


        //  types of dwellingss================
        if (type_of_twelling.length <= 0) {
            msgProvider.toast(Lang_chg.emptytype_of_twelling[config.language], 'center')
            return false
        }
        if (type_of_twelling.length <= 2) {
            msgProvider.toast(Lang_chg.minlentype_of_twelling[config.language], 'center')
            return false
        }
        if (type_of_twelling.length > 50) {
            msgProvider.toast(Lang_chg.maxlentype_of_twelling[config.language], 'center')
            return false
        }

        //no_of_bedroom===================
        if (no_of_bedroom.length <= 0) {
            msgProvider.toast(Lang_chg.emptyno_of_bedroom[config.language], 'center')
            return false
        }
        if (no_of_bedroom.length < 1) {
            msgProvider.toast(Lang_chg.no_of_bedroomMinLength[config.language], 'center')
            return false
        }
        if (no_of_bedroom.length > 3) {
            msgProvider.toast(Lang_chg.no_of_bedroomMaxLength[config.language], 'center')
            return false
        }

        if (await validationprovider.digitCheck(no_of_bedroom) != true) {
            msgProvider.toast(Lang_chg.vailidno_of_bedroom[config.language], 'center')
            return false
        }

        // members=============
        if (members.length <= 0) {
            msgProvider.toast(Lang_chg.emptymembers[config.language], 'center')
            return false
        }
        if (members.length < 1) {
            msgProvider.toast(Lang_chg.membersMinLength[config.language], 'center')
            return false
        }
        if (members.length > 3) {
            msgProvider.toast(Lang_chg.membersMaxLength[config.language], 'center')
            return false
        }

        if (await validationprovider.digitCheck(members) != true) {
            msgProvider.toast(Lang_chg.vailidmembers[config.language], 'center')
            return false
        }

        // no_of_adults=============
        if (no_of_adults.length <= 0) {
            msgProvider.toast(Lang_chg.emptyno_of_adults[config.language], 'center')
            return false
        }
        if (no_of_adults.length < 1) {
            msgProvider.toast(Lang_chg.no_of_adultsMinLength[config.language], 'center')
            return false
        }
        if (no_of_adults.length > 3) {
            msgProvider.toast(Lang_chg.no_of_adultsMaxLength[config.language], 'center')
            return false
        }

        if (await validationprovider.digitCheck(no_of_adults) != true) {
            msgProvider.toast(Lang_chg.vailidno_of_adults[config.language], 'center')
            return false
        }

        // no_of_kids=============
        if (no_of_kids.length <= 0) {
            msgProvider.toast(Lang_chg.emptyno_of_kids[config.language], 'center')
            return false
        }
        if (no_of_kids.length < 1) {
            msgProvider.toast(Lang_chg.no_of_kidsMinLength[config.language], 'center')
            return false
        }
        if (no_of_kids.length > 3) {
            msgProvider.toast(Lang_chg.no_of_kidsMaxLength[config.language], 'center')
            return false
        }

        if (await validationprovider.digitCheck(no_of_kids) != true) {
            msgProvider.toast(Lang_chg.vailidno_of_kids[config.language], 'center')
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



        // let { f_name,surname,identification_no,address,latidude,longitude,type_of_twelling,no_of_bedroom,members,basement,garden,rooftop,no_of_adults,no_of_kids,mobile_no,password,cpassword,user_type } = this.state;

        var data = new FormData();
        data.append('name', f_name)
        data.append('surname', surname)
        data.append('identification_no', identification_no)
        data.append('address', address)
        data.append('latitude', latitude)
        data.append('longitude', longitude)
        data.append('types_of_dewlling', type_of_twelling)
        data.append('no_of_bedroom', no_of_bedroom)
        data.append('members', members)
        data.append('basement', basement)
        data.append('garden', garden)
        data.append('rooftop', rooftop)
        data.append('no_of_adults', no_of_adults)
        data.append('no_of_kids', no_of_kids)
        data.append('mobile_no', mobile_no)
        data.append('phone_code', 593)
        data.append('landmark', landmark)
        data.append('user_id_post', user_id)
        if (this.state.profile_image != 'NA') {
            data.append('profile_img', {
                uri: this.state.profile_image,
                type: 'image/jpg', // or photo.type
                name: 'image.jpg'
            })
        }
        consolepro.consolelog('Edit profile data', data);
        let url = config.baseURL + "edit_profile_customer.php";
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


                <Modal
                    animationType="slide"
                    transparent={true}
                    visible={this.state.types_of_dwelling_popup}
                    onRequestClose={() => { this.setState({ types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }}
                >
                    <View style={{ backgroundColor: "#00000030", flex: 1, alignItems: "center", justifyContent: "center", paddingHorizontal: 20 }}>
                        <StatusBar backgroundColor={color1.theme_color} barStyle='default' hidden={false} translucent={false}
                            networkActivityIndicatorVisible={true} />
                        <View style={{ width: "100%", position: 'absolute', bottom: 20 }}>

                            <View style={{ backgroundColor: "#ffffff", width: "100%", height: 120 }}>
                                <TouchableOpacity
                                    style={(this.state.dwelling_type_status == 0) ? styles.dropDown11 : styles.dropDown12}
                                    onPress={() => { this.setState({ dwelling_type_status: 0, type_of_twelling: Lang_chg.txt_edit_pro_p_edit_House[config.language], types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>{Lang_chg.txt_edit_pro_p_edit_House[config.language]}</Text>
                                </TouchableOpacity>
                                <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 2 }}></View>
                                <TouchableOpacity
                                    style={(this.state.dwelling_type_status == 1) ? styles.dropDown11 : styles.dropDown12}
                                    onPress={() => { this.setState({ dwelling_type_status: 1, type_of_twelling: Lang_chg.txt_edit_pro_p_edit_Apartment[config.language], types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>{Lang_chg.txt_edit_pro_p_edit_Apartment[config.language]}</Text>
                                </TouchableOpacity>
                                <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 2 }}></View>
                                <TouchableOpacity
                                    style={(this.state.dwelling_type_status == 2) ? styles.dropDown11 : styles.dropDown12}
                                    onPress={() => { this.setState({ dwelling_type_status: 2, type_of_twelling: Lang_chg.txt_edit_pro_p_edit_Office[config.language], types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }}
                                >
                                    <Text style={{ color: 'black', fontSize: 18, fontWeight: 'bold', alignSelf: 'center' }}>{Lang_chg.txt_edit_pro_p_edit_Office[config.language]}</Text>
                                </TouchableOpacity>
                            </View>
                        </View>
                    </View>
                </Modal>

                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text style={styles.map_title}>{Lang_chg.txt_settings_edit_pro[config.language]}</Text>
                    <Text></Text>
                </View>
                <Cameragallery mediamodal={this.state.media_pop_up} Camerapopen={this._openCamera} Galleryopen={this._openGellery} Canclemedia={this.closeMediaPopup} />
                <Mapprovider mapmodal={this.state.mapmodal} locationget={this.locationget} address_arr="NA" canclemap={this.CloseMap} comingPageName='edit' />


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
                                <TouchableOpacity onPress={() => { this.setState({ mapmodal: true }) }} style={{ width: "50%", alignSelf: 'flex-end', marginRight: '5%', marginTop: 3 }}>
                                    <Text style={{ color: '#0088e0', fontFamily: 'Poppins-Medium', textDecorationLine: 'underline', textDecorationStyle: 'solid', textAlign: 'right' }}>{Lang_chg.txt_edit_p_change_add[config.language]}</Text>
                                </TouchableOpacity>
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


                            <TouchableOpacity activeOpacity={0.8} style={styles.view_input} onPress={() => { this.setState({ types_of_dwelling_popup: !this.state.types_of_dwelling_popup }) }}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/type.png')}></Image>
                                </View>
                                <View style={{ width: '80%', height: 50, justifyContent: "center", paddingLeft: 15 }}>

                                    <Text style={{ fontSize: 18 }}>{this.state.type_of_twelling}</Text>

                                </View>
                                <View style={styles.passEye}>
                                    <Image style={{ height: 10, width: 10, alignSelf: 'center' }} resizeMode="contain" source={require('./icons/downarrow.png')}></Image>
                                </View>
                            </TouchableOpacity>

                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/bedroom.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        placeholder={Lang_chg.txt_n_o_bedroom[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        minLength={1}
                                        maxLength={3}
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ no_of_bedroom: txt }) }}
                                        keyboardType='decimal-pad'
                                        value={this.state.no_of_bedroom.toString()}
                                    />
                                </View>
                            </View>

                            <View style={styles.baseMentBox}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/basement.png')}></Image>
                                </View>
                                <View style={styles.sign_select_ttle}>
                                    <Text style={styles.radio_title}>{Lang_chg.txt_basement[config.language]}</Text>
                                </View>

                                <View style={styles.right_yesNo}>
                                    <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>
                                        <CheckBox
                                            center
                                            containerStyle={{ elevation: 0 }}
                                            checkedIcon='dot-circle-o'
                                            uncheckedIcon='circle-o'
                                            checked={this.state.basement === 0 ? true : false}
                                            onPress={() => { this.setState({ basement: 0 }) }}
                                        />
                                        <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.Yes[config.language]}</Text>
                                    </TouchableOpacity>

                                    <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>

                                        <CheckBox
                                            center
                                            containerStyle={{ elevation: 0 }}
                                            checkedIcon='dot-circle-o'
                                            uncheckedIcon='circle-o'
                                            checked={this.state.basement === 1 ? true : false}
                                            onPress={() => { this.setState({ basement: 1 }) }}
                                        />
                                        <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.No[config.language]}</Text>
                                    </TouchableOpacity>
                                </View>
                            </View>

                            <View style={styles.baseMentBox}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/rooftop.png')}></Image>
                                </View>
                                <View style={styles.sign_select_ttle}>
                                    <Text style={styles.radio_title}>{Lang_chg.txt_rooftop[config.language]}</Text>
                                </View>

                                <View style={styles.right_yesNo}>
                                    <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>

                                        <CheckBox
                                            center
                                            containerStyle={{ elevation: 0 }}
                                            checkedIcon='dot-circle-o'
                                            uncheckedIcon='circle-o'
                                            checked={this.state.rooftop === 0 ? true : false}
                                            onPress={() => { this.setState({ rooftop: 0 }) }}
                                        />

                                        <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.Yes[config.language]}</Text>
                                    </TouchableOpacity>

                                    <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: "center" }}>

                                        <CheckBox
                                            center
                                            containerStyle={{ elevation: 0 }}
                                            checkedIcon='dot-circle-o'
                                            uncheckedIcon='circle-o'
                                            checked={this.state.rooftop === 1 ? true : false}
                                            onPress={() => { this.setState({ rooftop: 1 }) }}
                                        />

                                        <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.No[config.language]}</Text>
                                    </TouchableOpacity>
                                </View>
                            </View>


                            <View style={styles.baseMentBox}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/garden.png')}></Image>
                                </View>
                                <View style={styles.sign_select_ttle}>
                                    <Text style={styles.radio_title}>{Lang_chg.txt_gardern[config.language]}</Text>
                                </View>

                                <View style={styles.right_yesNo}>
                                    <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>

                                        <CheckBox
                                            center
                                            containerStyle={{ elevation: 0 }}
                                            checkedIcon='dot-circle-o'
                                            uncheckedIcon='circle-o'
                                            checked={this.state.garden === 0 ? true : false}
                                            onPress={() => { this.setState({ garden: 0 }) }}
                                        />

                                        <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.Yes[config.language]}</Text>

                                    </TouchableOpacity>

                                    <TouchableOpacity activeOpacity={0.9} style={{ flexDirection: 'row', alignItems: 'center' }}>

                                        <CheckBox
                                            center
                                            containerStyle={{ elevation: 0 }}
                                            checkedIcon='dot-circle-o'
                                            uncheckedIcon='circle-o'
                                            checked={this.state.garden === 1 ? true : false}
                                            onPress={() => { this.setState({ garden: 1 }) }}
                                        />

                                        <Text style={{ fontSize: 18, fontFamily: "Poppins-Regular", color: '#b8b8b8', marginLeft: -7 }}>{Lang_chg.No[config.language]}</Text>
                                    </TouchableOpacity>
                                </View>
                            </View>

                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/howmany.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        placeholder={Lang_chg.txt_Members[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ members: txt }) }}
                                        minLength={1}
                                        maxLength={3}
                                        keyboardType='decimal-pad'
                                        value={this.state.members.toString()}
                                    ></TextInput>
                                </View>
                            </View>

                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/howmany.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        placeholder={Lang_chg.txt_n_o_adults[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ no_of_adults: txt }) }}
                                        minLength={1}
                                        maxLength={3}
                                        keyboardType='decimal-pad'
                                        value={this.state.no_of_adults.toString()}
                                    ></TextInput>
                                </View>
                            </View>




                            <View style={styles.view_input}>
                                <View style={styles.login_pass}>
                                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/user.png')}></Image>
                                </View>
                                <View style={styles.right_view}>
                                    <TextInput
                                        style={styles.input_main}
                                        placeholder={Lang_chg.txt_n_o_kids[config.language]}
                                        onSubmitEditing={() => { Keyboard.dismiss() }}
                                        returnKeyLabel='done'
                                        ref={(input) => { this.textinput = input; }}
                                        onChangeText={(txt) => { this.setState({ no_of_kids: txt }) }}
                                        minLength={1}
                                        maxLength={3}
                                        keyboardType='decimal-pad'
                                        value={this.state.no_of_kids.toString()}
                                    ></TextInput>
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
                                        editable={false}
                                        value={this.state.mobile_no.toString()}
                                    />
                                </View>
                            </View>
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
