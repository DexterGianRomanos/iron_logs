<x-app-layout>
<div class="page-wrap">
    <h1 class="page-heading">Dashboard</h1>
    <p class="page-sub">{{ \Carbon\Carbon::now()->format('l, M j') }}</p>
    <div class="card">
        <p style="color:var(--text-muted); font-size:15px;">Welcome back! Head to <a href="{{ route('workouts.index') }}" style="color:var(--primary); font-weight:700;">Sessions</a> to log your workout.</p>
    </div>
</div>
</x-app-layout>
