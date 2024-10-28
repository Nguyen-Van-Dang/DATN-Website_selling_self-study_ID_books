<?php

return [
    'required' => ':attribute là bắt buộc.',
    'unique' => ':attribute đã tồn tại.',
    // Thêm thông báo lỗi khi không nhập tên
    'attributes' => [
        'name' => 'tên danh mục khóa học',
        'nameAdd' => 'tên danh mục khóa học',
    ],
    'custom' => [
        'name' => [
            'required' => 'Vui lòng nhập :attribute.',
        ],
        'nameAdd' => [
            'required' => 'Vui lòng nhập :attribute.',
        ],
    ],
];
