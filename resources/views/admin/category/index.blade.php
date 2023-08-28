@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>قائمة الاقسام</h1>
                        <div class="top-right-button-container">
                            <a href="{{URL('/create-category')}}" class="btn btn-primary btn-lg top-right-button mr-1">انشاء </a>
                        </div>
                    </div>

                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card" style="overflow: auto">
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">الاسم</th>
                                <th scope="col" class="text-center">الوصف</th>
                                <th scope="col" class="text-center">السعر</th>
                                <th scope="col" class="text-center">تعديل</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td class="text-center">{{$data->name}}</td>
                                    <td class="text-center">{{$data->desc}}</td>
                                    <td class="text-center">{{$data->price}}</td>
                                    <td class="text-center"><a href="{{URL('/edite-category-'.$data->id)}}" class="btn btn-sm btn-outline-primary">تعديل</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>{{$datas->links()}}</tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </main>
@endsection
