<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>إعادة تعيين كلمة المرور</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/admin/images/ico/favicon.ico')}}">
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('assets/front/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('assets/front/css/style-login.css')}}">
    <link href="https://fonts.googleapis.com/css?family=El+Messiri:400,500,600,700&amp;subset=arabic,cyrillic" rel="stylesheet">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" id="signup-form" class="signup-form" action="{{ route('password.email') }}">
                    @csrf
                        <h2 class="form-title">إعادة تعيين كلمة المرور</h2>
                        <div class="form-group">
                            <input id="email" placeholder="البريد الالكترونى" type="email" class="form-input  form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="إرسال رابط إعادة تعيين كلمة السر"/>
                        </div>
                    </form>
                    
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{asset('assets/front/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/front/js/main-login.js')}}"></script>
</body>
</html>