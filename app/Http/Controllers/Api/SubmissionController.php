<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmissionStoreRequest;
use App\Models\Submission;

class SubmissionController extends Controller
{
    /**
     * Get All Submissions
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Submission::all();
    }

    /**
     * Store submissions
     *
     * @param \App\Http\Requests\SubmissionStoreRequest $request
     * @return \App\Models\Submission
     */
    public function store(SubmissionStoreRequest $request)
    {
        $submissions = collect($request->submissions);

        $leaderSubmission = Submission::create($submissions->firstWhere('isLeader', true));

        $leaderSubmission->submissions()->createMany($submissions->where('isLeader', false)->toArray());

        return $leaderSubmission->load(['submissions']);
    }
}
