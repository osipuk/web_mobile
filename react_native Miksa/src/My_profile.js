import React, { Component } from 'react'
import { Text, View, StatusBar, SafeAreaView, Image, TouchableOpacity, FlatList, ScrollView } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import StarRating from 'react-native-star-rating';
import Footer from './Provider/Footer';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileW, mobileH } from './Provider/utilslib/Utils';

export default class My_profile extends Component {


    constructor(props) {
        super(props)
        this.state = {
            profile_data: 'NA',
            profile_data1: 'NA',
            house_sketch_img: '',
            provider_house_img: '',
            full_name: '',
            bio: '',
            user_id: '',
            user_profile: "",
            rating_avg: 0,
            rating_count: 0,
            job_arr: 'NA',
        }

        this.props.navigation.addListener('focus', () => {
            this.setDataProfile()
            const timer = setTimeout(() => {
                this.getProfileData()
            }, 500);
            return () => clearTimeout(timer);
        });

    }
    backpress = () => {
        this.props.navigation.goBack();
    }



    setDataProfile = async () => {
        let result = await localStorage.getItemObject('user_arr')
        consolepro.consolelog('result', result)
        if (result != null) {
            this.setState({
                full_name: result.name,
                bio: result.bio,
                user_id: result.user_id,
                user_profile: result.image,
            })
        }
    }

    getProfileData = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;

        }


        let url = config.baseURL + "customer_profile_data.php?user_id_post=" + user_id_post;
        consolepro.consolelog('Forgot change pass data', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Forgot change pass data', obj);
            if (obj.success == 'true') {
                global_notification_count = obj.notification_count;
                this.setState({
                    rating_avg: obj.rating_avg,
                    rating_count: obj.rating_count,
                    job_arr: obj.job_arr,
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


    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />

                <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={{ paddingBottom: 80 }}>
                    <View style={styles.banner_profile}>
                        <View style={styles.profile_setting_icon}>
                            <TouchableOpacity activeOpacity={1} onPress={() => { this.props.navigation.navigate('Edit_profile') }}>
                                <Image style={styles.profile_edit_icon} resizeMode="contain" source={require('./icons/edit2.png')}></Image>
                            </TouchableOpacity>
                            <TouchableOpacity activeOpacity={1} onPress={() => { this.props.navigation.navigate('Setting_p') }}>
                                <Image style={styles.profile_edit_icon} resizeMode="contain" source={require('./icons/settings.png')}></Image>
                            </TouchableOpacity>
                        </View>
                        {
                            (this.state.user_profile == 'NA') && <Image style={styles.Profule_user_pic} resizeMode="cover" source={require('./icons/user_error.png')}></Image>
                        }
                        {
                            (this.state.user_profile != 'NA') && <Image style={styles.Profule_user_pic} resizeMode="cover" source={{ uri: config.img_url1 + this.state.user_profile }}></Image>
                        }
                    </View>

                    <View style={styles.profile_body}>
                        <Text style={styles.profile_name}>{this.state.full_name}</Text>
                        <TouchableOpacity style={styles.profile_reviewer} onPress={() => { this.props.navigation.navigate('Ratings', { user_id: this.state.user_id }) }}>
                            {
                                <View style={{ flexDirection: 'row', alignItems: 'center', justifyContent: "center", width: "52%" }}>
                                    <StarRating
                                        disabled={false}
                                        emptyStar={require('./icons/star.png')}
                                        fullStar={require('./icons/star_active.png')}
                                        halfStar={require('./icons/half_star.png')}
                                        maxStars={5}
                                        rating={this.state.rating_avg}
                                        reversed={false}
                                        starSize={18}
                                        containerStyle={{ width: '50%' }}
                                    />
                                    <Text style={styles.profile_total_review}>{Lang_chg.txt_rating_revie_txt12[config.language]} ({this.state.rating_count})</Text>
                                </View>
                            }
                        </TouchableOpacity>
                        {
                            (this.state.job_arr != 'NA') && <View style={[styles.profile_contact]}>
                                <Text style={styles.profile_jobs}>{Lang_chg.txt_home_my_jobs[config.language]}</Text>
                                <TouchableOpacity activeOpacity={1} onPress={() => { this.props.navigation.navigate('My_booking') }}>
                                    <Text style={[styles.profile_allJobs, { textDecorationLine: 'underline' }]}>{Lang_chg.txt_home_p_View_All[config.language]}</Text>
                                </TouchableOpacity>
                            </View>
                        }



                        <View style={{ width: mobileW }}>
                            {
                                (this.state.job_arr != 'NA') &&
                                <FlatList style={{}}
                                    showsVerticalScrollIndicator={false}
                                    numColumns={2}
                                    data={this.state.job_arr}
                                    renderItem={({ item, index }) => {
                                        return (
                                            <View style={{ width: mobileW / 2, alignItems: 'center', justifyContent: 'center', paddingHorizontal: 5, paddingVertical: 15 }}>
                                                <TouchableOpacity style={{ width: '90%', borderRadius: 20, height: mobileW * 50 / 100, shadowOffset: { width: 0, height: 0, }, shadowOpacity: 1, shadowRadius: 2, elevation: 8, backgroundColor: '#ffffff', shadowColor: '#ccc' }} activeOpacity={1} onPress={() => { this.props.navigation.navigate('Details_job_c', { job_id: item.job_id }) }}>
                                                    <View style={styles.booking_item_detail}>
                                                        <View style={[styles.bookinsg_ID]}>
                                                            <Text style={styles.booking_ID_txt}>{item.job_number}</Text>
                                                        </View>
                                                        {
                                                            (item.image == 'NA') ?
                                                                <Image style={styles.bookingimg} resizeMode="cover" source={require('./icons/banner_error.jpg')}></Image>
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
                                                                    <TouchableOpacity activeOpacity={1} style={styles.booking_favorite}>
                                                                        <Image style={{ width: 20, height: 25, alignSelf: "flex-end" }} resizeMode="contain" source={require('./icons/saved.png')}></Image>
                                                                    </TouchableOpacity>
                                                                    :
                                                                    <TouchableOpacity activeOpacity={1} style={{ width: 30, height: 30, marginTop: 10, alignSelf: "flex-end" }}>
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
                                (this.state.job_arr == 'NA') &&
                                <View style={{
                                    width: '80%',
                                    borderRadius: 20,
                                    marginLeft: 8,
                                    marginRight: 8,
                                    borderWidth: 1,
                                    marginBottom: 20,
                                    borderColor: '#ccc', alignSelf: 'center', padding: 20
                                }}>
                                    <Text style={{ fontSize: 20, fontWeight: '700', alignSelf: 'center' }}>{Lang_chg.txt_job_notF[config.language]}</Text>
                                </View>
                            }
                        </View>
                    </View>
                </ScrollView>
                <Footer
                    activepage='My_profile'
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
