<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConditionRequest;
use App\Models\Condition;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $conditions = Condition::latest()->paginate(10);
        return view('conditions.index', compact('conditions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('conditions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ConditionRequest $request
     * @return RedirectResponse
     */
    public function store(ConditionRequest $request): RedirectResponse
    {
        Condition::create($request->validated());
        return redirect()->route('conditions.index')->with('message', 'Condition Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Condition $condition
     * @return View|Factory|Application
     */
    public function show(Condition $condition): View|Factory|Application
    {
        return view('conditions.show', compact('condition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Condition $condition
     * @return View|Factory|Application
     */
    public function edit(Condition $condition): View|Factory|Application
    {
        return view('conditions.edit', compact('condition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConditionRequest $request
     * @param Condition $condition
     * @return RedirectResponse
     */
    public function update(ConditionRequest $request, Condition $condition): RedirectResponse
    {
        $condition->update([
            'name' => $request->name,
            'info' => $request->info,
            'light_white' => $request->light_white,
            'light_red' => $request->light_red,
            'temperature' => $request->temperature,
            'temp_delta_top' => $request->temp_delta_top,
            'temp_delta_bot' => $request->temp_delta_bot,
            'humidity' => $request->humidity,
            'hum_delta_top' => $request->hum_delta_top,
            'hum_delta_bot' => $request->hum_delta_bot,
        ]);

        return redirect()->route('conditions.index')->with('message', 'Condition Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Condition $condition
     * @return RedirectResponse
     */
    public function destroy(Condition $condition): RedirectResponse
    {
        $condition->delete();
        return redirect()->route('conditions.index')->with('message', 'Condition Deleted Successfully');
    }
}
