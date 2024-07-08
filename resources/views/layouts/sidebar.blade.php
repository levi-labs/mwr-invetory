<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="{{ asset('/logo_tpp.png') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
                <li class="sidebar-item active ">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="triangle" width="20"></i>
                        <span>Components</span>
                    </a>
                    <ul class="submenu ">

                        <li>
                            <a href="component-alert.html">Alert</a>
                        </li>

                        <li>
                            <a href="component-badge.html">Badge</a>
                        </li>

                        <li>
                            <a href="component-breadcrumb.html">Breadcrumb</a>
                        </li>

                        <li>
                            <a href="component-buttons.html">Buttons</a>
                        </li>

                        <li>
                            <a href="component-card.html">Card</a>
                        </li>

                        <li>
                            <a href="component-carousel.html">Carousel</a>
                        </li>

                        <li>
                            <a href="component-dropdowns.html">Dropdowns</a>
                        </li>

                        <li>
                            <a href="component-list-group.html">List Group</a>
                        </li>

                        <li>
                            <a href="component-modal.html">Modal</a>
                        </li>

                        <li>
                            <a href="component-navs.html">Navs</a>
                        </li>

                        <li>
                            <a href="component-pagination.html">Pagination</a>
                        </li>

                        <li>
                            <a href="component-progress.html">Progress</a>
                        </li>

                        <li>
                            <a href="component-spinners.html">Spinners</a>
                        </li>

                        <li>
                            <a href="component-tooltips.html">Tooltips</a>
                        </li>

                    </ul>

                </li> --}}
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="briefcase" width="20"></i>
                        <span>Menu Barang</span>
                    </a>
                    <ul class="submenu ">
                        <li>
                            <a href="{{ route('barang.index') }}">Daftar Barang</a>
                        </li>
                        <li>
                            <a href="{{ route('barang-masuk.index') }}">Barang Masuk</a>
                        </li>
                        <li>
                            <a href="{{ route('barang-keluar.index') }}">Barang Keluar</a>
                        </li>
                    </ul>
                </li>



                <li class='sidebar-title'>Other Menu</li>
                <li class="sidebar-item  ">
                    <a href="{{ route('kategori.index') }}" class='sidebar-link'>
                        <i data-feather="layers" width="20"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="{{ route('supplier.index') }}" class='sidebar-link'>
                        <i data-feather="grid" width="20"></i>
                        <span>Supplier</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item  ">
                    <a href="{{ route('barang.index') }}" class='sidebar-link'>
                        <i data-feather="layers" width="20"></i>
                        <span>Barang</span>
                    </a>
                </li> --}}
                @if (Auth::user()->role == 'superadmin')
                    <li class='sidebar-title'>User Management</li>
                    <li class="sidebar-item  "></li>
                    <a href="{{ route('users.index') }}" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>Daftar User</span>
                    </a>
                    </li>
                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
