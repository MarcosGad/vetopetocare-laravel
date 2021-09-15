@extends('layouts.front')
@section('title','انضم الينا')
@section('content')
@if (!Auth::guest() && auth()->user()->active == 1 && auth()->user()->type == 1)
    <div class="main">
        <section>
            <div class="container">
                <div>
                    <form method="post" action="{{url('sendReqUser')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                      <h2 class="form-title centered">انضم الينا</h2>

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

                      @if(session('success'))
                        <div class="alert alert-success">
                          {{ session('success') }}
                        </div> 
                      @endif
                      

                        <div class="form-group">
                            <input id="email" placeholder="البريد الألكترونى" type="email" class="form-control form-input @error('email') is-invalid @enderror"  name="email" readonly value="{{$userEmail}}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="type" placeholder="نوع المستخدم" id="type" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                <option value="">النوع المراد الأنضمام اليه</option>   
                                <option value="2">عيادة</option>
                                <option value="3">صيدلية</option>
                                <option value="4">محل تجارى</option>
                                <option value="5">شركة</option>
                                <option value="6">مدرسة</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="colors" id="2">

                            <div class="form-group" >
                                <input id="address" placeholder="عنوان العيادة" type="text" class="form-control form-input @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>
                            </div>

                            <div class="form-group" >
                                <input id="disclosure_price" placeholder="سعر الكشف" type="text" class="form-control form-input @error('disclosure_price') is-invalid @enderror" name="disclosure_price" value="{{ old('disclosure_price') }}" autocomplete="disclosure_price" autofocus>
                            </div>

                            <div class="form-group" >
                                <textarea id="about_you" placeholder="نبدة عنك" class="form-control form-input @error('about_you') is-invalid @enderror" name="about_you" autofocus>{{ old('about_you') }}</textarea>
                            </div>

                            <p style="margin-bottom:0;"> رخصة مزاولة المهنة</p>
                            <div class="form-group" >
                                <input id="license" placeholder=" رخصة مزاولة المهنة" type="file" class="form-control form-input @error('license') is-invalid @enderror" name="license" value="{{ old('license') }}" autocomplete="license" autofocus>
                            </div>

                            <p style="margin-bottom:0;">صورة كرنية النقابة</p>
                            <div class="form-group" >
                                <input id="image_of_the_guild_capricorn" placeholder="صورة كرنية النقابة" type="file" class="form-control form-input @error('image_of_the_guild_capricorn') is-invalid @enderror" name="image_of_the_guild_capricorn" value="{{ old('image_of_the_guild_capricorn') }}" autocomplete="image_of_the_guild_capricorn" autofocus>
                            </div>

                            <p style="margin-bottom:0;">صورة تحقيق الشخصية</p>
                            <div class="form-group" >
                                <input id="Personal_identification_photo" placeholder="صورة تحقيق الشخصية" type="file" class="form-control form-input @error('Personal_identification_photo') is-invalid @enderror" name="Personal_identification_photo" value="{{ old('Personal_identification_photo') }}" autocomplete="Personal_identification_photo" autofocus>
                            </div>

                            </div>

                            <div class="pharmacy" id="3">
                            <p style="margin-bottom:0;">رخصة الصيدلية</p>
                            <div class="form-group" >
                                <input id="pharmacy_license" placeholder="رخصة الصيدلية" type="file" class="form-control form-input @error('pharmacy_license') is-invalid @enderror" name="pharmacy_license" value="{{ old('pharmacy_license') }}" autocomplete="pharmacy_license" autofocus>
                            </div>
                            </div>


                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="ارسال"/>
                        </div>
                    </form>
            </div>
        </section>

    </div>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script>        
    $('.colors').hide();
    $('.pharmacy').hide();
    $('#type').change(function(){
        $('.colors').hide();
        $('.pharmacy').hide();
        $('#' + $(this).val()).show();
    });

</script>
@else
<div class="alert alert-danger not-active-alert" role="alert">
    انت مستخدم غير مفعل لن تستمتع بجميع مميزات الموقع او قمت بالانضمام الينا --- انتظر التفعيل او تواصل معنا
</div>
@endif
@endsection