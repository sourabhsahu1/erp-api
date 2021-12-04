<?php

namespace Modules\Appraisal\Http\Controllers;
use Modules\Appraisal\Entities\ConfirmAppraisal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Appraisal\Entities\supervisorsAppraisal;

class ConfirmAppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($row_num =null)
    {
        $supervise = supervisorsAppraisal::find('supervisors_fileno');
        $user_id = Auth::user()->file_id;
        $row_num = request('row_num');
        if ($row_num != null){
        $result = ConfirmAppraisal::where($user_id, $supervise)->latest()->Paginate($row_num)->toJson(JSON_PRETTY_PRINT);
        } else {
            $result = ConfirmAppraisal::latest()->Paginate(15)->toJson(JSON_PRETTY_PRINT);
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
    public function store(Request $request, $fileno)
    {
        
        $request->validate([
            'reportconfirmation'=> 'required',
            'agreement'=> 'required',
            'grading'=> 'required',
            'serve'=> 'required',
            'blockfullname' => 'required',
            'fileno' => 'required',
            
        ]);

        $fileno = request('fileno');

        $contact = new ConfirmAppraisal([
            'fileno' => $fileno,
            'supervisors_fileno' => supervisorsAppraisal::find('supervisors_fileno'),
            'reportconfirmation' => $request->get('reportconfirmation'),
            'agreement' => $request->get('agreement'),
            'grading' => $request->get('grading'),
            'serve' => $request->get('serve'),
            'blockfullname' => $request->get('blockfullname'),
            'isAwardable' => TRUE,
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
        if (ConfirmAppraisal::where('id', $id)->exists()) {
            $student = ConfirmAppraisal::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
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
        $appraisal = ConfirmAppraisal::find($id);
        return view('appraisal.edit', compact('appraisal'));   
        
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id, $fileno)
    {
        //
        $request->validate([
            'reportconfirmation'=> 'required',
            'agreement'=> 'required',
            'grading'=> 'required',
            'serve'=> 'required',
            'blockfullname' => 'required',
            'fileno' => 'required',
        ]);

        $fileno = request('fileno');

        if (ConfirmAppraisal::where('id', $id)->exists()) {
            $result = ConfirmAppraisal::find($id);
            $result ->supervisors_fileno = supervisorsAppraisal::find('supervisors_fileno');
            $result->fileno = $fileno;
            $result->reportconfirmation = is_null($request->reportconfirmation) ? $result->reportconfirmation : $request->reportconfirmation;
            $result->agreement = is_null($request->agreement) ? $result->agreement : $request->agreement;
            $result->grading = is_null($request->grading) ? $result->grading : $request->grading;
            $result->isAwardable = TRUE;
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
    public function delete($id)
    {
        //
        
        if(ConfirmAppraisal::where('id', $id)->exists()) {
            $student = ConfirmAppraisal::find($id);
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
