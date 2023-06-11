import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, FlatList } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileH, mobileW } from './Provider/utilslib/Utils';
const demodat1 = [1, 4, 5, 2, 3, 6, 9, 8, 7, 4,];
export default class Wallet extends Component {

    constructor(props) {
        super(props)
        this.state = {
            wallet_arr: 'NA',
            wallet_balance: 0,
        }
    }
    backpress = () => {
        this.props.navigation.goBack();
    }

    componentDidMount() {
        this.walletHistory();
    }

    walletHistory = async (job_id) => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }

        let url = config.baseURL + "wallet_history_c.php?user_id_post=" + user_id_post;
        consolepro.consolelog('Wallet url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Wallet data', obj);
            if (obj.success == 'true') {
                this.setState({ wallet_arr: obj.wallet_arr, wallet_balance: obj.wallet_balance })
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
            <View style={{ flex: 1, height: '100%', backgroundColor: '#ffffff', }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text style={styles.map_title}>{Lang_chg.txt_wallet_txt[config.language]}</Text>
                    <Text></Text>
                </View>

                <View style={styles.wallet_body}>
                    {
                        (this.state.wallet_arr != 'NA') &&
                        <View style={styles.wallet_banner}>
                            <Text style={styles.wallet_total}>{config.currency} {this.state.wallet_balance.toFixed(2)}</Text>
                            <Text style={styles.wallet_txt}>{Lang_chg.txt_wallet_txt1[config.language]}</Text>
                        </View>
                    }

                    {
                        (this.state.wallet_arr != 'NA') &&
                        <FlatList style={{ marginBottom: 50, }}
                            showsVerticalScrollIndicator={false}
                            numColumns={1}
                            data={this.state.wallet_arr}
                            renderItem={({ item, index }) => {
                                return (
                                    <View style={styles.wallet_list}>
                                        <View style={{ flexDirection: 'row', alignItems: 'center', justifyContent: 'center' }}>
                                            {
                                                (item.status == 0) && <Image style={{ height: 15, width: 15 }} source={require('./icons/downarrow1.png')}></Image>
                                            }
                                            {
                                                (item.status == 1) && <Image style={{ height: 15, width: 15 }} source={require('./icons/uparrow.png')}></Image>
                                            }

                                            <View style={{ marginLeft: 10 }}>
                                                {
                                                    (item.job_number != 0) &&
                                                    <Text style={styles.wallet_id}>{item.job_number}</Text>
                                                }
                                                <Text style={styles.wallet_time}>{item.createtime}</Text>
                                            </View>
                                        </View>

                                        <View style={styles.wallet_right}>
                                            <Text style={styles.wallet_total_price}>{config.currency} {item.amount}</Text>
                                        </View>
                                    </View>

                                )
                            }}
                        />
                    }

                    {
                        (this.state.wallet_arr == 'NA') && <View style={{ height: mobileH, width: '100%', alignItems: 'center', paddingTop: mobileH * 0.2 }}>
                            <Image style={{ width: mobileW * 0.4, height: mobileW * 0.4 }} source={require('./icons/no_data_.png')} />
                            <Text style={{ fontSize: 18, color: '#000', fontFamily: 'Poppins-Bold' }}>{Lang_chg.txt_wallet_txt1_not[config.language]}</Text>
                        </View>
                    }
                </View>
            </View>
        )
    }
}
