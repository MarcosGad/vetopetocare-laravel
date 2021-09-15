@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> المستخدمين </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل - {{$user->name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل المستخدم </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

        <div class="card-content collapse show">
                <div class="card-body">
                    <form class="form" action="{{route('admin.users.update',$user -> id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @error('address')
                        <p style="color: red;margin: 15px;">{{ $message }}</p>
                    @enderror 

                    @error('disclosure_price')
                        <p style="color: red;margin: 15px;">{{ $message }}</p>
                    @enderror 

                    @error('about_you')
                        <p style="color: red;margin: 15px;">{{ $message }}</p>
                    @enderror 

                    @error('license')
                        <p style="color: red;margin: 15px;">{{ $message }}</p>
                    @enderror 

                    @error('image_of_the_guild_capricorn')
                        <p style="color: red;margin: 15px;">{{ $message }}</p>
                    @enderror 

                    @error('Personal_identification_photo')
                        <p style="color: red;margin: 15px;">{{ $message }}</p>
                    @enderror 

                    @error('pharmacy_license')
                        <p style="color: red;margin: 15px;">{{ $message }}</p>
                    @enderror 

                        <input name="id" value="{{$user->id}}" type="hidden">


                        <div class="form-group">
                            <select name="type" placeholder="نوع المستخدم" id="type" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                @if($user->type == 1)
                                <option value="1">عادى</option>
                                <option value="2">عيادة</option>
                                <option value="3">صيدلية</option>
                                <option value="4">محل تجارى</option>
                                <option value="5">شركة</option>
                                <option value="6">مدرسة</option>
                                @elseif($user->type == 2)
                                <option value="2">عيادة</option>
                                <option value="1">عادى</option>
                                <option value="3">صيدلية</option>
                                <option value="4">محل تجارى</option>
                                <option value="5">شركة</option>
                                <option value="6">مدرسة</option>
                                @elseif($user->type == 3)
                                <option value="3">صيدلية</option>
                                <option value="1">عادى</option>
                                <option value="2">عيادة</option>
                                <option value="4">محل تجارى</option>
                                <option value="5">شركة</option>
                                <option value="6">مدرسة</option>
                                @elseif($user->type == 4)
                                <option value="4">محل تجارى</option>
                                <option value="1">عادى</option>
                                <option value="2">عيادة</option>
                                <option value="3">صيدلية</option>
                                <option value="5">شركة</option>
                                <option value="6">مدرسة</option>
                                @elseif($user->type == 5)
                                <option value="5">شركة</option>
                                <option value="1">عادى</option>
                                <option value="2">عيادة</option>
                                <option value="3">صيدلية</option>
                                <option value="4">محل تجارى</option>
                                <option value="6">مدرسة</option>
                                @elseif($user->type == 6)
                                <option value="6">مدرسة</option>
                                <option value="1">عادى</option>
                                <option value="2">عيادة</option>
                                <option value="3">صيدلية</option>
                                <option value="4">محل تجارى</option>
                                <option value="5">شركة</option>
                                @endif
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <input id="name" value="{{$user->name}}" placeholder="الأسم" type="text" class="form-control form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="birth" value="{{$user->birth}}" placeholder="تاريخ الميلاد" type="text" pattern="\d{4}-\d{2}-\d{2}" class="form-control birth form-input @error('birth') is-invalid @enderror" name="birth" value="{{ old('birth') }}" readonly  autocomplete="birth" autofocus>

                            @error('birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="gender" placeholder="النوع" id="gender" class="form-control form-input dynamic @error('gender') is-invalid @enderror">
                                @if($user->gender == 'ذكر')
                                <option value="ذكر">ذكر</option>
                                <option value="أنثى">أنثى</option>
                                @else()
                                <option value="أنثى">أنثى</option>
                                <option value="ذكر">ذكر</option>
                                @endif
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
                                <option value="{{$country->country}}" @if($user->country == $country->country) selected @endif> {{ $country->country }}</option>
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
                                <option value="{{$user->state}}">{{$user->state}}</option>
                            </select>
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="city" placeholder="الحى"  id="city" class="form-control form-input dynamic @error('city') is-invalid @enderror">
                            <option value="{{$user->city}}">{{$user->city}}</option>
                            </select>
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{ csrf_field() }}

                        @if($user->type == 2)
                        <div class="colorss" id="2">
                            <div class="form-group">
                                <input id="address" value="{{$user->address}}" placeholder="عنوان العيادة" type="text" class="form-control form-input @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>          
                            </div>
                           
                            <div class="form-group" >
                                <input id="disclosure_price" value="{{$user->disclosure_price}}" placeholder="سعر الكشف" type="text" class="form-control form-input @error('disclosure_price') is-invalid @enderror" name="disclosure_price" value="{{ old('disclosure_price') }}" autocomplete="disclosure_price" autofocus>
                            </div>

                            <div class="form-group" >
                                <textarea id="about_you" placeholder="نبدة عنك" class="form-control form-input @error('about_you') is-invalid @enderror" name="about_you" autofocus>{{ $user->about_you }}</textarea>
                            </div>

                            <p> رخصة مزاولة المهنة</p>
                            <div class="form-group" >
                                <input id="license" placeholder=" رخصة مزاولة المهنة" type="file" class="form-control form-input @error('license') is-invalid @enderror" name="license" value="{{ old('license') }}" autocomplete="license" autofocus>
                            </div>
                            <img style="width: 150px; height: 100px; margin-bottom: 15px;" src="{{$user->license}}">

                            <p>صورة كرنية النقابة</p>
                            <div class="form-group" >
                                <input id="image_of_the_guild_capricorn" placeholder="صورة كرنية النقابة" type="file" class="form-control form-input @error('image_of_the_guild_capricorn') is-invalid @enderror" name="image_of_the_guild_capricorn" value="{{ old('image_of_the_guild_capricorn') }}" autocomplete="image_of_the_guild_capricorn" autofocus>
                            </div>
                            <img style="width: 150px; height: 100px; margin-bottom: 15px;" src="{{$user->image_of_the_guild_capricorn}}">

                            <p>صورة تحقيق الشخصية</p>
                            <div class="form-group" >
                                <input id="Personal_identification_photo" placeholder="صورة تحقيق الشخصية" type="file" class="form-control form-input @error('Personal_identification_photo') is-invalid @enderror" name="Personal_identification_photo" value="{{ old('Personal_identification_photo') }}" autocomplete="Personal_identification_photo" autofocus>
                            </div>
                            <img style="width: 150px; height: 100px; margin-bottom: 15px;" src="{{$user->Personal_identification_photo}}">

                           
                        </div>
                        @else
                        <div class="colors" id="2">
                            <div class="form-group">
                                <input id="address" value="{{$user->address}}" placeholder="عنوان العيادة" type="text" class="form-control form-input @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>          
                            </div>
                           
                            <div class="form-group" >
                                <input id="disclosure_price" value="{{$user->disclosure_price}}" placeholder="سعر الكشف" type="text" class="form-control form-input @error('disclosure_price') is-invalid @enderror" name="disclosure_price" value="{{ old('disclosure_price') }}" autocomplete="disclosure_price" autofocus>
                            </div>

                            <div class="form-group" >
                                <textarea id="about_you" placeholder="نبدة عنك" class="form-control form-input @error('about_you') is-invalid @enderror" name="about_you" autofocus>{{ $user->about_you }}</textarea>
                            </div>

                            <p> رخصة مزاولة المهنة</p>
                            <div class="form-group" >
                                <input id="license" placeholder=" رخصة مزاولة المهنة" type="file" class="form-control form-input @error('license') is-invalid @enderror" name="license" value="{{ old('license') }}" autocomplete="license" autofocus>
                            </div>

                            <p>صورة كرنية النقابة</p>
                            <div class="form-group" >
                                <input id="image_of_the_guild_capricorn" placeholder="صورة كرنية النقابة" type="file" class="form-control form-input @error('image_of_the_guild_capricorn') is-invalid @enderror" name="image_of_the_guild_capricorn" value="{{ old('image_of_the_guild_capricorn') }}" autocomplete="image_of_the_guild_capricorn" autofocus>
                            </div>

                            <p>صورة تحقيق الشخصية</p>
                            <div class="form-group" >
                                <input id="Personal_identification_photo" placeholder="صورة تحقيق الشخصية" type="file" class="form-control form-input @error('Personal_identification_photo') is-invalid @enderror" name="Personal_identification_photo" value="{{ old('Personal_identification_photo') }}" autocomplete="Personal_identification_photo" autofocus>
                            </div>
                        </div>
                        @endif

                        @if($user->type == 3)
                        <div class="pharmacyy" id="3">
                            <p>رخصة الصيدلية</p>
                            <div class="form-group" >
                                <input id="pharmacy_license" placeholder="رخصة الصيدلية" type="file" class="form-control form-input @error('pharmacy_license') is-invalid @enderror" name="pharmacy_license" value="{{ old('pharmacy_license') }}" autocomplete="pharmacy_license" autofocus>
                            </div>
                            <img style="width: 150px; height: 100px; margin-bottom: 15px;" src="{{$user->pharmacy_license}}">
                        </div>
                        @else
                        <div class="pharmacy" id="3">
                            <p>رخصة الصيدلية</p>
                            <div class="form-group" >
                                <input id="pharmacy_license" placeholder="رخصة الصيدلية" type="file" class="form-control form-input @error('pharmacy_license') is-invalid @enderror" name="pharmacy_license" value="{{ old('pharmacy_license') }}" autocomplete="pharmacy_license" autofocus>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <input id="phone" value="{{$user->phone}}" placeholder="رقم المحمول" type="text" class="form-control form-input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="email" value="{{$user->email}}" placeholder="البريد الالكترونى" type="email" class="form-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" placeholder="كلمة السر الجديدة" type="password" class="form-input form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>

                                           
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>


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
    url:"{{ route('create/fetch') }}",
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
    $(".birth").flatpickr({
        dateFormat: "d-m-Y",
    })

    $('.colors').hide();
    $('.pharmacy').hide();
    $('#type').change(function(){
        $('.colors').hide();
        $('.pharmacy').hide();
        $('#' + $(this).val()).show();
    });
    $('#type').change(function(){
        $('.colorss').hide();
        $('.pharmacyy').hide();
        $('#' + $(this).val()).show();
    });

</script>

@endsection
