<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Country;
use App\Models\Distribution;
use App\Models\Franchise;
use App\Models\Postrequirment;
use App\Models\Product;
use App\Models\SuccessStoryModel;
use Livewire\Component;

class Home extends Component
{
    public $name, $email, $phone_number, $city, $country, $message;
    public $products = [];
    public $postrequirments = [];
    public $categories = [];
    public $countries;
    public $bgImage;
    public $successStories;

    // public $totalProducts;


    public function mount()
    {

        $this->successStories = SuccessStoryModel::latest()->get();

        $this->countries = Country::select('country_id', 'short_name')->orderBy('short_name')->get();

        $this->postrequirments = Postrequirment::with(relations: 'customer')
            ->where('status', 1)
            ->inRandomOrder()
            ->limit(18)
            ->orderBy('id', 'desc')
            ->get();


        // Fetch products from the database
        $this->products = Product::with(['country', 'customer'])->where('status', 1)->inRandomOrder()->limit(9)->get();


        $this->categories = Category::with([
            'products' => function ($query) {
                $query->where('status', 1)->inRandomOrder()->limit(8); // Limit the number of products per category
            }
        ])->limit(1)->get();

        // if ($this->subSubcategory) {
        //     $this->bgImage = ''; // No background for sub-subcategory
        // } elseif ($this->subcategory) {
        // $this->bgImage = asset('storage/' . $this->subcategory->subcat_bgimg);
        // }
        // $this->bgImages = $this->categories->map(function ($cat) {
        //     return asset('storage/' . $cat->maincat_bgimg);
        // })->toArray();
    }

    //Distribution data Post
    public function addDistribution()
    {

        $customerId = session('id');

        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Please login to apply as a distributor.');
        }

        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required|string',
            'city' => 'required',
            'country' => 'required',
            'message' => 'required',
        ]);

        Distribution::create([
            'name'          => $this->name,
            'email'         => $this->email,
            'lead_id'         => $customerId,
            'phone_number'  => $this->phone_number,
            'city'          => $this->city,
            'country'       => $this->country,
            'message'       => $this->message,
            'staffid'       => 14,
        ]);

        // $this->resetForm();
        $this->reset(['name', 'email', 'phone_number', 'city', 'country', 'message']);

        session()->flash('message', 'Distribution Data added successfully.');

        return redirect()->to(url()->previous())->with('success', 'Distribution Data added successfully.');
    }

    //Franchise data Post
    public function addFranchise()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required|string',
            'city' => 'required',
            'country' => 'required',
            'message' => 'required',
        ]);

        Franchise::create([
            'name'          => $this->name,
            'email'         => $this->email,
            'phone_number'  => $this->phone_number,
            'city'          => $this->city,
            'country'       => $this->country,
            'message'       => $this->message,
        ]);

        // $this->resetForm();
        $this->reset(['name', 'email', 'phone_number', 'city', 'country', 'message']);

        session()->flash('message', 'Franchise Data added successfully.');

        return redirect()->to(url()->previous())->with('success', 'Franchise Data added successfully.');
    }


    // public function resetForm()
    // {
    //     $this->name = '';
    //     $this->email = '';
    //     $this->phone_number = '';
    //     $this->city = '';
    //     $this->country = '';
    //     $this->message = '';
    // }

    public function updatedPhoneNumber($value)
    {
        if (is_array($value)) {
            $this->phone_number = $value[0] ?? null;
        }
    }

    public function render()
    {
        $category = Category::all();

        return view('livewire.front.home', compact('category'));
    }
}
