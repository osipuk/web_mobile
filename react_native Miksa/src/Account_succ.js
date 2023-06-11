import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, TouchableOpacity, Image, BackHandler } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mediaprovider, Cameragallery,validationprovider } from './Provider/utilslib/Utils';
export default class Account_succ extends Component {
    _didFocusSubscription;
    _willBlurSubscription;

    constructor(props) {
        super(props);
        this.state = {

        }

        this._didFocusSubscription = props.navigation.addListener('focus', payload =>
            BackHandler.addEventListener('hardwareBackPress', this.handleBackPress)
        );
    }

    componentDidMount() {
        this._willBlurSubscription = this.props.navigation.addListener('blur', payload =>
            BackHandler.removeEventListener('hardwareBackPress', this.handleBackPress)
        );
    }

    handleBackPress = () => {
        this.props.navigation.navigate('Login')
        return true;
    };

    backpress = () => {
        this.props.navigation.navigate('Login');
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
                    <Text></Text>
                    <Text></Text>
                </View>

                <View style={styles.create_success_view}>
                    <Image style={styles.successimg} resizeMode="contain" source={require('./icons/success.png')}></Image>
                    <Text style={styles.jobcreateone, {
                        textAlign: 'center', fontSize: 20,
                        fontFamily: "Poppins-Bold",
                    }}>{Lang_chg.txt_acc_succ1[config.language]} {"\n"}
                        {Lang_chg.txt_acc_succ2[config.language]} {"\n"}
                        {Lang_chg.txt_acc_succ3[config.language]}</Text>


                    <View style={styles.login_btn}>
                        <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.props.navigation.navigate('Login') }}>
                            <Text style={styles.btn_txt}>{Lang_chg.txt_acc_succ4[config.language]}</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </View>
        )
    }
}
