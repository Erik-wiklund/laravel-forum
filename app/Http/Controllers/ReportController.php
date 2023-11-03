<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        


        $reason = $request->input('reason');
        $reportedReply = $request->input('reply_id');
        $reportedThread = $request->input('thread_id');


        if ($reason === 'Other') {
            // If "Other" is selected, get the reason from the text input
            $reason = $request->input('otherReason');
        }

        // Determine whether it's a reply or thread report

        // Reporting a thread start message
        $report = new Report();
        $report->reporter = auth()->user()->id;
        $report->reported_reply = $reportedReply;
        $report->reported_thread = $reportedThread;
        $report->reason = $reason;
        $report->save();


        return redirect()->back()->with('success', 'Report submitted successfully');
    }








    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
