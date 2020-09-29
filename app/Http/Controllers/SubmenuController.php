<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $parentId)
    {
        return view('submenus.create', ['parentId' => $parentId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $parentId)
    {
        $input = $request->all();
        $menu = Menu::with('submenus')->findOrFail($parentId);
        $order = ($menu->submenus->max('order') ?? -1) + 1  ;
        $submenu = new Submenu;
        $submenu->fill($input);
        $submenu->order = $order;
        $submenu->status = true;
        $menu->submenus()->save($submenu);
        return redirect()->route('menus.edit', $parentId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $parentId, int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $parentId, int $id)
    {
        return view('submenus.edit', [
            'parentId' => $parentId,
            'submenu' => Submenu::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $parentId, int $id)
    {
        $submenu = Submenu::findOrFail($id);
        $submenu->fill($request->all());
        $submenu->save();
        return redirect()->route('menus.edit', $parentId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $parentId, int $id)
    {
        dd(Submenu::destroy($id));
    }

    public function orderUp(int $parentId, int $id)
    {
        $submenu = Submenu::find($id);
        $targetMenu = Submenu::where('order', '<', $submenu->order)->orderBy('order', 'desc')->first();
        if ($submenu->order > 0 && $targetMenu) {
            $targetOrder = $targetMenu->order;
            $targetMenu->order = $submenu->order;
            $submenu->order = $targetOrder;
            $targetMenu->save();
            $submenu->save();
        }
        return redirect()->route('menus.edit', $parentId);
    }

    public function orderDown(int $parentId, int $id)
    {
        $submenu = Submenu::find($id);
        $targetMenu = Submenu::where('order', '>', $submenu->order)->orderBy('order', 'asc')->first();
        if ($targetMenu) {
            $targetOrder = $targetMenu->order;
            $targetMenu->order = $submenu->order;
            $submenu->order = $targetOrder;
            $targetMenu->save();
            $submenu->save();
        }
        return redirect()->route('menus.edit', $parentId);
    }

    public function toggle(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        dd(Submenu::where('id', $id)->update(['status' => $status]));
    }
}
