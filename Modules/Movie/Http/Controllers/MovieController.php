<?php

namespace Modules\Movie\Http\Controllers;

use App\Traits\Pagination;
use App\Traits\ApiResponser;
use App\Traits\JSONResponse;
use Illuminate\Http\Request;
use Modules\Movie\Entities\Movie;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Movie\Transformers\MovieResource;
use Modules\Movie\Http\Requests\StoreMovieRequest;
use Modules\Movie\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    use JSONResponse, ApiResponser, Pagination;

    public function __construct() {
        $this->setResource(MovieResource::class);
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

        $movies = Movie::query()
                        ->where('name', 'like', '%'.$keyword.'%')
                        ->orWhere('rate', $keyword)
                        ->paginate($perPage, ['*'], 'page', $page);

        return self::collection($movies);
    }

    
    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->all());

        return self::resource($movie);
    }

    
    public function show($id)
    {
        $movie = Movie::find($id);

        if(!$movie)
            return $this->error('404', 'Not Found');
        
        return self::resource($movie);
    }

 
    public function update(UpdateMovieRequest $request, $id)
    {
        $movie = Movie::find($id);

        if(!$movie)
            return $this->error('404', 'Not Found');
        
        $movie->update($request->all());

        return self::resource($movie);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if(!$movie)
            return $this->error('404', 'Not Found');
        
        $movie->delete();

        return $this->success('Deleted Successfully');
    }

    public function storeThroughXML(Request $request) {

    }
}
