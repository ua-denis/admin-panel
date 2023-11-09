<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\NewsRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class DashboardController extends Controller
{

    public function __construct(private NewsRepository $newsRepository)
    {

    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $news = $this->newsRepository->paginate();
        return view('dashboard', compact('news'));
    }

}