<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Http\Resources\Subject as SubjectResource;

class SubjectController extends Controller
{
    protected $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $subjects = $this->subjectRepository->getNameSubject();

        return SubjectResource::collection($subjects);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'day' => 'required',
        ]);
        $this->subjectRepository->create($request->all());

        return response()->json([
            'message' => config('api.create'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->subjectRepository->update($request->all(), $id);

        return response()->json([
            'message' => config('api.updated'),
        ]);
    }

    public function destroy($id)
    {
        $subject = $this->subjectRepository->find($id);
        $this->subjectRepository->delete($id);

        return response()->json([
            'message' => config('api.deleted'),
        ]);
    }
}
