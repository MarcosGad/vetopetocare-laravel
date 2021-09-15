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
                                <li class="breadcrumb-item"><a href=""> الحيوانات </a>
                                </li>
                                <li class="breadcrumb-item active">اضافة حيوان جديد
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
                                    <h4 class="card-title" id="basic-layout-form"> اضافة حيوان جديد </h4>
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
                    <form class="form" action="{{ route('admin.dogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                    <div class="form-body">
                    <h4 class="form-section"><i class="ft-home"></i> بيانات الحيوان </h4>

                        <div class="form-group">
                            <select name="type" placeholder="النوع" id="type" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                <option value="">اختر نوع</option>    
                                <option value="قطط">قطط</option>
                                <option value="كلاب">كلاب</option>
                                <option value="احصنة ">احصنة </option>
                                <option value="قوارض ">قوارض </option>
                                <option value="طيور ">طيور </option>
                                <option value="حيوانات المزرعة">حيوانات المزرعة</option>
                                <option value="اخرى ">اخرى </option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="purpose" placeholder="اختر الهدف" id="purpose" class="form-control form-input dynamic @error('purpose') is-invalid @enderror">
                                <option value="">اختر الهدف</option>    
                                <option value="تزاوج">تزاوج</option>
                                <option value="بيع">بيع</option>
                                <option value="تبنى">تبنى</option>
                                <option value="مفقود">مفقود</option>
                            </select>
                            @error('purpose')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="address" placeholder="العنوان" type="text" class="form-control form-input @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" >
                              <textarea id="description" placeholder="الوصف" class="form-control form-input @error('description') is-invalid @enderror" name="description" autofocus>{{ old('description') }}</textarea>
                              @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                        </div>

                        <div class="form-group">
                            <input id="color" placeholder="اللون" type="text" class="form-control form-input @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" required autocomplete="color" autofocus>
                            @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="strain" placeholder="السلالة" type="text" class="form-control form-input @error('strain') is-invalid @enderror" name="strain" value="{{ old('strain') }}" required autocomplete="strain" autofocus>
                            @error('strain')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="n_strain" placeholder="نقاء السلالة" type="text" class="form-control form-input @error('n_strain') is-invalid @enderror" name="n_strain" value="{{ old('n_strain') }}" required autocomplete="n_strain" autofocus>
                            @error('n_strain')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="pecial_marque" placeholder="علامة مميزة" type="text" class="form-control form-input @error('pecial_marque') is-invalid @enderror" name="pecial_marque" value="{{ old('pecial_marque') }}" required autocomplete="pecial_marque" autofocus>
                            @error('pecial_marque')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="form-group">
                            <input id="currency" placeholder="العمر" type="text" class="form-control form-input @error('currency') is-invalid @enderror" name="currency" value="{{ old('currency') }}" required autocomplete="currency" autofocus>
                            @error('currency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="price" placeholder="السعر" type="text" class="form-control form-input @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <input id="license" placeholder="رقم الرخصة" type="text" class="form-control form-input @error('license') is-invalid @enderror" name="license" value="{{ old('license') }}" required autocomplete="license" autofocus>
                            @error('license')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select name="sex" placeholder="الجنس" id="sex" class="form-control form-input dynamic @error('sex') is-invalid @enderror">
                                <option value="">اختر الجنس</option>    
                                <option value="أنثى">أنثى</option>
                                <option value="ذكر">ذكر</option>
                            </select>
                            @error('sex')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="input-group control-group increment">
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn"> 
                              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                            </div>
                          </div>
                          <div class="clone" style="display: none;">
                            <div class="control-group input-group" style="margin-top:10px">
                              <input type="file" name="filename[]" class="form-control">
                              <div class="input-group-btn"> 
                                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                              </div>
                            </div>
                        </div>

                            @if ($errors->has('filename'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('filename') }}</strong>
                            </span>
                            @endif

                            @if ($errors->has('filename.*')) <!--in case if we have multiple file-->
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                     <strong>نوع الملف يجب ان يكون jpeg,png,jpg,gif,svg</strong>
                            </span> 
                            @endif

                            <div class="form-group" style="margin-top:15px;">
                              <textarea id="notes" placeholder="ملاحظات" class="form-control form-input @error('notes') is-invalid @enderror" name="notes" autofocus>{{ old('notes') }}</textarea>
                              @error('notes')
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
                                        </form>
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });
    </script>
@endsection