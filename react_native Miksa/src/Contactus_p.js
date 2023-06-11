import React, { Component } from 'react'
import { Text,View,SafeAreaView,TouchableOpacity,Image,StatusBar,TextInput,Keyboard, } from 'react-native'
import color1 from './Colors'
import styles from "./Style.js";

export default class Contactus_p extends Component {
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
                    <Text style={styles.map_title}>Contact Us</Text>
                    <Text></Text>
                </View>

                <View style={styles.contact_body}>
                    <View>
                        <Text style={styles.contact_title}>Configure contact us email to be</Text>
                        <Text style={styles.contact_support_title}>‘Support.Android@wordown.com’</Text>
                    </View>

                   

                        <View style={styles.contact_box}>
                            <View style={styles.contact_Left}>
                            <Image resizeMode="contain" style={{width:20,height:20}} source={require('./icons/user.png')}></Image>
                            </View>
                            <View style={styles.contact_right}>
                            <TextInput style={styles.input_main} placeholder="First Name" onSubmitEditing={()=>{Keyboard.dismiss()}} returnKeyLabel='done' secureTextEntry={true}></TextInput>
                            </View>
                        </View>
                        <View style={styles.contact_box}>
                            <View style={styles.contact_Left}>
                            <Image resizeMode="contain" style={{width:20,height:20}} source={require('./icons/mail.png')}></Image>
                            </View>
                            <View style={styles.contact_right}>
                            <TextInput style={styles.input_main} placeholder="Email Address" onSubmitEditing={()=>{Keyboard.dismiss()}}  returnKeyLabel='done' onChangeText = {this.handleEmail}></TextInput>
                            </View>
                        </View>

                        <View style={styles.contact_box}>
                            <View style={styles.contact_Left}>
                            <Image resizeMode="contain" style={styles.contact_msgicon} source={require('./icons/edit.png')}></Image>
                            </View>
                            <View style={styles.contact_right}>
                            <TextInput
                   style={[styles.txtinput,{height:120,textAlignVertical:'top',fontSize:18,}]}
                    onChangeText={this.handleTextChange} 
                    multiline={true} 
                    placeholder="Enter Message"  
                    placeholderTextColor="#b8b8b8"  
                    /> 
                    </View>
                        </View>

                        <View style={styles.login_btn,{marginTop:10,width:'100%'}}>
                        <TouchableOpacity style={styles.btn_login} activeOpacity={0.9}  onPress={()=>{this.props.navigation.navigate('Setting_p')}}>
                            <Text style={styles.btn_txt}>Send</Text>
                        </TouchableOpacity>
                     </View>


                    </View>
                
                        

            </View>
        )
    }
}
