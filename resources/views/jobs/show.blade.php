@extends('layouts.app')

@section('title', $job->title)

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h3 class="mb-1">{{ $job->title }}</h3>
                            <h5 class="text-muted mb-0">
                                <i class="fas fa-building"></i> {{ $job->employer->name }}
                            </h5>
                        </div>
                        @auth
                            @if(auth()->user()->isEmployer() && auth()->user()->id === $job->employer_id)
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('jobs.edit', $job) }}">Edit Job</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this job?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger" type="submit">Delete Job</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><i class="fas fa-map-marker-alt text-primary"></i> <strong>Location:</strong> {{ $job->location }}</p>
                            <p><i class="fas fa-briefcase text-primary"></i> <strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-chart-line text-primary"></i> <strong>Experience:</strong> {{ ucfirst($job->experience_level) }} Level</p>
                            @if($job->salary_range)
                                <p><i class="fas fa-dollar-sign text-primary"></i> <strong>Salary:</strong> {{ $job->salary_range }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Technology Stack</h5>
                        <div>
                            @foreach($job->tech_stack as $tech)
                                <span class="tech-badge">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Job Description</h5>
                        <div>{!! nl2br(e($job->description)) !!}</div>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Requirements</h5>
                        <div>{!! nl2br(e($job->requirements)) !!}</div>
                    </div>
                    
                    <small class="text-muted">Posted {{ $job->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            @auth
                @if(auth()->user()->isJobSeeker())
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-paper-plane"></i> Apply for This Job</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $hasApplied = auth()->user()->applications()->where('job_post_id', $job->id)->exists();
                            @endphp
                            
                            @if($hasApplied)
                                <div class="alert alert-info">
                                    <i class="fas fa-check-circle"></i> You have already applied for this job.
                                </div>
                            @else
                                <form action="{{ route('applications.store', $job) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="cover_letter" class="form-label">Cover Letter</label>
                                        <textarea class="form-control @error('cover_letter') is-invalid @enderror" 
                                                  id="cover_letter" name="cover_letter" rows="6" 
                                                  placeholder="Tell the employer why you're interested in this position...">{{ old('cover_letter') }}</textarea>
                                        @error('cover_letter')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-paper-plane"></i> Submit Application
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Interested in this job?</h5>
                        <p class="text-muted">Create an account to apply for this position.</p>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register Now</a>
                        <p class="mt-2"><small>Already have an account? <a href="{{ route('login') }}">Login here</a></small></p>
                    </div>
                </div>
            @endauth
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5><i class="fas fa-building"></i> About the Company</h5>
                </div>
                <div class="card-body">
                    <h6>{{ $job->employer->name }}</h6>
                    @if($job->employer->location)
                        <p><i class="fas fa-map-marker-alt"></i> {{ $job->employer->location }}</p>
                    @endif
                    @if($job->employer->email)
                        <p><i class="fas fa-envelope"></i> {{ $job->employer->email }}</p>
                    @endif
                    @if($job->employer->phone)
                        <p><i class="fas fa-phone"></i> {{ $job->employer->phone }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection