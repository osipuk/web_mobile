import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, FlatList, Modal, TouchableOpacity, Image, ScrollView, Dimensions, TextInput, Linking, Alert, RefreshControl, Keyboard } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { WebView } from 'react-native-webview';
import Carousel from 'react-native-banner-carousel';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, notification } from './Provider/utilslib/Utils';
import StarRating from 'react-native-star-rating';
const BannerWidth = Dimensions.get('window').width;
const BannerHeight = Dimensions.get('window').height;
const screenWidth = Dimensions.get('window').width;
const screenHeight = Dimensions.get('window').height;
export default class Details_job_c extends Component {
    constructor(props) {
        super(props)
        this.state = {
            job_arr: 'NA',
            job_arr1: 'NA',
            job_id: this.props.route.params.job_id,
            job_details: 'NA',
            image_arr: '',
            service_arr: 'NA',
            saved_status: '',
            edit_delete_modal: false,
            final_amount: 0,
            already_payamt: 0,
            remaining_pay_amt: 0,
            final_amount_show: 'no',
            show_pay_btn_status: 'no',
            rating_popup: false,
            rating_popup: false,
            rating_count: 1,
            review: '',
            rating_avg: 0,
            webviewshow: false,
            payment_url: '',
            job_cancel_show: 'yes',
        }
    }

    backpress = () => {
        this.props.navigation.goBack();
    }

    componentDidMount() {
        this.props.navigation.addListener('focus', () => {
            this.getJobDetails()
        });
    }

    componentWillUnmount() {
        const { navigation } = this.props;
        navigation.removeListener('focus', () => {
            console.log('remove lister')
        });
    }

    getJobDetails = async (loding_type = 0) => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        let url = config.baseURL + "job_detail.php?user_id_post=" + user_id_post + "&job_id_post=" + this.state.job_id;
        consolepro.consolelog('muboking url', url);
        apifuntion.getApi(url, loding_type).then((obj) => {
            consolepro.consolelog('My Booking data', obj);
            if (obj.success == 'true') {
                var job_arr = obj.job_arr;
                var saved_status = obj.job_arr.saved_status;
                var service_arr = obj.service_arr;
                var image_arr = obj.image_arr;
                var total_time_spend = obj.total_time_spend;
                if (obj.final_amount_show == 'yes') {
                    var price = job_arr.price;
                    var final_amount = obj.final_amount;
                    if (parseFloat(final_amount) > parseFloat(price)) {
                        var remaining_pay_amt = parseFloat(final_amount) - parseFloat(price);
                        this.setState({ show_pay_btn_status: "yes", final_amount_show: 'yes', final_amount: final_amount, remaining_pay_amt: remaining_pay_amt, already_payamt: price })
                    }
                }

                this.setState({ job_details: job_arr, service_arr: service_arr, image_arr: image_arr, saved_status: saved_status, refresh: false, final_amount_show: obj.final_amount_show, final_amount: obj.final_amount, total_time_spend: total_time_spend, rating_avg: job_arr.provider_rating_avg, job_cancel_show: obj.job_cancel_show })
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
            console.log('err', err);
            if (err == "noNetwork") {
                this.setState({ refresh: false })
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                this.setState({ refresh: false })
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
        });
    }

    OpenMap = (address) => {
        if (address != null && address != 'NA') {
            // Linking.openURL('http://www.google.com/maps/place/' + lat, long)
            Linking.openURL('http://maps.google.com/?q=' + address)

        }
    }

    savedAddRemove = async (job_id) => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        let url = config.baseURL + "fav_add_remove.php?user_id_post=" + user_id_post + "&job_id=" + job_id;
        consolepro.consolelog('saved unsaved url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Saved unsaved data', obj);
            if (obj.success == 'true') {
                this.setState({ saved_status: obj.status });
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

    confirmDeleteJob = (job_id) => {
        Alert.alert(Lang_chg.Confirm[config.language], Lang_chg.msgdeleteJobCOnfirm[config.language], [
            {
                text: Lang_chg.cancel[config.language],
                onPress: () => { console.log('nothing') },
                style: "cancel"
            },
            { text: Lang_chg.Yes[config.language], onPress: () => { this.deleteJob(job_id) } }
        ], { cancelable: false });
        // config.checkUserDeactivate(navigation);
    }

    deleteJob = async (job_id) => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        let url = config.baseURL + "job_delete.php?user_id_post=" + user_id_post + "&job_id_post=" + job_id;
        consolepro.consolelog('job delete url', url);
        apifuntion.getApi(url).then((obj) => {
            setTimeout(() => {
                this.setState({ edit_delete_modal: false })
            }, 500);
            consolepro.consolelog('job delete data', obj);
            if (obj.success == 'true') {
                msgProvider.toast(obj.msg[config.language], 'center')
                this.props.navigation.navigate('My_booking');
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

    _onRefresh = () => {
        this.setState({ refresh: true })
        this.getJobDetails(1);
    }

    btnAddRatingReview = async () => {
        var job_id = this.state.job_id;
        var other_user_id = this.state.job_details.provider_id;
        var rating_count = this.state.rating_count;
        var review = this.state.review;
        if (review.length <= 0) {
            msgProvider.toast(Lang_chg.ratin_revie_empty[config.language], 'center')
            return false
        }

        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }


        let url = config.baseURL + 'rating_review_add.php?user_id_post=' + user_id_post + "&other_user_id=" + other_user_id + '&job_id_post=' + job_id + '&review=' + review + '&rating_count=' + rating_count;

        consolepro.consolelog('other user url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Other user data', obj);
            setTimeout(() => {
                this.setState({ rating_popup: false })
            }, 600);
            if (obj.success == 'true') {
                var provider_rating_avg = obj.provider_rating_avg;
                var provider_rating_count = obj.provider_rating_count;
                var job_arr = this.state.job_details;
                job_arr.rating_status = 'yes';
                job_arr.provider_rating_count = provider_rating_count;
                this.setState({ job_details: job_arr, rating_avg: provider_rating_avg })
                if (obj.notification_arr != 'NA') {
                    notification.oneSignalNotificationSendCall(obj.notification_arr)
                }
                msgProvider.toast(obj.msg[config.language], 'center')
                return false;
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

    btnPayNow = async (txt_id) => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        let txn_id = txt_id;
        let total_amount = this.state.final_amount;
        let job_id = this.state.job_id;


        var data = new FormData();
        data.append("user_id_post", user_id_post);
        data.append("total_amount", total_amount);
        data.append("job_id_post", job_id);
        data.append("txn_id", txn_id);
        console.log('payment done', data)
        var url = config.baseURL + 'job_payment_1.php';
        apifuntion.postApi(url, data).then((obj) => {
            console.log('payment done', obj)
            if (obj.success == 'true') {
                var job_arr = this.state.job_details;
                job_arr.status = 2;
                this.setState({ job_details: obj.job_arr })
                setTimeout(() => {
                    this.setState({ webviewshow: false });
                }, 900);
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


    }

    btnPayPalGetUrl = async () => {
        global_call_web_service = 0;
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        var currency = 'USD';
        if (userdata != null) {
            user_id_post = userdata.user_id
        }
        var payment_url = config.baseURL + "stripe_payment/payment_url.php?user_id=" + this.state.user_id_post + "&order_id=1&amount=" + this.state.final_amount + "&descriptor_suffix=Miksa&transfer_user_id=0&transfer_amount=0&check_flag=new_card";
        this.setState({
            payment_url: payment_url
        }, () => {
            setTimeout(() => {
                this.setState({ webviewshow: true })
            }, 1000);
        })

        return false;

        let url = config.baseURL + "paypal/paypal_payment_url.php?user_id=" + this.state.user_id_post + "&amount=" + this.state.final_amount + "&currency=" + currency;
        consolepro.consolelog('Paypal url get', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Paypal url data', obj);
            if (obj.success == 'true') {
                var data = obj.data;
                var links = data.links;
                var payment_url = links[1].href;
                var execute_url = links[2].href;
                this.setState({ payment_url: payment_url })
                setTimeout(() => {
                    this.setState({ webviewshow: true })
                }, 800);
            } else {
                if (obj.account_active_status == "deactivate") {
                    config.checkUserDeactivate(this.props.navigation);
                    return false;
                }
                msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                return false;
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
        var job_arr = this.state.job_details;
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />

                <Modal
                    animationType="slide"
                    transparent={true}
                    visible={this.state.edit_delete_modal}
                    onRequestClose={() => { this.setState({ edit_delete_modal: false }) }}
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
                                {
                                    (job_arr.status == 0) &&
                                    <View>
                                        <TouchableOpacity style={{ width: '100%', alignSelf: 'center', justifyContent: 'center', alignItems: 'center', }} activeOpacity={0.9} onPress={() => { this.setState({ edit_delete_modal: false }), this.props.navigation.navigate('Job_edit', { job_id: job_arr.job_id }) }}>
                                            <View style={{ paddingVertical: screenWidth * 3.5 / 100 }}>
                                                <Text style={{ fontFamily: 'Poppins-Medium', textAlign: 'center', fontSize: screenWidth * 4 / 100, color: "#000" }}>{Lang_chg.txt_detail_job_edit[config.language]}</Text>
                                            </View>
                                        </TouchableOpacity>
                                        <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 0.5, width: '100%' }}></View>
                                        <TouchableOpacity style={{ width: '100%', alignSelf: 'center', justifyContent: 'center', alignItems: 'center', }} activeOpacity={0.9} onPress={() => { this.confirmDeleteJob(job_arr.job_id) }}>
                                            <View style={{ paddingVertical: screenWidth * 3.5 / 100 }}>
                                                <Text style={{ fontFamily: 'Poppins-Medium', textAlign: 'center', fontSize: screenWidth * 4 / 100, color: "red" }}>{Lang_chg.txt_detail_job_Delete[config.language]}</Text>
                                            </View>
                                        </TouchableOpacity>
                                        <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 0.5, width: '100%' }}></View>
                                    </View>
                                }
                                <TouchableOpacity style={{ width: '100%', alignSelf: 'center', justifyContent: 'center', alignItems: 'center', }} activeOpacity={0.9} onPress={() => { this.setState({ edit_delete_modal: false }); this.props.navigation.navigate('Report_job', { job_id: job_arr.job_id }) }}>
                                    <View style={{ paddingVertical: screenWidth * 3.5 / 100 }}>
                                        <Text style={{ fontFamily: 'Poppins-Medium', textAlign: 'center', fontSize: screenWidth * 4 / 100, color: "red" }}>{Lang_chg.txt_detail_job_rport1[config.language]}</Text>
                                    </View>
                                </TouchableOpacity>
                                <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 0.5, width: '100%' }}></View>
                                {
                                    (this.state.job_cancel_show == 'yes' && job_arr.status == 1 || job_arr.status == 0 || job_arr.status == 4) &&
                                    <TouchableOpacity style={{ width: '100%', alignSelf: 'center', justifyContent: 'center', alignItems: 'center', }} activeOpacity={0.9} onPress={() => { this.setState({ edit_delete_modal: false }); this.props.navigation.navigate("Cancel_job", { job_id: job_arr.job_id }) }}>
                                        <View style={{ paddingVertical: screenWidth * 3.5 / 100 }}>
                                            <Text style={{ fontFamily: 'Poppins-Medium', textAlign: 'center', fontSize: screenWidth * 4 / 100, color: "red" }}>{Lang_chg.txt_detail_job_Cancel[config.language]}</Text>
                                        </View>
                                    </TouchableOpacity>
                                }

                            </View>
                            <View style={{ marginTop: 15, alignSelf: 'center', borderRadius: 20, backgroundColor: '#fff', width: '94%', justifyContent: 'center', alignItems: 'center', }}>
                                <TouchableOpacity onPress={() => { this.setState({ edit_delete_modal: false }) }} style={{ alignSelf: 'center', width: '94%', alignItems: 'center', justifyContent: 'center', paddingVertical: screenWidth * 3.5 / 100 }}>
                                    <Text style={{ fontFamily: 'Poppins-Medium', fontSize: screenWidth * 4 / 100, color: "red" }}>{Lang_chg.cancelmedia[config.language]}</Text>
                                </TouchableOpacity>
                            </View>
                        </View>
                    </View>
                </Modal>

                <Modal
                    animationType="slide"
                    transparent
                    visible={this.state.rating_popup}
                    onRequestClose={() => {
                        this.setState({ rating_popup: false })
                    }}>
                    <SafeAreaView style={{ flex: 1 }}>
                        <TouchableOpacity
                            activeOpacity={1}
                            onPress={() => { Keyboard.dismiss() }}
                            style={{
                                flex: 1,
                                backgroundColor: '#00000090',
                                alignItems: 'center',
                                justifyContent: 'center',
                                borderRadius: 0,
                            }}>
                            {/* <View style={styles.detail_job_top}>
                                <TouchableOpacity onPress={() => { this.setState({ rating_popup: false }) }} activeOpacity={1}>
                                    <Image style={styles.detail_pending_back_icons} resizeMode="contain" source={require('./icons/back3.png')}></Image>
                                </TouchableOpacity>
                                <TouchableOpacity onPress={() => this.setState({ edit_delete_modal: true })}>

                                </TouchableOpacity>
                            </View> */}
                            <View style={{ backgroundColor: color1.theme_app, width: '90%', borderRadius: 15, }}>
                                <View style={{ alignSelf: 'center', }}>
                                    <Text style={styles.reviwtitle_popup}>{Lang_chg.txt_detail_job_rating_review[config.language]}</Text>
                                    <StarRating
                                        disabled={false}
                                        emptyStar={require('./icons/star.png')}
                                        fullStar={require('./icons/star_active.png')}
                                        // halfStar={require('./icons/half_star.png')}
                                        maxStars={5}
                                        rating={this.state.rating_count}
                                        reversed={false}
                                        starSize={35}
                                        selectedStar={(rating) => { this.setState({ rating_count: rating }) }}

                                    />

                                </View>
                                <View style={{ width: '90%', alignSelf: 'center', marginTop: 10 }}>
                                    <View style={{ flexDirection: 'row', alignItems: 'center', borderBottomWidth: 1, borderColor: '#ccc', borderRadius: 20, paddingLeft: 20, paddingRight: 20 }}>
                                        <View style={styles.contact_Left}>
                                            <Image resizeMode="contain" style={styles.contact_msgicon} source={require('./icons/edit.png')}></Image>
                                        </View>
                                        <View style={styles.contact_right}>
                                            <TextInput
                                                style={[styles.txtinput, { height: 120, textAlignVertical: 'top', fontSize: 18, color: '#868484' }]}
                                                multiline={true}
                                                placeholder={Lang_chg.txt_detail_job_Review[config.language]}
                                                placeholderTextColor="#868484"
                                                onChangeText={(txt) => { this.setState({ review: txt }) }}
                                                maxLength={250}
                                                returnKeyLabel='done'
                                                returnKeyType='done'
                                                ref={(input) => { this.textinput = input; }}
                                                onSubmitEditing={() => { Keyboard.dismiss() }}
                                            />
                                        </View>
                                    </View>

                                </View>
                                <View style={{ alignItems: 'center', justifyContent: 'center', width: '80%', alignSelf: 'center', marginTop: 10 }}>
                                    <TouchableOpacity style={{ width: '100%', backgroundColor: '#42a7e8', height: 45, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginTop: 30, }} activeOpacity={0.9} onPress={() => {
                                        this.btnAddRatingReview()
                                    }} >
                                        <Text style={styles.btn_txt}>{Lang_chg.txt_detail_job_submit[config.language]}</Text>
                                    </TouchableOpacity>
                                </View>
                                <View style={{ alignItems: 'center', justifyContent: 'center', width: '80%', alignSelf: 'center', marginBottom: 20 }}>
                                    <TouchableOpacity onPress={() => { this.setState({ rating_popup: false }) }} style={{ width: '100%', backgroundColor: '#42a7e8', height: 45, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginTop: 20, marginBottom: 20 }} activeOpacity={0.9}>
                                        <Text style={styles.btn_txt}>{Lang_chg.chatcancel[config.language]}</Text>
                                    </TouchableOpacity>
                                </View>
                            </View>
                        </TouchableOpacity>
                    </SafeAreaView>
                </Modal>
                <ScrollView showsVerticalScrollIndicator={false} refreshControl={
                    <RefreshControl
                        refreshing={this.state.refresh}
                        onRefresh={this._onRefresh}
                    />
                }>

                    <View style={styles.detail_job_top}>
                        <TouchableOpacity onPress={() => { this.backpress() }} activeOpacity={1}>
                            <Image style={styles.detail_pending_back_icons} resizeMode="contain" source={require('./icons/back3.png')}></Image>
                        </TouchableOpacity>
                        {
                            (this.state.job_details != 'NA') &&
                            <TouchableOpacity onPress={() => this.setState({ edit_delete_modal: true })}>
                                {
                                    <Image style={styles.detail_pending_dot} resizeMode="contain" source={require('./icons/dot.png')}></Image>
                                }
                            </TouchableOpacity>
                        }
                    </View>

                    {
                        (this.state.image_arr != '') &&
                        <View>
                            {
                                (this.state.image_arr == 'NA') ? <Image source={require('./icons/banner_error.jpg')} style={{ width: BannerWidth, height: BannerHeight * 55 / 100 }} />
                                    :
                                    <Carousel
                                        autoplay
                                        style={{ borderRadius: 90 }}
                                        autoplayTimeout={5000}
                                        loop
                                        index={0}
                                        pageIndicatorStyle={{ backgroundColor: '#cceef6', bottom: 50 }}
                                        activePageIndicatorStyle={{ color: '#01a8e7', backgroundColor: '#01a8e7', bottom: 50 }}
                                        pageSize={BannerWidth * 100 / 100}>
                                        {this.state.image_arr.map((item, index) => {
                                            return (
                                                <Image source={{ uri: config.img_url2 + item.image }} style={{ width: BannerWidth, height: BannerHeight * 55 / 100 }} />
                                            )
                                        })}
                                    </Carousel>
                            }
                        </View>
                    }

                    <View>
                        {
                            (job_arr.status == 0) && <View style={styles.pendingiew}>
                                <Text style={styles.statusText}>{Lang_chg.txt_status_pending[config.language]}</Text>
                            </View>
                        }
                        {
                            (job_arr.status == 1) && <View style={styles.pendingiewinpprogrss}>
                                <Text style={styles.statusText}>{Lang_chg.txt_status_Inprogress[config.language]}</Text>
                            </View>
                        }
                        {
                            (job_arr.status == 2) && <View style={styles.pendingiewcomleed}>
                                <Text style={styles.statusText}>{Lang_chg.txt_status_Completed[config.language]}</Text>
                            </View>
                        }
                        {
                            (job_arr.status == 3) && <View style={styles.pendingiewcancel}>
                                <Text style={styles.statusText}>{Lang_chg.txt_status_Cancelled[config.language]}</Text>
                            </View>
                        }
                        {
                            (job_arr.status == 5) && <View style={styles.pendingiewcancel}>
                                <Text style={styles.statusText}>{Lang_chg.txt_status_rejected[config.language]}</Text>
                            </View>
                        }
                        {
                            (job_arr.status == 4) && <View style={styles.acceptediew}>
                                <Text style={styles.statusText}>{Lang_chg.txt_status_accepted[config.language]}</Text>
                            </View>
                        }

                    </View>
                    {
                        (this.state.job_details != "NA") &&
                        <View style={styles.detail_bodyjob}>
                            <View style={{ width: '90%', alignSelf: 'center' }}>
                                <View style={{ justifyContent: 'flex-end', position: 'absolute', right: 0, }}>

                                    {
                                        this.state.saved_status == 0 ?
                                            <TouchableOpacity style={[styles.booking_favorite, { paddingHorizontal: 5 }]} onPress={() => { this.savedAddRemove(job_arr.job_id) }}>
                                                <Image style={{ width: 30, height: 30, alignSelf: "flex-end", marginTop: 0 }} resizeMode="contain" source={require('./icons/saved.png')}></Image>
                                            </TouchableOpacity>
                                            :
                                            <TouchableOpacity style={[styles.booking_favorite, { paddingHorizontal: 5 }]} onPress={() => { this.savedAddRemove(job_arr.job_id) }}>
                                                <Image style={{ width: 28, height: 30, alignSelf: "flex-end", tintColor: "#706b6c", marginTop: 0 }} resizeMode="contain" source={require('./icons/saved1.png')}></Image>
                                            </TouchableOpacity>
                                    }
                                </View>
                                <View style={styles.house_cleat_section}>
                                    <Text style={styles.housecleantxt}>{job_arr.titile}</Text>
                                    {/* <Text style={styles.housecleanhhours}>Per Hours: $8</Text> */}
                                </View>
                                <View>
                                    <Text style={styles.job_detailid}>{Lang_chg.txt_detail_job_id[config.language]}:  <Text numberOfLines={2} style={[styles.detail_location, { width: '95%' }]}>{job_arr.job_number}</Text></Text>
                                </View>
                                <View>
                                    <Text style={styles.job_detailid}>{Lang_chg.txt_c_landmark_txt[config.language]}:  <Text numberOfLines={2} style={[styles.detail_location, {
                                        width: '95%', fontFamily: "Poppins-Regular", fontSize: 13
                                    }]}>{job_arr.landmark}</Text></Text>
                                </View>


                                <TouchableOpacity onPress={() => { this.OpenMap(job_arr.location_address) }} style={styles.detail_locatsion}>
                                    <Image style={[styles.detail_locationimg, { marginTop: 1 }]} resizeMode="contain" source={require('./icons/location_red.png')}></Image>
                                    <Text numberOfLines={2} style={[styles.detail_location, { width: '95%' }]}>{job_arr.location_address}</Text>
                                </TouchableOpacity>


                                <View style={[styles.create_covid_about, { backgroundColor: color1.covidbg, marginTop: 10 }]}>
                                    <Text style={styles.create_about_txt}>
                                        {Lang_chg.txt_covide_12[config.language]}
                                    </Text>
                                </View>
                                <View style={styles.detailexpire}>
                                    <Text style={styles.detail_service}>{Lang_chg.txt_detail_job_Provider_Detail[config.language]}</Text>
                                </View>

                                <TouchableOpacity activeOpacity={1} style={styles.detail_ratinngbox} onPress={() => { this.props.navigation.navigate('Other_profile', { provider_id: job_arr.provider_id, previous_page: 'detail_page', job_status: job_arr.status }) }}>
                                    <View style={styles.detail_jobuser}>
                                        {
                                            (job_arr.provider_image != 'NA') ?
                                                <Image resizeMode="cover" style={styles.rewiew_people_img} source={{ uri: config.img_url + job_arr.provider_image }}></Image>
                                                :
                                                <Image resizeMode="cover" style={styles.rewiew_people_img} source={require('./icons/user_error.png')}></Image>
                                        }

                                    </View>
                                    <View style={styles.detail_name_user}>
                                        <Text style={styles.detail_name_user_txt}>{job_arr.provider_name}</Text>
                                        <View style={{ flexDirection: 'row', alignItems: 'center' }}>
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
                                            <Text style={styles.profile_total_review}>{Lang_chg.txt_rating_revie_txt12[config.language]},({job_arr.provider_rating_count})</Text>
                                        </View>
                                    </View>
                                    {
                                        (job_arr.status == 1 || job_arr.status == 4) &&
                                        <TouchableOpacity style={{ width: '30%', justifyContent: 'center', alignItems: 'center' }} onPress={() => {
                                            (job_arr.status != 2 && job_arr.status != 3) ?
                                                this.props.navigation.navigate('Chat', { chatdata: { 'other_user_name': job_arr.provider_name, image: job_arr.provider_image, other_user_id: job_arr.provider_id, 'blockstatus': 'no' } },)
                                                : null
                                        }}>
                                            <Image resizeMode="cover" style={styles.jobchat} source={require('./icons/chat_pending.png')}></Image>
                                            {/* <Text style={styles.userjobtimme}>1 mint ago</Text> */}
                                        </TouchableOpacity>
                                    }
                                </TouchableOpacity>

                                <View style={[styles.detailexpire, { marginBottom: 20, marginTop: 20, }]}>
                                    <Text style={styles.detail_service}>{Lang_chg.txt_detail_job_Services[config.language]}</Text>
                                </View>


                                <FlatList
                                    showsVerticalScrollIndicator={false}
                                    contentContainerStyle={{ borderColor: '#b5b5b5', borderTopWidth: 0.5 }}
                                    data={this.state.service_arr}
                                    renderItem={({ item, index }) => {
                                        return (
                                            <View style={{ borderBottomWidth: 0.5, borderColor: '#b5b5b5', paddingVertical: 4 }}>
                                                <View style={{
                                                    flexDirection: 'row', alignItems: 'center', paddingTop: 5,
                                                }}>
                                                    <View style={{ width: '60%', flexDirection: 'row', alignItems: 'center' }}>
                                                        {
                                                            (item.service_image == 'NA') ? <Image resizeMode="cover" style={{ width: 40, height: 40, resizeMode: 'cover', borderRadius: 20 }} source={require('./icons/user_error.png')}></Image>
                                                                : <Image style={{ width: 40, height: 40, resizeMode: 'cover', borderRadius: 20 }} source={{ uri: config.img_url + item.service_image }}></Image>
                                                        }
                                                        <View style={{ flexDirection: "column", marginLeft: 10 }}>
                                                            <Text style={{ fontFamily: "Poppins-Bold", fontSize: 14 }}>{item.service_name}</Text>
                                                            {(job_arr.show_start_end_job_btn != 'no') && <Text style={{ color: '#777', fontFamily: "Poppins-SemiBold", fontSize: 12, marginTop: -2 }}>{config.currency} {item.job_price}/hr</Text>}
                                                        </View>
                                                    </View>
                                                </View>
                                                {
                                                    (item.job_avail_arr != 'NA') &&
                                                    item.job_avail_arr.map((item1, index1) => (
                                                        <View>
                                                            <View style={{
                                                                flexDirection: 'row',
                                                                paddingBottom: 5,
                                                                marginTop: 5,
                                                                width: '100%',
                                                                alignItems: 'center'
                                                            }}>
                                                                <View style={{ flexDirection: 'row', alignItems: 'center', width: '50%' }}>
                                                                    <Image style={{ width: 12, height: 12 }} resizeMode="contain" source={require('./icons/calender.png')}></Image>
                                                                    <Text style={{ fontFamily: "Poppins-Regular", fontSize: 12, marginLeft: 20, }}>{item1.job_avail_date_time}</Text>
                                                                </View>
                                                                {
                                                                    (item1.status == 0) &&
                                                                    <View style={{ width: '50%', alignItems: 'flex-end', justifyContent: 'flex-end' }}>
                                                                        <Text style={{ color: '#ff9900', fontSize: 11 }}>{Lang_chg.txt_status_pending[config.language]}</Text>
                                                                    </View>
                                                                }
                                                                {/*====================================================================== start button=================================================== */}
                                                                {
                                                                    (item1.status == 1) &&
                                                                    <View style={{ width: '50%', alignItems: 'flex-end', justifyContent: 'flex-end' }}>
                                                                        <Text style={{ color: 'green', fontSize: 11 }}>{Lang_chg.txt_status_accepted[config.language]}</Text>
                                                                    </View>
                                                                }
                                                                {/*==========================================================end start button============================================================== */}
                                                                {/* =====================rejected job================================ */}
                                                                {
                                                                    (item1.status == 2) &&
                                                                    <View style={{ width: '50%', alignItems: 'flex-end', justifyContent: 'flex-end' }}>
                                                                        <Text style={{ color: 'red', fontSize: 11 }}>{Lang_chg.txt_detail_job_rejectedd[config.language]}</Text>
                                                                    </View>

                                                                }
                                                                {/* =====================end rejected job================================ */}

                                                                {/* ============================end job btn=============================================================================================== */}

                                                                {
                                                                    (item1.status == 3) &&
                                                                    <View style={{ width: '50%', alignItems: 'flex-end', justifyContent: 'flex-end' }}>
                                                                        <Text style={{ color: '#22bbeb' }}>{Lang_chg.txt_detail_job_Started[config.language]}  <Text style={{ color: '#666' }}>{item1.final_time.toString()} </Text></Text>
                                                                    </View>

                                                                }
                                                                {/* ============================end end job btn===================================================================================*/}
                                                                {/* ============================end end job btn===================================================================================*/}
                                                                {
                                                                    (item1.status == 4) &&
                                                                    <View style={{ width: '50%', alignItems: 'flex-end', justifyContent: 'flex-end' }}>
                                                                        <Text style={{ color: '#0088e0', fontSize: 11 }}>{Lang_chg.txt_detail_job_End_j[config.language]}:<Text style={{ color: '#666' }}>{item1.final_time} </Text></Text>
                                                                    </View>
                                                                }
                                                            </View>
                                                        </View>
                                                    ))
                                                }
                                            </View>
                                        )
                                    }}
                                />


                                <View style={{ marginBottom: 30, marginTop: 20 }}>
                                    {
                                        (job_arr.status == 2) &&
                                        <View>
                                            <View style={{ flexDirection: 'row', justifyContent: 'space-between', borderColor: '#757575', borderBottomWidth: 1, marginTop: 20, borderTopWidth: 1, marginBottom: 25, paddingVertical: 10, alignItems: 'center' }}>
                                                <Text style={styles.paymmenttitlel}>{Lang_chg.txt_detail_job_Payment_Detail[config.language]}</Text>
                                                <Text style={styles.teacher_price}>{job_arr.updatetime}</Text>
                                            </View>

                                            <View style={{ marginBottom: 10 }}>
                                                <Text style={styles.jobdetailid}>{Lang_chg.txt_detail_job_id[config.language]}  :  {job_arr.job_number}</Text>
                                                <Text style={styles.jobdetailid}>{Lang_chg.txt_detail_job_txn_id[config.language]} :  {job_arr.txn_id}</Text>
                                                {
                                                    (job_arr.last_txn_id != null) &&
                                                    <Text style={styles.jobdetailid}>{Lang_chg.txt_detail_job_last_txn_id[config.language]} :  {job_arr.last_txn_id}</Text>
                                                }

                                            </View>
                                        </View>
                                    }
                                    {
                                        // (parseInt(job_arr.isd_perc) > 0) && <>
                                        //     <Text style={styles.detail_priice_total}>{Lang_chg.txt_total_service_amt[config.language]} <Text style={{ color: '#666' }}>: {config.currency} {job_arr.price}</Text></Text>

                                        //     <Text style={styles.detail_priice_total}>{Lang_chg.txt_tax_isd[config.language]}({job_arr.isd_perc}%) <Text style={{ color: '#666' }}>: {config.currency} {job_arr.txt_isd_amt}</Text></Text>
                                        // </>
                                    }

                                    <Text style={styles.detail_priice_total}>{Lang_chg.txt_detail_job_totla[config.language]} <Text style={{ color: '#666' }}>: {config.currency} {job_arr.tot_amount}</Text></Text>
                                    {/* {
                                        (this.state.show_pay_btn_status == 'yes') &&
                                        <View>
                                            <Text style={styles.jobdetailid}><Text style={styles.jobboldleft}>{Lang_chg.txt_detail_job_last_Total_Hours[config.language]} :</Text> {this.state.total_time_spend} </Text>

                                            <Text style={styles.detail_priice_total}>{Lang_chg.txt_detail_job_totla[config.language]}<Text style={{ color: '#666' }}>: {config.currency} {this.state.final_amount}</Text></Text>

                                            <Text style={styles.detail_priice_total}>{Lang_chg.txt_detail_job_last_already_Total_Hours[config.language]}<Text style={{ color: '#666' }}>: {config.currency} {this.state.already_payamt}</Text></Text>

                                            <Text style={styles.detail_priice_total}>{Lang_chg.txt_detail_job_Pay_Amounts[config.language]}
                                                <Text style={{ color: '#666' }}>: {config.currency} {this.state.remaining_pay_amt}</Text></Text>

                                        </View>
                                    }
                                    {
                                        (this.state.show_pay_btn_status == 'no') &&
                                        <View>
                                            {
                                                (job_arr.status == 2) ?
                                                    <View>
                                                        <Text style={styles.jobdetailid}><Text style={styles.jobboldleft}>{Lang_chg.txt_detail_job_last_Total_Hours[config.language]} :</Text> {this.state.total_time_spend} </Text>
                                                        <Text style={styles.detail_priice_total}>{Lang_chg.txt_detail_job_totla[config.language]}<Text style={{ color: '#666' }}>: {config.currency} {this.state.final_amount}</Text></Text>
                                                    </View>
                                                    :
                                                    <Text style={styles.detail_priice_total}>{Lang_chg.txt_detail_job_totla[config.language]} <Text style={{ color: '#666' }}>:{config.currency} {job_arr.price}</Text></Text>
                                            }
                                        </View>
                                    } */}

                                    {
                                        // (job_arr.mark_complete_status == 1 && job_arr.status != 2) && <View style={styles.login_btn, { marginTop: 15, width: '100%', margin: 10, }}>
                                        //     <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnPayPalGetUrl() }}>
                                        //         <Text style={styles.btn_txt}>{Lang_chg.txt_detail_job_Pay_Now[config.language]}</Text>
                                        //     </TouchableOpacity>
                                        // </View>
                                    }

                                    {
                                        (job_arr.status == 2 && job_arr.rating_status == 'no') && <View style={[styles.login_btn, { marginTop: 15, width: '100%', margin: 9, }]}>
                                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.setState({ rating_popup: true }); }}>
                                                <Text style={styles.btn_txt}>{Lang_chg.txt_detail_job_ratee_now[config.language]}</Text>
                                            </TouchableOpacity>
                                        </View>
                                    }
                                </View>
                            </View>
                        </View>
                    }
                </ScrollView>

                <Modal animationType="slide" transparent visible={this.state.webviewshow}
                    onRequestClose={() => {
                        this.setState({ webviewshow: false })
                    }}>
                    <View style={{ flex: 1 }}>
                        <SafeAreaView style={{ flex: 0, backgroundColor: color1.theme_color }} />

                        <StatusBar barStyle='light-content' backgroundColor={color1.theme_color} hidden={false} translucent={false}
                            networkActivityIndicatorVisible={true} />
                        <View style={[styles.headerContainer, { paddingHorizontal: 20 }]}>
                            <View style={{ flex: 1, justifyContent: "center" }}>
                                <TouchableOpacity style={{ flexDirection: "row", alignItems: "center" }}
                                    onPress={() => { this.setState({ webviewshow: false }) }}
                                >
                                    <Image style={{ width: 20, height: 20, marginLeft: 5 }}
                                        source={require('./icons/back2.png')}
                                        resizeMode="contain"
                                    />
                                </TouchableOpacity>
                            </View>
                            <View style={{ flex: 2, justifyContent: "center", }}>
                                <Text style={{ textAlign: "center", fontFamily: "Poppins-Bold", color: "#fff" }}></Text>
                            </View>
                            <View style={{ flex: 1, alignItems: 'flex-end', justifyContent: 'center' }}>
                                {/* <Image style={{ width: 20, height: 20, marginLeft: 5 }}
                            source={require('./icons/Menu_ic.png')}
                            resizeMode="contain"
                        /> */}
                            </View>
                        </View>
                        <View style={{ flex: 1, backgroundColor: 'white' }}>
                            <Text style={{ alignSelf: 'center', color: 'red', textAlign: 'center', fontFamily: 'Poppins-Medium', marginTop: 15 }}>{Lang_chg.txtpaymentpr[config.language]}</Text>
                            {
                                this.state.webviewshow == true &&
                                <WebView
                                    source={{ uri: this.state.payment_url }}
                                    onNavigationStateChange={this._onNavigationStateChange.bind(this)}
                                    javaScriptEnabled={true}
                                    domStorageEnabled={true}
                                    // injectedJavaScript = {this.state.cookie}
                                    startInLoadingState={false}
                                    containerStyle={{ marginTop: 20, flex: 1 }}
                                    // injectedJavaScript={runFirst}
                                    // androidHardwareAccelerationDisabled={true}
                                    // allowUniversalAccessFromFileURLs={true}
                                    // allowingReadAccessToURL={true}
                                    // keyboardDisplayRequiresUserAction={false}
                                    // allowFileAccess={true}
                                    textZoom={100}
                                // onMessage={this.onMessage}
                                // onNavigationStateChange={(navEvent)=> console.log(navEvent.jsEvaluationValue)}
                                // onMessage={(event)=> console.log(event.nativeEvent.data)}
                                />
                            }
                        </View>
                    </View>
                </Modal>


            </View>
        )
    }





    _onNavigationStateChange(webViewState) {
        webViewState.canGoBack = false
        if (webViewState.loading == false) {
            console.log('webViewState', webViewState);
            console.log(webViewState.url)
            var t = webViewState.url.split('/').pop().split('?')[0]
            if (typeof (t) != null) {
                var p = webViewState.url.split('?').pop().split('&')
                console.log('file name', t);
                if (t == 'payment_success_final.php') {
                    var payment_id = 0;
                    var payment_date = '';
                    var payment_time = '';
                    console.log('p.length', p.length);
                    for (var i = 0; i < p.length; i++) {
                        var val = p[i].split('=');
                        console.log('val', val);
                        if (val[0] == 'payment_id') {
                            payment_id = val[1]
                        }
                        if (global_call_web_service == 0) {
                            this.btnPayNow(payment_id);
                        }
                        global_call_web_service = 1;
                        return false;
                    }
                } else if (t == 'paypal_cancel.php') {
                    msgProvider.toast("Payment Cancel", 'center');
                    return false;
                }
            }
        }
    }
}
