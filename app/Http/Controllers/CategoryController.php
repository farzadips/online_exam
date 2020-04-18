<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $categories = Category::all();
        $categories = Category::with('childrenRecursive')
            ->where('parent_id',null)->get();
        return view('adminpanel.categories.index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $categories = Category::all();
        $categories = Category::with('childrenRecursive')
            ->where('parent_id',null)->get();
        return view('adminpanel.categories.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $category = new Category();
            $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect('adminpanel/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        $category = Category::findOrFail($id);
        return view('adminpanel.categories.edit',compact(['category','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect('/adminpanel/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::with('childrenRecursive')->where('id',$id)->first();
        if (count($category->childrenRecursive)>0){
            Session::flash('error_category',' دسته بندی '. $category->name .'  دارای زیر دسته است پس امکان پذیر نیست ');
            return redirect('/adminpanel/categories');
        }

        $category->delete();
        return redirect('/adminpanel/categories');
    }
}
