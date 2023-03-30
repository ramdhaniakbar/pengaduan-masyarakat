<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Response;
use App\Models\Complaint;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardBacksiteController extends Controller
{
    public function index()
    {
        $complaints = Complaint::latest()->paginate(10);
        $complaint_pending = Complaint::where('status', 'pending')->count();
        $complaint_completed = Complaint::where('status', 'completed')->count();

        $complaints_status = [
            'complaint_pending' => $complaint_pending,
            'complaint_completed' => $complaint_completed
        ];

        return view('pages.backsite.dashboard', compact('complaints', 'complaints_status'));
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

    public function createUser()
    {
        return view('pages.backsite.user.create');
    }

    public function storeUser(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'role_id' => $request->role,
            'name' => $fields['name'],
            'username' => $fields['username'],
            'password' => bcrypt($fields['password']),
        ]);

        $user->remember_token = $user->createToken('auth_token')->plainTextToken;
        $user->save();

        return redirect()->route('backsite.dashboard')->with('success', 'User created');
    }

    public function statusPending()
    {
        $complaints = Complaint::where('status', 'pending')->latest()->paginate(10);
        return view('pages.backsite.response.pending.index', compact('complaints'));
    }

    public function statusCompleted()
    {
        $complaints = Complaint::where('status', 'completed')->latest()->paginate(10);
        return view('pages.backsite.response.completed.index', compact('complaints'));
    }

    public function generatePDF(Request $request)
    {
        if ($request['tanggal_1'] || $request['tanggal_2']) {
            $complaints = Complaint::whereBetween('created_at', [$request['tanggal_1'], $request['tanggal_2']])->with('response')->latest()->get();

            $employee = auth()->user()->name;

            $data = [
                'title' => 'Generate Laporan',
                'employee' => $employee,
                'complaints' => $complaints
            ];

            $pdf = Pdf::loadView('pages.backsite.pdf.generate-pdf', $data);
            return $pdf->download(Str::random(20) . '.pdf');

        } else {
            $employee = auth()->user()->name;
            $complaints = Complaint::with('response')->latest()->get();
    
            $data = [
                'title' => 'Generate Laporan',
                'employee' => $employee,
                'complaints' => $complaints
            ];
    
            $pdf = Pdf::loadView('pages.backsite.pdf.generate-pdf', $data);
            return $pdf->download(Str::random(20) . '.pdf');
        }
    }
}
