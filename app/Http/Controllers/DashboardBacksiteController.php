<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardBacksiteController extends Controller
{
    public function index()
    {
        $complaints = Complaint::latest()->paginate(10);
        return view('pages.backsite.dashboard', compact('complaints'));
    }

    public function createResponse($id)
    {   
        $complaint = Complaint::find($id);
        return view('pages.backsite.response.create', compact('complaint'));
    }

    public function storeResponse(Request $request, $id)
    {
        $request->validate([
            'response' => ['required', 'string'],
            'response_date' => ['required', 'date'],
        ]);

        $complaint = Complaint::find($id);
        $response = $complaint->response()->first();
        
        if ($response) {
            return back()->with('error', 'Response already available');
        }

        Response::create([
            'user_id' => auth()->user()->id,
            'complaint_id' => $complaint->id,
            'response' => $request->response,
            'response_date' => $request->response_date,
        ]);

        Complaint::where('id', $complaint->id)->update(['status' => 'completed']);

        return redirect()->route('backsite.dashboard')->with('success', 'Response created and Complaint status updated');
    }

    public function editResponse($id)
    {
        $complaint = Complaint::find($id);

        $response = Response::where('complaint_id', $complaint->id)->first();

        if (!$response) {
            return back()->with('error', 'No response yet');
        }

        return view('pages.backsite.response.edit', compact('response'));
    }

    public function updateResponse(Request $request, $id)
    {
        $request->validate([
            'response' => ['required', 'string'],
            'response_date' => ['required', 'date'],
        ]);

        $complaint = Complaint::find($id);
        
        $response = Response::find($complaint->id);
        $response->user_id = auth()->user()->id;
        $response->response = $request->response;
        $response->response_date = $request->response_date;
        $response->save();

        return redirect()->route('backsite.dashboard')->with('success', 'Response updated');
    }

    public function rejectStatus($id)
    {
        $complaint = Complaint::find($id);
        
        Complaint::where('id', $complaint->id)->update(['status' => 'rejected']);

        return redirect()->route('backsite.dashboard')->with('success', 'Status rejected');
    }

    public function unrejectStatus($id)
    {
        $complaint = Complaint::find($id);

        Complaint::where('id', $complaint->id)->update(['status' => 'pending']);

        return redirect()->route('backsite.dashboard')->with('success', 'Status unrejected');
    }
}
