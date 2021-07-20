<?php

namespace App\Http\Controllers;

use App\Models\MainDestination;
use App\Models\PackageTicket;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductPackage;
use App\Models\SubDestination;
use App\Models\WelcomeGallery;
use App\Models\WelcomePage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function welcome()
    {
        $welcome = WelcomePage::first();
        $welcome_gallery = WelcomeGallery::where('kind','welcome')->get();
        $love_product = Product::where('package', '<>', 0)->where('ticket', '<>', 0)->where('top_thing','on')->where('status','<>','Inactive')->inRandomOrder()->get();
        $recommed_product = Product::where('package', '<>', 0)->where('ticket', '<>', 0)->where('recommend','on')->where('status','<>','Inactive')->inRandomOrder()->get();
        $main_dest = SubDestination::inRandomOrder()->get();
        return view('welcome',[
            'love_product' => $love_product,
            'recommed_product' => $recommed_product,
            'main_dest' => $main_dest,
            'welcome_gallery' => $welcome_gallery,
            'welcome' => $welcome,

        ]);
    }

    public function show_detail($product_id)
    {
        $product = Product::find($product_id);
        $product_gallery = ProductGallery::where('product_id', $product->id)->get();
        $package = ProductPackage::where('product_id', $product->id)->where('ticket', '<>', 0)->get();
        $date = [];
        foreach($package as $item){
            // $array = explode(',',$item->availability);
            // foreach($array as $value){
            //     array_push($date,$value);
            // }
            array_push($date , explode(',',$item->availability));
        }
        // dd($date);
        return view('product.detail', ['product' => $product, 'product_gallery' => $product_gallery, 'package' => $package]);
    }

    public function get_ticket_detail(Request $request)
    {
        $tickets = PackageTicket::where('package_id', $request->id)->get();
        $ticket_html = view('product.ticket_detail', ['tickets' => $tickets])->render();

        return response()->json([
            'status' => true,
            'ticket_html' => $ticket_html,
        ]);
    }

    public function get_available_package(Request $request)
    {
        $package = ProductPackage::where('product_id', $request->product_id)->where('ticket','<>',0)->get();
        foreach ($package as $item) {
            if (in_array($request->date, explode(',', $item->availability)))
                $item['available_on'] = true;
            else
                $item['available_on'] = false;
        }
        $availabe_package_html = view('product.package_available', ['package' => $package])->render();
        return response()->json([
            'status' => true,
            'availabe_package_html' => $availabe_package_html,
        ]);
    }
    public function get_dates(Request $request){
        $product = Product::find($request->product_id);
        $package = ProductPackage::where('product_id', $product->id)->where('ticket', '<>', 0)->get();
        $date = [];
        foreach($package as $item){
            $array = explode(',',$item->availability);
            foreach($array as $value){
                array_push($date,$value);
            }
        }
        return response()->json([
            'status'=>true,
            'dates' => $date,
        ]);
    }
}
