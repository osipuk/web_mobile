import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, TextInput, FlatList } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import StarRating from 'react-native-star-rating';
import HideWithKeyboard from 'react-native-hide-with-keyboard';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileH, mobileW } from './Provider/utilslib/Utils';
const demodat = [1,];
const demodat2 = [1,];
const demodat1 = [1,];
export default class Search_pro extends Component {
    backpress = () => {
        this.props.navigation.goBack();
    }

    constructor(props) {
        super(props)
        this.state = {
            provider_arr: 'NA',
            provider_arr1: 'NA',
            searchbtn: false,
        }
    }

    componentDidMount() {
        this.getProviderList();
    }


    getProviderList = async () => {
        let result = await localStorage.getItemObject('user_arr')
        let user_id_post = 0;
        if (result != null) {
            user_id_post = result.user_id;
        }
        let url = config.baseURL + "provider_list_all.php?user_id_post=" + user_id_post;
        consolepro.consolelog('provider_list url', url);
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('Provider  data', obj);
            if (obj.success == 'true') {
                this.setState({
                    provider_arr: obj.provider_arr,
                    provider_arr1: obj.provider_arr,
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


    _searchData = (textToSearch) => {
        if (this.state.provider_arr1 != "NA") {
            this.setState({
                provider_arr: this.state.provider_arr1.filter(i =>
                    i.name.toString().toLowerCase().includes(textToSearch.toString().toLowerCase()),
                ),
            })
        }
    }

    emptyText = async () => {
        this.searchfield.clear()
        this.setState({ provider_arr: this.state.provider_arr1 })
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
                            <Text style={styles.map_title}>{Lang_chg.txt_search_txt_pro[config.language]}</Text>
                            <TouchableOpacity onPress={() => { this.setState({ searchbtn: true }) }}>
                                {
                                    (this.state.provider_arr != 'NA') &&
                                    <Image style={styles.home_search_icon} resizeMode="contain" source={require('./icons/search_white.png')}></Image>
                                }
                            </TouchableOpacity>
                        </View>
                    </View>}
                {this.state.searchbtn == true &&
                    <View style={[styles.input_main_header, { backgroundColor: color1.theme_color, alignItems: 'center', paddingTop: 10, paddingBottom: 15 }]}>
                        <View style={styles.search_back_header}>
                            <TouchableOpacity onPress={() => { this.setState({ searchbtn: false }) }} activeOpacity={0.9}>
                                <Image resizeMode="contain" style={{ width: 20, height: 20, resizeMode: 'contain', }} source={require('./icons/back2.png')}></Image>
                            </TouchableOpacity>
                        </View>
                        <View style={{ height: 40, backgroundColor: '#e5e5e9', borderRadius: 20, flexDirection: 'row', width: '90%', alignItems: "center", justifyContent: "center", paddingHorizontal: 10 }}>

                            <TextInput
                                style={{ backgroundColor: '#e5e5e9', width: '90%', borderRadius: 20 }}
                                placeholder={Lang_chg.txt_select_service_search[config.language]}
                                onChangeText={text => this._searchData(text)}
                                returnKeyLabel='done'
                                keyboardType='default'
                                ref={(input) => { this.searchfield = input; }}
                            />

                            <TouchableOpacity onPress={() => { this.emptyText() }} style={{ width: '10%' }}><Image resizeMode="contain" style={{ width: 30, height: 30 }} source={require('./icons/cross2.png')}></Image></TouchableOpacity>
                        </View>
                    </View>
                }


                <View style={styles.search_pro_list}>
                    {
                        (this.state.provider_arr != 'NA') &&
                        <FlatList
                            contentContainerStyle={{ paddingTop: 20, paddingBottom: 80 }}
                            showsVerticalScrollIndicator={false}
                            data={this.state.provider_arr}
                            renderItem={({ item, index }) => {
                                return (
                                    <TouchableOpacity style={{
                                        flexDirection: 'row', alignItems: 'center', marginBottom: 15, width: '90%', alignSelf: 'center', backgroundColor: '#fff', shadowColor: "#ccc", shadowOffset: {
                                            width: 1, height: 1
                                        }, shadowOpacity: 1, shadowRadius: 2, elevation: 2, paddingHorizontal: 20, paddingVertical: 10, borderRadius: 10
                                    }} onPress={() => { this.props.navigation.navigate('Other_profile', { provider_id: item.provider_id, previous_page: 'search_pro' }) }}>
                                        <View style={styles.search_pro_left}>
                                            {
                                                (item.image != 'NA') ?
                                                    <Image resizeMode="cover" style={styles.search_proimg} source={{ uri: config.img_url1 + item.image }}></Image>
                                                    :
                                                    <Image resizeMode="cover" style={styles.search_proimg} source={require('./icons/user_error.png')}></Image>
                                            }

                                        </View>
                                        <View style={styles.search_pro_right}>
                                            <Text style={styles.search_proName}>{item.name}</Text>
                                            <View style={styles.search_pro_star_seaction}>
                                                <StarRating
                                                    emptyStar={require('./icons/star.png')}
                                                    fullStar={require('./icons/star_active.png')}
                                                    halfStar={require('./icons/half_star.png')}
                                                    maxStars={5}
                                                    rating={item.avg_rating}
                                                    reversed={false}
                                                    starSize={18}
                                                    disabled={true}
                                                />
                                                <Text style={styles.rewview_total_Seach}>{Lang_chg.txt_detail_job_Review[config.language]},({item.rating_count})</Text>
                                            </View>
                                        </View>
                                    </TouchableOpacity>
                                )
                            }}
                        />
                    }
                </View>
            </View>
        )
    }
}
