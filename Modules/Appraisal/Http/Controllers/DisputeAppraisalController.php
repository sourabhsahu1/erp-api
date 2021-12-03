<?php

namespace Modules\Appraisal\Http\Controllers;

use Modules\Appraisal\Entities\DisputeAppraisal;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DisputeAppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($row_num = null)
    {
        $users_id = Auth::user()->file_id;

        $row_num = request('row_num');
        if ($row_num= ""){
        $result = DisputeAppraisal::where('fileno', $users_id)->latest()->Paginate($row_num)->toJson(JSON_PRETTY_PRINT);
        } else {
            $result = DisputeAppraisal::where('fileno', $users_id)->latest()->Paginate(15)->toJson(JSON_PRETTY_PRINT);
        }
        
        return response($result, 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        return view('appraisal::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'fileno'=> 'required',
            'emailaddress'=> 'required',
            'dispute' => 'required',
            'isDisputable' => 'required',
        ]);

        $contact = new DisputeAppraisal([
            'fileno' => $request->get('fileno'),
            'emailaddress' => $request->get('emailaddress'),
            'dispute' => $request->get('dispute'),
            'isDisputable' => TRUE,
        ]);
        $contact->save();
        return response()->json([
            "message" => "Dispute submitted"
        ], 200);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        if (DisputeAppraisal::where('id', $id)->exists()) {
            $student = DisputeAppraisal::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $appraisal = DisputeAppraisal::find($id);
        return view('appraisal.edit', compact('appraisal'));   
        
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'fileno'=> 'required',
            'emailaddress'=> 'required',
            'dispute' => 'required',
            'isDisputable' => 'required',
        ]);

        if (DisputeAppraisal::where('id', $id)->exists()) {
            $result = DisputeAppraisal::find($id);
            $result->fileno = is_null($request->fileno) ? $result->fileno : $request->fileno;
            $result->emailaddress = is_null($request->emailaddress) ? $result->emailaddress : $request->emailaddress;
            $result->dispute = is_null($request->dispute) ? $result->dispute : $request->dispute;
            $result->isDisputable = TRUE;
            $result->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        
        if(DisputeAppraisal::where('id', $id)->exists()) {
            $student = DisputeAppraisal::find($id);
            $student->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
        
    }
}
