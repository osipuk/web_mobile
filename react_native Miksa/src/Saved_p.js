import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, FlatList, TouchableOpacity, Image, Alert } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileH, mobileW, notification } from './Provider/utilslib/Utils';
import Footer from './Provider/Footer';
export default class Saved_p extends Component {
    constructor(props) {
        super(props)
        this.state = {
            job_arr: 'NA',
            job_arr1: 'NA',
        }
    }

    componentDidMount() {
        this.props.navigation.addListener('focus', () => {
            const timer = setTimeout(() => {
                this.getSavedJobList();
            }, 90);
            return () => clearTimeout(timer);
        });
    }
    componentWillUnmount() {
        const { navigation } = this.props;
        navigation.removeListener('focus', () => {
            console.log('remove lister')
        });
    }
    getSavedJobList = async () => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        let url = config.baseURL + "fav_list.php?user_id_post=" + user_id_post;
        consolepro.consolelog('muboking url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('My Booking data', obj);
            if (obj.success == 'true') {
                global_notification_count = obj.notification_count;
                var job_arr = obj.job_arr;
                this.setState({ job_arr: job_arr })
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


    confirmClearJob = (type, job_id) => {
        Alert.alert(Lang_chg.Confirm[config.language], Lang_chg.msgremeveSaveJobCOnfirm[config.language], [
            {
                text: Lang_chg.cancel[config.language],
                onPress: () => { console.log('nothing') },
                style: "cancel"
            },
            { text: Lang_chg.Yes[config.language], onPress: () => { this.removeJob(type, job_id) } }
        ], { cancelable: false });
    }

    removeJob = async (type, job_id) => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        let url = config.baseURL + "fav_remove.php?user_id_post=" + user_id_post + "&job_id_post=" + job_id + '&type=' + type;
        consolepro.consolelog('job remove url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('job remove data', obj);
            if (obj.success == 'true') {
                this.setState({ job_arr: 'NA', job_arr1: 'NA' })
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
                this.setState({ job_arr: job_arr, job_arr1: job_arr })
                if (obj.notification_arr != 'NA') {
                    notification.oneSignalNotificationSendCall(obj.notification_arr)
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


    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />

                <View style={styles.headerContainer}>
                    <View style={{ flex: 1, justifyContent: "center" }}>
                        <TouchableOpacity style={{ flexDirection: "row", alignItems: "center" }}
                        // onPress={() => this.props.navigation.goBack()}
                        >
                            {/* <Image style={{ width: 20, height: 20, marginLeft: 5 }}
                                source={require('./icons/back_white.png')}
                                resizeMode="contain"
                            /> */}
                        </TouchableOpacity>
                    </View>
                    <View style={{ flex: 2, justifyContent: "center", }}>
                        <Text style={{ textAlign: "center", fontFamily: 'Poppins-Medium', color: '#d9ecf9', fontSize: 18 }}>{Lang_chg.txt_saved_txt[config.language]}</Text>
                    </View>
                    <TouchableOpacity style={{ flex: 1, alignItems: 'center', justifyContent: 'center', }} activeOpacity={0.9} onPress={() => { this.confirmClearJob('all', 0) }}>
                        {
                            (this.state.job_arr != 'NA') &&
                            <Text style={{ textAlign: "center", fontFamily: 'Poppins-Medium', color: '#d9ecf9', fontSize: 18 }}>{Lang_chg.Clear[config.language]}</Text>
                        }
                    </TouchableOpacity>
                </View>

                <View style={[styles.notofication_body]}>

                    {
                        (this.state.job_arr != 'NA') &&
                        <FlatList
                            showsVerticalScrollIndicator={false}
                            contentContainerStyle={{ paddingHorizontal: 5, paddingTop: 10, paddingBottom: 180 }}
                            data={this.state.job_arr}
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
                                                    (item.mark_complete_status == 1 && item.status != 3 && item.status != 5) && <View style={{
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
                        />
                    }
                    {
                        (this.state.job_arr == 'NA') && <View style={{ height: mobileH, width: '100%', alignItems: 'center', paddingTop: mobileH * 0.2 }}>
                            <Image style={{ width: mobileW * 0.4, height: mobileW * 0.4 }} source={require('./icons/no_data_.png')} />
                            <Text style={{ fontSize: 18, color: '#000', fontFamily: 'Poppins-Bold' }}>{Lang_chg.txt_saved_txt_not[config.language]}</Text>
                        </View>
                    }
                </View>
                <Footer
                    activepage='Saved_p'
                    usertype={1}
                    footerpage={[
                        { name: 'Home_p', pageName: '', countshow: false, image: require('./icons/home_bank.png'), activeimage: require('./icons/home_active.png') },

                        { name: 'Notifications', pageName: '', countshow: false, image: (global_notification_count > 0) ? require('./icons/notification.png') : require('./icons/w_noti_deactive.png'), activeimage: (global_notification_count > 0) ? require('./icons/notification_active.png') : require('./icons/w_noti_active.png') },

                        { name: 'Saved_p', pageName: '', countshow: false, image: require('./icons/saved.png'), activeimage: require('./icons/saved_active.png'), inbox_count: count_inbox },

                        { name: 'My_profile_p', pageName: '', countshow: false, image: require('./icons/profile.png'), activeimage: require('./icons/profile_active.png') },
                    ]}
                    navigation={this.props.navigation}
                    imagestyle1={{ width: 25, height: 25, backgroundColor: '#fff', countcolor: 'white', countbackground: 'black' }}
                    count_inbox={0}
                />
            </View>
        )
    }
}
