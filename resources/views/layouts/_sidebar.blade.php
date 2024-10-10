<aside class="sidebar sidebar-default navs-rounded-all ">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <!--Logo start-->
            <svg width="30" class="" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)"
                    fill="currentColor" />
                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)"
                    fill="currentColor" />
                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)"
                    fill="currentColor" />
                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)"
                    fill="currentColor" />
            </svg>
            <!--logo End-->
            <h4 class="logo-title">{{ env('APP_NAME') }}</h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <!-- Sidebar Menu Start -->
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                <li class="nav-item static-item">
                    <a class="nav-link static-item disabled" href="#" tabindex="-1">
                        <span class="default-icon">Menus</span>
                        <span class="mini-icon">M</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : ''  }}" aria-current="page"
                        href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-house"></i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
                @if(\Helper::cek_akses('Penyakit','Lihat') || \Helper::cek_akses('Kelas','Lihat') || \Helper::cek_akses('Unit','Lihat') || \Helper::cek_akses('Staff','Lihat') || \Helper::cek_akses('Siswa','Lihat') )
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#masterdata-menu" role="button"
                        aria-expanded="false" aria-controls="masterdata-menu">
                        <i class="fa-solid fa-database"></i>

                        <span class="item-name">Master Data</span>
                        <i class="right-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </i>
                    </a>
                    <ul class="sub-nav collapse" id="masterdata-menu" data-bs-parent="#sidebar-menu">
                        @if(\Helper::cek_akses('Penyakit','Lihat'))
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('penyakit*')) ? 'active' : ''  }}"
                                aria-current="page" href="{{ route('penyakit.index') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> P </i>
                                <span class="item-name"> Penyakit </span>
                            </a>
                        </li>
                        @endif
                        @if(\Helper::cek_akses('Unit','Lihat'))
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('unit*')) ? 'active' : ''  }}" aria-current="page" href="{{ route('unit.index') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> U </i>
                                <span class="item-name"> Unit </span>
                            </a>
                        </li>
                        @endif
                        @if(\Helper::cek_akses('Kelas','Lihat'))
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('kelas*')) ? 'active' : ''  }}"
                                aria-current="page" href="{{ route('kelas.index') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> K </i>
                                <span class="item-name"> Kelas </span>
                            </a>
                        </li>
                        @endif
                        @if(\Helper::cek_akses('Staff','Lihat'))
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('staff*')) ? 'active' : ''  }}" aria-current="page"
                                href="{{ route('staff.index') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> SF </i>
                                <span class="item-name"> Admin/Staff Sekolah </span>
                            </a>
                        </li>
                        @endif
                        @if(\Helper::cek_akses('Siswa','Lihat'))
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('siswa*')) ? 'active' : ''  }}" aria-current="page"
                                href="{{ route('siswa.index') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> SF </i>
                                <span class="item-name"> Siswa </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(\Helper::cek_akses('Skrining','Lihat'))
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('skrining')) ? 'active' : ''  }}" aria-current="page"
                        href="{{ route('skrining.index') }}">
                        <i class="fa-solid fa-file"></i>
                        <span class="item-name">Skrining</span>
                    </a>
                </li>
                @endif

                @if(\Helper::cek_akses('Level','Lihat') || \Helper::cek_akses('Pengaturan','Lihat'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#settings-menu" role="button"
                        aria-expanded="false" aria-controls="settings-menu">
                        <i class="fa-solid fa-gears"></i>

                        <span class="item-name">Settings</span>
                        <i class="right-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </i>
                    </a>
                    <ul class="sub-nav collapse" id="settings-menu" data-bs-parent="#sidebar-menu">
                        @if(\Helper::cek_akses('Level','Lihat'))
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('level*')) ? 'active' : ''  }}" aria-current="page"
                                href="{{ route('level.index') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> L </i>
                                <span class="item-name"> Level </span>
                            </a>
                        </li>
                        @endif
                        @if(\Helper::cek_akses('Pengaturan','Lihat'))
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('pengaturan*')) ? 'active' : ''  }}" aria-current="page"
                                href="{{ route('pengaturan.index') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> L </i>
                                <span class="item-name"> Pengaturan </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(\Helper::cek_akses('Laporan','Lihat'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#laporan-menu" role="button"
                        aria-expanded="false" aria-controls="laporan-menu">
                        <i class="fa-solid fa-tasks"></i>

                        <span class="item-name">Laporan</span>
                        <i class="right-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </i>
                    </a>
                    <ul class="sub-nav collapse" id="laporan-menu" data-bs-parent="#sidebar-menu">
                        
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('laporan/siswa*')) ? 'active' : ''  }}" aria-current="page"
                                href="{{ route('laporan.siswa') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> S </i>
                                <span class="item-name"> Data Siswa </span>
                            </a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('laporan/staff')) ? 'active' : ''  }}" aria-current="page"
                                href="{{ route('laporan.staff') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> ST </i>
                                <span class="item-name"> Data Admin/Staff </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('laporan/skrining-siswa')) ? 'active' : ''  }}" aria-current="page"
                                href="{{ route('laporan.skrining-siswa') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> SS </i>
                                <span class="item-name"> Data Skrining Siswa </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link  {{ (request()->is('laporan/skrining-staff')) ? 'active' : ''  }}" aria-current="page"
                                href="{{ route('laporan.skrining-staff') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> SSF </i>
                                <span class="item-name"> Data Skrining Staff </span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                @endif
            </ul>
            <!-- Sidebar Menu End -->
        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>