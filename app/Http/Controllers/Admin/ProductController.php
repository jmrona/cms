<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

use App\Models\Category;
use App\Models\Products;
use App\Models\PGallery;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->middleware('userStatus');
    }

    public function index(){
        $products = Products::with(['cat'])->orderBy('name', 'Asc')->get();
        $data = ['products' => $products];

        return view('admin.products.home', $data);
    }

    public function create(){
        $catProducts = Category::where('module','0')->pluck('name','id');
        $catBlogs = Category::where('module','1')->pluck('name','id');

        $categories = [
            'categories' => [
                'products' => $catProducts,
                'blogs' => $catBlogs,
            ]
        ];

        return view('admin.products.create',$categories);
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'price' => 'required|numeric',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'The name field is required',
            'price.required' => 'The price field is required',
            'description.required' => 'The description field is required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator)
                        ->with('message', 'An error has occurred')
                        ->with('typealert', 'danger')->withInput();
        }

        if($request->hasFile('image')){
            $upload_path = Config::get('filesystems.disks.uploads.root');

            $path = '/'.date('Y-m-d');
            $file = $request->file('image');
            $fileExt = trim($file->getClientOriginalExtension());
            $name = Str::slug(str_replace($fileExt, '', $file->getClientOriginalName() ));

            $filename = time().'-'.$name.'.'.$fileExt;
            $fileStore = $file->storeAs($path, $filename, 'uploads');
            $finalFile = $upload_path.$path.'/'.$filename;

            $img = Image::make($finalFile);
            $img->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($upload_path.'/'.$path.'/t_'.$filename);
        }

        $product = new Products();
        $product->name = e($request->name);
        $product->description = e($request->description);
        $product->slug = Str::slug(e($request->name));
        $product->category_id = $request->category;
        $product->image = $filename;
        $product->price = $request->price;
        $product->in_discount = $request->inDiscount;
        $product->discount = $request->discount;
        $product->file_path = $path;
        $product->save();

        if(!$product->save()){
            return back()->with('message', 'An error has occurred')
                         ->with('typealert', 'danger')->withInput();
        }

        return redirect('/admin/products')->with('message', 'Created successfully')
                                          ->with('typealert', 'success');
    }

    public function edit($id){
        $catProducts = Category::where('module','0')->pluck('name','id');
        $catBlogs = Category::where('module','1')->pluck('name','id');

        $product = Products::findOrFail($id);
        $data = [
            'product' => $product,
            'categories' =>[
                'products' => $catProducts,
                'blogs' => $catBlogs,
            ]
        ];

        return view('admin.products.edit', $data);
    }

    public function update(Request $request, $id){
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required'
        ];

        $messages = [
            'name.required' => 'The name field is required',
            'price.required' => 'The price field is required',
            'description.required' => 'The description field is required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator)
                        ->with('message', 'An error has occurred')
                        ->with('typealert', 'danger')->withInput();
        }

        $product = Products::findOrFail($id);

        if($request->hasFile('image')){
            $upload_path = Config::get('filesystems.disks.uploads.root');

            // Destroy old image
            $fileOldPath = $product->file_path;
            $fileOldName = $product->image;
            $finalOldFile = $upload_path.$fileOldPath.'/'.$fileOldName;
            $finalOldTempFile = $upload_path.$fileOldPath.'/t_'.$fileOldName;

            unlink($upload_path.'/'.$fileOldPath.'/'.$fileOldName);
            unlink($upload_path.'/'.$fileOldPath.'/t_'.$fileOldName);

            // Update image
            $path = '/'.date('Y-m-d');
            $file = $request->file('image');
            $fileExt = trim($file->getClientOriginalExtension());
            $name = Str::slug(str_replace($fileExt, '', $file->getClientOriginalName() ));

            $filename = time().'-'.$name.'.'.$fileExt;
            $fileStore = $file->storeAs($path, $filename, 'uploads');
            $finalFile = $upload_path.$path.'/'.$filename;

            $img = Image::make($finalFile);
            $img->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($upload_path.'/'.$path.'/t_'.$filename);
        }

        $product->status = $request->visible;
        $product->name = e($request->name);
        $product->description = e($request->description);
        $product->category_id = $request->category;
        if($request->hasFile('image')){
            $product->image = $filename;
            $product->file_path = $path;
        }
        $product->price = $request->price;
        $product->in_discount = $request->inDiscount;
        $product->discount = $request->discount;
        $product->save();

        if(!$product->save()){
            return back()->with('message', 'An error has occurred')
                         ->with('typealert', 'danger')->withInput();
        }

        return back()->with('message', 'Updated successfully')
                    ->with('typealert', 'success');
    }

    public function destroy($id){
        $product = Products::findOrFail($id);
        $product->delete();

        return back()->with('message', 'Product deleted successfully')
                    ->with('typealert', 'info');
    }

    public function galleryStore(Request $request, $id){
        $rules = [
            'input_file' => 'required'
        ];

        $messages = [
            'input_file.required' => 'The image field is required'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return back()->withErrors($validator)
                        ->with('message', 'An error has occurred')
                        ->with('typealert', 'danger')->withInput();
        }

        if($request->hasFile('input_file')){
            $upload_path = Config::get('filesystems.disks.uploads.root');

            $path = '/'.date('Y-m-d');
            $file = $request->file('input_file');
            $fileExt = trim($file->getClientOriginalExtension());
            $name = Str::slug(str_replace($fileExt, '', $file->getClientOriginalName() ));

            $filename = time().'-'.$name.'.'.$fileExt;
            $finalFile = $upload_path.$path.'/'.$filename;

            $gallery = new PGallery;
            $gallery->product_id = $id;
            $gallery->file_path = $path;
            $gallery->file_name = $filename;

            if($gallery->save()){
                if($request->hasFile('input_file')){
                    $fileStore = $file->storeAs($path, $filename, 'uploads');
                    $finalFile = $upload_path.$path.'/'.$filename;

                    $img = Image::make($finalFile);
                    $img->resize(256, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);

                    return back()->with('message', 'Image uploaded successfully')
                    ->with('typealert', 'success');
                }
            }
        }
    }

    public function deleteImage($product_id, $image_id){
        $upload_path = Config::get('filesystems.disks.uploads.root');

        $img = PGallery::findOrFail($image_id);

        $path = $img->file_path;
        $file = $img->file_name;

        if($img->product_id != $product_id){
            return back()->with('message', 'This image cannot be deleted')
                    ->with('typealert', 'error');
        }

        $img->delete();
        unlink($upload_path.'/'.$path.'/'.$file);
        unlink($upload_path.'/'.$path.'/t_'.$file);

        return back()->with('message', 'Image from gallery has been deleted successfully')
                    ->with('typealert', 'success');
    }
}
