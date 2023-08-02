<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\AddSettingRequest;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\Log;

class SettingAdminController extends Controller
{
    use DeleteModelTrait;
    private $setting;

    public function __construct(Setting $setting) {
        $this->setting = $setting;
    }

    public function index()
    {
        $settings = $this->setting->latest()->paginate(5);

        return view('admin.settings.index',[
            'settings' => $settings
        ]);
    }

    public function create(){

        return view('admin.settings.add');
    }

    public function store(AddSettingRequest $request){
        $this->setting->create([
            'config_key' => $request->input('config_key'),
            'config_value' => $request->input('config_value'),
            'type' => $request->input('type'),
        ]);
        return redirect()->route('settings.index');
    }

    public function edit($id){

        $setting = $this->setting->find($id);

        return view('admin.settings.edit',[
            'setting' => $setting
        ]);
    }

    public function update(AddSettingRequest $request,$id){

    }

    public function delete($id){
        return $this->deleteModelTrait($id,$this->setting);
    }
}
