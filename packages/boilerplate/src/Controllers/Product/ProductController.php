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
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Sebastienheyd\Boilerplate\Models\Product;

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
    public function create(Request $request)
    {
        
        $product = Product::insert($request->except(['_token']));
        return view('boilerplate::products.create',[
            'product' => $product,
        ]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('boilerplate::products.edit', [
            'product' => $product,
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
        $product = Product::find($id);

        $this->$request->validate(    [
            'name'  => 'required|unique:posts|max:255',
        ]);
        $product->update($request->all());

        return redirect()->route('boilerplate.products', $product)
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
