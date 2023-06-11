import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, TextInput, FlatList, Keyboard, Alert } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, notification, SocialLogin, Currentltlg, mobileH, mobileW } from './Provider/utilslib/Utils';

export default class Search_pro_p extends Component {
    backpress = () => {
        this.props.navigation.goBack();
    }

    constructor(props) {
        super(props)
        this.state = {
            searchbtn: false,
            country: false,
            job_arr: "NA",
            job_arr1: "NA",
            search_flag: 'NA',
            searchtext: "",
            title_text: this.props.route.params.heading,
        }
    }

    componentDidMount() {
        this.getHomedata();
    }

    componentWillUnmount() {
        const { navigation } = this.props;
        navigation.removeListener('focus', () => {
            console.log('remove lister')
        });
    }


    getHomedata = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }

        let url = config.baseURL + "job_list_p.php?user_id_post=" + user_id_post + "&search_flag=" + this.state.search_flag + '&searchtext=' + this.state.searchtext;
        consolepro.consolelog('Provider home url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Provider home data', obj);
            if (obj.success == 'true') {
                this.setState({
                    job_arr: obj.job_arr,
                    job_arr1: obj.job_arr,
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



    btnConfirmRejectAccept = (type, other_user_id, job_id, index) => {
        if (type == "reject") {
            Alert.alert(Lang_chg.Confirm[config.language], Lang_chg.msgAcceptRejectJob[config.language], [
                {
                    text: Lang_chg.cancel[config.language],
                    onPress: () => { console.log('nothing') },
                    style: "cancel"
                },
                { text: Lang_chg.Yes[config.language], onPress: () => { this.btnAcceptReject(type, other_user_id, job_id, index) } }
            ], { cancelable: false });
        } else {
            this.btnAcceptReject(type, other_user_id, job_id, index)
        }
    }

    btnAcceptReject = async (type, other_user_id, job_id, index) => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }

        let url = config.baseURL + "job_accept_reject.php?user_id_post=" + user_id_post + "&other_user_id=" + other_user_id + "&action_type=" + type + "&job_id=" + job_id;
        consolepro.consolelog('Provider accept reject url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Provider accept reject data', obj);
            if (obj.success == 'true') {
                if (obj.status == 'yes') {
                    config.checkUserDeactivate(this.props.navigation);
                    return false;
                }
                var job_arr = this.state.job_arr;
                if (type == 'reject') {
                    job_arr[index].status = 3;
                } else {
                    job_arr[index].status = 4;
                }
                if (obj.notification_arr != 'NA') {
                    notification.oneSignalNotificationSendCall(obj.notification_arr)
                }
                this.setState({ job_arr: job_arr, job_arr1: job_arr })
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



    emptyText = (type) => {
        if (type == 'Cross') {
            this.searchfield.clear()
            this.setState({ search_flag: 'NA', searchtext: "" });
        } else {
            this.setState({ search_flag: 'NA', searchbtn: false });
        }
        this.getHomedata();
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
                            <Text style={styles.map_title}>{this.state.title_text}</Text>
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
                            <TouchableOpacity onPress={() => { this.emptyText('not') }} activeOpacity={0.9}>
                                <Image resizeMode="contain" style={{ width: 20, height: 20, resizeMode: 'contain', }} source={require('./icons/back2.png')}></Image>
                            </TouchableOpacity>
                        </View>
                        <View style={{ height: 40, backgroundColor: '#e5e5e9', borderRadius: 20, flexDirection: 'row', width: '90%', alignItems: "center", justifyContent: "center", paddingHorizontal: 10 }}>

                            <TextInput
                                style={{ backgroundColor: '#e5e5e9', width: '90%', borderRadius: 20 }}
                                placeholder="Search Jobs"
                                keyboardType='default'
                                returnKeyLabel='search'
                                returnKeyType='search'
                                ref={(input) => { this.searchfield = input; }}
                                onSubmitEditing={() => { this.setState({ search_flag: 'search' }), Keyboard.dismiss(), this.getHomedata() }}
                                onChangeText={(txt) => { this.setState({ searchtext: txt }) }}
                            />
                            <TouchableOpacity onPress={() => { this.emptyText('Cross') }} style={{ width: '10%' }}><Image resizeMode="contain" style={{ width: 30, height: 30 }} source={require('./icons/cross2.png')}></Image></TouchableOpacity>

                        </View>
                    </View>
                }

                <View style={styles.notofication_body}>
                    {(this.state.job_arr != 'NA') && <FlatList style={{}}
                        showsVerticalScrollIndicator={false}
                        data={this.state.job_arr}
                        contentContainerStyle={{ paddingHorizontal: 5, paddingTop: 5, paddingBottom: 80, marginTop: 15 }}
                        renderItem={({ item, index }) => {
                            return (
                                <TouchableOpacity style={styles.homeplist1} activeOpacity={1} onPress={() => { this.props.navigation.navigate('Details_job_p', { job_id: item.job_id }) }}>
                                    <View style={styles.homelistp_left}>
                                        {
                                            (item.image != 'NA') ?
                                                <Image style={styles.phomeimg} resizeMode="cover" source={{ uri: config.img_url1 + item.image }}></Image>
                                                :
                                                <Image style={styles.phomeimg} resizeMode="cover" source={require('./icons/banner_error.jpg')}></Image>
                                        }

                                    </View>
                                    <View style={styles.homelistp_right}>
                                        <View style={styles.hommed}>
                                            <View>
                                                <Text style={styles.pboxid}>{item.job_number}</Text>
                                            </View>
                                            <View style={styles.phometime}>
                                                <Text style={styles.phometimemint}>{item.time_ago}</Text>
                                                {
                                                    item.saved_status == 0 ?
                                                        <Image style={{ width: 25, height: 25, marginLeft: 10 }} resizeMode="cover" source={require('./icons/saved.png')}></Image>
                                                        :
                                                        <Image style={{ width: 25, height: 25, marginLeft: 10 }} resizeMode="cover" source={require('./icons/saved1.png')}></Image>
                                                }
                                                {/* <Image style={styles.phomelike} resizeMode="contain" source={require('./icons/save_active.png')}></Image> */}
                                            </View>
                                        </View>
                                        <View>
                                            <Text style={styles.viewpaameiem}>{item.titile}</Text>
                                            <Text style={styles.phomepsg} numberOfLines={2}>{item.service_name}</Text>
                                        </View>


                                        <View style={styles.price_code}>
                                            <Text style={styles.home_rice_main}>{config.currency} {item.provider_earning}</Text>


                                            {
                                                (item.status == 0) && <View style={{
                                                    backgroundColor: '#ff9900', borderRadius: 20, width: 110, height: 30, justifyContent: 'center', alignItems: 'center'
                                                }}><Text style={styles.pendingbtnhomme}>{Lang_chg.txt_status_pending[config.language]}</Text></View>

                                            }

                                            {
                                                (item.status == 1 && item.mark_complete_status == 0) && <View style={{
                                                    backgroundColor: '#c0f20c', borderRadius: 20, width: 110, height: 30, justifyContent: 'center', alignItems: 'center'
                                                }}><Text style={styles.pendingbtnhomme}>{Lang_chg.txt_status_Inprogress[config.language]}</Text></View>
                                            }
                                            {
                                                (item.mark_complete_status == 1 && item.status != 5 && item.status != 3) && <View style={{
                                                    backgroundColor: 'green', borderRadius: 20, width: 110, height: 30, justifyContent: 'center', alignItems: 'center'
                                                }}><Text style={styles.pendingbtnhomme}>{Lang_chg.txt_status_Completed[config.language]}</Text></View>
                                            }
                                            {
                                                (item.status == 3) && <View style={{
                                                    backgroundColor: 'red', borderRadius: 20, width: 110, height: 30, justifyContent: 'center', alignItems: 'center'
                                                }}><Text style={styles.pendingbtnhomme}>{Lang_chg.txt_status_Cancelled[config.language]}</Text></View>
                                            }
                                            {
                                                (item.status == 5) && <View style={{
                                                    backgroundColor: 'red', borderRadius: 20, width: 110, height: 30, justifyContent: 'center', alignItems: 'center'
                                                }}><Text style={styles.pendingbtnhomme}>{Lang_chg.txt_status_rejected[config.language]}</Text></View>
                                            }

                                            {
                                                (item.status == 4) && <View style={{
                                                    backgroundColor: 'green', borderRadius: 20, width: 110, height: 30, justifyContent: 'center', alignItems: 'center'
                                                }}><Text style={styles.pendingbtnhomme}>{Lang_chg.txt_status_accepted[config.language]}</Text></View>
                                            }

                                        </View>
                                    </View>
                                </TouchableOpacity>
                            )
                        }}
                    />}
                    {
                        (this.state.job_arr == 'NA') && <View style={{ width: '100%', alignItems: 'center', height: mobileH, marginTop: mobileH * 0.21 }}>
                            <Image style={{ width: mobileW * 0.4, height: mobileW * 0.4 }} source={require('./icons/no_data_.png')} />
                            <Text style={{ fontSize: 18, color: '#000', fontFamily: 'Poppins-Bold' }}>{Lang_chg.txt_search_pro_not[config.language]}</Text>
                        </View>
                    }
                </View>
            </View>
        )
    }
}
