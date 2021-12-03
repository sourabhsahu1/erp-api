<?php

namespace Modules\Appraisal\Http\Controllers;

use Modules\Appraisal\Entities\SupervisorsAppraisal;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Appraisal\Entities\employeeAppraisals;
use Illuminate\Support\Facades\Auth;

class SupervisorsAppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($row_num = null)
    {
        $supervise = employeeAppraisals::find('supervisors_fileno');
        $user_id = Auth::user()->file_id;
        $row_num = request('row_num');
        if ($row_num != null){
        $result = SupervisorsAppraisal::where($user_id, $supervise)->latest()->Paginate($row_num)->toJson(JSON_PRETTY_PRINT);
        } else {
            $result = SupervisorsAppraisal::latest()->Paginate(15)->toJson(JSON_PRETTY_PRINT);
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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, $fileno)
    {
        
        $request->validate([
            'fileno' => 'required',
            'agree'=> 'required',
            'performance' => 'required',
            'foresight_option' => 'required',
            'judgement_option' => 'required',
            'paper_option' => 'required',
            'oral_option' => 'required',
            'numerical' => 'required',
            'relations' => 'required',
            'public_option' => 'required',
            'acceptance' => 'required',
            'reliability' => 'required',
            'drive' => 'required',
            'application' => 'required',
            'management' => 'required',
            'output' => 'required',
            'work' => 'required',
            'punctuality' => 'required',
            'outstanding' => 'required',
            'verygood' => 'required',
            'generally' => 'required',
            'moderate' => 'required',
            'ineffective' => 'required',
            'comment' => 'required',
            'confirm' => 'required',
            'level' => 'required',
            'title' => 'required',
            'dated' => 'required',
    
            'needed' => 'required',
            'recommended'=> 'required',
            'job' => 'required',
            'joblevel' => 'required',
            'reasons'=> 'required',
            'fitting'=> 'required',
            'position'=> 'required',
            'comment_recommendation'=> 'required',
            'considered' => 'required',
            'reason' => 'required',
            'future' => 'required',
            'near' => 'required',
            'potential' => 'required',
            'exceptional' => 'required',
            'additional' => 'required',
            'served' => 'required',
            'agreed' => 'required',
            'grade' => 'required',
            'day' => 'required',
            'blockname' => 'required',
            'isConsiderable'=> 'required'
        ]);

        $contact = new SupervisorsAppraisal([
            'supervisors_fileno' => employeeAppraisals::find('supervisors_fileno'),
            'fileno' => $request->get('fileno'),
            'agree' => $request->get('agree'),
            'performance' => $request->get('performance'),
            'foresight_option' => $request->get('foresight_option'),
            'judgement_option' => $request->get('judgement_option'),
            'paper_option' => $request->get('paper_option'),
            'oral_option' => $request->get('oral_option'),
            'numerical' => $request->get('numerical'),
            'relations' => $request->get('relations'),
            'public_option' => $request->get('public_option'),
            'acceptance' => $request->get('acceptance'),
            'reliability' => $request->get('reliability'),
            'drive' => $request->get('drive'),
            'application' => $request->get('application'),
            'management' => $request->get('management'),
            'output' => $request->get('output'),
            'work' => $request->get('work'),
            'punctuality' => $request->get('punctuality'),
            'outstanding' => $request->get('outstanding'),
            'verygood' => $request->get('verygood'),
            'generally' => $request->get('generally'),
            'moderate' => $request->get('moderate'),
            'ineffective' => $request->get('ineffective'),
            'comment' => $request->get('comment'),
            'confirm' => $request->get('confirm'),
            'level' => $request->get('level'),
            'title' => $request->get('title'),
            'dated' => $request->get('dated'),
            'needed' => $request->get('needed'),
            'recommended' => $request->get('recommended'),
            'job' => $request->get('job'),
            'joblevel' => $request->get('joblevel'),
            'reasons' => $request->get('reasons'),
            'fitting' => $request->get('fitting'),
            'position' => $request->get('position'),
            'comment_recommendation' => $request->get('comment_recommendation'),
            'considered' => $request->get('considered'),
            'reason' => $request->get('reason'),
            'future' => $request->get('future'),
            'near' => $request->get('near'),
            'potential' => $request->get('potential'),
            'exceptional' => $request->get('exceptional'),
            'additional' => $request->get('additional'),
            'served' => $request->get('served'),
            'agreed' => $request->get('agreed'),
            'grade' => $request->get('grade'),
            'day' => $request->get('day'),
            'blockname' => $request->get('blockname'),
            'isConsiderable' => TRUE,
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
        if (SupervisorsAppraisal::where('id', $id)->exists()) {
            $student = SupervisorsAppraisal::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
          } else {
            return response()->json([
              "message" => "Employee not found"
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
        $appraisal = SupervisorsAppraisal::find($id);
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
            'fileno' => 'required',
            'agree' => 'required',
            'performance' => 'required',
            'foresight_option' => 'required',
            'judgement_option' => 'required',
            'paper_option' => 'required',
            'oral_option' => 'required',
            'numerical' => 'required',
            'relations' => 'required',
            'public_option'=> 'required',
            'acceptance'=> 'required',
            'reliability' => 'required',
            'drive'=> 'required',
            'application'=> 'required',
            'management' => 'required',
            'output' => 'required',
            'work'=> 'required',
            'punctuality' => 'required',
            'outstanding' => 'required',
            'verygood' => 'required',
            'generally' => 'required',
            'moderate' => 'required',
            'ineffective' => 'required',
            'comment' => 'required',
            'confirm' => 'required',
            'level' => 'required',
            'title' => 'required',
            'dated' => 'required',
    
            'needed' => 'required',
            'recommended' => 'required',
            'job' => 'required',
            'joblevel' => 'required',
            'reasons' => 'required',
            'fitting' => 'required',
            'position' => 'required',
            'comment_recommendation' => 'required',
            'considered' => 'required',
            'reason' => 'required',
            'future' => 'required',
            'near' => 'required',
            'potential' => 'required',
            'exceptional' => 'required',
            'additional' => 'required',
            'served' => 'required',
            'agreed' => 'required',
            'grade' => 'required',
            'day' => 'required',
            'blockname' => 'required',
            'isConsiderable'=> 'required'
        ]);

        $fileno = request('fileno');
        if (SupervisorsAppraisal::where('id', $id)->exists()) {
            $result = SupervisorsAppraisal::find($id);
            $result ->supervisors_fileno = employeeAppraisals::find('supervisors_fileno');
            $result->fileno = $fileno;
            $result->agree = is_null($request->agree) ? $result->agree : $request->agree;
            $result->performance = is_null($request->performance) ? $result->performance : $request->performance;
            $result->foresight_option = is_null($request->foresight_option) ? $result->foresight_option : $request->foresight_option;
            $result->judgement_option = is_null($request->judgement_option) ? $result->judgement_option : $request->judgement_option;
            $result->paper_option = is_null($request->paper_option) ? $result->paper_option : $request->paper_option;
            $result->oral_option = is_null($request->oral_option) ? $result->oral_option : $request->oral_option;
            $result->numerical = is_null($request->numerical) ? $result->numerical : $request->numerical;
            $result->relations = is_null($request->relations) ? $result->relations : $request->relations;
            $result->public_option = is_null($request->public_option) ? $result->public_option : $request->public_option;
            $result->acceptance = is_null($request->acceptance) ? $result->acceptance : $request->acceptance;
            $result->reliability = is_null($request->reliability) ? $result->reliability : $request->reliability;
            $result->drive = is_null($request->drive) ? $result->drive : $request->drive;
            $result->application = is_null($request->application) ? $result->application : $request->application;
            $result->management = is_null($request->management) ? $result->management : $request->management;
            $result->output = is_null($request->output) ? $result->output : $request->output;
            $result->work = is_null($request->work) ? $result->work : $request->work;
            $result->punctuality = is_null($request->punctuality) ? $result->punctuality : $request->punctuality;
            $result->outstanding = is_null($request->outstanding) ? $result->outstanding : $request->outstanding;
            $result->verygood = is_null($request->verygood) ? $result->verygood : $request->verygood;
            $result->generally = is_null($request->generally) ? $result->generally : $request->generally;
            $result->moderate = is_null($request->moderate) ? $result->moderate : $request->moderate;
            $result->ineffective = is_null($request->ineffective) ? $result->ineffective : $request->ineffective;
            $result->comment = is_null($request->comment) ? $result->comment : $request->comment;
            $result->confirm = is_null($request->confirm) ? $result->confirm : $request->confirm;
            $result->level = is_null($request->level) ? $result->level : $request->level;
            $result->title = is_null($request->title) ? $result->title : $request->title;
            $result->dated = is_null($request->dated) ? $result->dated : $request->dated;

            $result->needed = is_null($request->needed) ? $result->needed : $request->needed;
            $result->recomended = is_null($request->recomended) ? $result->recomended : $request->recommended;
            $result->job = is_null($request->job) ? $result->job : $request->job;
            $result->joblevel = is_null($request->joblevel) ? $result->joblevel : $request->joblevel;
            $result->reasons = is_null($request->reasons) ? $result->reasons : $request->reasons;
            $result->fitting = is_null($request->fitting) ? $result->fitting : $request->fitting;
            $result->position = is_null($request->position) ? $result->position : $request->position;
            $result->comment_recommendation = is_null($request->comment_recommendation) ? $result->comment_recomendation : $request->comment_recomendation;
            $result->considered = is_null($request->considered) ? $result->considered : $request->considered;
            $result->reason = is_null($request->reason) ? $result->reason : $request->reason;
            $result->future = is_null($request->future) ? $result->future : $request->future;
            $result->near = is_null($request->near) ? $result->near : $request->near;
            $result->potential = is_null($request->potential) ? $result->potential : $request->potential;
            $result->exceptional = is_null($request->exceptional) ? $result->exceptional : $request->exceptional;
            $result->additional = is_null($request->additional) ? $result->additional : $request->additional;
            $result->served = is_null($request->served) ? $result->served : $request->served;
            $result->agreed = is_null($request->agreed) ? $result->agreed : $request->agreed;
            $result->grade = is_null($request->grade) ? $result->grade : $request->grade;
            $result->day = is_null($request->day) ? $result->day : $request->day;
            $result->blockname = is_null($request->blockname) ? $result->blockname : $request->blockname;
            $result->isCompleted = TRUE;
            $result->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Employee not found"
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
        
        if(SupervisorsAppraisal::where('id', $id)->exists()) {
            $student = SupervisorsAppraisal::find($id);
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
