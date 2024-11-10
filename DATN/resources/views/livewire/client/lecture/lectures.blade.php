<div>
    <div class="course" style="padding: 20px; background: #0dd6b8; font-size: 20px; font-weight: bold; color: #444444;">
        <a href="{{ route('homeClient') }}" style="text-decoration:none">Trở về</a>
    </div>

    <div class="row" style="height: 90vh; width: 100%;">
        <div class="col-lg-9" style="padding: 0; height: 90vh; background: black">
            <source src="{{ $lecture->video_url }}" type="video/mp4">
            {{-- <img src="https://images.pexels.com/photos/2728238/pexels-photo-2728238.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                style="height: 80%; object-fit: cover; width: 100%;"> --}}
            <div class="d-flex align-items-center osahan-post-header p-10"
                style=" background: black; margin-left: 10%; margin-top: 3%">
                <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                    style="width: 5%;" />
                <div class="p-2"></div>
                <div class="font-weight-bold mr-3">
                    <div class="text-truncate" style="font-weight: bolder; color: white">Thầy Nguyễn Văn A</div>
                </div>
                <button id="yesButton" type="submit"
                    style="background-color: #ff4d6d; color: white; border: none; padding: 10px 45px; font-size: 14px; border-radius: 5px; cursor: pointer; font-weight: bolder;">Theo
                    dõi</button>
            </div>
        </div>
        <div class="col-lg-3" style="height: 90vh;">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex align-items-center bg-light osahan-post-header">
                                    <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                        alt="" style="width: 15%;" />
                                    <div class="pe-2"></div>
                                    <div class="font-weight-bold mr-3">
                                        <div class="text-truncate" style="font-weight: bolder;">Thầy Nguyễn Văn A</div>
                                    </div>
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="box shadow-sm rounded bg-white"
                                style="height: calc(90vh - 80px); overflow: hidden;">
                                <div class="box-body p-0" style="height: calc(100% - 50px); overflow-y: auto;">
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                                                style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                                                style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                                                style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>


                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                                                style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                                                style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png" alt=""
                                                style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>

                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>


                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                <div class="d-flex align-items-center bg-light osahan-post-header">
                                    <div class="font-weight-bold mr-3">
                                        <div class="text-truncate" style="font-weight: bolder;">Bình luận</div>
                                    </div>
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <div class="box shadow-sm rounded bg-white"
                                style="height: calc(90vh - 80px); overflow: hidden;">
                                <div class="box-body p-0" style="height: calc(100% - 50px); overflow-y: auto;">
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>


                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>

                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>


                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                    <div class="p-3 d-flex align-items-center bg-light osahan-post-header">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle"
                                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                alt="" style="width: 40%;" />
                                        </div>
                                        <div class="mr-3">
                                            <div class="text-truncate">DAILY RUNDOWN: WEDNESDAY</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
