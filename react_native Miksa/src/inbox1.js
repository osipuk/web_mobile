import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, TextInput, FlatList, } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";

const demodat = [1,];
const demodat2 = [1,];
const demodat1 = [{ 'name': 'John Peter', 'numer': '+9', 'txt': 'Hello How Are You.', id: '#7354521434', status: 'Inprogress', date: '28/04/2021', image: require('./icons/ratings.png') },
{ 'name': 'David Rock', 'numer': '6', 'txt': 'David please release amount', id: '#0236589485', status: 'Inprogress', date: '28/03/2021', image: require('./icons/search_pro3.png') },
{ 'name': 'Marco Juicky', 'numer': '2', 'txt': 'Hii', id: '#9632587415', status: 'Completed', date: '01/02/2021', image: require('./icons/search_pro4.png') },
{ 'name': 'Patrick Johnson', 'numer': '3', 'txt': 'Hello, are you there?', id: '#7896413555', status: 'Inprogress', date: '06/03/2021', image: require('./icons/edit_profile.png') },

];
export default class Inbox extends Component {
    backpress = () => {
        this.props.navigation.goBack();
    }
    state = {
        searchbtn: false,
        countrydata: demodat1,
        country: false,
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
                        numColumns={1}
                        data={this.state.countrydata}
                        renderItem={({ item, index }) => {
                            return (
                                <TouchableOpacity activeOpacity={1} style={styles.searchibox} onPress={() => { this.props.navigation.navigate('Chat') }}>
                                    <View style={styles.inboxLeft}>
                                        <Image resizeMode="cover" style={styles.inboximg} source={item.image}></Image>
                                    </View>
                                    <View style={styles.inboxmiddle}>
                                        <Text style={styles.inboxName}>{item.name}</Text>
                                        <Text style={styles.inboxNamepsg}>{item.txt}</Text>
                                    </View>
                                    <View style={styles.vinboxtotalms}>
                                        <View style={styles.inboccotbg}>
                                            <Text style={styles.total_counters}>{item.numer}</Text>
                                        </View>
                                        <Text style={styles.inoxtime}>15m ago</Text>
                                    </View>
                                </TouchableOpacity>

                            )
                        }}
                    />
                </View>
            </View>
        )
    }
}
