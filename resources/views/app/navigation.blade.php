<ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">Accounts</a></li>
    <li><a href="#">Employees</a></li>
    <li><a href="#">Contacts</a></li>
    <li><a href="#">Opportunities</a></li>
    <li><a href="#">Leads</a></li>

    <li>
        <a href="{{ route('app.home') }}" class="{{ Ekko::isActiveRoute('app.home') }}">
            <i class="halflings white home"></i> Home
        </a>
    </li>

</ul>