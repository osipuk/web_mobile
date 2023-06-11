import React, { Component } from 'react'
import { Text, View, SafeAreaView, StatusBar, Image, TouchableOpacity, BackHandler } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider, mediaprovider, Cameragallery, Mapprovider } from './Provider/utilslib/Utils';
export default class Job_complete extends Component {

    _didFocusSubscription;
    _willBlurSubscription;
    constructor(props) {
        super(props)
        this.state = {
            job_number: this.props.route.params.job_number,
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
        return true;
    };
    backpress = () => {
        this.props.navigation.goBack();
    }

    render() {
        return (
            <View style={{ flex: 1, backgroundColor: color1.theme_app }}>
                <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
                <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
                    networkActivityIndicatorVisible={true} />
                <View style={styles.create_success_view}>
                    <Image style={styles.successimg} resizeMode="contain" source={require('./icons/success.png')}></Image>
                    <Text style={styles.jobcreateone}>{Lang_chg.txt_job_suuc1[config.language]}</Text>
                    <Text style={styles.jobcreateid}>{Lang_chg.txt_job_job_id[config.language]}: {this.state.job_number}</Text>
                    {/* <Text style={styles.jobcreatedates}>{Lang_chg.txt_job_date1[config.language]}: {this.state.createtime}</Text> */}
                    <View style={{ alignItems: 'center', justifyContent: 'center', width: '75%', alignSelf: 'center', marginBottom: 20, marginTop: 10 }}>
                        <TouchableOpacity style={styles.btn_login} activeOpacity={0.9} onPress={() => { this.props.navigation.navigate('Home_p') }}>
                            <Text style={styles.btn_txt}>{Lang_chg.txt_job_ok[config.language]}</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </View>
        )
    }
}
