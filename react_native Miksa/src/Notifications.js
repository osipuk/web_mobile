import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, FlatList, ActivityIndicator, Alert } from 'react-native'
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileH, mobileW, } from './Provider/utilslib/Utils';
import color1 from './Colors'
import styles from "./Style.js";
import Footer from './Provider/Footer';
export default class Notifications extends Component {
    onEndReachedCalledDuringMomentum = true;
    constructor(props) {
        super(props);
        this.state = {
            notification_arr: 'NA',
            notification_count: 0,
            last_id: 0,
            isLoading: false,
            hasLoading: false,
            user_type: 0,
        }
    }

    componentDidMount() {
        this.getUserType();
        // const { navigation } = this.props;
        // this.focusListener = navigation.addListener('focus', () => {
        this.setState({
            notification_arr: 'NA',
            notification_count: 0,
            last_id: 0,
            isLoading: false,
            hasLoading: false,
        })
        this._getNotificationList()
        // this.getMyInboxAllData1();
        // });
    }

    componentWillUnmount() {
        const { navigation } = this.props;
        navigation.removeListener('focus', () => {
            console.log('remove lister')
        });
    }

    _getNotificationList = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        consolepro.consolelog('notificationList', url);
        if (result != null) {
            user_id_post = result.user_id;
        }
        let url = config.baseURL + "notificationList.php?user_id_post=" + user_id_post + '&last_id=' + this.state.last_id;
        consolepro.consolelog('notificationList', url);
        if (this.state.last_id <= 0) {
            apifuntion.getApi(url).then((obj) => {
                consolepro.consolelog('notificationList', obj);
                if (obj.success == 'true') {
                    global_notification_count = obj.notification_count;
                    let notification_arr = obj.notification_arr;
                    this.setState({ notification_arr: notification_arr })
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
        } else {
            apifuntion.getNoLodingApi(url).then((obj) => {
                consolepro.consolelog('notificationList', obj);
                if (obj.success == 'true') {
                    global_notification_count = obj.notification_count;
                    let notification_arr = obj.notification_arr;
                    if (notification_arr != 'NA') {
                        let noti = this.state.notification_arr.concat(...notification_arr);
                        this.setState({
                            hasLoading: false,
                            isLoading: false,
                            notification_arr: noti
                        })
                    } else {
                        this.setState({ isLoading: false, hasLoading: false, })
                    }
                } else {
                    if (obj.account_active_status == "deactivate") {
                        config.checkUserDeactivate(this.props.navigation);
                        return false;
                    }
                    msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                    return false;
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
    }

    handleLoadMore = async () => {
        //  console.log('call loa more')
        if (this.state.hasLoading == true && this.state.notification_arr != "NA") {
            var arr_len = this.state.notification_arr.length;
            var last_id = this.state.notification_arr[arr_len - 1].notification_message_id;
            this.setState({
                last_id: last_id, isLoading: true, hasLoading: false,
            }, () => {
                this._getNotificationList()
            });
        }
    }


    renderFooter = () => {
        return (
            this.state.isLoading ? <View style={{ alignItems: 'center', marginVertical: 10 }}>
                <ActivityIndicator color={color1.theme_color} size="large" />
            </View>
                :
                null
        )
    }
    getUserType = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        let user_type = 0;
        if (result != null) {
            this.setState({ user_type: result.user_type })
        }
    }

    _deleteNoti = async (type, id) => {
        if (type == 'single') {
            Alert.alert(
                Lang_chg.Confirm[config.language],
                Lang_chg.msgConfirmTextNotifyDeleteMsg[config.language], [{
                    text: Lang_chg.No[config.language],
                    onPress: () => console.log('Cancel Pressed'),
                    style: Lang_chg.cancel[config.language],
                }, {
                    text: Lang_chg.Yes[config.language],
                    onPress: () => { this._delNotification(type, id) }
                }], {
                cancelable: false
            });
            return true;
        } else {
            Alert.alert(
                Lang_chg.Confirm[config.language],
                Lang_chg.msgConfirmTextNotifyAllDeleteMsg[config.language], [{
                    text: Lang_chg.No[config.language],
                    onPress: () => console.log('Cancel Pressed'),
                    style: Lang_chg.cancel[config.language],
                }, {
                    text: Lang_chg.Yes[config.language],
                    onPress: () => { this._delNotification(type, id) }
                }], {
                cancelable: false
            });
            return true;
        }
    }

    _delNotification = async (type, id) => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        let url = config.baseURL + "notificationDelete.php?user_id_post=" + user_id_post + "&notification_message_id=" + id + "&delete_type=" + type;
        consolepro.consolelog('notificationListurl', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('notificationList', obj);
            if (obj.success == 'true') {
                if (type == 'single') {
                    if (this.state.notification_arr != 'NA') {
                        if (this.state.notification_arr.length > 0) {
                            if (this.state.notification_arr.length == 1) {
                                this.setState({
                                    notification_arr: 'NA',
                                })
                            } else {
                                var ind = this.state.notification_arr.findIndex(x => x.notification_message_id == parseInt(id));
                                this.state.notification_arr.splice(ind, 1);
                                this.setState({
                                    notification_arr: [...this.state.notification_arr],
                                })
                            }

                        } else {
                            this.setState({
                                notification_arr: 'NA',
                            })
                        }
                    }
                } else {
                    this.setState({ notification_arr: 'NA' })
                }
            } else {
                if (obj.account_active_status == "deactivate") {
                    config.checkUserDeactivate(this.props.navigation);
                    return false;
                }
                msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                return false;
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



    _goToPage = (action, action_id,other_user_id=0) => {
        consolepro.consolelog("action=", action_id)
        if (this.state.user_type == 1) {
            if (action == 'job_start' || action == 'job_end' || action == 'job_reject' || action == 'job_accept' || action == 'job_cancel' || action == 'job_create' || action == 'job_avail_accept' || action == 'job_avail_reject' || action == 'arriving_job') {
                this.props.navigation.navigate('Details_job_c', { job_id: action_id });
            }  
            if (action == 'rate_now') {
                this.props.navigation.navigate('Ratings', { user_id: other_user_id });
            }
        } else {
            if (action == 'job_start' || action == 'job_end' || action == 'job_reject' || action == 'job_accept' || action == 'job_cancel' || action == 'job_create' || action == 'arriving_job') {
                this.props.navigation.navigate('Details_job_p', { job_id: action_id });
            } 
            if (action == 'rate_now') {
                this.props.navigation.navigate('Ratings', { user_id: other_user_id });
            } 
        }
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
                        <Text style={{ textAlign: "center", fontFamily: 'Poppins-Medium', color: '#d9ecf9', fontSize: 18 }}>{Lang_chg.txt_notification_txt[config.language]}</Text>
                    </View>
                    <TouchableOpacity style={{ flex: 1, alignItems: 'center', justifyContent: 'center', }} activeOpacity={0.9} onPress={() => { this._deleteNoti('all', 0) }} >
                        {
                            (this.state.notification_arr != 'NA') &&
                            <Text style={{ textAlign: "center", fontFamily: 'Poppins-Medium', color: '#d9ecf9', fontSize: 18 }}>{Lang_chg.Clear[config.language]}</Text>
                        }
                    </TouchableOpacity>
                </View>

                <View style={styles.notofication_body}>
                    {
                        (this.state.notification_arr != 'NA') &&
                        <FlatList
                            data={this.state.notification_arr}
                            horizontal={false}
                            contentContainerStyle={{ paddingHorizontal: 8, paddingTop: 8, paddingBottom: 180 }}
                            showsHorizontalScrollIndicator={false}
                            showsVerticalScrollIndicator={false}
                            inverted={false}
                            onScroll={() => {
                                this.setState({ hasLoading: true });
                            }}
                            onEndReached={() => { this.handleLoadMore() }}
                            onEndReachedThreshold={0.1}
                            ListFooterComponent={this.renderFooter}
                            renderItem={({ item, index }) => {
                                return (
                                    <TouchableOpacity activeOpacity={0.7} onPress={() => { this._goToPage(item.action, item.action_id,item.user_id_me) }} style={styles.notification_box}>
                                        <View style={styles.notification_left}>
                                            {
                                                (item.user_image != 'NA') ?
                                                    <Image style={styles.notiuserimg} resizeMode="cover" source={(item.action == 'login' || item.action == "broadcast" || item.action == "signup" || item.action == 'arriving_job') ? { uri: item.user_image } : { uri: config.img_url1 + item.user_image }}></Image>
                                                    :
                                                    <Image style={styles.notiuserimg} resizeMode="cover" source={require('./icons/user_error.png')}></Image>
                                            }
                                        </View>
                                        <View style={[styles.notification_midle, { marginLeft: 10 }]}>
                                            <Text style={styles.noti_user_name}>{item.user_name}</Text>
                                            <Text style={styles.noti_user_psg}>{item.message[config.language]}</Text>
                                        </View>
                                        <TouchableOpacity style={styles.notification_right} onPress={() => { this._deleteNoti('single', item.notification_message_id) }}>
                                            <View activeOpacity={1} style={styles.noticross}>
                                                <Image style={styles.noti_cross} resizeMode="contain" source={require('./icons/cross2.png')}></Image>
                                            </View>
                                            <Text style={[styles.notification_time]}>{item.createtime_ago}</Text>
                                        </TouchableOpacity>
                                    </TouchableOpacity>
                                )
                            }}
                        />
                    }


                    {
                        (this.state.notification_arr == 'NA') && <View style={{ height: mobileH, width: '100%', alignItems: 'center', paddingTop: mobileH * 0.2 }}>
                            <Image style={{ width: mobileW * 0.4, height: mobileW * 0.4 }} source={require('./icons/no_data_.png')} />
                            <Text style={{ fontSize: 18, color: '#000', fontFamily: 'Poppins-Bold' }}>{Lang_chg.txt_notification_txt_not[config.language]}</Text>
                        </View>
                    }
                </View>



                {

                    (this.state.user_type == 1) && <Footer
                        activepage='Notifications'
                        usertype={1}
                        footerpage={[
                            { name: 'Home_customer', pageName: '', countshow: false, image: require('./icons/home_bank.png'), activeimage: require('./icons/home_active.png') },

                            { name: 'Notifications', pageName: '', countshow: false, image: (global_notification_count > 0) ? require('./icons/notification.png') : require('./icons/w_noti_deactive.png'), activeimage: (global_notification_count > 0) ? require('./icons/notification_active.png') : require('./icons/w_noti_active.png') },

                            { name: 'My_booking', pageName: '', countshow: false, image: require('./icons/book.png'), activeimage: require('./icons/book_active.png'), },

                            { name: 'Saved', pageName: '', countshow: false, image: require('./icons/saved.png'), activeimage: require('./icons/saved_active.png'), inbox_count: count_inbox },

                            { name: 'My_profile', pageName: '', countshow: false, image: require('./icons/profile.png'), activeimage: require('./icons/profile_active.png') },
                        ]}
                        navigation={this.props.navigation}
                        imagestyle1={{ width: 25, height: 25, backgroundColor: '#fff', countcolor: 'white', countbackground: 'black' }}
                        count_inbox={0}
                    />
                }{

                    (this.state.user_type == 2) &&
                    <Footer
                        activepage='Notifications'
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
                }
            </View>
        )
    }
}
