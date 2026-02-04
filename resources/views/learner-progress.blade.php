<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learner Progress</title>
    <link rel="stylesheet" href="{{ asset('css/learner-progress.css') }}">
</head>
<body>
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
</body>
</html>
