import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, ScrollView, TouchableOpacity, Image, FlatList, BackHandler, Alert, RefreshControl } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, notification, Currentltlg, mobileH, mobileW, firebaseprovider } from './Provider/utilslib/Utils';
import OneSignal from 'react-native-onesignal';
import Footer from './Provider/Footer';
import firebase from './Config1';
export default class Home_p extends Component {
    _didFocusSubscription;
    _willBlurSubscription;

    constructor(props) {
        super(props)
        this.state = {
            refresh: false,
            job_arr: "NA",
            job_arr1: "NA",
        }
        this._didFocusSubscription = props.navigation.addListener('focus', payload =>
            BackHandler.addEventListener('hardwareBackPress', this.handleBackPress)
        );
        OneSignal.init(config.onesignalappid, {
            kOSSettingsKeyAutoPrompt: true,
        });
        OneSignal.setLogLevel(6, 0);
    }


    componentDidMount() {
        OneSignal.setLocationShared(true);
        OneSignal.inFocusDisplaying(2);
        OneSignal.addEventListener('opened', this.onOpened);
        OneSignal.addEventListener('received', this.onReceived);


        this._willBlurSubscription = this.props.navigation.addListener('blur', payload =>
            BackHandler.removeEventListener('hardwareBackPress', this.handleBackPress)
        );
        this.props.navigation.addListener('focus', () => {
            const timer = setTimeout(() => {
                this.getHomedata()
            }, 900);
            this.getMyInboxAllData1()
            return () => clearTimeout(timer);
        });
    }



    componentWillUnmount() {
        OneSignal.removeEventListener('opened', this.onOpened);
        const { navigation } = this.props;
        navigation.removeListener('focus', () => {
            console.log('remove lister')
        });
    }

    getMyInboxAllData1 = async () => {
        console.log('getMyInboxAllData');
        userdata = await localStorage.getItemObject('user_arr')
        //------------------------------ firbase code get user inbox ---------------
        if (userdata != null) {
            // alert("himanshu");
            var id = 'u_' + userdata.user_id;
            if (inboxoffcheck > 0) {
                console.log('getMyInboxAllDatainboxoffcheck');
                var queryOffinbox = firebase.database().ref('users/' + id + '/myInbox/').child(userChatIdGlobal);
                queryOffinbox.off('child_added');
                queryOffinbox.off('child_changed');
            }

            var queryUpdatemyinbox = firebase.database().ref('users/' + id + '/myInbox/');
            queryUpdatemyinbox.on('child_changed', (data) => {
                console.log('inboxkachildchange', data.toJSON())

                firebaseprovider.firebaseUserGetInboxCount()
                setTimeout(() => { this.setState({ countinbox: count_inbox }) }, 2000);

                //  this.getalldata(currentLatlong)
            })
            var queryUpdatemyinboxadded = firebase.database().ref('users/' + id + '/myInbox/');
            queryUpdatemyinboxadded.on('child_added', (data) => {
                console.log('inboxkaadded', data.toJSON())
                firebaseprovider.firebaseUserGetInboxCount()
                setTimeout(() => { this.setState({ countinbox: count_inbox }) }, 2000);

                // firebaseprovider.firebaseUserGetInboxCount();
            })

        }
    }

    onOpened = async (openResult) => {
        console.log('openResult: ', openResult);
        console.log('Message: ', openResult.notification.payload.body);
        console.log('Data: ', openResult.notification.payload.additionalData);
        console.log('isActive: ', openResult.notification.isAppInFocus);
        console.log('openResult: ', openResult);
        var datajson = openResult.notification.payload.additionalData.p2p_notification.action_json;
        var user_id = datajson.user_id;
        var other_user_id = datajson.other_user_id;
        var action_id = datajson.action_id;
        var action = datajson.action;
        var userdata = await localStorage.getItemObject('user_arr')
        console.log('datajson_user_id', datajson.user_id)
        console.log('datajson_other_user_id', datajson.other_user_id)
        console.log('datajson_action_id', datajson.action_id)
        console.log('datajson_action', datajson.action)
        if (userdata.user_id == other_user_id) {
            other_user_id = datajson.user_id
        }

        if (userdata != null) {
            if (userdata.user_type == 1) {
                if (action == 'job_start' || action == 'job_end' || action == 'job_reject' || action == 'job_accept' || action == 'job_cancel' || action == 'job_create' || action == 'job_avail_accept' || action == 'job_avail_reject' || action == 'arriving_job') {
                    this.props.navigation.navigate('Details_job_c', { job_id: action_id });
                }
                if (action == 'broadcast') {
                    this.props.navigation.navigate('Notifications');
                }
                if (action == 'rate_now') {
                    this.props.navigation.navigate('Ratings', { user_id: userdata.user_id });
                }
            } else {
                if (action == 'job_start' || action == 'job_end' || action == 'job_reject' || action == 'job_accept' || action == 'job_cancel' || action == 'job_create' || action == 'arriving_job') {
                    this.props.navigation.navigate('Details_job_p', { job_id: action_id });
                }
                if (action == 'broadcast') {
                    this.props.navigation.navigate('Notifications');
                }
                if (action == 'rate_now') {
                    this.props.navigation.navigate('Ratings', { user_id: userdata.user_id });
                }
            }
        } else {
            this.setState({ loading: false })
            this.props.navigation.navigate('Login')
        }
    }

    handleBackPress = () => {
        Alert.alert(
            Lang_chg.titleexitapp[config.language],
            Lang_chg.exitappmessage[config.language], [{
                text: Lang_chg.No[config.language],
                onPress: () => console.log('Cancel Pressed'),
                style: Lang_chg.cancel[config.language],
            }, {
                text: Lang_chg.Yes[config.language],
                onPress: () => BackHandler.exitApp()
            }], {
            cancelable: false
        }
        ); // works best when the goBack is async
        return true;
    };

    _onRefresh = () => {
        this.setState({ refresh: true })
        this.getHomedata(1);
    }



    getHomedata = async (loding_type = 0) => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;

        }

        let url = config.baseURL + "home_data_provider.php?user_id_post=" + user_id_post;
        consolepro.consolelog('Provider home url', url);
        apifuntion.getApi(url, loding_type).then((obj) => {
            consolepro.consolelog('Provider home data', obj);
            if (obj.success == 'true') {
                global_notification_count = obj.notification_count;
                this.setState({ job_arr: obj.job_arr, job_arr1: obj.job_arr, refresh: false })
            } else {
                this.setState({ refresh: false })
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
            this.setState({ refresh: false })
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




    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />

                <ScrollView showsVerticalScrollIndicator={false} scrollEnabled={(this.state.job_arr != 'NA') ? true : false} contentContainerStyle={{ paddingBottom: 80 }} refreshControl={
                    <RefreshControl
                        refreshing={this.state.refresh}
                        onRefresh={this._onRefresh}
                    />
                }>

                    <View style={[styles.homep_body]}>
                        <View style={styles.home_ptop}>
                            <View>
                                <Text style={styles.dicovertitle}>
                                    {Lang_chg.txt_home_p_discover[config.language]}
                                </Text>
                                <Text style={styles.dicovertitlebold}>
                                    {Lang_chg.txt_home_p_Job_Request[config.language]}
                                </Text>
                            </View>
                            <View>
                                {/* <TouchableOpacity activeOpacity={1} onPress={() => { this.props.navigation.navigate('Inbox_p') }}>
                                    {
                                        (count_inbox > 0) ?
                                            <Image style={styles.home_chat_icon} resizeMode="contain" source={require('./icons/chat.png')}></Image>
                                            :
                                            <Image style={styles.home_chat_icon} resizeMode="contain" source={require('./icons/chat12.png')}></Image>
                                    }
                                </TouchableOpacity> */}
                            </View>
                        </View>

                        <TouchableOpacity activeOpacity={1} style={styles.hmep_seach} onPress={() => { this.props.navigation.navigate('Search_pro_p', { heading: Lang_chg.txt_home_p_View_All_search[config.language] }) }}>
                            <Image style={styles.home_psearch_icon} resizeMode="contain" source={require('./icons/search2.png')}></Image>
                            <Text style={styles.homep_seach}>{Lang_chg.txt_home_p_Job_serach[config.language]}</Text>
                        </TouchableOpacity>
                    </View>

                    <View style={{
                        marginTop: mobileH * 0.06, paddingTop: 8,
                        // backgroundColor: '#f3fdfc',
                    }}>

                        <View style={styles.top_resetview}>
                            <View style={styles.profile_contact}>
                                <Text style={styles.profile_jobs}>{Lang_chg.txt_home_p_Job_recent[config.language]}</Text>
                                <TouchableOpacity activeOpacity={1} onPress={() => { this.props.navigation.navigate('Search_pro_p', { heading: Lang_chg.txt_home_p_View_All_jobs[config.language] }) }}>
                                    <Text style={{ fontFamily: "Poppins-Regular", color: '#0088e0', fontSize: 14, textDecorationLine: 'underline', textDecorationStyle: 'solid' }}>{Lang_chg.txt_home_p_View_All[config.language]}</Text>
                                </TouchableOpacity>
                            </View>
                        </View>

                        <View style={{ width: '95%', alignSelf: 'center', marginTop: 20, }} >
                            {
                                (this.state.job_arr != 'NA') &&
                                <FlatList
                                    scrollEnabled={false}
                                    showsVerticalScrollIndicator={false}
                                    contentContainerStyle={{ paddingHorizontal: 5, paddingTop: 5 }}
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
                                                        {/* {
                                                            (item.status == 4) && <View style={{
                                                                backgroundColor: 'red', borderRadius: 20, width: 110, height: 30, justifyContent: 'center', alignItems: 'center'
                                                            }}><Text style={styles.pendingbtnhomme}>{Lang_chg.txt_status_accepted[config.language]}</Text></View>
                                                        } */}
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
                                (this.state.job_arr == 'NA') && <View style={{ width: '100%', alignItems: 'center', paddingTop: 30, height: mobileH * 0.60 }}>
                                    <Image style={{ width: mobileW * 0.4, height: mobileW * 0.4 }} source={require('./icons/no_data_.png')} />
                                    <Text style={{ fontSize: 18, color: '#000', fontFamily: 'Poppins-Bold' }}>{Lang_chg.txt_home_p_Job_not[config.language]}</Text>
                                </View>
                            }


                        </View>
                    </View>
                </ScrollView>
                <Footer
                    activepage='Home_p'
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
