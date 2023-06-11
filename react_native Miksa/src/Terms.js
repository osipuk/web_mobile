import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, ScrollView,StyleSheet } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import HTMLView from 'react-native-htmlview';
export default class Terms extends Component {
    constructor(props) {
        super(props);
        this.state = {
            loading: false,
            player_id: '',
            content: this.props.route.params.content,
            title: this.props.route.params.title,
            loading: false,
            isConnected: true,
            Termsdata: 'NA',
            data_not_found:''
        }
    }
    backpress = () => {
        this.props.navigation.goBack();
    }
    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />

                <View style={styles.map_top}>
                    <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                        <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
                    </TouchableOpacity>
                    <Text style={{ textAlign: "center", fontFamily: "Poppins-Bold",color:"#fff" }}>{
                        this.state.title}</Text>
                    <Text></Text>
                </View>
                <ScrollView showsVerticalScrollIndicator={false}>
                    <View style={styles.terms_body}>
                        <HTMLView
                            value={this.state.content}
                            stylesheet={styles12}
                        />
                    </View>
                </ScrollView>
            </View>
        )
    }
}


const styles12 = StyleSheet.create({

    container: {
        flex: 1,
        backgroundColor: '#FFFFFF',
        paddingTop:20,
    },
    button:
    {
        marginBottom: 13,
        borderRadius: 6,
        paddingVertical: 12,
        width: '50%',
        margin: 15,
        backgroundColor: '#fa5252'
    },
    textbutton: {
        borderBottomColor: '#f2f2f2'
        , borderBottomWidth: 1,
        paddingVertical: 16,
        width: '95%',
        alignSelf: 'center'
    },
    textfont: {
        fontSize: 13,
        paddingLeft: 10
    },
    p: {
        fontWeight: '300',
        color: 'black', 
        marginBottom: -50,
        lineHeight: 24,
        letterSpacing: 0.8,
        fontStyle: 'normal',
    },

})