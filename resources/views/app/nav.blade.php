<ul>
    <li>
        <a href="{{ route('app.dashboard.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.dashboard.index']) }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('app.account.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.account.index', 'app.account.create', 'app.account.show', 'app.account.edit']) }}">Accounts</a>
    </li>

</ul>