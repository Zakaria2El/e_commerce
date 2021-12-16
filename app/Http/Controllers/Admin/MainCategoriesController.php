<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoriesRequest;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainCategoriesController extends Controller
{
    public function index(){
        $default_lang=locale();
        $categories=MainCategory::where('translation_lang',$default_lang)->selection()->get();
        return view('admin.maincategories.index',compact('categories'));
    }
    public function create(){

        return view('admin.maincategories.create');
    }
    public function save(MainCategoriesRequest $request){
        try {
            $main_categories = collect($request->category);
            $filter = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] == locale();
            });
            $default_category = array_values($filter->all()) [0];
            //save photo
            $filePath = "";
            if ($request->has('photo')) {
                $filePath = uploadImage('maincategories', $request->photo);

            }
//            if(!$request->has('category.0.active'))
              //  $request->request->add(['active'=>0]);

            DB::beginTransaction();
            //Insert Category by default lang
            $default_category_id = MainCategory::insertGetId([
                'translation_lang' => $default_category['abbr'],
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath,
                //'active'=>$default_category['active'],
                'translation_of' => 0,

            ]);

            $categories = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] != locale();
            });
            if (isset($categories) && $categories->count() > 0) {
                $categories_array = [];
                foreach ($categories as $category) {
                    $categories_array[] = [
                        'translation_lang' => $category['abbr'],
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $filePath,
                        'translation_of' => $default_category_id,
                    ];

                }
                MainCategory::insert($categories_array);
            }
            DB::commit();
            return redirect()->route('admin.maincategories')->with(['success'=>'Main Category saved with succes']);
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('admin.maincategories')->with(['error'=>'Main Category save failed, please retry later']);

        }

    }
    public function edit($id){
        $maincategory=MainCategory::selection()->find($id);
        if(!$maincategory)
            return redirect()->route('admin.maincategories')->with(['error'=>'Main Category not found']);
        return view('admin.maincategories.edit',compact('maincategory'));

    }
    public function update($id, MainCategoriesRequest $request){

        $maincategory=MainCategory::with('categories') //relation to get all translations
            ->selection()
            ->find($id);
        if(!$maincategory)
            return redirect()->route('admin.maincategories.edit')->with(['error'=>'Main Category not found']);

        $category = array_values($request->category) [0];

        if(!$request->has('category.0.active'))
            $request->request->add(['active'=>0]);
        else $request->request->add(['active'=>1]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('maincategories', $request->photo);
            MainCategory::where('id',$id)->update([
                'photo' => $filePath,
            ]);

        }
        MainCategory::where('id',$id)->update([
            'name' => $category['name'],
            'slug' => $category['name'],
            'active'=>$request->active,

        ]);
        return redirect()->back()->with(['success'=>'Main Category updated']);
    }

    public function delete($id){
        try {
            $maincategory = MainCategory::find($id);
            if (!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'this Main category not found']);

            $vendors = $maincategory->vendors();
            if (isset($vendors) && $vendors->count() > 0) {
                return redirect()->route('admin.maincategories')->with(['error' => 'you can t delete this category']);
            }

            $image = Str::after($maincategory->photo, 'assets/');
            $image = base_path('assets/' . $image);
            unlink($image); //delete from folder

            $maincategory->categories()->delete();
            $maincategory->delete();
            return redirect()->route('admin.maincategories')->with(['success' => 'deleted with success']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'please retry later']);
        }
    }
    public function changeStatus($id)
    {
        try {

            $maincategory = MainCategory::find($id);
            if (!$maincategory)
                return redirect()->route('admin.maincategories')->with(['error' => 'this Main category not found ']);

            $status =  $maincategory -> active  == 0 ? 1 : 0;

            $maincategory -> update(['active' =>$status ]);

            return redirect()->route('admin.maincategories')->with(['success' => 'Change status with success ']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'please retry later']);
        }
    }
}
