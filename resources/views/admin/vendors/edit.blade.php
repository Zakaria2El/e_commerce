@extends('layouts.admin')
@section('title','Update vendor')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Principal </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> Vendors </a>
                                </li>
                                <li class="breadcrumb-item active">Update Vendor
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> Update vendor {{$vendor->name}} </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.vendors.update',$vendor->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$vendor->id}}" type="hidden">

                                            <div class="form-group">
                                                <div class="text-left ">
                                                    <img class="rounded-circle" width="200px" height="200px" src="{{$vendor->logo}}">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label> Photo </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="logo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('logo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="la la-home"></i> Vendor data </h4>


                                                <div class="row">


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Name </label>
                                                            <input type="text" value="{{$vendor->name}}" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Main category </label>
                                                            <select name="category_id" class="select2 form-control">
                                                                <optgroup label="Please chose category ">
                                                                    @if($categories && $categories -> count() > 0)
                                                                        @foreach($categories as $category)
                                                                            <option value="{{$category -> id }}" @if($category -> id==$vendor->category_id) selected @endif>
                                                                                {{$category -> name}}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('category_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Email </label>
                                                            <input type="text" id="email"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value=" {{$vendor->email}}"
                                                                   name="email">

                                                            @error("email")
                                                            <span class="text-danger"> {{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Mobile </label>
                                                            <input type="text" id="mobile"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$vendor->mobile}} "
                                                                   name="mobile">

                                                            @error("mobile")
                                                            <span class="text-danger"> {{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="class col-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Password  </label>
                                                            <input type="password" id="password"
                                                                   class="form-control"
                                                                   placeholder="  " name="password">

                                                            @error("password")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> address  </label>
                                                            <input type="text" id="pac-input"
                                                                   class="form-control" value="{{$vendor->address}}"
                                                                   placeholder="  " name="address">


                                                            @error("address")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox" value="1"
                                                                       name="active"
                                                                       id="switcheryColor4"
                                                                       class="switchery" data-color="success"
                                                                       @if($vendor->active==1)checked/@endif>
                                                                <label for="switcheryColor4"
                                                                       class="card-title ml-1">Statue   </label>

                                                                @error("active")
                                                                <span class="text-danger"> </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>

                                                {{--                                            Map Google--}}
                                                <div id="map" style="height: 500px;width: 1000px;"></div>


                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1"
                                                            onclick="history.back();">
                                                        <i class="ft-x"></i> Back
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
{{--@section('content')--}}
{{--    <div class="app-content content">--}}
{{--        <div class="content-wrapper">--}}
{{--            <div class="content-header row">--}}
{{--                <div class="content-header-left col-md-6 col-12 mb-2">--}}
{{--                    <div class="row breadcrumbs-top">--}}
{{--                        <div class="breadcrumb-wrapper col-12">--}}
{{--                            <ol class="breadcrumb">--}}
{{--                                <li class="breadcrumb-item"><a href="">Principal </a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item"><a href=""> Main Categories </a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item active">Update Main Category--}}
{{--                                </li>--}}
{{--                            </ol>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="content-body">--}}
{{--                <!-- Basic form layout section start -->--}}
{{--                <section id="basic-form-layouts">--}}
{{--                    <div class="row match-height">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h4 class="card-title" id="basic-layout-form"> Update Main Category {{$vendor->name}} </h4>--}}
{{--                                    <a class="heading-elements-toggle"><i--}}
{{--                                            class="la la-ellipsis-v font-medium-3"></i></a>--}}
{{--                                    <div class="heading-elements">--}}
{{--                                        <ul class="list-inline mb-0">--}}
{{--                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
{{--                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
{{--                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>--}}
{{--                                            <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                @include('admin.includes.alerts.success')--}}
{{--                                @include('admin.includes.alerts.errors')--}}
{{--                                <div class="card-content collapse show">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <form class="form" action="{{route('admin.maincategories.update',$maincategory->id)}}"--}}
{{--                                              method="POST"--}}
{{--                                              enctype="multipart/form-data">--}}
{{--                                            @csrf--}}
{{--                                            <input name="id" value="{{$maincategory->id}}" type="hidden">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <div class="text-left">--}}
{{--                                                    <img class="rounded-circle" width="200px" height="200px" src="{{$maincategory->photo}}">--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label> Photo </label>--}}
{{--                                                <label id="projectinput7" class="file center-block">--}}
{{--                                                    <input type="file" id="file" name="photo">--}}
{{--                                                    <span class="file-custom"></span>--}}
{{--                                                </label>--}}
{{--                                                @error('photo')--}}
{{--                                                <span class="text-danger">{{$message}}</span>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}

{{--                                            <div class="form-body">--}}

{{--                                                <h4 class="form-section"><i class="la la-clipboard"></i> Main Category data </h4>--}}


{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label for="projectinput1"> Name - {{__('messages.'.$maincategory->translation_lang)}} </label>--}}
{{--                                                                    <input type="text"  id="name"--}}
{{--                                                                           class="form-control"--}}
{{--                                                                           placeholder="  "--}}
{{--                                                                           value="{{$maincategory->name}}"--}}
{{--                                                                           name="category[0][name]">--}}
{{--                                                                    @error("category.0.name")--}}
{{--                                                                    <span class="text-danger">this field is required</span>--}}
{{--                                                                    @enderror--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}


{{--                                                            <div class="col-md-6 hidden">--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label for="projectinput1"> Language Abbreviation {{__('messages.'.$maincategory->translation_lang)}} </label>--}}
{{--                                                                    <input type="text" id="abbr"--}}
{{--                                                                           class="form-control"--}}
{{--                                                                           placeholder="  "--}}
{{--                                                                           value="{{$maincategory->translation_lang}}"--}}
{{--                                                                           name="category[0][abbr]">--}}

{{--                                                                    @error("category.0.abbr")--}}
{{--                                                                    <span class="text-danger"> this field is required</span>--}}
{{--                                                                    @enderror--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}


{{--                                                        </div>--}}
{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <div class="form-group mt-1">--}}
{{--                                                                    <input type="checkbox" value="1"--}}
{{--                                                                           name="category[0][active]"--}}
{{--                                                                           id="switcheryColor4"--}}
{{--                                                                           class="switchery" data-color="success"--}}
{{--                                                                           @if($maincategory->active==1)checked/@endif>--}}
{{--                                                                    <label for="switcheryColor4"--}}
{{--                                                                           class="card-title ml-1">Statue  {{__('messages.'.$maincategory->translation_lang)}} </label>--}}

{{--                                                                    @error("category.0.active")--}}
{{--                                                                    <span class="text-danger"> </span>--}}
{{--                                                                    @enderror--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                            </div>--}}


{{--                                            <div class="form-actions">--}}
{{--                                                <button type="button" class="btn btn-warning mr-1"--}}
{{--                                                        onclick="history.back();">--}}
{{--                                                    <i class="ft-x"></i> Back--}}
{{--                                                </button>--}}
{{--                                                <button type="submit" class="btn btn-primary">--}}
{{--                                                    <i class="la la-check-square-o"></i> Update--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                        <ul class="nav nav-tabs nav-top-border  ">--}}
{{--                                            @isset($maincategory->categories)--}}

{{--                                                @foreach($maincategory -> categories   as $index =>  $translation)--}}
{{--                                                    <li class="nav-item">--}}
{{--                                                        <a class="nav-link @if($index ==  0) active @endif  " id="homeLable-tab"  data-toggle="tab"--}}
{{--                                                           href="#homeLable{{$index}}" aria-controls="homeLable"--}}
{{--                                                           aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">--}}
{{--                                                            {{__('messages.'.$translation->translation_lang)}}</a>--}}
{{--                                                    </li>--}}
{{--                                                @endforeach--}}
{{--                                            @endisset--}}

{{--                                        </ul>--}}

{{--                                        <div class="tab-content px-1 pt-1">--}}

{{--                                            @isset($maincategory -> categories)--}}
{{--                                                @foreach($maincategory -> categories   as $index =>  $translation)--}}

{{--                                                    <div role="tabpanel" class="tab-pane  @if($index ==  0) active  @endif  " id="homeLable{{$index}}"--}}
{{--                                                         aria-labelledby="homeLable-tab"--}}
{{--                                                         aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">--}}


{{--                                                <form class="form" action="{{route('admin.maincategories.update',$translation->id)}}"--}}
{{--                                                      method="POST"--}}
{{--                                                      enctype="multipart/form-data">--}}
{{--                                                    @csrf--}}
{{--                                                    <input name="id" value="{{$translation->id}}" type="hidden">--}}


{{--                                                    <div class="form-body">--}}



{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label for="projectinput1"> Name - {{__('messages.'.$translation->translation_lang)}} </label>--}}
{{--                                                                    <input type="text"  id="name"--}}
{{--                                                                           class="form-control"--}}
{{--                                                                           placeholder="  "--}}
{{--                                                                           value="{{$translation->name}}"--}}
{{--                                                                           name="category[0][name]">--}}
{{--                                                                    @error("category.0.name")--}}
{{--                                                                    <span class="text-danger">this field is required</span>--}}
{{--                                                                    @enderror--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}


{{--                                                            <div class="col-md-6 hidden">--}}
{{--                                                                <div class="form-group">--}}
{{--                                                                    <label for="projectinput1"> Language Abbreviation {{__('messages.'.$translation->translation_lang)}} </label>--}}
{{--                                                                    <input type="text" id="abbr"--}}
{{--                                                                           class="form-control"--}}
{{--                                                                           placeholder="  "--}}
{{--                                                                           value="{{$translation->translation_lang}}"--}}
{{--                                                                           name="category[0][abbr]">--}}

{{--                                                                    @error("category.0.abbr")--}}
{{--                                                                    <span class="text-danger"> this field is required</span>--}}
{{--                                                                    @enderror--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}


{{--                                                        </div>--}}
{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-md-6">--}}
{{--                                                                <div class="form-group mt-1">--}}
{{--                                                                    <input type="checkbox" value="1"--}}
{{--                                                                           name="category[0][active]"--}}
{{--                                                                           id="switcheryColor4"--}}
{{--                                                                           class="switchery" data-color="success"--}}
{{--                                                                           @if($translation->active==1)checked/@endif>--}}
{{--                                                                    <label for="switcheryColor4"--}}
{{--                                                                           class="card-title ml-1">Statue  {{__('messages.'.$translation->translation_lang)}} </label>--}}

{{--                                                                    @error("category.0.active")--}}
{{--                                                                    <span class="text-danger"> </span>--}}
{{--                                                                    @enderror--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}


{{--                                                    <div class="form-actions">--}}
{{--                                                        <button type="button" class="btn btn-warning mr-1"--}}
{{--                                                                onclick="history.back();">--}}
{{--                                                            <i class="ft-x"></i> Back--}}
{{--                                                        </button>--}}
{{--                                                        <button type="submit" class="btn btn-primary">--}}
{{--                                                            <i class="la la-check-square-o"></i> Update--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
{{--                                                </form>--}}


{{--                                                     </div>--}}


{{--                                            @endforeach--}}
{{--                                             @endisset--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </section>--}}
{{--                <!-- // Basic form layout section end -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
