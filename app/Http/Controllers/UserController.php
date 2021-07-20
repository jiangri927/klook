<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\AbpHistory;
use App\Models\AutoReport;
use App\Models\Book;
use App\Models\BookTicket;
use App\Models\CartTicket;
use App\Models\City;
use App\Models\CreditsHistory;
use App\Models\PackageTicket;
use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\User;
use App\Models\Country;
use App\Models\UserCart;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Input;
use App\Models\WelcomeGallery;
use App\Models\WelcomePage;
use App\Models\SubDestination;

class UserController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index(){
        $user = auth()->user();
        if ($user->status == 'Active')

            return redirect()->route('user.account.edit');
        else{
            $message='This Account '.$user->email.' is Inactive';
            Auth::logout($user);
            return view('auth.login',['error_msg'=>$message]);
        }

    }

    public function setting(){
        $user = auth()->user();
        return view('user.profile',['user'=>$user,'active'=>'setting','side'=>'Settings']);
    }
    public function wishlist(){
        $user = auth()->user();
        return view('user.profile',['user'=>$user,'active'=>'wishlist','side'=>'Wishlist']);
    }
    public function reviews(){
        $user = auth()->user();
        return view('user.profile',['user'=>$user,'active'=>'reviews','side'=>'Reviews']);
    }
    public function credits(){
        $user = auth()->user();
        return view('user.profile',['user'=>$user,'active'=>'credits','side'=>'Credits']);
    }

    public function edit_accout(){
        $user = auth()->user();
        $country = Country::all();
        return view('user.profile',['user'=>$user,'active'=>'edit_account','side'=>'Edit Profile','country'=>$country]);
    }
    public function upload_avatar(){
        $input = Input::all();
        $user = auth()->user();
        if(Input::hasFile('file')) {
            $file = Input::file('file');
            $filename = $file->getClientOriginalName();
            $upload_filename = time().'.'.$file->extension();

            $input['imagename'] = $upload_filename;
            $destinationPath = public_path('avatars');

            $upload_success = $file->move($destinationPath, $input['imagename']);

            if( $upload_success ) {
                $user->update(['avatar'=>asset('avatars/'.$upload_filename)]);
                return response()->json([
                    "status" => "success",
                    "upload_id" => $upload_filename,
                    'url' =>asset('avatars/'.$upload_filename),
                    "name" => $filename,
                ], 200);
            } else {
                return response()->json([
                    "status" => "error"
                ], 400);
            }
        } else {
            return response()->json('error: upload file not found.', 400);
        }
    }

    public function save_profile(Request $request){
        $user = auth()->user();
        $user->update([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'country' => $request->country,
            'countrycode' => $request->countrycode,
            'birthday' => $request->birthday,
            'number' => $request->number,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'email'=>$request->email
        ]);
        return redirect()->route('user.account.edit');
    }

    public function chanage_password(Request $request){
        $user = auth()->user();

        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|different:old_password',
            'password_confirmation' => 'required|same:password'
        ]);
        if (Hash::check($request->old_password,$user->password)){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('success_msg','true');
        }
        return redirect()->back()->with('error_msg','true');

    }
    public function add_cart(Request $request){
        $user = auth()->user();
        $cart = UserCart::create([
            'user_id' => $user->id,
            'package_id' => $request->package_id,
            'date' => $request->date,
            'total_price' => $request->total_price,
        ]);
        for ($i = 1; $i < $request->count; $i++) {
            CartTicket::create([
                'cart_id' => $cart->id,
                'user_id' => $user->id,
                'ticket_id' => $request['ticket_'.$i],
                'quantity' => $request['quantity_'.$i],
            ]);
        }

        return redirect()->route('user.view.cart',['cart_id'=>$cart->id]);
    }
    public function book_prepare(Request $request){
        $user = auth()->user();
        $package = ProductPackage::find($request->package_id);
        $product = Product::find($package->product_id);
        $book = Book::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'total_price' => $request->total_price,
            'product' => $product->title,
            'package' => $package->title,
            'status' => 'start'
        ]);
//        dd($request);
        for ($i = 1; $i < $request->count; $i++) {
            BookTicket::create([
                'book_id' => $book->id,
                'user_id' => $user->id,
                'ticket_id' => $request['ticket_'.$i],
                'quantity' => $request['quantity_'.$i],
            ]);
        }

        return redirect()->route('user.view.payment',['book_id'=>$book->id]);
    }

    public function view_cart(Request $request){
        $cart = UserCart::find($request->cart_id);
        $package = ProductPackage::find($cart->package_id);
        $product = Product::find($package->product_id);
        $tickets = CartTicket::where('cart_id',$cart->id)->get();
        $recommed_product = Product::where('package', '<>', 0)->where('ticket', '<>', 0)->where('recommend','on')->inRandomOrder()->get();
        return view('user.view_carts',['cart'=>$cart,'tickets'=>$tickets,'package'=>$package,'product'=>$product,'recommed_product'=>$recommed_product]);
    }

    public function view_payment(Request $request){
        $book = Book::find($request->book_id);
        $tickets = BookTicket::where('book_id',$book->id)->get();
        $total_abp = 0;
        foreach ($tickets as $item) {
            $total_abp = $total_abp + PackageTicket::find($item->ticket_id)->abp_amount * $item->quantity;
        }
        $user = User::find($book->user_id);
        $country = Country::all();
        return view('user.view_books',['book'=>$book,'tickets'=>$tickets,'user'=>$user,'country'=>$country,'total_abp'=>$total_abp]);
    }
    public function paypal_success(Request $request){
        $book = Book::find($request->id);
        $tickets = BookTicket::where('book_id',$book->id)->get();
        $total_abp = 0;
        foreach ($tickets as $item) {
            $total_abp = $total_abp + PackageTicket::find($item->ticket_id)->abp_amount * $item->quantity;
        }
        $book->update(['status'=>'complete']);

        $user = User::find($book->user_id);
        if ($request->kind == 'only'){
            CreditsHistory::create([
                'date' => now(),
                'order_id' => $book->id,
                'from_user' => $user->username,
                'to_user' => $user->username,
                'detail' => 'check out',
                'amount' => 0-$book->total_price,
                'product_name' => $book->product
            ]);
        }
        else{
            CreditsHistory::create([
                'date' => now(),
                'order_id' => $book->id,
                'from_user' => $user->username,
                'to_user' => $user->username,
                'detail' => 'check out',
                'amount' => 0-$book->total_price+$total_abp/2.5,
                'product_name' => $book->product
            ]);
            if ($user->abp >= $total_abp){
                $user->update(['abp' => $user->abp-$total_abp]);

                AbpHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $user->username,
                    'detail' => 'check out',
                    'amount' => 0-$total_abp,
                    'product_name' => 'Add by Admin'
                ]);
            }
            else{
                $am_abp = $total_abp-$user->abp;
                $am_user = User::where('abp','>',$am_abp)->where('am_status','Yes')->inRandomOrder()->first();

                AbpHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $user->username,
                    'detail' => 'check out',
                    'amount' => 0-$user->abp,
                    'product_name' => 'Add by Admin'
                ]);
                AbpHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $am_user->username,
                    'detail' => 'Auto Matching System',
                    'amount' => 0-$am_abp,
                    'product_name' => 'Add by Admin'
                ]);
                CreditsHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $am_user->username,
                    'detail' => 'Auto Matching System',
                    'amount' => $am_abp/2.5,
                    'product_name' => $book->product
                ]);
                CreditsHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $user->username,
                    'detail' => 'Auto Matching System',
                    'amount' => -$am_abp/2.5,
                    'product_name' => $book->product
                ]);
                AutoReport::create([
                   'username' => $user->username,
                    'order_no' => $book->id,
                    'detail' => 'Auto Matching: '.$book->product,
                    'credit' => -$am_abp/2.5,
                    'abp' => $am_abp,
                ]);
                AutoReport::create([
                    'username' => $am_user->username,
                    'order_no' => $book->id,
                    'detail' => 'Auto Matching: '.$book->product,
                    'credit' => $am_abp/2.5,
                    'abp' => -$am_abp,
                ]);
                $am_user->update(['abp'=>$am_user->abp-$am_abp,'credits'=>$am_user->credits+$am_abp/2.5]);
                $user->update(['credits' =>  $user->credits-$book->total_price+$user->abp/2.5,'abp' => 0]);

            }
        }
        $user->update(['credits' => 0]);

        return response()->json([
            'status' => true,
        ]);
    }
    public function pay_credits_success(Request $request){
        $book = Book::find($request->id);
        $tickets = BookTicket::where('book_id',$book->id)->get();
        $total_abp = 0;
        foreach ($tickets as $item) {
            $total_abp = $total_abp + PackageTicket::find($item->ticket_id)->abp_amount * $item->quantity;
        }
        $book->update(['status'=>'complete']);

        $user = User::find($book->user_id);
        if ($request->kind == 'only'){
            CreditsHistory::create([
                'date' => now(),
                'order_id' => $book->id,
                'from_user' => $user->username,
                'to_user' => $user->username,
                'detail' => 'check out',
                'amount' => 0-$book->total_price,
                'product_name' => $book->product
            ]);
            $user->update(['credits' => $user->credits-$book->total_price]);
        }
        else{
            CreditsHistory::create([
                'date' => now(),
                'order_id' => $book->id,
                'from_user' => $user->username,
                'to_user' => $user->username,
                'detail' => 'check out',
                'amount' => 0-$book->total_price+$total_abp/2.5,
                'product_name' => $book->product
            ]);
            if ($user->abp >= $total_abp){
                $user->update(['abp' => $user->abp-$total_abp]);

                AbpHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $user->username,
                    'detail' => 'check out',
                    'amount' => 0-$total_abp,
                    'product_name' => 'Add by Admin'
                ]);
                $user->update(['credits' => $user->credits-$book->total_price+$total_abp/2.5]);
            }
            else{
                $am_abp = $total_abp-$user->abp;
                $am_user = User::where('abp','>',$am_abp)->where('am_status','Yes')->inRandomOrder()->first();

                AbpHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $user->username,
                    'detail' => 'check out',
                    'amount' => 0-$user->abp,
                    'product_name' => 'Add by Admin'
                ]);
                AbpHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $am_user->username,
                    'detail' => 'Auto Matching System',
                    'amount' => 0-$am_abp,
                    'product_name' => 'Add by Admin'
                ]);
                CreditsHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $am_user->username,
                    'detail' => 'Auto Matching System',
                    'amount' => $am_abp/2.5,
                    'product_name' => $book->product
                ]);
                CreditsHistory::create([
                    'date' => now(),
                    'order_id' => $book->id,
                    'from_user' => $user->username,
                    'to_user' => $user->username,
                    'detail' => 'Auto Matching System',
                    'amount' => -$am_abp/2.5,
                    'product_name' => $book->product
                ]);
                AutoReport::create([
                    'username' => $user->username,
                    'order_no' => $book->id,
                    'detail' => 'Auto Matching: '.$book->product,
                    'credit' => -$am_abp/2.5,
                    'abp' => $am_abp,
                ]);
                AutoReport::create([
                    'username' => $am_user->username,
                    'order_no' => $book->id,
                    'detail' => 'Auto Matching: '.$book->product,
                    'credit' => $am_abp/2.5,
                    'abp' => -$am_abp,
                ]);
                $am_user->update(['abp'=>$am_user->abp-$am_abp,'credits'=>$am_user->credits+$am_abp/2.5]);
                $user->update(['credits' =>  $user->credits-$book->total_price+$user->abp/2.5,'abp' => 0]);
            }

        }


        return response()->json([
            'status' => true,
        ]);
    }
}
