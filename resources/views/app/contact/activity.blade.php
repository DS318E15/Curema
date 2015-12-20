@foreach($contact->changes as $change)
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

            @if($change->subject == 'ticket')
                a <a href="{{ route('app.ticket.show', $change->ticket_id) }}">case</a> on this contact.
            @elseif($change->subject == 'call')
                a <a href="{{ route('app.call.show', $change->call_id) }}">call</a> made to this contact.
            @elseif($change->subject == 'email')
                a <a href="{{ route('app.email.show', $change->email_id) }}">email</a> sent to this contact.
            @else
                this contact.
            @endif
        </div>
        <small>{{ $change->created_at }}</small>
    </div>
@endforeach