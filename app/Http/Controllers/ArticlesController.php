<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;

class ArticlesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:api'); 
        
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        /* return  *///$sort 

    
        $articles = Article::query();

      /*   foreach($sort as $sortcol)
        {
            $sortdir = starts_with($sortcol, '-') ? 'desc' : 'asc';

            $sortCol = ltrim($sortcol, '-');

            $articles->orderBy($sortCol, $sortdir);
        } */

        if(request()->has('filterBy'))
        {
           list($criteria, $value) = explode(':', request()->filterBy);

            $articles->where($criteria, $value);
        }

        return ArticleResource::collection($articles->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $article = Article::create([

            'title' => $request->title,

            'body' => $request->body,
        
        ]);

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if($article->delete())
        {

            return new  ArticleResource($article);
   
        }

    }
}
