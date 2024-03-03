<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Household;
use Datatables;

class HouseholdController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Household::select('*'))
            ->addColumn('action', 'household-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('index');
    }

    public function store(Request $request)
    {  
        $householdId = $request->id;

        $household = Household::updateOrCreate(
            [
                'id' => $householdId
            ],
            [
                'fhname' => $request->fhname, 
                'serial_no' => $request->serial_no,
                'address' => $request->address,
                'NOFHH' => $request->NOFHH,
                'NOLHH' => $request->NOLHH,
                'insurance' => $request->insurance,
                'TFI' => $request->TFI,
                'wall_materials' => $request->wall_materials,
                'roof_materials' => $request->roof_materials,
                'house_and_lot' => $request->house_and_lot,
                'disaster_prone' => $request->disaster_prone,
                'date_interviewed' => $request->date_interviewed
            ]
        );
        
        return Response()->json($household);
    }

    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $household = Household::where($where)->first();
       
        return Response()->json($household);
    }

    public function destroy(Request $request)
    {
        $household = Household::where('id',$request->id)->delete();
       
        return Response()->json($household);
    }
}
