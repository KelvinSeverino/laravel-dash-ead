<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\StoreUpdateLessonRequest;
use App\Repositories\{
    LessonRepositoryInterface,
    ModuleRepositoryInterface
};
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $repositoryModule;
    protected $repository;

    public function __construct(
        ModuleRepositoryInterface $repositoryModule,
        LessonRepositoryInterface $repository,
    )
    {
        $this->repositoryModule = $repositoryModule;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $moduleId)
    {
        if (!$module = $this->repositoryModule->findById($moduleId)) {
            return back();
        }

        $data = $this->repository->getAllByModuleId(
            moduleId: $moduleId,
            filter: $request->filter ?? ''
        );
        $lessons = convertItemsOfArrayToObject($data);

        return view('admin.courses.modules.lessons.index', compact('module', 'lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($moduleId)
    {
        if (!$module = $this->repositoryModule->findById($moduleId)) {
            return back();
        }

        return view('admin.courses.modules.lessons.create', compact('module'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateLessonRequest $request, $moduleId)
    {
        if (!$this->repositoryModule->findById($moduleId)) {
            return back();
        }

        $data = $request->only(['name', 'video', 'description']);

        $this->repository
            ->createByModule($moduleId, $data);

        return redirect()->route('lessons.index', $moduleId);
    }

    /**
     * Display the specified resource.
     */
    public function show($moduleId, $id)
    {
        if (!$module = $this->repositoryModule->findById($moduleId)) {
            return back();
        }

        if (!$lesson = $this->repository->findById($id)) {
            return back();
        }

        return view('admin.courses.modules.lessons.show', compact('module', 'lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($moduleId, $id)
    {
        if (!$module = $this->repositoryModule->findById($moduleId)) {
            return back();
        }

        if (!$lesson = $this->repository->findById($id)) {
            return back();
        }

        return view('admin.courses.modules.lessons.edit', compact('module', 'lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateLessonRequest $request, $moduleId, $id)
    {
        if (!$this->repositoryModule->findById($moduleId)) {
            return back();
        }

        $this->repository->update($id, $request->validated());

        return redirect()->route('lessons.index', $moduleId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($moduleId, $id)
    {
        if(!$this->repository->delete($id)){
            return back();
        }

        return redirect()->route('lessons.index', $moduleId);
    }
}
