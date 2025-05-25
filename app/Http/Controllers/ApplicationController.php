<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request, JobPost $job)
    {
        $request->validate([
            'cover_letter' => 'required|string',
        ]);

        // Check if user already applied
        $existingApplication = Application::where('job_post_id', $job->id)
            ->where('job_seeker_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this job.');
        }

        Application::create([
            'job_post_id' => $job->id,
            'job_seeker_id' => Auth::id(),
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    public function index()
    {
        $applications = Auth::user()->applications()->with('jobPost.employer')->paginate(10);
        return view('applications.index', compact('applications'));
    }
}