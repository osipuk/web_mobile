import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, TextInput, FlatList, ScrollView, } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileH, mobileW } from './Provider/utilslib/Utils';
import StarRating from 'react-native-star-rating';
import HideWithKeyboard from 'react-native-hide-with-keyboard';

export default class Select_provider extends Component {
    constructor(props) {
        super(props)
        this.state = {
            searchbtn: false,
            country: false,
            searchbtn: false,
            buttonshow: true,
            rating_avg: 0,
            job_data: this.props.route.params.job_data,
            provider_arr: 'NA',
            provider_arr1: 'NA',
            provider_id: 0,
        }
    }
    backpress = () => {
        this.props.navigation.goBack();
    }
    componentDidMount() {
        this.getProviderList();
    }


    getProviderList = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        var job_data = this.state.job_data;
        var service_ = job_data.services;




        consolepro.consolelog('ddfsdfd', job_data.services)
        var service_arr = [];
        for (let index = 0; index < service_.length; index++) {
            service_arr.push(service_[index].service_id);
        }
        consolepro.consolelog('service_', service_arr)



        let url = config.baseURL + "provider_list.php?user_id_post=" + user_id_post + "&service_arr=" + service_arr.join();
        consolepro.consolelog('provider_list url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Provider  data', obj);
            if (obj.success == 'true') {
                this.setState({
                    provider_arr: obj.provider_arr,
                    provider_arr1: obj.provider_arr,
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



    touchflat = (index) => {
        let data1 = this.state.provider_arr;
        for (let i = 0; i < data1.length; i++) {
            data1[i].status = false;
        }
        data1[index].status = !data1[index].status;
        var provider_id = data1[index].provider_id;
        this.setState({
            provider_arr: data1,
            provider_id: provider_id,
        })
    }

    _searchData = (textToSearch) => {
        if (this.state.provider_arr1 != "NA") {
            this.setState({
                provider_arr: this.state.provider_arr1.filter(i =>
                    i.name.toString().toLowerCase().includes(textToSearch.toString().toLowerCase()),
                ),
            })
        }
    }


    btnCountinue = async () => {
        if (this.state.provider_id == 0) {
            msgProvider.toast(Lang_chg.txt_sele_pro_emty[config.language], 'center')
            return false
        }

        this.state.job_data.provider_id = this.state.provider_id;
        consolepro.consolelog("job_arr", this.state.job_data);
        this.props.navigation.navigate('Cretae_job_detail', { job_data: this.state.job_data })

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
                            <Text style={styles.map_title}>{Lang_chg.txt_search_txt_pro[config.language]}</Text>
                            <TouchableOpacity onPress={() => { this.setState({ searchbtn: true }) }}>
                                {
                                    (this.state.provider_arr != 'NA') &&
                                    <Image style={styles.home_search_icon} resizeMode="contain" source={require('./icons/search_white.png')}></Image>
                                }
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

                <ScrollView showsVerticalScrollIndicator={false}>
                    <View style={{ width: '93%', alignSelf: 'center', marginTop: 20 }}>
                        {
                            (this.state.provider_arr != 'NA') &&
                            <FlatList style={{ marginBottom: 20, }}
                                contentContainerStyle={{ paddingHorizontal: 10, paddingTop: 10 }}
                                showsVerticalScrollIndicator={false}
                                numColumns={1}
                                data={this.state.provider_arr}
                                renderItem={({ item, index }) => {
                                    return (
                                        <TouchableOpacity onPress={() => { this.touchflat(index) }} activeOpacity={0.9} style={item.status ? styles.selct_providerbtn1 : styles.selct_providerbtn}>
                                            <View style={styles.rvider_left}>
                                                {
                                                    (item.image != 'NA')
                                                        ?
                                                        <Image style={styles.prvidermglef} resizeMode="cover" source={{ uri: config.img_url1 + item.image }}></Image>
                                                        :
                                                        <Image style={styles.prvidermglef} resizeMode="cover" source={require('./icons/user_error.png')}></Image>
                                                }

                                            </View>
                                            <View style={styles.provider_middle}>
                                                <Text style={styles.rating_name}>{item.name}</Text>
                                                <Text style={styles.rating_txt_main}>{item.service_name}</Text>
                                            </View>
                                            <View style={styles.rvider_rigt}>

                                                <StarRating
                                                    emptyStar={require('./icons/star.png')}
                                                    fullStar={require('./icons/star_active.png')}
                                                    halfStar={require('./icons/half_star.png')}
                                                    maxStars={5}
                                                    rating={item.avg_rating}
                                                    reversed={false}
                                                    starSize={18}
                                                    disabled={true}
                                                />

                                                <Text style={styles.proiderreviewmain}>({item.rating_count})</Text>
                                            </View>
                                        </TouchableOpacity>
                                    )
                                }}
                            />
                        }

                        {
                            (this.state.provider_arr == 'NA') && <View style={{ height: mobileH, width: '100%', alignItems: 'center', paddingTop: mobileH * 0.2 }}>
                                <Image style={{ width: mobileW * 0.4, height: mobileW * 0.4 }} source={require('./icons/no_data_.png')} />
                                <Text style={{ fontSize: 18, color: '#000', fontFamily: 'Poppins-Medium', textAlign: 'center' }}>{Lang_chg.txt_select_error_txt[config.language]}</Text>
                            </View>
                        }

                    </View>

                </ScrollView>
                {
                    (this.state.provider_arr != 'NA') &&
                    <HideWithKeyboard>
                        <View style={{ width: '90%', alignSelf: 'center', marginBottom: 21, }}>
                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnCountinue() }}>
                                <Text style={styles.btn_txt}>{Lang_chg.txt_home_continue_btn[config.language]}</Text>
                            </TouchableOpacity>
                        </View>
                    </HideWithKeyboard>

                }

            </View>
        )
    }
}
