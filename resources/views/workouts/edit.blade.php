<x-app-layout>
<div class="page-wrap">

    <a href="{{ route('workouts.index') }}" class="back-link">← Back to Sessions</a>

    <h1 class="page-heading">Edit Session</h1>
    <p class="page-sub">Update the date or workout split</p>

    @if($errors->any())
        <div class="alert-error">
            <strong>⚠ Fix the following:</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('workouts.update', $workout->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-group">
                <label class="form-label" for="date">Workout Date</label>
                <input type="date" name="date" id="date"
                    value="{{ old('date', $workout->date) }}"
                    class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}">
                @error('date')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="type">Workout Split</label>
                <select name="type" id="type" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                    <option value="Push"      {{ old('type',$workout->type)=='Push'      ?'selected':'' }}>🔥 Push — Chest, Shoulders, Triceps</option>
                    <option value="Pull"      {{ old('type',$workout->type)=='Pull'      ?'selected':'' }}>💪 Pull — Back, Biceps</option>
                    <option value="Legs"      {{ old('type',$workout->type)=='Legs'      ?'selected':'' }}>🦵 Legs — Quads, Hamstrings, Calves</option>
                    <option value="Full Body" {{ old('type',$workout->type)=='Full Body' ?'selected':'' }}>⚡ Full Body</option>
                    <option value="Cardio"    {{ old('type',$workout->type)=='Cardio'    ?'selected':'' }}>🏃 Cardio / Core</option>
                </select>
                @error('type')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn-primary full" style="margin-top:8px;">Save Changes</button>
        </form>
    </div>

    <a href="{{ route('workouts.index') }}" class="btn-secondary" style="display:block; text-align:center; margin-top:12px;">Cancel</a>

</div>
</x-app-layout>
