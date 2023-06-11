import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Dimensions, Modal, ScrollView, FlatList, Image, TextInput, Keyboard } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
// import DatePicker from 'react-native-datepicker'
import HideWithKeyboard from 'react-native-hide-with-keyboard';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mediaprovider, Cameragallery, Mapprovider, mobileH, mobileW } from './Provider/utilslib/Utils';
import RBSheet from "react-native-raw-bottom-sheet";
import DatePicker from 'react-native-date-picker'

const screenwidth = Dimensions.get('window').width;
var newDate = new Date();

var mi_min = parseInt(newDate.getMinutes());
var remain = 0;
if (mi_min <= 30) {
    remain = 30 - mi_min;
} else {
    remain = 60 - mi_min;
}
newDate.setMinutes(newDate.getMinutes() + remain);
newDate.setHours(newDate.getHours() + 1);
var newDate1 = new Date();
newDate1.setMinutes(newDate1.getMinutes() + remain);
newDate1.setHours(newDate1.getHours() + 1);
// const demodat1=[1,];
export default class Create_jobs extends Component {
    constructor(props) {
        newDate = new Date();

        var mi_min = parseInt(newDate.getMinutes());
        var remain = 0;
        if (mi_min <= 30) {
            remain = 30 - mi_min;
        } else {
            remain = 60 - mi_min;
        }

        newDate.setMinutes(newDate.getMinutes() + remain);
        newDate.setHours(newDate.getHours() + 1);
        newDate1 = new Date();
        newDate1.setMinutes(newDate1.getMinutes() + remain);
        newDate1.setHours(newDate1.getHours() + 1);

        super(props)
        this.state = {
            wallet_check: false,
            service_arr: this.props.route.params.service_arr,
            service_arr1: this.props.route.params.service_arr,
            buttonshow: true,
            service_modal_status: false,
            searchbtn: false,
            show_img: [{ id: 0 }, { id: 0 }, { id: 0 }],
            img_type: 0,
            mediamodal1: false,
            mapmodal: false,
            address: '',
            latitude: '',
            longitude: '',
            landmark: '',
            title: '',
            tot_amount: 0,
            tot_service_amount: 0,
            txt_isd_amt: 0,
            wallet_amt: 0,
            row_date: newDate,
            row_time: new Date(),
            currentdatefleg: true,
            date: '',
            time: '',
            dateTimeArr: [1],
            dateTimeArr1: [1],
            selected_date_index: -1,
            maxDateVailidation: newDate,
            isd_perc: 0,
        }
    }

    componentDidMount() {
        this.countAmount();
        const timer = setTimeout(() => {
            this.getisdAmountper();
        }, 400);
        return () => clearTimeout(timer);
    }



    getisdAmountper = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        let url = config.baseURL + "isd_percentage.php?user_id_post=" + user_id_post;
        consolepro.consolelog('Customer home url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Customer home data', obj);
            if (obj.success == 'true') {
                this.setState({
                    isd_perc: obj.isd_perc,
                })
                this.countAmount();
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

    countAmount = async () => {

        var dateArrSend = [];
        for (var i = 0; i < this.state.dateTimeArr.length; i++) {
            if (this.state.dateTimeArr[i] != 1) {
                dateArrSend.push(this.state.dateTimeArr[i])
            }
        }

        var length = dateArrSend.length;

        let data1 = this.state.service_arr;
        var count = 0;
        for (let i = 0; i < data1.length; i++) {
            if (data1[i].status == true) {
                if (length > 0) {
                    count = count + parseFloat(data1[i].price) * parseFloat(length);
                } else {
                    count = count + parseFloat(data1[i].price);
                }
            }
        }
        let tot_amount = 0;
        let txt_isd_amt = 0
        if (this.state.isd_perc != 0) {
            txt_isd_amt = (this.state.isd_perc * count) / 100;
        }
        tot_amount = txt_isd_amt + count;
        this.setState({
            tot_amount: tot_amount,
            tot_service_amount: count,
            txt_isd_amt: txt_isd_amt,
            service_modal_status: false
        })
    }


    selectDiselectServicces = (index, service_id) => {
        let data1 = this.state.service_arr;
        data1[index].status = !data1[index].status;

        var send_data = [];
        for (let i = 0; i < data1.length; i++) {
            if (data1[i].status == true) {
                send_data.push(data1[i].service_id);
            }
        }

        if (send_data.length <= 0) {
            this.setState({
                service_arr: data1,
                buttonshow: false,
            })
        } else {
            this.setState({
                service_arr: data1,
                buttonshow: true,
            })
        }
    }

    _searchData = (textToSearch) => {
        if (this.state.service_arr1 != "NA") {
            this.setState({
                service_arr: this.state.service_arr1.filter(i =>
                    i.name.toString().toLowerCase().includes(textToSearch.toString().toLowerCase()),
                ),
            })
        }
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
        let url = config.baseURL + "user_image_delete.php?user_id_post=" + user_id_post + "&user_image_id=" + id;


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

    btnSubmitJob = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        Keyboard.dismiss()
        let { date, time, title, tot_amount, show_img, address, latitude, longitude, landmark, wallet_check, wallet_amt, dateTimeArr } = this.state;
        var dateArrSend = [];
        for (var i = 0; i < dateTimeArr.length; i++) {
            if (dateTimeArr[i] != 1) {
                dateArrSend.push(dateTimeArr[i])
            }
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

        // date 
        if (dateArrSend.length <= 0) {
            msgProvider.toast(Lang_chg.emptyDatetime[config.language], 'center')
            return false
        }

        let data1 = this.state.service_arr;
        var send_data = [];
        for (let i = 0; i < data1.length; i++) {
            if (data1[i].status == true) {
                send_data.push(data1[i]);
            }
        }

        if (send_data.length <= 0) {
            msgProvider.toast(Lang_chg.txt_select_service[config.language], 'center')
            return false
        }

        var payment_mode = 'online';
        var online_pay_amt = tot_amount;
        var wallet_pay_amt = 0;
        // if (wallet_check == true) {
        //     if (parseFloat(tot_amount) > parseFloat(wallet_amt)) {
        //         payment_mode = 'wallet_online';
        //         online_pay_amt = parseFloat(tot_amount) - parseFloat(wallet_amt);
        //         wallet_pay_amt = parseFloat(wallet_amt);
        //     } else {
        //         payment_mode = 'wallet';
        //         wallet_pay_amt = parseFloat(tot_amount);
        //         online_pay_amt = 0;
        //     }
        // }


        var data = {
            'services': send_data,
            'title': title,
            'avail_date': date,
            'avail_time': time,
            'price': tot_amount,
            'address': address,
            'latitude': latitude,
            'longitude': longitude,
            'user_id_post': user_id_post,
            tot_amount: this.state.tot_amount,
            tot_service_amount: this.state.tot_service_amount,
            txt_isd_amt: this.state.txt_isd_amt,
            isd_perc: this.state.isd_perc,
            'wallet_amount': 0,
            'provider_id': 0,
            'show_img': show_img,
            'payment_mode': payment_mode,
            'online_pay_amt': online_pay_amt,
            'wallet_pay_amt': wallet_pay_amt,
            'dateArrSend': dateArrSend,
            'landmark': landmark,
        }
        this.props.navigation.navigate('Select_provider', { job_data: data });

    }

    _closeDatePicker = () => {
        this.DatePicker.close();
    }

    _setDatePicker = () => {
        var d = newDate;

        // ================================#30 Minutes date time============================================
        var dates_arr = this.state.dateTimeArr1;
        var dateArrSend = [];
        for (var i = 0; i < dates_arr.length; i++) {
            if (dates_arr[i] != 1) {
                dateArrSend.push(dates_arr[i])
            }
        }
        consolepro.consolelog('dateArrSend', dateArrSend);
        for (var j = 0; j < dateArrSend.length; j++) {
            var date121 = new Date(dateArrSend[j]);
            date121.setMinutes(date121.getMinutes() + 29);
            var date132 = new Date(d);
            consolepro.consolelog('date121', date121);
            consolepro.consolelog('date132', date132);
            if (date121 > date132) {
                msgProvider.toast(Lang_chg.timediiferr[config.language], 'center')
                return false;
            }
        }
        // ================================#30 Minutes date time============================================

        var m = d.getMonth() + 1;
        var y = d.getFullYear();
        var date = d.getDate();
        var hours = d.getHours();
        var minutes = d.getMinutes();
        if (hours.toString().length == 1) {
            hours = '0' + hours;
        }
        if (minutes.toString().length == 1) {
            minutes = '0' + minutes;
        }
        if (m.toString().length == 1) {
            m = '0' + m;
        }
        if (date.toString().length == 1) {
            date = '0' + date;
        }
        var fulldate = y + '-' + m + '-' + date + ' ' + hours + ':' + minutes;


        var fulldate12 = y + '-' + m + '-' + date;
        this.state.dateTimeArr[this.state.selected_date_index] = fulldate;
        this.state.dateTimeArr1[this.state.selected_date_index] = d;
        this.setState({ dateTimeArr: [...this.state.dateTimeArr], dateTimeArr1: [...this.state.dateTimeArr1] })
        consolepro.consolelog('this.state.dateTimeArr=', this.state.dateTimeArr)
        consolepro.consolelog('this.state.dateTimeArr1=', this.state.dateTimeArr1)

        var newDate12 = new Date();

        var mi_min = parseInt(newDate12.getMinutes());
        var remain = 0;
        if (mi_min <= 30) {
            remain = 30 - mi_min;
        } else {
            remain = 60 - mi_min;
        }

        newDate12.setMinutes(newDate12.getMinutes() + remain);
        newDate12.setHours(newDate12.getHours() + 1);
        var newDate11 = new Date();
        newDate11.setMinutes(newDate11.getMinutes() + remain);
        newDate11.setHours(newDate11.getHours() + 1);
        newDate = newDate12;
        newDate1 = newDate11;
        this.DatePicker.close();
        this.countAmount()
    }


    setDate = (d) => {
        newDate = d;
    }

    addDateTimePicker = () => {
        this.state.dateTimeArr.push(1)
        this.state.dateTimeArr1.push(1)
        this.setState({
            dateTimeArr: [...this.state.dateTimeArr],
            dateTimeArr1: [...this.state.dateTimeArr1]
        })
    }

    removeDatePicker = (index) => {
        if (this.state.dateTimeArr.length > 1) {
            this.state.dateTimeArr.splice(index, 1);
            this.state.dateTimeArr1.splice(index, 1);
            this.setState({
                dateTimeArr: [...this.state.dateTimeArr],
                dateTimeArr1: [...this.state.dateTimeArr1],
            })
        }
        this.countAmount();
    }

    OpenDatePicker(index) {

        newDate = new Date();
        var mi_min = parseInt(newDate.getMinutes());
        var remain = 0;
        if (mi_min <= 30) {
            remain = 30 - mi_min;
        } else {
            remain = 60 - mi_min;
        }
        newDate.setMinutes(newDate.getMinutes() + remain);
        newDate.setHours(newDate.getHours() + 1);
        newDate1 = new Date();
        newDate1.setHours(newDate1.getHours() + 1);
        newDate1.setMinutes(newDate1.getMinutes() + remain);
        this.setState({ selected_date_index: index, row_date: new Date() });
        this.DatePicker.open()
    }

    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                <RBSheet
                    ref={ref => { this.DatePicker = ref }}
                    height={300}
                    openDuration={200}
                    closeDuration={200}
                    customStyles={{
                        container: {
                        }
                    }}
                >
                    <View style={{ backgroundColor: "#0088e0", paddingTop: 20, paddingBottom: 20, paddingLeft: 20, paddingRight: 20, flexDirection: 'row', justifyContent: 'space-between' }}>
                        <TouchableOpacity activeOpacity={1} onPress={() => { this._closeDatePicker() }}>
                            <Text style={{ color: '#ffffff', fontFamily: "Poppins-Bold" }}>{Lang_chg.txt_job_close[config.language]}</Text>
                        </TouchableOpacity>
                        <TouchableOpacity activeOpacity={1} onPress={() => { this._closeDatePicker() }}>
                            <Text style={{ color: '#ffffff', fontFamily: "Poppins-Bold" }} onPress={() => { this._setDatePicker() }}>{Lang_chg.Done[config.language]}</Text>
                        </TouchableOpacity>

                    </View>
                    <View style={{ justifyContent: 'center', alignItems: 'center' }}>
                        <DatePicker
                            date={newDate}
                            onDateChange={(date) => this.setDate(date)}
                            mode='datetime'
                            minimumDate={newDate1}
                            minuteInterval={30}
                        />
                    </View>
                </RBSheet>



                {/*================================ Services modal========================= */}
                <Modal animationType="slide" transparent={false} visible={this.state.service_modal_status}
                    onRequestClose={() => { this.setState({ service_modal_status: !this.state.service_modal_status }) }}>
                    <View style={{ flex: 1, backgroundColor: '#ffffff', width: '100%', }}>




                        <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                        <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                            networkActivityIndicatorVisible={true} />
                        {this.state.searchbtn == false &&
                            <View styles={{ justifyContent: 'space-between', flexDirection: 'row' }}>
                                <View style={[styles.search_pro_header, { backgroundColor: color1.theme_color }]}>
                                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.setState({ service_modal_status: !this.state.service_modal_status }) }}>
                                        <Image style={styles.home_search_icon} resizeMode="contain" source={require('./icons/back2.png')}></Image>
                                    </TouchableOpacity>
                                    <Text style={styles.map_title}>{Lang_chg.txt_select_service[config.language]}</Text>
                                    <TouchableOpacity onPress={() => { this.setState({ searchbtn: true }) }}>
                                        <Image style={styles.home_search_icon} resizeMode="contain" source={require('./icons/search_white.png')}></Image>
                                    </TouchableOpacity>
                                </View>
                            </View>}
                        {this.state.searchbtn == true &&
                            <View style={[styles.input_main_header, { backgroundColor: color1.theme_color, alignItems: 'center', paddingTop: 10, paddingBottom: 15 }]}>
                                <View style={styles.search_back_header}>
                                    <TouchableOpacity onPress={() => { this.setState({ searchbtn: false }) }} activeOpacity={0.9}>
                                        <Image resizeMode="contain" style={{ width: 20, height: 20, resizeMode: 'contain', }} source={require('./icons/back2.png')}></Image>
                                    </TouchableOpacity>
                                </View>
                                <View style={{ height: 40, backgroundColor: '#e5e5e9', borderRadius: 20, flexDirection: 'row', width: '90%', alignItems: "center", justifyContent: "center", paddingHorizontal: 10 }}>

                                    <TextInput
                                        style={{ backgroundColor: '#e5e5e9', width: '90%', borderRadius: 20 }}
                                        placeholder={Lang_chg.txt_select_service_search[config.language]}
                                        onChangeText={text => this._searchData(text)}
                                        returnKeyLabel='done'
                                        keyboardType='default'
                                    />

                                    {/* <Image resizeMode="contain" style={{ width: 30, height: 30,width:'10%' }} source={require('./icons/cross2.png')}></Image> */}
                                </View>
                            </View>
                        }

                        <TouchableOpacity activeOpacity={0.8} onPress={() => { this.countAmount() }} style={{ backgroundColor: '#42a7e8', width: '90%', alignSelf: 'center', height: 60, position: 'absolute', bottom: (config.device_type == 'ios') ? mobileH * 0.05 : mobileH * 0.02, zIndex: 99, alignItems: 'center', justifyContent: 'center', borderRadius: 50, }}>

                            <Text style={styles.btn_txt}>{Lang_chg.txt_home_continue_btn[config.language]}</Text>

                        </TouchableOpacity>

                        <View style={{ width: '100%', }}>

                            {
                                (this.state.service_arr != 'NA') &&
                                <FlatList
                                    contentContainerStyle={{ paddingBottom: mobileH * 0.2 }}
                                    showsVerticalScrollIndicator={false}
                                    data={this.state.service_arr}
                                    numColumns={2}
                                    renderItem={({ item, index }) => {
                                        return (
                                            <View style={{ width: screenwidth / 2, alignItems: 'center', justifyContent: 'center', paddingHorizontal: 5, paddingVertical: 15 }}>
                                                <TouchableOpacity activeOpacity={0.9} style={(item.status) ? styles.list_bank_box21 : styles.list_bank_box20} onPress={() => { this.selectDiselectServicces(index, item.service_id); }}>
                                                    <View style={{ height: '45%', width: '100%' }}>
                                                        {
                                                            (item.image == 'NA') ? <Image style={styles.home_bank_option} resizeMode="contain" source={require('./icons/user_error.png')}></Image>
                                                                :
                                                                <Image resizeMode="contain" style={{ width: '100%', height: '100%' }} source={{ uri: config.img_url2 + item.image }}></Image>
                                                        }
                                                    </View>
                                                    <View style={{ height: '55%', width: '100%', marginTop: 10 }}>
                                                        <Text style={styles.name_bankhome} numberOfLines={2}>{item.name}</Text>
                                                    </View>
                                                </TouchableOpacity>
                                            </View>
                                        )
                                    }}
                                    keyExtractor={(item, index) => 'key' + index}
                                />
                            }

                            {
                                (this.state.service_arr == 'NA') &&
                                <View style={{ width: '80%', borderColor: '#fff', borderWidth: 1, padding: 20, justifyContent: 'center', alignItems: 'center', alignSelf: 'center' }}>
                                    <Text style={{ fontWeight: '700', color: '#000', fontSize: 18 }}>Services not found</Text>
                                </View>
                            }
                            {/* <HideWithKeyboard>
                        <View style={{ width: '90%',position:'absolute',backgroundColor:'red',top:20 }}>
                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.countAmount() }}>
                                <Text style={styles.btn_txt}>{Lang_chg.txt_home_continue_btn[config.language]}</Text>
                            </TouchableOpacity>
                        </View> 
                    </HideWithKeyboard>*/}
                        </View>

                    </View>
                </Modal>
                {/*================================End Services modal========================= */}
                <Cameragallery mediamodal={this.state.mediamodal1} Camerapopen={this._openCamera1} Galleryopen={this._openGellery1} Canclemedia={this.closeMediaPopup} />

                <Mapprovider mapmodal={this.state.mapmodal} locationget={this.locationget} address_arr="NA" canclemap={this.CloseMap} comingPageName='create_jobs' />

                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text style={styles.map_title}>{Lang_chg.txt_create_job_title[config.language]}</Text>
                    <Text></Text>
                </View>

                <View style={{ paddingHorizontal: 10, width: '95%', alignSelf: 'center', paddingBottom: 50 }}>
                    <ScrollView showsVerticalScrollIndicator={false}>

                        <View>
                            <Text style={styles.cretae_job_title}>{Lang_chg.txt_create_job_upload[config.language]}</Text>
                            <Text style={styles.crete_job_psg}>{Lang_chg.txt_create_job_upload1[config.language]}</Text>
                        </View>

                        <FlatList
                            contentContainerStyle={{ flexDirection: 'row', justifyContent: 'space-between', marginTop: 15, marginHorizontal: 5 }}
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
                                            <TouchableOpacity activeOpacity={0.9} style={{ position: 'absolute', right: 0, right: 2, top: 2 }} onPress={() => { this._removeImg(index, item.id) }}>
                                                <Image resizeMode="contain" style={styles.cross_slider} source={require('./icons/cross.png')} />
                                            </TouchableOpacity>
                                        }
                                    </TouchableOpacity>
                                )
                            }}
                            keyExtractor={(index) => { index.toString() }}
                        />

                        <View>
                            <Text style={styles.create_title_job}>{Lang_chg.title_txt[config.language]}</Text>
                            <TextInput
                                placeholderTextColor='#b8b8b8'
                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                returnKeyLabel='done'
                                style={[styles.create_input_titlejob]} placeholder={Lang_chg.txt_create_job_enter_title[config.language]}
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
                        <TouchableOpacity onPress={() => { this.setState({ mapmodal: true }) }} activeOpacity={1} style={styles.crete_location_job}>
                            <View style={{ width: '10%' }}>
                                <Image resizeMode="contain" style={styles.crete_locationiconjob} source={require('./icons/location4.png')}></Image>
                            </View>
                            <View style={{ width: '90%' }}>
                                <Text style={styles.cretelocation_jobtxt} numberOfLines={2}>{(this.state.address != '') ? this.state.address : Lang_chg.txt_create_job_enter_loc[config.language]}</Text>
                            </View>
                        </TouchableOpacity>


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

                        <View style={styles.create_job_service_btn}>
                            <Text style={styles.create_title_job}>{Lang_chg.txt_create_job_enter_selec_ser[config.language]}</Text>
                            <TouchableOpacity activeOpacity={1} onPress={() => { this.setState({ service_modal_status: true }) }}>
                                <Text style={{ fontFamily: 'Poppins-Medium', fontStyle: 'italic', marginTop: 8, fontSize: 18, color: '#0088e0', textDecorationLine: 'underline', textDecorationStyle: 'solid' }}>{Lang_chg.txt_create_job_change[config.language]}</Text>
                            </TouchableOpacity>
                        </View>


                        {/*========= service============ */}
                        <FlatList
                            data={this.state.service_arr}
                            horizontal={true}
                            showsHorizontalScrollIndicator={false}
                            renderItem={({ item, index }) => {
                                return (
                                    <View>
                                        {
                                            (item.status) &&
                                            <TouchableOpacity style={{ height: 150, width: 150, margin: 6, borderRadius: 15, justifyContent: 'center', alignItems: 'center', padding: 15, shadowOffset: { width: 1, height: 1, }, shadowOpacity: 1, shadowRadius: 2, elevation: 3, backgroundColor: '#fff', shadowColor: '#ccc', }} activeOpacity={0.9} >
                                                {
                                                    (item.image == 'NA') ? <Image style={styles.home_bank_option1} resizeMode="contain" source={require('./icons/user_error.png')} />
                                                        :
                                                        <Image style={styles.home_bank_option1} source={{ uri: config.img_url2 + item.image }} />
                                                }
                                                <Text style={styles.name_bankhome} numberOfLines={1}>{item.name}</Text>
                                                <Text style={{ fontSize: 12 }}>$ {item.price} {Lang_chg.txt_select_service_per_hours[config.language]}</Text>

                                            </TouchableOpacity>

                                        }
                                    </View>

                                )
                            }}
                            keyExtractor={(index) => { index.toString() }}
                        />
                        {/*=========end service============ */}

                        <View style={styles.create_date_job_box}>
                            <View>
                                <Text style={styles.cretae_job_title}>{Lang_chg.txt_create_job_avial_date[config.language]}</Text>
                                <Text style={styles.crete_job_psg}>{Lang_chg.txt_create_job_avial_date1[config.language]}</Text>
                            </View>
                            <View>
                                <TouchableOpacity activeOpacity={1} onPress={() => { this.addDateTimePicker() }}>
                                    <Image style={styles.create_dateview} resizeMode="contain" source={require('./icons/plus.png')}></Image>
                                </TouchableOpacity>
                            </View>
                        </View>


                        <View>
                            <FlatList
                                contentContainerStyle={{ paddingBottom: 10 }}
                                data={this.state.dateTimeArr}
                                keyExtractor={(index) => { index.toString() }}
                                renderItem={({ item, index }) => {
                                    return (
                                        <View style={{
                                            width: '100%',
                                            flexDirection: 'row',
                                            justifyContent: 'space-between',
                                            alignItems: 'center',
                                            marginTop: 20,
                                        }}>
                                            <View style={{ width: '80%' }}>
                                                <TouchableOpacity style={styles.ggjdhgjdgsajhgaj} onPress={() => { this.OpenDatePicker(index) }}>
                                                    <View style={{ alignItems: 'center', justifyContent: 'center', flexDirection: 'row' }}>
                                                        <Image style={styles.calender_Select} resizeMode="contain" source={require('./icons/calender.png')}></Image>
                                                        <Text style={{ marginLeft: 15 }}>{(item != 1) ? item : Lang_chg.txt_create_job_select_date[config.language]}</Text>
                                                    </View>
                                                    <View style={{ paddingRight: 10 }}>
                                                        <Image style={styles.calender_Select_down} resizeMode="contain" source={require('./icons/downarrow.png')}></Image>
                                                    </View>
                                                </TouchableOpacity>
                                            </View>
                                            <TouchableOpacity style={{ width: '20%', alignItems: 'flex-end', marginRight: 5 }} onPress={() => { this.removeDatePicker(index) }}>
                                                <Image style={{ width: 25, height: 25 }} resizeMode="contain" source={require('./icons/cross.png')}></Image>
                                            </TouchableOpacity>
                                        </View>
                                    )
                                }}
                            />
                        </View>



                        {/*eND DATE--------PICKER */}

                        <View style={styles.create_covid}>
                            <Text style={styles.create_title_job}>{Lang_chg.txt_create_job_warning_box[config.language]}</Text>
                            <View style={[styles.create_covid_about, { backgroundColor: color1.covidbg, marginTop: 10 }]}>
                                <Text style={styles.create_about_txt}>
                                    {Lang_chg.txt_covide_12[config.language]}
                                </Text>
                            </View>
                        </View>


                        {/* <View style={{ paddingBottom: 15, paddingLeft: 0, paddingRight: 20 }}>
                            <TouchableOpacity onPress={() => { this.setState({ wallet_check: !this.state.wallet_check }) }} activeOpacity={0.9} disabled={(this.state.wallet_amt == 0) ? true : false}>
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

                        {/* {
                            (parseInt(this.state.isd_perc) > 0) && <>
                                <View style={styles.wallet_amount_last}>
                                    <Text style={styles.wallet_bottom_total1}>{Lang_chg.txt_total_service_amt[config.language]} :</Text>
                                    <Text style={styles.wallet_bottom_doller1}>$ {this.state.tot_service_amount.toFixed(2)}</Text>
                                </View>
                                <View style={styles.wallet_amount_last}>
                                    <Text style={styles.wallet_bottom_total1}>{Lang_chg.txt_tax_isd[config.language]}({this.state.isd_perc}%) :</Text>
                                    <Text style={styles.wallet_bottom_doller1}>$ {this.state.txt_isd_amt.toFixed(2)}</Text>
                                </View>
                            </>
                        } */}
                        <View style={styles.wallet_amount_last}>
                            <Text style={styles.wallet_bottom_total1}>{Lang_chg.txt_detail_job_totla[config.language]} :</Text>
                            <Text style={styles.wallet_bottom_doller1}>$ {this.state.tot_amount.toFixed(2)}</Text>
                        </View>
                        <View style={[styles.login_btn, { marginBottom: 20, marginTop: 10, }]}>
                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnSubmitJob() }}>
                                <Text style={styles.btn_txt}>{Lang_chg.txt_create_job_submit[config.language]}</Text>
                            </TouchableOpacity>
                        </View>
                    </ScrollView>
                </View>
            </View>
        )
    }
}
