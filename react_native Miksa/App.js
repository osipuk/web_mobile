import React, { Component } from 'react'
import { Text, View, Image, TouchableOpacity, SafeAreaView, StatusBar, Platform } from 'react-native'
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import { firebaseprovider } from './src/Provider/FirebaseProvider';
import { DrawerActions } from '@react-navigation/native';
import { AppProvider, AppConsumer } from './src/Provider/context/AppProvider';
import Splash from './src/Splash';
import Banner from './src/Banner';
import Login from './src/Login';
import Forgot from './src/Forgot';
import Signup from './src/Signup';
import Home_customer from './src/Home_customer';
import Search_pro from './src/Search_pro';
import Notifications from './src/Notifications';
import My_booking from './src/My_booking';
import Saved from './src/Saved';
import My_profile from './src/My_profile';
import Create_jobs from './src/Create_jobs';
import Ratings from './src/Ratings';
import Edit_profile from './src/Edit_profile';
import Wallet from './src/Wallet';
import Terms from './src/Terms';
import Privacy from './src/Privacy';
import Contactus from './src/Contactus';
import Faq from './src/Faq';
import Other_profile from './src/Other_profile';
import Select_provider from './src/Select_provider';
import Cretae_job_detail from './src/Cretae_job_detail';
import Card from './src/Card';
import Create_success from './src/Create_success';
import Inbox from './src/Inbox';
import Chat from './src/Chat';
import Bank_dt from './src/Bank_dt';
import House_profile from './src/House_profile';
import Select_service_p from './src/Select_service_p';
import House_sketch from './src/House_sketch';
import Bio from './src/Bio';
import Upload_covid from './src/Upload_covid';
import Account_succ from './src/Account_succ';
import Home_p from './src/Home_p';
import Inbox_p from './src/Inbox_p';
import Search_pro_p from './src/Search_pro_p';
import All_jobs_p from './src/All_jobs_p';
import Report_p from './src/Report_p';
import Saved_p from './src/Saved_p';
import My_profile_p from './src/My_profile_p';
import Setting_p from './src/Setting_p';
import Edit_profile_p from './src/Edit_profile_p';
import Change_password_p from './src/Change_password_p';
import Terms_p from './src/Terms_p';
import Privacy_p from './src/Privacy_p';
import Wallet_p from './src/Wallet_p';
import Contactus_p from './src/Contactus_p';
import Forgot_change_pass from './src/Forgot_change_pass';
import Change_user_services from './src/Change_user_services';
import Change_covid from './src/Change_covid';
import House_sketch_change from './src/House_sketch_change';
import Details_job_c from './src/Details_job_c';
import Job_edit from './src/Job_edit';
import Details_job_p from './src/Details_job_p';
import Earnings_p from './src/Earnings_p';
import Fnew from './src/Fnew';
import Edit_bank_details from './src/Edit_bank_details';
import Job_complete from './src/Job_complete';
import Report_job from './src/Report_job';
import Cancel_job from './src/Cancel_job';





const Stack = createStackNavigator();

const Stacknav = (navigation) => {
  return (
    <Stack.Navigator
      initialRouteName={'Splash'}
    >
      <Stack.Screen name='Splash' component={Splash} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Banner' component={Banner} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Login' component={Login} options={{ headerShown: false, gestureEnabled: false }}></Stack.Screen>
      <Stack.Screen name='Forgot' component={Forgot} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Signup' component={Signup} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Search_pro' component={Search_pro} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Create_jobs' component={Create_jobs} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Ratings' component={Ratings} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Edit_profile' component={Edit_profile} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Wallet' component={Wallet} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Terms' component={Terms} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Privacy' component={Privacy} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Contactus' component={Contactus} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Faq' component={Faq} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Other_profile' component={Other_profile} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Select_provider' component={Select_provider} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Cretae_job_detail' component={Cretae_job_detail} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Card' component={Card} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Create_success' component={Create_success} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Inbox' component={Inbox} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Chat' component={Chat} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Bank_dt' component={Bank_dt} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='House_profile' component={House_profile} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Select_service_p' component={Select_service_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='House_sketch' component={House_sketch} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Bio' component={Bio} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Upload_covid' component={Upload_covid} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Account_succ' component={Account_succ} options={{ headerShown: false }}></Stack.Screen>

      <Stack.Screen name='Inbox_p' component={Inbox_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Search_pro_p' component={Search_pro_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='All_jobs_p' component={All_jobs_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Report_p' component={Report_p} options={{ headerShown: false }}></Stack.Screen>



      <Stack.Screen name='Setting_p' component={Setting_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Edit_profile_p' component={Edit_profile_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Change_password_p' component={Change_password_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Terms_p' component={Terms_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Privacy_p' component={Privacy_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Wallet_p' component={Wallet_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Contactus_p' component={Contactus_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Fnew' component={Fnew} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Forgot_change_pass' component={Forgot_change_pass} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Change_user_services' component={Change_user_services} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Change_covid' component={Change_covid} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='House_sketch_change' component={House_sketch_change} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Details_job_c' component={Details_job_c} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Job_edit' component={Job_edit} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Details_job_p' component={Details_job_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Earnings_p' component={Earnings_p} options={{ headerShown: false }}></Stack.Screen>


      <Stack.Screen name='Home_p' component={Home_p} options={{ headerShown: false, gestureEnabled: false }}></Stack.Screen>
      <Stack.Screen name='Notifications' component={Notifications} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Saved_p' component={Saved_p} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='My_profile_p' component={My_profile_p} options={{ headerShown: false }}></Stack.Screen>

      <Stack.Screen name='Home_customer' component={Home_customer} options={{ headerShown: false, gestureEnabled: false }}></Stack.Screen>
      <Stack.Screen name='My_booking' component={My_booking} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Saved' component={Saved} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='My_profile' component={My_profile} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Edit_bank_details' component={Edit_bank_details} options={{ headerShown: false }}></Stack.Screen>
      <Stack.Screen name='Job_complete' component={Job_complete} options={{ headerShown: false, gestureEnabled: false }}></Stack.Screen>
      <Stack.Screen name='Report_job' component={Report_job} options={{ headerShown: false, gestureEnabled: false }}></Stack.Screen>
      <Stack.Screen name='Cancel_job' component={Cancel_job} options={{ headerShown: false, gestureEnabled: false }}></Stack.Screen>
    </Stack.Navigator>

  );
}



export default class App extends Component {
  componentDidMount() {
    firebaseprovider.getAllUsers()
  }
  render() {
    return (
      <NavigationContainer>
        <View style={{ flex: 1, backgroundColor: '#fff' }}>
          <AppProvider {...this.props}>
            <AppConsumer>{funcs => {
              global.props = { ...funcs }
              return <Stacknav />
            }}
            </AppConsumer>
          </AppProvider>
        </View>
      </NavigationContainer>
    );
  }
}