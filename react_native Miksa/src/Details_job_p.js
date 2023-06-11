import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, FlatList, Modal, TouchableOpacity, Image, ScrollView, Dimensions, TextInput, Linking, Alert, RefreshControl, Keyboard } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import Carousel from 'react-native-banner-carousel';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileH, mobileW, notification } from './Provider/utilslib/Utils';
import StarRating from 'react-native-star-rating';

const BannerWidth = Dimensions.get('window').width;
const BannerHeight = Dimensions.get('window').height;
const screenWidth = Dimensions.get('window').width;
const screenHeight = Dimensions.get('window').height;


export default class Details_job_p extends Component {
    constructor(props) {
        super(props)
        this.state = {
            job_arr: 'NA',
            job_arr1: 'NA',
            job_id: this.props.route.params.job_id,
            customer_id: 0,
            job_details: 'NA',
            image_arr: '',
            service_arr: 'NA',
            saved_status: '',
            webviewshow: false,
            payment_url: '',
            edit_delete_modal: false,
            refresh: false,
            final_amount: 0,
            final_amount_show: 'no',
            total_time_spend: "00:00:00",
            rating_popup: false,
            rating_count: 1,
            review: '',
            job_avail_arr: 'NA',
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

        let url = config.baseURL + "job_details_p.php?user_id_post=" + user_id_post + "&job_id_post=" + this.state.job_id;
        consolepro.consolelog('Provider Detail page url', url);
        apifuntion.getApi(url, loding_type).then((obj) => {
            consolepro.consolelog('Provider Detail page ', obj);
            if (obj.success == 'true') {

                var job_arr = obj.job_arr;

                var saved_status = obj.job_arr.saved_status;
                var service_arr = obj.service_arr;
                var image_arr = obj.image_arr;
                this.setState({ job_details: job_arr, service_arr: service_arr, image_arr: image_arr, saved_status: saved_status, refresh: false, final_amount_show: obj.final_amount_show, final_amount: obj.final_amount, total_time_spend: obj.total_time_spend, job_avail_arr: obj.job_avail_arr })
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

    _onRefresh = () => {
        this.setState({ refresh: true })
        this.getJobDetails(1);
    }

    confirmationEndStart = (job_available_id, job_id, index, type) => {
        if (type == 'end') {
            Alert.alert(Lang_chg.Confirm[config.language], Lang_chg.msgAcceptEndService[config.language], [
                {
                    text: Lang_chg.cancel[config.language],
                    onPress: () => { console.log('nothing') },
                    style: "cancel"
                },
                { text: Lang_chg.Yes[config.language], onPress: () => { this.startEndJob(job_available_id, job_id, index, type) } }
            ], { cancelable: false });
        } else {
            this.startEndJob(job_available_id, job_id, index, type)
        }
    }

    startEndJob = async (job_available_id, job_id, index, type) => {
        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }

        let url = config.baseURL + "job_end_start.php?user_id_post=" + user_id_post + "&job_available_id=" + job_available_id + '&job_id=' + job_id + '&action_type=' + type;
        consolepro.consolelog('Job accept reject page url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Job accept reject page ', obj);
            if (obj.success == 'true') {
                var job_arr = obj.job_arr;
                if (obj.service_arr != 'NA') {
                    this.setState({ service_arr: obj.service_arr, job_details: job_arr, final_amount_show: obj.final_amount_show, final_amount: obj.final_amount, total_time_spend: obj.total_time_spend })
                }

                if (job_arr.mark_complete_status == 0 && obj.final_amount_show == 'yes') {
                    if (config.device_type == 'android') {
                        this.paymentAmount('na', 'na', obj.second_time_pay_amount, 'final_payment')
                    } else {
                        setTimeout(() => {
                            this.paymentAmount('na', 'na', obj.second_time_pay_amount, 'final_payment')
                        }, 550);
                    }
                }

                if (job_arr.mark_complete_status == 1) {
                    this.props.navigation.navigate('Job_complete', {
                        job_number: job_arr.job_number
                    });
                }
                if (obj.notification_arr != 'NA') {
                    notification.oneSignalNotificationSendCall(obj.notification_arr)
                }
            } else {
                setTimeout(() => {
                    if (obj.account_active_status == "deactivate") {
                        config.checkUserDeactivate(this.props.navigation);
                        return false;
                    }
                }, 600);

                if (config.device_type == 'ios') {
                    setTimeout(() => {
                        msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                    }, 600);
                } else {
                    msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
                }
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

    // reportuser=====================546=========================36534==========================
    btnReportUser = async () => {

        let userdata = await localStorage.getItemObject('user_arr')
        let user_id_post = 0
        if (userdata != null) {
            user_id_post = userdata.user_id
        }
        let customer_id = this.state.job_details.customer_id;
        let url = config.baseURL + "user_report_submit.php?user_id=" + user_id_post + "&other_user_id=" + customer_id;
        consolepro.consolelog('other user url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Other user data', obj);
            if (obj.success == 'true') {
                setTimeout(() => {
                    this.setState({ edit_delete_modal: false })
                }, 500);
                msgProvider.toast(obj.msg[config.language], 'center')
            } else {
                setTimeout(() => {
                    this.setState({ edit_delete_modal: false })
                }, 500);
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
            setTimeout(() => {
                this.setState({ edit_delete_modal: false })
            }, 500);
            console.log('err', err);
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
        });
    }

    btnAddRatingReview = async () => {
        var job_id = this.state.job_id;
        var other_user_id = this.state.job_details.customer_id;
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
            setTimeout(() => {
                this.setState({ rating_popup: false })
            }, 600);
            consolepro.consolelog('Other user data', obj);
            if (obj.success == 'true') {
                if (obj.notification_arr != 'NA') {
                    notification.oneSignalNotificationSendCall(obj.notification_arr)
                }
                // 'provider_rating_avg'=>$provider_rating_avg,'provider_rating_count'=>$provider_rating_count
                var provider_rating_avg = obj.provider_rating_avg;
                var provider_rating_count = obj.provider_rating_count;
                var job_arr = this.state.job_details;
                job_arr.customer_rating_avg = provider_rating_avg;
                job_arr.customer_rating_count = provider_rating_count;
                job_arr.rating_status = 'yes';
                this.setState({ job_details: job_arr })
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
                var job_arr = this.state.job_details;
                if (type == 'reject') {
                    job_arr.status = 3;
                } else {
                    job_arr.status = 4;
                }
                this.setState({ job_details: job_arr })
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
    // confirmCanceJob = (job_id) => {
    //     Alert.alert(Lang_chg.Confirm[config.language], Lang_chg.msgcacelJobCOnfirm[config.language], [
    //         {
    //             text: Lang_chg.cancel[config.language],
    //             onPress: () => { console.log('nothing') },
    //             style: "cancel"
    //         },
    //         { text: Lang_chg.Yes[config.language], onPress: () => { this.btnCancelJob(job_id) } }
    //     ], { cancelable: false });
    //     // config.checkUserDeactivate(navigation);
    // }
    // btnCancelJob = async (job_id) => {
    //     let result = await localStorage.getItemObject('user_arr')
    //     let user_id_post = 0;
    //     if (result != null) {
    //         user_id_post = result.user_id;
    //     }

    //     let url = config.baseURL + "job_cancel_provider.php?user_id_post=" + user_id_post + "&job_id_post=" + job_id;
    //     consolepro.consolelog('Provider cancel url', url);
    //     apifuntion.getApi(url).then((obj) => {
    //         setTimeout(() => {
    //             this.setState({ edit_delete_modal: false })
    //         }, 500);
    //         consolepro.consolelog('Provider cancel data', obj);
    //         if (obj.success == 'true') {
    //             var job_arr = this.state.job_details;
    //             job_arr.status = 3;
    //             if (obj.notification_arr != 'NA') {
    //                 notification.oneSignalNotificationSendCall(obj.notification_arr)
    //             }
    //         } else {

    //             if (obj.account_active_status == "deactivate") {
    //                 config.checkUserDeactivate(this.props.navigation);
    //                 return false;
    //             }
    //             msgProvider.alert(Lang_chg.information[config.language], obj.msg[config.language], false);
    //             return false;
    //         }
    //     }).catch(err => {

    //         console.log('err', err);
    //         if (err == "noNetwork") {
    //             msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
    //         } else {
    //             msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
    //         }
    //     });
    // }
    paymentAmount = async (job_available_id, type, price, check_type) => {

        let result = await localStorage.getItemObject('user_arr');
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        let job_status = this.state.job_details.status;
        let payment_method = this.state.job_details.payment_method;
        let url = '';
        if (config.live_status == 'yes') {
            url = config.baseURL + "update_payement_data_for_live.php?user_id=" + this.state.job_details.customer_id + "&amount=" + price + "&payment_method=" + payment_method + "&job_id=" + this.state.job_details.job_id + '&check_flag=' + check_type;
        } else {
            url = config.baseURL + "stripe_payment/payment_card_subscription.php?user_id=" + this.state.job_details.customer_id + "&amount=" + price + "&payment_method=" + payment_method + "&job_id=" + this.state.job_details.job_id + '&check_flag=' + check_type;
        }
        console.log('url', url);
        apifuntion.getApi(url).then((obj) => {
            if (obj.success == 'true') {
                consolepro.consolelog('accept', obj)
                if (check_type != 'accept_reject') {
                    this.props.navigation.navigate('Job_complete', {
                        job_number: this.state.job_details.job_number
                    });
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




    acceptService2 = async (job_available_id, type, check_flag) => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }

        let url = config.baseURL + "accept_service.php?user_id_post=" + user_id_post + "&job_available_id=" + job_available_id + "&job_id_post=" + this.state.job_id + "&type=" + type;
        consolepro.consolelog('Service accept ', url);
        apifuntion.getApi(url).then((obj) => {
            var job_arr = obj.job_arr;

            if (type == 'reject') {
                if (obj.service_arr != 'NA') {
                    this.setState({ service_arr: obj.service_arr, job_details: job_arr, final_amount_show: obj.final_amount_show, final_amount: obj.final_amount, total_time_spend: obj.total_time_spend })
                }

                if (job_arr.mark_complete_status == 0 && obj.final_amount_show == 'yes') {
                    if (config.device_type == 'android') {
                        this.paymentAmount('na', 'na', obj.second_time_pay_amount, 'final_payment')
                    } else {
                        setTimeout(() => {
                            this.paymentAmount('na', 'na', obj.second_time_pay_amount, 'final_payment')
                        }, 550);
                    }
                }

                if (job_arr.mark_complete_status == 1 && type != 'reject') {
                    this.props.navigation.navigate('Job_complete', {
                        job_number: job_arr.job_number
                    });
                    return false;
                }
            }



            if (obj.success == 'true') {
                var job_arr = obj.job_arr;
                if (check_flag == 'initial' && type != 'reject') {
                    //call payment -----------------------------------------
                    if (job_arr.payment_mode != 2) {
                        if (config.device_type == 'android') {
                            this.paymentAmount(job_available_id, type, this.state.job_details.online_amount, 'accept_reject');
                        } else {
                            setTimeout(() => {
                                this.paymentAmount(job_available_id, type, this.state.job_details.online_amount, 'accept_reject');
                            }, 550);
                        }
                    }
                }

                this.setState({
                    service_arr: obj.service_arr,
                    job_details: obj.job_arr,
                })
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


    acceptService = async (job_available_id, type) => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        let job_status = this.state.job_details.status;
        let payment_method = this.state.job_details.payment_method;
        if (job_status == 0) {
            this.acceptService2(job_available_id, type, 'initial')
            // this.paymentAmount(job_available_id, type, this.state.job_details.price, 'accept_reject');
        } else {
            this.acceptService2(job_available_id, type, 'later')
        }
    }


    btnMarkComplete = async (job_id) => {

        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }

        let url = config.baseURL + "job_mark_complete.php?user_id_post=" + user_id_post + "&job_id_post=" + job_id;
        consolepro.consolelog('mark complete ', url);
        apifuntion.getApi(url).then((obj) => {
            if (obj.success == 'true') {
                var job_arr = this.state.job_details;
                this.props.navigation.navigate('Job_complete', {
                    job_number: job_arr.job_number
                });
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
                                <View>
                                    <TouchableOpacity style={{ width: '100%', alignSelf: 'center', justifyContent: 'center', alignItems: 'center', }} activeOpacity={0.9} onPress={() => { this.setState({ edit_delete_modal: false }); this.props.navigation.navigate('Report_p', { other_user_id: this.state.job_details.customer_id }) }}>
                                        <View style={{ paddingVertical: screenWidth * 3.5 / 100 }}>
                                            <Text style={{ fontFamily: 'Poppins-Medium', textAlign: 'center', fontSize: screenWidth * 4 / 100, color: "#000" }}>{Lang_chg.txt_detail_job_rport1[config.language]}</Text>
                                        </View>
                                    </TouchableOpacity>
                                    <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 0.5, width: '100%' }}></View>
                                </View>

                                {
                                    (this.state.job_details.status == 0 || this.state.job_details.status == 4) &&
                                    <View>
                                        <View style={{ borderBottomColor: '#D0D7DE', borderBottomWidth: 0.5, width: '100%' }}></View>
                                        <TouchableOpacity style={{ width: '100%', alignSelf: 'center', justifyContent: 'center', alignItems: 'center', }} activeOpacity={0.9} onPress={() => { this.setState({ edit_delete_modal: false }); this.props.navigation.navigate("Cancel_job", { job_id: job_arr.job_id }) }}>
                                            <View style={{ paddingVertical: screenWidth * 3.5 / 100 }}>
                                                <Text style={{ fontFamily: 'Poppins-Medium', textAlign: 'center', fontSize: screenWidth * 4 / 100, color: "red" }}>{Lang_chg.txt_detail_job_Cancel[config.language]}</Text>
                                            </View>
                                        </TouchableOpacity>
                                    </View>
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
                    <TouchableOpacity
                        activeOpacity={1}
                        onPress={() => { Keyboard.dismiss(); }}
                        style={{
                            flex: 1,
                            backgroundColor: '#00000090',
                            alignItems: 'center',
                            justifyContent: 'center',
                            borderRadius: 0,
                        }}>
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
                                <TouchableOpacity onPress={() => { this.btnAddRatingReview() }} style={{ width: '100%', backgroundColor: '#42a7e8', height: 45, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50, marginTop: 30, }} activeOpacity={0.9}>
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
                        <TouchableOpacity onPress={() => this.setState({ edit_delete_modal: true })}>

                            <Image style={styles.detail_pending_dot} resizeMode="contain" source={require('./icons/dot.png')}></Image>

                        </TouchableOpacity>
                    </View>


                    {
                        (this.state.image_arr != '') &&
                        <View>
                            {
                                (this.state.image_arr == 'NA') ? <Image source={require('./icons/banner_error.jpg')} style={{ width: BannerWidth, height: BannerHeight * 55 / 100 }} />
                                    :
                                    <Carousel
                                        autoplay
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
                            (job_arr.status == 1 && job_arr.mark_complete_status == 0) && <View style={styles.pendingiewinpprogrss}>
                                <Text style={styles.statusText}>{Lang_chg.txt_status_Inprogress[config.language]}</Text>
                            </View>
                        }
                        {
                            (job_arr.mark_complete_status == 1 && job_arr.status != 3 && job_arr.status != 5) && <View style={styles.pendingiewcomleed}>
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
                                    <Text style={styles.job_detailid}>{Lang_chg.txt_detail_job_id[config.language]}: {job_arr.job_number}</Text>
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



                                {/* <View style={styles.detailexpire}>
                                    <Text style={styles.detail_service}>{Lang_chg.txt_detail_job_Availability[config.language]}</Text>
                                </View>

                                <View style={styles.detail_date_job}>
                                    <View style={styles.detail_date_box}>
                                        <View style={styles.detail_jobleft}>
                                            <Image style={styles.calender_Select} resizeMode="contain" source={require('./icons/calender.png')}></Image>
                                            <Text style={styles.detail_datet}>{job_arr.job_date}</Text>
                                        </View>
                                        <View style={styles.detail_jobright}>
                                            <Image style={styles.calender_Select} resizeMode="contain" source={require('./icons/watch.png')}></Image>
                                            <Text style={styles.detail_datet}>{job_arr.job_time}</Text>
                                        </View>
                                    </View>
                                </View> */}


                                <View style={[styles.create_covid_about, { backgroundColor: color1.covidbg, marginTop: 10 }]}>
                                    <Text style={styles.create_about_txt}>
                                        {Lang_chg.txt_covide_12[config.language]}
                                    </Text>
                                </View>
                                <View style={styles.detailexpire}>
                                    <Text style={styles.detail_service}>{Lang_chg.txt_detail_job_client_details[config.language]}</Text>
                                </View>

                                <TouchableOpacity activeOpacity={1} style={styles.detail_ratinngbox} onPress={() => { null }}>
                                    <View style={styles.detail_jobuser}>
                                        {
                                            (job_arr.customer_image != 'NA') ?
                                                <Image resizeMode="cover" style={styles.rewiew_people_img} source={{ uri: config.img_url + job_arr.customer_image }}></Image>
                                                :
                                                <Image resizeMode="cover" style={styles.rewiew_people_img} source={require('./icons/user_error.png')}></Image>
                                        }

                                    </View>
                                    <View style={styles.detail_name_user}>
                                        <Text style={styles.detail_name_user_txt}>{job_arr.customer_name}</Text>
                                        <View style={{ flexDirection: 'row', alignItems: 'center' }}>
                                            <StarRating
                                                emptyStar={require('./icons/star.png')}
                                                fullStar={require('./icons/star_active.png')}
                                                halfStar={require('./icons/half_star.png')}
                                                maxStars={5}
                                                rating={job_arr.customer_rating_avg}
                                                reversed={false}
                                                starSize={18}
                                                containerStyle={{ width: '50%' }}
                                                disabled={true}
                                            />
                                            <Text style={styles.profile_total_review}>{Lang_chg.txt_rating_revie_txt12[config.language]},({job_arr.customer_rating_count})</Text>
                                        </View>
                                    </View>
                                    {
                                        (job_arr.status == 1 || job_arr.status == 4) &&

                                        <TouchableOpacity style={{ width: '30%', justifyContent: 'center', alignItems: 'center' }} onPress={() => { this.props.navigation.navigate('Chat', { chatdata: { 'other_user_name': job_arr.customer_name, image: job_arr.customer_image, other_user_id: job_arr.customer_id, 'blockstatus': 'no' } },) }}>
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
                                                                    (item1.status == 0 && job_arr.status != 3 && job_arr.status != 2) &&
                                                                    <View style={{ flexDirection: 'row', width: '50%', justifyContent: 'flex-end' }}>

                                                                        <TouchableOpacity onPress={() => { this.acceptService(item1.job_available_id, 'reject') }}>
                                                                            <Image style={{ width: 25, height: 25, marginLeft: 13 }} resizeMode="contain" source={require('./icons/cross.png')}></Image>
                                                                        </TouchableOpacity>
                                                                        <TouchableOpacity onPress={() => { this.acceptService(item1.job_available_id, 'accept') }}>
                                                                            <Image style={{ width: 25, height: 25, marginLeft: 13 }} resizeMode="contain" source={require('./icons/checkmark.png')}></Image>
                                                                        </TouchableOpacity>

                                                                    </View>
                                                                }
                                                                {/*====================================================================== start button=================================================== */}
                                                                {
                                                                    (item1.status == 1) &&
                                                                    <View style={{ width: '50%', alignItems: 'flex-end' }}>
                                                                        <TouchableOpacity style={{ backgroundColor: '#0088e0', paddingLeft: 7, paddingRight: 7, borderRadius: 10, height: 30, alignItems: 'center', justifyContent: 'center', width: '35%' }} onPress={() => { this.startEndJob(item1.job_available_id, job_arr.job_id, index1, 'start') }}>
                                                                            <Text style={{ fontSize: 10, color: '#fff', }}>{Lang_chg.txt_detail_job_statr_job[config.language]}</Text>
                                                                        </TouchableOpacity>
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
                                                                        <TouchableOpacity style={{ backgroundColor: 'red', paddingLeft: 7, paddingRight: 7, borderRadius: 10, height: 30, alignItems: 'center', justifyContent: 'center', width: '35%' }} onPress={() => { this.confirmationEndStart(item1.job_available_id, job_arr.job_id, index1, 'end') }}>

                                                                            <Text style={{ fontSize: 10, color: '#fff', }}>{Lang_chg.txt_detail_job_End_j[config.language]}</Text>

                                                                        </TouchableOpacity>
                                                                        <Text style={{ color: '#0088e0', fontSize: 11 }}>{Lang_chg.txt_detail_job_Started[config.language]} <Text style={{ color: '#666' }}>{item1.final_time} </Text></Text>
                                                                    </View>
                                                                }
                                                                {/* ============================end end job btn===================================================================================*/}
                                                                {/* ============================end end job btn===================================================================================*/}
                                                                {
                                                                    (item1.status == 4) &&
                                                                    <View style={{ width: '50%', alignItems: 'flex-end', justifyContent: 'flex-end' }}>
                                                                        <Text style={{ color: '#0088e0', fontSize: 11 }}>{Lang_chg.txt_detail_job_End_j[config.language]}:   <Text style={{ color: '#666' }}>{item1.final_time} </Text></Text>
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
                                <View style={{ paddingBottom: 30, marginTop: 20 }}>

                                    {
                                        (job_arr.mark_complete_status == 1) &&
                                        <View>
                                            <View style={{ flexDirection: 'row', justifyContent: 'space-between', borderColor: '#757575', borderBottomWidth: 1, marginTop: 20, borderTopWidth: 1, marginBottom: 25, paddingVertical: 10, alignItems: 'center' }}>
                                                <Text style={styles.paymmenttitlel}>{Lang_chg.txt_detail_job_Payment_Detail[config.language]}</Text>
                                                <Text style={styles.teacher_price}>{job_arr.updatetime}</Text>
                                            </View>

                                            <View style={{ marginBottom: 10 }}>
                                                <Text style={styles.jobdetailid}>{Lang_chg.txt_detail_job_id[config.language]} :  {job_arr.job_number}</Text>
                                                <Text style={styles.jobdetailid}>{Lang_chg.txt_detail_job_txn_id[config.language]} :  {job_arr.txn_id}</Text>
                                                {
                                                    (job_arr.last_txn_id != null) &&
                                                    <Text style={styles.jobdetailid}>{Lang_chg.txt_detail_job_last_txn_id[config.language]} :  {job_arr.last_txn_id}</Text>
                                                }
                                                <Text style={styles.jobdetailid}><Text style={styles.jobboldleft}>{Lang_chg.txt_detail_job_last_Total_Hours[config.language]} :</Text> {this.state.total_time_spend} </Text>
                                            </View>
                                        </View>
                                    }

                                    <View>
                                        {
                                            // (parseInt(job_arr.isd_perc) > 0) && <>
                                            //     <Text style={styles.detail_priice_total}>{Lang_chg.txt_total_service_amt[config.language]} <Text style={{ color: '#666' }}>: {config.currency} {job_arr.price}</Text></Text>
                                            //     <Text style={styles.detail_priice_total}>{Lang_chg.txt_tax_isd[config.language]}({job_arr.isd_perc}%) <Text style={{ color: '#666' }}>: {config.currency} {job_arr.txt_isd_amt}</Text></Text>
                                            // </>
                                        }

                                        <Text style={styles.detail_priice_total}>{Lang_chg.txt_detail_job_totla[config.language]} <Text style={{ color: '#666' }}>: {config.currency} {job_arr.provider_earning}</Text></Text>
                                        {/* {
                                            (this.state.final_amount_show == 'no' || job_arr.status == 3 || job_arr.status == 5) &&
                                            <Text style={styles.detail_priice_total}>{Lang_chg.txt_detail_job_totla[config.language]} <Text style={{ color: '#666' }}>: {config.currency} {job_arr.price}</Text></Text>
                                        }
                                        {
                                            (this.state.final_amount_show == 'yes' && job_arr.status != 3) &&
                                            <Text style={styles.detail_priice_total}>{Lang_chg.txt_detail_job_totla[config.language]} <Text style={{ color: '#666' }}>: {config.currency} {this.state.final_amount}</Text></Text>
                                        } */}
                                    </View>
                                    {

                                        (job_arr.status == 2 && job_arr.mark_complete_status == 1 && job_arr.rating_status == 'no') &&
                                        <View style={[styles.login_btn, { marginTop: 10 }]}>
                                            <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.setState({ rating_popup: true }); }}>
                                                <Text style={styles.btn_txt}>{Lang_chg.txt_detail_job_ratee_now[config.language]}</Text>
                                            </TouchableOpacity>
                                        </View>
                                    }
                                </View>

                                {/* {
                                    (this.state.final_amount_show == 'yes' && job_arr.mark_complete_status == 0 && job_arr.status == 1) && <View style={styles.login_btn, { marginTop: 20, width: '100%', margin: 10, }}>
                                        <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.btnMarkComplete(job_arr.job_id) }}>
                                            <Text style={styles.btn_txt}>{Lang_chg.markComplete_txt[config.language]}</Text>
                                        </TouchableOpacity>
                                    </View>
                                } */}


                                {
                                    // (job_arr.status == 0) &&
                                    // <View style={{ width: '100%', flexDirection: 'row', alignItems: "center", justifyContent: "space-between", marginBottom: 20, marginTop: 20 }}>
                                    //     <TouchableOpacity style={{ width: '45%', backgroundColor: '#ff0004', height: 50, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50 }}
                                    //         onPress={() => { this.btnConfirmRejectAccept('reject', job_arr.customer_id.user_id, this.state.job_id) }}
                                    //     >
                                    //         <Text style={styles.btn_txt}>{Lang_chg.txt_detail_job_Reject[config.language]}</Text>

                                    //     </TouchableOpacity>
                                    //     <TouchableOpacity style={{
                                    //         width: '45%', backgroundColor: '#0ced48', height: 50, alignItems: 'center', justifyContent: 'center', alignSelf: 'center', borderRadius: 50,
                                    //     }}
                                    //         onPress={() => { this.btnConfirmRejectAccept('accept', job_arr.customer_id.user_id, this.state.job_id) }}
                                    //     >
                                    //         <Text style={styles.btn_txt}>{Lang_chg.txt_detail_job_acept[config.language]}</Text>
                                    //     </TouchableOpacity>
                                    // </View>
                                }

                            </View>
                        </View>
                    }
                </ScrollView>
            </View>
        )
    }

}
