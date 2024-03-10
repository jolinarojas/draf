<?php

namespace App\Http\Controllers;

use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familyMembers = FamilyMember::all();
        return view('family_members.index', compact('familyMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('family_members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Add validation rules here as needed
        ]);

        $family_member = new FamilyMember;
        $family_member->household_id = $request->household_id;
        $family_member->name = $request->name;
        $family_member->age = $request->age;
        $family_member->sex = $request->sex;
        $family_member->occupation = $request->occupation;
        $family_member->POF = $request->POF;
        $family_member->status = $request->status;
        $family_member->remarks = $request->remarks;
        $family_member->save();

        return redirect('family-members/'. $request->household_id);
        
        // 
            // ->with('success', 'Family member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($household_id)
    {
        $family_members = FamilyMember::where('household_id', $household_id)->get();
        // dd($family_members->toArray());
        return view('family_members.show', compact('family_members', 'household_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(FamilyMember $familyMember, Request $request)
    {

        if ($request->ajax()) {
            return response()->json($familyMember);
        } else {
            return view('family_members.edit', compact('familyMember'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamilyMember $familyMember)
    {
        $request->validate([
            // Add validation rules here as needed
        ]);


        $familyMember->update($request->all());
        
        return redirect('family-members/'. $request->household_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyMember $familyMember, Request $request)
    {

        $familyMember->delete();
        
        return json_encode(['success'=> 'Family member deleted successfully.']);
    }
}
