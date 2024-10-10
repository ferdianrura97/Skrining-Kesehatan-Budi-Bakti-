<div class="iq-navbar-header" style="height: 215px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div>
                        <h1>{{ $settings['title'] }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">{{ $settings['menu'] }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $settings['title'] }}</li>
                                {{-- <li class="breadcrumb-item"><a href="#">{{ $settings['menu'] }}</a></li>
                                <li class="breadcrumb-item" aria-current="page"> <a href="{{ route($settings['route'].'.index') }}"> {{ $settings['title'] }} </a> </li> --}}
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-header-img">
        <img src=" {{ asset('assets/images/dashboard/top-header.png') }} " alt="header"
            class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        <img src=" {{ asset('assets/images/dashboard/top-header1.png') }} " alt="header"
            class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
        <img src=" {{ asset('assets/images/dashboard/top-header2.png') }} " alt="header"
            class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
        <img src=" {{ asset('assets/images/dashboard/top-header3.png') }} " alt="header"
            class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
        <img src=" {{ asset('assets/images/dashboard/top-header4.png') }} " alt="header"
            class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
        <img src=" {{ asset('assets/images/dashboard/top-header5.png') }} " alt="header"
            class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>