@extends('layouts.admin')


@section('content')
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <h5 class="mb-4">تعديل</h5>


                    <div class="card mb-4">
                        <div class="card-body">
                        <form method="post" action="{{URL('/edite-ad')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الصورة</label>
                                    <input hidden type="text" name="id" value="{{$id}}">
                                    <input hidden type="text" name="image_old" value="{{$data->image}}">
                                    <input type="file" id="image_phone" name="image" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                </div>
                            </div>
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الاسم</label>
                                    <input name="title" required="" value="{{$data->title}}" id="Name" type="text" class="form-control" maxlength="18">
                                </div>
                            </div>
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>الرابط</label>
                                    <input name="link" required="" value="{{$data->link}}" id="Name" type="url" class="form-control">
                                </div>
                            </div>
                            <div class="tooltip-label-right">
                                <div class="error-l-100 position-relative form-group">
                                    <label>التطبيق</label>
                                    <select name="app" required="" id="Name" class="form-control">
                                        <option value="1" 
                                        @if ($data->app == 1)
                                            selected
                                        @endif
                                        >الفنيين</option>
                                        <option value="2"
                                        @if ($data->app == 2)
                                            selected
                                        @endif
                                        >العميل</option>
                                    </select>
                                </div>
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
