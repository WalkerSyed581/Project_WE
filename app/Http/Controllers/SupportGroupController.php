<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\SupportGroup;
use App\SupportGroupConductor;
class SupportGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$supportGroups = SupportGroup::where('support_group_conductor_id',\Auth::user()->supportGroupConductor->id)->get();
		return view('sgc.index',[
			'supportGroups' => $supportGroups,
		]);
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
        $rules = [
			'name' => ['string','required'],
			'appointmentTime' => ['date_format:H:i','required'],
			'description' => ['string','nullable'],
			'fee' => ['string','integer','required'],
		];
		
		$this->validate($request,$rules);
		$start_time = explode(':',$request->input('appointmentTime'));
		$fomratted_start_time = Carbon::now();
		$fomratted_start_time->hour = (int) $start_time[0];
		$fomratted_start_time->minute = (int) $start_time[1];
		$fomratted_start_time->second = 0;

		$supportGroup = SupportGroup::create([
			'name' => $request->input('name'),
			'timing' => $fomratted_start_time->toTimeString(),
			'fee' => $request->input('fee'),
			'description' => $request->input('description'),
			'support_group_conductor_id' => (int) $request->input('conductor_id'),
			'day' => $request->input('day'),
		]);
		

		return redirect()->action('AdminController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$supportGroup = SupportGroup::find($id);
		$supportGroupConductors = SupportGroupConductor::all();
		$days = [
			'Sunday',
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday',
		];
		return view('admin.addSupportGroup',[
			'supportGroups' => $supportGroups,
			'supportGroupConductors' => $supportGroupConductors,
			'days' => $days,
		]);
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
        $rules = [
			'name' => ['string','required'],
			'appointmentTime' => ['date_format:H:i:s','required'],
			'description' => ['string','nullable'],
			'fee' => ['string','integer','required'],
		];
		
		$this->validate($request,$rules);
		$start_time = explode(':',$request->input('appointmentTime'));
		$fomratted_start_time = Carbon::now();
		$fomratted_start_time->hour = (int) $start_time[0];
		$fomratted_start_time->minute = (int) $start_time[1];
		$fomratted_start_time->second = (int) $start_time[2];

		$supportGroup = SupportGroup::find($id);
		$supportGroup->name = $request->input('name');
		$supportGroup->timing = $fomratted_start_time->toTimeString();
		$supportGroup->fee = $request->input('fee');
		$supportGroup->description = $request->input('description');
		$supportGroup->support_group_conductor_id = (int) $request->input('conductor_id');
		$supportGroup->day = $request->input('day');
		$supportGroup->save();

		return redirect()->action('AdminController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		SupportGroup::find($id)->delete();
		
		return redirect()->action('AdminController@showSupportGroups',['id',\Auth::user()->id]);
	}
	
	public function addUser($user_id){

	}

	public function members($id,$supportGroup_id){
		$supportGroup = SupportGroup::find($supportGroup_id);
		$patients = $supportGroup->patients;
		return view('sgc.members',[
			'patients' => $patients,
			'supportGroup' =>$supportGroup,
		]);
	}
}
