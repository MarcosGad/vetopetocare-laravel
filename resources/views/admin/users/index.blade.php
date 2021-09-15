@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> المستخدمين </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> المستخدمين
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع المستخدمين</h4>
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
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal" style="margin-right: 21px;">
                                            <thead>
                                            <tr>
                                                <th>الاسم</th>
                                                <th>نوع المستخدم</th>
                                                <th>تاريخ الميلاد</th>
                                                <th>النوع</th>
                                                <th>العنوان</th>
                                                <th>عنوان العيادة</th>
                                                <th>سعر الكشف</th>
                                                <th>نبدة عنك</th>
                                                <th>الرخصة</th>

                                                <th>صورة كرنية النقابة</th>
                                                <th>صورة تحقيق الشخصية</th>
                                                <th>رخصة الصيديلة</th>
                                                
                                                <th>رقم المحمول</th>
                                                <th>البريد الألكترونى</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($users)
                                                @foreach($users as $user)
                                                    <tr>
                                                    <td style="width: 15px !important;">{{$user->name}}</td>
                                                        <td>
                                                           @if($user->type == 1) عادى @elseif($user->type == 2) عيادة @elseif($user->type == 3) صيدلية @elseif($user->type == 4) محل تجارى @elseif($user->type == 5) شركة @elseif($user->type == 6) مدرسة @endif
                                                        </td>
                                                        <td>@if($user->birth) {{$user->birth}} @else لا يوجد @endif</td>
                                                        <td>@if($user->gender) {{$user->gender}} @else لا يوجد @endif</td>
                                                        <td>@if($user->country) {{$user->country}} - {{$user->state}} - {{$user->city}} @else لا يوجد @endif</td>
                                                        <td>@if($user->address) {{$user->address}} @else لا يوجد @endif</td>
                                                        <td>@if($user->disclosure_price) {{$user->disclosure_price}} @else لا يوجد @endif</td>
                                                        <td>@if($user->about_you) {{$user->about_you}} @else لا يوجد @endif</td>
                                                        <td>@if($user->type == 2) 
                                                        <img style="width: 150px; height: 100px;" src="{{$user->license}}">
                                                         @else لايوجد @endif</td>
                                                         <td>@if($user->type == 2) 
                                                        <img style="width: 150px; height: 100px;" src="{{$user->image_of_the_guild_capricorn}}">
                                                         @else لايوجد @endif</td>
                                                         <td>@if($user->type == 2) 
                                                        <img style="width: 150px; height: 100px;" src="{{$user->Personal_identification_photo}}">
                                                         @else لايوجد @endif</td>
                                                         <td>@if($user->type == 3) 
                                                        <img style="width: 150px; height: 100px;" src="{{$user->pharmacy_license}}">
                                                         @else لايوجد @endif</td>
                                                        <td>@if($user->phone) {{$user->phone}} @else لا يوجد @endif</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.users.edit',$user -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href="{{route('admin.users.delete',$user -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                                <a href="{{route('admin.users.status',$user -> id)}}"
                                                                   class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                    @if($user->active == 0)
                                                                        تفعيل
                                                                        @else
                                                                        الغاء تفعيل
                                                                    @endif
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>                                        
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
