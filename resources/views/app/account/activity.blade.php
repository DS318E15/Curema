@foreach($account->changes as $change)
    <div class="activity">
        <div>
            <a href="{{ route('app.employee.show', $change->user_id) }}">{{ $change->user->name }}</a>

            @if($change->type == "update")
                updated
            @elseif($change->type == "create")
                created
            @elseif($change->type == "delete")
                deleted
            @elseif($change->type == "restore")
                restored
            @elseif($change->type == "stage")
                changed the stage of
            @else
                changed
            @endif

            @if($change->subject == 'account')
                an <a href="{{ route('app.opportunity.show', $change->opportunity_id) }}">opportunity</a> on this
                account
            @elseif($change->subject == 'contact')
                a <a href="{{ route('app.contact.show', $change->contact_id) }}">contact</a> on this account
            @elseif($change->subject == 'ticket')
                a <a href="{{ route('app.ticket.show', $change->ticket_id) }}">ticket</a> on this account
            @elseif($change->subject == 'call')
                a <a href="{{ route('app.call.show', $change->call_id) }}">call</a> made to this account
            @elseif($change->subject == 'email')
                a <a href="{{ route('app.email.show', $change->email_id) }}">email</a> sent to this account
            @else
                this account
            @endif
        </div>
        <small>{{ $change->created_at }}</small>
    </div>
@endforeach