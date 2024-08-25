<?php

namespace App\Http\Controllers;

use App\Models\FruitCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class FruitCategoryController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $request->validate([
            'page' => ['int', 'min:1', 'max:200'],
            'limit' => ['int', 'min:10'],
        ]);

        $limit = $request->get('limit');
        $categories = FruitCategory::query()
            ->orderBy('name')
            ->orderBy('id')
            ->paginate($limit);

        return view('categories', [
            'categories' => $categories
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make(
            $request->all(),
            ['name' => ['required', 'string', 'min:3', 'max:200'],]
        );
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator, 'category');
        }
        
        $category = FruitCategory::factory()->make($validator->safe(['name']));
        $category->save();

        return redirect(route('fruit.category.index'));
    }
}
