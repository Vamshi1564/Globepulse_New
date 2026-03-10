<?php

namespace App\Livewire\Seller;

use App\Models\Category;
use App\Models\Customer;
use App\Models\ItemsModel;
use App\Models\Membership;
use App\Models\Product;
use App\Models\Productgallery;
use App\Models\Subcategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductAdd extends Component
{

    use WithFileUploads;

    public $title;
    public $description;
    public $product_img;
    public $gallery_images = [];
    public $new_gallery_images = [];
    public $category_id;
    public $max_price;
    public $min_price;
    public $min_order;
    public $business_type;
    public $slug;
    public $HSN;
    public $customerId;
    public $subcategories = [];
    public $sub_subcategories = [];
    public $sub_subcategory_id;
    public $subcategory_id;


    public function render()
    {
        $categories = Category::all();
        return view('livewire.seller.product-add', compact('categories'));
    }

    public function updatedCategoryId($categoryId)
    {
        // Fetch subcategories based on the selected category
        $this->subcategories = Subcategory::where('category_id', $categoryId)->get();
        $this->subcategory_id = null; // Reset the selected subcategory
    }

    public function updatedSubcategoryId($subcategoryId)
    {
        $this->sub_subcategories = SubSubCategory::where('subcategory_id', $subcategoryId)->get();
        $this->sub_subcategory_id = null; // Reset the sub-subcategory selection
    }
    public function updatedNewGalleryImages()
    {
        foreach ($this->new_gallery_images as $image) {
            $this->gallery_images[] = $image; // ✅ Append instead of replace
        }

        $this->new_gallery_images = []; // ✅ Reset temp input
    }

    public function submit()
    {
        date_default_timezone_set('Asia/Kolkata');

        try {
            $validated = $this->validate([
                'title' => 'required',
                'description' => 'required',
                'product_img' => 'required|image|mimes:webp,jpg|dimensions:width=1080,height=1080',
                'max_price' => 'required|numeric',
                'min_price' => 'required|numeric',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'sub_subcategory_id' => 'required',
                'min_order' => 'required',
                'business_type' => 'required',
                'HSN' => 'required|numeric',
                'gallery_images' => 'required|array|min:1',
                'gallery_images.*' => 'image|mimes:webp,jpg,jpeg,png|max:2048|dimensions:width=1080,height=1080'

            ], [
                'category_id.required' => 'Please select a category.',
                'subcategory_id.required' => 'Please select a sub category.',
                'sub_subcategory_id.required' => 'Please select a sub subcategory.',
                'product_img.required' => 'The product img is required.',
                'product_img.dimensions' => 'The product image must be exactly 1080px by 1080px.',
                'product_img.mimes' => 'The product image must be a webp or jpg.',
                'gallery_images.*.mimes' => 'The Gallery image must be a webp,jpg.',
                'gallery_images.*.dimensions' => 'The Gallery image must be exactly 1080px by 1080px.',
                // 'HSN' => 'HSN Code is required'
            ]);

            $customerId = Session::get('id');

            $customer = Customer::find($customerId);
            $country = $customer->country_id;

            if ($customer->package_id == 0) {
                session()->flash('error', 'You cannot add a product without a valid package.');
                return;
            }

            // $packageId = $customer->package_id;
            // $membership = Membership::where('id', $packageId)->first();

            // $productLimit = $membership->product_limit;
            $existingProducts = Product::where('customer_id', $customerId)->count();
            if (!empty($customer->product_upload_limit)) {
                $productLimit = $customer->product_upload_limit;
            } else {
                $membership = ItemsModel::find($customer->package_id);
                $productLimit = $membership ? $membership->product_limit : 0;
            }


            if ($existingProducts >= $productLimit) {
                session()->flash('error', 'You have reached your product upload limit.');
                return;
            }

            $originalName = $this->product_img->getClientOriginalName();
            $nameOnly = preg_replace('/[[:space:]]+/', '-', trim(preg_replace('/\x{00A0}/u', ' ', pathinfo($originalName, PATHINFO_FILENAME))));
            $extension = $this->product_img->getClientOriginalExtension();
            $randomNumber = rand(1000, 999999);
            $uniqueName = $nameOnly . '-' . $randomNumber . '.' . $extension;

            $this->product_img->storeAs('public/uploads/product', $uniqueName, 's3');
            $imagePath = 'uploads/product/' . $uniqueName;

            $slug = preg_replace('/\s+/', '-', trim($this->slug));

            // $customerId = Session::get('id');

            $product = Product::create([
                'title' => $this->title,
                'description' => $this->description,
                'product_img' => $imagePath,
                'category_id' => $this->category_id,
                'subcategory_id' => $this->subcategory_id,
                'sub_subcategory_id' => $this->sub_subcategory_id,
                'max_price' => $this->max_price,
                'min_price' => $this->min_price,
                'min_order' => $this->min_order,
                'business_type' => $this->business_type,
                'slug' => $slug,
                'HSN' => $this->HSN,
                'customer_id' => $customerId, // Automatically store logged-in customer's ID
                'country_id' => $country,
                'status' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);



            // if (!empty($this->gallery_images)) {
            //     foreach ($this->gallery_images as $galleryImage) {
            //         $galleryImagePath = $galleryImage->store('uploads/gallery', 'public');
            //         ProductGallery::create([
            //             'product_id' => $product->id,
            //             'gallery_image' => $galleryImagePath
            //         ]);
            //     }
            // }

            if (!empty($this->gallery_images)) {
                foreach ($this->gallery_images as $galleryImage) {
                    $originalName = $galleryImage->getClientOriginalName();
                    $nameOnly = preg_replace('/[[:space:]]+/', '-', trim(preg_replace('/\x{00A0}/u', ' ', pathinfo($originalName, PATHINFO_FILENAME))));
                    $extension = $galleryImage->getClientOriginalExtension();
                    $randomNumber = rand(1000, 999999);
                    $uniqueName = $nameOnly . '-' . $randomNumber . '.' . $extension;

                    $galleryImage->storeAs('public/uploads/gallery', $uniqueName, 's3');
                    $galleryImagePath = 'uploads/gallery/' . $uniqueName;

                    Productgallery::create([
                        'product_id' => $product->id,
                        'gallery_images' => 'uploads/gallery/' . $uniqueName,
                        'customer_id' => $customerId,
                    ]);
                }
            }
            // session()->flash('message', 'Product Added Successfully.');
            $this->reset();
            return redirect()->route('product_list')->with('message', 'Product Added Successfully!');
        } catch (\Exception $e) {
            // Log::error('Product Add Error: ' . $e->getMessage());
            session()->flash('error', 'Something went wrong. Please try again.');
        } // return redirect()->route('product_gallery', ['productId' => $product->id])->with('message', 'Please Add More Product Gallery Images');
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title) . '-' . rand(100, 999999999);
    }
}
