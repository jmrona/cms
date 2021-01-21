<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->middleware('userStatus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'Asc')->get();
        $data = [ 'categories' => $categories ];

        return view('admin.categories.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['modules' => getModulesArray()];
        return view('admin.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'module' => 'required'
        ];

        $messages = [
            'name.required' => 'The name field is required',
            'module.required' => 'The module field is required'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator)
                        ->with('message', 'An error has occurred')
                        ->with('typealert', 'danger')->withInput();
        }

        $category = new Category();
        $category->name = e($request->name);
        $category->description = e($request->description);
        $category->module = $request->module;
        $category->slug = Str::slug($request->name) ;
        $category->save();

        if(!$category->save()){
            return back()->with('message', 'An error has occurred')
                         ->with('typealert', 'danger')->withInput();
        }

        return back()->with('message', 'Created successfully')
                     ->with('typealert', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $data = [
            'category'=> $category,
            'modules' => getModulesArray()
        ];

        return view('admin.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'module' => 'required'
        ];

        $messages = [
            'name.required' => 'The name field is required',
            'module.required' => 'The module field is required'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator)
                        ->with('message', 'An error has occurred')
                        ->with('typealert', 'danger')->withInput();
        }

        $category = Category::findOrFail($id);
        $category->name = e($request->name);
        $category->description = e($request->description);
        $category->module = $request->module;
        $category->slug = Str::slug($request->name) ;
        $category->save();

        if(!$category->save()){
            return back()->with('message', 'An error has occurred')
                         ->with('typealert', 'danger')->withInput();
        }

        return back()->with('message', 'Updated successfully')
                         ->with('typealert', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        if(!$category->delete()){
            return back()->with('message', 'An error has occurred')
                         ->with('typealert', 'danger')->withInput();
        }

        return back()->with('message', 'Category deleted successfully')
                    ->with('typealert', 'info');
    }
}
