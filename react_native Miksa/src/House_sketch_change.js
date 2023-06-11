import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, BackHandler } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mediaprovider, Cameragallery } from './Provider/utilslib/Utils';

export default class House_sketch_change extends Component {

    constructor(props) {
        super(props);
        this.state = {
            house_sketch_status: false,
            provider_house_status: false,
            house_sketch: "",
            provider_house: "",
            user_id: 0,
        }
        this.setDataProfile();
    }

    setDataProfile = async () => {
        let result = await localStorage.getItemObject('user_arr')
        consolepro.consolelog('result', result)
        if (result != null) {
            this.setState({
                house_sketch: config.img_url1 + result.house_sketch_img,
                provider_house: config.img_url1 + result.provider_house_img,
                user_id: result.user_id,
            })
        }
    }

    backpress = () => {
        this.props.navigation.goBack()
    }

    _openCamera = () => {
        mediaprovider.launchCamera().then((obj) => {
            console.log(obj.path);
            this.setState({
                house_sketch: obj.path,
                house_sketch_status: false,
            })
        })
    }

    _openGellery = () => {
        mediaprovider.launchGellery().then((obj) => {
            console.log(obj.path);
            this.setState({
                house_sketch: obj.path,
                house_sketch_status: false,
            })
        })
    }

    closeMediaPopup = () => {
        this.setState({
            house_sketch_status: false,
        })
    }


    _openCamera1 = () => {
        mediaprovider.launchCamera().then((obj) => {
            console.log(obj.path);
            this.setState({
                provider_house: obj.path,
                provider_house_status: false,
            })
        })
    }

    _openGellery1 = () => {
        mediaprovider.launchGellery().then((obj) => {
            console.log(obj.path);
            this.setState({
                provider_house: obj.path,
                provider_house_status: false,
            })
        })
    }

    closeMediaPopup1 = () => {
        this.setState({
            provider_house_status: false,
        })
    }

    submitSketchServer = async () => {
        let user_id = this.state.user_id;
        if (this.state.house_sketch == '') {
            msgProvider.toast(Lang_chg.emptyHouseSketchImage[config.language], 'center')
            return false
        }
        if (this.state.provider_house == '') {
            msgProvider.toast(Lang_chg.emptyProviderHouseImage[config.language], 'center')
            return false
        }

        var data = new FormData();
        data.append("user_id_post", user_id)
        data.append('house_sketch', {
            uri: this.state.house_sketch,
            type: 'image/jpg', // or photo.type
            name: 'image.jpg'
        })
        data.append('front_provider_house', {
            uri: this.state.provider_house,
            type: 'image/jpg', // or photo.type
            name: 'image.jpg'
        })
        let url = config.baseURL + "edit_house_sketch.php";

        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('signup step5', obj);
            if (obj.success == 'true') {
                let user_arr = obj.user_details;
                localStorage.setItemObject('user_arr', user_arr);
                msgProvider.toast(obj.msg[config.language], 'center')
                this.props.navigation.goBack()
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
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />

                <Cameragallery mediamodal={this.state.house_sketch_status} Camerapopen={this._openCamera} Galleryopen={this._openGellery} Canclemedia={this.closeMediaPopup} />
                <Cameragallery mediamodal={this.state.provider_house_status} Camerapopen={this._openCamera1} Galleryopen={this._openGellery1} Canclemedia={this.closeMediaPopup1} />

                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')} />
                    </TouchableOpacity>
                    <Text></Text>
                    <Text></Text>
                </View>

                <View style={styles.house_sketch}>
                    <TouchableOpacity onPress={() => { this.setState({ house_sketch_status: !this.state.house_sketch_status }) }}>
                        <Text style={styles.selec_ro_serice}>
                            {Lang_chg.txt_h_s_upload_sketch[config.language]}
                        </Text>
                        {
                            (this.state.house_sketch == '') ? <Image resizeMode="cover" style={styles.housedeomo} source={require('./icons/banner_error.jpg')} />
                                :
                                <Image resizeMode="cover" style={styles.housedeomo} source={{ uri: this.state.house_sketch }} />
                        }
                    </TouchableOpacity>

                    <TouchableOpacity onPress={() => { this.setState({ provider_house_status: !this.state.provider_house_status }) }}>
                        <Text style={styles.selec_ro_serice}>
                            {Lang_chg.txt_h_s_upload_sketch1[config.language]}
                        </Text>
                        {
                            (this.state.provider_house == '') ? <Image resizeMode="cover" style={styles.housedeomo} source={require('./icons/banner_error.jpg')} />
                                :
                                <Image resizeMode="cover" style={styles.housedeomo} source={{ uri: this.state.provider_house }} />
                        }

                    </TouchableOpacity>
                </View>
                <View style={{ width: '90%', alignSelf: 'center', bottom: 20, position: 'absolute', bottom: 25 }}>
                    <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.submitSketchServer() }}>
                        <Text style={styles.btn_txt}>{Lang_chg.txt_select_service_counti[config.language]}</Text>
                    </TouchableOpacity>
                </View>
            </View>
        )
    }
}


