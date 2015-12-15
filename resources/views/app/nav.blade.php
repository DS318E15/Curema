<ul>
    <li>
        <a href="{{ route('app.dashboard.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.dashboard.index']) }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('app.account.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.account.index', 'app.account.create', 'app.account.show', 'app.account.edit', 'app.account.trash']) }}">Accounts</a>
    </li>
    <li>
        <a href="{{ route('app.contact.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.contact.index', 'app.contact.create', 'app.contact.show', 'app.contact.edit', 'app.contact.trash']) }}">Contacts</a>
    </li>
</ul>