import React, { Component } from 'react'
import { Text, View, StatusBar, SafeAreaView, Image, TouchableOpacity, Linking, Modal, Dimensions, Alert } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileW, mobileH } from './Provider/utilslib/Utils';
import StarRating from 'react-native-star-rating';
const screenWidth = Dimensions.get('window').width;
const screenHeight = Dimensions.get('window').height;
import ImageZoom from 'react-native-image-pan-zoom';
import { ScrollView } from 'react-native';
export default class Other_profille extends Component {
    constructor(props) {
        super(props)
        this.state = {
            provider_id: this.props.route.params.provider_id,
            previous_page: this.props.route.params.previous_page,
            job_status: this.props.route.params.job_status,
            user_pro: 'NA',
            report_modal: false,
            imageModal: false,
            image_path: ""
        }
    }
    backpress = () => {
        this.props.navigation.goBack();
    }

    componentDidMount() {
        this.getUserProfile()
    }

    getUserProfile = async () => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        let url = config.baseURL + "other_user_profile.php?user_id_post=" + user_id_post + "&other_user_id=" + this.state.provider_id;
        consolepro.consolelog('other user url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Other user data', obj);
            if (obj.success == 'true') {
                this.setState({ user_pro: obj.user_data })
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

    callto = (mobile_no) => {
        if (mobile_no != '' && mobile_no != null && mobile_no != 'NA') {
            Linking.openURL(`tel:${mobile_no}`)
        }
    }

    confirmReport = async () => {

        Alert.alert(Lang_chg.Confirm[config.language], Lang_chg.msgRepotProviderConfirm[config.language], [
            {
                text: Lang_chg.cancel[config.language],
                onPress: () => { console.log('nothing') },
                style: "cancel"
            },
            { text: Lang_chg.Yes[config.language], onPress: () => { this.btnReportUser() } }
        ], { cancelable: false });
    }



    render() {
        var user_data = this.state.user_pro;

        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>

                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={{ paddingBottom: 70 }}>

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
                    <Modal
                        animationType="slide"
                        transparent={true}
                        visible={this.state.report_modal}
                        onRequestClose={() => { this.setState({ report_modal: false }) }}
                    >

                        <View style={{ flex: 1, backgroundColor: '#00000030', alignItems: 'center' }}>
                            <View style={{ position: 'absolute', bottom: 10, width: screenWidth, }}>
                                <View style={{ alignSelf: 'center', width: '94%', backgroundColor: "#ffffff", borderRadius: 20 }}>

                                    <TouchableOpacity style={{ width: '100%', alignSelf: 'center', justifyContent: 'center', alignItems: 'center', }} activeOpacity={0.9} onPress={() => { null }}>
                                        <View style={{ paddingVertical: screenWidth * 1.9 / 100 }}>
                                            <Text style={{ fontFamily: 'Poppins-Regular', textAlign: 'center', fontSize: screenWidth * 3 / 100, color: "#000" }}>{Lang_chg.txt_detail_job[config.language]}</Text>
                                        </View>
                                    </TouchableOpacity>
                                    <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 0.5, width: '100%' }}></View>

                                    <TouchableOpacity style={{ width: '100%', alignSelf: 'center', justifyContent: 'center', alignItems: 'center', }} activeOpacity={0.9} onPress={() => { this.setState({ report_modal: false }); this.props.navigation.navigate('Report_p', { other_user_id: this.state.provider_id }) }}>
                                        <View style={{ paddingVertical: screenWidth * 3.5 / 100 }}>
                                            <Text style={{ fontFamily: 'Poppins-Medium', textAlign: 'center', fontSize: screenWidth * 4 / 100, color: "#000" }}>{Lang_chg.txt_detail_job_rport1[config.language]}</Text>
                                        </View>
                                    </TouchableOpacity>
                                </View>
                                <View style={{ marginTop: 15, alignSelf: 'center', borderRadius: 20, backgroundColor: '#fff', width: '94%', justifyContent: 'center', alignItems: 'center', }}>
                                    <TouchableOpacity onPress={() => { this.setState({ report_modal: false }) }} style={{ alignSelf: 'center', width: '94%', alignItems: 'center', justifyContent: 'center', paddingVertical: screenWidth * 3.5 / 100 }}>
                                        <Text style={{ fontFamily: 'Poppins-Medium', fontSize: screenWidth * 4 / 100, color: "red" }}>{Lang_chg.cancelmedia[config.language]}</Text>
                                    </TouchableOpacity>
                                </View>
                            </View>
                        </View>
                    </Modal>


                    <View style={styles.banner_profileps}>
                        <View style={styles.other_profile_icon}>
                            <TouchableOpacity activeOpacity={1} onPress={() => { this.backpress() }}>
                                <Image style={styles.profile_edit_icon} resizeMode="contain" source={require('./icons/back3.png')}></Image>
                            </TouchableOpacity>
                            <TouchableOpacity activeOpacity={1} onPress={() => { this.setState({ report_modal: !this.state.report_modal }) }}>
                                {
                                    (user_data != 'NA') &&
                                    <Image style={styles.profile_edit_icon} resizeMode="contain" source={require('./icons/dot.png')}></Image>
                                }

                            </TouchableOpacity>
                        </View>
                        {
                            (user_data.image != 'NA') ?
                                <Image resizeMode="cover" style={styles.Profule_user_pic} source={{ uri: config.img_url2 + user_data.image }}></Image>
                                :
                                <Image style={styles.Profule_user_pic} resizeMode="cover" source={require('./icons/user_error.png')}></Image>
                        }
                    </View>


                    <View style={styles.profile_body_p}>



                        <Text style={styles.profile_name}>{user_data.name}</Text>
                        <TouchableOpacity style={styles.profile_reviewer} activeOpacity={1} onPress={() => {
                            this.props.navigation.navigate('Ratings', { user_id: this.state.provider_id })
                        }}>
                            <StarRating
                                emptyStar={require('./icons/star.png')}
                                fullStar={require('./icons/star_active.png')}
                                halfStar={require('./icons/half_star.png')}
                                maxStars={5}
                                rating={user_data.rating_avg}
                                reversed={false}
                                starSize={18}
                                containerStyle={{ width: '24%' }}
                                disabled={true}
                            />
                            <Text style={styles.profile_total_review}>{Lang_chg.txt_detail_job_Review[config.language]},({user_data.rating_count})</Text>
                        </TouchableOpacity>

                        <View style={{ width: "90%", alignSelf: 'center', marginTop: 15 }}>
                            <Text style={{
                                fontFamily: "Poppins-Bold", fontSize: 16, marginLeft: 5
                            }}>{Lang_chg.txt_phone_numer[config.language]} :  <Text numberOfLines={2} style={{ fontFamily: 'Poppins-Regular', fontSize: 16 }}>+593 {user_data.mobile}</Text></Text>
                        </View>
                        <View style={{ width: "90%", alignSelf: 'center', }}>
                            <Text style={{
                                fontFamily: "Poppins-Bold", fontSize: 16, marginLeft: 5
                            }}>{Lang_chg.txt_address[config.language]} :  <Text numberOfLines={2} style={{ fontFamily: 'Poppins-Regular', fontSize: 16 }}>{user_data.address}</Text></Text>
                        </View>
                        <View style={{ width: "90%", alignSelf: 'center', }}>
                            <Text style={{
                                fontFamily: "Poppins-Bold", fontSize: 16, marginLeft: 5
                            }}>{Lang_chg.txt_contact_txt_emeil[config.language]} :  <Text numberOfLines={2} style={{ fontFamily: 'Poppins-Regular', fontSize: 16 }}>{user_data.email}</Text></Text>
                        </View>
                        <View style={{ width: "90%", alignSelf: 'center', }}>
                            <Text style={{
                                fontFamily: "Poppins-Bold", fontSize: 16, marginLeft: 5
                            }}>{Lang_chg.txt_bio_txxt[config.language]} :  <Text numberOfLines={2} style={{ fontFamily: 'Poppins-Regular', fontSize: 16 }}>{user_data.bio}</Text></Text>
                        </View>





                        {/*============================== covide report================== */}
                        {
                            (user_data != 'NA') &&
                            <View style={{ marginTop: 10 }}>
                                <View style={styles.pprovider_profille_boox}>
                                    <Text style={styles.profile_jobs}> {Lang_chg.txt_uploade_covid_txt[config.language]}</Text>
                                    <TouchableOpacity onPress={() => { (user_data.covid_result_img != null) ? this.setState({ image_path: config.img_url1 + user_data.covid_result_img, imageModal: true }) : null }}>
                                        {
                                            (user_data.covid_result_img == null) &&
                                            <Image resizeMode="cover" style={{ width: '100%', height: 250, borderRadius: 20, marginTop: 10, marginBottom: 20 }} source={require('./icons/banner_error.jpg')} />
                                        }
                                        {
                                            (user_data.covid_result_img != null) &&
                                            <Image resizeMode="cover" style={{ width: '100%', height: 250, borderRadius: 20, marginTop: 10, marginBottom: 20 }} source={{ uri: config.img_url1 + user_data.covid_result_img }} />
                                        }

                                    </TouchableOpacity>
                                </View>

                                <View style={styles.pprovider_profille_boox}>
                                    <Text style={styles.profile_jobs}>{Lang_chg.txt_myprofile_l_o_r[config.language]}</Text>
                                    <TouchableOpacity onPress={() => { (user_data.recomadation_later_img != null) ? this.setState({ image_path: config.img_url1 + user_data.recomadation_later_img, imageModal: true }) : null }}>
                                        {
                                            (user_data.recomadation_later_img == null) &&
                                            <Image resizeMode="cover" style={{ width: '100%', height: 250, borderRadius: 20, marginTop: 10, marginBottom: 20 }} source={require('./icons/banner_error.jpg')} />
                                        }
                                        {
                                            (user_data.recomadation_later_img != null) &&
                                            <Image resizeMode="cover" style={{ width: '100%', height: 250, borderRadius: 20, marginTop: 10, marginBottom: 20 }} source={{ uri: config.img_url1 + user_data.recomadation_later_img }} />
                                        }
                                    </TouchableOpacity>
                                </View>

                                {
                                    // (this.state.previous_page != 'search_pro' && this.state.job_status != 3 && this.state.job_status != 2) &&
                                    // <View style={{ width: '100%', flexDirection: "row", alignItems: 'center', justifyContent: 'space-around' }}>
                                    //     <TouchableOpacity style={{
                                    //         backgroundColor: '#0088e0',
                                    //         alignItems: 'center',
                                    //         width: '90%',
                                    //         flexDirection: 'row',
                                    //         alignSelf: 'center',
                                    //         alignItems: 'center',
                                    //         justifyContent: 'center',
                                    //         height: 45, borderRadius: 20
                                    //     }}
                                    //         onPress={() => { this.props.navigation.navigate('Chat', { chatdata: { 'other_user_name': user_data.name, image: user_data.image, other_user_id: this.state.provider_id, 'blockstatus': 'no' } },) }}
                                    //     >
                                    //         <Image style={styles.otherprofilchat} resizeMode="contain" source={require('./icons/chat2.png')}></Image>
                                    //         <Text style={styles.calltn_other}>{Lang_chg.text_chat[config.language]}</Text>
                                    //     </TouchableOpacity>

                                    // </View>
                                }

                            </View>
                        }

                    </View>
                    {/*==============================end covide report================== */}
                </ScrollView>
            </View>
        )
    }
}
