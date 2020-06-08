<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Status;
use App\Patient;
use Illuminate\Support\Facades\Auth;
use Validator;
class PatientController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api')->except('register','login','logout');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::leftJoin('users', 'patients.user_id', '=', 'users.id')
        ->leftJoin('statuses', 'patients.status_id', '=', 'statuses.id')
        ->select('patients.*','users.name as doctor', 'statuses.status')
        ->get();
        return $patient;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
			'user_id' => 'required',
			'p_name' => 'required',
			'p_cnic' => 'required', 
			'p_mobile_no' => 'required', 
			'p_address' => 'required',
			'status_id' => 'required'
		]); 
		if ($validator->fails()) { 

			return response()->json([
			'success' => false,
			'errors' => $validator->errors()
		
		]); 

		}

		$input = $request->all(); 
        $pat = Patient::create($input); 
		$patient = Patient::where('patients.id', $pat->id)->leftJoin('users', 'patients.user_id', '=', 'users.id')
        ->leftJoin('statuses', 'patients.status_id', '=', 'statuses.id')
        ->select('patients.*','users.name as doctor', 'statuses.status')
        ->get();
		return response()->json([
			'success' => true,
			'data' => $patient
		],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::where('patients.id', $id)->leftJoin('users', 'patients.user_id', '=', 'users.id')
        ->leftJoin('statuses', 'patients.status_id', '=', 'statuses.id')
        ->select('patients.*','users.name as doctor', 'statuses.status')
        ->get();
		return response()->json([
			'success' => true,
			'data' => $patient
		],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->all(), [ 
			'user_id' => 'required',
			'p_name' => 'required',
			'p_cnic' => 'required', 
			'p_mobile_no' => 'required', 
			'p_address' => 'required',
			'status_id' => 'required'
		]); 
		if ($validator->fails()) { 

			return response()->json([
			'success' => false,
			'errors' => $validator->errors()
		
		]); 

		}

		$input = $request->all(); 
        $pat = Patient::where('id', $id)->update($input); 
		$patient = Patient::where('patients.id', $id)->leftJoin('users', 'patients.user_id', '=', 'users.id')
        ->leftJoin('statuses', 'patients.status_id', '=', 'statuses.id')
        ->select('patients.*','users.name as doctor', 'statuses.status')
        ->get();
		return response()->json([
			'success' => true,
			'data' => $patient
		],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Patient::find($id)->delete()) 
                ? [ 'response_status' => true, 'message' => 'Patient has been deleted' ] 
                : [ 'response_status' => false, 'message' => 'Patient cannot delete' ];
    }
}
