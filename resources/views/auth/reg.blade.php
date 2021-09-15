<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>التسجيل</title>
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
                    <form method="POST" id="signup-form" class="signup-form" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                        <h2 class="form-title">انشاء حساب</h2>

                        @error('address')
                            <p class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror

                        @error('disclosure_price')
                            <p class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror

                        @error('about_you')
                            <p class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror

                        @error('license')
                            <p class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror

                        
                        @error('image_of_the_guild_capricorn')
                                <p class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                </p>
                        @enderror 

                        @error('Personal_identification_photo')
                            <p class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </p>
                        @enderror
                        
                        <div class="form-group">
                            <input id="name" placeholder="الأسم" type="text" class="form-control form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="birth"  placeholder="تاريخ الميلاد" type="text" pattern="\d{4}-\d{2}-\d{2}" class="form-control birth form-input @error('birth') is-invalid @enderror" name="birth" value="{{ old('birth') }}" readonly required autocomplete="birth" autofocus>

                            @error('birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="gender" placeholder="النوع" id="gender" class="form-control form-input dynamic @error('gender') is-invalid @enderror">
                                <option value="">النوع</option>  
                                <option value="ذكر">ذكر</option>
                                <option value="أنثى">أنثى</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="country" placeholder="الدولة"  id="country" class="form-control form-input dynamic @error('country') is-invalid @enderror" data-dependent="state">
                                <option value="">اختار الدولة</option>
                                @foreach($country_list as $country)
                                <option value="{{ $country->country}}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="state" placeholder="المحافظة"  id="state" class="form-control form-input dynamic @error('state') is-invalid @enderror" data-dependent="city">
                                <option value="">اختار المحافظة</option>
                            </select>
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="city" placeholder="الحى"  id="city" class="form-control form-input dynamic @error('city') is-invalid @enderror">
                                <option value="">اختار الحى</option>
                            </select>
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input id="phone" placeholder="رقم المحمول" type="text" class="form-control form-input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="email" placeholder="البريد الالكترونى" type="email" class="form-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" placeholder="كلمة السر" type="password" class="form-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" placeholder="اعادة كلمة السر" class="form-input form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

    
   
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="تسجيل"/>
                        </div>
                    </form>
                    <p class="loginhere">
                       لديك حساب ? <a href="login" class="loginhere-link">تسجيل الدخول</a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

 $('.dynamic').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ route('reg.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

 $('#country').change(function(){
  $('#state').val('');
  $('#city').val('');
 });

 $('#state').change(function(){
  $('#city').val('');
 });
 

});
</script>


<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>        
        $(document).ready(function() {
            $(".birth").flatpickr({
                dateFormat: "d-m-Y",
            })
        });

        $(function() {
            $('.colors').hide();
            $('#type').change(function(){
                $('.colors').hide();
                $('#' + $(this).val()).show();
            });
        });
</script>
