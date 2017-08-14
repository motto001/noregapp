<?php

namespace App\Http\Controllers\Crud;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Worker;
use Illuminate\Http\Request;
use Session;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $workers = Worker::where('name', 'LIKE', "%$keyword%")
				->orWhere('cim', 'LIKE', "%$keyword%")
				->orWhere('email', 'LIKE', "%$keyword%")
				->orWhere('tel', 'LIKE', "%$keyword%")
				->orWhere('birth', 'LIKE', "%$keyword%")
				->orWhere('statusz', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $workers = Worker::paginate($perPage);
        }

        return view('crud.workers.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('crud.workers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required|max:100',
			'cim' => 'required|max:200',
			'email' => 'email',
			'tel' => 'max:50',
			'birth' => 'required|date',
			'statusz' => 'max:50'
		]);
        $requestData = $request->all();
        
        Worker::create($requestData);

        Session::flash('flash_message', 'Worker added!');

        return redirect('crud/workers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $worker = Worker::findOrFail($id);

        return view('crud.workers.show', compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $worker = Worker::findOrFail($id);

        return view('crud.workers.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
			'name' => 'required|max:100',
			'cim' => 'required|max:200',
			'email' => 'email',
			'tel' => 'max:50',
			'birth' => 'required|date',
			'statusz' => 'max:50'
		]);
        $requestData = $request->all();
        
        $worker = Worker::findOrFail($id);
        $worker->update($requestData);

        Session::flash('flash_message', 'Worker updated!');

        return redirect('crud/workers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Worker::destroy($id);

        Session::flash('flash_message', 'Worker deleted!');

        return redirect('crud/workers');
    }
}
