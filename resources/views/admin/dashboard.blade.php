@extends('layouts.admin')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
             <!-- eCommerce statistic -->
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('admin.users')}}">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">

                 <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$userActive}}</h3>
                      <h6>المفعل</h6>
                    </div>
                    <div>
                      <i class="fas fa-user success font-large-2 float-right"></i>
                    </div>
                  </div>

                  <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$userNotActive}}</h3>
                      <h6>غير مفعل</h6>
                    </div>
                  </div>

                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$percentUsers}}%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                 </div>
              </div>
            </div>
            </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
           <a href="{{route('admin.dogs')}}">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$selldogsActive}}</h3>
                      <h6>المفعل</h6>
                    </div>
                    <div>
                      <i class="fas fa-dog success font-large-2 float-right"></i>
                    </div>
                  </div>

                  <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$selldogsNotActive}}</h3>
                      <h6>غير مفعل</h6>
                    </div>
                  </div>

                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$percentSelldogs}}%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
           </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
           <a href="{{route('admin.guides')}}">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$guideActive}}</h3>
                      <h6>المفعل</h6>
                    </div>
                    <div>
                      <i class="fas fa-building success font-large-2 float-right"></i>
                    </div>
                  </div>

                  <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$guideNotActive}}</h3>
                      <h6>غير مفعل</h6>
                    </div>
                  </div>

                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$percentGuide}}%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
           </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <a href="{{route('admin.areas')}}">
                <div class="card-body">
                <div class="media d-flex" style="margin-bottom: 20px;">
                 <div class="media-body text-left">
                      <h3 class="success">{{$areasActive}}</h3>
                      <h6>المفعل</h6>
                    </div>
                    <div>
                      <i class="fas fa-location-arrow success font-large-2 float-right"></i>
                    </div>
                  </div>

                  <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$areasNotActive}}</h3>
                      <h6>غير مفعل</h6>
                    </div>
                  </div>

                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$percentAreas}}%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!--/ eCommerce statistic -->

        <!-- eCommerce statistic -->
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
            <a href="{{route('admin.requestsUser')}}">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">

                 <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$usersMass}}</h3>
                      <h6>انضمام المستخدمين</h6>
                    </div>
                    <div>
                      <i class="fas fa-envelope success font-large-2 float-right"></i>
                    </div>
                  </div>

                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$percentUsersMass}}%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                 </div>
              </div>
            </div>
            </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
           <a href="">
           <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$clinics}}</h3>
                      <h6>العيادات</h6>
                    </div>
                    <div>
                      <i class="fas fa-clinic-medical success font-large-2 float-right"></i>
                    </div>
                  </div>

                  <div class="media d-flex" style="margin-bottom: 20px;">
                    <div class="media-body text-left">
                      <h3 class="success">{{$ClinicReservations}}</h3>
                      <h6>الحجوزات</h6>
                    </div>
                  </div>

                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$percentClinicReservationsFromUser}}%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
           </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
           <a href="">

            </a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <a href="">

                </a>
              </div>
            </div>
          </div>
        </div>
        <!--/ eCommerce statistic -->

        </div>
    </div>
    
@endsection
