```php
@auth
    <li class="nav-item">
        @if(auth()->user()->role === 'admin')
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
        @else
            <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard Anggota</a>
        @endif
    </li>
@endauth