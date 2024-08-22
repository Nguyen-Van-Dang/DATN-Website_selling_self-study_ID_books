@extends('layouts.client.client')

@section('title', 'Thông Tin Tài khoản')

@section('content')
       <div class="row">
          <div class="col-lg-12">
             <div class="iq-card">
                <div class="iq-card-body p-0">
                   <div class="iq-edit-list">
                      <ul class="iq-edit-profile d-flex nav nav-pills">
                         <li class="col-md-3 p-0">
                            <a class="nav-link active" data-toggle="pill" href="#personal-information">
                               Thông tin cá nhân
                            </a>
                         </li>
                         <li class="col-md-3 p-0">
                            <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                               Đổi mật khẩu
                            </a>
                         </li>
                         <li class="col-md-3 p-0">
                            <a class="nav-link" data-toggle="pill" href="#emailandsms">
                               Lịch sử bài kiểm tra
                            </a>
                         </li>
                         <li class="col-md-3 p-0">
                            <a class="nav-link" data-toggle="pill" href="#manage-contact">
                               Lịch sử đơn hàng
                            </a>
                         </li>
                      </ul>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-lg-12">
             <div class="iq-edit-list-data">
                <div class="tab-content">
                    {{-- thông tin người dùng --}}
                   <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                      <div class="iq-card">
                         <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                               <h4 class="card-title">Thông tin cá nhân</h4>
                            </div>
                         </div>
                         <div class="iq-card-body">
                            <form>
                               <div class="form-group row align-items-center">
                                  <div class="col-md-12">
                                     <div class="profile-img-edit">
                                        <img class="profile-pic" src="{{ asset('assets/images/user/1.jpg') }}" alt="profile-pic">
                                        <div class="p-image">
                                           <i class="ri-pencil-line upload-button"></i>
                                           <input class="file-upload" type="file" accept="image/*"/>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class=" row align-items-center">
                                  <div class="form-group col-sm-6">
                                     <label for="fname">First Name:</label>
                                     <input type="text" class="form-control" id="fname" value="Ông">
                                  </div>
                                  <div class="form-group col-sm-6">
                                     <label for="lname">Last Name:</label>
                                     <input type="text" class="form-control" id="lname" value="Trần Thuận">
                                  </div>
                                  <div class="form-group col-sm-6">
                                     <label for="uname">Tên tài khoản:</label>
                                     <input type="text" class="form-control" id="uname" value="Thuangiaosu">
                                  </div>
                                  <div class="form-group col-sm-6">
                                     <label for="cname">Công ty:</label>
                                     <input type="text" class="form-control" id="cname" value="TV Team">
                                  </div>
                                  <div class="form-group col-sm-6">
                                     <label class="d-block">Giới tính:</label>
                                     <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio6" name="customRadio1" class="custom-control-input" checked="">
                                        <label class="custom-control-label" for="customRadio6"> Nam </label>
                                     </div>
                                     <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio7" name="customRadio1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio7"> Nữ </label>
                                     </div>
                                  </div>
                                  <div class="form-group col-sm-6">
                                     <label for="dob">Ngày sinh:</label>
                                     <input  class="form-control" id="dob" value="1984-01-24">
                                  </div>
                                  <div class="form-group col-sm-6">
                                     <label>Tình trạng hôn nhân:</label>
                                     <select class="form-control" id="exampleFormControlSelect1">
                                        <option selected="">Độc thân</option>
                                        <option>Đã kết hôn</option>
                                        <option>Góa</option>
                                        <option>Đã ly hôn</option>
                                        <option>Ly thân </option>
                                     </select>
                                  </div>
                                  <div class="form-group col-sm-6">
                                     <label>Tuổi:</label>
                                     <select class="form-control" id="exampleFormControlSelect2">
                                        <option>12-18</option>
                                        <option>19-32</option>
                                        <option selected="">33-45</option>
                                        <option>46-62</option>
                                        <option>63 > </option>
                                     </select>
                                  </div>
                                  <div class="form-group col-sm-6">
                                     <label>Quốc gia:</label>
                                     <select class="form-control" id="exampleFormControlSelect3">
                                        <option>Laos</option>
                                        <option>China</option>
                                        <option selected="">Viet Nam</option>
                                        <option>Indo</option>
                                        <option>USA</option>
                                     </select>
                                  </div>
                                  <div class="form-group col-sm-6">
                                     <label>Tỉnh/Thành phố:</label>
                                     <select class="form-control" id="exampleFormControlSelect4">
                                        <option></option>
                                        <option>Hà Nội</option>
                                        <option selected="">Đà Nẵng</option>
                                        <option>HCM</option>
                                        <option>Buôn Ma Thuột</option>
                                     </select>
                                  </div>
                                  <div class="form-group col-sm-12">
                                     <label>Địa chỉ:</label>
                                     <textarea class="form-control" name="address" rows="5" style="line-height: 22px;">
                                        06 Nam Thành
                                        Đà Nãng, VA 23803
                                        Viet Nam
                                        Zip Code: 40001
                                     </textarea>
                                  </div>
                               </div>
                               <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                               <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                            </form>
                         </div>
                      </div>
                   </div>
                    {{-- đổi mật khẩu --}}
                   <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                      <div class="iq-card">
                         <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                               <h4 class="card-title">Đổi mật khẩu</h4>
                            </div>
                         </div>
                         <div class="iq-card-body">
                            <form>
                               <div class="form-group">
                                  <label for="cpass">Mật khẩu hiện tại:</label>
                                  <a href="javascripe:void();" class="float-right">Quên mật khẩu</a>
                                  <input type="Password" class="form-control" id="cpass" value="">
                               </div>
                               <div class="form-group">
                                  <label for="npass">Mật khẩu mới:</label>
                                  <input type="Password" class="form-control" id="npass" value="">
                               </div>
                               <div class="form-group">
                                  <label for="vpass">Xác nhận lại mật khẩu:</label>
                                  <input type="Password" class="form-control" id="vpass" value="">
                               </div>
                               <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                               <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                            </form>
                         </div>
                      </div>
                   </div>
                    {{-- Lịch sử bài kiểm tra --}}
                   <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                      <div class="iq-card">
                         <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                               <h4 class="card-title">Lịch Sử Bài Kiểm Tra</h4>
                            </div>
                         </div>
                         <div class="iq-card-body">
                            <form>
                               <div class="form-group row align-items-center">
                                  <label class="col-8 col-md-3" for="emailnotification">Thông báo tới Email :</label>
                                  <div class="col-4 col-md-9 custom-control custom-switch">
                                     <input type="checkbox" class="custom-control-input" id="emailnotification" checked="">
                                     <label class="custom-control-label" for="emailnotification"></label>
                                  </div>
                               </div>
                               <div class="form-group row align-items-center">
                                  <label class="col-8 col-md-3" for="smsnotification">Thông báo tới SMS:</label>
                                  <div class="col-4 col-md-9 custom-control custom-switch">
                                     <input type="checkbox" class="custom-control-input" id="smsnotification" checked="">
                                     <label class="custom-control-label" for="smsnotification"></label>
                                  </div>
                               </div>
                               <div class="form-group row align-items-center">
                                  <label class="col-md-3" for="npass">Khi nào gửi Email</label>
                                  <div class="col-md-9">
                                     <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="email01">
                                        <label class="custom-control-label" for="email01">Bạn có thông báo mới.</label>
                                     </div>
                                     <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="email02">
                                        <label class="custom-control-label" for="email02">Bạn đã gửi một tin nhắn trực tiếp</label>
                                     </div>
                                     <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="email03" checked="">
                                        <label class="custom-control-label" for="email03">Ai đó thêm bạn làm kết nối</label>
                                     </div>
                                  </div>
                               </div>
                               <div class="form-group row align-items-center">
                                  <label class="col-md-3" for="npass">Khi nào cần báo email</label>
                                  <div class="col-md-9">
                                     <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="email04">
                                        <label class="custom-control-label" for="email04"> Theo đơn đặt hàng mới.</label>
                                     </div>
                                     <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="email05">
                                        <label class="custom-control-label" for="email05"> Phê duyệt thành viên mới</label>
                                     </div>
                                     <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="email06" checked="">
                                        <label class="custom-control-label" for="email06"> Đăng ký thành viên</label>
                                     </div>
                                  </div>
                               </div>
                               <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                               <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                            </form>
                         </div>
                      </div>
                   </div>
                    {{-- lịch sử đơn hàng --}}
                   <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                      <div class="iq-card">
                         <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                               <h4 class="card-title">Lịch Sử Đơn Hàng</h4>
                            </div>
                         </div>
                         <div class="iq-card-body">
                            <form>
                               <div class="form-group">
                                  <label for="cno">Số liên lạc:</label>
                                  <input type="text" class="form-control" id="cno" value="089">
                               </div>
                               <div class="form-group">
                                  <label for="email">Email:</label>
                                  <input type="text" class="form-control" id="email" value="tvtean@ttnm.com">
                               </div>
                               <div class="form-group">
                                  <label for="url">Url:</label>
                                  <input type="text" class="form-control" id="url" value="https://nhasachtv.com">
                               </div>
                               <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                               <button type="reset" class="btn iq-bg-danger">Hủy bỏ</button>
                            </form>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
@endsection