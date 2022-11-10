<?php

namespace Sebastienheyd\Boilerplate\Controllers\Articles;

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
use Sebastienheyd\Boilerplate\Models\Articles;

class ArticlesController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return Application|Factory|View 
     */
    public function index()
    {
        return view('boilerplate::articles.list');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Application|Factory|View
     */

    public function create() {
        return view('boilerplate::articles.create');
    }

    public function createPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles',
            'excerpt'=> 'required',
        ]);
        if($request->has('image_path')) {
            $file = $request->image_path;
            $ext = $request->image_path->extension();
            $file_name = time() .'-'.'articles.'.$ext;
            $file->move(public_path('uploads'), $file_name);
        }
        Articles::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image_path' => $file_name ?? ''
        ]);
        return redirect()->route('boilerplate.articles.index')
                        ->with('growl', [__('boilerplate::articles.list.successcreate'), 'success']);
    }

    public function edit($id)
    {
        $article = Articles::findOrFail($id);
        return view('boilerplate::articles.edit', [
            'articles' => $article,
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
        $article = Articles::find($id);
        if($request->has('image_path')) {
            $description = 'uploads'.$article->image_path;
            if(File::exists($description)) {
                File::delete($description);
            }
            $file = $request->image_path;
            $ext = $request->image_path->extension();
            $file_name = time() .'-'.'articles.'.$ext;
            $file->move(public_path('uploads'), $file_name);
        }
        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image_path' => $file_name ?? ''
        ]);
        $article->update();
        return redirect()->route('boilerplate.articles.index', $article)
                ->with('growl', [__('boilerplate::articles.successmod'), 'success']);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $article = Articles::findOrFail($id);
        return response()->json(['success' => $article->delete() ?? false]);
    }
}
