<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href=""><i class="fas fa-home"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item open"><a href=""><i class="fas fa-users"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المستخدمين</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{App\User::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.users')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.users.create')}}" data-i18n="nav.dash.crypto">أضافة
                             مستخدم</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item open"><a href=""><i class="fas fa-envelope-open"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">انضمام المستخدمين</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{App\RequestsUser::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.requestsUser')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item open"><a href=""><i class="fas fa-dog"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> الحيوانات والمستلزمات</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{App\Selldogs::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.dogs')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.dogs.create')}}" data-i18n="nav.dash.crypto">أضافة
                             حيوان</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.dogs.createAccessories')}}" data-i18n="nav.dash.crypto">أضافة
                             مستلزم</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item open"><a href=""><i class="fas fa-file"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الدلائل</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{App\guide::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.guides')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.guides.create')}}" data-i18n="nav.dash.crypto">أضافة
                             دليل</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item open"><a href=""><i class="fas fa-globe-africa"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المناطق</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{App\Country_state_city::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.areas')}}"
                                          data-i18n="nav.dash.ecommerce"> كل المناطق </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.areas.create')}}" data-i18n="nav.dash.crypto">اضافة منطقة 
                             </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item open"><a href=""><i class="fas fa-sliders-h"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Slides</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{App\Slide::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.slides')}}"
                                          data-i18n="nav.dash.ecommerce"> all Slides</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.slides.create')}}" data-i18n="nav.dash.crypto">Add Slide
                             </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item open"><a href=""><i class="far fa-file-alt"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">Testimonials</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{App\Testimonial::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.testimonials')}}"
                                          data-i18n="nav.dash.ecommerce"> all Testimonials</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.testimonials.create')}}" data-i18n="nav.dash.crypto">Add Testimonial
                             </a>
                    </li>
                </ul>
            </li>
            
            <li class="nav-item open"><a href=""><i class="fas fa-database"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">النسخة الأحتياطية</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.backup')}}"
                        data-i18n="nav.dash.ecommerce">أخذ نسخة احتياطية</a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</div>
