import { StyleSheet, Dimensions, Platform } from 'react-native';
const windowWidth = Dimensions.get('window').width;
const windowheight = Dimensions.get('window').height;
import color1 from './Colors'
const styles = StyleSheet.create({

  Banner_bg: {
    height: 300,
    width: '100%',
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#0088e0',
  },

  banner_main_logo: {
    height: 170,
    width: 170,
    resizeMode: 'cover',
  },

  // Login
  view_input: {
    flexDirection: 'row',
    borderBottomWidth: 1,
    borderBottomColor: '#0088e0',
    marginBottom: 15,
    width: '90%',
    alignItems: 'center',
    alignSelf: 'center'
  },
  loginParent: {
    height: '60%',
    width: '100%',
    alignSelf: 'center',
    backgroundColor: '#fff',
    marginTop: -30,
    borderTopEndRadius: 30,
    borderTopLeftRadius: 30,
    paddingTop: 10,
    marginBottom: 30,
  },
  contact_Icon: {
    width: 20,
    height: 20,
    marginRight: 10,
    marginTop: 3,
  },

  left_view: {
    width: '20%',
    borderRightWidth: 1,
    borderColor: '#b8b8b8',
    marginTop: 15,
    paddingRight: 10,
  },
  right_view: {
    width: '80%',
  },
  icon_number: {
    flexDirection: 'row',
    alignItems: "center",
  },
  textleft: {
    color: '#000',
    fontSize: 18,
    fontFamily: "Poppins-Medium",
  },
  textleft1: {
    color: '#000',
    fontSize: 14,
    fontFamily: "Poppins-Medium",
  },
  input_main: {
    height: 50,
    paddingLeft: 15,
    fontSize: 18,
  },
  input_main12: {
    height: 50,
    paddingLeft: 15,
    fontSize: 14,
  },
  login_pass: {
    width: '10%',
  },
  login_email: {
    width: 20,
    height: 20,
    borderRadius: 100,
  },

  forgot_view: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    // alignItems:"flex-end",
    width: '90%',
    alignSelf: 'center',
  },
  forgot_txt: {
    fontFamily: 'Poppins-Regular',
    color: '#848484',
    textDecorationLine: "underline",
    textDecorationStyle: "solid",
    textDecorationColor: "#000",
  },
  btn_login: {
    width: '100%',
    backgroundColor: '#42a7e8',
    height: 50,
    alignItems: 'center',
    justifyContent: 'center',
    alignSelf: 'center',
    borderRadius: 50,
  },
  login_btn: {
    alignItems: 'center',
    justifyContent: 'center',
    width: '90%',
    alignSelf: 'center',
    marginBottom: 20,
  },
  btn_txt: {
    alignItems: 'center',
    alignSelf: 'center',
    // lineHeight: 60,
    fontFamily: 'Poppins-Regular',
    color: '#fff',
    fontSize: 18,
  },
  loginAnd: {
    textAlign: 'center',
    marginTop: 20,
    fontFamily: 'Poppins-Regular',
    color: '#000'
  },

  loginMedia: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    alignSelf: 'center',
    marginBottom: 20,
    marginTop: 20,
  },
  media_img: {
    width: 70,
    height: 70,
  },
  login_signt_text: {
    textAlign: 'center',
    fontFamily: 'Poppins-Bold',
    fontSize: 13,
    marginTop: 20,
    color: '#6b6b6b'
  },
  sign_color_Txt: {
    textAlign: 'center',
    fontFamily: 'Poppins-Bold',
    fontSize: 14,
    color: '#0088e0',
    textDecorationLine: "underline",
    textDecorationStyle: "solid",
    textDecorationColor: "#000",
  },
  passEye: {
    width: '10%',
  },

  //Forgot

  forgotTitle: {
    textAlign: 'center',
    fontSize: 28,
    fontFamily: 'Poppins-Bold',
    color: '#584b4b',
    marginTop: 10,
  },
  forgot_p: {
    textAlign: 'center',
    fontFamily: "Poppins-Medium",
    fontSize: 16,
    color: '#584b4b',
  },
  forgot_viewTop: {
    marginBottom: 30,
    marginHorizontal: windowWidth * 0.025,
  },

  //signup

  signup_tab: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    width: '100%',
    alignItems: 'center',
    alignSelf: 'center',
  },
  customerbtn: {
    fontSize: 22,
    fontFamily: "Poppins-Bold",
    color: '#939090',
  },
  customerbtn_select: {
    fontSize: 23,
    fontFamily: "Poppins-Bold",
    color: '#0088e0',
  },

  signup_addres: {
    fontSize: 18,
    color: '#939090',
    fontFamily: "Poppins-Regular",
    marginLeft: 17,
  },
  map_location: {
    width: '100%',
    height: '100%',
  },

  map_top: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingTop: 10,
    paddingBottom: 10,
    paddingLeft: 20,
    paddingRight: 20,
    backgroundColor: '#0088e0',
  },
  map_title: {
    fontSize: 16,
    color: '#fff',
    fontFamily: "Poppins-Regular",
  },
  location_search: {
    backgroundColor: '#fff',
    flexDirection: 'row',
    paddingLeft: 20,
    paddingRight: 20,
    borderBottomWidth: 1,
    borderColor: '#ccc'
  },


  map_View_new: {
    flexDirection: 'row',
    borderBottomWidth: 1,
    borderBottomColor: '#0088e0',
    marginBottom: 15,
    // paddingLeft:20,
    // paddingRight:20,
    width: '90%',
    alignItems: 'center',
    alignSelf: 'center',
    paddingBottom: 10,
    marginTop: 10,
  },


  downArrow: {
    width: 20,
    height: 20,
    marginRight: 10,
    marginTop: 3,
    justifyContent: 'flex-end',
  },

  signupselect: {
    width: '40%',
  },

  baseMentBox: {
    flexDirection: 'row',
    borderBottomWidth: 1,
    borderBottomColor: '#0088e0',
    marginBottom: 15,
    // paddingLeft:20,
    // paddingRight:20,
    width: '90%',
    alignItems: 'center',
    alignSelf: 'center',
    paddingBottom: 10,
    paddingTop: 10,

  },
  sign_select_ttle: {
    width: '35%',
  },
  right_yesNo: {
    width: '55%',
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  yesNotxt: {
    marginTop: 5,
    fontSize: 18,
    fontFamily: "Poppins-Regular",
    color: '#b8b8b8',
  },

  radio_title: {
    fontSize: 17,
    color: '#939090',
    fontFamily: "Poppins-Regular",
    marginLeft: 17,
  },

  terms_txt: {
    textAlign: 'center',
    fontFamily: "Poppins-Bold",
    fontSize: 12,
  },

  termsMainSign: {
    textDecorationLine: "underline",
    textDecorationStyle: "solid",
    textDecorationColor: "#000",
  },
  sign_term: {
    width: '90%',
    alignSelf: 'center',
    marginTop: 20,
  },
  signup_main: {
    backgroundColor: '#fff',
    borderTopLeftRadius: 30,
    borderTopRightRadius: 30,
    marginTop: -30,
    paddingTop: 20,
  },

  //country popup
  countryPopupTop: {
    backgroundColor: '#0088e0',
  },
  search_bar: {
    backgroundColor: '#fff',
  },
  select_country: {
    backgroundColor: '#000'
  },
  flag_text_detail: {
    color: '#000',
  },
  country_header: {
    flexDirection: 'row',
    paddingLeft: 20,
    paddingRight: 20,
    borderBottomWidth: 1,
    borderColor: '#f5f5f5',
    width: '90%',
    alignItems: 'center',
    alignSelf: 'center',
    marginTop: 20,
    borderRadius: 5,
  },
  country_close: {
    color: '#fff',
    fontFamily: 'Poppins-Regular'
  },
  county_view: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 10,
    width: '90%',
    alignSelf: 'center',

  },
  country_code: {
    fontFamily: 'Poppins-Bold',
    fontSize: 12,
  },
  country_name: {
    fontFamily: 'Poppins-Regular',
    marginRight: 10,
    marginLeft: 10,
    color: '#686868',
    marginTop: 8,
  },
  search_location_input: {
    height: 50,
  },

  /// otp pop start ===================
  otptitle: {
    fontFamily: "Poppins-Medium",
    fontSize: 26,
    textAlign: 'center',
    marginTop: 10,
  },
  optTxt: {
    textAlign: 'center',
    fontFamily: "Poppins-Medium",
    fontSize: 14,
  },
  otpInpoutType: {
    borderWidth: 1,
    borderColor: '#ccc',
    width: '90%',
    alignSelf: 'center',
    textAlign: 'center',
    height: 50,
    marginTop: 15,
    marginBottom: 20,
  },
  verifyBox: {
    flexDirection: 'row',
    borderTopWidth: 1,
    borderColor: '#ccc',
    marginTop: 10,
  },
  resendboxLeft: {
    width: '50%',
    justifyContent: 'center',
    alignSelf: 'center',
    alignItems: 'center',
    borderRightWidth: 1,
    borderColor: '#ccc',
    paddingTop: 12,
    paddingBottom: 12,
  },
  resendbox: {
    width: '50%',
    justifyContent: 'center',
    alignSelf: 'center',
    alignItems: 'center',
    paddingTop: 12,
    paddingBottom: 12,
  },
  OTpLeftverify: {
    color: '#0e81ff',
    fontFamily: "Poppins-Medium",
    fontSize: 16,
  },

  //select location

  bodyView: {
    width: '90%',
    alignSelf: 'center',
  },
  back_img: {
    width: 20,
    height: 20,
  },
  header_select: {
    paddingTop: 10,
    paddingBottom: 10,
  },


  red_map: {
    height: windowheight / 8,
    resizeMode: 'contain',
    alignSelf: 'center',
  },
  select_location_box: {
    width: '90%',
    alignSelf: 'center',
    borderRadius: 8,
    paddingBottom: 20,
    paddingTop: 30,
    alignItems: 'center',

  },
  location_map: {
    textAlign: 'center',
    fontSize: 26,
    fontFamily: "Poppins-Bold",
    marginTop: 20,
  },
  location_map_psg: {
    textAlign: 'center',
    fontFamily: "Poppins-Medium",
  },
  location_notbtn: {
    textAlign: 'center',
    fontFamily: "Poppins-Medium",
    marginTop: 10,
  },


  //Home bank

  home_bani_title: {
    fontFamily: "Poppins-Bold",
    fontSize: 22,
    color: '#000',
  },
  home_search_icon: {
    width: 25,
    height: 25,
    marginTop: 5,
  },
  home_chat_icon: {
    width: 30,
    height: 30,
  },
  homebank_header_right: {
    flexDirection: 'row',
    justifyContent: 'flex-end',
    width: '23%',
  },
  homebank_header: {
    flexDirection: 'row',
    alignItems: 'center',
    // marginTop:20,
    width: '90%',
    alignSelf: 'center',
    alignItems: 'center',
    paddingTop: 15,
    paddingBottom: 15,
  },
  home_bank_header: {
    width: '77%',
  },
  home_slider: {
    width: windowWidth,
    alignItems: 'center',
    height: windowheight * 32 / 80,
    borderRadius: 25,
    justifyContent: 'center',
  },


  home_bank_option: {
    height: 20,
    width: 20,
    marginBottom: 10,
  },
  home_bank_option1: {
    height: 80,
    width: 80,
    marginBottom: 10,
  },
  name_bankhome: {
    fontFamily: 'Poppins-Medium',
    fontSize: 14,
    alignSelf: 'center',
    textAlign: "center"
  },
  list_bank_box20: {
    width: '90%',
    paddingTop: 40,
    paddingHorizontal: 20,
    alignItems: 'center',
    justifyContent: 'center',
    borderRadius: 10,
    height: windowWidth * 40 / 100,
    shadowOffset: { width: 0, height: 0, },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 8,
    backgroundColor: '#ffffff',
    shadowColor: '#ccc'
  },
  list_bank_box21: {
    width: '90%',
    paddingTop: 40,
    paddingHorizontal: 20,
    alignItems: 'center',
    justifyContent: 'center',
    borderRadius: 10,
    height: windowWidth * 40 / 100,
    shadowOffset: { width: 0, height: 0, },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 8,
    backgroundColor: '#ceedf6',
    shadowColor: '#ccc',
  },
  list_bank_box: {
    width: '90%',
    padding: 20,
    alignItems: 'center',
    justifyContent: 'center',
    borderRadius: 10,
    height: windowWidth * 50 / 100,
    shadowOffset: { width: 0, height: 0, },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 8,
    backgroundColor: '#ffffff',
    shadowColor: '#ccc'
  },
  list_bank_box1: {

    width: '90%',
    padding: 20,
    alignItems: 'center',
    justifyContent: 'center',
    borderRadius: 10,
    height: windowWidth * 50 / 100,
    shadowOffset: { width: 0, height: 0, },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 8,
    backgroundColor: '#ceedf6',
    shadowColor: '#ccc',
  },
  homebank_box: {
    flexDirection: 'row',
    width: '50%',
    alignItems: 'center',
    alignSelf: 'center',
    justifyContent: 'space-between',
    paddingHorizontal: 20,
  },

  //clict to open searc input

  input_main_header: {
    flexDirection: 'row',
    paddingRight: 15,
    paddingLeft: 15,
    marginBottom: 0,
    paddingTop: 5,
    paddingBottom: 5,
  },
  search_back_header: {
    width: '10%',
  },
  search_nav_right: {
    width: '90%',
  },
  search_header_back: {
    width: 20,
    height: 20,
    resizeMode: 'contain',
    marginTop: 15,
  },
  search_navbar: {
    paddingRight: 10,
    paddingLeft: 10,
    backgroundColor: '#e5e5e9',
    // borderRadius: 20,
    height: 40,
    marginTop: 5,
  },
  search_pro_header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingLeft: 20,
    paddingRight: 20,
    paddingTop: 10,
    paddingBottom: 15,
    alignItems: 'center',
    height: 65,
  },

  // Search properties

  header_search_pro_title: {
    color: '#fff',
    fontSize: 16,
    fontFamily: "Poppins-Medium",
    marginTop: 5,
  },
  search_proimg: {
    width: 50,
    height: 50,
    borderRadius: 100,
  },
  search_proName: {
    fontSize: 14,
    fontFamily: "Poppins-Bold",
  },
  search_pro_star: {
    width: 15,
    height: 15,
    marginRight: 2,
    marginTop: 2,
  },
  search_pro_star_seaction: {
    flexDirection: 'row',
  },
  search_pro_box: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 30,
    width: '90%',
    alignSelf: 'center',
  },
  search_pro_left: {
    width: '20%'
  },
  rewview_total_Seach: {
    color: '#92a3b8',
    fontSize: 14,
    marginLeft: 10,
  },
  search_pro_total: {
    width: '90%',
    alignSelf: 'center',
  },

  //Create Job
  cross_slider: {
    width: 25,
    height: 25,
  },
  slide_plus: {
    width: 20,
    height: 20,
    resizeMode: 'contain',
    alignItems: 'center',
    alignSelf: 'center',
    marginTop: 40,
    tintColor: color1.theme_color
  },
  Add_advertisment_show: {
    width: '100%',
    height: 98,
    borderRadius: 15,
    resizeMode: 'cover'
  },
  body_view: {
    width: '90%',
    alignSelf: 'center',
    paddingBottom: 50,
  },
  cretae_job_title: {
    fontSize: 18,
    fontFamily: "Poppins-Medium",
    marginTop: 10,
  },
  crete_job_psg: {
    fontFamily: "Poppins-Medium",
    fontSize: 14,
    lineHeight: 16,
  },
  upload_img_icon: {
    width: 100,
    height: 100,
    borderRadius: 10,
  },
  cretate_job_img: {
    flexDirection: 'row',
    // justifyContent: 'space-between',
    marginTop: 20,
    width: '100%'
  },

  upload_img: {
    borderRadius: 10,
  },

  create_input_titlejob: {
    height: 50,
    borderRadius: 28,
    // borderWidth: 1,
    // borderColor: '#ccc',
    marginHorizontal: 5,
    paddingLeft: 20,
    paddingRight: 20,
    shadowOffset: { width: 0, height: 0, },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 3,
    backgroundColor: '#fff',
    shadowColor: '#ccc',
  },
  create_input_landmark: {
    height: 70,
    borderRadius: 28,
    marginHorizontal: 5,
    paddingLeft: 20,
    paddingRight: 20,
    shadowOffset: { width: 0, height: 0, },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 3,
    backgroundColor: '#fff',
    shadowColor: '#ccc',
  },
  create_title_job: {
    fontSize: 16,
    fontFamily: "Poppins-Medium",
    marginTop: 30,
    marginBottom: 10,
    marginHorizontal: 5,
  },
  cretelocation_jobtxt: {
    color: '#b8b8b8',
    fontFamily: "Poppins-Medium",
  },

  crete_locationiconjob: {
    width: 20,
    height: 20,
  },
  crete_location_job: {
    flexDirection: 'row',
    height: 60,
    borderRadius: 28,
    // borderWidth: 1,
    // borderColor: '#ccc',
    paddingLeft: 20,
    paddingRight: 20,
    // paddingTop: 15,
    marginHorizontal: 5,
    alignItems: "center",
    shadowOffset: { width: 0, height: 0, },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 3,
    backgroundColor: '#fff',
    shadowColor: '#ccc',
  },
  create_job_service_btn: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    paddingHorizontal: 2
  },
  select_servicerdit: {
    fontFamily: 'Poppins-Medium',
    fontStyle: 'italic',
    marginTop: 8,
    fontSize: 18,
    borderBottomWidth: 1,
    borderColor: '#0088e0',
    color: '#0088e0',
  },

  create_job_show: {
    flexDirection: 'row',
    width: '100%',
    alignItems: 'center',
    alignSelf: 'center',
    justifyContent: 'space-between',
  },
  create_job_show1: {
    flexDirection: 'row',
    width: '50%',
    alignItems: 'center',
    alignSelf: 'center',
    justifyContent: 'space-between',
  },
  create_dateview: {
    width: 25,
    height: 25,
    marginTop: 10,
  },
  create_date_job_box: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },

  calender_Select: {
    width: 16,
    height: 16,
  },
  calender_Select_down: {
    width: 10,
    height: 10,
  },

  select_dete_time_job: {
    width: '100%',
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 20,
  },
  select_date_icon: {
    width: '15%',
  },
  ggjdhgjdgsajhgaj: {

    shadowOffset: { width: 1, height: 1, },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 3,
    backgroundColor: '#fff',
    shadowColor: '#ccc',
    width: '100%',
    flexDirection: 'row',
    alignItems: 'center',
    alignSelf: 'center',
    borderRadius: 20,
    height: 50, paddingLeft: 15, justifyContent: 'space-between', marginLeft: 5

  },
  select_date_arow: {
    width: '15%',
  },
  select_date_input: {
    width: '70%',
    paddingLeft: 0,
    marginLeft: 0,
    textAlign: 'center',
  },
  select_job_create_plac: {
    textAlign: 'center',
  },
  create_covid_about: {
    paddingLeft: 15,
    paddingRight: 15,
    paddingTop: 15,
    paddingBottom: 15,
    borderRadius: 15,
  },
  create_about_txt: {
    fontSize: 12,
    fontFamily: 'Poppins-Medium',
  },
  create_price_job: {
    flexDirection: 'row',
  },
  create_total_title: {
    width: '75%',
    fontSize: 14,
    textAlign: 'right',
    paddingRight: 20,
    fontFamily: 'Poppins-Medium',
    color: '#000',
  },
  create_total_time: {
    width: '25%',
    paddingLeft: 10,
    fontFamily: 'Poppins-Medium',
    color: '#000',
  },
  create_covid: {
    borderBottomWidth: 0.5,
    borderColor: '#828282',
    paddingBottom: 20,
    marginBottom: 15,
  },

  create_job_check: {
    width: 20,
    height: 20,
    marginTop: 2,
  },
  wallet_amount_last: {
    flexDirection: 'row',
  },
  wallet_bottom_total: {
    width: '20%',
    fontFamily: 'Poppins-Bold',
    fontSize: 18,
  },
  wallet_bottom_doller: {
    width: '80%',
    fontSize: 16,
    fontFamily: 'Poppins-Bold',
    color: '#616161',
  },
  wallet_bottom_total1: {
    fontFamily: 'Poppins-Bold',
    fontSize: 18,
  },
  wallet_bottom_doller1: {
    fontSize: 16,
    fontFamily: 'Poppins-Bold',
    color: '#616161',
    marginLeft: 6
  },

  //Notifications

  notiuserimg: {
    width: 50,
    height: 50,
    borderRadius: 100,
  },

  notification_time: {
    color: '#92a3b8',
    fontFamily: 'Poppins-Regular',
    fontSize: 12,
    textAlign: 'center',
    position: 'absolute',
    bottom: 0,
    right: 15
  },
  noti_user_name: {
    fontFamily: 'Poppins-SemiBold',
    fontSize: 16,
  },
  noti_user_psg: {
    fontFamily: 'Poppins-Regular',
    fontSize: 12,
  },
  noti_cross: {
    width: 20,
    height: 20,
    position: 'absolute',
    right: 20,
  },
  notification_left: {
    width: '15%',
  },
  notification_midle: {
    width: '60%',
  },
  notification_right: {
    width: '25%',
  },
  notification_box: {
    flexDirection: 'row',
    paddingBottom: 10,
    paddingLeft: 10,
    paddingTop: 15,
    paddingBottom: 15,
    borderRadius: 20,
    marginBottom: 20,
    backgroundColor: '#ffffff',
    shadowColor: "#ccc",
    shadowOffset: {
      width: 0,
      height: 0,
    },
    shadowOpacity: 1,
    shadowRadius: 1,
    elevation: 5,
  },
  notofication_body: {
    width: '95%',
    alignSelf: 'center',
    marginTop: 20,
  },

  //My_booking

  bookinsg_ID: {
    position: 'absolute',
    zIndex: 99999999,
    paddingRight: 15,
    top: 20,
    borderTopRightRadius: 15,
    borderBottomRightRadius: 15,
    opacity: 0.7,

    backgroundColor: "#ffffff"
  },

  booking_ID_txt: {
    fontFamily: 'Poppins-Medium',
    fontSize: 14,
    lineHeight: 28,
  },

  nooking_header_icon: {
    height: 25,
    height: 25,
    marginTop: 10,
  },
  bookingimg: {
    width: '100%',
    height: 110,
    borderTopLeftRadius: 20,
    borderTopRightRadius: 20,
  },
  booking_item: {
    width: '47%',
    borderRadius: 20,
    marginLeft: 8,
    marginRight: 8,
    marginBottom: 20,
    backgroundColor: '#ffffff',
    shadowColor: "#ccc",
    shadowOffset: {
      width: 0,
      height: 0,
    },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 5,
  },
  booking_box: {
    width: '100%',
  },

  booking_ID: {
    position: 'absolute',
    zIndex: 99999999,
    top: 15,
    left: -2,
    // paddingBottom:4,
    // paddingTop:4,
    paddingLeft: 5,
    paddingRight: 15,
    borderTopEndRadius: 10,
    borderBottomEndRadius: 10,
  },
  booking_heart_view: {
    flexDirection: 'row',
    width: '90%',
    alignSelf: 'center',
    paddingBottom: 8,

  },
  booking_item_left: {
    width: '80%',
  },
  booking_item_right: {
    width: '20%',
    // backgroundColor:'red'
  },
  booking_item_time: {
    fontSize: 10,
    fontFamily: "Poppins-Medium"
  },
  booking_item_name: {
    fontSize: 16,
    fontFamily: "Poppins-Bold",
    marginTop: 5,
  },
  booking_item_inprogress: {
    fontSize: 11,
    fontFamily: "Poppins-Regular",
    color: '#c0f20c',
  },
  booking_item_pending: {
    fontSize: 11,
    fontFamily: "Poppins-Regular",
    color: '#ff9900',
  },
  adfasdasaccept: {
    fontSize: 11,
    fontFamily: "Poppins-Regular",
    color: 'green',
  },
  booking_item_complete: {
    fontSize: 11,
    fontFamily: "Poppins-Regular",
    color: 'green',
  },
  booking_item_reject: {
    fontSize: 11,
    fontFamily: "Poppins-Regular",
    color: 'red',
  },

  booking_item_inprogress1: {
    fontSize: 11,
    fontFamily: "Poppins-Regular",
    color: 'green',
  },
  //Profile

  Profule_user_pic: {
    width: '100%',
    height: 400,
  },
  banner_profile: {
    height: '50%',
    backgroundColor: '#fff'
  },
  profile_name: {
    fontFamily: 'Poppins-Bold',
    fontSize: 18,
    textAlign: 'center',
    marginTop: 15,
  },
  profile_body: {
    height: '50%',
    backgroundColor: '#fff',
    borderTopLeftRadius: 30,
    borderTopRightRadius: 30,
  },
  profile_star: {
    width: 20,
    height: 20,
    marginLeft: 1,
    marginRight: 1,
  },
  profile_reviewer: {
    flexDirection: 'row',
    alignSelf: 'center',
    alignItems: 'center'
  },
  profile_total_review: {
    fontSize: 16,
    color: '#92a3b8',
    fontFamily: "Poppins-Regular",
    marginLeft: 10,
    marginTop: 3
  },
  profile_contact: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    width: '90%',
    alignSelf: 'center',
    marginTop: 10,
  },
  profile_jobs: {
    fontFamily: "Poppins-Bold",
    fontSize: 18,
  },
  profile_allJobs: {
    fontFamily: "Poppins-Regular",
    color: '#0088e0',
    fontSize: 14,
  },

  profile_setting_icon: {
    flexDirection: 'row',
    width: '25%',
    justifyContent: 'space-around',
    position: 'absolute',
    zIndex: 99999999,
    right: 20,
    top: 20,
  },
  profile_edit_icon: {
    width: 35,
    height: 35,
  },

  // Ratings


  // header_earnig:{
  //   flexDirection: 'row',
  //   justifyContent:'space-between',
  //   paddingTop:10,
  //   paddingBottom:10,
  //   paddingLeft:20,
  //   paddingRight:20,
  //   },
  //   select_back:{
  //   width:30,
  //   height:30,
  //   resizeMode:'contain',
  //   },
  //   earnig_title:{
  //   fontSize:18,
  //   fontFamily:"Ubuntu-Bold",
  //   fontWeight:'bold',
  //   },

  rating_banner: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingBottom: 20,
    borderBottomWidth: 8,
    borderColor: '#f8f8f8',
    paddingRight: 20,
    paddingLeft: 20,
    marginTop: 10,
  },
  rating_right: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 5,
  },
  review_star: {
    width: 20,
    height: 20,
    marginLeft: 3,
    marginRight: 3,
  },
  review_star_left: {
    width: 10,
    height: 10,
    marginLeft: 2,
    marginRight: 2,
  },
  rating_left: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  rating_total: {
    textAlign: 'left',
    fontSize: 24,
    fontFamily: "Poppins-SemiBold",
    marginTop: 50,
  },

  rating_1425: {
    color: '#7f7f7f',
    letterSpacing: 1,
    marginLeft: 10,
    fontFamily: "Poppins-Regular",
    fontSize: 14,
  },
  total_ratin_txt: {
    color: '#7f7f7f',
    letterSpacing: 1,
    marginLeft: 10,
    fontFamily: "Poppins-Regular",
    fontSize: 16,
  },
  rating_people: {
    flexDirection: 'row',
    width: '100%',
    marginBottom: 3,
    marginTop: 3,
  },
  rating_status_star: {
    width: 18,
    height: 18,
    marginLeft: 2,
    marginRight: 2,
  },
  total_earnig_list: {
    flexDirection: 'row',
    width: '100%',
    borderBottomWidth: 1,
    paddingBottom: 15,
    paddingTop: 15,
    borderColor: '#c2c2c2',
    paddingLeft: 20,
    paddingRight: 20,
  },
  rating_right_sc: {
    width: '20%',
    textAlign: 'center',
    alignItems: 'center',
  },
  rating_main: {
    width: '80%',
  },

  rating_name: {
    fontFamily: "Poppins-SemiBold",
    fontSize: 16,
    lineHeight: 20,
  },
  rewiew_people_img: {
    width: 40,
    height: 40,
    resizeMode: 'cover',
    marginTop: 10,
    borderRadius: 100,
  },
  rating_title_main: {
    color: '#727272',
  },
  rating_txt_main: {
    fontFamily: "Poppins-Regular",
    fontSize: 12,
    color: '#222222',
  },
  left_time_sele: {
    position: 'absolute',
    fontFamily: 'Poppins-Regular',
    color: '#727272',
    fontSize: 14,
    right: 0,
  },


  // Edit profile

  profile_main_userimg: {
    height: 104,
    width: 104,
    borderRadius: 100,
    //  borderWidth:10,
    //  height:100,
    //  height:100,
    alignSelf: 'center'


  },

  image_profile_top: {
    borderRadius: 100,
    // width:'28%',
    justifyContent: 'center',
    borderColor: '#73beee',
    borderWidth: 8,
    width: 120,
    height: 120,
    alignSelf: 'center',
    marginTop: 30,
    marginBottom: 30,
  },

  // Settings

  setting_body: {
    width: '100%',
    alignSelf: 'center',
    marginTop: 15,
  },
  setting_Account: {
    color: '#929191',
    fontFamily: "Poppins-Regular",
    fontSize: 16,
    marginTop: 10,
    marginBottom: 10,
  },
  setting_pust: {
    color: '#000000',
    fontFamily: "Poppins-Regular",
    fontSize: 16,
  },
  setting_logout: {
    color: '#ff0000',
    fontFamily: "Poppins-Regular",
    fontSize: 16,
    marginBottom: 50,
  },
  setting_toggles: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginTop: 10,
    marginBottom: 10,
  },

  setting_btn_txt: {
    marginTop: 10,
    marginBottom: 10,
  },


  // change pass
  change_pass_body: {
    width: '90%',
    alignItems: 'center',
    alignSelf: 'center',
    marginTop: 20,

  },
  pass_change_left: {
    width: '10%',
  },
  pass_change_middle: {
    width: '80%',
  },
  pass_change_right: {
    width: '10%',
  },

  change_pass_view: {
    flexDirection: 'row',
    alignItems: 'center',
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 20,
    paddingLeft: 20,
    marginTop: 20,
  },


  //wallet

  wallet_body: {
    width: '100%',
    alignSelf: 'center',
  },
  wallet_total: {
    textAlign: 'center',
    fontSize: 24,
    fontFamily: "Poppins-SemiBold",
  },
  wallet_txt: {
    fontSize: 14,
    textAlign: 'center',
    color: '#868686',
    fontFamily: 'Poppins-Regular',
  },
  wallet_list: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    borderWidth: 1,
    borderColor: '#cccccc',
    paddingLeft: 20,
    paddingRight: 20,
    paddingTop: 15,
    paddingBottom: 15,
    height: 55
  },

  wallet_id: {
    color: '#686868',
    fontFamily: 'Poppins-SemiBold',
    fontSize: 15,
  },
  wallet_time: {
    color: '#686868',
    fontFamily: 'Poppins-Regular',
    fontSize: 14,
  },

  wallet_total_price: {
    color: '#686868',
    fontFamily: 'Poppins-SemiBold',
    fontSize: 18,
  },
  wallet_banner: {
    paddingTop: 40,
    paddingBottom: 40,
  },

  // Terms of Service

  terms_body: {
    width: '90%',
    alignSelf: 'center',
    marginTop: 20,
    marginBottom: 20,
  },
  terms_txt_setting: {
    fontFamily: 'Poppins-Regular',
    fontSize: 16,
    lineHeight: 24,
    textAlign: 'justify',
  },

  //Contact Us

  contact_body: {
    width: '90%',
    alignSelf: 'center',
  },
  contact_title: {
    textAlign: 'center',
    fontSize: 18,
    fontFamily: 'Poppins-Regular',
    marginTop: 20,
  },
  contact_support_title: {
    textAlign: 'center',
    fontFamily: 'Poppins-Regular',
    color: '#0088e0',
    fontSize: 16,
    marginBottom: 30,
  },

  contact_Left: {
    width: '10%',
  },
  contact_right: {
    width: '90%',
  },
  contact_box: {
    flexDirection: 'row',
    alignItems: 'center',
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 20,
    paddingLeft: 20,
    paddingRight: 20,
    marginBottom: 20,
  },
  contact_msgicon: {
    width: 20,
    height: 20,
    position: 'absolute',
    bottom: 30,
  },


  // detail_job_pending_book


  detail_pending_back_icons: {
    width: 40,
    height: 40,
  },

  detail_job_top: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    width: '90%',
    alignSelf: 'center',
    position: 'absolute',
    zIndex: 99999999,
    top: 20,
  },
  detail_pending_dot: {
    width: 40,
    height: 40,
  },
  statusText: {
    fontFamily: "Poppins-Bold",
    color: 'white',
    fontSize: 14,
    lineHeight: 35,
  },
  pendingtxt: {
    fontFamily: "Poppins-Bold",
    color: 'white',
    fontSize: 16,
    lineHeight: 35,
  },
  pending_viewtxt: {
    backgroundColor: '#def10e',
    width: '20%',
    height: 35,
    borderTopRightRadius: 15,
    borderBottomRightRadius: 15,
    position: 'absolute',
    zIndex: 99999999,
    bottom: 20,
  },

  detailheartimg: {
    width: 30,
    height: 30,
    right: 0,
  },
  detail_bodyjob: {
    width: '100%',
    alignSelf: 'center',
    borderTopLeftRadius: 30,
    borderTopRightRadius: 30,
    marginTop: -30,
    backgroundColor: '#ffffff',
    shadowColor: "#ccc",
    shadowOffset: {
      width: 0,
      height: 0,
    },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 3,
    borderRadius: 15
  },
  housecleantxt: {
    fontFamily: "Poppins-Bold",
    fontSize: 22,
  },
  housecleanhhours: {
    fontFamily: "Poppins-Medium",
    fontSize: 18,
  },
  job_detailid: {
    fontFamily: "Poppins-Regular",
    fontSize: 16,
  },
  detail_locationimg: {
    width: 18,
    height: 18,
    marginRight: 10,
  },

  detail_locatsion: {
    flexDirection: 'row',
    alignItems: 'flex-start',
  },
  detailexpire: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 20,
  },
  detail_service: {
    fontFamily: "Poppins-Bold",
    fontSize: 18,
  },
  house_cleat_section: {
    marginTop: 20,
  },
  detail_jobleft: {
    flexDirection: 'row',
    alignItems: 'center',
    width: '50%',
  },
  detail_datet: {
    fontFamily: "Poppins-Regular",
    fontSize: 12,
    marginLeft: 20,
  },
  detail_date_box: {
    flexDirection: 'row',
    borderBottomWidth: 0.5,
    borderColor: '#ccc',
    paddingBottom: 10,
    marginTop: 20,
  },
  detail_jobright: {
    flexDirection: 'row',
    alignItems: 'center',
    width: '50%',
  },
  detail_date_job: {
    marginBottom: 20,
  },
  jobchat: {
    width: 30,
    height: 30,
  },
  userjobtimme: {
    color: '#777',
    fontFamily: "Poppins-SemiBold",
    fontSize: 12,
  },
  userjobtimmenoot: {
    color: 'red',
    fontFamily: "Poppins-SemiBold",
    fontSize: 12,
  },
  detail_jobuser: {
    width: '14%',
  },
  detail_name_user: {
    width: '58%',
    justifyContent: 'flex-end',
  },
  detail_jobuser_chat: {
    width: '40%',
    justifyContent: 'flex-end',
    alignItems: 'flex-end',
    paddingRight: 7
  },
  detail_ratinngbox: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingBottom: 15,
    paddingTop: 15,
    paddingLeft: 10,
    marginTop: 15,
    backgroundColor: '#ffffff',
    shadowColor: "#ccc",
    shadowOffset: {
      width: 0,
      height: 0,
    },
    shadowOpacity: 0.7,
    shadowRadius: 2,
    elevation: 2,
    borderRadius: 15
  },
  detail_name_user_txt: {
    fontFamily: "Poppins-Bold",
    fontSize: 14,
  },

  detail_serviseBox: {
    flexDirection: 'row',
    alignItems: 'center',
    borderBottomWidth: 0.5,
    borderTopWidth: 0.5,
    borderColor: '#b5b5b5',
    paddingBottom: 15,
    paddingTop: 5,
  },
  detail_priice_total: {
    color: '#000',
    fontFamily: 'Poppins-Bold',
    fontSize: 20,
  },
  detail_botom_proce: {
    borderTopWidth: 1,
    borderColor: '#ccc',
    paddingTop: 15,
    marginBottom: 15,
  },
  selectoption: {
    fontFamily: 'Poppins-Medium',
    fontSize: 16,
    textAlign: 'center',
    color: '#666',
    marginBottom: 10,
    marginTop: 10,
  },
  action_edit: {
    fontFamily: 'Poppins-Medium',
    fontSize: 16,
    textAlign: 'center',
  },
  action_row: {
    alignSelf: 'center',
    paddingTop: 10,
    paddingBottom: 10,
  },
  sheet_action_name: {
    textAlign: 'center',
    color: 'red',
    fontFamily: 'Poppins-Medium',
    fontSize: 16,
    color: 'red',
  },

  cancel_body: {
    alignSelf: 'center',
    width: '90%',
    marginTop: 30,
  },
  Cancel_reasontxt: {
    fontFamily: 'Poppins-Medium',
    fontSize: 16,
    borderColor: '#ccc',
    borderBottomWidth: 1,
    lineHeight: 45,
  },


  // Other profile

  other_profile_icon: {
    flexDirection: 'row',
    width: '90%',
    justifyContent: 'space-between',
    position: 'absolute',
    zIndex: 99999999,
    right: 20,
    top: 20,
  },
  jo_otherox: {
    width: '90%',
    alignSelf: 'center',
    flexDirection: 'row',
    textAlign: 'center',
  },

  leftboxjob: {
    width: '50%',
    textAlign: 'center',
    marginTop: 40,
  },
  totalJobxt: {
    textAlign: 'center',
    fontFamily: 'Poppins-Bold',
    fontSize: 20,
    color: '#716767',
  },
  comletejob: {
    textAlign: 'center',
    fontSize: 14,
    color: '#222',
    fontFamily: 'Poppins-Medium',
  },
  profile_btn_other: {
    backgroundColor: '#0088e0',
    alignItems: 'center',
    width: '50%',
    flexDirection: 'row',
    alignSelf: 'center',
    height: 45,
  },
  otherprofilchat: {
    width: 20,
    height: 20,
  },
  profile_chat: {
    alignSelf: 'center',
    backgroundColor: '#0088e0',
    width: '90%',
    borderRadius: 50,
    marginTop: 40,
  },

  calltn_other: {
    color: '#fff',
    fontFamily: 'Poppins-Medium',
    marginLeft: 10,
  },
  prvidermglef: {
    width: 50,
    height: 50,
    borderRadius: 100,
  },
  rvider_left: {
    width: '20%',
  },
  provider_middle: {
    width: '45%',
  },
  rvider_rigt: {
    width: '35%',
    flexDirection: 'row',
  },
  provde_select: {
    flexDirection: 'row',
    marginBottom: 15,
    borderBottomWidth: 1,
    borderColor: '#ccc',
    paddingBottom: 10,
  },

  roviderstarma: {
    width: 15,
    height: 15,
    marginLeft: 1,
    marginRight: 1,
  },
  slect_servistitme: {
    fontSize: 12,
    fontFamily: 'Poppins-Medium',
  },


  // create job dtails


  createjob_body: {
    width: '90%',
    alignSelf: 'center',
    marginTop: 30,
  },
  contact_jobedit: {
    width: '10%',
  },
  contact_msgiconedit: {
    width: 20,
    height: 20,
    marginTop: 15,
  },

  introcontact: {
    flexDirection: 'row',
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 20,
    paddingLeft: 20,
    paddingRight: 20,
    marginBottom: 20,
  },

  //card

  card_body: {
    width: '90%',
    alignSelf: 'center',
  },
  entercard: {
    fontSize: 22,
    fontFamily: 'Poppins-Bold',
    color: '#fff',
    marginTop: 20,
  },
  cardpsg: {
    color: '#fff',
    fontFamily: 'Poppins-Medium',
  },

  card_title: {
    paddingLeft: 20,
    paddingRight: 20,
    paddingBottom: 50,
  },


  card_box: {
    flexDirection: 'row',
    borderBottomWidth: 1,
    borderBottomColor: '#ccc',
    marginBottom: 15,
    // paddingLeft:20,
    // paddingRight:20,
    width: '90%',
    alignItems: 'center',
    alignSelf: 'center',
  },
  card_box_left: {
    borderBottomWidth: 1,
    borderBottomColor: '#ccc',
    marginBottom: 15,
    alignItems: 'center',
    alignSelf: 'center',
    width: '45%',
  },
  card_cvv: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    width: '90%',
    alignSelf: 'center',
  },
  card_view: {
    marginTop: -30,
    borderTopRightRadius: 30,
    borderTopLeftRadius: 30,
    paddingTop: 30,
  },
  input_main_card: {
    height: 50,
    paddingLeft: 0,
    fontSize: 18,
  },

  // success

  successimg: {
    width: 60,
    height: 60,
  },
  jobcreateone: {
    fontSize: 20,
    fontFamily: "Poppins-Bold",
  },
  jobcreateid: {
    color: '#000000',
    fontSize: 16,
    fontFamily: 'Poppins-Bold',
  },

  jobcreatedates: {
    color: '#666',
    fontSize: 16,
    fontFamily: 'Poppins-Medium',
  },
  create_success_view: {
    // alignSelf:'center',
    justifyContent: "center",
    alignItems: 'center',
    width: '100%',
    height: '100%',
  },
  succesbtn: {
    width: '100%',
    backgroundColor: '#0088e0',
    height: 60,
    borderRadius: 50,
    marginTop: 20,
  },

  succesbtnoks: {
    color: '#fff',
    fontFamily: 'Poppins-Medium',
  },

  homebankbtn: {
    width: '90%',
    alignSelf: 'center',
  },
  homebankbtn1: {
    width: '90%',
    alignSelf: 'center',
    position: 'absolute',
    bottom: 10
  },
  // flank_view_card:{
  //   width:50,
  //   height:50,

  // },
  cardline_Icon: {
    width: 30,
    height: 5,
    marginTop: 5,
  },



  // Inbox

  inboximg: {
    width: 50,
    height: 50,
    borderRadius: 100,
  },
  inoxtime: {
    fontFamily: 'Poppins-Regular',
    color: '#92a3b8',
    fontSize: 14,
    marginTop: 30,
  },
  inboxLeft: {
    width: '20%',
  },
  inboxmiddle: {
    width: '60%',
  },
  inboxright: {
    width: '20%',
    justifyContent: 'flex-end'
  },

  searchibox: {
    width: '100%',
    flexDirection: 'row',
    borderWidth: 1,
    borderColor: '#ccc',
    paddingTop: 15,
    paddingBottom: 15,
    borderRadius: 30,
    paddingRight: 15,
    paddingLeft: 15,
    marginBottom: 15,
  },
  inboxName: {
    fontFamily: 'Poppins-Bold',
    fontSize: 16,
    color: '#303030',
  },
  inboccotbg: {
    backgroundColor: '#ee647b',
    width: 25,
    height: 25,
    borderRadius: 100,
    top: 0,
    right: 10,
    position: 'absolute',
    right: 0,
  },
  total_counters: {
    textAlign: 'center',
    lineHeight: 25,
    color: '#fff',
    fontSize: 12,
    fontFamily: 'Poppins-Regular',
  },

  // chat

  header_back_btn: {
    width: 25,
    height: 25,
    resizeMode: 'contain',
  },
  user_img: {
    width: 40,
    height: 40,
    resizeMode: 'cover',
    borderRadius: 100,
  },
  chat_header: {
    flexDirection: 'row',
    backgroundColor: '#ffffff',
    paddingTop: 15,
    paddingBottom: 15,
    paddingRight: 20,
    paddingLeft: 20,
    borderBottomWidth: 0.5,
    borderColor: '#ccc',
  },
  chat_header_left: {
    width: '20%',
    marginTop: 8,
  },
  chat_header_middle: {
    width: '75%',
    flexDirection: 'row',
  },
  chat_header_right: {
    width: '5%',
    marginTop: 5,
  },
  name_online_of: {
    marginLeft: 15,
  },
  user_name: {
    fontFamily: 'Poppins-Bold',
    fontWeight: 'bold',
    fontSize: 16,
    color: '#fff',
  },
  user_online: {
    fontFamily: 'Poppins-Regular',
    fontSize: 14,
    color: '#fff',
  },
  header_dot_btn: {
    height: 25,
    width: 20,
    resizeMode: 'contain',
  },
  receive_user_img: {
    width: 40,
    height: 40,
    resizeMode: 'cover',
    borderRadius: 100,
  },
  receve_msg: {
    flexDirection: 'row',
    width: '80%',
    backgroundColor: '#ffffff',
    marginBottom: 15,
  },
  receive_box: {
    backgroundColor: '#e2e2e4',
    marginLeft: 20,
    paddingLeft: 20,
    paddingRight: 20,
    width: '80%',
    paddingBottom: 5,
    paddingTop: 5,
    borderRadius: 5,
  },
  receive_txt: {
    fontFamily: 'Poppins-Regular',
    fontSize: 12,
    textAlign: 'left',
  },
  receive_time: {
    fontFamily: 'Poppins-Regular',
    fontSize: 10,
    textAlign: 'right',
    color: '#9f9f9f',
  },
  user_img_main: {
    marginTop: 5,
  },
  send_box: {
    backgroundColor: '#0088e0',
    width: '70%',
    right: 0,
    paddingRight: 20,
    paddingLeft: 20,
    paddingBottom: 5,
    paddingTop: 5,
    borderRadius: 5,
  },
  send_msg: {
    flexDirection: 'row',
  },
  send_txt: {
    fontFamily: 'Poppins-Regular',
    fontSize: 12,
    color: '#fff',
  },
  send_time: {
    fontFamily: 'Poppins-Regular',
    fontSize: 10,
    textAlign: 'right',
    color: '#fff',
  },
  typing_dot1: {
    width: 8,
    height: 8,
    backgroundColor: '#000000',
    borderRadius: 100,
  },
  typing_dot2: {
    width: 8,
    height: 8,
    backgroundColor: '#444445',
    borderRadius: 100,
    marginLeft: 4,
    marginRight: 4,
  },
  typing_dot3: {
    width: 8,
    height: 8,
    backgroundColor: '#888889',
    borderRadius: 100,
  },
  typing_dot_box: {
    flexDirection: 'row',
    backgroundColor: '#e2e2e4',
    paddingLeft: 15,
    paddingRight: 15,
    paddingTop: 16,
    borderRadius: 5,
    marginLeft: 20,
  },
  typing_msg: {
    flexDirection: 'row',
    marginTop: 15,
  },
  chat_content_main: {
    paddingLeft: 20,
    paddingRight: 20,
    marginTop: 20,
  },
  sheet_title: {
    textAlign: 'center',
    color: '#666',
    fontFamily: 'Poppins-Regular',
    fontSize: 16,
  },
  sheet_action_name: {
    textAlign: 'right',
    fontSize: 15,
    fontFamily: 'Poppins-Regular',
    lineHeight: 40,
  },
  chat_option: {
    paddingLeft: 20,
    paddingRight: 20,
  },

  chat_cancel: {
    textAlign: 'right',
    fontSize: 15,
    fontFamily: 'Poppins-Regular',
    lineHeight: 40,
    color: 'red',
  },
  Block_user: {
    textAlign: 'right',
    fontSize: 15,
    fontFamily: 'Poppins-Regular',
    lineHeight: 40,
    color: 'red',
  },
  chat_bootm: {
    flexDirection: 'row',
    paddingLeft: 10,
    paddingRight: 10,
    borderTopWidth: 0.5,
    borderColor: '#ccc',
    paddingTop: 0,
    position: 'absolute',
    bottom: 0,
    backgroundColor: '#fff',
  },
  bottom_chat_left: {
    width: '10%',
    flexDirection: 'row',
    justifyContent: 'flex-end'
  },
  bottom_chat_middle: {
    width: '80%',
  },
  bottom_chat_right: {
    width: '10%'
  },
  plus_img: {
    width: 17,
    height: 17,
    resizeMode: 'contain',
    marginTop: 15,
  },

  send_img: {
    width: 20,
    height: 20,
    resizeMode: 'contain',
    marginTop: 14,
  },
  msg_type_input: {
    textAlign: 'right',
    paddingRight: 10,
  },
  sentickmsg: {
    width: 10,
    height: 10,
    marginRight: 5,
  },

  send_timebox: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'flex-end',
  },
  pendingiew: {
    position: 'absolute',
    zIndex: 99999999,
    backgroundColor: '#ff9900',
    paddingRight: 20,
    bottom: 50,
    borderTopRightRadius: 20,
    borderBottomRightRadius: 20,
    paddingLeft: 10,
  },
  acceptediew: {
    position: 'absolute',
    zIndex: 99999999,
    backgroundColor: 'green',
    paddingRight: 20,
    bottom: 50,
    borderTopRightRadius: 20,
    borderBottomRightRadius: 20,
    paddingLeft: 10,
  },
  pendingiewinpprogrss: {
    position: 'absolute',
    zIndex: 99999999,
    backgroundColor: '#c0f20c',
    paddingRight: 20,
    bottom: 50,
    borderTopRightRadius: 20,
    borderBottomRightRadius: 20,
    paddingLeft: 10,
  },

  pendingiewcomleed: {
    position: 'absolute',
    zIndex: 99999999,
    backgroundColor: 'green',
    paddingRight: 20,
    bottom: 50,
    borderTopRightRadius: 20,
    borderBottomRightRadius: 20,
    paddingLeft: 10,
  },
  pendingiewcancel: {
    position: 'absolute',
    zIndex: 99999999,
    backgroundColor: 'red',
    paddingRight: 20,
    bottom: 50,
    borderTopRightRadius: 20,
    borderBottomRightRadius: 20,
    paddingLeft: 10,
  },
  pendingiewcomleedp: {
    position: 'absolute',
    zIndex: 99999999,
    backgroundColor: '#02cf45',
    paddingRight: 20,
    bottom: 20,
    borderTopRightRadius: 20,
    borderBottomRightRadius: 20,
    paddingLeft: 10,
  },


  garden: {
    marginTop: 5,
    fontSize: 18,
    fontFamily: "Poppins-Regular",
    color: '#b8b8b8',
  },

  selct_providerbtn: {
    alignItems: 'center',
    width: '100%',
    alignSelf: 'center',
    marginBottom: 15,
    backgroundColor: '#ffffff',
    flexDirection: 'row',
    paddingLeft: 15,
    paddingRight: 15,
    paddingTop: 10,
    paddingBottom: 10,
    borderRadius: 30,
    shadowColor: "#ccc",
    shadowOffset: {
      width: 0,
      height: 0,
    },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 5
  },

  selct_providerbtn1: {
    alignItems: 'center',
    width: '100%',
    alignSelf: 'center',
    marginBottom: 15,
    backgroundColor: '#ceedf6',
    flexDirection: 'row',
    paddingLeft: 15,
    paddingRight: 15,
    paddingTop: 10,
    paddingBottom: 10,
    borderRadius: 30,
    shadowColor: "#ccc",
    shadowOffset: {
      width: 0,
      height: 0,
    },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 5
  },


  // Bank

  bankody: {
    width: '90%',
    alignSelf: 'center',
    marginTop: 20,
  },
  bankdt: {
    fontSize: 20,
    fontFamily: "Poppins-Bold",
  },
  bankenter: {
    fontSize: 16,
    fontFamily: "Poppins-Medium",
  },
  bankname: {
    borderBottomWidth: 1,
    borderColor: '#0088e1',
    marginBottom: 20,
  },
  typeofaccount: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    borderBottomWidth: 1,
    borderColor: '#0088e1',
    paddingBottom: 15,
    paddingLeft: 10,
    paddingRight: 10,
  },
  banktypename: {
    fontFamily: "Poppins-Medium",
    color: '#bbb',
    fontSize: 18,
    marginLeft: 7
  },

  login_btneter: {
    width: '90%',
    alignSelf: 'center',
    bottom: 20,

  },

  housephoto: {
    fontFamily: 'Poppins-Bold',
    textAlign: 'center',
    fontSize: 20,
  },
  photopsg: {
    textAlign: 'center',
    fontFamily: "Poppins-Medium",
  },
  housephotoection: {
    textAlign: 'center',
    alignSelf: 'center',
    marginTop: 20,
  },

  house_img: {
    alignSelf: 'center',
    justifyContent: 'center',
    alignItems: 'center',
    flex: 1,
  },

  selec_ro_serice: {
    fontFamily: 'Poppins-Bold',
    fontSize: 20,
  },
  selec_ro_psg: {
    fontSize: 16,
    fontFamily: "Poppins-Medium",
  },

  select_servicepage: {
    alignSelf: 'center',
    width: '90%',
    marginTop: 30,
  },

  //House sketches

  house_sketch: {
    width: '90%',
    alignSelf: 'center',
    marginTop: 30,

  },
  housedeomo: {
    width: '100%',
    height: 160,
    borderRadius: 20,
    marginTop: 10,
    marginBottom: 20,
  },

  bio_self: {
    borderBottomWidth: 1,
    borderColor: '#0088e0',
    marginTop: 20,
  },


  //Home_p

  homep_body: {
    width: '90%',
    alignSelf: 'center',
  },

  home_ptop: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 10,
  },
  dicovertitle: {
    fontSize: 18,
    fontFamily: "Poppins-Medium",
  },
  dicovertitlebold: {
    fontFamily: "Poppins-Bold",
    fontSize: 20,
  },
  hmep_seach: {
    flexDirection: 'row',
    borderWidth: 1,
    borderColor: '#d7d7d7',
    paddingBottom: 7,
    paddingTop: 7,
    paddingLeft: 10,
    paddingRight: 10,
    borderRadius: 20,
    marginTop: 10,
  },

  home_psearch_icon: {
    width: 18,
    height: 18,
    marginRight: 10,
    marginTop: 5,
  },
  homep_seach: {
    color: '#ababab',
    fontSize: 16,
    fontFamily: "Poppins-Medium",
  },

  resentjobbox: {
    backgroundColor: '#f3fdfc',
    paddingTop: 5,
  },
  homelistp_left: {
    width: '30%',
  },
  phomeimg: {
    width: '100%',
    height: 100,
    borderRadius: 20,
    marginTop: 10
  },

  homelistp_right: {
    width: '70%',
    paddingLeft: 10,
  },


  phomelike: {
    width: 25,
    height: 25,
    marginLeft: 10,
  },
  homeplist: {
    flexDirection: 'row',
    borderWidth: 1,
    borderColor: '#ccc',
    paddingLeft: 10,
    paddingRight: 10,
    paddingBottom: 10,
    borderRadius: 20,
    marginBottom: 20,
  },

  homeplist1: {
    flexDirection: 'row',
    paddingLeft: 10,
    paddingRight: 10,
    paddingBottom: 10,
    borderRadius: 20,
    marginBottom: 20,
    shadowOffset: { width: 0, height: 0, },
    shadowOpacity: 1,
    shadowRadius: 2,
    elevation: 8,
    backgroundColor: '#ffffff',
    shadowColor: '#ccc',
  },

  pboxid: {
    color: '#837e7e',
    fontFamily: "Poppins-Bold",
    marginTop: 5,
  },
  hommed: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  phometime: {
    flexDirection: 'row',
  },
  phometimemint: {
    color: '#333',
    fontFamily: 'Poppins-Bold',
  },
  viewpaameiem: {
    fontFamily: 'Poppins-Bold',
    fontSize: 16,
    lineHeight: 20,
    // lineHeight: 16,
  },
  phomepsg: {
    fontSize: 16,
    fontFamily: 'Poppins-Regular',
    // lineHeight: 16,
  },
  price_code: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 10,
  },
  homeoencose: {
    flexDirection: 'row',
  },
  home_rice_main: {
    fontSize: 16,
    fontFamily: 'Poppins-Bold',
  },
  pendingbtnhomme: {
    color: '#fff',
    borderRadius: 20,
    width: 110,
    textAlign: 'center',
  },

  pendingbtcompleted: {
    color: '#fff',
    fontFamily: 'Poppins-Regular',
    textAlign: 'center',
  },
  pendingbtinprogres: {
    backgroundColor: '#fcac01',
    color: '#fff',
    fontFamily: 'Poppins-Regular',
    borderRadius: 20,
    textAlign: 'center',
  },
  cancelbtinprogres: {
    // backgroundColor: 'red',
    color: '#fff',
    fontFamily: 'Poppins-Regular',
    // paddingRight:15,
    // paddingLeft:15,
    // lineHeight: 30,
    // borderRadius: 20,
    // width: 110,
    textAlign: 'center',
  },

  //inbox_p


  inboccotbgpi: {
    backgroundColor: '#0088e0',
    width: 25,
    height: 25,
    borderRadius: 100,
    top: 0,
    right: 10,
    position: 'absolute',
    right: 0,
  },

  reportp_body: {
    width: '90%',
    alignSelf: 'center',
    marginTop: 30,
  },

  startjjobtn: {
    backgroundColor: '#0088e0',
    color: '#fff',
    lineHeight: 30,
    paddingLeft: 10,
    paddingRight: 10,
    borderRadius: 30,
    fontSize: 12,
  },
  startjjobtn1: {
    backgroundColor: 'red',
    color: '#fff',
    lineHeight: 30,
    paddingLeft: 10,
    paddingRight: 10,
    borderRadius: 30,
    fontSize: 12,
  },

  paymment_detailbottom: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  paymmenttitlel: {
    fontSize: 18,
    fontFamily: "Poppins-Bold",
  },
  jobdetailid: {
    fontSize: 16,
    fontFamily: "Poppins-Medium",
    // lineHeight: 24,
  },
  jobboldleft: {
    fontFamily: "Poppins-Bold",
  },
  jobid_etail: {
    marginBottom: 30,
  },


  // Review popop


  reviwtitle_popup: {
    fontSize: 24,
    fontFamily: "Poppins-Bold",
    textAlign: "center",
    marginTop: 10,
  },
  review_star: {
    width: 25,
    height: 25,
    alignSelf: 'center',
    marginRight: 3,
    marginLeft: 3,
  },
  reviewbox: {
    flexDirection: 'row',
    width: '100%',
    alignSelf: 'center',
    alignItems: 'center',
    marginTop: 7,
  },

  review_nput: {
    flexDirection: 'row',
    alignItems: 'center',
    borderBottomWidth: 1,
    borderColor: '#ccc',
    borderRadius: 20,
    paddingLeft: 20,
    paddingRight: 20,
    marginBottom: 20,
  },
  rating_status_total: {
    width: 22,
    height: 22,
    marginRight: 2,
  },
  show_review_box: {
    flexDirection: 'row',
    marginTop: 10,
  },

  // profile  p

  p_pprofilebio: {
    width: '90%',
    alignSelf: 'center',
  },
  profile_pnnamecv: {
    fontFamily: 'Poppins-Regular',
    fontSize: 12,
    marginBottom: 20,
    lineHeight: 16,
  },

  pprovider_profille_boox: {
    width: '90%',
    alignSelf: 'center',
  },

  profile_body_p: {
    borderTopRightRadius: 30,
    borderTopLeftRadius: 30,
    backgroundColor: '#ffffff',
    marginTop: -30,
  },

  profile_pnnamecvbold: {
    fontFamily: 'Poppins-Bold',
  },


  contactnumber: {
    color: '#5c5959',
    fontFamily: 'Poppins-Bold',
    fontSize: 20,
  },
  pprofile_contact: {
    flexDirection: 'row',
    width: '90%',
    alignSelf: 'center',
  },
  pprofileuser: {
    width: 20,
    height: 20,
    marginRight: 15,
    marginTop: 8,
  },






  // FAQ


  heading: {
    fontSize: 18,
    textAlign: 'center',
    fontFamily: 'Poppins-Regular',
    paddingVertical: 20
  },
  text2: {
    fontSize: 14,
    fontFamily: 'Poppins-Bold',
    width: '90%',
    color: '#292626',
  },
  text3: {
    marginVertical: 10,
    fontSize: 12,
    fontFamily: 'Poppins-Medium',
    width: '100%'

  },
  text: {
    fontSize: 16,
    alignSelf: 'center',
    fontFamily: 'Poppins-Regular',
    width: '90%'
  },
  back: {
    width: 25,
    height: 25
  },

  text1: {
    fontSize: 20,
    fontFamily: 'Poppins-Bold',
  },

  headingfaq: {
    fontSize: 20,
    fontFamily: 'Poppins-Bold',
    textAlign: 'center',
    marginTop: 30,
  },
  langauge_style: {
    width: 100, height: 30,
    borderColor: "#0088e0",
    borderWidth: 1,
    alignSelf: "flex-end", alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#fff'
  },
  langauge_style1: {
    width: 100, height: 30,
    borderColor: "#0088e0",
    borderWidth: 1,
    alignSelf: "flex-end", alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#e6e6e6'
  },
  dropDown: {
    height: '33.3%',
    backgroundColor: "#fff",
    alignItems: "center",
    justifyContent: 'center'
  },
  dropDown1: {
    height: '33.3%',
    backgroundColor: "#0088e0",
    alignItems: "center",
    justifyContent: 'center'
  },
  dropDown12: {
    height: '33.3%',
    backgroundColor: "#fff",
    alignItems: "center",
    justifyContent: 'center'
  },
  dropDown11: {
    height: '33.3%',
    backgroundColor: "#0088e0",
    alignItems: "center",
    justifyContent: 'center'
  },
  headerContainer: {
    flexDirection: "row",
    height: windowheight * 0.071,
    backgroundColor: '#0088e0',
  },


  appJsBottomBar: {
    width: 25,
    height: 25,
    resizeMode: 'contain',
    color: 'red',
  },
  appJsBottomBar1: {
    width: 25,
    height: 25,
    resizeMode: 'contain',
    color: 'red',
  },
  homemmmmm: {
    width: '95%', alignSelf: 'center', marginTop: 20,
  },
  homemmmmm1: {
    width: '95%', alignSelf: 'center', marginTop: 20, height: windowheight * 0.60
  },

})

export default styles;