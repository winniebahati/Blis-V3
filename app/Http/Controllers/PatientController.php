<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use App\Models\Patient;
class PatientController extends Controller
{
     const ORG_ID="";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients=Patient::paginate(15);

        return Response::json($patients);
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
       
        //Obtain values from input fields
        $active=1;
        $name=$request->input('name');
        $telecom=$request->input('telecom');
        $gender=$request->input('gender');
        $birthDate=$request->input('birthDate');
        $deceased=0;
        $address=$request->input('address');
        $maritalStatus=$request->input('maritalStatus');
        $multipleBirth=$request->input('multipleBirth');
        $photo=$request->input('photo');
        $generalPractitioner=\Auth::id();
        $managingOrganization=ORG_ID;

        $patient=new Patient;
        $patient->name=$name;
        $patient->telecom=$telecom;
        $patient->birthDate=$birthDate;
        $patient->deceased=$deceased;
        $patient->address=$address;
        $patient->maritalStatus=$maritalStatus;
        $patient->multipleBirth=$multipleBirth;
        $patient->photo=$photo;
        $patient->generalPractitioner=$generalPractitioner;
        $patient->managingOrganization=ORG_ID;

        DB::transaction(function ($patient) {
            $patient->save();
        }, 5);

        return Response::json($patient);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient=Patient::find($id);

        return Response::json($patient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $active=$request->input('active');
        $name=$request->input('name');
        $telecom=$request->input('telecom');
        $gender=$request->input('gender');
        $birthDate=$request->input('birthDate');
        $deceased=$request->input('deceased');
        $address=$request->input('address');
        $maritalStatus=$request->input('maritalStatus');
        $multipleBirth=$request->input('multipleBirth');
        $photo=$request->input('photo');
        $generalPractitioner=\Auth::id();

        //Create update array
        $patient_details=array(
            'active'=>$active,
            'name'=>$name,
            'telecom'=>$telecom,
            'gender'=>$gender,
            'birthDate'=>$birthDate,
            'deceased'=>$deceased,
            'address'=>$address,
            'maritalStatus'=>$maritalStatus,
            'multipleBirth'=>$multipleBirth,
            'photo'=>$photo,
            'generalPractitioner'=>$generalPractitioner
        );

        $patient=Patient::find($id);

        DB::transaction(function ($patient) {
           $patient->update($array);
        }, 2);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
