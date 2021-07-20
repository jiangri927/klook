<?php

namespace App\Http\Controllers;

use App\Models\AbpHistory;
use App\Models\AutoReport;
use App\Models\City;
use App\Models\Country;
use App\Models\CreditsHistory;
use App\Models\MainCategory;
use App\Models\MainDestination;
use App\Models\PackageTicket;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductPackage;
use App\Models\Region;
use App\Models\SubCategory;
use App\Models\SubDestination;
use App\Models\User;
use App\Models\WelcomeGallery;
use App\Models\WelcomePage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    //


    public function index(Request $request)
    {
        // dd($request->active);
        return view('admin.index',['active'=>$request->active]);
    }

    public function get_user(Request $request){
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0);" class="edit btn btn-success btn-sm" data-id="'.$row->id.'">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->addColumn('statement', function($row){
                    $btn = '<a href="'.route("admin.user.credits.change",["user_id"=>$row->id]).'" class="btn btn-info btn-sm">Credits</a> <a href="'.route("admin.user.abp.change",["user_id"=>$row->id]).'" class=" btn btn-info btn-sm">ABP</a>';
                    return $btn;})
                ->addColumn('edit', function($row){
                    $btn = '<a href="javascript:void(0);" class="edit btn admin-action btn-success btn-sm" data-id="'.$row->id.'">Edit</a>';
                    return $btn;})
                ->rawColumns(['statement','action','edit'])
                ->make(true);
        }
        return view('admin.index');
    }
    public function get_products(Request $request){
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0);" class="edit btn btn-success btn-sm" data-id="'.$row->id.'">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.index');
    }
    public function get_credits_history(Request $request){
        if ($request->ajax()) {
            $data = CreditsHistory::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.index');
    }
    public function get_report(Request $request){
        if ($request->ajax()) {
            $data = AutoReport::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.index');
    }

    public function get_abp_history(Request $request){
        if ($request->ajax()) {
            $data = AbpHistory::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.index');
    }


    public function edit_user_management(Request $request){
        $user = User::find($request->user_id);
        return view('admin.user.edit_setting',['user'=>$user]);
    }
    public function store_user_aiva(Request $request){
        $user = User::find($request->user_id);
        $user->update([
            'am_status' => $request->am_status,
            'aiva_username' => $request->aiva_username,
        ]);
        return redirect()->route('admin',['active'=>'credits']);
    }
    public function store_user_profile(Request $request){
        $user = User::find($request->user_id);
        $user->update([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'country' => $request->country,
            'title' => $request->title,
            'countryCode' => $request->countryCode,
            'number' => $request->number,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'birthday' => $request->birthday,
            'aiva_username' => $request->aiva_username,
        ]);
        return redirect()->back();
    }

    public function add_user_credits(Request $request){
        $user = User::find($request->user_id);
        $user->update(['credits'=>$user->credits+$request->amount]);
        $credits_history = CreditsHistory::create([
            'date' => now(),
            'order_id' => 0,
            'from_user' => 'Admin',
            'to_user' => $user->username,
            'detail' => $request->reason,
            'amount' => $request->amount,
            'product_name' => 'Added by Admin'
        ]);
        return redirect()->route('admin',['active'=>'credits']);
    }
    public function substract_user_credits(Request $request){
        $user = User::find($request->user_id);
        $user->update(['credits'=>$user->credits-$request->amount]);
        $credits_history = CreditsHistory::create([
            'date' => now(),
            'order_id' => 0,
            'from_user' => 'Admin',
            'to_user' => $user->username,
            'detail' => $request->reason,
            'amount' => 0-$request->amount,
            'product_name' => 'Subtracted by Admin'
        ]);
        return redirect()->route('admin',['active'=>'credits']);
    }
    public function transfer_user_credits(Request $request){
        $user = User::find($request->user_id);
        $user->update(['credits'=>$user->credits-$request->amount]);
        $to_user = User::where('username',$request->to_username)->first();
        $to_user->update(['credits'=>$to_user->credits+$request->amount]);
        $credits_history = CreditsHistory::create([
            'date' => now(),
            'order_id' => 0,
            'from_user' => $user->username,
            'to_user' => $to_user->username,
            'detail' => 'Credit Transfer from '.$user->username. ' to '.$to_user->username,
            'amount' => $request->amount,
            'product_name' => 'Transferred by Admin'
        ]);
        return redirect()->route('admin',['active'=>'credits']);
    }
    public function add_user_abp(Request $request){
        $user = User::find($request->user_id);
        $user->update(['abp'=>$user->abp+$request->amount]);
        $credits_history = AbpHistory::create([
            'date' => now(),
            'order_id' => 0,
            'from_user' => 'Admin',
            'to_user' => $user->username,
            'detail' => $request->reason,
            'amount' => $request->amount,
            'product_name' => 'Added by Admin'
        ]);
        return redirect()->route('admin',['active'=>'credits']);
    }
    public function substract_user_abp(Request $request){
        $user = User::find($request->user_id);
        $user->update(['abp'=>$user->abp-$request->amount]);
        $credits_history = AbpHistory::create([
            'date' => now(),
            'order_id' => 0,
            'from_user' => 'Admin',
            'to_user' => $user->username,
            'detail' => $request->reason,
            'amount' => 0-$request->amount,
            'product_name' => 'Subtracted by Admin'
        ]);
        return redirect()->route('admin',['active'=>'credits']);
    }
    public function get_username(Request $request){
        $users = User::all();
        return response()->json([
            'status' => true,
            'users' => $users,
        ]);
    }
    public function transfer_user_abp(Request $request){
        $user = User::find($request->user_id);
        $user->update(['abp'=>$user->abp-$request->amount]);
        $to_user = User::where('username',$request->to_username)->first();
        $to_user->update(['abp'=>$to_user->abp+$request->amount]);
        $credits_history = AbpHistory::create([
            'date' => now(),
            'order_id' => 0,
            'from_user' => $user->username,
            'to_user' => $to_user->username,
            'detail' => 'Transfered by admin',
            'amount' => $request->amount,
            'product_name' => 'Transferred by Admin'
        ]);
        return redirect()->route('admin',['active'=>'credits']);
    }
    public function store_user_credits(Request $request){
        $user = User::find($request->user_id);
        if($user->credits != $request->credits){
            $credits_history = CreditsHistory::create([
                'date' => now(),
                'order_id' => 0,
                'from_user' => 'Admin',
                'to_user' => $user->username,
                'detail' => 'Credit add by Admin',
                'amount' => $request->credits-$user->credits,
                'product_name' => 'Add by Admin'
            ]);
        }
        if($user->abp != $request->abp){
            $credits_history = AbpHistory::create([
                'date' => now(),
                'order_id' => 0,
                'from_user' => 'Admin',
                'to_user' => $user->username,
                'detail' => 'ABP add by Admin',
                'amount' => $request->abp-$user->abp,
                'product_name' => 'Add by Admin'
            ]);
        }
        $user->update([
            'credits' => $request->credits,
            'abp' => $request->abp,
            'am_status' => $request->am_status,
        ]);
        return redirect()->route('admin',['active'=>'credits']);
    }
    public function store_user_management(Request $request){
        $user = User::find($request->user_id);
        $user->update([
            'email' => $request->email,
            'am_status' => $request->am_status,
            'username' => $request->username,
        ]);
        return redirect()->back();
    }
    public function delete_user(Request $request){
        User::find($request->user_id)->delete();
        return response()->json(['status' => true]);
    }

    public function change_username(Request $request){
        $request->validate([
            'username' => 'required|unique:users',
            'confirm_username' => 'required|same:username'

        ]);

        try{
            User::find($request->user_id)->update(['username'=> $request->username]);
            return redirect()->route('admin',['active'=>'management']);
        }
        catch (Exception $e){
            return redirect()->back();
        }
    }
    public function change_email(Request $request){
        $request->validate([
            'email' => 'required|unique:users',
            'confirm_email' => 'required|same:email'

        ]);

        try{
            User::find($request->user_id)->update(['email'=> $request->email]);
            return redirect()->route('admin',['active'=>'management']);
        }
        catch (Exception $e){
            return redirect()->back();
        }
    }
    public function change_password(Request $request){
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'

        ]);

        try{
            User::find($request->user_id)->update(['password'=> Hash::make($request->password)]);
            return redirect()->route('admin',['active'=>'management']);
        }
        catch (Exception $e){
            return redirect()->back();
        }
    }

    public function change_am_status(Request $request){
        $user = User::find($request->user_id);
        $user->update(['am_status' => $request->am_status]);
        return redirect()->route('admin',['active'=>'management']);
    }
    public function change_status(Request $request){
        $user = User::find($request->user_id);
        $user->update(['status' => $request->status]);
        return redirect()->route('admin',['active'=>'management']);
    }
    public function admin_detail(Request $request)
    {
        $users = User::all();
        $country = Country::get();

        $users_html = view('admin.user.users', ['users' => $users,'country' =>$country])->render();
        $management_html = view('admin.user.management')->render();
        $credits_html = view('admin.user.credits')->render();
        $credits_history_html = view('admin.user.credits_history')->render();
        $abp_history_html = view('admin.user.abp_history')->render();
        $products = Product::all();
        $products_html = view('admin.products.products')->render();
        $category = MainCategory::all();
        $welcome = WelcomePage::first();
        $region = Region::all();
        $subcategory = SubCategory::all();
        $main_dest = MainDestination::all();
        $sub_dest = SubDestination::all();
        $category_html = view('admin.category',['category'=>$category,'welcome'=>$welcome,'region'=>$region,'main_dest'=>$main_dest,'sub_dest'=>$sub_dest,'subcategory'=>$subcategory])->render();
        $report = AutoReport::all();
        $report_html = view('admin.user.am_report')->render();
        return response()->json([
            'status' => true,
            'users_html' => $users_html,
            'management_html' => $management_html,
            'credits_html' => $credits_html,
            'credits_history_html' => $credits_history_html,
            'abp_history_html' => $abp_history_html,
            'products_html' => $products_html,
            'category_html' => $category_html,
            'report_html' => $report_html,
        ]);
    }

    public function add_product()
    {
        $region = Region::all();

        $category = MainCategory::all();
        return view('admin.add_product', ['region' => $region, 'category' => $category]);
    }
    public function store_product(Request $request)
    {
//         dd($request);
        $request->validate([
            'title' => 'required',
            'region' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'city' => 'required',
            'country' => 'required',
            'info' => 'required',
        ]);
        try {
            $product = Product::updateOrCreate(
                ['id' => $request->product_id],
                [
                    'title' => $request->title,
                    'info' => $request->info,
                    'category' => $request->category,
                    'subcategory' => $request->subcategory,
                    'city' => $request->city,
                    'country' => $request->country,
                    'region' => $request->region,
                    'things' => $request->things,
                    'look_for' => $request->look_for,
                    'faq' => $request->faq,
                    'top_thing' => $request->top_thing == 'on' ? 'on' : 'off',
                    'recommend' => $request->recommend == 'on' ? 'on' : 'off',
                    'status' => $request->status,
                ]
            );
            if (!empty($request->gallery)) {
                $product_gallery_ids = $request->gallery;
                ProductGallery::where('product_id',$product->id)->update(['product_id'=>null]);
                ProductGallery::whereIn('id', $product_gallery_ids)->update(['product_id' => $product->id]);
            }
            if (!empty($request->product_id))
                return redirect()->route('admin',['active'=>'products']);
            return redirect()->route('admin.setup.package', ['product_id' => $product->id]);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
        //        return view('admin.text',['product'=>$product]);
    }

    public function get_city(Request $request)
    {
        $country = MainDestination::where('title',$request->country)->first();
        $city = SubDestination::where('main_destination_id', $country->id)->get();
        return response()->json([
            'status' => 'success',
            'city' => $city
        ]);
    }
    public function get_country(Request $request)
    {
        $region = Region::where('title',$request->region)->first();
        $country = MainDestination::where('region_id',$region->id)->get();
        return response()->json([
            'status' => 'success',
            'country' => $country,
        ]);
    }
    public function get_subcategory(Request $request)
    {
        $category = MainCategory::where('title',$request->main_category)->first();
        $subcategory = SubCategory::where('parent_id', $category->id)->get();
        return response()->json([
            'status' => 'success',
            'subcategory' => $subcategory,
        ]);
    }
    public function upload_gallery(Request $request)
    {
        $input = Input::all();
        $user = auth()->user();
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $filename = $file->getClientOriginalName();
            $upload_filename = time() . '.' . $file->extension();

            $input['imagename'] = $upload_filename;
            $destinationPath = public_path('gallery');

            $upload_success = $file->move($destinationPath, $input['imagename']);

            if ($upload_success) {
                $upload = ProductGallery::create([
                    'gallery_url' => asset('gallery/' . $upload_filename),
                    'extension' => pathinfo($filename, PATHINFO_EXTENSION),
                    'kind' => $request->kind,
                ]);
                return response()->json([
                    "status" => "success",
                    "upload_id" => $upload->id,
                    'url' => asset('gallery/' . $upload_filename),
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

    public function upload_gallery_setting(Request $request){
        $input = Input::all();
        $user = auth()->user();
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $filename = $file->getClientOriginalName();
            $upload_filename = time() . '.' . $file->extension();

            $input['imagename'] = $upload_filename;
            $destinationPath = public_path('gallery');

            $upload_success = $file->move($destinationPath, $input['imagename']);

            if ($upload_success) {
                $upload = WelcomeGallery::create([
                    'path' => asset('gallery/' . $upload_filename),
                    'extension' => pathinfo($filename, PATHINFO_EXTENSION),
                    'name' => $filename,
                    'kind' => $request->kind,
                    'index' => $request->index,
                ]);
                return response()->json([
                    "status" => "success",
                    'url' => asset('gallery/' . $upload_filename),
                    "id" => $upload->id,
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

    public function setup_package(Request $request)
    {
        $product = Product::find($request->product_id);
        return view('admin.setup_package', ['product' => $product])->with('success', 1);
    }

    public function store_package(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'info' => 'required',
            'description' => 'required',
            'terms' => 'required',
            'availability' => 'required',
            'guide' => 'required',

        ]);
        try {
            $package = ProductPackage::updateOrCreate(
                ['id'=>$request->package_id],
                [
                    'product_id' => $request->product_id,
                    'title' => $request->title,
                    'info' => $request->info,
                    'description' => $request->description,
                    'availability' => $request->availability,
                    'terms' => $request->terms,
                    'guide' => $request->guide,
                ]);
            $product = Product::find($request->product_id);
            if (!empty($request->package_id)){
                return redirect()->route('admin',['active'=>'products']);
            }
            else
            {
                $product->update(['package' => $product->package + 1]);
                return redirect()->route('admin.add.ticket', ['package_id' => $package->id]);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
    public function add_package(Request $request)
    {
        $package = ProductPackage::find($request->package_id);
        $product = Product::find($package->product_id);
        return view('admin.add_ticket', ['product' => $product, 'package' => $package]);
    }
    public function change_ticket(Request $request){
        $ticket = PackageTicket::find($request->ticket_id);
        $ticket->update([
            'title' => $request->title,
            'm_price' => $request->m_price,
            'o_price' => $request->o_price,
            'o_percent' => $request->o_percent,
            'abp_price' => $request->abp_price,
            'abp_amount' => $request->abp_amount,
            'abp_percent' => $request->abp_percent,
        ]);
        return redirect()->route('admin',['active'=>'products']);
    }
    public function store_ticket(Request $request)
    {
//        dd($request);
        $package = ProductPackage::find($request->package_id);

        $product = Product::find($package->product_id);

        for ($i = 1; $i < $request->counts + 1; $i++) {
            PackageTicket::create([
                'package_id' => $request->package_id,
                'title' => $request['title' . $i],
                'm_price' => $request['m_price' . $i],
                'o_price' => $request['o_price' . $i],
                'o_percent' => $request['o_percent' . $i],
                'abp_price' => $request['abp_price' . $i],
                'abp_amount' => $request['abp_amount' . $i],
                'abp_percent' => $request['abp_percent' . $i],
            ]);
            $product->update(['ticket' => $product->ticket + 1]);
            $package->update(['ticket' => $package->ticket + 1]);
        }

        if (!empty($request->addNewPk))
            return redirect()->route('admin.setup.package', ['product_id' => $product->id]);
        else
            return redirect()->route('admin',['active'=>'products']);
    }

    public function delete_product(Request $request)
    {
        $product = Product::find($request->product_id);
        $package = ProductPackage::where('product_id',$product->id)->get();
        PackageTicket::whereIn('package_id',$package->pluck('id'))->delete();
        ProductPackage::where('product_id',$product->id)->delete();
        ProductGallery::where('product_id',$request->product_id)->delete();
        $product->delete();
        return redirect()->route('admin',['active'=>'products']);
    }
    public function delete_package(Request $request)
    {
        $package = ProductPackage::find($request->package_id);
        $ticket_counts = PackageTicket::where('package_id',$package->id)->count();
        PackageTicket::whereIn('package_id',$package->pluck('id'))->delete();
        $product = Product::find($package->product_id);
        $product->update(['package'=>$product->package-1,'ticket'=>$product->ticket-$ticket_counts]);
        $package->delete();
        return redirect()->route('admin',['active'=>'products']);
    }
    public function delete_ticket(Request $request){
        $ticket = PackageTicket::find($request->ticket_id);
        $package = ProductPackage::find($ticket->package_id);
        $product = Product::find($package->product_id);
        $product->update(['ticket'=>$product->ticket-1]);
        $package->update(['ticket'=>$package->ticket-1]);
        $ticket->delete();
        return redirect()->back();
    }

    function edit_product(Request $request)
    {
        $product = Product::find($request->product_id);
        $region = Region::get();

        $category = MainCategory::get();
        return view('admin.products.edit_product', ['product' => $product, 'region' => $region, 'category' => $category]);
    }

    public function edit_maincategory(Request $request){
        $category = MainCategory::find($request->category_id);
        $subcategory = SubCategory::where('parent_id',$category->id)->get();
        return view('admin.category.edit_maincategory',['category'=>$category,'subcategory'=>$subcategory]);
    }
    public function edit_subcategory(Request $request){
        $subcategory = SubCategory::find($request->category_id);
        $category = MainCategory::find($subcategory->parent_id);
        return view('admin.category.edit_subcategory',['category'=>$category,'subcategory'=>$subcategory]);
    }
    function edit_package(Request $request)
    {
        $package = ProductPackage::find($request->package_id);
        $product = Product::find($package->product_id);
        $date = [];

        $array = explode(',',$package->availability);
        foreach($array as $value){
            array_push($date,$value);
        }
        return view('admin.products.edit_package', ['package'=>$package,'product'=>$product,'dates'=>$date]);
    }
    public function edit_ticket(Request $request){
        $ticket = PackageTicket::find($request->ticket_id);
        $package = ProductPackage::find($ticket->package_id);
        $product = Product::find($package->product_id);

        return view('admin.products.edit_ticket',['package'=>$package,'product'=>$product,'ticket'=>$ticket]);

    }
    public function add_category(Request $request){
        return view('admin.category.add_category');
    }

    public function store_category(Request $request){
        $request->validate([
            'title'=>'required',
        ]);
        try{
            $category = MainCategory::updateOrCreate(
                ['id'=>$request->category_id],
                [
                    'title' => $request->title,
                    'info' => $request->info,
                    'promo1' => $request->promo1,
                    'promo2' => $request->promo2,

                ]);
            if (!empty($request->gallery)) {
                $gallery_ids = $request->gallery;
                WelcomeGallery::where('kind_id',$category->id)->where('kind','main_category')->update(['kind_id'=>null]);
                WelcomeGallery::whereIn('id', $gallery_ids)->update(['kind_id' => $category->id]);
            }
            else{
                WelcomeGallery::where('kind_id',$category->id)->where('kind','main_category')->update(['kind_id'=>null]);
            }
            if (!empty($request->addSub))
                return redirect()->route('admin.add.subcategory',['category_id'=>$category->id]);
            else
                return redirect()->route('admin',['active'=>'category']);
        }
        catch (Exception $exception){
            return redirect()->back();
        }
    }

    public function add_subcategory(Request $request){
        $category = MainCategory::find($request->category_id);
        return view('admin.category.add_subcategory',['category'=>$category]);
    }
    public function store_subcategory(Request $request){
        $request->validate([
            'title'=>'required',
        ]);
        try{
            $subcategory = SubCategory::updateOrCreate(
                ['id'=>$request->category_id],
                [
                    'title' => $request->title,
                    'parent_id' => $request->main_category,
                ]);
            if (!empty($request->gallery)) {
                $gallery_ids = $request->gallery;
                WelcomeGallery::where('kind_id',$subcategory->id)->where('kind','sub_category')->update(['kind_id'=>null]);
                WelcomeGallery::whereIn('id', $gallery_ids)->update(['kind_id' => $subcategory->id]);
            }
            if (!empty($request->addSub))
                return redirect()->route('admin.add.subcategory',['category_id'=>$request->main_category])->with('success_msg',$subcategory->title);
            else
                return redirect()->route('admin',['active'=>'category']);
        }
        catch (Exception $exception){
            return redirect()->back();
        }
    }

    public function delete_maincategory (Request $request){
        $category = MainCategory::find($request->category_id);
        $subcategory = SubCategory::where('parent_id',$category->id)->get();
        WelcomeGallery::whereIn('kind_id',$subcategory->pluck('id'))->where('kind','sub_category')->delete();
        WelcomeGallery::where('kind_id',$category->id)->where('kind','main_category')->delete();
        SubCategory::where('parent_id',$category->id)->delete();
        $category->delete();

        return redirect()->route('admin',['active'=>'category']);

    }

    public function delete_subcategory(Request $request){
        $subcategory = SubCategory::find($request->category_id);
        $category = MainCategory::find($subcategory->parent_id);
        WelcomeGallery::where('kind_id',$subcategory->id)->where('kind','sub_category')->delete();
        $subcategory->delete();
        return redirect()->route('admin',['active'=>'category']);
    }

    public function setup_welcome(){
        return view('admin.welcome.setup');
    }

    public function save_welcome(Request $request){
        $welcome = WelcomePage::updateOrCreate(
            ['id'=>$request->id],
            [
                'promo' => $request->promo,
                'other_info' => $request->other_info,
            ],
            );

        if (!empty($request->gallery)) {
            $gallery_ids = $request->gallery;
            WelcomeGallery::where('kind_id',$welcome->id)->where('kind','welcome')->update(['kind_id'=>null]);
            WelcomeGallery::whereIn('id', $gallery_ids)->update(['kind_id' => $welcome->id]);
        }
        else
            WelcomeGallery::where('kind','welcome')->delete();

        return redirect()->route('admin',['active'=>'category']);
    }

    public function edit_welcome(){
        $welcome = WelcomePage::first();
        return view('admin.welcome.setup',['welcome'=>$welcome]);
    }

    public function add_region(){
        return view('admin.destination.add_region');
    }
    public function save_region(Request $request){
        $request->validate([
            'title' => 'required'
        ]);
        try{
            $region = Region::updateOrCreate(
                ['id' => $request->region_id],
                [
                    'title' => $request->title,
                    'info' => $request->info,
                ],
                );
            if (!empty($request->gallery)) {
                $gallery_ids = $request->gallery;
                WelcomeGallery::where('kind_id',$region->id)->where('kind','region')->update(['kind_id'=>null]);
                WelcomeGallery::whereIn('id', $gallery_ids)->update(['kind_id' => $region->id]);
            }
            else
                WelcomeGallery::where('kind','region')->where('kind_id',$region->id)->delete();
            return redirect()->route('admin.m_dest.add',['region_id'=>$region->id]);
        }
        catch (Exception $exception){
            return redirect()->back();
        }
    }
    public function edit_region(Request $request){
        $region = Region::find($request->region_id);
        return view('admin.destination.add_region',['region'=>$region]);
    }
    public function delete_region(Request $request){
        $region = Region::find($request->region_id);
        $m_dest = MainDestination::where('region_id',$region->id)->get();
        $s_dest = SubDestination::where('region_id',$region->id)->get();
        WelcomeGallery::where('kind','m_dest')->whereIn('kind_id',$m_dest->pluck('id'))->delete();
        WelcomeGallery::where('kind','s_dest')->whereIn('kind_id',$s_dest->pluck('id'))->delete();
        WelcomeGallery::where('kind','region')->where('kind_id',$region->id)->delete();
        SubDestination::where('region_id',$region->id)->delete();
        MainDestination::where('region_id',$region->id)->delete();
        $region->delete();
        return redirect()->route('admin',['active'=>'category']);

    }

    public function add_m_dest(Request $request){
        $region = Region::find($request->region_id);
        return view('admin.destination.add_m_dest',['region'=>$region]);
    }

    public function save_m_dest(Request $request){
        $request->validate([
            'title' => 'required'
        ]);
        try{
            $m_dest = MainDestination::updateOrCreate(
                ['id' => $request->m_dest_id],
                [
                    'title' => $request->title,
                    'info' => $request->info,
                    'region_id' => $request->region_id,
                ],
                );
            if (!empty($request->gallery)) {
                $gallery_ids = $request->gallery;
                WelcomeGallery::where('kind_id',$m_dest->id)->where('kind','m_dest')->update(['kind_id'=>null]);
                WelcomeGallery::whereIn('id', $gallery_ids)->update(['kind_id' => $m_dest->id]);
            }
            else
                WelcomeGallery::where('kind','m_dest')->where('kind_id',$m_dest->id)->delete();
            return redirect()->route('admin.s_dest.add',['m_dest_id'=>$m_dest->id]);
        }
        catch (Exception $exception){
            return redirect()->back();
        }
    }
    public function edit_m_dest(Request $request){
        $m_dest = MainDestination::find($request->m_dest_id);
        $region = Region::find($m_dest->region_id);
        return view('admin.destination.add_m_dest',['region'=>$region,'m_dest'=>$m_dest]);
    }
    public function delete_m_dest(Request $request){
        $m_dest = MainDestination::find($request->m_dest_id);
        $s_dest = SubDestination::where('main_destination_id',$m_dest->id)->get();
        WelcomeGallery::where('kind','m_dest')->where('kind_id',$m_dest->id)->delete();
        WelcomeGallery::where('kind','s_dest')->whereIn('kind_id',$s_dest->pluck('id'))->delete();
        SubDestination::where('main_destination_id',$m_dest->id)->delete();
        $m_dest->delete();
        return redirect()->back();
    }

    public function add_s_dest(Request $request){
        $m_dest = MainDestination::find($request->m_dest_id);
        $region = Region::find($m_dest->region_id);
        return view('admin.destination.add_s_dest',['m_dest'=>$m_dest,'region'=>$region]);
    }

    public function save_s_dest(Request $request){
        $request->validate([
            'title' => 'required'
        ]);
        try{
            $s_dest = SubDestination::updateOrCreate(
                ['id' => $request->s_dest_id],
                [
                    'title' => $request->title,
                    'promo1' => $request->promo1,
                    'promo2' => $request->promo2,
                    'info1' => $request->info1,
                    'info2' => $request->info2,
                    'region_id' => $request->region_id,
                    'main_destination_id' => $request->m_dest_id,
                ],
                );
            if (!empty($request->gallery)) {
                $gallery_ids = $request->gallery;
                WelcomeGallery::where('kind_id',$s_dest->id)->where('kind','s_dest')->update(['kind_id'=>null]);
                WelcomeGallery::whereIn('id', $gallery_ids)->update(['kind_id' => $s_dest->id]);
            }
            else
                WelcomeGallery::where('kind','s_dest')->where('kind_id',$s_dest->id)->delete();
            return redirect()->route('admin.s_dest.add',['m_dest_id'=>$request->m_dest_id]);
        }
        catch (Exception $exception){
            return redirect()->back();
        }
    }
    public function edit_s_dest(Request $request){
        $s_dest = SubDestination::find($request->s_dest_id);
        $m_dest = MainDestination::find($s_dest->main_destination_id);
        $region = Region::find($s_dest->region_id);
        return view('admin.destination.add_s_dest',['m_dest'=>$m_dest,'region'=>$region,'s_dest'=>$s_dest]);
    }
    public function delete_s_dest(Request $request){
        $s_dest = SubDestination::find($request->s_dest_id);
        WelcomeGallery::where('kind','s_dest')->where('kind_id',$s_dest->id)->delete();
        $s_dest->delete();
        return redirect()->back();
    }

    public function change_user_credits(Request $request){
        $user = User::find($request->user_id);
        $history = CreditsHistory::where('from_user',$user->username)->orWhere('to_user',$user->username)->get();
//        dd($history);
        $users = User::all();
        $usernames ='';
        foreach ($users as $item){
            $usernames = $usernames.','.$item->username;
        }
//        dd($usernames);
        return view('admin.user.change_credits',['user'=>$user,'history'=>$history,'usernames'=>$usernames]);
    }
    public function change_user_abp(Request $request){
        $user = User::find($request->user_id);
        $history = AbpHistory::where('from_user',$user->username)->orWhere('to_user',$user->username)->get();
        $users = User::all();
        $usernames ='';
        foreach ($users as $item){
            $usernames = $usernames.','.$item->username;
        }
        return view('admin.user.change_abp',['user'=>$user,'history'=>$history,'usernames'=>$usernames]);
    }
}
