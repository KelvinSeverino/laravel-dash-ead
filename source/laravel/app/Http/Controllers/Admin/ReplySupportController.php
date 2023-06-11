<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ReplySupportRepositoryInterface;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    protected $service;

    public function __construct(ReplySupportRepositoryInterface $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
