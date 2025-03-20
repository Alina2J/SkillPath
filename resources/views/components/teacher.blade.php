<li class="card-item">
    <a href="{{ route('teacher-page', $teacher->id) }}" class="card-link">
        <img width="156" height="156" src="/storage/{{ $teacher->photo_url }}" alt="" class="card-img">
        <div class="card-desc">
            <h3 class="card-title">{{ $teacher->name }} {{ $teacher->surname }}</h3>
            <p class="card-subtitle">{{ $teacher->direction }}</p>
        </div>
    </a>
</li>
