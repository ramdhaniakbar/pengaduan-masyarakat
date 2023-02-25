<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('is_masyarakat')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.complaint.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'content_report' => ['required', 'string'],
            'image' => ['image', 'max:1999', 'mimes:png,jpg'],
            'complaint_date' => ['required', 'date'],
        ]);


        // Handle file upload
        if ($request->hasFile('image')) {
            // get filename
            $filename = $request->file('image')->getFilename();
            // get extension
            $extension = $request->file('image')->extension();
            // concat filename and extension with time
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // store to storage
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore); 
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        Complaint::create([
            'user_id' => auth()->user()->id,
            'content_report' => $fields['content_report'],
            'image' => $fileNameToStore,
            'complaint_date' => $fields['complaint_date'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Complaint Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complaint = Complaint::find($id);
        
        $user_complaint = User::find($complaint->user_id);
        
        $response = $complaint->response()->first();

        $response ? $user_response = User::find($response->user_id) : $user_response = null;

        return view('pages.complaint.show', compact(['complaint', 'response', 'user_complaint', 'user_response']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complaint = Complaint::find($id);
        return view('pages.complaint.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content_report' => ['required', 'string'],
            'image' => ['image', 'max:1999', 'mimes:png,jpg'],
            'complaint_date' => ['required', 'date'],
        ]);

        $complaint = Complaint::find($id);
        $complaint->content_report = $request->input('content_report');
        $complaint->complaint_date = $request->input('complaint_date');

        // Handle file upload
        if ($request->hasFile('image')) {
            // get filename
            $filename = $request->file('image')->getFilename();
            // get extension
            $extension = $request->file('image')->extension();
            // concat filename and extension with time
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // store to storage
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore); 
            // store image
            $complaint->image = $fileNameToStore;
        } 

        // save the updated post
        $complaint->save();
        return redirect()->route('dashboard')->with('success', 'Complaint Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaint = Complaint::find($id);
        
        if ($complaint->image) {
            // Delete image
            Storage::delete('public/cover_images/'.$complaint->image);
        }

        $complaint->delete();
        return redirect()->route('dashboard')->with('error', 'Complaint Removed');
    }
}
