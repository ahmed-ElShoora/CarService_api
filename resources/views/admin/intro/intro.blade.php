@extends('layouts.admin')


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card mb-4">
                        <div class="card-body">
                        <form method="post" action="{{URL('/intro')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <h5 hidden class="">الصورة الافتتاحية لتطبيق الفني</h5>
                                    <img hidden src="{{asset('/'.$image_phane)}}" height="100px" width="100px">
                                    <input hidden type="file" value="{{$image_phane}}" id="image_phone" name="image_splash_phane" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                </div>
                            </div>

                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <h5 hidden class="">الصورة الافتتاحية لتطبيق العميل</h5>
                                    <img hidden src="{{asset('/'.$image_client)}}" height="100px" width="100px">
                                    <input hidden type="file" value="{{$image_client}}" id="image_phone" name="image_splash_client" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                </div>
                            </div>
                            <hr hidden>
                            <h4>التطبيق للفني</h4>











                            <p>الشاشه للعملاء</p>
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <h5 class="">الصورة</h5>
                                    <img src="{{asset('/'.$data_one_one->image)}}" height="100px" width="100px">
                                    <input hidden value="{{$data_one_one->image}}" required name="data_one_one_image_old">
                                    <input type="file" value="{{$data_one_one->image}}" id="image_phone" name="data_one_one_image" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                </div>
                            </div>
                            <div class="tooltip-center-top position-relative form-group">
                                <label>العنوان</label>
                                <input name="data_one_one_title" value="{{$data_one_one->title}}" required="" id="email" type="text" class="form-control">
                            </div>
                            <div class="tooltip-center-top position-relative form-group">
                                <label>الوصف</label>
                                <input name="data_one_one_desc" value="{{$data_one_one->desc}}" required="" id="email" type="text" class="form-control">
                            </div>











                            <p>الشاشه الثانية</p>
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <h5 class="">الصورة</h5>
                                    <img src="{{asset('/'.$data_one_two->image)}}" height="100px" width="100px">
                                    <input hidden value="{{$data_one_two->image}}" required name="data_one_two_image_old">
                                    <input type="file" value="{{$data_one_two->image}}" id="image_phone" name="data_one_two_image" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                </div>
                            </div>
                            <div class="tooltip-center-top position-relative form-group">
                                <label>العنوان</label>
                                <input name="data_one_two_title" value="{{$data_one_two->desc}}" required="" id="email" type="text" class="form-control">
                            </div>
                            <div class="tooltip-center-top position-relative form-group">
                                <label>الوصف</label>
                                <input name="data_one_two_desc" value="{{$data_one_two->desc}}" required="" id="email" type="text" class="form-control">
                            </div>











                            <hr>
                            <h4>التطبيق الثاني</h4>
                            <p>الشاشه الاولي</p>
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <h5 class="">الصورة</h5>
                                    <img src="{{asset('/'.$data_two_one->image)}}" height="100px" width="100px">
                                    <input hidden value="{{$data_two_one->image}}" required name="data_two_one_image_old">
                                    <input type="file" value="{{$data_two_one->image}}" id="image_phone" name="data_two_one_image" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                </div>
                            </div>
                            <div class="tooltip-center-top position-relative form-group">
                                <label>العنوان</label>
                                <input name="data_two_one_title" value="{{$data_two_one->title}}" required="" id="email" type="text" class="form-control">
                            </div>
                            <div class="tooltip-center-top position-relative form-group">
                                <label>الوصف</label>
                                <input name="data_two_one_desc" value="{{$data_two_one->desc}}" required="" id="email" type="text" class="form-control">
                            </div>









                            <p>الشاشه الثانية</p>
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <h5 class="">الصورة</h5>
                                    <img src="{{asset('/'.$data_two_two->image)}}" height="100px" width="100px">
                                    <input hidden value="{{$data_two_two->image}}" required name="data_two_two_image_old">
                                    <input type="file" value="{{$data_two_two->image}}" id="image_phone" name="data_two_two_image" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                </div>
                            </div>
                            <div class="tooltip-center-top position-relative form-group">
                                <label>العنوان</label>
                                <input name="data_two_two_title" value="{{$data_two_two->desc}}" required="" id="email" type="text" class="form-control">
                            </div>
                            <div class="tooltip-center-top position-relative form-group">
                                <label>الوصف</label>
                                <input name="data_two_two_desc" value="{{$data_two_two->desc}}" required="" id="email" type="text" class="form-control">
                            </div>
                            <button class="btn btn-primary mt-5" type="submit">تاكيد</button>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
