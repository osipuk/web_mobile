<?php

namespace App\Http\Controllers;

use App\Events\UserUpdateEvent;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Socialite;
use Twitter;
use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\HttpFoundation\File\File;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\knowledgeBase;
use App\Models\Support;
use App\Models\UserSubscription;
use App\Models\TenantUser;
use App\Http\Controllers\ActiveCampaitngController;

class UserProfileController extends Controller
{
    //
    public function getUserInfo(){
        if(Auth::check()){
            return response()->json([
                'status'=>true,
                'data'=>Auth::user(),
            ]);
        }
        return response()->json([
            'status'=>false,
        ]);
       
    }
    public function updateUserProfileNew(Request $request){
        // $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
       
        $user = Auth::user();
        $rules=[
            'first_name'    => 'required|string|max:32',
            'last_name'     => 'required|string|max:32',
            'city' => 'nullable',
            'postal_code' => 'nullable|numeric|min_digits:5',
            'address' => 'nullable',
            'website' => ['nullable','regex:/^((ftp|http|https):\/\/)?(www.)?(?!.*(ftp|http|https|www.))[a-zA-Z0-9_-]+(\.[a-zA-Z]+)+((\/)[\w#]+)*(\/\w+\?[a-zA-Z0-9_]+=\w+(&[a-zA-Z0-9_]+=\w+)*)?$/'],
            'role'=>'required|string',
            'timezone'=>'nullable',
            'location'=>'nullable'
        ];
        if(!$user->phone_verified){
            $rules['phone'] = 'required|numeric|unique:users,phone,'.$user->id;
        }
        if(!$user->email_verified){
            $rules['email'] = 'required|email|unique:users,email,'.$user->id;
        }
        
       $validated=$request->validate($rules);
        if(!$user->email_verified){
            try{
                $url = "https://api.listclean.xyz/v1/";
                $endpoint = 'verify/email/';
                $api_key = env('LISTCLEAN_TOKEN');
                $email = $request->email;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url . $endpoint . $email);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'X-AUTH-TOKEN: '. $api_key,
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $rr = curl_exec($ch);
                curl_close($ch);
                $rr = json_decode($rr, true);
                if($rr['data']['status']!='clean'){
                    return response()->json([
                        'status' => false,
                        'email'=>false,
                        'message'=>_('Email is not Valid'),
                    ], 200);

                }
            }
            catch(Exception $e){
                return response()->json([
                    'status'=>false,
                    'message'=>_('error'),
                ], 201);
            }
        }
        $data = [
            'first_name'=> $validated['first_name'],
            'last_name'=> $validated['last_name'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'email'=>$validated['email'] ?? $user->email,
            'phone' => $validated['phone'] ?? $user->phone,
            'postal_code' => $validated['postal_code'],
            'timezone' => $validated['timezone'],
            'website' => $validated['website'],
            'role' => $validated['role'],
            'country'=>$validated['location']
        ];

        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            $data['image'] = $filename;
        }
        $user->update($data);

        return response()->json([
            'status'=>true
        ]);
        $ActiveCampaitng = new ActiveCampaitngController();
        $ActiveCampaitng->EventTrackingCreation('Update-User-Profile');
        $ActiveCampaitng->EventTrackingAPI('Update-User-Profile','',$user->email);
        $ActiveCampaitng->UpdateContactAC($user->email);
        $ActiveCampaitng->SyncContactAC();
    }
    public function updateUserProfile(Request $request){

        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $user = Auth::user();

        $request->validate([
            'first_name'    => 'required|string|max:32',
            'last_name'     => 'required|string|max:32',
            // 'email' => [
            //     'required',
            //     'regex:/(.+)@(.+)\.(.+)/i',
            //     Rule::unique('users')->ignore($user->id),
            // ],
            'city' => 'nullable',
            'postal_code' => 'nullable|numeric|min_digits:5',
            'address' => 'nullable',
            'phone' => 'nullable|numeric',
            'website' => 'nullable|regex:'.$regex,
        ]);

        $data = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code,
            // 'email' => $request->email,
            'timezone' => $request->timezone,
            'website' => $request->website,
        ];

        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            $data['image'] = $filename;
        }

        // if($request->email !== $user->email){
        //     $userOld = $user->replicate();
        //     $userOld->push();

        //     UserUpdateEvent::dispatch($userOld, $user);
        //     $userOld->delete();
        // }
        $user->update($data);
        $ActiveCampaitng = new ActiveCampaitngController();
        $ActiveCampaitng->CreateContact($user);
        $ActiveCampaitng->EventTrackingCreation('Update-User-Profile');
        $ActiveCampaitng->EventTrackingAPI('Update User Profile','',$user->email);
        $ActiveCampaitng->UpdateContactAC($data,$user);
        $ActiveCampaitng->SyncContactAC();
        return redirect()->back()->with('success','Profile updated successfully');
        
    }

    public function submitTicket(Request $request){
        $data = [];
        if($request->isMethod('post')){
            $validation_array = [
                'title'     => 'required',
                'department'      => 'required',
                'description'      => 'required',
               // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $validation_attributes = [
                'title'     => 'Subject',
                'department'      => 'Department',
                'description'      => 'Message',
               // 'image' => 'Attachment',
            ];

            $validator = Validator::make($request->all(), $validation_array,[],$validation_attributes);
            $validation_message   = get_message_from_validator_object($validator->errors());

            if($validator->fails()){
                return back()->with('error', $validation_message);
            }else{
                if ($request->hasFile('image')) {
                    $imageDe = public_path('images/knowlage-images');
                    $image = time().'.'.$request->image->getClientOriginalExtension();
                    $request->image->move($imageDe, $image);
                    $imageName=$image;
                  }else{
                      $imageName = 'No Image';
                  }
                  $email = session()->get('email');
                $data = [
                    'user_id' => $email,
                    'title' => $request->title,
                    'file' => $imageName,
                    'department' => $request->department,
                    'desciption' => $request->description,
                    'status' => '1'
                ];

                $res = Support::create($data);
                $company = session()->get('company');
                return redirect()->route('tenant.help', ['subdomain' => $company])->with('success', 'Ticket created successfully.');
            }
        }

    }

    public function ticketDetail(Request $request,$id){
        $r = $_SERVER['REQUEST_URI'];
        $r = explode('/', $r);
        //print_r($r[2]);die;
        $ticketdetails = Support::where('id',$r[2])->first();
        return view('tenant.ticketdetails',compact('ticketdetails'));
    }

     public function latestactivity(Request $request){
        return view('tenant.latestactivity');
    }

    public function viewActivity($id) {
        ActivityLog::find($id)->update([
            'viewed' => true
        ]);
        return response()->json([
            'message' => 'viewed activity'
        ]);
    }
    public function viewActivityAll() {
        ActivityLog::where('user_id', Auth::id())->where('viewed', false)->update([
            'viewed' => true
        ]);
        return response()->json([
            'message' => 'viewed activity'
        ]);
    }
}
