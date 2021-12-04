<?php

namespace Modules\Appraisal\Http\Controllers;

use Modules\Appraisal\Entities\EmployeeAppraisals;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeAppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($row_num =null)
    {
        $users_id = Auth::user()->file_id;

        $row_num = request('row_num');
        if ($row_num= ""){
        $result = employeeAppraisals::where('fileno', $users_id)->latest()->Paginate($row_num)->toJson(JSON_PRETTY_PRINT);
        } else {
            $result = employeeAppraisals::where('fileno', $users_id)->latest()->Paginate(15)->toJson(JSON_PRETTY_PRINT);
        }
        
        return response($result, 200);
    }

    public function EmployeeAppraisal($row_num =null, $fileno = null)
    {
        
        $row_num = request('row_num');
        if ($row_num= ""){
        $result = employeeAppraisals::where('fileno', $fileno)->latest()->Paginate($row_num)->toJson(JSON_PRETTY_PRINT);
        } else {
            $result = employeeAppraisals::where('fileno', $fileno)->latest()->Paginate(15)->toJson(JSON_PRETTY_PRINT);
        }
        
        return response($result, 200);
    }
       
         /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function supervisorAssignment(Request $request)
    {
        
        $request->validate([
            'supervisors_fileno'=> 'required',
            
        ]);

        $contact = new employeeAppraisals([
            'supervisors_fileno' => $request->get('supervisors_fileno'),
        
        ]);
        $contact->save();
        return response()->json([
            "message" => "Supervisor Assigned"
        ], 200);

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
            'fileno' => 'required',
            'fullname'=> 'required',
            'dob'=> 'required',
            'department'=> 'required',
            'designation'=> 'required',
            'qualification'=> 'required',
            'doa'=> 'required',
            'rank'=> 'required',
            'rankdate'=> 'required',
            'actingappointment'=> 'required',
            'courseundertaken'=> 'required',
            'absentdays'=> 'required',
            'jobduties'=> 'required',
            'extraduties'=> 'required',
            'isCompleted'=> 'required',
        ]);

        $contact = new employeeAppraisals([
            'fileno' => Auth::user()->id,
            'dob' => $request->get('dob'),
            'department' => $request->get('department'),
            'designation' => $request->get('designation'),
            'qualification' => $request->get('qualification'),
            'doa' => $request->get('doa'),
            'rank' => $request->get('rank'),
            'rankdate' => $request->get('rankdate'),
            'actingappointment' => $request->get('actingappointment'),
            'courseundertaken' => $request->get('courseundertaken'),
            'absentdays' => $request->get('absentdays'),
            'jobduties' => $request->get('jobduties'),
            'extraduties' => $request->get('extraduties'),
            'isCompleted' => TRUE,
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
        if (employeeAppraisals::where('id', $id)->exists()) {
            $student = employeeAppraisals::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
          } else {
            return response()->json([
              "message" => "Emplloyee not found"
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
        $appraisal = employeeAppraisals::find($id);
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
            'fileno' => 'required',
            'fullname'=> 'required',
            'dob'=> 'required',
            'department'=> 'required',
            'designation'=> 'required',
            'qualification'=> 'required',
            'doa'=> 'required',
            'rank'=> 'required',
            'rankdate'=> 'required',
            'actingappointment'=> 'required',
            'courseundertaken'=> 'required',
            'absentdays'=> 'required',
            'jobduties'=> 'required',
            'extraduties'=> 'required',
            'isCompleted'=> 'required',
        ]);

        if (employeeAppraisals::where('id', $id)->exists()) {
            $result = employeeAppraisals::find($id);
            $result->fileno= is_null($request->fileno) ? $result->fileno : $request->fileno;
            $result->fullname = is_null($request->fullname) ? $result->fullname : $request->fullname;
            $result->dob = is_null($request->dob) ? $result->dob : $request->dob;
            $result->department = is_null($request->department) ? $result->department : $request->department;
            $result->designation = is_null($request->designation) ? $result->designation : $request->designation;
            $result->qualification = is_null($request->qualification) ? $result->qualification : $request->qualification;
            $result->doa = is_null($request->doa) ? $result->doa : $request->doa;
            $result->rank = is_null($request->rank) ? $result->rank : $request->rank;
            $result->rankdate = is_null($request->rankdate) ? $result->rankdate : $request->rankdate;
            $result->actingappointment = is_null($request->actingappointment) ? $result->actingappointment : $request->actingappointment;
            $result->courseundertaken = is_null($request->courseundertaken) ? $result->courseundertaken : $request->courseundertaken;
            $result->absentdays = is_null($request->absentdays) ? $result->absentdays : $request->absentdays;
            $result->jobduties = is_null($request->jobduties) ? $result->jobduties : $request->jobduties;
            $result->extraduties = is_null($request->extraduties) ? $result->extraduties : $request->extraduties;
            $result->isCompleted = TRUE;
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
        
        if(employeeAppraisals::where('id', $id)->exists()) {
            $student = employeeAppraisals::find($id);
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
