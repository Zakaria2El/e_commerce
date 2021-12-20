<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use App\Notifications\VendorCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class VendorsController extends Controller
{
    public function index(){
        $vendors=Vendor::selection()->paginate(PAGINATION_COUNT);
        return view('admin.vendors.index',compact('vendors'));
    }

    public function create(){
        $categories=MainCategory::where('translation_lang',locale())->orderBy('name')->active()->get();

        return view('admin.vendors.create',compact('categories'));
    }

    public function save(VendorRequest  $request){
       // try {
            //return $request;
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $filePath = "";
            if ($request->has('logo')) {
                $filePath = uploadImage('vendors', $request->logo);
            }

            $vendor = Vendor::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'active' => $request->active,
                'address' => $request->address,
                'logo' => $filePath,
                'password' => $request->password,
                'category_id' => $request->category_id,
//                'latitude' => $request->latitude,
//                'longitude' => $request->longitude,
            ]);

            Notification::send($vendor, new VendorCreated($vendor));

            return redirect()->route('admin.vendors')->with(['success' => 'vendor saved with success']);

//        } catch (\Exception $ex) {
//
//            return redirect()->route('admin.vendors')->with(['error' => 'Error please retry later']);
//
//        }
    }

    public function edit($id){

//        try {
                $vendor=Vendor::selection()->find($id);
                if(!$vendor)
                    return redirect()->route('admin.vendors')->with(['error' => 'this vendor not found']);
                  $categories=MainCategory::where('translation_lang',locale())->orderBy('name')->active()->get();

                return view('admin.vendors.edit',compact('categories','vendor'));
//        }
//        catch (\Exception $ex){
//             return redirect()->route('admin.vendors')->with(['error' => 'Error please retry later']);
//        }
    }

    public function update($id, VendorRequest $request)
    {
        try {

            $vendor = Vendor::Selection()->find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'vendor not found ']);


            DB::beginTransaction();
            //photo
            if ($request->has('logo') ) {
                $filePath = uploadImage('vendors', $request->logo);
                Vendor::where('id', $id)
                    ->update([
                        'logo' => $filePath,
                    ]);
            }


            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $data = $request->except('_token', 'id', 'logo', 'password');


            if ($request->has('password') && !is_null($request->  password)) {

                $data['password'] = $request->password;
            }

            Vendor::where('id', $id)
                ->update(
                    $data
                );

            DB::commit();
            return redirect()->route('admin.vendors')->with(['success' => 'updated success']);
        } catch (\Exception $exception) {
            //return $exception;
            DB::rollback();
            return redirect()->route('admin.vendors')->with(['error' => 'Please retry later ']);
        }


    }

    public function delete($id){
        try {
            $vendor = Vendor::find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'this vendor not found']);



            $image = Str::after($vendor->logo, 'assets/');
            $image = public_path('assets/' . $image);
            unlink($image); //delete from folder



            $vendor->delete();
            return redirect()->route('admin.vendors')->with(['success' => 'deleted with success']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.vendors')->with(['error' => 'please retry later']);
        }
    }
    public function changeStatus($id)
    {
        try {

            $vendor = Vendor::find($id);
            if (!$vendor)
                return redirect()->route('admin.vendors')->with(['error' => 'this Main category not found ']);

            $status =  $vendor -> active  == 0 ? 1 : 0;

            $vendor -> update(['active' =>$status ]);

            return redirect()->route('admin.vendors')->with(['success' => 'Change status with success ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.vendors')->with(['error' => 'please retry later']);
        }
    }
}
