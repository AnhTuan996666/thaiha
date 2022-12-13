<?php

namespace Sebastienheyd\Boilerplate\Controllers\Product;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Sebastienheyd\Boilerplate\Models\Product;
use Sebastienheyd\Boilerplate\Models\Categories;

class ProductController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return Application|Factory|View 
     */
    public function index()
    {
        return view('boilerplate::products.list');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Application|Factory|View
     */

    public function create() {
        $category = Categories::select([
            'id',
            'name',
            'slug',
            'created_at',
        ])->get();
        return view('boilerplate::products.create', [
            'category' => $category
        ]);
    }

    public function createPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        if($request->has('image_path')) {
            $file = $request->image_path;
            $ext = $request->image_path->extension();
            $file_name = time() .'-'.'category.'.$ext;
            $file->move(public_path('uploads'), $file_name);
        }
        Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image_path' => $file_name ?? ''
        ]);
        return redirect()->route('boilerplate.products.index')
                        ->with('growl', [__('boilerplate::products.list.successcreate'), 'success']);
    }

    public function edit($id)
    {
        $category = Categories::select([
            'id',
            'name',
            'slug',
            'created_at',
        ])->get();
        $product = Product::findOrFail($id);
        return view('boilerplate::products.edit', [
            'product' => $product,
            'category' => $category
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function update($id, Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        $product = Product::find($id);
        $category = Categories::select([
            'id',
            'name',
            'slug',
            'created_at',
        ])->get();
        if($request->has('image_path')) {
            $description = 'uploads'.$product->image_path;
            if(File::exists($description)) {
                File::delete($description);
            }
            $file = $request->image_path;
            $ext = $request->image_path->extension();
            $file_name = time() .'-'.'product.'.$ext;
            $file->move(public_path('uploads'), $file_name);
            $product->update(['image_path' => $file_name ?? '']);
        }
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('boilerplate.products.index', $product)
                ->with('growl', [__('boilerplate::products.successmod'), 'success']);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['success' => $product->delete() ?? false]);
    }
}
