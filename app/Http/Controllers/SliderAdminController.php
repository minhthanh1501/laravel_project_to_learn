<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use Illuminate\Http\Request;
use \App\Models\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;

class SliderAdminController extends Controller
{

    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider) {
        $this->slider = $slider;
    }

    public function index() {
        $sliders = $this->slider->latest()->paginate(5);
        
        return view('admin.sliders.index',[
            'sliders' => $sliders
        ]);
    }

    public function create(){

        return view('admin.sliders.add');
    }

    public function store(SliderAddRequest $request) {
        
        try {
            $dataInsert = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ];
    
            $dataImageSlider = $this->storageTraitUpload($request,'image_path','slider');
    
            if(!empty($dataImageSlider)){
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = $dataImageSlider['file_path'];
            }
    
            $this->slider->create($dataInsert);
    
            return redirect()->route('sliders.index');
        } catch (\Exception $exception) {
            Log::error("Lỗi :" . $exception->getMessage() . ' --line : ' . $exception->getLine());
        }
    }
}
