<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\MenusRecusive;
use App\Models\Menu;

class MenuController extends Controller
{
    private $menusRecusive;
    private $menu;
    
    public function __construct(MenusRecusive $menusRecusive,Menu $menu) {
        $this->menusRecusive = $menusRecusive;
        $this->menu = $menu;

    }

    public function index()
    {
        $menus = $this->menu->latest()->paginate(10);
        return view('admin.menus.index',[
            'menus' => $menus
        ]);
    }

    public function create()
    {
        $htmlOption = $this->menusRecusive->menuRecusiveAdd();
    
        return view('admin.menus.add', [
            'htmlOption' => $htmlOption
        ]);
    }

    public function store(Request $request){

        $this->menu->create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'slug' => str_slug($request->input('name'))
        ]);

        return redirect()->route('admin.menus.index');
    }

    public function edit($id){
        $menu = $this->menu->find($id);
        $htmlOption = $this->menusRecusive->menuRecusiveAdd();
        


        return view('admin.menus.edit',[
            'menu' => $menu,
            'htmlOption' => $htmlOption
        ]);
    }

    public function update($id,Request $request){
        $menu = $this->menu->find($id);
    
        $menu->update([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'slug' => str_slug($request->input('name'))
        ]);

        return redirect()->route('admin.menus.index');
    }

    //xóa mềm
    public function delete($id){
        $category = $this->menu->find($id);
        $category->delete();


        return redirect()->route('admin.menus.index');
    }
}
