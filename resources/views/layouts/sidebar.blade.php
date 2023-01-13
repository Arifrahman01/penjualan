<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <ul class="sidebar-menu">
        <li class="dropdown {{ request()->is("company") || request()->is("company/*") ||  
          request()->is("material") || request()->is("material/*") || request()->is("uom/*")  ||  
          request()->is("uom")  ||request()->is("plant/*")  ||  request()->is("plant") || request()->is("vendor/*")  ||  
          request()->is("vendors") || request()->is("masterstatus/*")  ||  request()->is("masterstatus") || 
          request()->is("currency/*")  ||  request()->is("currency") 
          ? "active" : "" }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i><span>Master</span></a>
          <ul class="dropdown-menu">

            <li class="{{ request()->is("company") || request()->is("company/*") ? "active" : "" }}"><a class="nav-link"
                href="{{  route("barang.index") }}">Barang</a></li>
          
            <li class="{{ request()->is("material") || request()->is("material/*") ? "active" : "" }}"><a class="nav-link"
                >Material</a></li>
          
            <li class="{{ request()->is("uom") || request()->is("uom/*") ? "active" : "" }}"><a class="nav-link"
                >Unit Of Measurement</a></li>
           
              <li class="{{ request()->is("plant") || request()->is("plant/*") ? "active" : "" }}"><a class="nav-link"
                  >Plant</a></li>
           
            <li class="{{ request()->is("vendors") || request()->is("vendor/*") ? "active" : "" }}"><a class="nav-link"
                >Vendor</a></li>
         
            <li class="{{ request()->is("masterstatus") || request()->is("masterstatus/*") ? "active" : "" }}"><a class="nav-link"
                >Master Status</a></li>
          
            <li class="{{ request()->is("currency") || request()->is("currency/*") ? "active" : "" }}"><a class="nav-link"
                >Currency</a></li>
           
          </ul>
        </li>
        
      </ul>
    </aside>
  </div>