@extends('layout.userhead')

@section('content')
    <body class="user-team-page">
    @include('layout.usersidenav')
    <div class="user-billing-content-wrapper">
        @include('tenant.components.settings-header')
        <div class="user-permission-modal-content">
            <div class='user-team-modal-add-header-wrap'>
                <h3 class='user-team-add-title font-28-lh-42-semi-bold'>{{__('Manage Permissions')}}</h3>
            </div>

            <div>
                <form method="post" action="{{url('update-user-permissions')}}" id='forma'>
                    @csrf
                    <div id='form' class='user-permission-modal'>
                        <h4 class='user-team-add-title font-28-lh-42-semi-bold perm-title'>{{__('User: ')}} {{$user->first_name}} {{$user->last_name}}</h4>
                        <div class="permission-input-wrapper">
                            @foreach($permissions as $permission)
                                @if(Auth::user()->company->owner_id === $user->getKey())
                                    @if(!empty($localization) && $localization === 'ar')
                                        @if($user->permissions->contains($permission))
                                            <div>
                                                <label for="permissions-{{$permission->id}}">{{$permission->ar_name}}</label>
                                                <input type="checkbox" id="permissions-{{$permission->id}}" name="permissions[]" disabled checked value="{{$permission->id}}">
                                            </div>
                                        @else
                                            <div>
                                                <label for="permissions-{{$permission->id}}">{{$permission->ar_name}}</label>
                                                <input type="checkbox" id="permissions-{{$permission->id}}" name="permissions[]" disabled value="{{$permission->id}}">
                                            </div>
                                        @endif
                                    @else
                                        @if($user->permissions->contains($permission))
                                            <div>
                                                <label for="permissions-{{$permission->id}}">{{$permission->name}}</label>
                                                <input type="checkbox" id="permissions-{{$permission->id}}" name="permissions[]" disabled checked value="{{$permission->id}}">
                                            </div>
                                        @else
                                            <div>
                                                <label for="permissions-{{$permission->id}}">{{$permission->name}}</label>
                                                <input type="checkbox" id="permissions-{{$permission->id}}" name="permissions[]" disabled value="{{$permission->id}}">
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if(!empty($localization) && $localization === 'ar')
                                        @if($user->permissions->contains($permission))
                                            <div>
                                                <label class="cursor-p" for="permissions-{{$permission->id}}">{{$permission->ar_name}}</label>
                                                <input type="checkbox" id="permissions-{{$permission->id}}" name="permissions[]" checked value="{{$permission->id}}">
                                            </div>
                                        @else
                                            <div>
                                                <label class="cursor-p" for="permissions-{{$permission->id}}">{{$permission->ar_name}}</label>
                                                <input type="checkbox" id="permissions-{{$permission->id}}" name="permissions[]" value="{{$permission->id}}">
                                            </div>
                                        @endif
                                    @else
                                        @if($user->permissions->contains($permission))
                                            <div>
                                                <label class="cursor-p" for="permissions-{{$permission->id}}">{{$permission->name}}</label>
                                                <input type="checkbox" id="permissions-{{$permission->id}}" name="permissions[]" checked value="{{$permission->id}}">
                                            </div>
                                        @else
                                            <div>
                                                <label class="cursor-p" for="permissions-{{$permission->id}}">{{$permission->name}}</label>
                                                <input type="checkbox" id="permissions-{{$permission->id}}" name="permissions[]" value="{{$permission->id}}">
                                            </div>
                                        @endif
                                    @endif
                                @endif


                            @endforeach
                            <input type="hidden" name="user_id" value="{{$user->getKey()}}">
                        </div>
                    </div>
                    <div class='user-team-add-form-btn-wrap'>
                        <input class='user-team-add-form-btn-sub font-18-lh-21-regular permission-button' type="submit" value="{{__('Save')}}">
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
@endsection
