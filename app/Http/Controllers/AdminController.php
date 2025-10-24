<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Candidate;

class AdminController extends Controller
{
    public function dashboard() {
        $candidatesCount = Candidate::count();
        $newApplications = Candidate::where('status','new')->count();
        $usersCount = User::count();
        return view('admin.dashboard', compact('candidatesCount','newApplications','usersCount'));
    }

    public function candidates() {
        $candidates = Candidate::latest()->paginate(20);
        return view('admin.candidates.index', compact('candidates'));
    }

    public function users() {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function roles() {
        return view('admin.roles.index');
    }

    public function analytics() {
        return view('admin.analytics.index');
    }

    public function settings() {
        return view('admin.settings.index');
    }
}
