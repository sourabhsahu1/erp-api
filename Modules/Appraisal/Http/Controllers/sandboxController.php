<?php

namespace Modules\Appraisal\Http\Controllers;

use Modules\Appraisal\Entities\appraisals_datas;
use Modules\Hr\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $row_num = request('row_num');
        if ($row_num= ""){
        $result = appraisals_datas::latest()->Paginate($row_num)->toJson(JSON_PRETTY_PRINT);
        } else {
            $result = appraisals_datas::latest()->Paginate(15)->toJson(JSON_PRETTY_PRINT);
        }
        
        return response($result, 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
      
        // $appraisalStore = appraisals_datas::create($request->all());
        // return $appraisalStore;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */

    public function createAppraisal(Request $request, $file_id)
    {
       // $id = auth()->user()->file_id; 
        $appraisalStore = User::where('file_id', $file_id)->first();
        $appraisalStore = appraisals_datas::create($request->all());
        return $appraisalStore;
    }

        /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function storeAds(Request $request)
    {
        //
        request()->validate([
            'fullname' => 'required',
            'department' => 'required',
        ]);

        return appraisals_datas::create([
            'fullname' => request('fullname'),
            'department' => request('department'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        // $request->validate([
        //     'fullname' => 'required',
        //     'department' => 'required'
            
        // ]);
        // $product = new appraisals_datas;
        // $product->fullname = $request->fullname;
        // $product->department = $request->department;
        // $product->save();
        // return response()->json(['message' => 'Success made'], 200);

        return appraisals_datas::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $appraisalShow = appraisals_datas::find($id);
        return $appraisalShow;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('appraisal::edit');
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
        $updateAppraisal = appraisals_datas::find($id);
        
        $updateAppraisal->update($request->all());
        
        return $updateAppraisal;

       
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $destroyAppraisal = appraisals_datas::destroy($id);
        return $destroyAppraisal;
    }
}
