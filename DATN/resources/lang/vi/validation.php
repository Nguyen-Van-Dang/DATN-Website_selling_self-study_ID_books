<?php

return [
    'required' => ':attribute là bắt buộc.',
    'email' => ':attribute không đúng định dạng email.',
    'min' => ':attribute phải có ít nhất :min ký tự.',
    'max' => ':attribute không được quá :max ký tự.',
    'confirmed' => ':attribute không khớp với xác nhận.',
    'unique' => ':attribute đã tồn tại.',
    'exists' => ':attribute không tồn tại.',
    'in' => ':attribute không hợp lệ.',
    'numeric' => ':attribute phải là số.',
    'integer' => ':attribute phải là số nguyên.',
    'string' => ':attribute phải là chuỗi.',
    'boolean' => ':attribute phải là boolean.',
    'date' => ':attribute không đúng định dạng ngày.',
    'before' => ':attribute không được trước :date.',
    'after' => ':attribute không được sau :date.',
    'unique' => ':attribute đã tồn tại.',
    // Thêm thông báo lỗi khi không nhập tên
    'attributes' => [
        //khóa học
        'name' => 'tên danh mục khóa học',
        'nameAdd' => 'tên danh mục khóa học',
        'description' => 'mô tả khóa học',
        'descriptionAdd' => 'mô tả khóa học',
    ],
    'custom' => [
        //khóa học
        'name' => [
            'required' => 'Vui lòng nhập :attribute.',
        ],
        'nameAdd' => [
            'required' => 'Vui lòng nhập :attribute.',
        ],
        'description' => [
            'required' => 'Vui lòng nhập :attribute.',
        ],
        'descriptionAdd' => [
            'required' => 'Vui lòng nhập :attribute.',
        ],
    ],
];
