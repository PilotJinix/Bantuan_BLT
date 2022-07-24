<div class="app-container">
    <!-- begin app-nabar -->
    <aside class="app-navbar">
        <!-- begin sidebar-nav -->
        <div class="sidebar-nav scrollbar scroll_light">
            <ul class="metismenu " id="sidebarNav">
                <li class="nav-static-title">Menu</li>
                <li class="active"><a href="{{route("/")}}" aria-expanded="false"><i class="nav-icon ti ti-home"></i><span class="nav-title">Dashboard</span></a></li>
                @if(auth()->user()->role == 'Super Admin')
                    <li class="nav-static-title">Kelola Akun Pengguna</li>
                    <li><a href="{{route("index_user_admin")}}" aria-expanded="false"><i class="nav-icon ti ti-user"></i><span class="nav-title">Kelola User</span></a></li>
                    <li class="nav-static-title">Data Penerima Bantuan</li>
                    <li><a href="{{route('index_penerima_admin')}}" aria-expanded="false"><i class="nav-icon ti ti-book"></i><span class="nav-title">Data Penerima</span></a></li>
                    <li class="nav-static-title">Perhitungan F-AHP</li>
                    <li><a href="{{route("index_skala")}}" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Master Skala Kriteria</span></a> </li>
                    <li class="nav-static-title">Prioritas Penerima</li>
                    <li><a href="{{route("index_informasi")}}" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Informasi Penerima Bantuan</span></a> </li>
                    <li class="sidebar-banner p-4 bg-gradient text-center m-3 d-block rounded">
                        <h5 class="text-white mb-1">Sistem Penunjang Keputusan</h5>
                        <p class="font-13 text-white line-20">Bantuan Langsung Tunai Dana Desa</p>
                        <a class="btn btn-square btn-inverse-light btn-xs d-inline-block mt-2 mb-0" href="#"> BLT-DD</a>
                    </li>
                @elseif(auth()->user()->role == 'Kades')
                    <li class="nav-static-title">Data Penerima Bantuan</li>
                    <li><a href="{{route("index_penerima_admin-kades")}}" aria-expanded="false"><i class="nav-icon ti ti-book"></i><span class="nav-title">Data Penerima</span></a></li>
                    <li class="nav-static-title">Prioritas Penerima</li>
                    <li><a href="{{route("index_informasi-kades")}}" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Informasi Penerima Bantuan</span></a> </li>
                    <li class="sidebar-banner p-4 bg-gradient text-center m-3 d-block rounded">
                        <h5 class="text-white mb-1">Sistem Penunjang Keputusan</h5>
                        <p class="font-13 text-white line-20">Bantuan Langsung Tunai Dana Desa</p>
                        <a class="btn btn-square btn-inverse-light btn-xs d-inline-block mt-2 mb-0" href="#"> BLT-DD</a>
                    </li>
                @elseif(auth()->user()->role == 'Kadus')
                    <li class="nav-static-title">Data Penerima Bantuan</li>
                    <li><a href="{{route("index_penerima_admin-kadus")}}" aria-expanded="false"><i class="nav-icon ti ti-book"></i><span class="nav-title">Data Penerima</span></a></li>
                    <li class="nav-static-title">Prioritas Penerima</li>
                    <li><a href="{{route("index_informasi-kadus")}}" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span class="nav-title">Informasi Penerima Bantuan</span></a> </li>
                    <li class="sidebar-banner p-4 bg-gradient text-center m-3 d-block rounded">
                        <h5 class="text-white mb-1">Sistem Penunjang Keputusan</h5>
                        <p class="font-13 text-white line-20">Bantuan Langsung Tunai Dana Desa</p>
                        <a class="btn btn-square btn-inverse-light btn-xs d-inline-block mt-2 mb-0" href="#"> BLT-DD</a>
                    </li>
                @endif



            </ul>
        </div>
        <!-- end sidebar-nav -->
    </aside>
    <!-- end app-navbar -->
    <!-- begin app-main -->
@yield("content")
<!-- end app-main -->
</div>

