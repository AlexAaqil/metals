<aside>
    @php
        $user = Auth::user();
    @endphp

    <div class="header">
        <a href="{{ route('profile.edit') }}">
            @if($user->image)
                <img src="{{ asset('storage/' . ($user->image)) }}" alt="User Image">
            @else
                <img src="{{ asset('assets/images/default_profile.jpg') }}" alt="Profile Image" width="25" height="25">
            @endif
        </a>
        <span class="text">
            {{ $user->first_name . ' ' . $user->last_name }}
            <span>{{ $user->email }}</span>
        </span>
    </div>

    @php
        $nav_content = collect([
            [
                'route' => 'dashboard',
                'icon' => 'fas fa-home',
                'text' => 'Dashboard',
                'level' => [0, 1],
            ],
        ]);

        $userLevel = $user->user_level ?? null;
        $nav_links = $nav_content->filter(fn($link) => in_array($userLevel, $link['level']));
    @endphp

    <ul class="links">
        @foreach ($nav_links as $link)
            <li class="link {{ Route::currentRouteName() === $link['route'] ? 'active' : '' }}">
                <a href="{{ route($link['route']) }}">
                    <i class="{{ $link['icon'] }}"></i>
                    <span class="text">{{ $link['text'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="footer">
        <div class="logout">
            <form action="{{ route('logout') }}" method="post">
                @csrf

                <button type="submit">
                    <span class="text">Logout</span>
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
