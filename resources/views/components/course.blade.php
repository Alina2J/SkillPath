<li style="width: 100%;" class="card-item">
    <a style="    display: flex; flex-direction: column; justify-content: space-between;"
        href="{{ route('course-page', $course->id) }}" class="card-link">
        <img style="height: inherit; object-fit: cover;" width="156" height="156"
            src="/storage/{{ $course->photo_url }}" alt="" class="card-img">
        <div style="padding: 1.5rem 1rem;" class="card-desc">
            <h3 class="card-title">{{ $course->title }}</h3>
            <p class="card-subtitle">{{ $course->subCategory->title }}</p>
        </div>
    </a>
</li>
