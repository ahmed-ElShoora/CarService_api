@extends('layouts.admin')

@section('content')
    <main>
        <div class="container-fluid disable-text-selection">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="card" style="overflow: auto">
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                {{-- <th scope="col" class="text-center">الايدي الخاص</th> --}}
                                <th scope="col" class="text-center">الاسم</th>
                                <th scope="col" class="text-center">اسم القسم</th>
                                <th scope="col" class="text-center">البريد الاكتروني</th>
                                <th scope="col" class="text-center">رقم الهاتف</th>
                                <th scope="col" class="text-center">الباسورد</th>
                                <th scope="col" class="text-center">المدينة</th>
                                <th scope="col" class="text-center">الجنس</th>
                                <th scope="col" class="text-center">العمر</th>
                                <th scope="col" class="text-center">الخبرة</th>
                                <th scope="col" class="text-center">الارباح</th>
                                <th scope="col" class="text-center">وضع التفعيل</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    {{-- <td class="text-center">{{$data->id}}</td> --}}
                                    <td class="text-center">{{$data->name}}</td>
                                    <td class="text-center">{{$data->category_name}}</td>
                                    <td class="text-center">{{$data->email}}</td>
                                    <td class="text-center">{{$data->phone}}</td>
                                    <td class="text-center">{{$data->password_hash}}</td>
                                    <td class="text-center">{{$data->town}}</td>
                                    <td class="text-center">{{$data->gender}}</td>
                                    <td class="text-center">{{$data->age}}</td>
                                    <td class="text-center">{{$data->exeperince}}</td>
                                    <td class="text-center">{{$data->earn}}</td>
                                    <td class="text-center">
                                        @if ($data->status == false)
                                            <a href="{{URL('/tecnical-true-'.$data->id)}}" class="btn btn-sm btn-outline-primary">تفعيل</a>
                                        @else
                                            <a href="{{URL('/tecnical-false-'.$data->id)}}" class="btn btn-sm btn-outline-danger">الغاء تفعيل</a>
                                        @endif
                                        
                                    </td>
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
