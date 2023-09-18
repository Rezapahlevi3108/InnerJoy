@extends('layout.main')

@section('content')
    <div class="my-5 pt-5">
        <h1 class="font-size-30 font-weight-600 color-primary-2 text-center mb-5">Beranda</h1>
        @foreach ($data as $item)
        <div class="border border-2 border-start-0 border-end-0 py-4">
            <div class="container">
                <div class="row">
                    <div class="col-10">
                        <a href="{{ route('posting', ['id' => $item->id]) }}">
                            <div class="d-flex">
                                <img src="{{ $item->cover ? asset('images/' . $item->cover) : asset('images/lost_home.jpg') }}" class="img-posting rounded me-3 me-md-4" alt="story-image">
                                <div>
                                    <h1 class="title-posting">{{ $item->title }}</h1>
                                    <p class="content-posting">{{ $item->content }}</p>
                                    <div class="d-flex">
                                        <div class="visibilitas-posting d-flex align-items-center me-3">
                                            <i class="fa-solid fa-eye me-1"></i>
                                            <span>{{ $item->see }}</span>
                                        </div>
                                        <div class="visibilitas-posting d-flex align-items-center me-3">
                                            <i class="fa-solid fa-heart me-1" style="color: #e64c4c;"></i>
                                            <span>{{ $item->like }}</span>
                                        </div>
                                        <div class="date-posting d-flex align-items-center font-weight-400 d-md-none">
                                            <i class="fa-solid fa-calendar-days me-2"></i>
                                            <span>{{ Carbon\Carbon::parse($item->created_at)->format('d m Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2 d-none d-md-block">
                        <div class="d-flex align-items-center justify-content-end font-size-12 font-weight-400 mt-3 mt-md-0 text-end">
                            <i class="fa-solid fa-calendar-days me-2"></i>
                            <span>{{ Carbon\Carbon::parse($item->created_at)->format('d m Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
