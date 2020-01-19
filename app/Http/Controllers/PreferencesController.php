<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use Storage;
use Carbon\Carbon;
use App\Sliders;

class PreferencesController extends Controller
{
    /*--------------------------------------------------------------------------
     Methods for Developer start
    --------------------------------------------------------------------------*/

    public function developerPreferences()
    {
      $sliders = Sliders::all();
      return view('developer.preferences.media.slider', compact('sliders'));
    }
    public function developerSliderSubmit(Request $request)
    {
      $validatedData = $request->validate([
        'image' => 'required|mimes:jpeg,jpg,png,gif,webp',
        'header' => '',
        'content' => '',
        'header' => '',
        'position' => '',
        'privacy' => '',
      ]);
      // New Codes for resize & store images Starts
      if($request->hasFile('image')) {
      //get filename with extension
      $fileNameWithExtension = $request->file('image')->getClientOriginalName();

      //get filename without extension
      $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

      //get file extension
      $extension = $request->file('image')->getClientOriginalExtension();

      //filename to store
      $fileNameToStore = str_replace(' ', '-', $fileName).'-'.time().'.'.$extension;

      //Upload File
      $imagePath = $request->file('image')->storeAs("images/vendor/sliders", $fileNameToStore);
      $thumbnailPathSmall = $request->file('image')->storeAs("images/vendor/sliders/thumbnailSmall", $fileNameToStore);

      //Resize image here
      // Thumbnail Small
      $thubmnailRealPathSmall = public_path("/storage/$thumbnailPathSmall");
      $thumbnailSmall = Image::make($thubmnailRealPathSmall)->resize(360, 133, function($constraint) {
          $constraint->aspectRatio();
      });
      $thumbnailSmall->save($thubmnailRealPathSmall);
    }
    // New Codes for resize & store images Ends
    Sliders::insert([
      "created_by" => Auth::id(),
      "header" => $request->header,
      "content" => $request->content,
      "header" => $request->header,
      "position" => $request->position,
      "privacy" => $request->privacy,
      "image" => $imagePath,
      "thumbnail_small" => $thumbnailPathSmall,
      "created_at" => Carbon::now()
      ]);
      return back()->with('status', 'Slider Added Successfully!');
    }
    // Slider Update
    public function developerSliderUpdate(Request $request)
    {
      $validatedData = $request->validate([
        'sliderId' => 'required',
        'image' => 'mimes:jpeg,jpg,png,gif,webp',
        'header' => '',
        'content' => '',
        'header' => '',
        'position' => '',
        'privacy' => '',
      ]);
      // New Codes for resize & store images Starts
      if($request->hasFile('image')) {
        Storage::delete(Sliders::findOrfail($request->sliderId)->image);
        Storage::delete(Sliders::findOrfail($request->sliderId)->thumbnail_small);

        //get filename with extension
        $fileNameWithExtension = $request->file('image')->getClientOriginalName();

        //get filename without extension
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('image')->getClientOriginalExtension();

        //filename to store
        $fileNameToStore = str_replace(' ', '-', $fileName).'-'.time().'.'.$extension;

        //Upload File
        $imagePath = $request->file('image')->storeAs("images/vendor/sliders", $fileNameToStore);
        $thumbnailPathSmall = $request->file('image')->storeAs("images/vendor/sliders/thumbnailSmall", $fileNameToStore);

        //Resize image here
        // Thumbnail Small
        $thubmnailRealPathSmall = public_path("/storage/$thumbnailPathSmall");
        $thumbnailSmall = Image::make($thubmnailRealPathSmall)->resize(360, 133, function($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnailSmall->save($thubmnailRealPathSmall);
        // New Codes for resize & store images Ends

        // Codes for Update
        Sliders::findOrfail($request->sliderId)->update([
          "header" => $request->header,
          "content" => $request->content,
          "header" => $request->header,
          "position" => $request->position,
          "privacy" => $request->privacy,
          "image" => $imagePath,
          "thumbnail_small" => $thumbnailPathSmall
          ]);
        return back()->with('status', 'Slider with Image Updated Successfully!');
      }else{
        // Codes for Update
        Sliders::findOrfail($request->sliderId)->update([
          "header" => $request->header,
          "content" => $request->content,
          "header" => $request->header,
          "position" => $request->position,
          "privacy" => $request->privacy,
          ]);
        return back()->with('status', 'Slider Updated Successfully!');
      }
    }

    public function developerSliderDelete(Request $request)
    {
      $validatedData = $request->validate([
        'sliderId' => 'required'
      ]);
      // Codes for Update
      Storage::delete(Sliders::findOrfail($request->sliderId)->image);
      Storage::delete(Sliders::findOrfail($request->sliderId)->thumbnail_small);
      Sliders::findOrfail($request->sliderId)->delete();
      return back()->with('status', 'Slider Image Deleted Successfully!');
    }

    /*--------------------------------------------------------------------------
     Methods for Developer End
    --------------------------------------------------------------------------*/
}
