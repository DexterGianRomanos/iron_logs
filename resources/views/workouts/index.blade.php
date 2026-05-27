<x-app-layout>
<div class="page-wrap">

    @if(session('success'))
        <div class="alert-success">💪 {{ session('success') }}</div>
    @endif

    <!-- Header -->
    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:20px;">
        <div>
            <h1 class="page-heading">Sessions</h1>
            <p class="page-sub">{{ \Carbon\Carbon::now()->format('l, M j') }}</p>
        </div>
        <a href="{{ route('workouts.create') }}" class="btn-primary">+ New</a>
    </div>

    @forelse($workouts as $workout)
        @php
            $typeMap = ['Push'=>'push','Pull'=>'pull','Legs'=>'legs','Full Body'=>'full','Cardio'=>'cardio'];
            $badgeClass = 'badge-'.($typeMap[$workout->type] ?? 'push');
            $emojiMap = ['Push'=>'🔥','Pull'=>'💪','Legs'=>'🦵','Full Body'=>'⚡','Cardio'=>'🏃'];
            $emoji = $emojiMap[$workout->type] ?? '🏋️';
        @endphp
        <div class="workout-card">
            <div class="workout-header">
                <div>
                    <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
                        <span style="font-size:20px;">{{ $emoji }}</span>
                        <span class="workout-type">{{ $workout->type }} Day</span>
                    </div>
                    <span class="type-badge {{ $badgeClass }}">{{ $workout->type }}</span>
                </div>
                <span class="workout-date">{{ \Carbon\Carbon::parse($workout->date)->format('M d, Y') }}</span>
            </div>

            @if($workout->exercises->count())
                <div class="section-label">Lifts ({{ $workout->exercises->count() }})</div>
                @foreach($workout->exercises->take(3) as $exercise)
                    <div class="exercise-pill">
                        <span class="exercise-pill-name">{{ $exercise->name }}</span>
                        <span class="exercise-pill-stats">{{ $exercise->sets }}×{{ $exercise->reps }} @ {{ number_format($exercise->weight,1) }}kg</span>
                    </div>
                @endforeach
                @if($workout->exercises->count() > 3)
                    <p style="font-size:12px; color:var(--text-muted); margin-top:4px; padding-left:4px;">
                        +{{ $workout->exercises->count() - 3 }} more lifts…
                    </p>
                @endif
            @else
                <p style="font-size:13px; color:var(--text-muted); margin:8px 0;">No lifts logged yet</p>
            @endif

            <div class="card-actions">
                <a href="{{ route('workouts.show', $workout->id) }}" class="btn-primary" style="font-size:13px; padding:9px 16px;">+ Log Lifts</a>
                <a href="{{ route('workouts.edit', $workout->id) }}" class="btn-ghost-blue">Edit</a>
                <form action="{{ route('workouts.destroy', $workout->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Delete this session?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-state-icon">🏋️</div>
            <h3>No Sessions Yet</h3>
            <p>Log your first workout and start tracking your progress.</p>
            <a href="{{ route('workouts.create') }}" class="btn-primary">Start First Session</a>
        </div>
    @endforelse

</div>
</x-app-layout>
