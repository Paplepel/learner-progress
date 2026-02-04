<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learner Progress</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            margin-bottom: 30px;
            color: #222;
        }

        .controls {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .control-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        label {
            font-weight: 500;
            color: #666;
        }

        select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        button {
            padding: 8px 16px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background: #0056b3;
        }

        .learner-item {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .learner-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #222;
        }

        .courses-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 12px;
        }

        .course-item {
            background: #f9f9f9;
            border-left: 4px solid #007bff;
            padding: 12px;
            border-radius: 4px;
        }

        .course-name {
            font-weight: 500;
            margin-bottom: 6px;
            color: #333;
        }

        .progress-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-bar {
            flex: 1;
            height: 6px;
            background: #e0e0e0;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #28a745;
            border-radius: 3px;
        }

        .progress-text {
            font-weight: 600;
            color: #28a745;
            min-width: 50px;
            text-align: right;
        }

        .empty-state {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 40px;
            text-align: center;
            color: #999;
        }
    </style>
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
