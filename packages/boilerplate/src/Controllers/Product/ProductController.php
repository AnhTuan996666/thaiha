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
    public function create()
    {
        return view('boilerplate::products.create');
    }

    public function edit(Request $request, $id)
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
        $userModel = config('boilerplate.auth.providers.users.model');
        $user = $userModel::findOrFail($id);

        $this->validate($request, [
            'name'  => 'required',
            'first_name' => 'required',
            'email'      => 'required|email|unique:users,email,'.$id,
        ]);

        $user->update($request->all());

        $user->roles()->sync(array_keys($request->input('roles', [])));

        return redirect()->route('boilerplate.users.edit', $user)
                         ->with('growl', [__('boilerplate::users.successmod'), 'success']);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $product = Product::find($id);
        return response()->json(['success' => $product->delete() ?? false]);
    }



    


 




}
