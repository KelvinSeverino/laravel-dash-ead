<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
