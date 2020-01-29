<?php


namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\models\offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    public function offers()
    {
        $offers = offer::orderBy('id','DESC')->paginate(12);

        return view('offer/offers',compact('offers'));
    }
    public function add()
    {
        return view('offer/offer-add');
    }

      public function submit(OfferRequest $request)
      {


        $offer = new Offer();
        $offer->title = $request->input('title');
          $offer->description = $request->input('description');
          $offer->user_id = Auth::user()->id;
          $offer->price = $request->input('price');
          $offer->save();

          if($request->hasFile('image')) {
              $files = $request->file('image');
              $offerFilesNames = '';
              $path = 'public/offerImg/' . $offer->id;
              if(!Storage::exists($path)) {
                  Storage::makeDirectory($path);
              }
              foreach ($files as $file) {
                  $name = $file->getClientOriginalName();

                  $file->move(storage_path("app/$path"), $name);
                  $offerFilesNames .= $name. ',';
              }

              $offer->image = $offerFilesNames;
              $offer->save();
          }


          return redirect()->route('offers');
      }
      public function edit(offer $offer)
      {


         return view('offer/offer-edit',compact('offer'));
      }
      public function submitedit(OfferRequest $request, offer $offer)
      {
          $offer->title = $request->input('title');
          $offer->description = $request->input('description');
          $offer->price = $request->input('price');
          $offer->save();
          if($request->hasFile('images')) {
              $files = $request->file('images');
              $offerFileNames = '';
              $path = 'public/offerImg/' . $offer->id;
              if(!Storage::exists($path)) {
                  Storage::makeDirectory($path);
              }else{
                  Storage::deleteDirectory($path);

                  Storage::makeDirectory($path);
              }
              foreach ($files as $file) {
                  $name = $file->getClientOriginalName();

                  $file->move(storage_path("app/$path"), $name);
                  $offerFileNames .= $name.',';
              }
              $offer->image = $offerFileNames;
              $offer->save();
          }
          return redirect()->route('offers');


      }
    public function remove(offer $offer)
    {
        $path = 'public/offerImg/' . $offer->id;
        if(!Storage::exists($path)) {
            Storage::deleteDirectory($path);
        }
        $offer->delete();
        return redirect()->route('offers');
    }
    public function view(offer $offer)
    {
        return view('offer/offer',compact('offer'));
    }

    public function search(Request $request)
    {
        $search = true;
        $offers = offer::where('title','like','%'.$request->input('search').'%')->get();
        return view('offer/offers',compact('offers', 'search'));
    }
}
