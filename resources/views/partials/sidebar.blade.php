<aside id="aside" class="app-aside hidden-xs bg-black">
    <a href="#/" class="navbar-brand text-lt">
        <!-- <i class="fa fa-btc" class="hide"></i> -->
        <img src="{{ asset('src/img/icons/icon.png') }}" alt="UP2D Kalbar">
        {{-- UP --}}
        <span class="hidden-folded m-l-xs">UP2D Kalbar</span>
    </a>
    <div class="aside-wrap">
        <div class="app-aside-footer">
            @guest
                <nav ui-bottom-nav class="navi clearfix">
                    <ul class="nav">
                        <li><a href="{{ route('login') }}">
                            <i class="fa fa-login icon"></i>
                            <span>Login</span>
                        </a></li>
                    </ul>
                </nav>
            @else
                <nav ui-bottom-nav class="navi clearfix">
                    <ul class="nav">
                        @include('partials.menu', ['items' => $footMenu->roots()])
                    </ul>
                </nav>
            @endif
        </div>

        <div class="navi-wrap">
            <!-- nav -->
            <nav ui-nav="" class="navi clearfix">
                <ul class="nav">
                    @include('partials.menu', ['items' => $sideMenu->roots()])
                </ul>
            </nav>
            <!-- nav -->
        </div>
        <!-- / user -->
    </div>
</aside>