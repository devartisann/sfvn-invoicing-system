<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\FruitCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class FruitController extends Controller
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
        $fruits = Fruit::query()
            ->with(['category'])
            ->orderBy('name')
            ->orderBy('id')
            ->paginate($limit);


        $categories = cache()->rememberForever(
            'fruit_categories_data', function () {
            return FruitCategory::query()->get()->toArray();
        });

        $categoryOptions = [];
        foreach ($categories as $category) {
            $categoryOptions[] = [
                'label' => $category['name'] ?? '',
                'value' => $category['id'] ?? '',
            ];
        }

        return view('fruits', compact('fruits', 'categoryOptions'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'min:3', 'max:200'],
                'unit' => ['required', 'string', 'in:pcs,kg,pack'],
                'price' => ['required', 'integer', 'min:1'],
                'category_id' => ['required', 'integer', 'exists:fruit_categories,id'],
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator, 'fruit');
        }

        $fruit = Fruit::factory()->make($validator->safe()->only(['name', 'category_id', 'unit', 'price']));
        $fruit->save();

        return redirect(route('fruit.index'));
    }
}
