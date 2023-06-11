import { config } from '../configProvider';
import {notification} from '../NotificationProvider';
import {Dimensions} from 'react-native';
import { localStorage }  from '../localStorageProvider';
import {Lang_chg}  from '../Language_provider';
import {consolepro} from '../Messageconsolevalidationprovider/Consoleprovider'
import { msgProvider, msgTitle, msgText } from '../Messageconsolevalidationprovider/messageProvider';
// import { validation} from '../Messageconsolevalidationprovider/Validation_provider';
import {Currentltlg} from '../Curentlatlong';
import Cameragallery from '../Mediaprovider/Cameragallery';
import  {mediaprovider} from '../Mediaprovider/Mediaprovider'
import {SocialLogin} from '../Apicallingprovider/SocialLoginProvider';
import {apifuntion} from '../Apicallingprovider/apiProvider';
import {validationprovider} from '../Validation_provider';
import {Colors,Font} from '../Colorsfont';
// import {localimag} from '../Localimageprovider/Localimage';
import {firebaseprovider} from '../FirebaseProvider'
import Mapprovider from '../Mapprovider';
// import Otpprovider from '../Otpprovider';
 const mobileH = Math.round(Dimensions.get('window').height);
const mobileW = Math.round(Dimensions.get('window').width);

export {config,apifuntion,Colors,Font,mobileH,mobileW,localStorage,Lang_chg,consolepro,msgProvider,msgTitle,msgText,Currentltlg,Mapprovider,validationprovider,SocialLogin,mediaprovider,Cameragallery,notification,firebaseprovider}

