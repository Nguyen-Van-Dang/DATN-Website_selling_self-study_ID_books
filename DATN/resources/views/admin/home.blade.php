@extends('layouts.admin.admin')

@section('title', 'Quản trị')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-line"></i></div>
                            <div class="text-left ml-3">
                                <h2 class="mb-0"><span class="counter">{{ $userCount }}</span></h2>
                                <h5 class="">Người dùng</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-book-2-line"></i></div>
                            <div class="text-left ml-3">
                                <h2 class="mb-0"><span class="counter">{{ $bookCount }}</span></h2>
                                <h5 class="">Sách</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-info"><i class="ri-book-line"></i></div>
                            <div class="text-left ml-3">
                                <h2 class="mb-0"><span class="counter">{{ $courseCount }}</span></h2>
                                <h5 class="">Khóa Học</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-shopping-cart-2-line"></i>
                            </div>
                            <div class="text-left ml-3">
                                <h2 class="mb-0"><span class="counter">{{ $orderCount }}</span></h2>
                                <h5 class="">Đơn Hàng</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Doanh số hàng tuần</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div id="iq-sale-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Doanh số hàng tháng</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="list-inline p-0 mb-0">
                            <li>
                                <div class="iq-details mb-2">
                                    <span class="title">Thu nhập</span>
                                    <div class="percentage float-right text-primary">
                                        {{ number_format($monthlyIncome) }}
                                        <span>đ</span>
                                    </div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                        <div class="iq-progress-bar iq-bg-primary">
                                            <span class="bg-primary" data-percent="100"></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="iq-details mb-2">
                                    <span class="title">Sách Bán Được</span>
                                    <div class="percentage float-right text-warning">{{ number_format($bookSold) }}
                                        <span>Cuốn</span>
                                    </div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                        <div class="iq-progress-bar iq-bg-warning">
                                            <span class="bg-warning" data-percent="100"></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="iq-details mb-2">
                                    <span class="title">Khóa Học Bán Được</span>
                                    <div class="percentage float-right text-info">{{ number_format($courseSold) }}
                                        <span>Khóa Học</span>
                                    </div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                        <div class="iq-progress-bar iq-bg-info">
                                            <span class="bg-info" data-percent="100"></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-body">
                        <h4 class="text-uppercase text-black mb-0">Phiên (Bây giờ)</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="font-size-80 text-black">12</div>
                            <div class="text-left">
                                <p class="m-0 text-uppercase font-size-12">1 giờ</p>
                                <div class="mb-1 text-black">1500<span class="text-danger"><i
                                            class="ri-arrow-down-s-fill"></i>3.25%</span></div>
                                <p class="m-0 text-uppercase font-size-12">1 ngày</p>
                                <div class="mb-1 text-black">1890<span class="text-success"><i
                                            class="ri-arrow-down-s-fill"></i>1.00%</span></div>
                                <p class="m-0 text-uppercase font-size-12">1 tuần</p>
                                <div class="text-black">1260<span class="text-danger"><i
                                            class="ri-arrow-down-s-fill"></i>9.87%</span></div>
                            </div>
                        </div>
                        <div id="wave-chart-7"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Chi Tiết Đơn Hàng</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Hóa đơn</th>
                                        <th scope="col">Số tiền</th>
                                        <th scope="col">Tình trạng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="text-center">
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ number_format($order->price) }}đ</td>
                                            <td>
                                                <div
                                                    class="badge badge-pill {{ $order->payment_status == 1 || $order->payment_status == 3 ? 'badge-success' : 'badge-danger' }}">
                                                    @if ($order->payment_status == 0)
                                                        Chưa thanh toán
                                                    @elseif ($order->payment_status == 1)
                                                        Đã thanh toán
                                                    @elseif ($order->payment_status == 2)
                                                        Đang giao
                                                    @else
                                                        Đã Giao
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            $(document).ready(function() {
                $('.apexcharts-yaxis-label').each(function() {
                    $(this).attr('x', 25); // trị giá bên trái cột DSHTuần
                });
            });
            if (jQuery('#iq-sale-chart').length) {
                var options = {
                    series: [{
                        name: 'Doanh Thu',
                        data: @json($dailySales)
                    }],
                    chart: {
                        type: 'bar'
                    },
                    colors: ['#0dd6b8'],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '45%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: ['Chủ Nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', ],
                    },
                    yaxis: {
                        title: {
                            text: ''
                        },
                        labels: {
                            offsetX: -20,
                            offsetY: 0
                        },
                    },
                    grid: {
                        padding: {
                            left: -5,
                            right: 0
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val.toLocaleString('vi-VN') + " đ";
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#iq-sale-chart"), options);
                chart.render();
            }
        </script>
    </div>
@endsection
