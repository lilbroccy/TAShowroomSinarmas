<aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route ('dashboard') }}" aria-expanded="false"><i class="me-3 fa fa-chart-bar fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false">
                                <i class="me-3 fa fa-user" aria-hidden="true"></i><span
                                    class="hide-menu">Profile</span></a>
                        </li> -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="me-3 fa fa-calendar"
                                    aria-hidden="true"></i><span class="hide-menu">Jadwal Test Drive</span></a>
                        </li>
                        <li class="sidebar-item"> 
                            <a id="data-mobil-link" class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false">
                                <i class="me-3 fa fa-car" aria-hidden="true"></i>
                                <span class="hide-menu">Data Mobil <i class="fa fa-chevron-down"></i></span>
                            </a>
                            <!-- Submenu untuk Data Mobil -->
                            <ul id="data-mobil-submenu" class="sidebar-submenu">
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route ('dashboard.car-units')}}" aria-expanded="false">
                                        <i class="me-3 fa fa-ambulance" aria-hidden="true"></i>
                                        <span class="hide-menu">Unit Mobil</span>
                                    </a>
                                </li>
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false">
                                        <i class="me-3 fa fa-list-alt" aria-hidden="true"></i>
                                        <span class="hide-menu">Kategori</span>
                                    </a>
                                </li>
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false">
                                        <i class="me-3 fa fa-copyright" aria-hidden="true"></i>
                                        <span class="hide-menu">Brand</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="me-3 fa fa-user"
                                    aria-hidden="true"></i><span class="hide-menu">Data User</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="#" aria-expanded="false"><i class="me-3 fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">Data Penjualan</span></a>
                        </li>
                        <!-- <li class="text-center p-20 upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/monsteradmin/"
                                class="btn btn-danger text-white mt-4" target="_blank">Upgrade to
                                Pro</a>
                        </li> -->
                    </ul>
                </nav>
            </div>
        </aside>