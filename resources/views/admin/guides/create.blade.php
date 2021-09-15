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
                                <li class="breadcrumb-item"><a href=""> الدلائل </a>
                                </li>
                                <li class="breadcrumb-item active">اضافة دليل جديد
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> اضافة دليل جديد </h4>
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
                    <form class="form" action="{{ route('admin.guides.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                    <div class="form-body">
                    <h4 class="form-section"><i class="ft-home"></i> بيانات الدليل </h4>

                        <div class="form-group">
                            <select name="type" placeholder="نوع الدليل" id="type" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                <option value="">نوع الدليل</option>   
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
      
                        <div class="form-group">
                            <input id="name" placeholder="الأسم" type="text" class="form-control form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        

                        <div class="input-group control-group increment-one" style="margin-bottom: 15px;">
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn"> 
                              <button class="btn btn-success btn-success-one" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                            </div>
                          </div>
                          <div class="clone-one" style="display:none;">
                            <div class="control-group input-group" style="margin-top:10px">
                              <input type="file" name="filename[]" class="form-control" style="margin-bottom: 15px;">
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


                            <div class="form-group">
                            <input id="address" placeholder="العنوان" type="text" class="form-control form-input @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        <div class="form-group">
                            <input id="phone" placeholder="رقم التليفون" type="text" class="form-control form-input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="landline_phone" placeholder="رقم التليفون الارضى" type="text" class="form-control form-input @error('landline_phone') is-invalid @enderror" name="landline_phone" value="{{ old('landline_phone') }}" required autocomplete="landline_phone" autofocus>
                            @error('landline_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="clinic" id="2" style="display: none;">

                            <div class="form-group">
                                <p>هل يقبل الكشف المنزلى</p>
                                <select id="yes_or_no" name="yes_or_no" placeholder="هل يقبل الكشف المنزلى" class="form-control form-input dynamic @error('yes_or_no') is-invalid @enderror">
                                    <option value="لا">لا</option>
                                    <option value="نعم">نعم</option>
                                </select>
                                @error('yes_or_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group نعم" id="نعم" style="display: none;">
                                <input id="home_detection_rate" placeholder="سعر الكشف المنزل" type="text" class="form-control form-input @error('home_detection_rate') is-invalid @enderror" name="home_detection_rate" value="{{ old('home_detection_rate') }}" autocomplete="home_detection_rate" autofocus>
                                @error('home_detection_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="regular_check_up_price" placeholder="سعر الكشف العادي" type="text" class="form-control form-input @error('regular_check_up_price') is-invalid @enderror" name="regular_check_up_price" value="{{ old('regular_check_up_price') }}" autocomplete="regular_check_up_price" autofocus>
                                @error('regular_check_up_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="doctor_name" placeholder="اسم الدكتور" type="text" class="form-control form-input @error('doctor_name') is-invalid @enderror" name="doctor_name" value="{{ old('doctor_name') }}" autocomplete="doctor_name" autofocus>
                                @error('doctor_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="pharmacy" id="3" style="display: none;">
                             <div class="form-group">
                                <p>توصيل المنازل</p>
                                <select id="yes_or_no_two" name="yes_or_no_two" placeholder="توصيل المنازل" class="form-control form-input dynamic @error('yes_or_no_two') is-invalid @enderror">
                                    <option value="لا">لا</option>
                                    <option value="نعم">نعم</option>
                                </select>
                                @error('yes_or_no_two')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group نعم" id="نعم" style="display: none;">
                                <input id="price_of_the_delivery_service" placeholder="سعر خدمة التوصيل" type="text" class="form-control form-input @error('price_of_the_delivery_service') is-invalid @enderror" name="price_of_the_delivery_service" value="{{ old('price_of_the_delivery_service') }}" autocomplete="price_of_the_delivery_service" autofocus>
                                @error('price_of_the_delivery_service')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 

                        <div class="form-group" >
                              <textarea id="offers_services" placeholder="الوصف" class="form-control form-input @error('offers_services') is-invalid @enderror" name="offers_services" autofocus>{{ old('offers_services') }}</textarea>
                              @error('offers_services')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                        </div>
                        
                          <p style="margin-bottom:10px;">مواعيد العمل</p>
                          <div class="input-group control-group">
                               <div class="col-md-4">
                                 <input id="weekDay" name="weekDay[]" value="السبت" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-4">
                               <select name="start_time[]" placeholder="من" id="start_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                               <div class="col-md-4">
                                  <select name="end_time[]" placeholder="الى" id="end_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                          </div>

                          <div class="input-group control-group">
                               <div class="col-md-4">
                                  <input id="weekDay" name="weekDay[]" value="الأحد" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-4">
                               <select name="start_time[]" placeholder="من" id="start_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">من</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                               <div class="col-md-4">
                                  <select name="end_time[]" placeholder="الى" id="end_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                          </div>

                          <div class="input-group control-group">
                               <div class="col-md-4">
                                  <input id="weekDay" name="weekDay[]" value="الأثنين" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-4">
                               <select name="start_time[]" placeholder="من" id="start_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">من</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                               <div class="col-md-4">
                                  <select name="end_time[]" placeholder="الى" id="end_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                          </div>

                          <div class="input-group control-group">
                               <div class="col-md-4">
                                  <input id="weekDay" name="weekDay[]" value="الثلاثاء" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-4">
                               <select name="start_time[]" placeholder="من" id="start_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">من</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                               <div class="col-md-4">
                                  <select name="end_time[]" placeholder="الى" id="end_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                          </div>

                          <div class="input-group control-group">
                               <div class="col-md-4">
                                 <input id="weekDay" name="weekDay[]" value="الأربعاء" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-4">
                               <select name="start_time[]" placeholder="من" id="start_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">من</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                               <div class="col-md-4">
                                  <select name="end_time[]" placeholder="الى" id="end_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                          </div>

                          <div class="input-group control-group">
                               <div class="col-md-4">
                               <input id="weekDay" name="weekDay[]" value="الخميس" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-4">
                               <select name="start_time[]" placeholder="من" id="start_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">من</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                               <div class="col-md-4">
                                  <select name="end_time[]" placeholder="الى" id="end_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                          </div>

                          <div class="input-group control-group">
                               <div class="col-md-4">
                               <input id="weekDay" name="weekDay[]" value="الجمعة" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-4">
                               <select name="start_time[]" placeholder="من" id="start_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">من</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
                               <div class="col-md-4">
                                  <select name="end_time[]" placeholder="الى" id="end_time" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
                                    <option value="off">من</option>   
                                    <option value="1ص">1 ص</option>
                                    <option value="2ص">2 ص</option>
                                    <option value="3ص">3 ص</option>
                                    <option value="4ص">4 ص</option>
                                    <option value="5ص">5 ص</option>
                                    <option value="6ص">6 ص</option>
                                    <option value="7ص">7 ص</option>
                                    <option value="8ص">8 ص</option>
                                    <option value="9ص">9 ص</option>
                                    <option value="10ص">10 ص</option>
                                    <option value="11ص">11 ص</option>
                                    <option value="12ص">12 ص</option>
                                    <option value="1م">1 م</option>
                                    <option value="2م">2 م</option>
                                    <option value="3م">3 م</option>
                                    <option value="4م">4 م</option>
                                    <option value="5م">5 م</option>
                                    <option value="6م">6 م</option>
                                    <option value="7م">7 م</option>
                                    <option value="8م">8 م</option>
                                    <option value="9م">9 م</option>
                                    <option value="10م">10 م</option>
                                    <option value="11م">11 م</option>
                                    <option value="12م">12 م</option>
                                  </select>
                               </div>
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
            </div>
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success-one").click(function(){ 
          var html = $(".clone-one").html();
          $(".increment-one").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

        $('#type').change(function(){
            $('.clinic').hide();
            $('.pharmacy').hide();
            $('#' + $(this).val()).show();
        });

        $('#yes_or_no').change(function(){
            $('.نعم').hide();
            $('#' + $(this).val()).show();
        });

        $('#yes_or_no_two').change(function(){
            $('.نعم').hide();
            $('#' + $(this).val()).show();
        });

    });
    </script>
@endsection