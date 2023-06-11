import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, ScrollView, Image, Dimensions, FlatList, BackHandler, Alert } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import Carousel from 'react-native-banner-carousel';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, firebaseprovider } from './Provider/utilslib/Utils';
import OneSignal from 'react-native-onesignal';
import Footer from './Provider/Footer';
import firebase from './Config1';
const BannerWidth = Dimensions.get('window').width;
const BannerHeight = Dimensions.get('window').height;
const screenwidth = Dimensions.get('window').width;

export default class Home_customer extends Component {
    _didFocusSubscription;
    _willBlurSubscription;
    constructor(props) {
        super(props)
        this.state = {
            country: false,
            searchbtn: false,
            buttonshow: false,
            image_arr: 'NA',
            service_arr: 'NA',
            service_arr1: 'NA',
            data_found_flag: 'NA',
            countinbox: 0

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
        // OneSignal.addEventListener('ids', this.onIds.bind(this));
        OneSignal.addEventListener('opened', this.onOpened);
        OneSignal.addEventListener('received', this.onReceived);

        this._willBlurSubscription = this.props.navigation.addListener('blur', payload =>
            BackHandler.removeEventListener('hardwareBackPress', this.handleBackPress)
        );


        this.props.navigation.addListener('focus', payload => {
            this.setState({ buttonshow: false })
            this.getHomedata();
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


    async onReceived(event) {
        var datajson = event.payload.additionalData.p2p_notification.action_json;
        var other_user_id = datajson.other_user_id;
        var action = datajson.action;
        consolepro.consolelog("datajson home=", datajson);
        var userdata = await localStorage.getItemObject('user_arr')
        if (userdata.user_id == other_user_id) {
            other_user_id = datajson.user_id
        }

        if (userdata != null) {
            // if (action != 'login') {
            global_notification_count = global_notification_count + 1;
            this.setState({ notification_count: global_notification_count });
            // }
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
                if (action == 'job_start' || action == 'job_end' || action == 'job_reject' || action == 'job_accept' || action == 'job_cancel' || action == 'job_create' || action == 'arriving_job') {
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



    getHomedata = async () => {

        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;

        }

        let url = config.baseURL + "home_data_customer.php?user_id_post=" + user_id_post;
        consolepro.consolelog('Customer home url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Customer home data', obj);
            if (obj.success == 'true') {
                if (this.state.service_arr != "NA") {
                    global_notification_count = obj.notification_count;
                    this.setState({
                        service_arr: obj.service_arr,
                        service_arr1: obj.service_arr,
                        image_arr: obj.banner_arr,
                        data_found_flag: "NA"
                    })
                } else {
                    this.setState({
                        service_arr: obj.service_arr,
                        image_arr: obj.banner_arr,
                        data_found_flag: Lang_chg.txt_home_service_not_found[config.language]
                    })
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

    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />


                <View styles={{ justifyContent: 'space-between', flexDirection: 'row', paddingBottom: 10, }}>
                    <View style={styles.homebank_header}>
                        <View style={styles.home_bank_header}>
                            <View><Text style={styles.home_bani_title}>{Lang_chg.txt_home_dicocer[config.language]}</Text></View>
                        </View>
                        <View style={styles.homebank_header_right}>
                            {/* <TouchableOpacity activeOpacity={0.9} onPress={() => { this.props.navigation.navigate('Search_pro') }}>
                                <Image style={styles.home_search_icon} resizeMode="contain" source={require('./icons/search2.png')}></Image>
                            </TouchableOpacity> */}
                            {/* <TouchableOpacity activeOpacity={1} onPress={() => { this.props.navigation.navigate('Inbox_p') }}>
                                {
                                    (this.state.countinbox > 0) ?
                                        <Image style={styles.home_chat_icon} resizeMode="contain" source={require('./icons/chat.png')}></Image>
                                        :
                                        <Image style={styles.home_chat_icon} resizeMode="contain" source={require('./icons/chat12.png')}></Image>
                                }
                            </TouchableOpacity> */}
                        </View>
                    </View>
                </View>



                <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={{ paddingBottom: 85 }}>
                    {/*===============================home banner  *=======================================*/}
                    <View style={styles.home_slider}>
                        {
                            (this.state.image_arr != 'NA') ?
                                <Carousel
                                    autoplay
                                    style={{ borderRadius: 90, }}
                                    autoplayTimeout={5000}
                                    loop
                                    index={0}
                                    pageIndicatorStyle={{ backgroundColor: '#cceef6' }}
                                    activePageIndicatorStyle={{ color: '#01a8e7', backgroundColor: '#01a8e7', width: 7 }}
                                    pageSize={BannerWidth * 100 / 100}>

                                    {
                                        this.state.image_arr.map((item1, index) => {
                                            return (
                                                <Image source={{ uri: config.img_url + item1.image }} style={{ width: BannerWidth, height: BannerHeight * 32 / 90 }} />
                                            )
                                        })
                                    }

                                </Carousel>
                                :
                                <Image source={require('./icons/banner_error.jpg')} style={{ width: BannerWidth, height: BannerHeight * 32 / 90 }} />
                        }

                    </View>
                    {/*===============================End home banner=======================================*/}
                    <View style={{ marginBottom: 30, width: BannerWidth }}>
                        {
                            (this.state.service_arr != 'NA') &&
                            <FlatList
                                style={{ marginBottom: 0, backgroundColor: '#fff', paddingTop: 20 }}
                                showsVerticalScrollIndicator={false}
                                data={this.state.service_arr}
                                numColumns={2}
                                renderItem={({ item, index }) => {
                                    return (
                                        <View style={{ width: screenwidth / 2, alignItems: 'center', justifyContent: 'center', paddingHorizontal: 5, paddingVertical: 15 }}>
                                            <TouchableOpacity activeOpacity={0.9} style={(item.status) ? styles.list_bank_box21 : styles.list_bank_box20} onPress={() => {
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
                                                </View>


                                            </TouchableOpacity>
                                        </View>
                                    )
                                }}
                                keyExtractor={(item, index) => 'key' + index}
                            />
                        }

                        {
                            (this.state.data_found_flag != 'NA' && this.state.service_arr == 'NA') &&
                            <View style={{ width: '80%', borderColor: '#fff', borderWidth: 1, padding: 20, justifyContent: 'center', alignItems: 'center', alignSelf: 'center' }}>
                                <Text style={{ fontWeight: '700', color: '#000', fontSize: 18 }}>{Lang_chg.txt_home_service_not_found[config.language]}</Text>
                            </View>
                        }
                    </View>
                </ScrollView>
                {this.state.buttonshow && <View style={{ position: 'absolute', width: '94%', alignSelf: 'center', bottom: 81 }}>
                    <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => {
                        this.props.navigation.navigate('Create_jobs', {
                            service_arr: this.state.service_arr
                        })
                    }}>
                        <Text style={styles.btn_txt}>{Lang_chg.txt_home_continue_btn[config.language]}</Text>
                    </TouchableOpacity>
                </View>}

                <Footer
                    activepage='Home_customer'
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
            </View>
        )
    }
}
