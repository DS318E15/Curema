<ul>
    <li>
        <a href="{{ route('app.dashboard.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.dashboard.index']) }}">Dashboard</a>
    </li>
    <li>
        <a href="{{ route('app.lead.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.lead.index', 'app.lead.create', 'app.lead.show', 'app.lead.edit', 'app.lead.trash']) }}">Leads</a>
    </li>
    <li>
        <a href="{{ route('app.account.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.account.index', 'app.account.create', 'app.account.show', 'app.account.edit', 'app.account.trash']) }}">Accounts</a>
    </li>
    <li>
        <a href="{{ route('app.contact.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.contact.index', 'app.contact.create', 'app.contact.show', 'app.contact.edit', 'app.contact.trash']) }}">Contacts</a>
    </li>
    <li>
        <a href="{{ route('app.employee.index') }}"
           class="{{ Ekko::areActiveRoutes(['app.employee.index', 'app.employee.show']) }}">Employees</a>
    </li>
</ul>