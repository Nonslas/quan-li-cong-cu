<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Equipment;
use App\Models\EquipmentDepartment;
use Illuminate\Http\Request;

class DepartmentEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $department = Department::find($id);

        return view('departments.equipment', [
            'department' => $department
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $id)
    {
        $department = Department::find($id);
        $equipments = Equipment::all();

        return view('departments.equipment.create', [
            'equipments' => $equipments,
            'department' => $department
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $id)
    {
        $input = $request->all();
        $input['department_id'] = $id;

        $record = new EquipmentDepartment;
        $record->fill($input);
        $record->save();

        return redirect()->route('departments.equipment.index', ['department' => $id]);
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
    public function edit(int $departmentId, int $equipmentId)
    {
        $department = Department::find($departmentId);
        $equipmentDepartment = EquipmentDepartment::find($equipmentId);
        $equipments = Equipment::all();

        return view('departments.equipment.edit', [
            'department' => $department,
            'equipments' => $equipments,
            'equipmentDepartment' => $equipmentDepartment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $departmentId, $equipmentDepartmentId)
    {
        $input = $request->all();

        $equipmentDepartment = EquipmentDepartment::find($equipmentDepartmentId);
        $equipmentDepartment->fill($input);
        $equipmentDepartment->save();

        return redirect()->route('departments.equipment.index', [
            'department' => $departmentId
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $departmentId, $equipmentDepartmentId)
    {
        EquipmentDepartment::destroy($equipmentDepartmentId);
        
        return redirect()->route('departments.equipment.index', [
            'department' => $departmentId
        ]);
    }
}
