{{-- navabar  --}}
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu 
@if(isset($configData['navbarType'])){{$configData['navbarClass']}} @endif" 
data-bgcolor="@if(isset($configData['navbarBgColor'])){{$configData['navbarBgColor']}}@endif">
  <div class="navbar-wrapper">
    <div class="navbar-container content">
      <div class="navbar-collapse" id="navbar-mobile">
        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
          </ul>
        </div>
        <ul class="nav navbar-nav float-right">
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name"><?php $user = Session::get('set_userdata'); echo $user['name']; ?> </span>
              </div>
              <span>
                <div class="avatar bg-rgba-primary m-0">
                  <div class="avatar-content">
                    <i class="bx bx-user text-primary font-size-base"></i>
                  </div>
                </div>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pb-0 pt-0 ">
              <button class="dropdown-item" type="button" id="buttonlogout"><i class="bx bx-power-off mr-50"></i> Logout</button>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
