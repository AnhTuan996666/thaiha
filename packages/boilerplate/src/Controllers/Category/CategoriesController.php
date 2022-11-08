<?php

namespace Sebastienheyd\Boilerplate\Controllers\Category;

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
use Sebastienheyd\Boilerplate\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return Application|Factory|View 
     */
    public function index()
    {
        return view('boilerplate::categories.list');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        
        $categorie = Categories::insert($request->except(['_token']));
        return view('boilerplate::categories.create',[
            'categories' => $categorie,
        ]);
    }

    public function edit($id)
    {
        $categorie = Categories::findOrFail($id);
        return view('boilerplate::categories.edit', [
            'categories' => $categorie,
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
        $categorie = Categories::find($id);

        $this->$request->validate(    [
            'name'  => 'required|unique:posts|max:255',
        ]);
        $categorie->update($request->all());

        return redirect()->route('boilerplate.categories', $categorie)
                ->with('growl', [__('boilerplate::categories.successmod'), 'success']);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $categorie = Categories::findOrFail($id);
        return response()->json(['success' => $categorie->delete() ?? false]);
    }
}
