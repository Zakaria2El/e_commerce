<?php

use Illuminate\Support\Facades\Config;

function show_name(){
    return 'name';
}
function get_languages(){
   return  \App\Models\Language::active()->selection()->get();
}

function locale(){
    return Config::get('app.locale');
}

function uploadImage($folder,$image){
    $image->store('/',$folder);
    $filename=$image->hashName();
    $path='images/'.$folder.'/'.$filename;
    return $path;
}
