import React, { Component } from 'react'
import color1 from './Colors'
import {View,Dimensions,Text, SafeAreaView,StatusBar,Image,TouchableOpacity,StyleSheet,ScrollView,FlatList} from 'react-native';
const windowWidth  = Dimensions.get('window').width;
const windowHeight = Dimensions.get('window').height;

const data = [
    {
        'question'     : 'How can it help for tattoo?',
        'answer'       : 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        'status'       : false,   
    },
    {
        'question'     : 'How can it help for tattoo?',
        'answer'       : 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        'status'       : false,   
    },
    {
        'question'     : 'How can it help for tattoo?',
        'answer'       : 'Lorem Ipsum is simply dummy text of the printing and typesetting industry',
        'status'       : false,   
    },
];
 


class Fnew extends Component{   
    constructor(props){
        super(props)
        this.state = {
            showAnswer : false,
            faqdata:data,
          
          
      };
    }   
    
    question=(index)=>{
       let data=this.state.faqdata
        data[index].status=!data[index].status
        this.setState({faqdata:data})

    }
      render() {   
         
        return(
            <View style={{ flex: 1, backgroundColor: Colorss.white_color,alignItems:'center' }}>
            <SafeAreaView style={{ flex: 0 ,}} />
            <StatusBar barStyle='dark-content'  hidden={false} translucent={false}
                networkActivityIndicatorVisible={true} />

        <View   style={{backgroundColor:'white',
                        paddingHorizontal:'3%', 
                        flexDirection:'row',
                        justifyContent:'space-between' ,
                        height:windowHeight*8/100,
                        alignItems:'center',
                        elevation:5,
                        elevation:5,
                        shadowColor: "#000",
                        shadowOffset: {
                            width: 2,
                            height: 2,                           
                        },
                        width:'100%'                                                      
                        }}>                    
                <TouchableOpacity  onPress={() => this.props.navigation.goBack()}>
                <Image  style={styles.back}  source={require('./icons/back3.png')}></Image>
                </TouchableOpacity>  
                              
                <Text style={styles.text1}>FAQ</Text>  
                <Text></Text>
                              
                </View>
                <View style={{width:windowWidth*90/100, justifyContent:'flex-start',alignContent:'center'}}>
                <ScrollView>
                <Text style={styles.heading}>We are here to help you</Text>

              <FlatList
                            // showsHorizontalScrollIndicator={false}
                            // horizontal={this.state.isHorizontal}
                            data={this.state.faqdata}
                            renderItem={({ item, index }) => {
                                return (  
                    <View style={{width:'100%',alignSelf:'center'}}>
                 <View style={{borderWidth: 0.5,padding:6,justifyContent:'flex-start',
                                        alignItems:'flex-start',marginVertical:10}}>
                      <TouchableOpacity activeOpacity={1} style={{flexDirection:'row',
                                    // borderBottomWidth:0.5,  width:windowWidth*100/100,
                                    padding:8,justifyContent:'flex-start',
                                     }}  onPress={()=>{this.question(index)}} >              
                        <Text style={styles.text2}>{item.question}</Text>
                          <Image style={{
                                  width:'10%',
                                  height:'100%',
                                  alignSelf:'flex-end',                     
                                   resizeMode:'contain',                                                                             
                                  }} source ={require('./icons/back3.png')}>
                                 </Image>  
                
                                     
                    </TouchableOpacity> 
                   {item.status==true && <View style={{flexWrap:'wrap',width:'100%',alignSelf:'center'}}>
                  <View style={{ borderBottomColor: '#D0D7DE',width:'100%', borderBottomWidth:  1,}}></View>
                      <Text style={styles.text3}>{item.answer}</Text> 
                 </View>   }
                </View>      

                </View>
                )              
                        
                    }}
                 />       
                                    
               </ScrollView>
               </View>
               
        </View>
        )
    }
}
const styles = StyleSheet.create({
    heading:{
            fontSize:18, 
            textAlign:'center',
            fontFamily:'Poppins-Regular',
            paddingVertical:20
        },
    text2: {
            fontSize:16,           
            fontFamily:'Poppins-Regular',            
            width:'90%' ,
            
        },
    text3: {
            marginVertical:10,
            fontSize:14,           
            fontFamily:'Poppins-Regular',            
        width:'100%'
            
        },       
    text: {
        fontSize:16, 
        alignSelf:'center',
        fontFamily:'Poppins-Regular',
        // backgroundColor:'red',
        width:'90%'   
    },
    back:{        
        width:25,
        height:25
    },
    SizeImg: {  
        resizeMode:'contain',   
        alignSelf:'center', 
        height:windowHeight*5/100,
        width:windowWidth*5/100
    },
    text1: {        
        fontSize:20,
        fontFamily:'Poppins-Bold'
                    
    }
})
export default Fnew;