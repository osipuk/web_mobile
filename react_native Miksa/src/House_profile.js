import React, { Component } from 'react'
import { Text, StatusBar, TouchableOpacity, Image, View, SafeAreaView, BackHandler } from 'react-native'
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, validationprovider, mediaprovider, Cameragallery } from './Provider/utilslib/Utils';
import color1 from './Colors'
import styles from "./Style.js";

export default class House_profile extends Component {
    _didFocusSubscription;
    _willBlurSubscription;
    constructor(props) {
        super(props);
        this.state = {
            media_pop_up: false,
            profile_image: 'NA',
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
        this.props.navigation.navigate('Login')// works best when the goBack is async
        return true;
    };

    backpress = () => {
        this.props.navigation.navigate('Login');
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

    submitProfileToServer = async () => {
        let user_id = await localStorage.getItemObject('user_id');
        if (this.state.profile_image == 'NA') {
            msgProvider.toast(Lang_chg.emptyProfileImage[config.language], 'center')
            return false
        }

        var data = new FormData();
        data.append("user_id_post", user_id)
        data.append("signup_type", "profile_picture")
        data.append('profile_img', {
            uri: this.state.profile_image,
            type: 'image/jpg', // or photo.type
            name: 'image.jpg'
        })
        let url = config.baseURL + "signup_step2.php";

        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('signup step3', obj);
            if (obj.success == 'true') {
                this.props.navigation.navigate('Select_service_p');
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
                <Cameragallery mediamodal={this.state.media_pop_up} Camerapopen={this._openCamera} Galleryopen={this._openGellery} Canclemedia={this.closeMediaPopup} />
                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text></Text>
                    <Text></Text>
                </View>

                <View style={styles.house_img}>
                    <Text style={styles.housephoto}>
                        {Lang_chg.txt_upload_photo_[config.language]}
                    </Text>
                    <Text style={styles.photopsg}>{Lang_chg.txt_upload_photo_1[config.language]}</Text>
                    <TouchableOpacity style={styles.housephotoection} onPress={() => { this.setState({ media_pop_up: !this.state.media_pop_up }) }}>
                        {
                            (this.state.profile_image != 'NA')
                                ?
                                <Image resizeMode="cover" style={{ width: 130, height: 130, borderRadius: 130 / 2 }} source={{ uri: this.state.profile_image }}></Image>
                                :
                                <Image resizeMode="cover" style={{ width: 130, height: 130, borderRadius: 130 / 2 }} source={require('./icons/camerahouse.png')}></Image>
                        }
                    </TouchableOpacity>
                </View>

                <View style={styles.login_btneter}>
                    <TouchableOpacity style={[styles.btn_login, { marginBottom: 20 }]} activeOpacity={0.9} onPress={() => { this.submitProfileToServer() }}>
                        <Text style={styles.btn_txt}>{Lang_chg.txt_bank_countinue_btn[config.language]}</Text>
                    </TouchableOpacity>
                </View>
            </View>
        )
    }
}


