@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-3 sidebar p-3">
            <h5><i class="fas fa-user"></i> Job Seeker Dashboard</h5>
            <hr>
            <nav class="nav flex-column">
                <a class="nav-link active" href="#"><i class="fas fa-chart-line"></i> Overview</a>
                <a class="nav-link" href="{{ route('jobs.index') }}"><i class="fas fa-search"></i> Browse Jobs</a>
                <a class="nav-link" href="{{ route('applications.index') }}"><i class="fas fa-file-alt"></i> My Applications</a>
                <a class="nav-link" href="#"><i class="fas fa-user-edit"></i> Edit Profile</a>
            </nav>
        </div>
        
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Welcome back, {{ auth()->user()->name }}!</h2>
                <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                    <i class="fas fa-search"></i> Browse Jobs
                </a>
            </div>
            
            <div class="row mb-4">
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['applications_sent'] }}</h4>
                                    <small>Applications Sent</small>
                                </div>
                                <i class="fas fa-paper-plane fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['pending_applications'] }}</h4>
                                    <small>Pending Applications</small>
                                </div>
                                <i class="fas fa-clock fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Recent Applications</h5>
                        </div>
                        <div class="card-body">
                            @if($recent_applications->count() > 0)
                                @foreach($recent_applications as $application)
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div>
                                            <h6 class="mb-0">{{ $application->jobPost->title }}</h6>
                                            <small class="text-muted">{{ $application->jobPost->employer->name }}</small>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-{{ $application->status === 'pending' ? 'warning' : ($application->status === 'accepted' ? 'success' : 'secondary') }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                            <div><small class="text-muted">{{ $application->created_at->diffForHumans() }}</small></div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="mt-3">
                                    <a href="{{ route('applications.index') }}" class="btn btn-sm btn-outline-primary">View All Applications</a>
                                </div>
                            @else
                                <p class="text-muted">You haven't applied to any jobs yet. <a href="{{ route('jobs.index') }}">Start browsing</a>!</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Recommended Jobs</h5>
                        </div>
                        <div class="card-body">
                            @foreach($recommended_jobs as $job)
                                <div class="border-bottom py-2">
                                    <h6 class="mb-1">
                                        <a href="{{ route('jobs.show', $job) }}" class="text-decoration-none">
                                            {{ $job->title }}
                                        </a>
                                    </h6>
                                    <div class="mb-1">
                                        @foreach(array_slice($job->tech_stack, 0, 3) as $tech)
                                            <span class="tech-badge">{{ $tech }}</span>
                                        @endforeach
                                        @if(count($job->tech_stack) > 3)
                                            <span class="tech-badge">+{{ count($job->tech_stack) - 3 }} more</span>
                                        @endif
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-building"></i> {{ $job->employer->name }} | 
                                        <i class="fas fa-map-marker-alt"></i> {{ $job->location }}
                                    </small>
                                </div>
                            @endforeach
                            <div class="mt-3">
                                <a href="{{ route('jobs.index') }}" class="btn btn-sm btn-outline-primary">View All Jobs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection