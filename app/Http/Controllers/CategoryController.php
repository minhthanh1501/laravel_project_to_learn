<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recusive;

class CategoryController extends Controller
{

    private $category;

    public function __construct(Category $category){
        $this->category = $category;
    }

    public function index(){
        $data = $this->category->latest()->paginate(5);

        return view('admin.category.index',[
            'categories' => $data
        ]);
    }

    public function create($parentId = ''){
        $htmlOption = $this->getCategory($parentId);

        return view('admin.category.add',[
            'htmlOption' => $htmlOption
        ]);
    }

    public function store(Request $request){

        // $Category = Category::Create([
        //     'name' => $request->input('name'),
        //     'parent_id' => $request->input('parent_id'),
        //     'slug' => $request->input('slug')
        // ]);
        $this->category->create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'slug' => ''
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->CategoryRecusive($parentId);
        
        return $htmlOption;
    }

    public function edit($id){
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        


        return view('admin.category.edit',[
            'category' => $category,
            'htmlOption' => $htmlOption
        ]);
    }

    public function update($id,Request $request){
        $category = $this->category->find($id);
        $category->update([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'slug' => ''
        ]);

        return redirect()->route('admin.categories.index');
    }

    // xóa vĩnh viễn
    // public function delete($id){
    //     $category = $this->category->find($id);
    //     $category->delete();


    //     return redirect()->route('categories.index');
    // }

    //xóa mềm
    public function delete($id){
        $category = $this->category->find($id);
        $category->delete();


        return redirect()->route('admin.categories.index');
    }



    //handle algorithm

    
}
