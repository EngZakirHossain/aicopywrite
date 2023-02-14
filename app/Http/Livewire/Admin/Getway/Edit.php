<?php

namespace App\Http\Livewire\Admin\Getway;

use Livewire\Component;
use App\Models\Getway;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Validator;

class Edit extends Component
{

    public $getway, $name, $logo, $rate, $charge, $namespace, $currency_name, $image_accept, $is_auto, $test_mode, $status, $phone_required, $instruction, $data = [];

    use WithFileUploads;

    public function mount($id)
    {
        $this->getway = Getway::find($id);

        $this->fill([
            'name' => $this->getway->name,
            'rate' => $this->getway->rate,
            'charge' => $this->getway->charge,
            'currency_name' => $this->getway->currency_name,
            'image_accept' => $this->getway->image_accept,
            'is_auto' => $this->getway->is_auto,
            'test_mode' => $this->getway->test_mode,
            'phone_required' => $this->getway->phone_required,
            'instruction' => $this->getway->instruction
        ]);

        if(json_decode($this->getway->data) != null)
        {
            foreach(json_decode($this->getway->data) as $key => $value) {
                $this->data[$key] = str_replace(' ', '', $value);
            }
        }

        $this->status = $this->getway->status;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:255',
            'rate' => 'required|integer|min:1',
            'charge' => 'required|integer',
            'currency_name' => 'required|string|max:255',
            'image_accept' => 'required|boolean',
            'is_auto' => 'required|boolean',
            'test_mode' => 'required|boolean',
            'status' => 'required|string|max:255',
            'phone_required' => 'required|boolean',
            'instruction' => 'nullable|string|max:255',
            'data' => 'nullable'
        ]);



        if($this->logo)
        {
            $this->logo->store('getway','public');

            $logo = Storage::url('getway/'.$this->logo->hashName());
        }else{
            $logo = $this->getway->logo;
        }

        $this->getway->update([
            'name' => $this->name,
            'logo' => $logo,
            'rate' => $this->rate,
            'charge' => $this->charge,
            'currency_name' => $this->currency_name,
            'image_accept' => $this->image_accept,
            'is_auto' => $this->is_auto,
            'test_mode' => $this->test_mode,
            'status' => $this->status,
            'phone_required' => $this->phone_required,
            'instruction' => $this->instruction,
            'data' => json_encode($this->data)
        ]);

        foreach($this->data as $key => $value) {
            Artisan::call("env:set ".$key."='".str_replace(' ', '', $value)."'");
        }

        return redirect()->route('admin.gateway.index');
    }

    public function render()
    {
        return view('livewire.admin.getway.edit');
    }
}
