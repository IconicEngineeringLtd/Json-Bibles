<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use Carbon\Carbon;
use App\User;
use App\Inventory;
use App\Stores;
use App\Brands;
use App\Products;
use App\Categories;
use App\SubCategories;
use App\CatSubs;
use App\Tags;
use App\Roles;
use App\RolesStore;

class StoreController extends Controller
{
    // Authentication Method
    public function __construct()
    {
      $this->middleware('auth');
    }

    // Ajax Requests Start
    public function ajaxRequest(Request $request)
    {

      // Post Add - Request for Sub Category
      if ($request->query_for == "sub_category_productAdd") {
        $stringToSend = '<option value="">--Select Sub Category--</option>';
        $subcategories = Categories::findOrfail($request->category_id)->subCategories;
        echo $stringToSend;
        foreach($subcategories as $subCat){
          $subcategory = '<option value="'.$subCat->id.'">'.$subCat->name.'</option>';
          echo $subcategory;
        }
      }
    }
    // Ajax Requests End

    /*--------------------------------------------------------------------------
     Methods for Developer start
    --------------------------------------------------------------------------*/

    // Brand Add
    public function developerBrandAdd()
    {
      return view('developer.store.brand');
    }
    public function developerBrandSubmit(Request $request)
    {
      // Backend Form Validation
      $request->validate([
        'name' => 'required|unique:brands',
        'url' => 'required|unique:brands',
        'country' => '',
      ]);
      Brands::insert([
        "user_id" => Auth::id(),
        "name" => $request->name,
        "url" => $request->url,
        "country" => $request->country,
        "created_at" => Carbon::now(),
      ]);
      return back()->with('status', 'Brand Submitted Successfully!');
    }
    // Category Add
    public function developerCategoryAdd()
    {
      $categories = Categories::all();
      return view('developer.store.category.addCategory', compact('categories'));
    }
    public function developerCategorySubmit(Request $request)
    {
      // Backend Form Validation
      $request->validate([
        'name' => 'required|unique:categories',
        'url' => 'required|unique:categories',
        'meta_title' => '',
        'meta_slug' => 'unique:categories',
        'meta_description' => '',
        'meta_keywords' => '',
      ]);
      Categories::insert([
        "user_id" => Auth::id(),
        "name" => $request->name,
        "url" => $request->url,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
        "created_at" => Carbon::now(),
      ]);
      return back()->with('status', 'Category Submitted Successfully!');
    }
    public function developerCategoryEdit($catId)
    {
      $category = Categories::findOrfail($catId);
      return view('developer.store.category.editCategory', compact('category'));
    }
    public function developerCategoryUpdate(Request $request)
    {
      // Backend Form Validation
      $category = Categories::findOrfail($request->category_id);
      $checkurl = $category->url;
      if($checkurl != $request->url){
        $validatedData = $request->validate([
          'name' => 'required',
          'url' => 'required|unique:categories',
          'meta_title' => '',
          'meta_slug' => 'required|unique:categories',
          'meta_description' => '',
          'meta_keywords' => '',
        ]);
      }else {
        $validatedData = $request->validate([
          'name' => 'required',
          'url' => 'required',
          'meta_title' => '',
          'meta_slug' => 'required',
          'meta_description' => '',
          'meta_keywords' => '',
        ]);
      }
      // New Codes for resize & store images Starts

        if($request->hasFile('banner') && $request->hasFile('cover')) {
        Storage::delete(Categories::findOrfail($request->category_id)->banner);
        Storage::delete(Categories::findOrfail($request->category_id)->cover);
        //get filename with extension
        $bannerWithExtension = $request->file('banner')->getClientOriginalName();
        $coverWithExtension = $request->file('cover')->getClientOriginalName();
        //get filename without extension
        $bannerName = pathinfo($bannerWithExtension, PATHINFO_FILENAME);
        $coverName = pathinfo($coverWithExtension, PATHINFO_FILENAME);
        //get file extension
        $bannerExtension = $request->file('banner')->getClientOriginalExtension();
        $coverExtension = $request->file('cover')->getClientOriginalExtension();
        //filename to store
        $bannerToStore = str_replace(' ', '-', $bannerName).'-'.time().'.'.$bannerExtension;
        $coverToStore = str_replace(' ', '-', $coverName).'-'.time().'.'.$coverExtension;
        //Upload File
        $bannerImagePath = $request->file('banner')->storeAs("images/vendor/category/$category->url/banner", $bannerToStore);
        $coverImagePath = $request->file('cover')->storeAs("images/vendor/category/$category->url/cover", $coverToStore);
      // New Codes for resize & store images Ends
      Categories::findOrfail($request->category_id)->update([
        "name" => $request->name,
        "url" => $request->url,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
        "banner" => $bannerImagePath,
        "cover" => $coverImagePath,
      ]);
      return back()->with('status', 'Category with Banner & Cover Updated Successfully!');
      }
      elseif($request->hasFile('banner')) {
      Storage::delete(Categories::findOrfail($request->category_id)->banner);
      //get filename with extension
      $bannerWithExtension = $request->file('banner')->getClientOriginalName();
      //get filename without extension
      $bannerName = pathinfo($bannerWithExtension, PATHINFO_FILENAME);
      //get file extension
      $bannerExtension = $request->file('banner')->getClientOriginalExtension();
      //filename to store
      $bannerToStore = str_replace(' ', '-', $bannerName).'-'.time().'.'.$bannerExtension;
      //Upload File
      $bannerImagePath = $request->file('banner')->storeAs("images/vendor/category/$category->url/banner", $bannerToStore);
    // New Codes for resize & store images Ends
      Categories::findOrfail($request->category_id)->update([
        "name" => $request->name,
        "url" => $request->url,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
        "banner" => $bannerImagePath,
      ]);
      return back()->with('status', 'Category with Banner Updated Successfully!');
      }
      elseif($request->hasFile('cover')) {
      Storage::delete(Categories::findOrfail($request->category_id)->cover);
      //get filename with extension
      $coverWithExtension = $request->file('cover')->getClientOriginalName();
      //get filename without extension
      $coverName = pathinfo($coverWithExtension, PATHINFO_FILENAME);
      //get file extension
      $coverExtension = $request->file('cover')->getClientOriginalExtension();
      //filename to store
      $coverToStore = str_replace(' ', '-', $coverName).'-'.time().'.'.$coverExtension;
      //Upload File
      $coverImagePath = $request->file('cover')->storeAs("images/vendor/category/$category->url/cover", $coverToStore);
    // New Codes for resize & store images Ends
      Categories::findOrfail($request->category_id)->update([
        "name" => $request->name,
        "url" => $request->url,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
        "cover" => $coverImagePath,
      ]);
      return back()->with('status', 'Category with Cover Updated Successfully!');
    }else{
      Categories::findOrfail($request->category_id)->update([
        "name" => $request->name,
        "url" => $request->url,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
      ]);
      return back()->with('status', 'Category Updated Successfully!');
    }

    }

    // Sub Category Add
    public function developersubCategoryAdd()
    {
      return view('developer.store.subCategory.index');
    }
    public function  developerSubCategorySubmit(Request $request)
    {
      // Backend Form Validation
      $request->validate([
        'name' => 'required|unique:sub_categories',
        'url' => 'required|unique:sub_categories',
      ]);
      SubCategories::insert([
        "user_id" => Auth::id(),
        "name" => $request->name,
        "url" => $request->url,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
        "created_at" => Carbon::now(),
      ]);
      return back()->with('status', 'Sub Category Submitted Successfully!');
    }
    public function developerSubCategoryEdit($subCatId)
    {
      $subCategory = SubCategories::findOrfail($subCatId);
      return view('developer.store.subCategory.edit', compact('subCategory'));
    }
    public function developerSubCategoryUpdate(Request $request)
    {
      // Backend Form Validation
      $currentUrl = SubCategories::findOrfail($request->sub_category_id)->url;
      if($currentUrl != $request->url){
        $validatedData = $request->validate([
          'name' => 'required',
          'url' => 'required|unique:categories',
          'meta_title' => '',
          'meta_slug' => 'required|unique:categories',
          'meta_description' => '',
          'meta_keywords' => '',
        ]);
      }else {
        $validatedData = $request->validate([
          'name' => 'required',
          'url' => 'required',
          'meta_title' => '',
          'meta_slug' => 'required',
          'meta_description' => '',
          'meta_keywords' => '',
        ]);
      }
      SubCategories::findOrfail($request->sub_category_id)->update([
        "name" => $request->name,
        "url" => $request->url,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
      ]);
      return back()->with('status', 'Sub Category Updated Successfully!');
    }
    // Delete Sub Category
    public function developerSubCategoryDelete(Request $request)
    {
      // Delete Sub Category
      SubCategories::findOrfail($request->sub_category_id)->delete();
      // Delete Assigned Sub Categories
      CatSubs::where('sub_category_id', $request->sub_category_id)->delete();
      return back()->with('status', 'Sub Category Deleted Successfully!');
    }

    // Sub Category Assignment
    public function developerAssignSubCat($catId)
    {
      $categories = Categories::all();
      $currentCat = Categories::findOrfail($catId);
      $sub_categories = SubCategories::all();
      return view('developer.store.category.assignSubCat', compact('categories', 'currentCat', 'sub_categories'));
    }
    public function  developerAssignSubCatDone(Request $request)
    {
      // Backend Form Validation
      $request->validate([
        'category_id' => 'required',
        'sub_categories' => 'required',
      ]);

      // Divide All Sub Categories to Single Sub Category
      foreach ($request->sub_categories as $sub_category) {
        CatSubs::insert([
          "user_id" => Auth::id(),
          "category_id" => $request->category_id,
          "sub_category_id" => $sub_category,
          "created_at" => Carbon::now(),
        ]);
      }
      return back()->with('status', 'Assigned Successfully!');
    }

    /*--------------------------------------------------------------------------
     Methods for Developer End
    --------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------
     Common Methods Start
    --------------------------------------------------------------------------*/
    // Store Related Methods
    public function index()
    {
      $store = Auth::user()->myStore;
      // Role check Developer
      if (Auth::user()->role == 1) {
        // echo "developer";
        return view('developer.store.index');
      }
      // Role check Supplier
      if (Auth::user()->role == 0 && !empty(Auth::user()->myStore)) {
        // echo "supplier";
        return view('supplier.store.index', compact('store'));
      }
      if(Auth::user()->role == 0 && empty(Auth::user()->myStore)){
        // echo "customer";
        return view('customer.store.index', compact('store'));
      }
    }
    /*--------------------------------------------------------------------------
     Common Methods End
    --------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------
     Methods for Supplier Start
    --------------------------------------------------------------------------*/
    public function supplierStoreAdd()
    {
      return view('supplier.store.add');
    }
    public function supplierStoreSubmit(Request $request)
    {
      // Backend Form Validation
      $request->validate([
        'name' => 'required|unique:stores',
        'url' => 'required',
        'type' => '',
        'slogan' => '',
        'trade_license' => 'required',
        'established_at' => 'required',
        'logo' => '',
      ]);
      Stores::insert([
        "user_id" => Auth::id(),
        "name" => $request->name,
        "url" => $request->url,
        "type" => $request->type,
        "slogan" => $request->slogan,
        "trade_license" => $request->trade_license,
        "established_at" => $request->established_at,
        "logo" => $request->logo,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
        "created_at" => Carbon::now(),
      ]);
      return redirect('/stores')->with('status', 'Store Created Successfully!');
    }

    // Inner Store Methods
    public function supplierInnerStore ($storeId)
    {
      $store = Stores::findOrfail($storeId);
      if (!empty(Auth::user()->myStore) && Auth::user()->myStore->id == $storeId || Auth::user()->role == 1) {
        return view('supplier.store.innerStore.index', compact('store'));
      }else {
        echo "Access denied!";
      }
    }
    // My Categories, Sub Categories & Products
    public function supplierAllCategories ($storeId)
    {
      $store = Stores::findOrfail($storeId);
      if (!empty(Auth::user()->myStore) && Auth::user()->myStore->id == $storeId || Auth::user()->role == 1) {
        return view('supplier.store.innerStore.categories', compact('store'));
      }else {
        echo "Access denied!";
      }
    }
    public function supplierAllSubCategories ($storeId, $categoryId)
    {
      $store = Stores::findOrfail($storeId);
      $products = Products::where('supplier_id', $storeId)->where('category_id', $categoryId)->get()->unique('sub_category_id');
      if (!empty(Auth::user()->myStore) && Auth::user()->myStore->id == $storeId || Auth::user()->role == 1) {
        return view('supplier.store.innerStore.subCategories', compact('store', 'products'));
      }else {
        echo "Access denied!";
      }
    }
    public function supplierAllProducts ($storeId, $subCategoryId)
    {
      $store = Stores::findOrfail($storeId);
      $products = Products::where('supplier_id', $storeId)->where('sub_category_id', $subCategoryId)->get();
      if (!empty(Auth::user()->myStore) && Auth::user()->myStore->id == $storeId || Auth::user()->role == 1) {
        return view('supplier.store.innerStore.products', compact('store', 'products'));
      }else {
        echo "Access denied!";
      }
    }

    // Role Assignment
    public function supplierstoreRole($storeId)
    {
      $store = Stores::findOrfail($storeId);
      $users = User::all();
      $roles = Roles::where('role_for', 'store')->orderBy('id', 'desc')->get();
      return view('supplier.store.innerStore.roles', compact('store', 'users','roles'));
    }

    public function roleAssigned(Request $request)
    {
      // Backend Form Validation
      $request->validate([
        'store_id' => 'required',
        'role_id' => 'required',
        'user_id' => 'required',
      ]);
      RolesStore::insert([
        "created_by" => Auth::id(),
        "store_id" => $request->store_id,
        "role_id" => $request->role_id,
        "user_id" => $request->user_id,
      ]);
      return back()->with('status', 'Role Assigned Successfully!');
    }

    // Tag Add
    public function supplierTags($storeId)
    {
      $store = Stores::findOrfail($storeId);
      return view('supplier.store.tag', compact('store'));
    }

    public function suppliertagSubmit(Request $request)
    {
      // Backend Form Validation
      $request->validate([
        'name' => 'required',
        'store_id' => 'required',
      ]);
      Tags::insert([
        "user_id" => Auth::id(),
        "name" => $request->name,
        "url" => $request->url,
        "store_id" => $request->store_id,
        "meta_title" => $request->meta_title,
        "meta_slug" => $request->meta_slug,
        "meta_description" => $request->meta_description,
        "meta_keywords" => $request->meta_keywords,
        "created_at" => Carbon::now(),
      ]);
      return back()->with('status', 'Tag Submitted Successfully!');
    }

    // Inventory Related Methods
    public function storeInventoryIncrease(Request $request)
    {
      // Backend Form Validation
      $request->validate([
        'quantity' => 'required',
        'product_id' => 'required',
        'supplier_id' => 'required',
      ]);
      Inventory::insert([
        "supplier_id" => $request->supplier_id,
        "user_id" => Auth::id(),
        "product_id" => $request->product_id,
        "quantity" => $request->quantity,
        "created_at" => Carbon::now(),
      ]);
      return back()->with('status', 'Stock Increased Successfully!');
    }

    /*--------------------------------------------------------------------------
     Methods for Supplier End
    --------------------------------------------------------------------------*/

}
