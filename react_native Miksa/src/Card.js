import React, { Component } from 'react'
import { Text,View,SafeAreaView,StatusBar,TouchableOpacity,Image,ScrollView,TextInput} from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";

export default class Card extends Component {
    backpress=()=>{
        this.props.navigation.goBack();
    } 
         
    render() {
        return (
            <View style={{ flex: 1,backgroundColor:color1.theme_app }}>
            <SafeAreaView style={{ flex: 0, backgroundColor:'#ffffff'}}/>
            <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
               networkActivityIndicatorVisible={true} />
               <View style={styles.map_top}>
            <TouchableOpacity activeOpacity={0.9}  onPress={()=>{this.backpress()}}>
                <Image resizeMode="contain" style={{width:20,height:20}} source={require('./icons/back2.png')}></Image>
             </TouchableOpacity>
                <Text></Text>
                <Text></Text>
            </View>

            <ScrollView showsVerticalScrollIndicator={false}>

                
                <View  style={[styles.card_title,{backgroundColor:color1.theme_color}]}>
                    <Text style={styles.entercard}>Enter Card Detail</Text>
                    <Text style={styles.cardpsg}>Please enter credit card or debit cad detail 
                    {"\n"}for instaant payment</Text>
                    <Image style={styles.cardline_Icon} resizeMode="contain" source={require('./icons/ine.png')}></Image>
                </View>

                <View style={[styles.card_view,{backgroundColor:color1.theme_app}]}>

                <View style={styles.card_box}>
                    <View style={styles.login_pass}>
                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/voter.png')}></Image>
                    </View>
                    <View style={styles.right_view}>
                        <TextInput style={styles.input_main_card}  placeholder="Enter Cards Number" onSubmitEditing={()=>{Keyboard.dismiss()}} returnKeyLabel='done' ></TextInput>
                    </View>
                </View>
                <View style={styles.card_box}>
                    {/* <View style={styles.login_pass}>
                    <Image style={styles.contact_Icon} resizeMode="contain" source={require('./icons/voter.png')}></Image>
                    </View> */}
                    <View style={styles.right_view}>
                        <TextInput style={styles.input_main_card}  placeholder="Account Holder Name" onSubmitEditing={()=>{Keyboard.dismiss()}} returnKeyLabel='done' ></TextInput>
                    </View>
                </View>
                <View style={styles.card_cvv}>

                <View style={styles.card_box_left}>
                    <View style={styles.right_view}>
                        <TextInput style={styles.input_main_card}  placeholder="Expiry Date" onSubmitEditing={()=>{Keyboard.dismiss()}} returnKeyLabel='done' ></TextInput>
                    </View>
                </View>
                <View style={styles.card_box_left}>
                    <View style={styles.right_view}>
                        <TextInput style={styles.input_main_card}  placeholder="Cvv" onSubmitEditing={()=>{Keyboard.dismiss()}} returnKeyLabel='done' ></TextInput>
                    </View>
                </View>
                </View>
             <View style={styles.login_btn,{margin:50,}}>
                <TouchableOpacity style={styles.btn_login} activeOpacity={0.9}  onPress={()=>{this.props.navigation.navigate('Create_success')}}>
                    <Text style={styles.btn_txt}>Pay Now</Text>
                </TouchableOpacity>
             </View>

               
                </View>
            


          
            </ScrollView>


            </View>
        )
    }
}
