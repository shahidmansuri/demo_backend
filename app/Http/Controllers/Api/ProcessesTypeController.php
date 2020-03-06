<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProcessType;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseHelper;

class ProcessesTypeController extends Controller
{
    /**
     * Create Process
     * Required Params: Type, Code, Description
     */
    public function create(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $rules = [
            'type'          => 'required',
            'code'          => 'required',
            'description'   => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ResponseHelper::error('error', $validator->errors());
        }
        $processType = new ProcessType;
        $processType->type = $request->type;
        $processType->code = $request->code;
        $processType->description = $request->description;
        $processType->i_by = $user->id;
        $processType->i_date = time();
        $processType->u_by = $user->id;
        $processType->u_date = time();
        if($id = $processType->save()){
            return ResponseHelper::success($id, 'Type Created');
        }
        else{
            return ResponseHelper::error('Not created');
        }
    }
    /**
     * Create Process
     * Required Params: Type, Code, Description
     */
    public function edit(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $rules = [
            'type'          => 'required',
            'code'          => 'required',
            'description'   => 'required',
            'id'            => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ResponseHelper::error('error', $validator->errors());
        }
        $processType = ProcessType::where('id', $request->id)->first();
        
        $processType->type = $request->type;
        $processType->code = $request->code;
        $processType->description = $request->description;
        $processType->i_by = $user->id;
        $processType->i_date = time();
        $processType->u_by = $user->id;
        $processType->u_date = time();
        if($processType->save()){
            return ResponseHelper::success([], 'Type Edited');
        }
        else{
            return ResponseHelper::error('Not created');
        }
    }

    /**
     * Delete Process
     * Required Params: Id
     */
    public function delete(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        $rules = [
            'id'          => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ResponseHelper::error('error', $validator->errors());
        }
        if(ProcessType::where('id', $request->id)->delete()){
            return ResponseHelper::success([], 'Deleted');
        }
        else{
            return ResponseHelper::success([], 'Not able to delete');
        }
    }

    /**
     * List
     * Order, filter
     */
    public function list(Request $request){
        
    }
}
