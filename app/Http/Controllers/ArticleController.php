<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return response()->json(['article' => $article]);
    }
    

    public function create(Request $request)
    {
        $user = auth()->user();

        $article = Article::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Article créé avec succès.',
            'article' => $article,
        ], 201);
    }



public function update(Request $request, Article $article)
{
    if (Gate::denies('update', $article)) {
        return response()->json(['error' => 'Vous ne pouvez modifier cet article'], 403);
    }

    $article->update([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
    ]);

    return response()->json([
        'message' => 'Article mis à jour avec succès.',
        'article' => $article,
    ]);
}

public function delete(Article $article)
{
    if (Gate::denies('delete', $article)) {
        return response()->json(['error' => 'vous ne pouvez pas supprimer cet article'], 403);
    }

    $article->delete();

    return response()->json(['message' => 'Article a été supprimé avec succès']);
}

}

