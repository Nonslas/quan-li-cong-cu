<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\Supplier;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipment::all();

        return view('equipments.index', ['equipments' => $equipments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipments.create', [
            'suppliers' => Supplier::all(),
            'departments' => Department::select(['id', 'name'])->get(),
            'employees' => Employee::select(['id', 'name', 'department_id'])->get(),
            'types' => EquipmentType::select(['id', 'name'])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $equipment = new Equipment;
        $equipment->fill($input);
        $equipment->save();
        return redirect()->route('equipments.index');
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
    public function edit(int $id)
    {
        return view('equipments.edit', [
            'equipment' => Equipment::find($id),
            'suppliers' => Supplier::all(),
            'departments' => Department::select(['id', 'name'])->get(),
            'employees' => Employee::select(['id', 'name', 'department_id'])->get(),
            'types' => EquipmentType::select(['id', 'name'])->get()
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
        $equipment = Equipment::findOrFail($id);
        $equipment->fill($request->all());
        $equipment->save();
        return redirect()->route('equipments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Equipment::destroy($id);
    }

    public function export()
    {
        $equipments = Equipment::all();

        $data = [
            ['QUẢN LÝ CÔNG CỤ DỤNG CỤ'],
            ['STT', 'Mã CCDC', 'Model/Series', 'Ngày mua', 'Loại CCDC', 'Số Lượng', 'Giá tiền', 'Người sử dụng', 'Phòng ban', 'Ngày bàn giao', 'Trạng thái', 'Thời hạn bảo hành', 'Nhà cung cấp', 'Tình trạng', 'Chi tiết'],
        ];

        $i = 0;

        foreach ($equipments as $equipment) {
            $data[] = [
                ++$i,
                $equipment->code, 
                $equipment->name, 
                $equipment->buy_at, 
                $equipment->types->name,
                $equipment->amount, 
                $equipment->price, 
                $equipment->employee->name, 
                $equipment->department->name,
                $equipment->assign_at,
                '',
                $equipment->guarantee, 
                $equipment->supplier->name, 
                $equipment->status, 
                $equipment->detail
            ];
        }
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($data);

        $style = [
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ];

        $sheet->getStyle('A1:O2')->applyFromArray($style);
        $sheet->mergeCells('A1:O1');

        for ($i = 66; $i < 80; $i++) {
            $sheet->getColumnDimension(chr($i))->setWidth(20);
        }

        $saveTo = date('YmdHis') . '.xlsx';

        $writer = new Xlsx($spreadsheet);
        $writer->save($saveTo);

        return redirect()->intended($saveTo);
    }
}
