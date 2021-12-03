<?php

namespace Modules\Appraisal\Http\Controllers;

use Modules\Appraisal\Entities\Appraisals;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


class AppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($row_num = null)
    {
        
        $row_num = request('row_num');
        if (!$row_num != null){
        $result = Appraisals::latest()->Paginate($row_num)->toJson(JSON_PRETTY_PRINT);
        } else {
            $result = Appraisals::latest()->Paginate(15)->toJson(JSON_PRETTY_PRINT);
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
            'startDate' => 'required',
            'endDate' => 'required',
            'ongoing' => 'required',
            'purpose' => 'required',
            
        ]);

        $contact = new appraisals([
            'startDate' => $request->get('startDate'),
            'endDate' => $request->get('endDate'),
            'ongoing' => $request->get('ongoing'),
            'purpose' => $request->get('purpose'),
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
        if (appraisals::where('id', $id)->exists()) {
            $student = appraisals::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
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
        $appraisal = appraisals::find($id);
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
            'startDate' => 'required',
            'startDate' => 'required',
            'ongoing' => 'required',
            'purpose' => 'required',
        ]);

        if (appraisals::where('id', $id)->exists()) {
            $result = appraisals::find($id);
            $result->startDate = is_null($request->startDate) ? $result->startDate : $request->startDate;
            $result->endDate = is_null($request->endDate) ? $result->endDate : $request->endDate;
            $result->ongoing = is_null($request->ongoing) ? $result->ongoing : $request->ongoing;
            $result->purpose = is_null($request->purpose) ? $result->purpose : $request->purpose;
            $result->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Appraisal not found"
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
        
        if(appraisals::where('id', $id)->exists()) {
            $student = appraisals::find($id);
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
