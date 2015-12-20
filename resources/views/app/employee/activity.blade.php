@foreach($employee->changes as $change)
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
            @else
                changed
            @endif

            @if($change->subject == 'account')
                this <a href="{{ route('app.account.show', $change->account_id) }}">account</a>
            @elseif($change->subject == 'call')
                this <a href="{{ route('app.call.show', $change->call_id) }}">call</a>
            @elseif($change->subject == 'contact')
                this <a href="{{ route('app.contact.show', $change->contact_id) }}">contact</a>
            @elseif($change->subject == 'email')
                this <a href="{{ route('app.email.show', $change->email_id) }}">email</a>
            @elseif($change->subject == 'lead')
                this <a href="{{ route('app.lead.show', $change->lead_id) }}">lead</a>
            @elseif($change->subject == 'opportunity')
                this <a href="{{ route('app.opportunity.show', $change->opportunity_id) }}">opportunity</a>
            @elseif($change->subject == 'ticket')
                this <a href="{{ route('app.ticket.show', $change->ticket_id) }}">ticket</a>
            @else
                this employee.
            @endif
        </div>
        <small>{{ $change->created_at }}</small>
    </div>
@endforeach