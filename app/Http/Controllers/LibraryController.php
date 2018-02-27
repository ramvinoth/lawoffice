<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use DateTime;
use Auth;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()
            ->json([
                'model' => Library::filterPaginateOrder()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()
            ->json([
                'form' => Library::initialize(),
                'option' => []
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $book_details = $request->all();
        $book_details['org_id'] = Auth::user()->org_id;
        $book_details['created_at'] = (new DateTime())->getTimestamp()."000";
        $book_details['updated_at'] = (new DateTime())->getTimestamp()."000";
        
        $book = Library::create($book_details);
        
        return response()->json([
            'saved' => true,
            'book' => $book,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Library  $Library
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Library::where([['id','=',$id]])->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Case  $case
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Library = Library::findOrFail($id);

        return response()
            ->json([
                'form' => $Library,
                'option' => []
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Library  $Library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Library $Library)
    {
        //
        $id = $request->id;
        $book_details = $request->all();
        $book_details['updated_at'] = (new DateTime())->getTimestamp()."000";
        $book = Library::findOrFail($id)->update($book_details);
        
        return response()->json([
            'updated' => $book,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Library  $Library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $Library)
    {
        //
    }
}
?>
