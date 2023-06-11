<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Session;
use Crypt;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;
use App\Models\Admin;
use App\Models\contactInfo;
use App\Models\User;
use App\Models\SubscriptionPlan;
use App\Models\knowledgeBase;
use App\Models\SmtpSetting;
use App\Models\PaymentGateway;
use App\Models\WebsiteSetting;
use App\Models\CurrencyRate;
use App\Models\News;
use App\Models\CustomerSupport;
use App\Models\CustomerSupportAnswer;
use App\Models\SubBlogknowledgebase;
use App\Models\Support;
use App\Models\GlosseryModel;
use App\Models\GuidesModel;
use App\Models\BlogModel;

class SuperAdminController extends Controller
{
    //
    public function index(Request $request){
      $getdata=User::Where('status','1')->orderBy('id','desc')->get();
      $usercount=User::Where('status','1')->count();
      $result=[
        'users'=>$getdata,
        'usercount'=>$usercount,
      ];
    	if(!empty(session()->get('admin_id'))){
        return view('admin/dashboard',$result);
        }else{
          return view('admin/signin');
        }
    }

    public function signIn(Request $request){
        return view('admin/signin');
    }

    public function usermanagement(Request $request){
    	if(!empty(session()->get('admin_id'))){
        return view('admin/usermanagement');
        }else{
          return view('admin/signin');
        }
    }
    public function billing(Request $request){
        if(!empty(session()->get('admin_id'))){
        return view('admin/billing');
        }else{
          return view('admin/signin');
        }
    }

    public function customersupport(Request $request){
    	if(!empty(session()->get('admin_id'))){
    	    $details = CustomerSupport::orderBy('id','desc')->get()->toArray();
            return view('admin/customersupport', compact('details'));
         }else{
            return view('admin/signin');
         }
    }

    public function subscription(Request $request){

        if(!empty(session()->get('admin_id'))){
        $details = SubscriptionPlan::where('deleted', '!=', '1')->orderBy('id','desc')->get()->toArray();
        return view('admin/subscription', compact('details'));
        }else{
          return view('admin/signin');
        }
    }

    public function createsubscription(Request $request){

        if(!empty(session()->get('admin_id'))){
        return view('admin/createsubscription');
        }else{
          return view('admin/signin');
        }
    }

    public function editsubscription(Request $request,$id){

        if(!empty(session()->get('admin_id'))){
          $base_64 = $id . str_repeat('=', strlen($id) % 4);
        $ids = base64_decode($base_64);
        $subscription_details = SubscriptionPlan::where('id',$ids)->first();
        return view('admin/editsubscription', compact('subscription_details'));
        }else{
          return view('admin/signin');
        }
    }

    public function newsfeed(Request $request){
        if(!empty(session()->get('admin_id'))){
        $details = News::where('delete_status', '!=', '1')->orderBy('id','desc')->get()->toArray();
        return view('admin/newsfeed', compact('details'));
        }else{
          return view('admin/signin');
        }
    }

    public function createnewsfeed(Request $request){
        if(!empty(session()->get('admin_id'))){
        return view('admin/createnewsfeed');
        }else{
              return view('admin/signin');
        }
    }

    public function editnewsfeed(Request $request,$id){
        if(!empty(session()->get('admin_id'))){
              $base_64 = $id . str_repeat('=', strlen($id) % 4);
              $ids = base64_decode($base_64);
              $details = News::where('id',$ids)->first();
              return view('admin/editnewsfeed', compact('details'));
        }else{
              return view('admin/signin');
        }
    }

    public function profile(Request $request){

         if(!empty(session()->get('admin_id'))){
           $user_id = session()->get('admin_id');
        //print_r($user_id);die;
    	$details = Admin::where('id', $user_id)->first();
        return view('admin/profile', compact('details'));
        }else{
          return view('admin/signin');
        }
    }

    public function smtpsetting(Request $request){

        if(!empty(session()->get('admin_id'))){
          $details = SmtpSetting::orderBy('id','desc')->first();
    	//dd($details);die;
        return view('admin/smtpsetting', compact('details'));
        }else{
          return view('admin/signin');
        }
    }

    public function payment(Request $request){

        if(!empty(session()->get('admin_id'))){
         $stripe_details = PaymentGateway::where('type','stripe')->first();
    	 $paypal_details = PaymentGateway::where('type','paypal')->first();
         return view('admin/payment', compact('stripe_details','paypal_details'));

        }else{
          return view('admin/signin');
        }
    }

    public function customermessage(Request $request,$id){
        if(!empty(session()->get('admin_id'))){
            $base_64 = $id . str_repeat('=', strlen($id) % 4);
            $ids = base64_decode($base_64);
            $details = CustomerSupport::where('id',$ids)->first();
            return view('admin/customermessage', compact('details'));
        }else{
          return view('admin/signin');
        }

    }

    public function websitesetting(Request $request){

        if(!empty(session()->get('admin_id'))){
          $details = WebsiteSetting::orderBy('id','desc')->first();
    	  //dd($details);die;
        return view('admin/websitesetting', compact('details'));
        }else{
          return view('admin/signin');
        }
    }

    public function emailtemplate(Request $request){
        return view('admin/emailtemplate');
    }

    public function editemailtemplate(Request $request){
        return view('admin/editemailtemplate');
    }

    public function pages(Request $request){
        return view('admin/pages');
    }

    public function editpages(Request $request){
        return view('admin/editpages');
    }

    public function forgotpassword(Request $request){
        return view('admin/forgotpassword');
    }


    /**
     * function to generate otp
     * Vikash Rai
     * @return \Illuminate\Http\Response
    */
    private function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }

    /**
     * function for login
     * Vikash Rai
     * @return \Illuminate\Http\Response
    */
    public function login(Request $request){
		$userdata = Admin::where('email', $request->email)->first();
        if(!empty($userdata)){

	       if($userdata->password == $request->password){
	           $otp_value = $this->generateOTP();
	           $otp = $otp_value;
	           $data = ['otp' => $otp];
			   $result = Admin::where('email', $request->email)->update($data);
			     /*---------code to send email -----*/

                $mailData = [
                    'title' => 'Verification Email',
                    'body' => 'Your OTP is : '.$otp
                ];

              $res =  Mail::to($request->email)->send(new \App\Mail\LoginMail($mailData));
             /*---------code to send email -----*/
             $base_64 = base64_encode($request->email);
             $encryptedemail = rtrim($base_64, '=');
              return redirect()->to('otp-verification/'.$encryptedemail)->with('success','Otp sent successfully on email!');
	        }else{
	             return redirect()->to('signin')->with('error','Wrong Password!');

	        }
        }else{
             return redirect()->to('signin')->with('error','Email not registered!');
           }
    }

    /**
     * function for creating new subsciption plan
     * Vikash Rai
     * @return \Illuminate\Http\Response
    */
    public function addSubscriptionPlan(Request $request){

     $existing_package_check = SubscriptionPlan::where('package_name', $request->package_name)->first();
     if($existing_package_check){
    return redirect()->route('create-subscription')->with('success','Subscription plan already exist with this package name!');
     }else{
      $input = $request->all();
      $input['status'] = 1;
      $res = SubscriptionPlan::create($input);
      return redirect()->route('subscription')->with('success','Subscription plan created successfully');
    }
   }

   /**
     * function to update subsciption plan
     * Vikash Rai
     * @return \Illuminate\Http\Response
    */
   public function updateSubscriptionPlan(Request $request){
     $package_id = $request->id;
     $base_64 = base64_encode($package_id);
     $encryptid = rtrim($base_64, '=');
     $input = [
        'package_name' => $request->package_name,
        'package_amount' => $request->package_amount,
        'package_duration' => $request->package_duration,
        'package_short_description' => $request->package_short_description,
        'package_long_description' => $request->package_long_description,
     ];
     $res = SubscriptionPlan::where('id', $package_id)->update($input);
      return redirect()->to('edit-subscription/'.$encryptid)->with('success','Subscription plan updated successfully');

   }


    /**
     * function to change password
     * Vikash Rai
     * @return \Illuminate\Http\Response
    */
   public function changePassword(Request $request){
   	$user_id = session()->get('admin_id');
   	$new_password = $request->new_password;

   	$admindetails = Admin::where('id', $user_id)->first();
   	if($admindetails->password == $request->old_password){
        $data = ['password' => $new_password];
        $res = Admin::where('id', $user_id)->update($data);
         /*---------code to send email -----*/
			    $otp = $this->generateOTP();
                $mailData = [
                    'title' => 'New Password',
                    'body' => 'Your Password is :'.$new_password
                ];

              $result =  Mail::to($admindetails->email)->send(new \App\Mail\LoginMail($mailData));
          /*---------code to send email -----*/

       //  print_r($result);die;
        return redirect()->to('profile')->with('success','Password updated!');
   	}else{
   	    return redirect()->to('profile')->with('success','Old password is wrong!');
   	}
   }

   /**
     * function to update profile
     * Vikash Rai
     * @return \Illuminate\Http\Response
    */
   public function updateProfile(Request $request){
   	     $user_id = session()->get('admin_id');

   	    if(!empty($request->profile_picture)){
         $destinationPath = base_path('images');
          $profile_picture = time().'.'.$request->profile_picture->getClientOriginalExtension();
          $request->profile_picture->move($destinationPath, $profile_picture);
           $data = [
                'name' => $request->full_name,
                'mobile' => $request->mobile,
                'profile_picture' => $profile_picture
              ];
       }else{
           $data = [
                'name' => $request->full_name,
                'mobile' => $request->mobile,
               // 'profile_picture' => $profile_picture
              ];
       }

      $res = Admin::where('id', $user_id)->update($data);
       return redirect()->to('profile')->with('success','Profile updated!');
   }

   public function saveSmtpSetting(Request $request){
   	  $existing_smtpsetting_check = SmtpSetting::where('id', $request->id)->first();
     if($existing_smtpsetting_check){
       $data = [
          'smtp_server_host' => $request->smtp_server_host,
          'smtp_port_number' => $request->smtp_port_number,
          'smtp_username' => $request->smtp_username,
          'smtp_password' => $request->smtp_password,
          'email_encryption_type' => $request->email_encryption_type,
       ];
       $res = SmtpSetting::where('id', $request->id)->update($data);
       return redirect()->to('smtp-setting')->with('success','SMTP Setting updated!');

     }else{
      $input = $request->all();
      $res = SmtpSetting::create($input);
      return redirect()->to('smtp-setting')->with('success','SMTP Setting created!');
    }
   }

   public function savePaymentGatewaySetting(Request $request){
   	 $existing_paymentgateway_check = PaymentGateway::where('id', $request->id)->first();
     if($existing_paymentgateway_check){
       $data = [
          'username' => $request->username,
          'password' => $request->password,
          'api_signature' => $request->api_signature,
          'currency' => $request->currency,
          'status' => $request->status,
          'type' => $request->type,
       ];
       $res = PaymentGateway::where('id', $request->id)->update($data);
        return redirect()->to('payment-gateway')->with('success','Payment Gateway Setting updated!');
     }else{
      $input = $request->all();
      $res = PaymentGateway::create($input);
       return redirect()->to('payment-gateway')->with('success','Payment Gateway Setting created!');
    }
   }

   public function otpVerification(Request $request,$id){
   	$base_64 = $id . str_repeat('=', strlen($id) % 4);
    $email = base64_decode($base_64);
   // print_r($email);die;
   	  return view('admin/otp', compact('email'));
   }

   public function verifyOtp(Request $request){

   	$res = Admin::where('email',$request->email)->first();
   	if($res->otp == $request->otp){
   		$request->session()->put('email',$res->email);
        $request->session()->put('admin_id',$res->id);
         return redirect()->to('dashboard')->with('success','Login Success!');
   	}else{
   	      return redirect()->to('signin')->with('error','Wrong OTP!');
   	}

   }

   public function addWebsiteSettings(Request $request){
    $existing_websitesetting_check = WebsiteSetting::where('id', $request->id)->first();
     if($existing_websitesetting_check){
         if(!empty($request->logo)){
         $destinationPath = base_path('images/website_settings');
          $logo = time().'.'.$request->logo->getClientOriginalExtension();
          $request->logo->move($destinationPath, $logo);

       }else{
           $logo = $existing_websitesetting_check->website_logo;
       }
       $data = [
            'website_logo' => $logo,
            'copyright_content' => $request->copyright_content,
            'address' => $request->address,
            'address_google_link' => $request->address_google_link,
            'contact_details' => $request->editor1,
       ];
       $res = WebsiteSetting::where('id', $request->id)->update($data);
       return redirect()->to('website-setting')->with('success','website Setting updated!');

     }else{
        if(!empty($request->logo)){
         $destinationPath = base_path('images/website_settings');
          $logo = time().'.'.$request->logo->getClientOriginalExtension();
          $request->logo->move($destinationPath, $logo);

       }else{
           $logo = '';
       }

        $data = [
                'website_logo' => $logo,
                'copyright_content' => $request->copyright_content,
                'address' => $request->address,
                'address_google_link' => $request->address_google_link,
                'contact_details' => $request->editor1,
              ];

        $res = WebsiteSetting::create($data);
      return redirect()->to('website-setting')->with('success','website settings created!');
     }
   }


        private function convertCurrency( $amount , $from_currency , $to_currency ){

              $from_Currency = urlencode($from_currency);
              $to_Currency = urlencode($to_currency);
              $query =  "{$from_Currency}_{$to_Currency}";
             // print_r($query);die;
              $json = file_get_contents("https://free.currconv.com/api/v7/convert?q=".$query."&compact=ultra&apiKey=2cd2746ee96374e39601");
              $obj = json_decode($json, true);
             // print_r($obj["USD_INR"]);die;
              $val = floatval($obj["$query"]);


              $total = $val * $amount;
              return number_format($total, 2, '.', '');
            }



    public function currencyRate(Request $request){
            $amount = $request->amount;
            $from_currency = $request->from_currency;
            $to_currency = $request->to_currency;

        $details =  CurrencyRate::where('id',$to_currency)->first();
       // print_r($details->current_value);die;
        $converted_amount = number_format($details->current_value * $amount, 2);
        dd($converted_amount);die;


     }

    public function currencyConverter(Request $request){
        $currencyrates = CurrencyRate::all();
       // dd($details);die;
        return view('admin/currencyconverter', compact('currencyrates'));
    }

    public function addNewsFeeds(Request $request){
        if(!empty($request->image)){
          $destinationPath = public_path('images/news_feeds');
          $image = time().'.'.$request->image->getClientOriginalExtension();
          $request->image->move($destinationPath, $image);

       }else{
           $image = '';
       }

       if($request->btn == "publish"){

       $data = [
             'title' => $request->title,
             'image' => $image,
             'description' => $request->editor1,
             'publish' => 1
           ];

       }else{
           $data = [
             'title' => $request->title,
             'image' => $image,
             'description' => $request->editor1,
             'publish' => 0
           ];
       }

       $res = News::create($data);
       return redirect()->to('create-newsfeed')->with('success','News feed created!');
    }

    public function updateNewsFeeds(Request $request){
        $id = $request->id;
        $base_64 = base64_encode($id);
        $encryptid = rtrim($base_64, '=');
        if(!empty($request->image)){
          $destinationPath = public_path('images/news_feeds');
          $image = time().'.'.$request->image->getClientOriginalExtension();
          $request->image->move($destinationPath, $image);

           }else{
               $image = '';
           }
          if($request->btn == "publish"){
         if(!empty($image)){
           $data = [
                 'title' => $request->title,
                 'image' => $image,
                 'description' => $request->editor1,
                 'publish' => 1
               ];
         }else{
            $data = [
                 'title' => $request->title,
                 //'image' => $image,
                 'description' => $request->editor1,
                 'publish' => 1
               ];
         }
           }else{
              if(!empty($image)){
               $data = [
                 'title' => $request->title,
                 'image' => $image,
                 'description' => $request->editor1,
                 'publish' => 0
               ];
            }else{
            $data = [
                 'title' => $request->title,
                 //'image' => $image,
                 'description' => $request->editor1,
                 'publish' => 0
               ];
         }
       }
        $res = News::where('id', $id)->update($data);
       return redirect()->to('edit-newsfeed/'.$encryptid)->with('success','News feed updated!');
    }

    public function customerSupportReply(Request $request){
        $input = $request->all();
        $res = CustomerSupportAnswer::create($input);
        return redirect()->to('customer-support')->with('success','Customer query replied!');
    }

    public function customerSupportResolved(Request $request){
        $data = ['resolved' => '1'];
        $res =  CustomerSupport::where('id', $request->id)->update($data);
        return redirect()->to('customer-support')->with('success','Customer query resolved!');
    }

    public function deleteSubscription(Request $request,$id){
        $base_64 = $id . str_repeat('=', strlen($id) % 4);
        $ids = base64_decode($base_64);
       // print_r($ids);die;
        $data = ['deleted' => 1];
        $res = SubscriptionPlan::where('id',$ids)->update($data);
        return redirect()->to('subscription')->with('success','Subscription Plan deleted!');
    }

    public function knowledgebase(Request $request){
      $details = $request->all();
      $getData = knowledgeBase::all();
      return view('admin.knowledgebase', compact('details','getData'));
     // return redirect()->to('knowledge_base')->with('success','Customer query replied!');
  }

  public function addknowledgebase(Request $request){
    $details = $request->all();
    return view('admin.add-knowledgebase', compact('details'));
   // return redirect()->to('knowledge_base')->with('success','Customer query replied!');
}



public function editknowledgebase($id){

  $details ='';
  $getData = knowledgeBase::where('id',$id)->get();
  return view('admin.add-knowledgebase', compact('details','getData'));
 // return redirect()->to('knowledge_base')->with('success','Customer query replied!');
}

public function submitknowledgebase(Request $request){

  $request->validate([
      'title' => ['required'],
      'description' => ['required'],
      'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ]);

    if(isset($request->upd_image) && !empty($request->upd_image)){
        if ($request->hasFile('image')) {
              $imageDe = public_path('images/knowlage-images');
              $image = time().'.'.$request->image->getClientOriginalExtension();
              $request->image->move($imageDe, $image);
              $imageName=$image;
        }else{
            $imageName = $request->upd_image;
        }
    }else{
        if ($request->hasFile('image')) {
          $imageDe = public_path('images/knowlage-images');
          $image = time().'.'.$request->image->getClientOriginalExtension();
          $request->image->move($imageDe, $image);
          $imageName=$image;
        }else{
            $imageName = 'No Image';
        }
    }

  $getData = knowledgeBase::updateOrCreate(['id' => $request->table_id], [
            "title" => $request->title,
            "image" => $imageName,
            "description" => $request->description,
  ]);
  return redirect('knowledge_base')->with('success', 'Submitted!!!');
  }


  public function deleteknowledgebase($id){
    $productid=knowledgeBase::findOrFail($id);
    $productid->delete();
    return back()
        ->with('success', 'Record deleted successfully');
  }



  public function support(Request $request){

    $getData = Support::all();
    $openTicket =Support::where('status','4')->get()->count();
    $closedTicket =Support::where('status','3')->get()->count();
    return view('admin.support', compact('openTicket','closedTicket','getData'));
  // return redirect()->to('knowledge_base')->with('success','Customer query replied!');
  }


    public function editsupport($id){
    $details ='';
    $getData = Support::where('id',$id)->get();
    return view('admin.edit-support', compact('details','getData'));
    // return redirect()->to('knowledge_base')->with('success','Customer query replied!');
    }

    public function submitsupport(Request $request){

    $request->validate([
      'description' => ['required'],
      'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);


    $getData = Support::updateOrCreate(['id' => $request->table_id], [
            "status" => $request->status,
            "desciption" => $request->description,
    ]);
    return redirect('support')->with('success', 'Submitted!!!');
    }

    public function deletesupport($id){
      $productid=Support::findOrFail($id);
      $productid->delete();
      return back()
      ->with('success', 'Record deleted successfully');
    }


      public function viewblogknowledgebase($id){

        $getData = SubBlogknowledgebase::where('knowledge_id',$id)->get();

        return view('admin.view-blog-knowledgebase', compact('getData'));
      }

      public function addBlogKnowledgebase($id){

        $knowledgeId=$id ;

        return view('admin.add-blog-knowledgebase', compact('knowledgeId'));
      }


     public function submitblogknowledgebase(Request $request){

          $request->validate([
              'title' => ['required'],
              'description' => ['required'],
          ]);
          $getData = SubBlogknowledgebase::updateOrCreate(['id' => $request->table_id], [
                    "knowledge_id" => $request->knowledge_id,
                    "title" => $request->title,
                    "desciption" => $request->description,
          ]);
          return redirect('knowledge_base')->with('success', 'Submitted!!!');
      }

          /** Glossery Section  */

    public function glossary(Request $request){
      $details = $request->all();
      $getData = GlosseryModel::all();
      return view('admin.glossary', compact('details','getData'));
  }

      public function addGlossary(Request $request){
        $details = $request->all();
        return view('admin.add-glossary', compact('details'));
      }


    public function editGlossary($id){

      $details ='';
      $getData = GlosseryModel::where('id',$id)->get();
      return view('admin.add-glossary', compact('details','getData'));
    }

    public function submitGlossary(Request $request){

      $request->validate([
          'title' => ['required'],
          'description' => ['required'],
      ]);


      $getData = GlosseryModel::updateOrCreate(['id' => $request->table_id], [
                "title" => $request->title,
                "description" => $request->description,
                "meta_description" => $request->meta_description,
                "meta_title" => $request->meta_title,
                "meta_keyword" => $request->meta_keyword,
      ]);
      return redirect('glossary')->with('success', 'Submitted!!!');
      }


      public function deleteGlossary($id){
        $productid=GlosseryModel::findOrFail($id);
        $productid->delete();
        return back()
            ->with('success', 'Record deleted successfully');
      }

    /** Guidens section */



     public function guides(Request $request){
      $details = $request->all();
      $getData = GuidesModel::all();
      return view('admin.guides', compact('details','getData'));
    }

    public function addGuides(Request $request){
    $details = $request->all();
    return view('admin.add-guides', compact('details'));
    }


    public function editGuides($id){

    $details ='';
    $getData = GuidesModel::where('id',$id)->get();
    return view('admin.add-guides', compact('details','getData'));
    }

    public function submitGuides(Request $request){

    $request->validate([
      'title' => ['required'],
      'description' => ['required'],
      'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if(isset($request->upd_image) && !empty($request->upd_image)){
      if ($request->hasFile('image')) {
            $imageDe = public_path('images/guides-images');
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move($imageDe, $image);
            $imageName=$image;
      }else{
          $imageName = $request->upd_image;
      }
    }else{
      if ($request->hasFile('image')) {
        $imageDe = public_path('images/guides-images');
        $image = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move($imageDe, $image);
        $imageName=$image;
      }else{
          $imageName = 'No Image';
      }
    }

    $getData = GuidesModel::updateOrCreate(['id' => $request->table_id], [
            "title" => $request->title,
            "description" => $request->description,
            "meta_description" => $request->meta_description,
            "meta_title" => $request->meta_title,
            "meta_keyword" => $request->meta_keyword,
            "image" => $imageName,
    ]);
    return redirect('guides')->with('success', 'Submitted!!!');
    }


    public function deleteGuides($id){
    $productid=GuidesModel::findOrFail($id);
    $productid->delete();
    return back()
        ->with('success', 'Record deleted successfully');
    }



    /** Blog section */



    public function blog(Request $request){
      $details = $request->all();
      $getData = BlogModel::all();
      return view('admin.blog', compact('details','getData'));
    }

    public function addBlog(Request $request){
    $details = $request->all();
    return view('admin.add-blog', compact('details'));
    }


    public function editBlog($id){

    $details ='';
    $getData = BlogModel::where('id',$id)->get();
    return view('admin.add-blog', compact('details','getData'));
    }

    public function submitBlog(Request $request){

    $request->validate([
      'title' => ['required'],
      'description' => ['required'],
      'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if(isset($request->upd_image) && !empty($request->upd_image)){
      if ($request->hasFile('image')) {
            $imageDe = public_path('images/blog-images');
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move($imageDe, $image);
            $imageName=$image;
      }else{
          $imageName = $request->upd_image;
      }
    }else{
      if ($request->hasFile('image')) {
        $imageDe = public_path('images/blog-images');
        $image = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move($imageDe, $image);
        $imageName=$image;
      }else{
          $imageName = 'No Image';
      }
    }


    $getData = BlogModel::updateOrCreate(['id' => $request->table_id], [
            "title" => $request->title,
            "meta_description" => $request->meta_description,
            "meta_title" => $request->meta_title,
            "meta_keyword" => $request->meta_keyword,
            "description" => $request->description,
            "image" => $imageName,
    ]);
    return redirect('blog')->with('success', 'Submitted!!!');
    }


    public function deleteBlog($id){
    $productid=BlogModel::findOrFail($id);
    $productid->delete();
    return back()
        ->with('success', 'Record deleted successfully');
    }
    public function contactInfo(){

      $getData = contactInfo::orderBy('id','desc')->get();
      return view('admin.contact-info', compact('getData'));
    }
    public function deleteNewsFeed(Request $request){
      $productid=News::findOrFail($request->deleteId);
      $productid->delete();
      return back()
          ->with('success', 'Record deleted successfully');
    }


}
