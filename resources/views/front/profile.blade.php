@extends('layouts.front')
@section('title','البيانات الشخصية')
@section('content')
@if (!Auth::guest() && auth()->user()->active == 1)
    <div class="main">
        <section>
            <div class="container">
                  <div class="row">
                    <div class="col-sm-8">
                        <div>
                <form action="{{route('profile')}}" method="POST">

                            {{ csrf_field()}}

                            <h2 class="form-title centered">بياناتك</h2>

                            @if(session('success'))
                                <div class="alert alert-success">
                                {{ session('success') }}
                                </div> 
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                {{ session('error') }}
                                </div> 
                            @endif
    
                            <div class="form-group">
                              <label for="name">الأسم</label>
                              <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"  value="{{$user->name}}">
                              @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                              @enderror
                            </div>

                            <div class="form-group">
                            <input id="birth"  placeholder="تاريخ الميلاد" type="text" pattern="\d{4}-\d{2}-\d{2}" class="form-control birth form-input @error('birth') is-invalid @enderror" name="birth" value="{{$user->birth}}" readonly required autocomplete="birth" autofocus>

                            @error('birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            
                        <div class="form-group">
                            <label for="email">رقم المحمول</label>
                            <input id="phone" placeholder="رقم المحمول" type="text" class="form-control form-input @error('phone') is-invalid @enderror" name="phone" value="{{$user->phone}}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="gender" placeholder="النوع" id="gender" class="form-control form-input @error('gender') is-invalid @enderror">
                                @if($user->gender == 'ذكر')
                                <option value="ذكر">ذكر</option>
                                <option value="أنثى">أنثى</option>
                                @endif
                                @if($user->gender == 'أنثى')
                                <option value="أنثى">أنثى</option>
                                <option value="ذكر">ذكر</option>
                                @endif
                                @if($user->gender == null)
                                <option value="">اختار النوع</option>
                                <option value="ذكر">ذكر</option>
                                <option value="أنثى">أنثى</option>
                                @endif
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                            
                            <div class="form-group">
                                    <label for="email">البريد الألكترونى</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" readonly>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                   @enderror
                            </div>


                            <div class="form-group">
                                <label for="password">كلمة السر القديمة</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                   @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password">كلمة السر الجديدة</label>
                                <input type="text" class="form-control" name="new_password">
                                @error('new_password')
                                    <span class="invalid-feedback  @error('new_password') is-invalid @enderror" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">تحديث البيانات</button>
                </form> 
            </div>
                    </div>
                    <div class="col-sm-4">
                         <h2 class="form-title centered">حذف الحساب وترك الموقع</h2>
                        <p>عند حذف حسابك سوف تترك الحيوانات والمستلزمات والدلائل التى قمت بأضافتها اذا كنت تريد مسحها قم بذلك قبل مغادرة الموقع</p>
                        <div>
    					   <button style="margin-top:15px" type="button" class="btn btn-danger showModal">حذف الحساب</button>
    					</div>
                    </div>
                    
                  </div>
                   <div id="formModal" class="modal fade" role="dialog">
    				    <div class="modal-dialog">
    					        <div class="modal-content">
    								<div class="modal-header">
    									<button type="button" class="close" data-dismiss="modal">&times;</button>
    									<h4 class="modal-title">نحن فى غاية الحزن لتركنا اذا كان لديك اقتراح او شكوة قبل تركنا تواصل معنا </h4>
    								</div>
    								<div class="modal-body">
    									<form action="{{route('removeProfile')}}" method="POST">
    										{{ csrf_field()}}
    										<button type="submit" class="btn btn-primary">حذف الحساب نهائيا</button>
    									</form>
    								</div>
    						    </div>
    					</div>
    				</div>
        </section>
    </div>
@section('profile')
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
    
    $(document).on('click', '.showModal', function(){
		$('#formModal').modal('show');
    });
</script>
@endsection
@else
<div class="alert alert-danger not-active-alert" role="alert">
    انت مستخدم غير مفعل لن تستمتع بجميع مميزات الموقع --- انتظر التفعيل او تواصل معنا
</div>
@endif
@endsection