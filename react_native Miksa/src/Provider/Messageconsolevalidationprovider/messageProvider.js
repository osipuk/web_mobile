import { Alert,ToastAndroid ,Platform} from "react-native";
import Toast from 'react-native-simple-toast';
//--------------------------- Message Provider Start -----------------------
class messageFunctionsProviders {
        toast(message,position){
			if(position=='center')
			{
				Toast.showWithGravity(message, Toast.SHORT, Toast.CENTER);
		   }
			else if(position=='top')
			{
				Toast.showWithGravity(message, Toast.SHORT, Toast.TOP);
			}
			else if(position=='bottom')
			{
				Toast.showWithGravity(message, Toast.SHORT, Toast.BOTTOM);
				
			}
			else if(position=='long')
			{
				Toast.showWithGravity(message, Toast.LONG, Toast.CENTER);
		    }
			
		}
	 
	   alert(title, message, callback) {
		if(callback === false){
			Alert.alert(
				title,
				message,
				[
					{
						text: msgTitle.ok[0], 
					},
				],
				{cancelable: false},
			);
		}else{
			Alert.alert(
				title,
				message,
				[
					{
						text: msgTitle.ok[0], 
						onPress: () => callback,
					},
				],
				{cancelable: false},
			);
		}
		
       }

       confirm(title, message, callbackOk, callbackCancel) {
    	if(callbackCancel === false){
    		Alert.alert(
				title,
				message,
				[
					{
						text: msgTitle.cancel[0], 
					},
					{
						text: msgTitle.ok[0], 
						onPress: () =>  this.btnPageLoginCall(),
					},
				],
				{cancelable: false},
			);
    	}else{
    		Alert.alert(
				title,
				message,
				[
					{
						text: msgTitle.cancel[0], 
						onPress: () => callbackCancel,
					},
					{
						text: msgTitle.ok[0], 
						onPress: () => callbackOk,
					},
				],
				{cancelable: false},
			);
    	}
		
        }

      later(title, message, callbackOk, callbackCancel, callbackLater) {
		Alert.alert(
			title,
			message,
			[
				{
					text: 'Ask me later', 
					onPress: () => msgTitle.later[0],
				},
				{
					text: 'Cancel', 
					onPress: () => msgTitle.cancel[0],
				},
				{
					text: 'OK', 
					onPress: () => msgTitle.ok[0],
				},
			],
			{cancelable: false},
		);
	   }


}

//--------------------------- Title Provider Start -----------------------

class messageTitleProvider {
	//----------------- message buttons
	ok = ['Ok','Okay','Está bem' ];
	cancel = ['Cancel', 'Cancelar','Cancelar'];
	later = ['Later', 'Más tarde','Mais tarde'];

	//--------------- message title 
	information = ['Information Message','Mensaje informativo','Mensagem Informativa' ];
	alert = ['Alert','Alerta','Alerta' ];
	confirm = ['Information Message','Mensaje informativo','Mensagem Informativa' ];
	validation = ['Information Message', 'Mensaje informativo','Mensagem Informativa'];
	success = ['Information Message', 'Mensaje informativo','Mensagem Informativa'];
	error = ['Information Message', 'Mensaje informativo','Mensagem Informativa'];
	response = ['Response', 'Respuesta','Resposta'];
	server=['Connection Error','Error de conexión','Erro de conexão'];
	internet=['Connection Error','Error de conexión','Erro de conexão']
	deactivate_msg=['Account deactived']
	deactivate=[0,]
	usernotexit=["User id does not exist"]
	account_deactivate_title=['your account deactivated please try again']
}

//--------------------------- Message Provider Start -----------------------

class messageTextProvider {
	
	 loginFirst = ['Please login first', 'التحقق من صحة'];
	 emptyContactResion = ['Please select contact reason', 'التحقق من صحة'];
	 emptyContactMessage = ['Please enter message', 'التحقق من صحة'];
     networkconnection=['Unable to connect. Please check that you are connected to the Internet and try again.','Unable to connect. Please check that you are connected to the Internet and try again.'];
     servermessage=['An Unexpected error occured , Please try again .If the problem continues , Please do contact us','An Unexpected error occured , Please try again .If the problem continues , Please do contact us'];

}

export const msgText = new messageTextProvider();
export const msgTitle = new messageTitleProvider();
export const msgProvider = new messageFunctionsProviders();
//--------------------------- Message Provider End -----------------------