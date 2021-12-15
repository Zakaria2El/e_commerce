<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(){
        $languages=Language::selection()->orderBy('name')->paginate(PAGINATION_COUNT);
        return view('admin.languages.index',compact('languages'));

    }

    public function create(){
        return view('admin.languages.create');
    }
    public function save(LanguageRequest $request){
        try{
            if(!$request->has('active'))
                $request->request->add(['active'=>0]);

            Language::create($request->except(['_token']));
            return redirect(route('admin.languages'))->with(['success'=>'Language saved succes']);
        }catch (\Exception $ex){
            return redirect(route('admin.languages'))->with(['error'=>'Language saved failed']);


        }

    }

    public function edit($id){

        $language=Language::select()->find($id);
        if(!$language)
            return redirect(route('admin.languages'))->with(['error'=>'Language not exist ']);

        return view('admin.languages.edit',compact('language'));

    }

    public function update($id,LanguageRequest $request){
        try{

            $language=Language::find($id);
            if(!$language) {
                return redirect(route('admin.languages.edit', $id))->with(['error' => 'Language update failed']);
            }
            if(!$request->has('active')) {
                $request->request->add(['active' => 0]);
            }

            $language->update($request->except('_token'));
            return redirect(route('admin.languages'))->with(['success'=>'Language update succes']);


        }catch (\Exception $ex){
            return redirect(route('admin.languages'))->with(['error'=>'Language update failed']);
        }

    }
    public function delete($id)
    {
        try {
            $language = Language::find($id);
            if (!$language)
                return redirect(route('admin.languages', $id))->with(['error' => 'Language not exist']);


            $language->delete();
            return redirect(route('admin.languages'))->with(['success' => 'Language delete succes']);
        } catch (\Exception $ex) {
            return redirect(route('admin.languages'))->with(['error' => 'Language delete failed']);

        }
    }
}
