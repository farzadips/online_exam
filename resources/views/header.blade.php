  <div class="container-fluid">
    
  	<div class="row" style="direction: rtl;">
      
  		<div class="d-flex" style="width: 100%;height: 15rem; background:  #1da1f2;
     padding-top: 1em;">
     <div class="col-sm-8">
      <p style="font-size: 2vw;color: white;margin-top: 4rem;margin-left: 3rem;">آزمون های آنلاین موسسه اردوش</p>
     </div>
     <div class="col-sm-3">
       
     </div>
     <div class="col-sm-1">
    <img  style="float:left;width:12rem;height: 12rem;margin-top: 1rem;margin-left: 1rem;"src="{{ asset('images/logo.png') }}">
     </div>
  		
  
  	</div>
  </div>
  </div>

  <div class="d-flex" style="margin-bottom: 0 ;border-bottom:#d6d6d6 .1rem solid;  font-weight: 800;font-size:1rem">
       <div class="mr-auto menu-option-settingn" style="margin:1rem;margin-left: 6rem; font-size: 1.2rem"><a href="@yield('link')" class="menu-items">@yield('title')</a></div>
      @if(Auth::check())
       <div class="menu-option-setting"><a href="/userpanel" class="menu-items">پنل کاربری</a></div>
        <div class="menu-option-setting"><a href="/results" class="menu-items">نتایج آزمون ها</a></div>
       <div class="menu-option-setting"><a href="/exams" class="menu-items">آزمون ها</a></div>
       @endif
       </div>