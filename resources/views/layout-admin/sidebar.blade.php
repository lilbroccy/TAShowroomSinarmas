<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route ('dashboard') }}" aria-expanded="false"><i class="me-3 fa fa-chart-bar fa-fw"
                            aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('dashboard.check-units') }}" aria-expanded="false"><i class="me-3 fa fa-calendar"
                            aria-hidden="true"></i><span class="hide-menu">Jadwal Cek Unit</span></a>
                </li>
                <li class="sidebar-item"> 
                    <a id="data-mobil-link" class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false">
                        <i class="me-3 fa fa-car" aria-hidden="true"></i>
                        <span class="hide-menu">Data Mobil <i class="fa fa-chevron-down"></i></span>
                    </a>
                    <ul id="data-mobil-submenu" class="sidebar-submenu">
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route ('dashboard.car-units')}}" aria-expanded="false">
                                <i class="me-3 fa fa-ambulance" aria-hidden="true"></i>
                                <span class="hide-menu">Unit Mobil</span>
                            </a>
                        </li>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route ('dashboard.categories')}}" aria-expanded="false">
                                <i class="me-3 fa fa-list-alt" aria-hidden="true"></i>
                                <span class="hide-menu">Kategori</span>
                            </a>
                        </li>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route ('dashboard.brands')}}" aria-expanded="false">
                                <i class="me-3 fa fa-copyright" aria-hidden="true"></i>
                                <span class="hide-menu">Brand</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route ('dashboard.sales')}}" aria-expanded="false"><i class="me-3 fa fa-table"
                            aria-hidden="true"></i><span class="hide-menu">Data Penjualan</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route ('dashboard.users')}}" aria-expanded="false"><i class="me-3 fa fa-user"
                            aria-hidden="true"></i><span class="hide-menu">Data User</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route ('dashboard.titipan')}}" aria-expanded="false"><i class="me-3 fa fa-car"
                            aria-hidden="true"></i><span class="hide-menu">Data Mobil Titipan</span></a>
                </li>
            </ul>
        </nav>
        <div class="text-center mt-3">
        <a href="{{ route('logout') }}" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    </div>
    
</aside>