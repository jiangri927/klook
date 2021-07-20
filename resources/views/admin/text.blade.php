@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="padding: 40px;">
            <h2>{{$product->title}}</h2>
            <?php echo $product->info?>
        </div>
    </div>
@endsection
@section('additional_js')

@endsection
