import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Dimensions, Modal, ScrollView, FlatList, Image, TextInput, Keyboard } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import DatePicker from 'react-native-datepicker'
import HideWithKeyboard from 'react-native-hide-with-keyboard';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mediaprovider, Cameragallery, Mapprovider, mobileH, mobileW } from './Provider/utilslib/Utils';
const screenwidth = Dimensions.get('window').width;
// const demodat1=[1,];
export default class Job_edit extends Component {
    constructor(props) {
        super(props)
        this.state = {
            job_id: this.props.route.params.job_id,
            show_img: [],
            img_type: 0,
            mediamodal1: false,
            mapmodal: false,
            address: '',
            title: '',
            job_details: "NA",
            location_address: '',
            latitude: '',
            longitude: '',
            landmark: ''
        }
    }

    componentDidMount() {
        // this.countAmount();
        const timer = setTimeout(() => {
            this.getJobDetails();
        }, 600);
        return () => clearTimeout(timer);
    }

    getJobDetails = async () => {
        // return false;
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        let url = config.baseURL + "job_detail.php?user_id_post=" + user_id_post + "&job_id_post=" + this.state.job_id;
        consolepro.consolelog('muboking url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('My Booking data', obj);
            if (obj.success == 'true') {
                // var saved_status = obj.job_arr.saved_status;
                // var service_arr = obj.service_arr;
                var job_arr = obj.job_arr;
                var image_arr = obj.image_arr;


                let title = job_arr.titile;
                let landmark = job_arr.landmark;
                let location_address = job_arr.location_address;
                let latitude = job_arr.latitude;
                let longitude = job_arr.longitude;

                this.setState({ job_details: job_arr, title: title, location_address: location_address, latitude: latitude, longitude: longitude, landmark: landmark })




                if (image_arr != 'NA') {
                    let len = image_arr.length;
                    let rem_len = 3 - len;

                    for (let i = 0; i < len; i++) {
                        let a = config.img_url1 + obj.image_arr[i].image;
                        let id = image_arr[i].job_image_id;
                        let json = {
                            image: a,
                            id: id,
                        }
                        this.setState({
                            show_img: [...this.state.show_img, json]
                        })
                        // show_img.push(json);
                    }

                    for (let i = rem_len; i >= 1; i--) {
                        let json = {
                            id: 0
                        }
                        this.setState({
                            show_img: [...this.state.show_img, json]
                        })
                        // no_show_img.push(json);
                    }
                } else {
                    for (let i = 1; i <= 3; i++) {
                        let json = {
                            id: 0
                        }
                        this.setState({
                            show_img: [...this.state.show_img, json]
                        })
                    }
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

    _openCamera1 = () => {
        mediaprovider.launchCamera().then((obj) => {
            console.log(obj.path);
            let index = this.state.img_type;
            this.state.show_img.splice(index, 1);
            let json = {
                image: obj.path,
                id: 'local',
            }
            this.state.show_img.splice(index, 0, json);
            console.log('this.state.show_img', this.state.show_img);
            this.setState({
                img_1: obj.path,
                show_img: [...this.state.show_img],
                mediamodal1: false,
            })
        })
    }

    _openGellery1 = () => {
        mediaprovider.launchGellery().then((obj) => {
            console.log(obj.path);
            let index = this.state.img_type;
            this.state.show_img.splice(index, 1);
            let json = {
                image: obj.path,
                id: 'local',
            }
            this.state.show_img.splice(index, 0, json);
            console.log('this.state.show_img', this.state.show_img);
            this.setState({
                img_1: obj.path,
                show_img: [...this.state.show_img],
                mediamodal1: false,
            })
        })
    }

    _removeImg = (index, id) => {
        if (id > 0) {
            this._delete_image(id, index);
        }
        if (id == 'local') {
            this.state.show_img.splice(index, 1);
            let json = {
                id: 0,
            }
            this.state.show_img.push(json);
            this.setState({
                show_img: [...this.state.show_img],
            })
        }
    }

    _delete_image = async (id, index) => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        let url = config.baseURL + "job_img_delete.php?user_id_post=" + user_id_post + "&job_img_id=" + id;


        consolepro.consolelog('delete inmagr', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('delete img', obj);
            if (obj.success == 'true') {
                this.state.show_img.splice(index, 1);
                let json = {
                    id: 0,
                }
                this.state.show_img.push(json);
                this.setState({
                    show_img: [...this.state.show_img],
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
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
            console.log('err', err);
        });

    }

    backpress = () => {
        this.props.navigation.goBack();
    }



    closeMediaPopup = () => {
        this.setState({
            mediamodal1: false,
        })
    }

    locationget = async (data) => {
        this.setState({
            location_address: data.address,
            latitude: data.latitude,
            longitude: data.longitude,
        })
    }

    CloseMap = () => {
        this.setState({
            mapmodal: false,
        })
    }


    btnUpdateJob = async () => {
        let { job_id, title, show_img, location_address, latitude, longitude, landmark } = this.state;
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        if (title.length <= 0) {
            msgProvider.toast(Lang_chg.emptyTitle[config.language], 'center')
            return false
        }
        if (title.length <= 2) {
            msgProvider.toast(Lang_chg.minlenTitle[config.language], 'center')
            return false
        }
        if (title.length > 50) {
            msgProvider.toast(Lang_chg.maxlenTitle[config.language], 'center')
            return false
        }

        // address===============
        if (location_address.length <= 0) {
            msgProvider.toast(Lang_chg.emptyaddress[config.language], 'center')
            return false
        }
        if (location_address.length <= 2) {
            msgProvider.toast(Lang_chg.minlenaddress[config.language], 'center')
            return false
        }
        if (location_address.length > 250) {
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



        var data = new FormData();
        data.append('title', title)
        data.append('address', location_address)
        data.append('latitude', latitude)
        data.append('longitude', longitude)
        data.append('landmark', landmark)
        data.append('user_id_post', user_id_post)
        data.append('job_id_post', job_id)


        if (show_img.length != 0) {
            for (let i = 0; i < show_img.length; i++) {
                if (show_img[i].id == 'local') {
                    data.append('image_arr[]', {
                        uri: show_img[i].image,
                        type: 'image/jpg', // or photo.type
                        name: 'image.jpg'
                    });
                }
            }
        }

        consolepro.consolelog("Edit job", data);
        let url = config.baseURL + "job_edit.php";
        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('Edit job', obj);
            if (obj.success == 'true') {
                msgProvider.toast(obj.msg[config.language], 'center')
                const timer = setTimeout(() => {
                    this.props.navigation.goBack();
                }, 600);
                return () => clearTimeout(timer);
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
        var job_arr = this.state.job_details;
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                {/*================================End Services modal========================= */}
                <Cameragallery mediamodal={this.state.mediamodal1} Camerapopen={this._openCamera1} Galleryopen={this._openGellery1} Canclemedia={this.closeMediaPopup} />
                {
                    (job_arr != 'NA') && <Mapprovider mapmodal={this.state.mapmodal} locationget={this.locationget} address_arr={{ latitude: this.state.latitude, longitude: this.state.longitude }} canclemap={this.CloseMap} comingPageName='create_job' />
                }



                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text style={styles.map_title}>{Lang_chg.txt_job_edit[config.language]}</Text>
                    <Text></Text>
                </View>

                <View style={styles.body_view}>
                    {
                        (job_arr != 'NA') &&


                        <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={{ paddingBottom: 20 }}>


                            <View>
                                <Text style={styles.cretae_job_title}>{Lang_chg.txt_create_job_upload[config.language]}</Text>
                                <Text style={styles.crete_job_psg}>{Lang_chg.txt_create_job_upload1[config.language]}</Text>
                            </View>


                            <FlatList
                                contentContainerStyle={{ flexDirection: 'row', justifyContent: 'space-between', marginTop: 15 }}
                                data={this.state.show_img}
                                // horizontal={true}
                                renderItem={({ item, index }) => {
                                    return (
                                        <TouchableOpacity style={{ height: mobileW * 29 / 100, width: mobileW * 29 / 100, borderRadius: 15, justifyContent: 'center', alignItems: 'center' }} activeOpacity={0.9} onPress={() => { (item.id == 0) ? this.setState({ img_type: index, mediamodal1: true, }) : null }}>
                                            {
                                                (item.id == 0) && <Image resizeMode="cover" style={{ height: mobileW * 27 / 100, width: mobileW * 27 / 100 }} source={require('./icons/uploadimg.png')} />
                                            }
                                            {
                                                (item.id >= 1 || item.id == 'local') && <Image resizeMode="stretch" style={{ height: mobileW * 25 / 100, width: mobileW * 25 / 100, borderRadius: 15 }} source={{ uri: item.image }}></Image>
                                            }
                                            {
                                                (item.id >= 1 || item.id == 'local') &&
                                                <TouchableOpacity activeOpacity={0.9} style={{ position: 'absolute', right: 0, right: 2, top: 2, }} onPress={() => { this._removeImg(index, item.id) }}>
                                                    <Image resizeMode="contain" style={styles.cross_slider} source={require('./icons/cross.png')} />
                                                </TouchableOpacity>
                                            }
                                        </TouchableOpacity>
                                    )
                                }}
                                keyExtractor={(item, index) => { item.id.toString() }}
                            />




                            <View>
                                <Text style={styles.create_title_job}>Title</Text>
                                <TextInput
                                    placeholderTextColor='#b8b8b8'
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    style={[styles.create_input_titlejob, { backgroundColor: color1.theme_app }]} placeholder={Lang_chg.txt_create_job_enter_title[config.language]}
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ title: txt }) }}
                                    maxLength={50}
                                    minLength={3}
                                    value={this.state.title}
                                ></TextInput>
                            </View>
                            <View>
                                <Text style={styles.create_title_job}>{Lang_chg.txt_job_edit_location[config.language]}</Text>
                            </View>
                            <TouchableOpacity activeOpacity={1} style={styles.crete_location_job}>
                                <View style={{ width: '10%' }}>
                                    <Image resizeMode="contain" style={styles.crete_locationiconjob} source={require('./icons/location4.png')}></Image>
                                </View>


                                {/* let latitude            = job_arr.latitude;
                let longitude           = job_arr.longitude; */}
                                <View style={{ width: '90%', height: 60, justifyContent: "center" }}>
                                    <Text numberOfLines={2} style={styles.cretelocation_jobtxt}>{(this.state.location_address != '') ? this.state.location_address : Lang_chg.txt_create_job_enter_loc[config.language]}</Text>
                                </View>

                            </TouchableOpacity>

                            <TouchableOpacity onPress={() => { this.setState({ mapmodal: true }) }} style={{ width: "50%", alignSelf: 'flex-end', marginRight: '5%', marginTop: 3 }}><Text style={{ color: '#0088e0', fontFamily: 'Poppins-Medium', textDecorationLine: 'underline', textDecorationStyle: 'solid', textAlign: 'right' }}>{Lang_chg.txt_edit_p_change_loca[config.language]}</Text></TouchableOpacity>

                            <View>
                                <Text style={styles.create_title_job}>{Lang_chg.txt_c_landmark_txt[config.language]}</Text>
                                <TextInput
                                    placeholderTextColor='#b8b8b8'
                                    onSubmitEditing={() => { Keyboard.dismiss() }}
                                    returnKeyLabel='done'
                                    style={[styles.create_input_landmark]}
                                    placeholder={Lang_chg.txt_c_landmark_txt[config.language]}
                                    ref={(input) => { this.textinput = input; }}
                                    onChangeText={(txt) => { this.setState({ landmark: txt }) }}
                                    maxLength={250}
                                    minLength={3}
                                    multiline={true}
                                    value={this.state.landmark}
                                ></TextInput>
                            </View>
                            {/* <View style={styles.create_job_service_btn}>
                            <Text style={styles.create_title_job}>{Lang_chg.txt_create_job_enter_selec_ser[config.language]}</Text>
                            <TouchableOpacity activeOpacity={1} onPress={() => {this.setState({service_modal_status:true})}}>
                                <Text style={styles.select_servicerdit}>{Lang_chg.txt_create_job_change[config.language]}</Text>
                            </TouchableOpacity>
                        </View> */}


                            {/*========= service============ */}
                            {/* <FlatList
                            data={this.state.service_arr}
                            horizontal={true}
                            showsHorizontalScrollIndicator={false}
                            renderItem={({ item, index }) => {
                                return (
                                  <View>
                                    {
                                        (item.status) && 
                                        <TouchableOpacity style={{ height: 150, width: 150,margin:6,borderRadius: 15, borderColor: "#ccc", borderWidth: 1,justifyContent:'center',alignItems:'center',padding:15 }} activeOpacity={0.9} >
                                        {
                                            (item.image == 'NA') ? <Image style={styles.home_bank_option1} resizeMode="contain" source={require('./icons/user_error.png')} />
                                                :
                                                <Image style={styles.home_bank_option1} source={{ uri: config.img_url2 + item.image }} />
                                        }
                                        <Text style={styles.name_bankhome} numberOfLines={1}>{item.name}</Text>
                                        <Text style={{fontSize:12}}>$ {item.price} {Lang_chg.txt_select_service_per_hours[config.language]}</Text>
                                         
                                    </TouchableOpacity>

                                    }
                                  </View>
                                    
                                )
                            }}
                            keyExtractor={(index) => { index.toString() }}
                        /> */}
                            {/*=========end service============ */}

                            {/* <View style={styles.create_date_job_box}>
                            <View>
                                <Text style={styles.cretae_job_title}>{Lang_chg.txt_create_job_avial_date[config.language]}</Text>
                                <Text style={styles.crete_job_psg}>{Lang_chg.txt_create_job_avial_date1[config.language]}</Text>
                            </View>
                            <View>
                                <TouchableOpacity activeOpacity={1}>
                                    <Image style={styles.create_dateview} resizeMode="contain" source={require('./icons/plus.png')}></Image>
                                </TouchableOpacity>
                            </View>
                        </View> */}

                            {/* <View style={styles.select_dete_time_job}>
                            <TouchableOpacity style={styles.select_date_left}>
                                <View style={styles.select_date_icon}>
                                    <Image style={styles.calender_Select} resizeMode="contain" source={require('./icons/calender.png')}/> 
                                </View>
                                    <DatePicker style={styles.select_date_input}
                                        onDateChange={(date) => { this.setState({ date: date }) }}
                                        showIcon={false}
                                        customStyles={{
                                            dateInput: {
                                                borderColor: '#234456',
                                                borderWidth: 0,
                                                borderRadius: 4,
                                                alignItems: 'center',
                                                paddingRight: 10, 
                                            },
                                        }}
                                         
                                        date={this.state.date}
                                        confirmBtnText="Confirm"
                                        placeholder={Lang_chg.txt_create_job_select_date[config.language]}
                                        cancelBtnText="Cancel"
                                    />
                               
                                <View style={styles.select_date_arow}>
                                    <Image style={styles.calender_Select_down} resizeMode="contain" source={require('./icons/downarrow.png')}></Image>
                                </View>

                            </TouchableOpacity>

                            <TouchableOpacity style={styles.select_date_left}>
                                <View style={styles.select_date_icon}>
                                    <Image style={styles.calender_Select} resizeMode="contain" source={require('./icons/watch.png')}></Image>
                                </View>
                                    <DatePicker style={styles.select_date_input}
                                        mode="time"
                                        onDateChange={(date) => { this.setState({ time: date }) }}
                                        showIcon={false}
                                        customStyles={{
                                            dateInput: {
                                                borderColor: '#234456',
                                                borderWidth: 0,
                                                borderRadius: 4,
                                                paddingLeft: 0,
                                                marginLeft: 0,
                                            },
                                        }}
                                       
                                        date={this.state.time}
                                        confirmBtnText="Confirm"
                                        placeholder={Lang_chg.txt_create_job_select_time[config.language]}
                                        cancelBtnText="Cancel"
                                    />
                                <View style={styles.select_date_arow}>
                                    <Image style={styles.calender_Select_down} resizeMode="contain" source={require('./icons/downarrow.png')}></Image>
                                </View>
                            </TouchableOpacity>
                        </View> */}

                            {/*eND DATE--------PICKER */}

                            {/* <View style={styles.create_covid}>
                            <Text style={styles.create_title_job}>{Lang_chg.txt_create_job_warning_box[config.language]}</Text>
                            <View style={[styles.create_covid_about, { backgroundColor: color1.covidbg }]}>
                                <Text style={styles.create_about_txt}>
                                {Lang_chg.txt_create_job_warning1[config.language]} {"\n"}
                                {Lang_chg.txt_create_job_warning2[config.language]}  {"\n"}
                                {Lang_chg.txt_create_job_warning3[config.language]}
                                </Text>
                            </View>
                        </View> */}

                            {/* 
                        <View style={{ paddingBottom: 15, paddingLeft: 0, paddingRight: 20 }}>
                            <TouchableOpacity onPress={() => { this.setState({ wallet_check: !this.state.wallet_check}) }} activeOpacity={0.9} disabled={(this.state.wallet_amt==0) ? true : false}>
                                <View style={{ flexDirection: 'row' }}>
                                    {this.state.wallet_check == true &&
                                        <Image style={styles.create_job_check} source={require('./icons/checkboxcheck1.png')}></Image>
                                    }
                                    {this.state.wallet_check == false &&
                                        <Image style={styles.create_job_check} source={require('./icons/checkbox1.png')}></Image>
                                    }
                                    <Text style={{ marginLeft: 10, color: '#000', fontSize: 16, fontFamily: "Poppins-Regular", }}>{Lang_chg.txt_create_job_wallet_amt[config.language]} ($ {this.state.wallet_amt})</Text>
                                </View>
                            </TouchableOpacity>
                        </View> */}

                            {/* <View style={styles.wallet_amount_last}>
                            <Text style={styles.wallet_bottom_total}>{Lang_chg.txt_create_job_totla[config.language]} :</Text>
                            <Text style={styles.wallet_bottom_doller}>$ {this.state.tot_amount}</Text>
                        </View>

                        <View style={styles.login_btn, { marginBottom: 20, marginTop: 10, }}>
                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnSubmitJob() }}>
                                <Text style={styles.btn_txt}>{Lang_chg.txt_create_job_submit[config.language]}</Text>
                            </TouchableOpacity>
                        </View> */}
                            {
                                (job_arr != 'NA') &&

                                <TouchableOpacity style={{ width: '98%', backgroundColor: '#0088e0', height: 50, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginBottom: 50, marginTop: 40 }} activeOpacity={0.9} onPress={() => { this.btnUpdateJob() }}>
                                    <Text style={styles.btn_txt}>{Lang_chg.txt_edit_pro_update[config.language]}</Text>
                                </TouchableOpacity>
                            }
                        </ScrollView>

                    }


                </View>
            </View>
        )
    }


}
