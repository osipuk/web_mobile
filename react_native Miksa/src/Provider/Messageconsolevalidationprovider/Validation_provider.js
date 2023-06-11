import {msgProvider,msgText,msgTitle,config} from '../utilslib/Utils';
class Validation_provider {
   emptyEmail = ['Please enter email or phone', 'التحقق من صحة'];
	validEmail=['Please enter valid email']
	emptyPassword = ['Please enter password', 'التحقق من صحة'];
	lengthPassword=['Password length should be minimum 8 character'];
	emptynewPassword=['Please enter new password', 'التحقق من صحة'];
	emptyconfirmPassword=['Please enter new password', 'التحقق من صحة'];
	emptyconfirm=['please enter right password'];
  //-------------------- Registration messages ---------------
	emptyFirstName = ['Please enter first name', 'التحقق من صحة'];
	emptyLastName = ['Please enter last name', 'التحقق من صحة'];
	emptyPhone = ['Please enter phone number', 'التحقق من صحة'];
   lengthPhone=['Password length should be minimum 10 digit'];
	//-------------------- Registration messages ---------------
	loginFirst = ['Please login first', 'التحقق من صحة'];
	emptyContactResion = ['Please select contact reason', 'التحقق من صحة'];
	emptyContactMessage = ['Please enter message', 'التحقق من صحة'];
   networkconnection=['Unable to connect. Please check that you are connected to the Internet and try again.','Unable to connect. Please check that you are connected to the Internet and try again.'];
   servermessage=['An Unexpected error occured , Please try again .If the problem continues , Please do contact us','An Unexpected error occured , Please try again .If the problem continues , Please do contact us'];

   // ________________________________ end validation___________________________________________

   usernotallow_validation(props,pagename){
      console.log('navigation',props)
       console.log('navigation',props.navigation)
        Alert.alert(
         msgTitle.information[config.language],
         msgTitle.account_deactivate_title[config.language],
          [
               {
                  text: msgTitle.ok[config.language],
                  onPress: () => { localStorage.removeItem('user_arr');
                  localStorage.clear();
                  props.navigation.navigate(pagename)},
               },
           ],
          { cancelable: false },
      );
}
 getDateTime=()=> {
   var now     = new Date();
   var year    = now.getFullYear();
   var month   = now.getMonth()+1;
   var day     = now.getDate();
   var hour    = now.getHours();
   var minute  = now.getMinutes();
   var second  = now.getSeconds();
   if(month.toString().length == 1) {
        month = '0'+month;
   }
   if(day.toString().length == 1) {
        day = '0'+day;
   }
   if(hour.toString().length == 1) {
        hour = '0'+hour;
   }
   if(minute.toString().length == 1) {
        minute = '0'+minute;
   }
   if(second.toString().length == 1) {
        second = '0'+second;
   }
   var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;
    return dateTime;
}
}
export const validation = new Validation_provider();