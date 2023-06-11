import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, FlatList, Image } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileH, mobileW } from './Provider/utilslib/Utils';
import Footer from './Provider/Footer';
export default class My_booking extends Component {
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
                this.getBookingList();
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


    getBookingList = async () => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        let user_type = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
            user_type = userdata.user_type
        }

        let url = config.baseURL + "job_list.php?user_id_post=" + user_id_post + "&user_type=" + user_type;
        consolepro.consolelog('muboking url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('My Booking data', obj);
            if (obj.success == 'true') {
                global_notification_count = obj.notification_count;
                var job_arr = obj.job_arr;
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
                <View style={styles.map_top}>
                    <Text></Text>
                    <Text style={styles.map_title}>{Lang_chg.txt_my_job_booking1[config.language]}</Text>
                    <Text></Text>
                </View>

                <View style={{ width: mobileW, alignSelf: 'center' }}>
                    {
                        (this.state.job_arr != 'NA') &&
                        <FlatList
                            contentContainerStyle={{ paddingBottom: 180, paddingTop: 20 }}
                            showsVerticalScrollIndicator={false}
                            numColumns={2}
                            data={this.state.job_arr}
                            renderItem={({ item, index }) => {
                                consolepro.consolelog("image = ", config.img_url1 + item.image)
                                return (
                                    <View style={{ width: mobileW / 2, alignItems: 'center', justifyContent: 'center', paddingHorizontal: 5, paddingVertical: 15 }}>
                                        <TouchableOpacity style={{ width: '90%', borderRadius: 20, height: mobileW * 50 / 100, shadowOffset: { width: 0, height: 0, }, shadowOpacity: 1, shadowRadius: 2, elevation: 8, backgroundColor: '#ffffff', shadowColor: '#ccc' }} activeOpacity={1} onPress={() => { this.props.navigation.navigate('Details_job_c', { job_id: item.job_id }) }}>
                                            <View style={styles.booking_item_detail}>
                                                <View style={[styles.bookinsg_ID]}>
                                                    <Text style={styles.booking_ID_txt}>{item.job_number}</Text>
                                                </View>
                                                {
                                                    (item.image == 'NA') ? <Image style={styles.bookingimg} resizeMode="cover" source={require('./icons/banner_error.jpg')}></Image>
                                                        :
                                                        <Image style={styles.bookingimg} resizeMode="cover" source={{ uri: config.img_url2 + item.image }}></Image>
                                                }

                                            </View>
                                            <View style={styles.booking_heart_view}>
                                                <View style={styles.booking_item_left}>
                                                    <Text numberOfLines={1} style={{ fontSize: 16, fontFamily: "Poppins-Bold", marginTop: 5, }}>{item.titile}</Text>
                                                    <Text style={styles.booking_item_time}>{item.createtime}</Text>
                                                    {
                                                        (item.status == 0) && <Text style={styles.booking_item_pending}>{Lang_chg.txt_status_pending[config.language]}</Text>
                                                    }
                                                    {
                                                        (item.status == 1) && <Text style={styles.booking_item_inprogress}>{Lang_chg.txt_status_Inprogress[config.language]}</Text>
                                                    }
                                                    {
                                                        (item.status == 2) && <Text style={styles.booking_item_complete}>{Lang_chg.txt_status_Completed[config.language]}</Text>
                                                    }
                                                    {
                                                        (item.status == 3) && <Text style={styles.booking_item_reject}>{Lang_chg.txt_status_Cancelled[config.language]}</Text>
                                                    }
                                                    {
                                                        (item.status == 5) && <Text style={styles.booking_item_reject}>{Lang_chg.txt_status_rejected[config.language]}</Text>
                                                    }
                                                    {
                                                        (item.status == 4) && <Text style={styles.adfasdasaccept}>{Lang_chg.txt_status_accepted[config.language]}</Text>
                                                    }

                                                </View>
                                                <View style={styles.booking_item_right}>
                                                    {
                                                        item.saved_status == 0 ?
                                                            <TouchableOpacity style={{ width: 30, height: 30, marginTop: 10, alignSelf: "flex-end" }}>
                                                                <Image style={{ width: 20, height: 25, alignSelf: "flex-end" }} resizeMode="contain" source={require('./icons/saved.png')}></Image>
                                                            </TouchableOpacity>
                                                            :
                                                            <TouchableOpacity style={{ width: 30, height: 30, marginTop: 10, alignSelf: "flex-end" }}>
                                                                <Image style={{ width: 20, height: 25, tintColor: "#706b6c" }} resizeMode="contain" source={require('./icons/saved1.png')}></Image>
                                                            </TouchableOpacity>
                                                    }
                                                </View>
                                            </View>
                                        </TouchableOpacity>
                                    </View>
                                )
                            }}
                        />
                    }
                    {
                        (this.state.job_arr == 'NA') && <View style={{ height: mobileH, width: '100%', alignItems: 'center', paddingTop: mobileH * 0.2 }}>
                            <Image style={{ width: mobileW * 0.4, height: mobileW * 0.4 }} source={require('./icons/no_data_.png')} />
                            <Text style={{ fontSize: 18, color: '#000', fontFamily: 'Poppins-Bold' }}>{Lang_chg.txt_job_edit_not[config.language]}</Text>
                        </View>
                    }

                </View>
                <Footer
                    activepage='My_booking'
                    usertype={1}
                    footerpage={[
                        { name: 'Home_customer', pageName: '', countshow: false, image: require('./icons/home_bank.png'), activeimage: require('./icons/home_active.png') },

                        { name: 'Notifications', pageName: '', countshow: false, image: (global_notification_count > 0) ? require('./icons/notification.png') : require('./icons/w_noti_deactive.png'), activeimage: (global_notification_count > 0) ? require('./icons/notification_active.png') : require('./icons/w_noti_active.png') },

                        { name: 'My_booking', pageName: '', countshow: false, image: require('./icons/book.png'), activeimage: require('./icons/book_active.png'), inbox_count: global_notification_count },

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
