@extends('layouts.front')
@section('title','اضاف دليلك')
@section('content')
@if (!Auth::guest() && auth()->user()->active == 1 && auth()->user()->type != 1)
    <div class="main">
        <section>
            <div class="container">
                <div>
                    <form method="post" action="{{url('addGuides')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                      <h2 class="form-title centered">أضافة دليلك</h2>

                      @if(session('success'))
                        <div class="alert alert-success">
                          {{ session('success') }}
                        </div> 
                      @endif

                      <div class="form-group">
                            <input id="name" placeholder="الأسم" type="text" class="form-control form-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group control-group increment" style="margin-bottom: 15px;">
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn"> 
                              <button class="btn btn-success btn-addRemove" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                            </div>
                          </div>
                          <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">
                              <input type="file" name="filename[]" class="form-control" style="margin-bottom: 15px;">
                              <div class="input-group-btn"> 
                                <button style="margin-top:-18px;" class="btn btn-danger btn-addRemove" type="button"><i class="glyphicon glyphicon-remove"></i></button>
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
                                <!-- <strong>{{ $errors->first('filename.*') }}</strong> -->
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

                        @if (auth()->user()->type == 2)
                        <div class="clinic">
                            <div class="form-group">
                                <p style="margin-bottom:0;">هل يقبل الكشف المنزلى</p>
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
                        @endif
                        @if (auth()->user()->type == 3)
                        <div class="pharmacy">
                             <div class="form-group">
                                <p style="margin-bottom:0;">توصيل المنازل</p>
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
                        @endif
                        <div class="form-group" >
                              <textarea id="offers_services" placeholder="الوصف" class="form-control form-input @error('offers_services') is-invalid @enderror" name="offers_services" autofocus>{{ old('offers_services') }}</textarea>
                              @error('offers_services')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                        </div>
                    
                        
                        <p style="margin-bottom:10px;">مواعيد العمل</p>
                        
                          <div class="row">
                               <div class="col-md-3">
                                 <input id="weekDayOne" name="weekDay[]" value="السبت" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-3">
                               <select name="start_time[]" placeholder="من" id="start_time_one" class="form-control form-input dynamic @error('type') is-invalid @enderror">
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
                               <div class="col-md-3">
                                  <select name="end_time[]" placeholder="الى" id="end_time_one" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
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
                               <div class="col-md-3">
                                  <input type="checkbox" id="isOne"/> اغلاق
                               </div>  
                          </div>
                          
                          <div class="row">
                               <div class="col-md-3">
                                  <input id="weekDayTwo" name="weekDay[]" value="الأحد" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-3">
                               <select name="start_time[]" placeholder="من" id="start_time_two" class="form-control form-input dynamic @error('type') is-invalid @enderror">
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
                               <div class="col-md-3">
                                  <select name="end_time[]" placeholder="الى" id="end_time_two" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
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
                               <div class="col-md-3">
                                  <input type="checkbox" id="isTwo"/> اغلاق
                               </div>  
                          </div>

                          <div class="row">
                               <div class="col-md-3">
                                  <input id="weekDayThree" name="weekDay[]" value="الأثنين" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-3">
                               <select name="start_time[]" placeholder="من" id="start_time_three" class="form-control form-input dynamic @error('type') is-invalid @enderror">
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
                               <div class="col-md-3">
                                  <select name="end_time[]" placeholder="الى" id="end_time_three" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
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
                               <div class="col-md-3">
                                  <input type="checkbox" id="isThree"/> اغلاق
                               </div>  
                          </div>

                          <div class="row">
                               <div class="col-md-3">
                                  <input id="weekDayFour" name="weekDay[]" value="الثلاثاء" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-3">
                               <select name="start_time[]" placeholder="من" id="start_time_four" class="form-control form-input dynamic @error('type') is-invalid @enderror">
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
                               <div class="col-md-3">
                                  <select name="end_time[]" placeholder="الى" id="end_time_four" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
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
                               <div class="col-md-3">
                                  <input type="checkbox" id="isFour"/> اغلاق
                               </div>  
                          </div>

                          <div class="row">
                               <div class="col-md-3">
                                 <input id="weekDayFive" name="weekDay[]" value="الأربعاء" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-3">
                               <select name="start_time[]" placeholder="من" id="start_time_five" class="form-control form-input dynamic @error('type') is-invalid @enderror">
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
                               <div class="col-md-3">
                                  <select name="end_time[]" placeholder="الى" id="end_time_five" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
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
                               <div class="col-md-3">
                                  <input type="checkbox" id="isFive"/> اغلاق
                               </div>  
                          </div>

                          <div class="row">
                               <div class="col-md-3">
                               <input id="weekDaySix" name="weekDay[]" value="الخميس" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-3">
                               <select name="start_time[]" placeholder="من" id="start_time_six" class="form-control form-input dynamic @error('type') is-invalid @enderror">
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
                               <div class="col-md-3">
                                  <select name="end_time[]" placeholder="الى" id="end_time_six" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
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
                               <div class="col-md-3">
                                  <input type="checkbox" id="isSix"/> اغلاق
                               </div>  
                          </div>

                          <div class="row">
                               <div class="col-md-3">
                               <input id="weekDaySeven" name="weekDay[]" value="الجمعة" type="text" class="form-control form-input" readonly>
                               </div>
                               <div class="col-md-3">
                               <select name="start_time[]" placeholder="من" id="start_time_seven" class="form-control form-input dynamic @error('type') is-invalid @enderror">
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
                               <div class="col-md-3">
                                  <select name="end_time[]" placeholder="الى" id="end_time_seven" class="form-control form-input dynamic @error('type') is-invalid @enderror">
                                    <option value="off">الى</option>   
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
                               <div class="col-md-3">
                                  <input type="checkbox" id="isSeven"/> اغلاق
                               </div>  
                          </div>
                            
                        
                        <div class="form-group">
                            <input style="margin:15px;" type="submit" name="submit" id="submit" class="btn btn-primary" value="اضافة"/>
                        </div>
                    </form>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{asset('assets/front/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/front/js/main-login.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

        $('#yes_or_no').change(function(){
            $('.نعم').hide();
            $('#' + $(this).val()).show();
        });

        $('#yes_or_no_two').change(function(){
            $('.نعم').hide();
            $('#' + $(this).val()).show();
        });

        $('#isOne').click(function() {
            if($("#isOne").is(':checked')){
                $("#start_time_one").attr("disabled", "disabled"); 
                $("#end_time_one").attr("disabled", "disabled"); 
                $("#weekDayOne").attr("disabled", "disabled"); 
            }else{
                $("#start_time_one").removeAttr("disabled", "disabled"); 
                $("#end_time_one").removeAttr("disabled", "disabled"); 
                $("#weekDayOne").removeAttr("disabled", "disabled"); 
            }
        });

        $('#isTwo').click(function() {
            if($("#isTwo").is(':checked')){
                $("#start_time_two").attr("disabled", "disabled"); 
                $("#end_time_two").attr("disabled", "disabled"); 
                $("#weekDayTwo").attr("disabled", "disabled"); 
            }else{
                $("#start_time_two").removeAttr("disabled", "disabled"); 
                $("#end_time_two").removeAttr("disabled", "disabled"); 
                $("#weekDayTwo").removeAttr("disabled", "disabled"); 
            }
        });

        $('#isThree').click(function() {
            if($("#isThree").is(':checked')){
                $("#start_time_three").attr("disabled", "disabled"); 
                $("#end_time_three").attr("disabled", "disabled"); 
                $("#weekDayThree").attr("disabled", "disabled"); 
            }else{
                $("#start_time_three").removeAttr("disabled", "disabled"); 
                $("#end_time_three").removeAttr("disabled", "disabled"); 
                $("#weekDayThree").removeAttr("disabled", "disabled"); 
            }
        });

        $('#isFour').click(function() {
            if($("#isFour").is(':checked')){
                $("#start_time_four").attr("disabled", "disabled"); 
                $("#end_time_four").attr("disabled", "disabled"); 
                $("#weekDayFour").attr("disabled", "disabled"); 
            }else{
                $("#start_time_four").removeAttr("disabled", "disabled"); 
                $("#end_time_four").removeAttr("disabled", "disabled");
                $("#weekDayFour").removeAttr("disabled", "disabled");  
            }
        });

        $('#isFive').click(function() {
            if($("#isFive").is(':checked')){
                $("#start_time_five").attr("disabled", "disabled"); 
                $("#end_time_five").attr("disabled", "disabled"); 
                $("#weekDayFive").attr("disabled", "disabled");
            }else{
                $("#start_time_five").removeAttr("disabled", "disabled"); 
                $("#end_time_five").removeAttr("disabled", "disabled"); 
                $("#weekDayFive").removeAttr("disabled", "disabled"); 
            }
        });

        $('#isSix').click(function() {
            if($("#isSix").is(':checked')){
                $("#start_time_six").attr("disabled", "disabled"); 
                $("#end_time_six").attr("disabled", "disabled"); 
                $("#weekDaySix").attr("disabled", "disabled");
            }else{
                $("#start_time_six").removeAttr("disabled", "disabled"); 
                $("#end_time_six").removeAttr("disabled", "disabled");
                $("#weekDaySix").removeAttr("disabled", "disabled");  
            }
        });

        $('#isSeven').click(function() {
            if($("#isSeven").is(':checked')){
                $("#start_time_seven").attr("disabled", "disabled"); 
                $("#end_time_seven").attr("disabled", "disabled"); 
                $("#weekDaySeven").attr("disabled", "disabled");
            }else{
                $("#start_time_seven").removeAttr("disabled", "disabled"); 
                $("#end_time_seven").removeAttr("disabled", "disabled"); 
                $("#weekDaySeven").removeAttr("disabled", "disabled"); 
            }
        });
    });
    </script>



@else
<div class="alert alert-danger not-active-alert" role="alert">
    انت مستخدم غير مفعل لن تستمتع بجميع مميزات الموقع --- انتظر التفعيل او تواصل معنا
</div>
@endif
@endsection