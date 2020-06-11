  <div class="container-fluid">

  	<div class="row" style="direction: rtl;">

  		<div class="d-flex" style="width: 100%;height: 15rem; background:  #1da1f2;
     padding-top: 1em;">
     <div class="col-sm-8">
      <p style="font-size: 2vw;color: white;margin-top: 4rem;margin-left: 3rem;">آزمون های آنلاین </p>
     </div>
     <div class="col-sm-3">

     </div>
     <div class="col-sm-1">
    <img  style="float:left;width:12rem;height: 12rem;margin-top: 1rem;margin-left: 1rem;"src="{{ asset('images/tua.gif') }}">
     </div>


  	</div>
  </div>
  </div>

  <div class="d-flex" style="margin-bottom: 0 ;border-bottom:#d6d6d6 .1rem solid;  font-weight: 800;font-size:1rem">




      @if(Auth::check())

          <div class="mr-auto menu-option-settingn" style="margin:1rem;margin-left: 6rem; font-size: 1.2rem">
              <li>
                  <a class="fa fa-close" href="/logout"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">خروج</a>
                  <div>
                      <form id="logout-form" action="/logout" method="post" style="display: none">
                          @csrf
                      </form>
                  </div>
              </li>

          </div>
       <div class="menu-option-setting"><a href="/userpanel" class="menu-items">پنل کاربری</a></div>
        <div class="menu-option-setting"><a href="/results" class="menu-items">نتایج آزمون ها</a></div>
       <div class="menu-option-setting"><a href="/exams" class="menu-items">آزمون ها</a></div>
  </div>

  @else
          <div class="mr-auto menu-option-settingn" style="margin:1rem;margin-left: 6rem; font-size: 1.2rem"><a href="/signup" class="menu-items">ثبت نام</a></div>

  </div>
      @endif
