<div>
    @forelse ($orderUsers as $order)
        <tr class="text-center">
            <td>{{ $order->id }}</td>
            <td>{{ $order->price }}</td>
            <td>{{10}}</td>
            <td>{{ $order->deleted_at }}</td>
            <td class="text-center">
                <a href="" class="btn btn-success">Khôi phục</a>
                <a href="" class="btn btn-danger">Xóa vĩnh viễn</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">Không có đơn hàng nào bị xóa</td>
        </tr>
    @endforelse
</div>
