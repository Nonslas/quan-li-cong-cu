<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::with('permissions')->orderBy('order')->get();
        return view('menus.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create', [
            'permissions' => Permission::all()
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
        // ddd($request->all());
        $lastOrderMenu = Menu::select('order')->orderBy('order', 'DESC')->first();
        $order = is_null($lastOrderMenu) ? 0 : $lastOrderMenu->order + 1;
        // dd($order);

        $menu = new Menu;
        $menu->text = $request->text;
        $menu->url = $request->url;
        $menu->icon = $request->icon;
        $menu->status = true;
        $menu->order = $order;
        $menu->target = $request->target;
        $menu->save();

        if (!empty($request->permissions)) {
            $menu->permissions()->sync($request->permissions);
        }

        return redirect()->route('menus.index');
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
        $menu = Menu::with([
            'permissions',
            'submenus' => fn ($query) => $query->orderBy('order')
        ])->where('id', $id)->get()->first();

        $arrSelectedPID = $menu->permissions->map(fn ($permission) => $permission->id)->toArray();

        return view('menus.edit', [
            'menu' => $menu,
            'selected' => $arrSelectedPID,
            'permissions' => Permission::all()
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
        $menu = Menu::find($id);
        $menu->text = $request->text;
        $menu->url = $request->url;
        $menu->icon = $request->icon;
        $menu->target = $request->target;
        $menu->permissions()->sync($request->permissions);
        $menu->save();
        return redirect()->route('menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::destroy($id);
        // return redirect()->route('menus.index');
    }

    public function orderUp(int $id)
    {
        $menu = Menu::find($id);
        $targetMenu = Menu::where('order', '<', $menu->order)->orderBy('order', 'desc')->first();
        if ($menu->order > 0 && $targetMenu) {
            $targetOrder = $targetMenu->order;
            $targetMenu->order = $menu->order;
            $menu->order = $targetOrder;
            $targetMenu->save();
            $menu->save();
        }
        return redirect()->route('menus.index');
    }

    public function orderDown(int $id)  
    {
        $menu = Menu::find($id);
        $targetMenu = Menu::where('order', '>', $menu->order)->orderBy('order', 'asc')->first();
        if ($targetMenu) {
            $targetOrder = $targetMenu->order;
            $targetMenu->order = $menu->order;
            $menu->order = $targetOrder;
            $targetMenu->save();
            $menu->save();
        }
        return redirect()->route('menus.index');
    }

    public function toggle(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        dd(Menu::where('id', $id)->update(['status' => $status]));
    }
}
