<?php

namespace App\Http\Controllers\Worker;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\WorkTime;
use Illuminate\Http\Request;
use Session;

class WorkTimeController extends Controller
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
            $worktime = WorkTime::where('user_id', 'LIKE', "%$keyword%")
				->orWhere('year', 'LIKE', "%$keyword%")
				->orWhere('mounth', 'LIKE', "%$keyword%")
				->orWhere('day', 'LIKE', "%$keyword%")
				->orWhere('hour', 'LIKE', "%$keyword%")
				->orWhere('type', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $worktime = WorkTime::paginate($perPage);
        }

        return view('Crud.work-time.index', compact('worktime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Crud.work-time.create');
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
			'year' => 'required|min:2000|max:2100',
			'mounth' => 'required|max:12',
			'day' => 'required|max:31',
			'hour' => 'max:24'
		]);
        $requestData = $request->all();
        
        WorkTime::create($requestData);

        Session::flash('flash_message', 'WorkTime added!');

        return redirect('Crud/work-time');
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
        $worktime = WorkTime::findOrFail($id);

        return view('Crud.work-time.show', compact('worktime'));
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
        $worktime = WorkTime::findOrFail($id);

        return view('Crud.work-time.edit', compact('worktime'));
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
			'year' => 'required|min:2000|max:2100',
			'mounth' => 'required|max:12',
			'day' => 'required|max:31',
			'hour' => 'max:24'
		]);
        $requestData = $request->all();
        
        $worktime = WorkTime::findOrFail($id);
        $worktime->update($requestData);

        Session::flash('flash_message', 'WorkTime updated!');

        return redirect('Crud/work-time');
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
        WorkTime::destroy($id);

        Session::flash('flash_message', 'WorkTime deleted!');

        return redirect('Crud/work-time');
    }
}
