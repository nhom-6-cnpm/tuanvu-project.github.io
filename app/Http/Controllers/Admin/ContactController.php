<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Hiển thị danh sách liên hệ
     */
    public function list(Request $request)
    {
        $query = Contact::orderByDesc('created_at');
        
        // Lọc theo trạng thái
        if ($request->has('status')) {
            $status = $request->status;
            $query->where('status', $status);
        }

        $contacts = $query->paginate(10);

        return view('admin.contacts.list', [
            'title' => 'Danh Sách Liên Hệ',
            'contacts' => $contacts
        ]);
    }

    /**
     * Hiển thị chi tiết một liên hệ
     */
    public function view(Contact $contact)
    {
        // Cập nhật trạng thái thành đã xem
        if ($contact->status == 0) {
            $contact->update(['status' => 1]);
        }
        
        return view('admin.contacts.view', [
            'title' => 'Chi Tiết Liên Hệ #' . $contact->id,
            'contact' => $contact
        ]);
    }

    /**
     * Xóa liên hệ
     */
    public function destroy(Request $request)
    {
        try {
            $contact = Contact::find($request->input('id'));
            if ($contact) {
                $contact->delete();
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa liên hệ thành công'
                ]);
            }
            return response()->json([
                'error' => true,
                'message' => 'Không tìm thấy liên hệ'
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'error' => true,
                'message' => 'Có lỗi xảy ra: ' . $err->getMessage()
            ]);
        }
    }

    /**
     * Cập nhật trạng thái đã xem
     */
    public function markAsRead(Contact $contact)
    {
        try {
            $contact->update(['status' => 1]);
            return response()->json([
                'error' => false,
                'message' => 'Cập nhật trạng thái thành công'
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'error' => true,
                'message' => 'Có lỗi xảy ra: ' . $err->getMessage()
            ]);
        }
    }

    /**
     * Lọc danh sách theo trạng thái
     */
    public function filter(Request $request)
    {
        $status = $request->input('status');
        $query = Contact::orderByDesc('created_at');

        if ($status !== null) {
            $query->where('status', $status);
        }

        return view('admin.contacts.list', [
            'title' => 'Danh Sách Liên Hệ',
            'contacts' => $query->paginate(10)
        ]);
    }
}
