import React, { Component } from 'react'
import { Text, View, StatusBar, SafeAreaView, Image, TouchableOpacity, Dimensions, ScrollView, Linking, Modal } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileH, mobileW } from './Provider/utilslib/Utils';
import StarRating from 'react-native-star-rating';
import ImageZoom from 'react-native-image-pan-zoom';
import Footer from './Provider/Footer';
export default class My_profile_p extends Component {

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
            imageModal: false,
            image_path: ""
        }

        this.props.navigation.addListener('focus', () => {
            this.setDataProfile()
            const timer = setTimeout(() => {
                this.getProfileData();
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
                house_sketch_img: result.house_sketch_img,
                provider_house_img: result.provider_house_img,
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

        let url = config.baseURL + "provider_profile_data.php?user_id_post=" + user_id_post;
        consolepro.consolelog('Forgot change pass data', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Forgot change pass data', obj);
            if (obj.success == 'true') {
                global_notification_count = obj.notification_count;
                this.setState({
                    profile_data: obj.user_data,
                    rating_avg: obj.rating_avg,
                    rating_count: obj.rating_count,
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
    callto = () => {
        this.setState({ modalVisible: false })
        if (this.state.profile_data.mobile_no != '' && this.state.profile_data.mobile_no != null && this.state.profile_data.mobile_no != 'NA') {
            Linking.openURL(`tel:${this.state.profile_data.mobile_no}`)
        }
    }
    render() {

        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />

                <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={{ paddingBottom: 80 }}>

                    <Modal
                        animationType="slide"
                        visible={this.state.imageModal}
                        onRequestClose={() => {
                            this.setState({ imageModal: false })
                        }}>
                        <SafeAreaView>

                            <View style={{ width: '100%', alignSelf: 'center', flexDirection: 'row', paddingTop: 10, backgroundColor: '#0088e0' }}>
                                <TouchableOpacity style={{ paddingVertical: 15, width: '20%', alignSelf: 'center' }} onPress={() => { this.setState({ imageModal: false }) }}>
                                    <View style={{ width: '100%', alignSelf: 'center' }}>
                                        <Image source={require('./icons/back2.png')} style={{ alignSelf: 'center', width: 20, height: 20, resizeMode: 'contain' }} />
                                    </View>
                                </TouchableOpacity>
                                <View style={{ paddingVertical: 15, width: '60%' }}>

                                </View>
                                <TouchableOpacity style={{ paddingVertical: 15, width: '20%', alignSelf: 'center' }} onPress={() => { null }}>
                                    <View style={{ width: '100%', alignSelf: 'center' }} >

                                    </View>
                                </TouchableOpacity>

                            </View>
                            <View style={{ flex: 1 }}>
                                <ImageZoom style={{ justifyContent: "center", alignItems: 'center' }} cropWidth={Dimensions.get('window').width}
                                    cropHeight={mobileH * 0.95}
                                    imageWidth={mobileW * 0.92}
                                    imageHeight={mobileW * 0.92}>
                                    <Image style={{ width: mobileW * 0.92, height: mobileW * 0.92 }}
                                        source={{ uri: this.state.image_path }} resizeMode="contain" />
                                </ImageZoom>
                            </View>

                        </SafeAreaView>
                    </Modal>

                    <View style={styles.banner_profileps}>
                        <View style={styles.profile_setting_icon}>
                            <TouchableOpacity activeOpacity={1} onPress={() => { this.props.navigation.navigate('Edit_profile_p') }}>
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

                    <View style={styles.profile_body_p}>
                        <Text style={styles.profile_name}>{this.state.full_name}</Text>
                        <TouchableOpacity style={styles.profile_reviewer} activeOpacity={1} onPress={() => { this.props.navigation.navigate('Ratings', { user_id: this.state.user_id }) }}>
                            {
                                (this.state.profile_data != 'NA') &&
                                <View style={{ flexDirection: 'row', alignItems: 'center', justifyContent: "center", width: "52%" }}>
                                    <StarRating

                                        emptyStar={require('./icons/star.png')}
                                        fullStar={require('./icons/star_active.png')}
                                        halfStar={require('./icons/half_star.png')}
                                        maxStars={5}
                                        rating={this.state.rating_avg}
                                        reversed={false}
                                        starSize={18}
                                        containerStyle={{ width: '50%' }}
                                        disabled={true}
                                    />
                                    <Text style={styles.profile_total_review}>{Lang_chg.txt_detail_job_Review[config.language]} ({this.state.rating_count})</Text>
                                </View>
                            }
                        </TouchableOpacity>

                        <View style={styles.p_pprofilebio}>
                            <Text style={styles.profile_jobs}>{Lang_chg.txt_bio_txxt[config.language]}</Text>
                            <Text style={styles.profile_pnnamecv}>{this.state.bio}</Text>
                        </View>

                        <View style={styles.pprovider_profille_boox}>
                            <Text style={styles.profile_jobs}>{Lang_chg.txt_h_s_upload_sketch12[config.language]}</Text>
                            <TouchableOpacity onPress={() => { (this.state.house_sketch_img != null) ? this.setState({ image_path: config.img_url1 + this.state.house_sketch_img, imageModal: true }) : null }}>
                                {
                                    (this.state.house_sketch_img == null) && <Image resizeMode="cover" style={styles.housedeomo} source={require('./icons/banner_error.jpg')}></Image>
                                }
                                {
                                    (this.state.house_sketch_img != null) && <Image resizeMode="cover" style={styles.housedeomo} source={{ uri: config.img_url1 + this.state.house_sketch_img }}></Image>
                                }
                            </TouchableOpacity>

                        </View>

                        <View style={styles.pprovider_profille_boox}>
                            <Text style={styles.profile_jobs}>{Lang_chg.txt_h_s_upload_sketch[config.language]}</Text>
                            <TouchableOpacity onPress={() => { (this.state.provider_house_img != null) ? this.setState({ image_path: config.img_url1 + this.state.provider_house_img, imageModal: true }) : null }}>
                                {
                                    (this.state.provider_house_img == null) && <Image resizeMode="cover" style={styles.housedeomo} source={require('./icons/banner_error.jpg')}></Image>
                                }
                                {
                                    (this.state.provider_house_img != null) && <Image resizeMode="cover" style={styles.housedeomo} source={{ uri: config.img_url1 + this.state.provider_house_img }}></Image>
                                }
                            </TouchableOpacity>
                        </View>

                        {/*============================== covide report================== */}
                        {
                            (this.state.profile_data != 'NA') &&
                            <View>
                                <View style={styles.pprovider_profille_boox}>
                                    <Text style={styles.profile_jobs}> {Lang_chg.txt_uploade_covid_txt[config.language]}</Text>
                                    <TouchableOpacity onPress={() => { (this.state.profile_data.covid_result_img != null) ? this.setState({ image_path: config.img_url1 + this.state.profile_data.covid_result_img, imageModal: true }) : null }}>
                                        {
                                            (this.state.profile_data.covid_result_img == null) &&
                                            <Image resizeMode="cover" style={{ width: '100%', height: 250, borderRadius: 20, marginTop: 10, marginBottom: 20 }} source={require('./icons/banner_error.jpg')} />
                                        }
                                        {
                                            (this.state.profile_data.covid_result_img != null) &&
                                            <Image resizeMode="cover" style={{ width: '100%', height: 250, borderRadius: 20, marginTop: 10, marginBottom: 20 }} source={{ uri: config.img_url1 + this.state.profile_data.covid_result_img }} />
                                        }

                                    </TouchableOpacity>
                                </View>

                                <View style={styles.pprovider_profille_boox}>
                                    <Text style={styles.profile_jobs}>{Lang_chg.txt_myprofile_l_o_r[config.language]}</Text>
                                    <TouchableOpacity onPress={() => { (this.state.profile_data.recomadation_later_img != null) ? this.setState({ image_path: config.img_url1 + this.state.profile_data.recomadation_later_img, imageModal: true }) : null }}>
                                        {
                                            (this.state.profile_data.recomadation_later_img == null) &&
                                            <Image resizeMode="cover" style={{ width: '100%', height: 250, borderRadius: 20, marginTop: 10, marginBottom: 20 }} source={require('./icons/banner_error.jpg')} />
                                        }
                                        {
                                            (this.state.profile_data.recomadation_later_img != null) &&
                                            <Image resizeMode="cover" style={{ width: '100%', height: 250, borderRadius: 20, marginTop: 10, marginBottom: 20 }} source={{ uri: config.img_url1 + this.state.profile_data.recomadation_later_img }} />
                                        }
                                    </TouchableOpacity>
                                </View>


                                <View style={styles.pprofile_contact}>
                                    <Image resizeMode="cover" style={styles.pprofileuser} source={require('./icons/user.png')}></Image>
                                    <Text style={styles.contactnumber}>{this.state.profile_data.employer_name}</Text>
                                </View>
                                <View style={styles.pprofile_contact}>
                                    <Image resizeMode="cover" style={styles.pprofileuser} source={require('./icons/call.png')}></Image>
                                    <Text onPress={() => { null }} style={styles.contactnumber}>+ {config.phone_code} {this.state.profile_data.mobile_no}</Text>
                                </View>

                            </View>
                        }

                    </View>
                    {/*==============================end covide report================== */}
                </ScrollView>
                <Footer
                    activepage='My_profile_p'
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
