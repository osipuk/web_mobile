import React, { Component } from 'react'
import { Text,View,SafeAreaView,StatusBar,TouchableOpacity,Image,ScrollView} from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";

export default class Terms_p extends Component {
backpress=()=>{
    this.props.navigation.goBack();
} 
    render() {
        return (
            <View style={{ flex: 1,backgroundColor:color1.theme_app }}>
            <SafeAreaView style={{ flex: 0, backgroundColor:'#ffffff' }}/>
            <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
               networkActivityIndicatorVisible={true} />

            <View style={styles.map_top}>
            <TouchableOpacity activeOpacity={0.9}  onPress={()=>{this.backpress()}}>
                <Image resizeMode="contain" style={{width:20,height:20}} source={require('./icons/back2.png')}></Image>
             </TouchableOpacity>
                <Text style={styles.map_title}>Terms Of Service</Text>
                <Text></Text>
            </View>
            <ScrollView showsVerticalScrollIndicator={false}>
            <View style={styles.terms_body}>
           
               
                    <Text style={styles.terms_txt_setting}>
                        Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy
                        text ever since the 1500s, when an unknown printer took a 
                        galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap
                        into electronic typesetting, remaining.Lorem Ipsum is 
                        simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text
                        ever since the 1500s, when an unknown printer took a 
                        galley of type and scrambled it to make a type specimen
                        book. It has survived not only five centuries, but also
                        the leap into electronic typesetting, remaining.Lorem
                        Ipsum is simply dummy text of the printing and 
                        typesetting industry. Lorem Ipsum has been the 
                        industry's standard dummy text ever since the 
                        1500s, when an unknown printer took a galley of
                        type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also 
                        the leap into electronic typesetting, remaining.Lorem
                        Ipsum is simply dummy text of the printing and 
                        typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the
                        1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen
                        book. It has survived not only five centuries,
                        but also the leap into electronic typesetting,
                        remaining.Lorem Ipsum is simply dummy text of
                        the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy 
                        text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled 
                    </Text>
                
            </View>
            </ScrollView>
            </View>
        )
    }
}
