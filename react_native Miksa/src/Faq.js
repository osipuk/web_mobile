import React, { Component } from 'react'
import { View, Dimensions, Text, SafeAreaView, StatusBar, Image, TouchableOpacity, StyleSheet, ScrollView, FlatList } from 'react-native';
import color1 from './Colors'
import styles from "./Style.js";
import { config, apifuntion, localStorage, Lang_chg, consolepro, msgProvider } from './Provider/utilslib/Utils';

const windowWidth = Dimensions.get('window').width;
const windowHeight = Dimensions.get('window').height;




export default class Faq extends Component {

   constructor(props) {
      super(props)
      this.state = {
         showAnswer: false,
         faqdata: "NA",
      };
      this.getFaq();
   }


   getFaq = async () => {
      let result = await localStorage.getItemObject('user_arr')
      let user_id_post = 0;
      let user_type = 0;
      if (result != null) {
         user_id_post = result.user_id;
         user_type = result.user_type;

      }
      let url = config.baseURL + "faq_get.php?user_id_post=" + user_id_post + "&user_type=" + user_type;
      consolepro.consolelog('bank data', url);
      apifuntion.getApi(url).then((obj) => {
         consolepro.consolelog('bank data', obj);
         if (obj.success == 'true') {
            if (obj.bank_details != 'NA') {
               this.setState({
                  faqdata: obj.faq_arr
               })
            }
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



   question = (index) => {
      let data = this.state.faqdata
      for (var i = 0; i < data.length; i++) {
         data[i].status = false;
      }
      data[index].status = !data[index].status
      this.setState({ faqdata: data })
   }



   backpress = () => {
      this.props.navigation.goBack();
   }

   render() {
      return (
         <View style={{ flex: 1, height: '100%', backgroundColor: '#ffffff', }}>
            <SafeAreaView style={{ flex: 0, backgroundColor: '#ffffff' }} />
            <StatusBar backgroundColor={color1.white_color} barStyle='default' hidden={false} translucent={false}
               networkActivityIndicatorVisible={true} />

            <View style={styles.map_top}>
               <TouchableOpacity activeOpacity={0.9} onPress={() => { this.backpress() }}>
                  <Image resizeMode="contain" style={{ width: 20, height: 20 }} source={require('./icons/back2.png')}></Image>
               </TouchableOpacity>
               <Text style={styles.map_title}>{Lang_chg.txt_faq_faq[config.language]}</Text>
               <Text></Text>
            </View>
            <View style={{ width: windowWidth * 100 / 100, justifyContent: 'flex-start', alignContent: 'center' }}>
               <ScrollView>
                  <Text style={styles.headingfaq}>{Lang_chg.txt_faq_faq1[config.language]}</Text>

                  <FlatList
                     // showsHorizontalScrollIndicator={false}
                     // horizontal={this.state.isHorizontal}
                     contentContainerStyle={{ paddingBottom: 90 }}
                     data={this.state.faqdata}
                     renderItem={({ item, index }) => {
                        return (
                           <View style={{
                              width: '90%', alignSelf: 'center', borderWidth: 1,
                              borderColor: '#ccc', marginTop: 20,
                           }}>
                              <View style={{
                                 padding: 6, justifyContent: 'flex-start',
                                 alignItems: 'flex-start', marginVertical: 5
                              }}>
                                 <TouchableOpacity activeOpacity={1} style={{
                                    flexDirection: 'row',
                                    padding: 8,
                                    alignItems: "flex-start"
                                 }} onPress={() => { this.question(index) }} >
                                    <Text style={styles.text2}>{item.question}</Text>
                                    <Image style={{
                                       marginTop: 5,
                                       width: 14,
                                       height: 14,
                                       resizeMode: 'contain',
                                    }} source={require('./icons/down1.png')}>
                                    </Image>


                                 </TouchableOpacity>
                                 {item.status == true && <View style={{ flexWrap: 'wrap', width: '100%', alignSelf: 'center' }}>
                                    <View style={{ borderColor: '#D0D7DE', width: '100%', borderWidth: 1, }}></View>
                                    <Text style={styles.text3}>{item.answer}</Text>
                                 </View>}
                              </View>

                           </View>
                        )

                     }}
                     keyExtractor={item => item.faq_id}
                  />

               </ScrollView>
            </View>
         </View>
      )
   }
}
