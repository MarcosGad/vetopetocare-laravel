<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول</title>
	    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/admin/images/ico/favicon.ico')}}">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('assets/front/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/front/css/style-login.css')}}">
    <link href="https://fonts.googleapis.com/css?family=El+Messiri:400,500,600,700&amp;subset=arabic,cyrillic" rel="stylesheet">
</head>
<body>
<style>
/* Shared */
.loginBtn {
  box-sizing: border-box;
  position: relative;
  margin: 0.2em;
  padding: 0 15px 0 46px;
  border: none;
  text-align: left;
  line-height: 34px;
  white-space: nowrap;
  border-radius: 0.2em;
  font-size: 16px;
  color: #FFF;
}
.loginBtn:before {
  content: "";
  box-sizing: border-box;
  position: absolute;
  top: 0;
  left: 0;
  width: 34px;
  height: 100%;
}
.loginBtn:focus {
  outline: none;
}
.loginBtn:active {
  box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
}


/* Facebook */
.loginBtn--facebook {
  background-color: #4C69BA;
  background-image: linear-gradient(#4C69BA, #3B55A0);
  /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
  text-shadow: 0 -1px 0 #354C8C;
}
.loginBtn--facebook:before {
  border-right: #364e92 1px solid;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
}
.loginBtn--facebook:hover,
.loginBtn--facebook:focus {
  background-color: #5B7BD5;
  background-image: linear-gradient(#5B7BD5, #4864B1);
}


/* Google */
.loginBtn--google {
  /*font-family: "Roboto", Roboto, arial, sans-serif;*/
  background: #DD4B39;
}
.loginBtn--google:before {
  border-right: #BB3F30 1px solid;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
}
.loginBtn--google:hover,
.loginBtn--google:focus {
  background: #E74B37;
}
@media (min-width: 0px){
  .loginBtn {
      width: 100% ;
      text-align: center;
  }
}
@media (min-width: 768px){
    .loginBtn {
       width: fit-content;
    }
}
</style>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form" action="{{ route('login') }}">
                    @csrf
                        <h2 class="form-title">تسجيل الدخول</h2>
                        <div class="form-group">
                            <input id="email" placeholder="البريد الالكترونى" type="email" class="form-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" placeholder="كلمة السر"  type="password" class="form-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" style="display:initial" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        تذكرنى
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="تسجيل الدخول"/>
                        </div>
                    </form>
                    
                    
                    <a href="{{ url('auth/facebook') }}">
                        <button class="loginBtn loginBtn--facebook">
                                تسجيل الدخول عن طريق الفيسبوك
                        </button>
                    </a>

                    <a href="{{ url('auth/google') }}">
                        <button class="loginBtn loginBtn--google">
                            تسجيل الدخول عن طريق جوجل
                        </button>
                    </a>
                    
                    <p class="loginhere">
                        @if (Route::has('password.request'))
                            <a class="loginhere-link btn btn-link" href="{{ route('password.request') }}">
                                    نسيت كلمة السر ؟
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="{{asset('assets/front/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/front/js/main-login.js')}}"></script>
</body>
</html>