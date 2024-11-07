<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    private FavoriteRepository $favoriteRepository;

    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function toggleFavorite($bookId)
    {
        return $this->favoriteRepository->toggleFavorite($bookId);
    }
}
