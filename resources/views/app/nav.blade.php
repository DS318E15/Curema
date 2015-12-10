<ul>
    <li><a href="{{ route('app.dashboard.index') }}" class="{{ Ekko::isActiveRoute('app.dashboard.index') }}">Home</a></li>
    <li><a href="{{ route('app.opportunity.index') }}" class="{{ Ekko::isActiveRoute('app.opportunity.index') }}">Opportunities</a></li>
    <li><a href="{{ route('app.lead.index') }}" class="{{ Ekko::isActiveRoute('app.lead.index') }}">Leads</a></li>
    <li><a href="{{ route('app.account.index') }}" class="{{ Ekko::isActiveRoute('app.account.index') }}">Accounts</a></li>
    <li><a href="{{ route('app.contact.index') }}" class="{{ Ekko::isActiveRoute('app.contact.index') }}">Contacts</a></li>
    <li><a href="{{ route('app.case.index') }}" class="{{ Ekko::isActiveRoute('app.case.index') }}">Cases</a></li>
    <li><a href="{{ route('app.employee.index') }}" class="{{ Ekko::isActiveRoute('app.employee.index') }}">Employees</a></li>
</ul>