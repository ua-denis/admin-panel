<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Repositories\Eloquent\NewsRepository;
use App\Services\UnsplashService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{

    public function __construct(private NewsRepository $newsRepository, private UnsplashService $unsplashService)
    {

    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $news = $this->newsRepository->paginate();
        return view('admin-panel.news.index', compact('news'));
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin-panel.news.create');
    }

    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['photo'] = $this->unsplashService->getRandomImage();
        $this->newsRepository->create($data);
        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    public function edit(int $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $news = $this->newsRepository->find($id);
        return view('admin-panel.news.edit', compact('news'));
    }

    public function update(UpdateNewsRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();
        if ($request->has('new_photo') && $request->get('new_photo') === 'on') {
            $data['photo'] = $this->unsplashService->getRandomImage();
        }
        $this->newsRepository->update($id, $data);
        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $this->newsRepository->delete($id);
        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
