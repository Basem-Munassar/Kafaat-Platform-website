<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    public function create()
    {
        return view('client.pages.contactPage');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('client.contact')
            ->with('contact_success', 'تم إرسال رسالتك بنجاح. شكراً لتواصلك معنا!');
    }

    // ===== Admin inbox =====
    public function adminIndex()
    {
        $messages = ContactMessage::latest()->get();
        $messageCount = $messages->count();
        return view('admin.pages.messages', compact('messages', 'messageCount'));
    }

    public function destroy(int $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح');
    }
}
