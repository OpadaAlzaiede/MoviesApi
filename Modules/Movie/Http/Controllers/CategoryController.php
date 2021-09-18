<?php

namespace Modules\Movie\Http\Controllers;

use App\Traits\Pagination;
use App\Traits\ApiResponser;
use App\Traits\JSONResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Movie\Entities\Category;
use Illuminate\Contracts\Support\Renderable;
use Modules\Movie\Transformers\CategoryResource;
use Modules\Movie\Http\Requests\StoreCategoryRequest;
use Modules\Movie\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use JSONResponse, ApiResponser, Pagination;

    public function __construct() {
        $this->setResource(CategoryResource::class);
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $page = $this->checkPageValue($request);
        $perPage = $this->checkPerPageValue($request);
        $keyword = $request->keyword;

        $categories = Category::query()
                        ->where('name', 'like', '%'.$keyword.'%')
                        ->paginate($perPage, ['*'], 'page', $page);

        return self::collection($categories);
    }

    
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());

        return self::resource($category);
    }

    
    public function show($id)
    {
        $category = Category::find($id);

        if(!$category)
            return $this->error('404', 'Not Found');
        
        return self::resource($category);
    }

 
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if(!$category)
            return $this->error('404', 'Not Found');
        
        $category->update($request->all());

        return self::resource($category);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if(!$category)
            return $this->error('404', 'Not Found');
        
        $category->delete();

        return $this->success('Deleted Successfully');
    }
}
