<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Module\StoreUpdateModuleRequest;
use App\Repositories\{
    CourseRepositoryInterface,
    ModuleRepositoryInterface
};
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $repositoryCourse;
    protected $repository;

    public function __construct(
        CourseRepositoryInterface $repositoryCourse,
        ModuleRepositoryInterface $repository,
    )
    {
        $this->repositoryCourse = $repositoryCourse;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($courseId)
    {
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        $data = $this->repository->getAllByCourseId($courseId);
        $modules = convertItemsOfArrayToObject($data);

        return view('admin.courses.modules.index', compact('course', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($courseId)
    {
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        return view('admin.courses.modules.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateModuleRequest $request, $courseId)
    {
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        $this->repository
            ->createByCourse($courseId, $request->only(['name']));

        // $course->modules()->create($request->only(['name']));

        return redirect()->route('modules.index', $courseId);
    }

    /**
     * Display the specified resource.
     */
    public function show($courseId, $id)
    {
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        if (!$module = $this->repository->findById($id)) {
            return back();
        }

        return view('admin.courses.modules.show', compact('course', 'module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($courseId, $id)
    {
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        if (!$module = $this->repository->findById($id)) {
            return back();
        }

        return view('admin.courses.modules.edit', compact('course', 'module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateModuleRequest $request, $courseId, $id)
    {
        if (!$this->repositoryCourse->findById($courseId)) {
            return back();
        }

        $this->repository->update($id, $request->only(['name']));

        return redirect()->route('modules.index', $courseId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($courseId, $id)
    {
        if(!$this->repository->delete($id)){
            return back();
        }

        return redirect()->route('modules.index', $courseId);
    }
}
