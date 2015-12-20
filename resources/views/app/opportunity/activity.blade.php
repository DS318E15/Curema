@foreach($opportunity->changes as $change)
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

            this opportunity.
        </div>
        <small>{{ $change->created_at }}</small>
    </div>
@endforeach