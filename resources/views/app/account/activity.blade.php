@foreach($account->changes as $change)
    <div class="activity">
        <div>
            <a href="{{ route('app.employee.show', $change->user_id) }}">{{ $change->user->name }}</a>

            @if($change->type == "update")
                updated
            @elseif($change->type == "create")
                created
            @elseif($change->type == "destroy")
                destroyed
            @elseif($change->type == "restore")
                restored
            @else
                changed
            @endif

            @if(count($change->opportunity))
                this account's opportunity <a href="{{ route('app.opportunity.show', $change->opportunity_id) }}">{{ $change->opportunity->name }}</a>.
            @elseif(count($change->contact))
                a <a href="{{ route('app.contact.show', $change->contact_id) }}">contact</a> on this account.
            @elseif(count($change->ticket))
                a <a href="{{ route('app.ticket.show', $change->ticket_id) }}">case</a> on this account.
            @elseif(count($change->call))
                a <a href="{{ route('app.call.show', $change->call_id) }}">call</a> made to this account.
            @elseif(count($change->email))
                a <a href="{{ route('app.email.show', $change->email_id) }}">email</a> sent to this account.
            @else
                this account.
            @endif
        </div>

        <small>{{ $change->created_at }}</small>
    </div>
@endforeach