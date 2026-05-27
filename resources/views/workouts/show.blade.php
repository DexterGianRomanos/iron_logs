<x-app-layout>
<div class="page-wrap">

    <a href="{{ route('workouts.index') }}" class="back-link">← Back to Sessions</a>

    @php
        $emojiMap = ['Push'=>'🔥','Pull'=>'💪','Legs'=>'🦵','Full Body'=>'⚡','Cardio'=>'🏃'];
        $typeMap  = ['Push'=>'push','Pull'=>'pull','Legs'=>'legs','Full Body'=>'full','Cardio'=>'cardio'];
        $emoji = $emojiMap[$workout->type] ?? '🏋️';
        $badgeClass = 'badge-'.($typeMap[$workout->type] ?? 'push');
    @endphp

    <!-- Session Header -->
    <div class="card" style="border-left: 4px solid var(--primary); margin-bottom:20px;">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div>
                <div style="font-size:28px; margin-bottom:4px;">{{ $emoji }}</div>
                <h1 style="font-family:'Bebas Neue',sans-serif; font-size:28px; letter-spacing:1px; color:var(--navy);">{{ $workout->type }} Day</h1>
                <p style="color:var(--text-muted); font-size:13px; margin-top:2px;">
                    {{ \Carbon\Carbon::parse($workout->date)->format('l, M d, Y') }}
                </p>
            </div>
            <span class="type-badge {{ $badgeClass }}" style="font-size:12px;">{{ $workout->type }}</span>
        </div>
        @if($workout->exercises->count())
            <div class="stat-row" style="margin-top:14px;">
                <span class="stat-chip">{{ $workout->exercises->count() }} lifts</span>
                <span class="stat-chip">{{ $workout->exercises->sum('sets') }} total sets</span>
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert-success">💪 {{ session('success') }}</div>
    @endif

    <!-- Add Lift Form -->
    <div class="card">
        <h2 style="font-size:16px; font-weight:700; margin-bottom:14px; color:var(--navy);">Log a Lift</h2>

        @if($errors->any())
            <div class="alert-error">
                <strong>⚠ Fix the following:</strong>
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('exercises.store', $workout->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Exercise Name</label>
                <input type="text" name="name" placeholder="e.g. Bench Press, Squat…"
                    value="{{ old('name') }}"
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                @error('name')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <div class="grid-3" style="margin-bottom:14px;">
                <div>
                    <label class="form-label">Sets</label>
                    <input type="number" name="sets" placeholder="4" min="1"
                        value="{{ old('sets') }}"
                        class="form-control {{ $errors->has('sets') ? 'is-invalid' : '' }}">
                    @error('sets')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label">Reps</label>
                    <input type="number" name="reps" placeholder="10" min="1"
                        value="{{ old('reps') }}"
                        class="form-control {{ $errors->has('reps') ? 'is-invalid' : '' }}">
                    @error('reps')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label">Weight (kg)</label>
                    <input type="number" name="weight" placeholder="60" step="0.5" min="0"
                        value="{{ old('weight') }}"
                        class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}">
                    @error('weight')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <button type="submit" class="btn-primary full">+ Add Lift</button>
        </form>
    </div>

    <!-- Logged Lifts -->
    @if($workout->exercises->count())
        <div class="section-label">Completed Lifts</div>
        @foreach($workout->exercises as $exercise)
            <div class="exercise-pill" style="background:var(--surface); border:1px solid var(--border); border-radius:14px; padding:14px 16px; margin-bottom:10px; display:flex; justify-content:space-between; align-items:center; box-shadow:var(--shadow);">
                <div>
                    <div class="exercise-pill-name" style="margin-bottom:3px;">{{ $exercise->name }}</div>
                    <div style="font-size:13px; color:var(--primary); font-weight:700;">
                        {{ $exercise->sets }} sets × {{ $exercise->reps }} reps @ {{ $exercise->weight ?? 0 }}kg
                    </div>
                </div>
                <form action="{{ route('exercises.destroy', $exercise->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger" style="padding:6px 12px;" title="Remove">✕</button>
                </form>
            </div>
        @endforeach
    @else
        <div style="text-align:center; padding:30px 0; color:var(--text-muted);">
            <div style="font-size:36px; margin-bottom:10px;">🏋️</div>
            <p style="font-size:14px;">No lifts logged yet — add your first above!</p>
        </div>
    @endif

</div>
</x-app-layout>
