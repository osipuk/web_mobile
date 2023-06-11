<?php

namespace App\Http\Controllers;

use App\Classes\Activity;
use App\Helpers\UserPlanHelper;
use App\Mail\InviteUser;
use App\Models\Company;
use App\Models\Invite;
use App\Models\Permission;
use App\Models\Seo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Nette\Schema\ValidationException;

class MemberController extends Controller
{
    public function index(Request $request){
        $check = Invite::where('token', $request->token)->exists();
        if ($request->token && $check){
            $token = $request->token;
            $user = Invite::where('token', $token)->first();
            $company = Company::findOrFail($user->company_id);
            return view('frontend.signup-member', compact(['token', 'user', 'company']));
        }
        return redirect('/signup');
    }
    public function getAddUserHtml(){
        $returnHTML = view('tenant.v2.response-view.add-more-user')->render();
        return response()->json([
            'success' => true,
            'html' => $returnHTML,
        ]);
    }
    public function countMemebers(){
        return response()->json([
            'usersCount' => Auth::user()->company->user()->count(),
            'subscriptionPlanUsersCount' => UserPlanHelper::subscription_info()->users,
        ]);
    }
    public function store(Request $request) {
        if (Auth::check()) {
//            if (env('APP_ENV') === 'production'){
//                return redirect()->route('dashboard', ['subdomain' => Session::get('subdomain')]);
//            }
            return redirect('/dashboard');
        }
        $request->validate([
            'token'    => 'required',
            'password'      => 'required|min:6',
            'terms'         => 'required'
        ]);


        $invite_user = Invite::where('token', $request->token)->first();

        $user = User::create([
            'first_name' => $invite_user->first_name,
            'last_name' => $invite_user->last_name,
            'email' => $invite_user->email,
            'role' => $invite_user->role,
            'company_id' => $invite_user->company_id,
            'password' => bcrypt($request->password),
        ]);
        if (Auth::attempt(['email' => $invite_user->email, 'password' => $request->password])){
            $invite_user->delete();

            $activity = new Activity();
            $activity->addActivity('register', '');

//            if (env('APP_ENV') === 'production'){
//                return redirect()->route('dashboard', ['subdomain' => Session::get('subdomain')]);
//            }
            return redirect('/dashboard');
        }

        return redirect()->back();
    }

    public function inviteMember(Request $request) {
        $company_id = Auth::user()->company_id;
        $activity = new Activity();
        $errors = [];
        foreach ($request->members as $member) {
            if($member['email'] && $member['name']){
                if(json_decode($this->checkAbilityAddUser()->getContent())->status){
                    if (!filter_var($member['email'], FILTER_VALIDATE_EMAIL)) {
                        return response()->json([
                            'status' => 'fail',
                            'message' => __('Invalid email format')
                        ]);
                    }
                    $userCheck = User::where('email', $member['email'])->first();
                    $inviteCheck = Invite::where('email', $member['email'])->first();

                    if ($userCheck || $inviteCheck) {
                        $errors[] = $member['email'];
                        continue;
                    }

                    $invite_token = Str::random(254);
                    $full_name = explode(' ', $member['name']);

                    Invite::create([
                        'first_name' => count($full_name) > 1 ? $full_name[1] : ' ',
                        'last_name' => $full_name[0],
                        'email' => $member['email'],
                        'company_id' => $company_id,
                        'role' => $member['profession'],
                        'token' => $invite_token
                    ]);

                    $activity->addActivity('add_member', $member['email']);
                    Mail::to($member['email'])->send(new InviteUser(count($full_name) > 1 ? $full_name[1] : $full_name[0], Auth::user()->company->name, $invite_token));
                }
                else{
                    return response()->json([
                        'status' => 'fail',
                        'message' => __('Not all users were added. You need to upgrade your plan')
                    ]);
                }
            }
            else{
                return response()->json([
                    'status' => 'fail',
                    'message' => __('error')
                ]);
            }
        }
        if(count($errors) > 0){
            $message = __('Users with emails ') . implode(', ', $errors) . __(' have been already invited or registered');

            return response()->json([
                'status' => 'fail',
                'message' => $message
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('Invite sent')
        ]);
    }
    public function inviteMemberNew(Request $request) {
        parse_str($request->members,$data);
       $members=[];
        foreach($data['name'] as $key=>$name){
            $members[$key]['name']= $data['name'][$key];
            $members[$key]['email']= $data['email'][$key];
            $members[$key]['job_position']= $data['job_position'][$key];
            $members[$key]['location']= $data['location'][$key];
            $members[$key]['role']= $data['role'][$key];
        }
        $company_id = Auth::user()->company_id;
        $activity = new Activity();
        $errors = [];
        foreach ($members as $member) {
            if(!empty($member['email']) && !empty($member['name'])){
                if(json_decode($this->checkAbilityAddUser()->getContent())->status){
                    if (!filter_var($member['email'], FILTER_VALIDATE_EMAIL)) {
                        return response()->json([
                            'status' => 'fail',
                            'message' => __('Invalid email format')
                        ]);
                    }
                    $userCheck = User::where('email', $member['email'])->first();
                    $inviteCheck = Invite::where('email', $member['email'])->first();

                    if ($userCheck || $inviteCheck) {
                        $errors[] = $member['email'];
                        continue;
                    }

                    $invite_token = Str::random(254);
                    $full_name = explode(' ', $member['name']);

                    Invite::create([
                        'first_name' => count($full_name) > 1 ? $full_name[1] : ' ',
                        'last_name' => $full_name[0],
                        'email' => $member['email'],
                        'company_id' => $company_id,
                        'role' => $member['role'],
                        'token' => $invite_token
                    ]);

                    $activity->addActivity('add_member', $member['email']);
                    Mail::to($member['email'])->send(new InviteUser(count($full_name) > 1 ? $full_name[1] : $full_name[0], Auth::user()->company->name, $invite_token));
                }
                else{
                    return response()->json([
                        'status' => 'fail',
                        'message' => __('Not all users were added. You need to upgrade your plan')
                    ]);
                }
            }
            else{
                return response()->json([
                    'status' => 'fail',
                    'message' => __('error')
                ]);
            }
        }
        if(count($errors) > 0){
            $message = __('Users with emails ') . implode(', ', $errors) . __(' have been already invited or registered');

            return response()->json([
                'status' => 'fail',
                'message' => $message
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('Invite sent')
        ]);
    }

    public function getCompanyMembers(Request $request){
        $query = User::where('company_id', Auth::user()->company_id)->where('id', '!=', Auth::id());
        if ($request->search){
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('role', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }

        $users = $query->get();

        return response()->json([
            'users' => $users
        ]);
    }

    public function removeMember($id){
        $activity = new Activity();
        $user = User::find($id);
        $activity->addActivity('remove_member', $user->first_name . ' ' .$user->last_name);
        $user->company_id = null;
        $user->save();
        return response()->json([
            'message' => 'Member removed'
        ]);
    }

    public function getMemberWithPermissions(Request $request, $userId){
        if (!Auth::user()->permissions->contains('code', 'manage_users')) {
            return redirect('/dashboard/no-permission');
        }
        $user = User::with('permissions')->findOrFail($userId);
        if (Auth::user()->company->getKey() !== $user->company->getKey()) {
            return redirect('/dashboard/no-permission');
        }
        $permissions = Permission::get();
        $localization = session()->get('locale') ?: 'ar';
        $seo = Seo::where('route', '/user-permissions-manage/')->first();
        return view('tenant.permission-manage', compact(['user', 'permissions', 'localization', 'seo']));
    }

    public function updateMemberPermissions(Request $request){
        $id = $request->get('user_id');

        if($id){
            $user = User::with('permissions')->findOrFail($id);
            $permissions = $request->get('permissions');

            $user->permissions()->sync($permissions);
        }

        return redirect('/dashboard/user-team');
    }

    public function checkAbilityAddUser(){
        $invites = Invite::where('company_id', Auth::user()->company->getKey())->get();
        $status = (Auth::user()->company->user()->count() + $invites->count()) < UserPlanHelper::subscription_info()->users;
        return response()->json([
            'status' => $status
        ]);
    }
}
