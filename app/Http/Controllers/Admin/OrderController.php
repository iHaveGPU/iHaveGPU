<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * แสดงรายการออเดอร์ (กรองสถานะได้)
     */
    public function index(Request $request)
    {
        // $this->authorize('order.viewAny'); // ถ้าเปิด Gate/Policy
        $q = Order::query()
            ->with(['user'])
            ->latest();

        if ($status = $request->get('status')) {
            $q->where('status', $status);
        }

        $orders = $q->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * แสดงรายละเอียดออเดอร์
     */
    public function show(Order $order)
    {
        // $this->authorize('order.viewAny');
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * อัปเดตสถานะออเดอร์ (staff/admin)
     */
    public function update(Request $request, Order $order)
    {
        // $this->authorize('order.update');
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,shipped,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Order status updated.');
    }

    /**
     * ลบออเดอร์ (admin)
     */
    public function destroy(\App\Models\Order $order)
{
    $user = auth()->user();

    // ถ้าไม่ใช่แอดมิน -> ไม่ให้ลบ แต่แจ้งเป็น flash message
    if (! $user || ! method_exists($user, 'isAdmin') || ! $user->isAdmin()) {
        return redirect()
            ->back()
            ->with('error', 'คุณไม่มีสิทธิ์ลบออเดอร์นี้ (เฉพาะ Admin เท่านั้น)');
    }

    // ดำเนินการลบ
    $order->items()->delete(); // ถ้ามีความสัมพันธ์รายการ
    $order->delete();

    return redirect()
        ->route('manage.orders.index')
        ->with('success', 'ลบออเดอร์เรียบร้อยแล้ว');
}

    // ไม่ใช้ในหลังบ้าน (ออเดอร์ถูกสร้างจากฝั่งลูกค้า)
    public function create() { abort(404); }
    public function store(Request $request) { abort(404); }
    public function edit(Order $order) { abort(404); }
}
