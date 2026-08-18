<?php
namespace App\Services;
use App\Models\OrderDetail;
class OrderDetailService
{ /** * Get all order details */
    public function getAll()
    {
        return OrderDetail::with(['order', 'menuItem'])->latest()->paginate(10);
    } /** * Create order detail */
    public function create(array $data)
    {
        return OrderDetail::create($data);
    } /** * Find one order detail */
    public function find(OrderDetail $orderDetail)
    {
        return $orderDetail->load(['order', 'menuItem']);
    } /** * Update order detail */
    public function update(OrderDetail $orderDetail, array $data)
    {
        $orderDetail->update($data);
        return $orderDetail;
    } /** * Delete order detail */
    public function delete(OrderDetail $orderDetail)
    {
        return $orderDetail->delete();
    }
}