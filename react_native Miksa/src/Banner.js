import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, ImageBackground, Image, Dimensions, TouchableOpacity } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
const windowWidth = Dimensions.get('window').width;
const windowheight = Dimensions.get('window').height;
export default class Banner extends Component {
    render() {
        return (
            <View style={{ flex: 1, height: '100%', width: '100%', backgroundColor: '#FFFFFF' }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                <ImageBackground style={styles.Banner_bg} source={require('./icons/loginbg.png')}>
                    <Image style={styles.banner_main_logo} resizeMode="contain" source={require('./icons/logo.png')}></Image>
                </ImageBackground>
            </View>
        )
    }
}
