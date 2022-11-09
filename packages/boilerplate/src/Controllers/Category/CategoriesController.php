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
    public function create()
    {
        return view('boilerplate::categories.create');
    }
    
    public function createPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        Categories::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);
        return redirect()->route('boilerplate.categories.index')
                        ->with('growl', [__('boilerplate::categories.list.successupdate'), 'success']);
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
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        $categorie->update([
            'name' => $request->name,
            'slug' => $request->slug
        ]);
        $categorie->update();

        return redirect()->route('boilerplate.categories.index', $categorie)
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
