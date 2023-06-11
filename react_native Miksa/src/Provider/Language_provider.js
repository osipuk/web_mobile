import { Alert, ToastAndroid, I18nManager, Platform } from "react-native";
import { localStorage } from './localStorageProvider';
import AsyncStorage from "@react-native-community/async-storage";
import { config } from "./configProvider";

global.language_key = 1;
class Language_provider {


  //title net-----------
  information = ['Mensaje informativo', 'Information Message'];
  msgTitleDefualt = ['Mensaje informativo', 'Information Message'];
  msgTitleServerNotRespond = ['Error de conexión', 'Connection Error'];
  msgTitleNoNetwork = ['Error de conexión', 'Connection Error'];
  //end title net-----------

  //

  //message net related-------------------------
  enableLocation = ['A Miksa le gustaría acceder a su ubicación', 'Miksa  would like to access your location for address '];
  AccountCloseRequest = ['Tu cuenta ha sido cerrada', 'Your account has been closed'];
  AccountDeactive = ['Su cuenta ha sido desactivada por el administrador', 'Your account has been deactivated by admin'];
  UnAuthorized = ['Algo salió mal. Vuelve a intentarlo más tarde.', 'Something is went wrong, Please try again later'];
  elseResponse = ['Datos no disponibles', 'No data available'];
  serverNotRespond = ["An unexpected error occurred, Please try again. If the problem continues, Please do contact us.", "Se produjo un error inesperado. Vuelva a intentarlo. Si el problema continúa, contáctenos."];
  noNetwork = ['No puede conectarse. Compruebe que está conectado a Internet y vuelva a intentarlo. Reinicie su teléfono si el problema de conexión persiste', 'Unable to connect. Please check that you are connected to the Internet and try again. Please reboot your phone if your connection problem persists'];
  //end message net related-------------------------

  MediaCamera = ['Abrir Cámara', 'Choose Camera'];
  Mediagallery = ['Abrir Galería', 'Choose Gallery'];
  cancelmedia = ['Cancelar', 'Cancel'];

  //notification delete
  msgConfirmTextNotifyDeleteMsg = ['¿Está seguro de que desea eliminar esta notificación?', 'Are you sure want to delete this notification?'];
  msgConfirmTextNotifyAllDeleteMsg = ['¿Quieres eliminar todas las notificaciones?', 'Do you want to delete all notification?'];

  //2nd sur name====================
  emptyFirstName123 = ['Por favor ingresar segundo apellido', 'Please enter second surname']
  FirstNameMinLength123 = ['Segundo apellido debe de contener mínimo 3 caracteres', 'Second surname must be of minimum 3 characters']
  FirstNameMaxLength123 = ['Segundo apellido no puede tener más de 50 caracteres', 'Second surname cannot be more than 50 characters']
  validFirstName123 = ['Segundo apellido debe contener solo caracteres', 'Second surname should be only characters']
  //sur name====================
  emptyFirstName12 = ['Por favor ingresar apellido', 'Please enter surname']
  FirstNameMinLength12 = ['Apellido debe tener mínimo 3 caracteres', 'Surname must be of minimum 3 characters']
  FirstNameMaxLength12 = ['Apellido no debe tener más de 50 caracteres', 'Surname cannot be more than 50 characters']
  validFirstName12 = ['Apellido solo debe tener letras', 'Surname should be only characters']

  //name====================
  emptyFirstName1 = ['Por favor ingresar el nombre', 'Please enter name']
  FirstNameMinLength1 = ['Nombre no puede tener menos de 3 carecteres', 'Name must be of minimum 3 characters']
  FirstNameMaxLength1 = ['Nombre no debe contener más de 50 caracteres', 'Name cannot be more than 50 characters']
  validFirstName1 = ['Nombre solo debe tener letras', 'Name should be only characters']
  // first name====================
  emptyFirstName = ['Por favor ingrese su primer nombre', 'Please enter first name']
  FirstNameMinLength = ['El nombre debe tener un mínimo de 3 caracteres', 'First name must be of minimum 3 characters']
  FirstNameMaxLength = ['El nombre no puede tener más de 50 caracteres', 'First name cannot be more than 50 characters']
  validFirstName = ['El nombre debe tener solo caracteres', 'First name should be only characters']
  // last name====================
  emptyLastName = ['Por favor ingrese su apellido', 'Please enter surname']
  LastNameMinLength = ['El apellido debe tener un mínimo de 3 caracteres', 'Surname must be of minimum 3 characters']
  LastNameMaxLength = ['El apellido no puede tener más de 50 caracteres', 'Surname cannot be more than 50 characters']
  validLastName = ['El apellido debe tener solo caracteres', 'Surname should be only characters']
  //identification no======================================
  emptyIdentification = ["Ingrese el número de identificación", "Please enter identification number"]
  identificationMinLength = ["El número de identificación debe tener un mínimo de 5 dígitos", "Identification number must be of minimum 5 digits"]
  identificationMaxLength = ["El número de identificación no puede tener más de 20 dígitos", "Identification number  cannot be more than 20 digits"]
  vailidIdentification = ["El número de identificación debe tener solo números", "Identification number should be only digit"]

  //identification no======================================
  emptyIdentification1 = ["Ingrese el número de cuenta", "Please enter bank identification number"]
  identificationMinLength1 = ["El número de cuenta debe tener un mínimo de 5 dígitos.", "Bank identification number must be of minimum 5 digits"]
  identificationMaxLength1 = ["El número de cuenta no puede tener más de 20 dígitos", "Bank identification number  cannot be more than 20 digits"]
  vailidIdentification1 = ["El número de cuenta solo debe contener números", "Bank identification number should be only digit"]

  //address==========
  emptyaddress = ['Por favor ingrese la direccion', "Please enter address"]
  maxlenaddress = ['La dirección no puede tener más de 250 caracteres.', "Address cannot be more than 250 characters."]
  minlenaddress = ['La dirección debe tener un mínimo de 3 caracteres.', "Address must be of minimum 3 characters."]
  //Landmark  ==========
  emptyLandmark = ['Por favor ingrese la dirección completa', "Please enter landmark"]
  maxlenLandmark = ['La dirección no puede tener más de 250 caracteres.', "Landmark cannot be more than 250 characters."]
  minlenLandmark = ['La dirección debe tener un mínimo de 3 caracteres.', "Landmark must be of minimum 3 characters."]

  //type_of_twelling==========
  emptytype_of_twelling = ['Ingrese el tipo de vivienda', "Please enter type of dwelling"]
  maxlentype_of_twelling = ['El tipo de vivienda no puede tener más de 50 caracteres.', "Type of dwelling cannot be more than 50 characters."]
  minlentype_of_twelling = ['El tipo de vivienda debe tener un mínimo de 3 caracteres.', "Type of dwelling must be of minimum 3 characters."]

  // nof of bed room==================
  emptyno_of_bedroom = ["Ingrese el número de dormitorios", "Please enter number of bedroom"]
  no_of_bedroomMinLength = ["El número de dormitorios debe tener un mínimo de 1 dígitos.", "Number of bedroom must be of minimum 1 digits"]
  no_of_bedroomMaxLength = ["El número de dormitorios no puede tener más de 3 dígitos.", "Number of bedrooms cannot be more than 3 digits"]
  vailidno_of_bedroom = ["El número de dormitorios debe ser solo un dígito", "Number of bedrooms should be only digit"]
  // members==================
  emptymembers = ["Ingrese el número de integrantes familiares", "Please enter number of members"]
  membersMinLength = ["Los miembros deben tener un mínimo de 1 dígitos.", "Members must be of minimum 1 digits"]
  membersMaxLength = ["Los miembros no pueden tener más de 3 dígitos.", "Members cannot be more than 3 digits"]
  vailidmembers = ["Los miembros deben ser solo dígitos", "Members should be only digits"]

  // no of adults==================
  emptyno_of_adults = ["Ingrese el número de adultos", "Please enter number of adults"]
  no_of_adultsMinLength = ["El número de adultos debe tener un mínimo de 1 dígito.", "Number of adult must be of minimum 1 digit"]
  no_of_adultsMaxLength = ["El número de adultos no puede tener más de 3 dígitos.", "Number of adults cannot be more than 3 digits"]
  vailidno_of_adults = ["El número de adultos debe ser solo un dígito", "Number of adults should be only digits"]

  // no of kids==================
  emptyno_of_kids = ["Por favor ingrese el número de niños", "Please enter number of kids"]
  no_of_kidsMinLength = ["El número de niños debe tener un mínimo de 1 dígito", "Number of kid must be of minimum 1 digit"]
  no_of_kidsMaxLength = ["El número de niños no puede tener más de 3 dígitos.", "Number of kids cannot be more than 3 digits"]
  vailidno_of_kids = ["El número de niños debe ser solo dígitos", "Number of kids should be only digits"]


  // ==============
  acceptserviceaerr = ["Aceptar el trabajo", "Please accept job"]

  //phone no===============
  emptyMobile = ["Ingrese el número móvil", "Please enter mobile number"]
  MobileMinLength = ['El número de teléfono móvil debe tener un mínimo de 8 dígitos', 'Mobile number must be of minimum 8 digits']
  MobileMaxLength = ['El número de móvil no puede tener más de 12 dígitos', "Mobile number cannot be more than 12 digits"]
  validMobile = ["El número del móvil debe tener solo números", "Mobile number should be only digits"]
  //phone no===============
  emptyMobile1 = ["Por favor ingresar el número de teléfono", "Please enter phone number"]
  MobileMinLength1 = ['Número de teléfono debe tener mínimo 8 dígitos', 'Phone number must be of minimum 8 digits']
  MobileMaxLength1 = ['Número de teléfono no puede tener más de 12 dígitos', "Phone number cannot be more than 12 digits"]
  validMobile1 = ["Solo se deben ingresar números", "Phone number should be only digits"]
  txt_phone_numer = ["Número de teléfono", "Phone Number"]
  //email============================
  emptyEmail = ["Por favor ingrese su correo electrónico", "Please enter email"]
  emailMaxLength = ['El correo electrónico no puede tener más de 50 caracteres', 'Email cannot be more than 50 characters']
  validEmail = ["Por favor introduzca un correo electrónico válido", "Please enter valid email"]

  //password=========================
  emptyPassword = ['Por favor introduzca una contraseña', 'Please enter password']
  PasswordMinLength = ['La contraseña debe tener un mínimo de 6 caracteres', 'Password must be of minimum 6 characters']
  PasswordMaxLength = ['La contraseña no puede tener más de 16 caracteres', 'Password cannot be more than 16 characters']
  spacePasswordpassMaxLength = ['No ingrese espacios en la contraseña', 'Please do not enter space in password']
  // For Confirm Password
  emptyConfirmPWD = ['Por favor confirme su contraseña', 'Please confirm your password']
  ConfirmPWDMatch = ['Las contraseñas no coinciden', 'Password does not match']
  ConfirmPWDMinLength = ['La contraseña debe tener un mínimo de 6 caracteres', 'Confirm password must be of minimum 6 characters']
  ConfirmPWDMaxLength = ['La contraseña no puede tener más de 16 caracteres', 'Confirm password cannot be more than 16 characters']


  //about==========
  emptyabout = ['Please enter about text', "Please enter about text"]
  maxlenabout = ['About cannot be more than 250 characters.', "About cannot be more than 250 characters."]
  minlenabout = ['About must be of minimum 3 characters.', "About must be of minimum 3 characters."]





  // For old Password
  emptyoldPassword = ['Ingrese la contraseña anterior', 'Please enter old password']
  PasswordoldMinLength = ['La contraseña anterior debe tener un mínimo de 6 caracteres', 'Old password must be of minimum 6 characters']
  PasswordoldMaxLength = ['La contraseña anterior no puede tener más de 16 caracteres', 'Old password cannot be more than 16 characters']
  spacePasswordoldMaxLength = ['No ingrese el espacio en la contraseña anterior', 'Please do not enter space in old password']
  // For New Password
  emptyNewPassword = ['Por favor ingrese nueva contraseña', 'Please enter new password']
  PasswordNewMinLength = ['La nueva contraseña debe tener un mínimo de 6 caracteres', 'New password must be of minimum 6 characters']
  PasswordNewMaxLength = ['La nueva contraseña no puede tener más de 16 caracteres', 'New password cannot be more than 16 characters']
  spacePasswordnewMaxLength = ['No ingrese espacios en la nueva contraseña', 'Please do not enter space in new password']
  // For Confirm Password
  emptyConfirmPWD = ['Por favor confirme su contraseña', 'Please confirm your password']
  ConfirmPWDMinLength = ['La contraseña debe tener un mínimo de 6 caracteres', 'Confirm password must be of minimum 6 characters']
  ConfirmPWDMaxLength = ['La contraseña no puede tener más de 16 caracteres', 'Confirm password cannot be more than 16 characters']
  spacePasswordcMaxLength = ['Por favor no ingrese espacios para confirmar la contraseña.', 'Please do not enter space in confirm password']
  ConfirmPWDMatch1 = ['Las contraseñas no coinciden', 'Password does not match']

  // account number===================================
  emptyAccNo = ["Ingrese el número de cuenta", 'Please enter account number']
  AccNoMinLength = ["El número de cuenta debe tener un mínimo de 14 caracteres", 'Account number must be of minimum 14 characters']
  AccNoMaxLength = ["El número de cuenta no puede tener más de 20 caracteres", 'Account number cannot be more than 20 characters']
  AccNoVailidLength = ["El número de cuenta debe ser solo números.", 'Account number should be only numbers.']

  emptyBank_name = ["Ingrese el nombre del banco", 'Please enter bank name']
  BanknameMinLength = ["El nombre del banco debe tener un mínimo de 3 caracteres", 'Bank name must be of minimum 3 characters']
  BanknameMaxLength = ["El nombre del banco no puede tener más de 50 caracteres", 'Bank name cannot be more than 50 characters']
  emptyAccountType = ["Seleccione el tipo de cuenta", 'Please select account type']
  //end  account number===================================
  emptyProfileImage = ["Seleccione la imagen de perfil", "Please select profile image"]

  emptyHouseSketchImage = ["Seleccione la imagen del croquis de la casa", "Please select house sketch image"]
  emptyProviderHouseImage = ["Seleccione una imagen de la fachada de la casa del proveedor", "Please select front of providers house"]

  // Bio===============
  emptyBio = ["Por favor ingrese una breve biografía sobre usted y los servicios que desempeña", "Please enter bio"]
  BioMinLength = ["La biografía debe tener un mínimo de 5 caracteres.", 'Bio must be of minimum 5 characters']
  BioMaxLength = ["La biografía no puede tener más de 250 caracteres", 'Bio cannot be more than 250 characters']

  emptyCovideReport = ["Por favor seleccione la imagen de su carnet de vacunación contra el Covid", "Please select Covid record card image"]
  emptyRecommendation = ["Seleccione una carta de recomendación", "Please select letter of recommendation"]
  // employer name==================
  emptyEmp = ['Ingrese el nombre del ex empleador', 'Please enter previus employer name']
  EmpMinLength = ['El nombre del ex empleador debe tener un mínimo de 3 caracteres', 'Previus Employer name must be of minimum 3 characters']
  EmpMaxLength = ['El nombre del ex empleador no puede tener más de 50 caracteres', 'Previus mployer name cannot be more than 50 characters']
  validEmp = ['El nombre del ex empleador debe contener solo caracteres', 'Previus Employer name should be only characters']

  //Message====
  emptyMessage = ["Por favor ingrese el texto del mensaje", 'Please enter message']
  maxlenMessage = ["El mensaje no puede tener más de 250 caracteres", 'Message cannot be more than 250 characters']
  minlenMessage = ["El mensaje debe tener un mínimo de 3 caracteres", 'Message must be of minimum 3 characters']

  emptyName = ["Por favor ingrese el nombre", 'Please enter name']
  maxlenName = ["El nombre no puede tener más de 50 caracteres", 'Name cannot be more than 50 characters']
  minlenName = ["El nombre debe tener un mínimo de 3 caracteres", 'Name must be of minimum 3 characters']

  // title=============
  emptyTitle = ["Por favor ingrese el título", 'Please enter title']
  maxlenTitle = ["El título no puede tener más de 50 caracteres", 'Title cannot be more than 50 characters']
  minlenTitle = ["El título debe tener un mínimo de 3 caracteres", 'Title must be of minimum 3 characters']

  // date
  emptyDate = ["Por favor seleccione la fecha", "Please select date"]
  emptyDatetime = ["Seleccione fecha y hora", "Please select date & time"]
  emptyTime = ["Por favor seleccione hora", "Please select time"]

  //
  ratin_revie_empty = ["Por favor ingrese la calificación", "Please enter rating"]
  //---------------------------share app page---------------------------//
  headdingshare = ['He compartido un enlace contigo a una nueva app', "I've shared a link with you to a great new App"]
  sharelinktitle = ['Miksa App Link', 'Enlace de la aplicación Miksa']


  //==========================Confirmation Messages=============================
  cancel_text = ['Cancelar', 'Cancel']
  cancel = ['Cancelar', 'Cancel']
  Yes = ['sí', 'Yes']
  No = ['No', 'No']
  ok_text = ['OK', 'Ok']
  save = ['Ahorrar', 'Save']
  Done = ['Hecho', 'Done']
  Confirm = ["Confirmar", 'Confirm']
  Save = ['Ahorrar', 'Save']
  Skip = ['Saltar', 'Skip']
  Clear = ['Limpiar', 'Clear']
  titleexitapp = ['Salir de Miksa', 'Exit Miksa']
  exitappmessage = ['¿Deseas salir de Miksa?', 'Do you want to exit app?']
  msgConfirmTextLogoutMsg = ['¿Estás seguro de que quieres cerrar sesión?', 'Are you sure  want to Logout?']
  msgConfirmTextDeleteURAccMsg = ['¿Estás seguro de que quieres eliminar tu cuenta?', 'Are you sure  want to delete your account?']
  msgLoginError = [' Debes ingresar primero', 'Please login first']


  msgdeleteJobCOnfirm = ['¿Estás seguro de que quieres eliminar este trabajo?', 'Are you sure  want to delete this job?']
  msgcacelJobCOnfirm = ['¿Estás seguros que deseas cancelar este trabajo?', 'Are you sure  want to cancel this job?']
  msgremeveSaveJobCOnfirm = ['¿Está seguro de que desea eliminar todos los trabajos de tu listado?', 'Are you sure want to remove all jobs from your saved list ?']
  msgRepotProviderConfirm = ['¿Está seguro de que deseas reportar a este proveedor?', 'Are you sure want to report this provider']
  msgAcceptRejectJob = ['¿Está seguro de que desea rechazar el trabajo porque si rechaza el mismo trabajo del cliente 3 veces, su cuenta se desactivará automáticamente?', 'Are you sure you want to reject the job because if you reject the same customer job 3 times your account will be deactivated automatically']
  msgAcceptEndService = ['¿Estás seguros que deseas finalizar este trabajo?', 'Are you sure you want to end this service']


  //============Otp===========
  otp_verification = ['Verificación', 'Verification']
  otp_verification1 = ['Por favor intrducir código OTP', 'Please type verification code sent to']
  otp_verification13 = ['móvil', 'mobile']
  txt_edit = ['Editar', 'Edit']
  txt_otp = ['OTP', 'OTP']
  txt_RESEND = ['Reenviar', 'Resend']
  txt_VERIFY = ['Verificar', 'Verify']
  //==========forgot================

  txt_Forgot_Pass1 = ['Olvidó su contraseña', 'Forgot Password']
  txt_Forgot_Pass2 = ['Por favor ingresar su correo para resetear la cuenta', 'Please enter your email for reset account']
  txt_Forgot_Pass3 = ['Enviar', 'Submit']

  //edit profile=================
  Choose_City = ['Elegir Ciudad', 'Choose City']
  Choose_Gender = ['Elegir Género', 'Select Gender']
  female_txt = ['Mujer', 'Female']
  male_txt = ['Hombre', 'Male']
  Edit_Profile_txt = ['Editar Perfil', 'Edit Profile']
  dob_txt = ['Fecha de nacimiento', 'Date of birth']
  Gender_txt = ['Género', 'Gender']
  about_txt = ['Sobre', 'About']
  Take_a_photo_txt = ['Tomar foto', 'Take a photo']
  Choose_from_library_txt = ['Elegir de la librería', 'Choose from library']
  settings_txt = ['Configuración', 'Settings']
  my_waallet_txt = ['Mi Billetera', 'My Wallet']
  Address_txt = ["Dirección", "Address"]
  Optional_txt = ["Opcional", "Optional"]
  logout_txt = ['Salir', 'Logout']
  txt_edit_p_change_add = ["Cambiar dirección", "Change Address"]
  txt_edit_p_change_loca = ["Cambiar ubicación", "Change Location"]
  txt_c_landmark_txt = ["Dirección y referencia", "Landmark"]
  txt_tax_isd = ["Impuesto ISD", "ISD Tax"]
  //change pass================
  change_language_txt = ["Cambiar contraseña", 'Change Password']
  old_pass_txt = ["Contraseña anterior", 'Old Password']
  new_pass_txt = ["Nueva contraseña", 'New Password']
  c_pass_txt = ["Confirmar nueva contraseña", 'Confirm New Password']
  txt_Submit = ["Enviar", 'Submit']
  txt_logout = ["Salir", "LOGOUT"]
  txt_logout_confirm = ["Deseas salir?", "Do you want to logout?"]

  ///////////////////////////////////////////////////////app Language///////////////////////////////////////////////////////////////

  //signup page-----------------------
  txt_mobile_no = ["Número de teléfono móvil", "Mobile Number"]
  txt_customer = ["Cliente", "Customer"]
  txt_provider = ["Proveedor", "Provider"]
  txt_fname = ["Primer nombre", "First Name"]
  txt_surname = ["Apellido", "Surname"]
  txt_2_surname = ["Segundo apellido", "Second surname"]
  txt_identification_no = ["Número de identificación", "Identification Number"]
  txt_address = ["Locación", "Address"]
  txt_t_of_dwelling = ["Tipo de vivienda", "Type Of Dwelling"]
  txt_n_o_bedroom = ["Numero de habitaciones", "Number Of Bedrooms"]
  txt_basement = ["Sótano", "Basement"]
  txt_rooftop = ["Altillo", "Rooftop"]
  txt_gardern = ["Jardín", "Garden"]
  txt_Members = ["Grupo Familiar", "Members"]
  txt_n_o_adults = ["Cuantos adultos", "How Many Adults"]
  txt_n_o_kids = ["Cuantos niños", "How Many Kids"]
  txt_emails = ["correo electrónico", "Email Address"]
  txt_password = ["Contraseña", "Password"]
  txt_cpassword = ["Confirmar Contraseña", "Confirm Password"]
  txt_term_condi = ["Términos de servicio", "Terms of service"]
  txt_term_condi1 = ["Al registrarse, usted acepta nuestra", "By signing up, you agree to our"]
  txt_pri_poli = ["política de Privacidad", "Privacy Policy"]
  txt_and = ["y", "and"]
  txt_signup = ["Registrarse", "Sign up"]
  txt_do_have_acc = ["¿Tiene usted una cuenta con nosotros?", "Do you have an account?"]
  txt_Login = ["Ingresar", "Login"]

  // login_page======================
  txt_login_remember_me = ["Recuérdame", "Remember Me"]
  txt_login_forgot_pass = ["¿Has olvidado tu contraseña?", "Forgot Password?"]
  txt_login_forgot_pass1 = ["Por favor ingrese su número de móvil registrado", "Please enter you registered mobile number"]
  txt_login_or_l_w = ["o inicia sesión con", "or login with"]
  txt_login_do_not_have_acc = ["¿No tienes una cuenta?", "Don't have an account?"]

  // bank page=========================
  txt_enter_bank_details = ["Ingrese los datos bancarios", "Enter Bank Details"]
  txt_enter_bank_details1 = ["Ingrese sus datos bancarios", "Please enter your bank details"]
  txt_bank_name = ["Nombre del banco", "Bank Name"]
  txt_bank_types_off_acc = ["Tipo de cuenta", "Type of Account"]
  txt_bank_personal = ["Personal", "Personal"]
  txt_bank_business = ["Empresarial", "Business"]
  txt_bank_Check = ["Corriente", "Check"]
  txt_bank_Check12 = ["Seleccione tipo de cuenta", "Select account type"]
  txt_bank_Saving = ["Ahorros", "Saving"]
  txt_bank_acc_number = ["Número de cuenta", "Account Number"]
  txt_bank_countinue_btn = ["Continuar", "Continue"]
  // upload photo==================
  txt_upload_photo_ = ["Subir foto", "Upload Photo"]
  txt_upload_photo_1 = ["Sube tu foto de perfil", "Please upload your profile picture"]
  // select services==================
  txt_select_service = ["Por favor selecciona el o los servicios", "Please select services"]
  txt_select_service_search = ["Buscar", "Search"]
  txt_select_service_txt = ["Seleccionar servicio", "Select Service"]
  txt_select_service_txt1 = ["Agregue los siguientes servicios", "Please add the following services"]
  txt_select_service_per_hours = ["Por hora", "Per hour"]
  txt_select_service_counti = ["Continuar", "Continue"]
  txt_total_service_amt = ["Importe total del servicio", "Total service amount"]
  // house sketch=====================
  txt_h_s_upload_sketch = ["Cargar croquis", "Upload House Sketch"]
  txt_h_s_upload_sketch12 = ["Croquis", "House Sketch"]
  txt_h_s_upload_sketch1 = ["Fachada frontal de la casa del proveedor", "Front of provider's house"]
  // Bio txt
  txt_bio_txxt = ["Biografía", "Bio"]
  txt_bio_txxt1 = ["Por favor ingrese informcación sobre usted", "Please enter about yourself"]
  txt_bio_decribe_hare = ["Describa aquí", "Describe here"]
  // account succ
  txt_acc_succ1 = ["Tu cuenta ha sido creada", "Your account has been  created"]
  txt_acc_succ2 = ["El administrador aprobará", "successfully Admin will approve"]
  txt_acc_succ3 = ["en 24 horas", "in 24 hours"]
  txt_acc_succ4 = ["Continuar", "Proceed"]
  // covide report ==================
  txt_uploade_covid_txt = ["carnet de vacunación COVID-19", "COVID-19 Vaccination Record Card"]
  txt_uploade_covid_txt1 = ["Subir carta de recomendación", "Upload letter of recommendation"]
  txt_uploade_covid_emp_name = ["Empleador Anterior", "Previous employer name"]
  txt_uploade_covid_mob_no = ["Número de teléfono móvil", "Mobile Number"]
  //change pass================
  change_language_txt = ["Cambiar la contraseña", "Change Password"]
  old_pass_txt = ["Contraseña anterior", "Old Password"]
  new_pass_txt = ["Nueva contraseña", "New Password"]
  c_pass_txt = ["Confirmar Contraseña", "Confirm Password"]
  txt_Submit = ["Enviar", "Submit"]

  // contact =================
  txt_contact_txt1 = ["Contáctanos", "Contact Us"]
  txt_contact_txt2 = ["Configure el correo electrónico de contacto con nosotros", "Configure contact us email to be"]
  txt_contact_txt_name = ["Nombre completo", "Full Name"]
  txt_contact_txt_emeil = ["correo electrónico", "Email"]
  txt_message = ["mensaje", "Message"]
  txt_send = ["Enviar", "Send"]
  //change service=============
  txt_change_service = ["Cambio de Sericios", "Change Services"]
  // settings page
  txt_settings = ["Configuraciones", "Settings"]
  txt_settings_acc = ["Cuenta", "Account"]
  txt_settings_support = ["Soporte", "Support"]
  txt_settings_push = ["Notificaciones", "Push Notification"]
  txt_settings_edit_pro = ["Editar perfil", "Edit Profile"]
  txt_settings_edit_bank_edit = ["Editar información del banco", "Edit Bank Details"]
  txt_settings_wallet = ["Mi billetera", "My Wallet"]
  txt_settings_Earnings = ["Mis Ganancias", "My Earnings"]
  txt_settings_chn_services = ["Cambiar servicios", "Change services"]
  txt_settings_chn_covid = ["Cambiar Carnet de Covid", "Change covid report"]
  txt_settings_chn_house_ske = ["Cambio de croquis", "House sketch change"]
  txt_settings_termCond = ["Términos y condiciones", "Terms And Conditions"]
  txt_settings_privacy = ["Políticas de privacidad", "Privacy Policy"]
  txt_settings_about = ["Sobre nosotros", "About Us"]
  txt_settings_faq = ["FAQ", "FAQ"]
  txt_settings_share_app = ["Compartir aplicación", "Share App"]
  txt_settings_rate_app = ["Calificar aplicacion", "Rate App"]
  txt_settings_logout = ["Cerrar sesión", "Logout"]
  txt_edit_pro_update = ["Actualizar", "Update"]
  // home ==========
  txt_home_dicocer = ["Descubra los servicios", "Discover Services"]
  txt_home_continue_btn = ["Continuar", "Continue"]
  txt_home_service_not_found = ["Servicios no encontrados", "Services not found"]
  // ==select provider
  txt_sele_pro_emty = ["Por favor seleccione al proveedor", "Please select provider"]

  // creatye job
  create_hib_msg = ["Ingrese mensaje", "Enter message"]
  txt_create_job_title = ["Crear nuevo trabajo", "Create New Job"]
  txt_create_job_upload = ["Cargar imágenes (opcional)", "Upload pictures (Optional)"]
  txt_create_job_upload1 = ["Cargue máximo 3 imágenes", "Please upload (Max 3 pictures)"]
  txt_create_job_enter_title = ["Ingrese el título", "Enter Title"]
  txt_create_job_enter_loc = ["Ingrese la ubicación", "Enter Location"]
  txt_create_job_enter_selec_ser = ["Servicio seleccionado", "Selected Service"]
  txt_create_job_change = ["Cambio", "Change"]
  txt_create_job_avial_date = ["Fecha y hora de disponibilidad", "Availability date and time"]
  txt_create_job_avial_date1 = ["(Cuándo deseas este trabajo)", "(when you want this job )"]
  txt_create_job_select_date = ["Seleccionar fecha", "Select Date"]
  txt_create_job_select_time = ["Seleccionar hora", "Select Time"]
  txt_create_job_warning1 = ["el proveedor debe utilizar mascarilla y asistir con ropa adecuada de trabajo", "the provider must wear a mask and should be"]
  txt_create_job_warning2 = ["una opción en el formulario de registro para cargar un", "an option in the registration form to upload a"]
  txt_create_job_warning3 = ["Resultado de la prueba Covid, fecha en que se realizó.", "Covid test result, date it were realized."]
  txt_create_job_warning_box = ["Advertencia sobre COVID", "warning box about COVID"]
  txt_create_job_wallet_amt = ["saldo de la billetera", "Wallet amount"]
  txt_create_job_totla = ["Total", "Total"]
  txt_create_job_submit = ["Enviar", "Submit"]
  // Select Provider
  txt_select_provider = ["Seleccionar proveedor", "Select Provider"]
  txt_select_error_txt = ["Proveedor no disponible para servicios seleccionados", "Provider not available for selected services"]
  // Instructions
  txt_instructions = ["Instrucciones", "Instructions"]
  // job success
  txt_job_suuc = ["Trabajo creado exitosamente", "Job Created Successfully"]
  txt_job_suuc1 = ["Trabajo terminado exitosamente", "Job Completed Successfully"]
  txt_job_job_id = ["Id de trabajo", "Job id"]
  txt_job_date = ["Fecha", "Date"]
  txt_job_date1 = ["fecha de trabajo", "Completed date"]
  txt_job_ok = ["ok", "Ok"]
  txt_job_close = ["Cerrar", "Close"]

  //chat //
  name_txt12 = ['Nombre', 'Name']
  chattextinputmessage = ['Mensaje', "Message"]
  chataction = ['Acción', "Action"]
  chatreport = ['Reportar usuario', "Report User"]
  chatclear = ['Eliminar chat', "Clear Chat", "Clear Chat"]
  chatcancel = ['Cancelar', "Cancel"]
  reportmessagepopup = ['Estás seguro que deseas enviar reporte? report', "Are your sure you want to ? report"]
  chatclearpopup = ['Estás seguro que? clear chat', "Are your sure you to ? clear chat"]
  inbox_not_found = ['Bandeja vacía', 'Inbox is empty']
  privacypolicy = ["Opciones", "Options"]
  takephot = ["Tomar foto", "Take picture", "Take picture"]
  chooselib = ["Elefir de la galería", "Choose from library"]
  rate_now = ["Califica ahora", "Rate Now"]
  text_chat = ["Chat", "Chat", "Chat"]
  text_search1 = ["Buscar", "Search"]

  // content=====================
  txt_content = ["Sobre nosotros", "About Us"]
  txt_content_privacy_policy = ["Política de privacidad", "Privacy Policy"]
  txt_content_terms_of_service = ["Términos de servicio", "Terms of service"]
  txt_content_App_User_Guide = ["Guía del usuario de la aplicación", "App User Guide"]
  //select services===========================
  txt_select_service = ["Seleccionar servicios", "Select Services"]

  // Detail jobs==============
  txt_detail_job = ["Seleccionar opción", "Select Option"]
  txt_detail_job_edit = ["Editar", "Edit"]
  txt_detail_job_Delete = ["Borrar", "Delete"]
  txt_detail_job_Cancel = ["Cancelar trabajo", "Job Cancel"]
  txt_detail_job_report = ["Informe trabajo", "Job Report"]
  txt_detail_job_rating_review = ["Calificación y reseña", "Rating And Review"]
  txt_detail_job_Review = ["Revisar", "Review"]
  txt_detail_job_submit = ["Enviar", "Submit"]
  txt_detail_job_id = ["Identificación del trabajo", "Job id"]
  txt_detail_job_Availability = ["Disponibilidad", "Availability"]
  txt_detail_job_Provider_Detail = ["Detalles del proveedor", "Provider Details"]
  txt_detail_job_Services = ["Servicios", "Services"]
  txt_detail_job_Started = ["Realizándose", "Started"]
  txt_detail_job_End_j = ["Finalizar trabajo", "End Job"]
  txt_detail_job_not_s = ["No empezado", "Not started"]
  txt_detail_job_Payment_Detail = ["Detalles de pago", "Payment Detail"]
  txt_detail_job_txn_id = ["Identificación de Txn", "Txn  id"]
  txt_detail_job_last_txn_id = ["Última identificación de Txn", "Last Txn  id"]
  txt_detail_job_last_Total_Hours = ["Horas totales", "Total Hours"]

  txt_detail_job_last_already_Total_Hours = ["Monto Pagado", "Paid Amount"]
  txt_detail_job_Pay_Amounts = ["Monto a pagar", "Pay Amount"]
  txt_detail_job_totla = ["Total", "Total"]
  txt_detail_job_Pay_Now = ["Pagar ahora", "Pay Now"]
  txt_detail_job_ratee_now = ["Califica ahora", "Rate Now"]
  txt_detail_job_acept = ["Aceptar", "Accept"]
  txt_detail_job_Reject = ["Rechazar", "Reject"]
  txt_detail_job_statr_job = ["Iniciar", "Start Job"]
  txt_detail_job_client_details = ["Detalles del cliente", "Client Detail"]
  txt_detail_job_rport1 = ["Reporte", "Report"]
  txt_detail_job_rejectedd = ["Rechazado", "Rejected"]


  txt_covide_12 = ["El proveedor debe usar mascarilla en todo momento en el que se realiza el trabajo, de igual manera debe vestir de manera apropiada para ejecutar el trabajo", "El proveedor debe usar mascarilla en todo momento en el que se realiza el trabajo, de igual manera debe vestir de manera apropiada para ejecutar el trabajo"]
  // txt_covide_121 = ["una opción en el formulario de registro para cargar un", "an option in the registration form to upload a"]
  // txt_covide_122 = ["Carnet de vacunación contra el Covid.", "Covid record card."]

  txt_status_pending = ["Pendiente", "Pending"]
  txt_status_accepted = ["Aceptado", "Accepted"]
  txt_status_Inprogress = ["En curso", "Inprogress"]
  txt_status_Completed = ["Terminado", "Completed"]
  txt_status_Cancelled = ["Cancelado", "Cancelled"]
  txt_status_rejected = ["Rechazado", "Rejected"]

  //Edit profile _p =====================
  txt_edit_pro_p_edit_bank_details = ["Editar detalles bancarios", "Edit Bank Details"]
  txt_edit_pro_p_edit_Office = ["Oficina", "Office"]
  txt_edit_pro_p_edit_Apartment = ["Departamento", "Apartment"]
  txt_edit_pro_p_edit_House = ["Casa", "House"]
  // faq==================
  txt_faq_faq = ["FAQ", "FAQ"]
  txt_faq_faq1 = ["Preguntas frecuentes", "Frequently Ask Questions"]
  //1home p ==============
  txt_home_p_discover = ["Descubrir", "Discover"]
  txt_home_p_Job_Request = ["Solicitud de trabajo", "Job Request"]
  txt_home_p_Job_serach = ["Buscar por ID de trabajo", "Search by job id"]
  txt_home_p_Job_recent = ["Trabajos recientes", "Recent Jobs"]
  txt_home_p_Job_not = ["No tienes ningun trabajo", "You don't have any job"]
  txt_home_p_View_All = ["Ver todo", "View All"]
  txt_home_my_jobs = ["Mis trabajos", "My Jobs"]
  txt_home_p_View_All_jobs = ["Todos los trabajos", "All Jobs"]
  txt_home_p_View_All_search = ["Buscar trabajo", "Search Job"]
  // inbox==================
  txt_inbox_txt = ["Bandeja de entrada", "Inbox"]
  txt_inbox_txt_search = ["Busca aquí...", "Search here..."]
  txt_inbox_not = ["La bandeja de entrada está vacía", "Inbox Is Empty"]
  // job_edit==================
  txt_job_edit = ["Editar trabajo", "Edit Job"]
  txt_job_edit_location = ["Ubicación", "Location"]

  // my booking===================
  txt_my_job_booking = ["Mi reserva", "My Booking"]
  txt_my_job_booking1 = ["Todos los trabajos", "All Jobs"]
  txt_job_edit_location = ["Ubicación", "Location"]
  txt_job_edit_not = ["No has creado ningún trabajo", "You not created any jobs"]
  // myprofile
  txt_myprofile_l_o_r = ["Carta de recomendación", "Letter Of Recommendation"]
  txt_job_notF = ["No encontré ningún trabajo", "Not found any job"]
  // ====================
  txt_notification_txt = ["Notificaciones", "Notifications"]
  txt_notification_txt_not = ["No tienes ninguna notificación", "You don't have any notification"]
  // other user datat
  txt_other_user_data_not = ["Datos del proveedor no encontrados", "Provider Data Not Found"]
  txt_other_user_data_call = ["Llamada", "Call"]
  txt_other_user_data_total_earns = ["Ganancias totales", "Total Earns"]
  txt_other_user_data_Completed_Jobs = ["Trabajos completados", "Completed Jobs"]

  // rating=============
  txt_rating_revie_txt = ["Calificaciones", "Ratings"]
  txt_rating_revie_txt1 = ["Calificaciones", "Rating"]
  txt_rating_revie_txt12 = ["Reseñas", "Review"]
  // saved================
  txt_saved_txt = ["Guardado", "Saved"]
  txt_saved_txt_not = ["No has guardado ningún trabajo", "You have not saved any job"]
  txt_search_pro_not = ["Datos no encontrados", "Data Not Found"]

  // select provider
  txt_search_txt_pro = ["Seleccionar proveedor", "Select Provider"]
  // wallet================
  txt_wallet_txt = ["Billetera", "Wallet"]
  txt_wallet_txt1 = ["Saldo de la billetera", "Wallet Amount Balance"]
  txt_wallet_txt1_not = ["Datos no encontrados", "Data Not Found"]
  title_txt = ['título', 'title']

  //earnin
  txt_Earnings_txt = ["Mis Ganancias", "My Earnings"]
  txt_Earnings_txt1 = ["Saldo de ganancias", "Earning Amount Balance"]
  reportTextErr12 = ["Ingresar reportet", "Enter report"]
  txtpaymentpr = ["Por favor no presionar atrás mientras se procesa el pago", "Please don't press back until the payment process"]
  reportTextErr = ["Por favor ingresar el reportet", "Please enter report"]
  cancelResonTextErr = ["Por favor ingresar la razón de la cancelación", "Please enter cancel reason"]
  markComplete_txt = ["Marcar como coompletado", "Mark Complete"]

  // ================
  timediiferr = ["La diferencia entre dos fechas reservas deben ser mayor a 30 minutos", "The time difference between two booking dates should be 30 minutes plus"]

}
export const Lang_chg = new Language_provider();