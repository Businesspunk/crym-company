@extends('components.layout')

@section('content')
<main>
    <div class="container">
        <div class="error_404">
            <h3>Страница не найдена</h3>
            <div class="to_home"><a class="firm_btn btn_white" href="{{ route('main') }}">На главную</a></div>
        </div>
    </div>
</main>
@endsection