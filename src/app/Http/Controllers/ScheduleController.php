<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Condition;
use App\Models\Schedule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        $schedule = Schedule::latest()->paginate(10);
        $conditions = Condition::all(['id','name']);
        return view('schedule.index', compact('schedule'), compact('conditions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        $conditions = Condition::all(['id','name']);
        return view('schedule.create', compact('conditions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScheduleRequest $request
     * @return RedirectResponse
     */
    public function store(ScheduleRequest $request): RedirectResponse
    {
        Schedule::create($request->validated());
        return redirect()->route('schedule.index')->with('message', 'Schedule Entry Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @return View|Factory|Application
     */
    public function show(Schedule $schedule): View|Factory|Application
    {
        return view('schedule.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Schedule $schedule
     * @return View|Factory|Application
     */
    public function edit(Schedule $schedule): View|Factory|Application
    {
        $conditions = Condition::all(['id','name']);
        return view('schedule.edit', compact('schedule'), compact('conditions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScheduleRequest $request
     * @param Schedule $schedule
     * @return RedirectResponse
     */
    public function update(ScheduleRequest $request, Schedule $schedule): RedirectResponse
    {
        $schedule->update([
            'condition_id' => $request->condition_id,
            'condition_start' => $request->condition_start,
            'condition_end' => $request->condition_end
        ]);

        return redirect()->route('schedule.index')->with('message', 'Schedule Entry Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return RedirectResponse
     */
    public function destroy(Schedule $schedule): RedirectResponse
    {
        $schedule->delete();
        return redirect()->route('schedule.index')->with('message', 'Schedule Entry Deleted Successfully');
    }
}
