import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, Image, TextInput, TouchableOpacity, FlatList } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, validationprovider, SocialLogin, Currentltlg, mobileH, mobileW } from './Provider/utilslib/Utils';
const demodat = [1,];
const demodat1 = [1,];
export default class All_jobs_p extends Component {
    backpress = () => {
        this.props.navigation.goBack();
    }

    constructor(props) {
        super(props)
        this.state = {
            countrydata: demodat1,
            job_arr: "NA",
            job_arr1: "NA",
        }
    }

    componentDidMount() {
        this.getHomedata();
    }

    componentWillUnmount() {
        const { navigation } = this.props;
        navigation.removeListener('focus', () => {
            console.log('remove lister')
        });
    }


    getHomedata = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;

        }

        let url = config.baseURL + "job_list_p.php?user_id_post=" + user_id_post;
        consolepro.consolelog('Provider home url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Provider home data', obj);
            if (obj.success == 'true') {
                this.setState({
                    job_arr: obj.job_arr,
                    job_arr1: obj.job_arr,
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
                var job_arr = this.state.job_arr;
                if (type == 'reject') {
                    job_arr[index].status = 3;
                } else {
                    job_arr[index].status = 4;
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

                {this.state.searchbtn == false &&
                    <View styles={{ justifyContent: 'space-between', flexDirection: 'row' }}>

                        <View style={[styles.search_pro_header, { backgroundColor: color1.theme_color }]}>
                            <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                                <Image style={styles.home_search_icon} resizeMode="contain" source={require('./icons/back2.png')}></Image>
                            </TouchableOpacity>
                            <Text style={styles.header_search_pro_title}>Inbox</Text>
                            <TouchableOpacity onPress={() => { this.setState({ searchbtn: true }) }}>
                                <Image style={styles.home_search_icon} resizeMode="contain" source={require('./icons/search_white.png')}></Image>
                            </TouchableOpacity>
                        </View>
                    </View>}
                {this.state.searchbtn == true &&
                    <View style={[styles.input_main_header, { backgroundColor: color1.theme_color }]}>
                        <View style={styles.search_back_header}>
                            <TouchableOpacity onPress={() => { this.setState({ searchbtn: false }) }} activeOpacity={0.9}>
                                <Image resizeMode="contain" style={styles.search_header_back} source={require('./icons/back2.png')}></Image>
                            </TouchableOpacity>
                        </View>
                        <View style={styles.search_nav_right}>
                            <TextInput style={styles.search_navbar} placeholder="Search"></TextInput>
                        </View>
                    </View>
                }

                <View style={styles.notofication_body}>

                    <FlatList style={{ marginBottom: 50, }}
                        showsVerticalScrollIndicator={false}
                        data={this.state.countrydata}
                        renderItem={({ item, index }) => {
                            return (

                                <View>

                                    <TouchableOpacity style={styles.homeplist} activeOpacity={1}>
                                        <View style={styles.homelistp_left}>
                                            <Image style={styles.phomeimg} resizeMode="cover" source={require('./icons/home1.png')}></Image>
                                        </View>
                                        <View style={styles.homelistp_right}>
                                            <View style={styles.hommed}>
                                                <View>
                                                    <Text style={styles.pboxid}>39293</Text>
                                                </View>
                                                <View style={styles.phometime}>
                                                    <Text style={styles.phometimemint}>2m ago</Text>
                                                    <Image style={styles.phomelike} resizeMode="contain" source={require('./icons/save_active.png')}></Image>
                                                </View>
                                            </View>
                                            <View>
                                                <Text style={styles.viewpaameiem}>Clean up rubbish </Text>
                                                <Text style={styles.phomepsg}>home or office cleaning</Text>
                                            </View>
                                            <View style={styles.price_code}>
                                                <Text style={styles.home_rice_main}>$200</Text>
                                                <View style={styles.homeoencose}>
                                                    <Image style={styles.phomelike} resizeMode="contain" source={require('./icons/cross.png')}></Image>
                                                    <Image style={styles.phomelike} resizeMode="contain" source={require('./icons/checkmark.png')}></Image>
                                                </View>
                                            </View>
                                        </View>
                                    </TouchableOpacity>


                                    <TouchableOpacity style={styles.homeplist} activeOpacity={1}>
                                        <View style={styles.homelistp_left}>
                                            <Image style={styles.phomeimg} resizeMode="cover" source={require('./icons/edit_job1.png')}></Image>
                                        </View>
                                        <View style={styles.homelistp_right}>
                                            <View style={styles.hommed}>
                                                <View>
                                                    <Text style={styles.pboxid}>39293</Text>
                                                </View>
                                                <View style={styles.phometime}>
                                                    <Text style={styles.phometimemint}>2m ago</Text>
                                                    <Image style={styles.phomelike} resizeMode="contain" source={require('./icons/save_unfill.png')}></Image>
                                                </View>
                                            </View>
                                            <View>
                                                <Text style={styles.viewpaameiem}>House cleaning </Text>
                                                <Text style={styles.phomepsg}>home or office cleaning</Text>
                                            </View>
                                            <View style={styles.price_code}>
                                                <Text style={styles.home_rice_main}>$200</Text>
                                                <Text style={styles.pendingbtnhomme}>
                                                    Pending
                                                </Text>
                                            </View>
                                        </View>
                                    </TouchableOpacity>

                                    <TouchableOpacity style={styles.homeplist} activeOpacity={1}>
                                        <View style={styles.homelistp_left}>
                                            <Image style={styles.phomeimg} resizeMode="cover" source={require('./icons/home1.png')}></Image>
                                        </View>
                                        <View style={styles.homelistp_right}>
                                            <View style={styles.hommed}>
                                                <View>
                                                    <Text style={styles.pboxid}>39293</Text>
                                                </View>
                                                <View style={styles.phometime}>
                                                    <Text style={styles.phometimemint}>2m ago</Text>
                                                    <Image style={styles.phomelike} resizeMode="contain" source={require('./icons/save_active.png')}></Image>
                                                </View>
                                            </View>
                                            <View>
                                                <Text style={styles.viewpaameiem}>Clean up rubbish </Text>
                                                <Text style={styles.phomepsg}>home or office cleaning</Text>
                                            </View>
                                            <View style={styles.price_code}>
                                                <Text style={styles.home_rice_main}>$200</Text>
                                                <View style={styles.homeoencose}>
                                                    <Image style={styles.phomelike} resizeMode="contain" source={require('./icons/cross.png')}></Image>
                                                    <Image style={styles.phomelike} resizeMode="contain" source={require('./icons/checkmark.png')}></Image>
                                                </View>
                                            </View>
                                        </View>
                                    </TouchableOpacity>

                                    <TouchableOpacity style={styles.homeplist} activeOpacity={1}>
                                        <View style={styles.homelistp_left}>
                                            <Image style={styles.phomeimg} resizeMode="cover" source={require('./icons/home1.png')}></Image>
                                        </View>
                                        <View style={styles.homelistp_right}>
                                            <View style={styles.hommed}>
                                                <View>
                                                    <Text style={styles.pboxid}>39293</Text>
                                                </View>
                                                <View style={styles.phometime}>
                                                    <Text style={styles.phometimemint}>2m ago</Text>
                                                    <Image style={styles.phomelike} resizeMode="contain" source={require('./icons/save_unfill.png')}></Image>
                                                </View>
                                            </View>
                                            <View>
                                                <Text style={styles.viewpaameiem}>House cleaning </Text>
                                                <Text style={styles.phomepsg}>home or office cleaning</Text>
                                            </View>
                                            <View style={styles.price_code}>
                                                <Text style={styles.home_rice_main}>$200</Text>
                                                <Text style={styles.pendingbtinprogres}>
                                                    Inprogress
                                                </Text>
                                            </View>
                                        </View>
                                    </TouchableOpacity>
                                </View>
                            )
                        }}
                    />
                </View>
            </View>
        )
    }
}
