<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learner Progress</title>
    <link rel="stylesheet" href="{{ asset('css/learner-progress.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="8" fill="#007bff"/>
                    <path d="M20 10L28 15V25L20 30L12 25V15L20 10Z" stroke="white" stroke-width="2" fill="none"/>
                    <circle cx="20" cy="20" r="3" fill="white"/>
                </svg>
                <span class="logo-text">Adriaan's Assessment</span>
            </div>
            <nav class="nav">
                <a href="/" class="nav-link active">Dashboard</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Learner Progress</h1>

        <div class="controls">
            <form method="GET" style="display: flex; gap: 10px; flex-wrap: wrap;">
                <div class="control-group">
                    <label for="course">Filter by Course:</label>
                    <select name="course" id="course">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" @if($selectedCourse == $course->id) selected @endif>{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="control-group">
                    <label for="sort">Sort by:</label>
                    <select name="sort" id="sort">
                        <option value="name" @if($sortBy === 'name') selected @endif>Name (A-Z)</option>
                        <option value="progress" @if($sortBy === 'progress') selected @endif>Progress (High to Low)</option>
                    </select>
                </div>

                <button type="submit">Apply</button>
            </form>
        </div>

        @if($learners->count() > 0)
            @foreach($learners as $learner)
                <div class="learner-item">
                    <div class="learner-name">{{ $learner->firstname }} {{ $learner->lastname }}</div>

                    @if($learner->courses->count() > 0)
                        <div class="courses-list">
                            @foreach($learner->courses as $course)
                                <div class="course-item">
                                    <div class="course-name">{{ $course->name }}</div>
                                    <div class="progress-container">
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: {{ $course->pivot->progress }}%"></div>
                                        </div>
                                        <div class="progress-text">{{ $course->pivot->progress }}%</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #999; font-size: 14px;">No courses enrolled</p>
                    @endif
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <p>No learners found for the selected filters.</p>
            </div>
        @endif
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="8" fill="#007bff"/>
                    <path d="M20 10L28 15V25L20 30L12 25V15L20 10Z" stroke="white" stroke-width="2" fill="none"/>
                    <circle cx="20" cy="20" r="3" fill="white"/>
                </svg>
                <span>Adriaan's Assessment © 2026</span>
            </div>
            <div class="footer-contact">
                <div class="contact-name">Adriaan van Niekerk</div>
                <div class="contact-details">
                    <a href="tel:+27623542471">+27 62 354 2471</a>
                    <span class="separator">•</span>
                    <a href="mailto:adriaan.e.van.niekerk@gmail.com">adriaan.e.van.niekerk@gmail.com</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
