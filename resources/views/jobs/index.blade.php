@extends('layouts.app')

@section('title', 'Browse Jobs')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-filter"></i> Filter Jobs</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('jobs.index') }}">
                        <div class="mb-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="{{ request('search') }}" placeholder="Job title or keywords">
                        </div>
                        
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" 
                                   value="{{ request('location') }}" placeholder="City, Country">
                        </div>
                        
                        <div class="mb-3">
                            <label for="job_type" class="form-label">Job Type</label>
                            <select class="form-select" id="job_type" name="job_type">
                                <option value="">All Types</option>
                                <option value="full_time" {{ request('job_type') === 'full_time' ? 'selected' : '' }}>Full Time</option>
                                <option value="part_time" {{ request('job_type') === 'part_time' ? 'selected' : '' }}>Part Time</option>
                                <option value="contract" {{ request('job_type') === 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="remote" {{ request('job_type') === 'remote' ? 'selected' : '' }}>Remote</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tech_stack" class="form-label">Technology</label>
                            <select class="form-select" id="tech_stack" name="tech_stack">
                                <option value="">All Technologies</option>
                                <option value="JavaScript" {{ request('tech_stack') === 'JavaScript' ? 'selected' : '' }}>JavaScript</option>
                                <option value="Python" {{ request('tech_stack') === 'Python' ? 'selected' : '' }}>Python</option>
                                <option value="Java" {{ request('tech_stack') === 'Java' ? 'selected' : '' }}>Java</option>
                                <option value="PHP" {{ request('tech_stack') === 'PHP' ? 'selected' : '' }}>PHP</option>
                                <option value="React" {{ request('tech_stack') === 'React' ? 'selected' : '' }}>React</option>
                                <option value="Laravel" {{ request('tech_stack') === 'Laravel' ? 'selected' : '' }}>Laravel</option>
                                <option value="Node.js" {{ request('tech_stack') === 'Node.js' ? 'selected' : '' }}>Node.js</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear Filters</a>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Available Tech Jobs ({{ $jobs->total() }})</h2>
                @auth
                    @if(auth()->user()->isEmployer())
                        <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Post Job
                        </a>
                    @endif
                @endauth
            </div>
            
            @if($jobs->count() > 0)
                @foreach($jobs as $job)
                    <div class="card job-card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h5 class="card-title">
                                        <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none">
                                            {{ $job->title }}
                                        </a>
                                    </h5>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <i class="fas fa-building"></i> {{ $job->employer->name }}
                                    </h6>
                                    <p class="card-text">{{ Str::limit($job->description, 150) }}</p>
                                    <div class="mb-2">
                                        @foreach($job->tech_stack as $tech)
                                            <span class="tech-badge">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> {{ $job->location }} | 
                                        <i class="fas fa-briefcase"></i> {{ ucfirst(str_replace('_', ' ', $job->job_type)) }} | 
                                        <i class="fas fa-chart-line"></i> {{ ucfirst($job->experience_level) }} Level
                                        @if($job->salary_range)
                                            | <i class="fas fa-dollar-sign"></i> {{ $job->salary_range }}
                                        @endif
                                    </small>
                                </div>
                                <div class="col-lg-4 text-end">
                                    <p class="text-muted mb-2">{{ $job->created_at->diffForHumans() }}</p>
                                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="d-flex justify-content-center">
                    {{ $jobs->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4>No jobs found</h4>
                    <p class="text-muted">Try adjusting your search criteria or check back later for new opportunities.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
