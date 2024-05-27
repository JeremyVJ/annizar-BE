<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::all();
        return view('owner.feedback.index', compact('feedback'));
    }

}
