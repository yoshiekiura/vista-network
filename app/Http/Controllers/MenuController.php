<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function menuIndex()
    {
        $menu = Menu::all();
        return view('admin.interface.menu.index', compact('menu')) ;
    }

    public function menuCreate()
    {
        return view('admin.interface.menu.create');
    }

    public function menuStore(Request $request)
    {
        $this->validate($request, [
            'menu_name' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        Menu::create([
            'menu_name' => $request->menu_name,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->back()->withMsg('Created Package Successfully');
    }

    public function menuDelete($id)
    {
        Menu::whereId($id)->delete();
        return redirect()->back()->withMsg('Deleted Successfully');
    }

    public function menuEdit($id)
    {
        $menu = Menu::find($id);
        return view('admin.interface.menu.edit', compact('menu'));
    }

    public function menuUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'menu_name' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        Menu::whereId($id)
            ->update([
                'menu_name' => $request->menu_name,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        return redirect('admin/menu')->withMsg('Updated Package Successfully');
    }
}
