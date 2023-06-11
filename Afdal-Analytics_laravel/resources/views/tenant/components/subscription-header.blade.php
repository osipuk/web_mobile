<header class="settings-header" style="height: 65px; padding: 0px;">
  <div class="settings-top-bar">
    <h1 class="settings-title font-54-lh-50-medium">
      {{__('Dashboards')}}
    </h1>
    <div class="settings-user-block">
      @include('tenant.components.user-block')
    </div>


  </div>

  <div class="settings-menu">
    @if(!empty($user_permissions))
        <ul class="settings-menu-list">

              <li style="margin-right: 30px;margin-left: 0px;" class="settings-menu-item settings-menu-item-profile">
                <a href="{{url('dashboard/user-profile')}}"
                  class="settings-link font-24-lh-28-medium"
                >
                    {{__('Profile')}}
                </a>

                <div class="settings-orange-line"></div>
              </li>

              <li style="margin-right: 30px;margin-left: 0px;" class="settings-menu-item settings-menu-item-billing">
                  @if($user_permissions->contains('code', 'manage_payments'))
                      <a href="{{url('dashboard/user-billing')}}"
                         class="settings-link font-24-lh-28-medium"
                      >
                          {{__('Billing')}}
                      </a>
                  @else
                      <a href="{{url('dashboard/user-billing')}}"
                         class="settings-link font-24-lh-28-medium"
                         style="pointer-events: none"
                      >
                          {{__('Billing')}}
                      </a>
                  @endif

                <div class="settings-orange-line"></div>
              </li>

          <li style="margin-right: 30px;margin-left: 0px;" class="settings-menu-item settings-menu-item-users">
              @if($user_permissions->contains('code', 'manage_users'))
                    <a href="{{url('dashboard/user-team')}}"
                    class="settings-link font-24-lh-28-medium">
                        {{__('Users')}}
                    </a>
              @else
                  <a href="{{url('dashboard/user-team')}}"
                     class="settings-link font-24-lh-28-medium"
                     style="pointer-events: none"
                  >
                      {{__('Users')}}
                  </a>
              @endif
            <div class="settings-orange-line"></div>
          </li>
        </ul>
    @endif
  </div>
</header>

<script>
  const currentPath = location.pathname;
  const billingItem = document.querySelector('.settings-menu-item-billing');
  const usersItem = document.querySelector('.settings-menu-item-users');
  const profileItem = document.querySelector('.settings-menu-item-profile');

  switch (currentPath) {
    case '/dashboard/user-profile':
      profileItem.classList.add('active');
    break;

    case '/dashboard/user-billing':
      billingItem.classList.add('active');
    break;

    case '/dashboard/user-team':
      usersItem.classList.add('active');
    break;

    default:
      break;
  }
</script>
