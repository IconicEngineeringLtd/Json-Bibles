<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Storage;
use Auth;

use Carbon\Carbon;
use App\Stores;
use App\Categories;
use App\SubCategories;
use App\Brands;
use App\Products;

class ProductController extends Controller
{
  // Authentication Method
  public function __construct()
  {
    $this->middleware('auth');
  }

  // Temporary for bulk change
  // public function changeProductSupplier()
  // {
  //   $products = Products::where('brand_id', '>=', 9)->get();
  //   foreach ($products as $product) {
  //     $product->supplier_id = 2;
  //     $product->save();
  //   }
  // }

  // Product Retalet Methods
  // Product Add
  public function supplierProductAdd($storeId)
  {
    $store = Stores::findOrfail($storeId);
    $categories = Categories::all();
    $sub_categories = SubCategories::all();
    $brands = Brands::all();
    return view('supplier.store.innerStore.productAdd', compact('store', 'categories', 'sub_categories', 'brands'));
  }
  public function supplierProductSubmit(Request $request)
    {
      $validatedData = $request->validate([
        'store_id' => 'required',
        'category_id' => 'required',
        'sub_category_id' => '',
        'brand_id' => 'required',
        'model' => 'required',
        'title' => 'required',
        'url' => 'required|unique:products',
        'price' => 'required',
        'discount_ratio' => '',
        'product_image' => 'required',
        'overview' => 'required',
        'features' => 'required',
        'specifications' => 'required',
        'includes' => 'required',
        'accessories' => 'required',
        'meta_slug' => 'unique:products',
      ]);

      $store = Stores::findOrfail($request->store_id);
      $category = Categories::findOrfail($request->category_id);
      $sub_category = SubCategories::findOrfail($request->sub_category_id);
      $brand = Brands::findOrfail($request->brand_id);

      // Tags
      if(!empty($request->tags)){
        $tags = implode(',', $request->tags);
      }else {
        $tags = "NULL";
      }

      $lastInsertedId = Products::insertGetId([
        "created_by" => Auth::id(),
        "supplier_id" => $request->store_id,
        "category_id" => $request->category_id,
        "sub_category_id" => $request->sub_category_id,
        "brand_id" => $request->brand_id,
        "model" => $request->model,
        "title" => $request->title,
        "url" => $request->url,
        "price" => $request->price,
        "discount_ratio" => $request->discount_ratio,
        "overview" => $request->overview,
        "features" => $request->features,
        "specifications" => $request->specifications,
        "includes" => $request->includes,
        "accessories" => $request->accessories,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
        "tags" => $tags,
        "created_at" => Carbon::now()
        ]);

        // New Codes for resize & store images Starts
        if($request->hasFile('product_image')) {
        //get filename with extension
        $fileNameWithExtension = $request->file('product_image')->getClientOriginalName();

        //get filename without extension
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('product_image')->getClientOriginalExtension();

        //filename to store
        $fileNameToStore = str_replace(' ', '-', $fileName).'-'.time().'.'.$extension;

        //Upload File
        $imagePath = $request->file('product_image')->storeAs("images/products/$store->id/$category->url/$sub_category->url/$brand->url", $fileNameToStore);
        $thumbnailPathSmall = $request->file('product_image')->storeAs("images/products/$store->id/$category->url/$sub_category->url/$brand->url/thumbnailSmall", $fileNameToStore);
        $thumbnailPathMedium = $request->file('product_image')->storeAs("images/products/$store->id/$category->url/$sub_category->url/$brand->url/thumbnailMedium", $fileNameToStore);

        //Resize image here
        // Thumbnail Small
        $thubmnailRealPathSmall = public_path("/storage/$thumbnailPathSmall");
        $thumbnailSmall = Image::make($thubmnailRealPathSmall)->resize(100, 100, function($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnailSmall->save($thubmnailRealPathSmall);
        //Thumbnail Medium
        $thubmnailRealPathMedium = public_path("/storage/$thumbnailPathMedium");
        $thumbnailMedium = Image::make($thubmnailRealPathMedium)->resize(228, 228, function($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnailMedium->save($thubmnailRealPathMedium);
      }
      // New Codes for resize & store images Ends

      Products::find($lastInsertedId)->update([
        "updated_by" => Auth::id(),
        "product_image" => $imagePath,
        "thumbnail_small" => $thumbnailPathSmall,
        "thumbnail_medium" => $thumbnailPathMedium,
      ]);

      $productUrl = Products::find($lastInsertedId)->url;
      $finalUrl = '<a href="'. route('product_details', $productUrl) . '" class="btn btn-success ml-2">View Product</a>';
      return back()->with('status', "Product Added Successfully! $finalUrl");
    }
    // Single Product Page Methods
    // Product Edit Page
    public function supplierEditProduct($productId)
    {
      $product = Products::findOrFail($productId);
      $store = $product->store;
      $categories = Categories::all();
      $sub_categories = SubCategories::all();
      $brands = Brands::all();
      return view('supplier.store.innerStore.productEdit', compact('product', 'store', 'categories', 'sub_categories', 'brands'));
    }
    // Prosuct Update Method
    public function supplierProductUpdate(Request $request)
      {
        $product = Products::findOrfail($request->product_id);
        $checkurl = $product->url;
        if($checkurl != $request->url){
          $validatedData = $request->validate([
            'store_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => '',
            'brand_id' => 'required',
            'model' => 'required',
            'title' => 'required',
            'url' => 'required|unique:products',
            'price' => 'required',
            'discount_ratio' => '',
            'product_image' => '',
            'overview' => 'required',
            'features' => 'required',
            'specifications' => 'required',
            'includes' => 'required',
            'accessories' => 'required',
            'meta_slug' => 'unique:products',
          ]);
        }else {
          $validatedData = $request->validate([
            'store_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => '',
            'brand_id' => 'required',
            'model' => 'required',
            'title' => 'required',
            'url' => 'required',
            'price' => 'required',
            'discount_ratio' => '',
            'product_image' => '',
            'overview' => 'required',
            'features' => 'required',
            'specifications' => 'required',
            'includes' => 'required',
            'accessories' => 'required',
            'meta_slug' => '',
          ]);
        }

        $proId = $request->product_id;
        $store = Stores::findOrfail($request->store_id);
        $category = Categories::findOrfail($request->category_id);
        $sub_category = SubCategories::findOrfail($request->sub_category_id);
        $brand = Brands::findOrfail($request->brand_id);

        // New Codes for resize & store images Starts
        if($request->hasFile('product_image')) {
        Storage::delete(Products::findOrfail($proId)->product_image);
        Storage::delete(Products::findOrfail($proId)->thumbnail_medium);
        Storage::delete(Products::findOrfail($proId)->thumbnail_small);
        //get filename with extension
        $fileNameWithExtension = $request->file('product_image')->getClientOriginalName();

        //get filename without extension
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('product_image')->getClientOriginalExtension();

        //filename to store
        $fileNameToStore = str_replace(' ', '-', $fileName).'-'.time().'.'.$extension;

        //Upload File
        $imagePath = $request->file('product_image')->storeAs("images/products/$store->id/$category->url/$sub_category->url/$brand->url", $fileNameToStore);
        $thumbnailPathSmall = $request->file('product_image')->storeAs("images/products/$store->id/$category->url/$sub_category->url/$brand->url/thumbnailSmall", $fileNameToStore);
        $thumbnailPathMedium = $request->file('product_image')->storeAs("images/products/$store->id/$category->url/$sub_category->url/$brand->url/thumbnailMedium", $fileNameToStore);

        //Resize image here
        // Thumbnail Small
        $thubmnailRealPathSmall = public_path("/storage/$thumbnailPathSmall");
        $thumbnailSmall = Image::make($thubmnailRealPathSmall)->resize(150, 150, function($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnailSmall->save($thubmnailRealPathSmall);
        //Thumbnail Medium
        $thubmnailRealPathMedium = public_path("/storage/$thumbnailPathMedium");
        $thumbnailMedium = Image::make($thubmnailRealPathMedium)->resize(228, 228, function($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnailMedium->save($thubmnailRealPathMedium);
        // New Codes for resize & store images Ends

          // Tags
          if(!empty($request->tags)){
            $tags = implode(',', $request->tags);
          }else {
            $tags = "NULL";
          }

          Products::findOrfail($proId)->update([
            "updated_by" => Auth::id(),
            "supplier_id" => $request->store_id,
            "category_id" => $request->category_id,
            "sub_category_id" => $request->sub_category_id,
            "brand_id" => $request->brand_id,
            "model" => $request->model,
            "title" => $request->title,
            "url" => $request->url,
            "price" => $request->price,
            'discount_ratio' => $request->discount_ratio,
            "overview" => $request->overview,
            "features" => $request->features,
            "specifications" => $request->specifications,
            "includes" => $request->includes,
            "accessories" => $request->accessories,
            "meta_title" => $request->meta_title,
            "meta_slug" => $request->meta_slug,
            "meta_description" => $request->meta_description,
            "meta_keywords" => $request->meta_keywords,
            "tags" => $tags,
            "product_image" => $imagePath,
            "thumbnail_small" => $thumbnailPathSmall,
            "thumbnail_medium" => $thumbnailPathMedium,
            ]);
            return back()->with('status', 'Product with Image Updated Successfully!');
          }else{

            // Tags
            if(!empty($request->tags)){
              $tags = implode(',', $request->tags);
            }else {
              $tags = "NULL";
            }

            Products::findOrfail($proId)->update([
              "updated_by" => Auth::id(),
              "supplier_id" => $request->store_id,
              "category_id" => $request->category_id,
              "sub_category_id" => $request->sub_category_id,
              "brand_id" => $request->brand_id,
              "model" => $request->model,
              "title" => $request->title,
              "url" => $request->url,
              "price" => $request->price,
              'discount_ratio' => $request->discount_ratio,
              "overview" => $request->overview,
              "features" => $request->features,
              "specifications" => $request->specifications,
              "includes" => $request->includes,
              "accessories" => $request->accessories,
              "meta_title" => $request->meta_title,
              "meta_slug" => $request->meta_slug,
              "meta_description" => $request->meta_description,
              "meta_keywords" => $request->meta_keywords,
              "tags" => $tags,
              ]);
              return back()->with('status', 'Product Updated Successfully!');
          }
      }
}
