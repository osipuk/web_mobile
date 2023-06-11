import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, StyleSheet, TouchableOpacity, Image, FlatList, ScrollView } from 'react-native'
import colors from './Colors'
import StarRating from 'react-native-star-rating';
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mobileH, mobileW } from './Provider/utilslib/Utils';
export default class Rating_review extends Component {

    constructor(props) {
        super(props)
        this.state = {
            total_owner_amt: 0,
            rating_arr: 'NA',
            ratting_data: 'NA',
            user_id: this.props.route.params.user_id,
        }
    }

    componentDidMount() {
        this._getRating();
    }


    backpress = () => {
        this.props.navigation.goBack();
    }

    _getRating = async () => {

        let url = config.baseURL + "rating_review_list.php?user_id_post=" + this.state.user_id;
        console.log('url', url)
        apifuntion.getApi(url).then((obj) => {
            consolepro.consolelog('notificationList', obj);
            if (obj.success == 'true') {
                this.setState({
                    rating_arr: obj.rating_arr,
                    ratting_data: obj
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
            if (err == "noNetwork") {
                msgProvider.alert(Lang_chg.msgTitleNoNetwork[config.language], Lang_chg.noNetwork[config.language], false);
            } else {
                msgProvider.alert(Lang_chg.msgTitleServerNotRespond[config.language], Lang_chg.serverNotRespond[config.language], false);
            }
            console.log('err', err);
        });

    }

    render() {
        return (
            <View style={{ flex: 1, height: '100%', backgroundColor: '#ffffff', }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: colors.theme_color }} />
                <StatusBar backgroundColor={colors.staus_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />

                <View style={{ flexDirection: "row", height: mobileH * 0.071, backgroundColor: '#0088e0', paddingHorizontal: 20 }}>
                    <View style={{ flex: 1, justifyContent: "center" }}>
                        <TouchableOpacity style={{ flexDirection: "row", alignItems: "center" }}
                            onPress={() => this.props.navigation.goBack()}
                        >
                            <Image style={{ width: 20, height: 20, marginLeft: 5 }}
                                source={require('./icons/back2.png')}
                                resizeMode="contain"
                            />
                        </TouchableOpacity>
                    </View>
                    <View style={{ flex: 2, justifyContent: "center", }}>
                        <Text style={{ textAlign: "center", fontFamily: 'Poppins-Regular', color: '#fff', fontSize: 18 }}>{Lang_chg.txt_rating_revie_txt[config.language]}</Text>
                    </View>
                    <TouchableOpacity style={{ flex: 1, alignItems: 'flex-end', justifyContent: 'center' }} activeOpacity={0.9} >

                    </TouchableOpacity>
                </View>


                {
                    this.state.rating_arr != 'NA' &&
                    <View style={styles.rating_banner}>
                        <View>
                            <Text style={styles.rating_total}>{this.state.ratting_data.avg_rating}</Text>
                            <View style={styles.rating_left}>
                                <StarRating
                                    disabled={false}
                                    emptyStar={require('./icons/star.png')}
                                    fullStar={require('./icons/star_active.png')}
                                    halfStar={require('./icons/half_star.png')}
                                    maxStars={5}
                                    rating={this.state.ratting_data.avg_rating}
                                    reversed={false}
                                    starSize={18}
                                    disabled={true}
                                />
                                <Text style={styles.rating_1425}>({this.state.ratting_data.rating_count})</Text>
                            </View>
                        </View>
                        <View>
                            <View style={styles.rating_right}>
                                <StarRating
                                    disabled={false}
                                    emptyStar={require('./icons/star.png')}
                                    fullStar={require('./icons/star_active.png')}
                                    halfStar={require('./icons/half_star.png')}
                                    maxStars={5}
                                    rating={5}
                                    reversed={false}
                                    starSize={18}
                                    disabled={true}
                                />
                                <Text style={styles.total_ratin_txt}>{this.state.ratting_data.num_5}</Text>
                            </View>
                            <View style={styles.rating_right}>
                                <StarRating
                                    disabled={false}
                                    emptyStar={require('./icons/star.png')}
                                    fullStar={require('./icons/star_active.png')}
                                    halfStar={require('./icons/half_star.png')}
                                    maxStars={5}
                                    rating={4}
                                    reversed={false}
                                    starSize={18}
                                    disabled={true}
                                />
                                <Text style={styles.total_ratin_txt}>{this.state.ratting_data.num_4}</Text>
                            </View>
                            <View style={styles.rating_right}>
                                <StarRating
                                    disabled={false}
                                    emptyStar={require('./icons/star.png')}
                                    fullStar={require('./icons/star_active.png')}
                                    halfStar={require('./icons/half_star.png')}
                                    maxStars={5}
                                    rating={3}
                                    reversed={false}
                                    starSize={18}
                                    disabled={true}
                                />
                                <Text style={styles.total_ratin_txt}>{this.state.ratting_data.num_3}</Text>
                            </View>
                            <View style={styles.rating_right}>
                                <StarRating
                                    disabled={false}
                                    emptyStar={require('./icons/star.png')}
                                    fullStar={require('./icons/star_active.png')}
                                    halfStar={require('./icons/half_star.png')}
                                    maxStars={5}
                                    rating={2}
                                    reversed={false}
                                    starSize={18}
                                    disabled={true}
                                />
                                <Text style={styles.total_ratin_txt}>{this.state.ratting_data.num_2}</Text>
                            </View>
                            <View style={styles.rating_right}>
                                <StarRating
                                    disabled={false}
                                    emptyStar={require('./icons/star.png')}
                                    fullStar={require('./icons/star_active.png')}
                                    halfStar={require('./icons/half_star.png')}
                                    maxStars={5}
                                    rating={1}
                                    reversed={false}
                                    starSize={18}
                                    disabled={true}
                                />
                                <Text style={styles.total_ratin_txt}>{this.state.ratting_data.num_1}</Text>
                            </View>
                        </View>
                    </View>
                }


                <ScrollView showsVerticalScrollIndicator={false}>

                    <View style={styles.rating_main_page}>
                        {
                            this.state.rating_arr != 'NA' &&
                            <FlatList
                                data={this.state.rating_arr}
                                horizontal={false}
                                showsHorizontalScrollIndicator={false}
                                inverted={false}
                                renderItem={({ item, index }) => {
                                    return (
                                        <View>
                                            <View style={styles.total_earnig_list}>
                                                <View style={styles.rating_right_sc}>
                                                    {
                                                        (item.user_image == 'NA')
                                                            ?
                                                            <Image resizeMode="cover" style={styles.rewiew_people_img} source={require('./icons/user_error.png')}></Image>
                                                            :
                                                            <Image source={{ uri: config.img_url1 + item.user_image }} resizeMode="cover" style={styles.rewiew_people_img} />
                                                    }
                                                </View>
                                                <View style={styles.rating_main}>
                                                    <Text style={styles.left_time_sele}>{item.createtime}</Text>
                                                    {
                                                        (item.job_number != 0) &&
                                                        <Text style={styles.rating_name}>{item.job_number}</Text>
                                                    }
                                                    <Text style={styles.rating_name}>{item.user_name}</Text>
                                                    <View style={styles.rating_people}>
                                                        <StarRating
                                                            disabled={false}
                                                            emptyStar={require('./icons/star.png')}
                                                            fullStar={require('./icons/star_active.png')}
                                                            halfStar={require('./icons/half_star.png')}
                                                            maxStars={5}
                                                            rating={item.rating}
                                                            reversed={false}
                                                            starSize={18}
                                                            disabled={true}
                                                        />
                                                    </View>
                                                    <View>
                                                        <Text style={styles.rating_txt_main}>{item.review}</Text>
                                                    </View>
                                                </View>
                                            </View>
                                        </View>
                                    )
                                }}
                                keyExtractor={(index) => { index.toString() }}
                            />
                        }
                    </View>
                    {

                        (this.state.rating_arr == 'NA') && <View style={{ width: '100%', alignItems: 'center', height: mobileH * 0.9, justifyContent: 'center', marginTop: -30 }}>
                            <Image style={{ width: mobileW * 0.4, height: mobileW * 0.4 }} source={require('./icons/no_data_.png')} />
                            <Text style={{ fontSize: 18, color: '#000', fontFamily: 'Poppins-Bold' }}></Text>
                        </View>

                    }
                </ScrollView>
            </View>
        )
    }
}


const styles = StyleSheet.create({

    header_earnig: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        paddingTop: 10,
        paddingBottom: 10,
        paddingLeft: 20,
        paddingRight: 20,
    },
    select_back: {
        width: 30,
        height: 30,
        resizeMode: 'contain',
    },
    earnig_title: {
        fontSize: 18,
        fontFamily: 'Poppins-Bold',
        fontWeight: 'bold',
    },
    rating_banner: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        paddingBottom: 20,
        borderBottomWidth: 8,
        borderColor: '#f8f8f8',
        paddingRight: 20,
        paddingLeft: 20,
    },
    rating_right: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        marginTop: 10,
    },
    review_star: {
        width: 20,
        height: 20,
        marginLeft: 2,
        marginRight: 2,
    },
    review_star_left: {
        width: 16,
        height: 16,
        marginLeft: 2,
        marginRight: 2,
    },
    rating_left: {
        flexDirection: 'row',
        justifyContent: 'space-between',
    },
    rating_total: {
        textAlign: 'left',
        fontSize: 24,
        fontFamily: 'Poppins-Regular',
        marginTop: 50,
    },

    rating_1425: {
        color: '#7f7f7f',
        letterSpacing: 1,
        marginLeft: 10,
        fontFamily: 'Poppins-Regular',
    },
    total_ratin_txt: {
        color: '#7f7f7f',
        letterSpacing: 1,
        marginLeft: 10,
        fontFamily: 'Poppins-Regular',
        fontSize: 18,
    },
    rating_people: {
        flexDirection: 'row',
        width: '100%',
        justifyContent: 'flex-start',
        marginBottom: 3,
        marginTop: 3,
    },
    rating_status_star: {
        width: 18,
        height: 18,
        marginLeft: 2,
        marginRight: 2,
    },
    total_earnig_list: {
        flexDirection: 'row',
        width: '100%',
        borderBottomWidth: 1,
        paddingBottom: 15,
        paddingTop: 15,
        borderColor: '#c2c2c2',
        // paddingLeft: 20,
        // paddingRight: 20,
    },
    rating_right_sc: {
        width: '20%',
        textAlign: 'center',
        alignItems: 'center',
    },
    rating_main: {
        width: '80%',
    },

    rating_name: {
        textAlign: 'left',
        fontFamily: 'Poppins-Bold',
        fontSize: 16,
        lineHeight: 18
    },
    rewiew_people_img: {
        width: 40,
        height: 40,
        marginTop: 10,
        borderRadius: 20
    },
    rating_title_main: {
        color: '#727272',
    },
    rating_txt_main: {
        textAlign: 'left'
    },
    left_time_sele: {
        position: 'absolute',
        fontFamily: 'Poppins-Regular',
        color: '#727272',
        fontSize: 12,
        right: 20
    },
})