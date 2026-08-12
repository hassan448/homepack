<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\LoadsPageContent;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    use LoadsPageContent;

    public function index(): View
    {
        return $this->pageView('contact', 'contact.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'dimensions' => ['nullable', 'string', 'max:100'],
            'quantity' => ['nullable', 'integer', 'min:1'],
            'cardboard_type' => ['nullable', 'string', 'max:255'],
            'printing_type' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ], [
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
        ]);

        $order = Order::create($validated);

        return redirect()
            ->route('contact.index')
            ->with('success', 'تم استلام استفسارك بنجاح. سيتواصل معك فريقنا خلال 24 ساعة.')
            ->with('tracking_code', $order->tracking_code);
    }
}
