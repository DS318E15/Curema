@foreach($changes as $change)
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

            @if(count($change->account))
                this <a href="{{ route('app.account.show', $change->account_id) }}">account</a>
            @elseif(count($change->call))
                this <a href="{{ route('app.call.show', $change->call_id) }}">call</a>
            @elseif(count($change->contact))
                this <a href="{{ route('app.contact.show', $change->contact_id) }}">contact</a>
            @elseif(count($change->email))
                this <a href="{{ route('app.email.show', $change->email_id) }}">email</a>
            @elseif(count($change->lead))
                this <a href="{{ route('app.lead.show', $change->lead_id) }}">lead</a>
            @elseif(count($change->opportunity))
                this <a href="{{ route('app.opportunity.show', $change->opportunity_id) }}">opportunity</a>
            @elseif(count($change->ticket))
                this <a href="{{ route('app.ticket.show', $change->ticket_id) }}">ticket</a>
            @else
                this employee.
            @endif
        </div>
        <small>{{ $change->created_at }}</small>
    </div>
@endforeach