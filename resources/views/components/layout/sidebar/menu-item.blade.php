<li class="nav-item {{ $isSubmenuActive }}">
    <a href="{{ $url }}" class="nav-link {{ $isActive }}">
        <i class="nav-icon fas {{ $icon }}"></i>
        <p>
            {{ $label }}
            @if ($submenu)
                <i class="right fas fa-angle-left"></i>
            @endif
        </p>
    </a>
    @if ($submenu)
        <ul class="nav nav-treeview">
            {{ $slot }}
        </ul>
    @endif
</li>
