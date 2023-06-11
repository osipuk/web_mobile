import React, { Component } from 'react'
import { Text, Dimensions, View, SafeAreaView, StatusBar, Image, TouchableOpacity, TextInput, ScrollView, FlatList, BackHandler } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, validationprovider, mediaprovider, Cameragallery } from './Provider/utilslib/Utils';
const screenwidth = Dimensions.get('window').width;
export default class Select_service_p extends Component {
    _didFocusSubscription;
    _willBlurSubscription;

    constructor(props) {
        super(props);
        this.state = {
            searchbtn: false,
            searchbtn: false,
            buttonshow: false,
            service_arr: 'NA',
            service_arr1: 'NA',
            send_services: [],
        }

        this._didFocusSubscription = props.navigation.addListener('focus', payload =>
            BackHandler.addEventListener('hardwareBackPress', this.handleBackPress)
        );
    }

    componentDidMount() {

        this._willBlurSubscription = this.props.navigation.addListener('blur', payload =>
            BackHandler.removeEventListener('hardwareBackPress', this.handleBackPress)
        );
        const timer = setTimeout(() => {
            this.getServicesData();
        }, 500);
        return () => clearTimeout(timer);
    }

    handleBackPress = () => {
        this.props.navigation.navigate('Login')
        return true;
    };

    backpress = () => {
        this.props.navigation.navigate('Login');
    }

    getServicesData = async () => {
        let user_id = await localStorage.getItemObject('user_id');
        let url = config.baseURL + 'service_list.php?user_id_post=' + user_id;
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('service array', obj);
            if (obj.success == 'true') {
                let service_arr = obj.service_arr;
                this.setState({ service_arr: service_arr, service_arr1: service_arr })
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

    selectDiselectServicces = (index, service_id) => {
        let data1 = this.state.service_arr;
        let data12 = this.state.service_arr1;
        data1[index].status = !data1[index].status;

        // var ind = data12.findIndex(x => x.service_id == service_id);

        var send_data = [];
        for (let i = 0; i < data1.length; i++) {
            if (data1[i].status == true) {
                send_data.push(data1[i].service_id);
            }
        }

        if (send_data.length <= 0) {
            this.setState({
                service_arr: data1,
                send_services: send_data,
                buttonshow: false,
            })
        } else {
            this.setState({
                service_arr: data1,
                send_services: send_data,
                buttonshow: true,
            })
        }
    }

    btnSubmitServices = async () => {
        let user_id = await localStorage.getItemObject('user_id');
        if (this.state.send_services.length <= 0) {
            msgProvider.toast(Lang_chg.txt_select_service[config.language], 'center')
            return false
        }

        var data = new FormData();
        data.append("user_id_post", user_id)
        data.append("signup_type", "service_add")
        data.append("service_arr[]", JSON.stringify(this.state.send_services));
        consolepro.consolelog('signup step4', data);
        let url = config.baseURL + "signup_step2.php";
        consolepro.consolelog('signup step4', url);
        apifuntion.postApi(url, data).then((obj) => {
            consolepro.consolelog('signup step4', obj);
            if (obj.success == 'true') {
                this.props.navigation.navigate('House_sketch');
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

    _searchData = (textToSearch) => {
        if (this.state.service_arr1 != "NA") {
            this.setState({
                service_arr: this.state.service_arr1.filter(i =>
                    i.name.toString().toLowerCase().includes(textToSearch.toString().toLowerCase()),
                ),
            })
        }
    }


    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                {this.state.searchbtn == false &&
                    <View styles={{ justifyContent: 'space-between', flexDirection: 'row' }}>
                        <View style={[styles.search_pro_header, { backgroundColor: color1.theme_color }]}>
                            <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                                <Image style={styles.home_search_icon} resizeMode="contain" source={require('./icons/back2.png')}></Image>
                            </TouchableOpacity>
                            <Text></Text>
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

                <View style={styles.select_servicepage}>
                    <View>
                        <Text style={styles.selec_ro_serice}>
                            {Lang_chg.txt_select_service_txt[config.language]}
                        </Text>
                        <Text style={styles.selec_ro_psg}>
                            {Lang_chg.txt_select_service_txt1[config.language]}
                        </Text>
                    </View>
                </View>
                <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={{ paddingBottom: 80 }}>
                    <View style={{ marginBottom: 30, width: screenwidth }}>
                        <FlatList style={{ marginBottom: 0, backgroundColor: '#fff', paddingTop: 20, }}
                            showsVerticalScrollIndicator={false}
                            data={this.state.service_arr}
                            numColumns={2}
                            renderItem={({ item, index }) => {
                                return (
                                    <View style={{ width: screenwidth / 2, alignItems: 'center', justifyContent: 'center', paddingHorizontal: 5, paddingVertical: 15 }}>
                                        <TouchableOpacity activeOpacity={0.9} style={(item.status) ? styles.list_bank_box1 : styles.list_bank_box} onPress={() => {
                                            this.selectDiselectServicces(index, item.service_id);
                                        }}>
                                            <View style={{ height: '45%', width: '100%' }}>
                                                {
                                                    (item.image == 'NA') ? <Image style={styles.home_bank_option} resizeMode="contain" source={require('./icons/user_error.png')}></Image>
                                                        :
                                                        <Image resizeMode="contain" style={{ width: '100%', height: '100%' }} source={{ uri: config.img_url2 + item.image }}></Image>
                                                }
                                            </View>
                                            <View style={{ height: '55%', width: '100%', marginTop: 10 }}>
                                                <Text style={styles.name_bankhome} numberOfLines={2}>{item.name}</Text>
                                                <Text numberOfLines={2} style={styles.name_bankhome}>$ {item.price} {Lang_chg.txt_select_service_per_hours[config.language]}</Text>
                                            </View>


                                        </TouchableOpacity>
                                    </View>
                                )
                            }}
                        />
                    </View>
                </ScrollView>
                <View style={styles.homebankbtn, { width: '90%', alignSelf: 'center', position: 'absolute', bottom: 20 }}>
                    <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnSubmitServices() }}>
                        <Text style={styles.btn_txt}>{Lang_chg.txt_select_service_counti[config.language]}</Text>
                    </TouchableOpacity>
                </View>
            </View>
        )
    }
}




