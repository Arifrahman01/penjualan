<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <ul class="sidebar-menu">
        <li class="{{ request()->is("transaksi") || request()->is("transaksi/*") ? "active" : "" }}"><a class="nav-link"
          href="{{ route("transaksi.index") }}"><i class="fas fa-list"></i> <span>Transaksi</span> </a></li>
      </ul>
      <ul class="sidebar-menu">
        <li class="dropdown {{ request()->is("barang") || request()->is("barang/*") ||
        request()->is("supplier") || request()->is("supplier/*")
          ? "active" : "" }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i><span>Master</span></a>
          <ul class="dropdown-menu">

            <li class="{{ request()->is("barang") || request()->is("barang/*") ? "active" : "" }}"><a class="nav-link"
                href="{{  route("barang.index") }}">Barang</a></li>

            <li class="{{ request()->is("supplier") || request()->is("supplier/*") ? "active" : "" }}"><a class="nav-link"
              href="{{  route("supplier.index") }}">Supplier</a></li>
          </ul>
        </li>
      </ul>
      <ul class="sidebar-menu">
        <li class="{{ request()->is("report") || request()->is("report/*") ? "active" : "" }}"><a class="nav-link"
          href="{{ route("report.index") }}"><i class="fas fa-chart-line"></i> <span>Report</span> </a></li>
      </ul>
    </aside>
  </div>