@extends('layouts.admin.admin')

@section('title', 'Phản hồi liên hệ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header">
                    <h4 class="card-title">Phản hồi liên hệ</h4>
                </div>
                <div class="iq-card-body">
                    <form method="POST" action="{{ route('sendReply', $contact->id) }}">
                        @csrf
                        <div class="form-group">
                            <label>Tên người liên hệ:</label>
                            <input type="text" class="form-control" value="{{ $contact->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" value="{{ $contact->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nội dung:</label>
                            <textarea class="form-control" readonly>{{ $contact->message }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Phản hồi:</label>
                            <textarea name="message" class="form-control" rows="4" placeholder="Nhập nội dung phản hồi..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
