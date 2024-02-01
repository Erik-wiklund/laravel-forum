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
        $reports = Report::with('user', 'reply', 'thread', 'conversation', 'conversationMessages')->latest()->paginate(20);
        return view('admin.reports.index', ['reports' => $reports]);
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
        //dd($request->all());

        $request->validate([
            'reason' => 'required|string',
        ], [
            'reason.required' => 'Please choose a reason for reporting.',
        ]);


        $reason = $request->input('reason');
        $reportedReply = $request->input('reply_id');
        $reportedThread = $request->input('thread_id');
        $reportedConversationMessage = $request->input('replypm_id');
        $reportedConversation = $request->input('conversation_id');


        if ($reason === 'Other') {
            // If "Other" is selected, get the reason from the text input
            $reason = $request->input('otherReason');
        }

        // Determine whether it's a reply or thread report

        $report = new Report();
        $report->reporter = auth()->user()->id;

        $reportedThread = $request->input('thread_id');
        $report->reported_thread = empty($reportedThread) ? null : $reportedThread;

        $reportedPrivateConversation = $request->input('conversation_id');
        $report->reported_private_conversation = empty($reportedPrivateConversation) ? null : $reportedPrivateConversation;

        $report->reported_reply = $request->input('reply_id');

        // For reported_private_messages, as shown in the previous example
        $reportedPrivateMessages = $request->input('replypm_id');
        $report->reported_private_messages = empty($reportedPrivateMessages) ? null : $reportedPrivateMessages;

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
