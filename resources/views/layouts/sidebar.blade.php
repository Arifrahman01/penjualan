@php
    $menuItems = session('menu') ?? null;
@endphp
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <ul class="sidebar-menu">
            @foreach ($menuItems as $menuItem)
                @if ($menuItem->children->count())
                <ul class="sidebar-menu">
                    <li
                        class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="{{ $menuItem->icon }}"></i><span>{{ $menuItem->title }}</span></a>
                        <ul class="dropdown-menu">
                            @foreach ($menuItem->children as $child)
                     
                                <li><a class="nav-link" href="{{ $child->url }}">
                                    <i class="{{ $menuItem->icon }}"></i>
                                    {{ $child->title }}</a>
                                </li>
                                {{-- <li class="{{ request()->is('barang') || request()->is('barang/*') ? 'active' : '' }}"><a
                                    class="nav-link" href="{{ route('barang.index') }}">Barang</a></li> --}}
                            @endforeach
                        </ul>
                    </li>
                </ul>
                @else
                <li><a
                    class="nav-link" href="{{ $menuItem->url }}"><i class="{{ $menuItem->icon }}"></i>
                    <span>{{ $menuItem->title }}</span> </a></li>
                @endif
            @endforeach
        </ul>
    </aside>
</div>
