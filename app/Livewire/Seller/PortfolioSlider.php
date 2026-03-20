<?php

namespace App\Livewire\Seller;

use App\Models\SliderImage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PortfolioSlider extends Component
{

    use WithFileUploads;

    public $editSliderId;
    public $isEdit = false;
    public $slider_images;
    public $slider_img;

    public function AddSliderImage()
    {
        $this->validate([
            'slider_img' => $this->isEdit ? 'nullable' : 'required',
        ]);

        $lead_id = Session::get('id');

        if ($this->isEdit) {
            $slider = SliderImage::findOrFail($this->editSliderId);

            // if ($this->slider_img  && is_object($this->slider_img)) {
            //     $newImagePath = $this->slider_img->store('uploads/slider-images', 'public');

            //     if (file_exists(public_path('storage/' . $slider->slider_img))) {
            //         unlink(public_path('storage/' . $slider->slider_img));
            //     }

            //     $slider->update(['slider_img' => $newImagePath]);
            // }
            if ($this->slider_img && is_object($this->slider_img)) {

                $newImagePath = $this->slider_img->store('uploads/slider-images', 's3', 's3');

                if ($slider->slider_img && Storage::disk('s3')->exists($slider->slider_img)) {
                    Storage::disk('s3')->delete($slider->slider_img);
                }

                $slider->update(['slider_img' => $newImagePath]);
            }

            session()->flash('message', 'Slider image updated successfully!');
        } else {

            $imagePath = $this->slider_img->store('uploads/slider-images', 'public', 's3');

            SliderImage::create([
                'slider_img' => $imagePath,
                'lead_id' => $lead_id,
            ]);

            session()->flash('message', 'Slider image added successfully!');
        }
        $this->reset();
    }

    public function editSliderImage($id)
    {
        $this->isEdit = true;
        $slider = SliderImage::findOrFail($id);
        $this->editSliderId = $slider->id;
        $this->slider_img = $slider->slider_img;
    }

    public function DeleteSliderImage($id)
    {
        $slider = SliderImage::findOrFail($id);

        // Delete the image file from storage
        // if (file_exists(public_path('storage/' . $slider->slider_img))) {
        //     unlink(public_path('storage/' . $slider->slider_img));
        // }
        if ($slider->slider_img && Storage::disk('s3')->exists($slider->slider_img)) {
            Storage::disk('s3')->delete($slider->slider_img);
        }

        // Delete the image record from the database
        $slider->delete();

        session()->flash('message', 'Slider image removed successfully!');
    }

    public function render()
    {
        $this->slider_images = SliderImage::all();
        return view('livewire.seller.portfolio-slider');
    }
}
