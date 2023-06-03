<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreUpdateCourseRequest;
use App\Services\CourseService;
use App\Services\UploadFile;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $courses = $this->service->getAll(
            filter: $request->filter ?? ''
        );

        return view('admin.courses.index', ['courses' => $courses]);
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(StoreUpdateCourseRequest $request, UploadFile $uploadFile)
    {
        $data = $request->only(['name', 'description']);
        $data['available'] = isset($request->available);

        if($request->image){
            $data['image'] = $uploadFile->store($request->image, 'courses');
        }

        $this->service->create($data);

        return redirect()->route('courses.index');
    }

    public function show(string $id)
    {
        if(!$course = $this->service->findById($id)){
            return back();
        }

        return view('admin.courses.show', compact('course'));
    }

    public function edit(string $id)
    {
        if(!$course = $this->service->findById($id)){
            return back();
        }

        return view('admin.courses.edit', compact('course'));
    }

    public function update(StoreUpdateCourseRequest $request, UploadFile $uploadFile, string $id)
    {
        $data = $request->only(['name', 'description']);
        $data['available'] = isset($request->available);

        $course = $this->service->findById($id);

        if($request->image){
            // remove old image
            if($course && $course->image){
                $uploadFile->removeFile($course->image);
            }

            // upload new image
            $data['image'] = $uploadFile->store($request->image, 'courses');
        }

        $this->service->update($id, $data);

        return redirect()->route('courses.index');
    }

    public function destroy(string $id)
    {
        if(!$this->service->delete($id)){
            return back();
        }

        return redirect()->route('courses.index');
    }
}
