<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Whyus extends Component
{
    public $heading;
    public $content;
    public $customer_id = 5;
    public $dataList;

    // public function mount() // Get customer_id from route or other means
    // {
    //     // $this->customer_id = $customer_id; // Set the customer_id
    //     $this->fetchData(); // Fetch the existing data
    // }


    // public function fetchData()
    // {
    //     $response = Http::get('https://demo.digiexpertpro.com/api/why_choose_us_update_api.php', [
    //         'customer_id' => $this->customer_id,
    //     ]);
    //     // $response = Http::get('http://localhost:8000/api/sign_up');
    //     $collection = json_decode($response);
    //     // $this->dataList = collect($collection->d/ata);
    //     // if ($response->successful()) {
    //     //     // $this->dataList = $response->json(); // Assuming the response is a JSON array
    //     //     $data = $response->json();
    //     //     // $this->dataList = $data['dataList'] ?? [];
    //     // } else {
    //     //     $this->errorMessage = 'Failed to fetch data: ' . $response->body();
    //     //     // $this->dataList = []; 
    //     // }

    // public function fetchData()
    // {
        // $response = Http::get('https://demo.digiexpertpro.com/api/why_choose_us_update_api.php', [
        //     'customer_id' => $this->customer_id,
        // ]);
        // $response = Http::get('http://localhost:8000/api/sign_up');
        // $collection = json_decode($response);
        // $this->dataList = collect($collection->d/ata);
        // if ($response->successful()) {
        //     // $this->dataList = $response->json(); // Assuming the response is a JSON array
        //     $data = $response->json();
        //     // $this->dataList = $data['dataList'] ?? [];
        // } else {
        //     $this->errorMessage = 'Failed to fetch data: ' . $response->body();
        //     // $this->dataList = []; 
        // }


    //     if (isset($collection->data)) {
    //         // Store the data in a collection
    //         $this->dataList = collect($collection->data);
    //     } else {
    //         // Handle the case where there is no data or an error occurred
    //         $this->dataList = collect(); // Initialize as an empty collection
    //     }

    // }


    // public function submit()
    // {
    //     $response = Http::post('https://demo.digiexpertpro.com/api/why_choose_us_update_api.php',[
    //         'customer_id' => $this->customer_id,
    //         'heading' => $this->heading,
    //         'content' => $this->content,
    //         'api_type'=> 'insert',
    //     ]);

    // public function submit()
    // {
        // $response = Http::post('https://demo.digiexpertpro.com/api/why_choose_us_update_api.php',[
        //     'customer_id' => $this->customer_id,
        //     'heading' => $this->heading,
        //     'content' => $this->content,
        //     'api_type'=> 'insert',
        // ]);


    //     if($response->successful()){
    //         $this->successMessage = 'Data submitted successfully';
    //         $this->reset(['heading','content']);
    //     } else {
    //         $this->errorMessage = 'Failed'.$response->body();
    //     }
    // }



    public function render()
    {
        // $response = Http::get('https://demo.digiexpertpro.com/api/why_choose_us_update_api.php', [
        //     'customer_id' => $this->customer_id,
        // ]);
        
        // $response = Http::get('https://demo.digiexpertpro.com/api/why_choose_us_update_api.php', [
        //     'customer_id' => $this->customer_id,
        // ]);
        // // $response = Http::get('http://localhost:8000/api/sign_up');
        // $collection = json_decode($response);
        // $this->dataList = collect($collection->data);


        return view('livewire.whyus');
    }
}
