<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\LoadsPageContent;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrackController extends Controller
{
    use LoadsPageContent;

    public function index(): View
    {
        return $this->pageView('track', 'track.index');
    }

    public function lookup(Request $request): RedirectResponse
    {
        $this->ensurePageActive('track');

        $request->validate([
            'code' => ['required', 'string', 'max:255'],
        ], [
            'code.required' => 'يرجى إدخال رمز التتبع.',
        ]);

        $code = strtoupper(trim($request->input('code')));
        $order = Order::query()->where('tracking_code', $code)->first();

        if (! $order) {
            return back()
                ->withInput()
                ->withErrors(['code' => 'لم يتم العثور على طلب بهذا الرمز. تحقق من الرمز وحاول مرة أخرى.']);
        }

        return redirect()->route('track.show', $order->tracking_code);
    }

    public function show(string $code): View
    {
        $this->ensurePageActive('track');

        $order = Order::query()
            ->where('tracking_code', strtoupper($code))
            ->firstOrFail();

        return view('track.show', [
            'order' => $order,
            'timeline' => $order->timeline(),
        ]);
    }
}
