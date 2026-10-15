<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class CategoryController extends Controller
{


    public function index()
    {

        $categories = Category::latest()->get();


        return view(
            'admin.categories.index',
            compact('categories')
        );

    }






    public function create()
    {

        return view(
            'admin.categories.create'
        );

    }







    public function store(Request $request)
    {


        $request->validate([

            'name' => 'required|unique:categories,name',

            'image' => 'nullable|image|max:2048'

        ]);




        $image = null;



        if($request->hasFile('image'))
        {

            $image = $request
                ->file('image')
                ->store(
                    'categories',
                    'public'
                );

        }




        Category::create([

            'name'=>$request->name,

            'slug'=>str()->slug($request->name),

            'image'=>$image

        ]);




        return redirect()

        ->route('categories.index')

        ->with(
            'success',
            'Category created successfully'
        );


    }









    public function edit(Category $category)
    {


        return view(
            'admin.categories.edit',
            compact('category')
        );


    }









    public function update(Request $request, Category $category)
    {


        $request->validate([

            'name'=>'required',

            'image'=>'nullable|image|max:2048'

        ]);





        $image = $category->image;





        if($request->hasFile('image'))
        {


            if($category->image)
            {

                Storage::disk('public')
                    ->delete($category->image);

            }




            $image = $request
                ->file('image')
                ->store(
                    'categories',
                    'public'
                );


        }





        $category->update([

            'name'=>$request->name,

            'slug'=>str()->slug($request->name),

            'image'=>$image

        ]);





        return redirect()

        ->route('categories.index')

        ->with(
            'success',
            'Category updated successfully'
        );


    }









    public function destroy(Category $category)
    {


        if($category->products()->count() > 0)
        {


            return redirect()

            ->route('categories.index')

            ->with(
                'error',
                'Category cannot be deleted because it has products.'
            );

        }





        if($category->image)
        {

            Storage::disk('public')
                ->delete($category->image);

        }






        $category->delete();





        return redirect()

        ->route('categories.index')

        ->with(
            'success',
            'Category deleted successfully'
        );


    }


}