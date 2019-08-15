@extends('site.layouts.default')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <ul class="nav nav-pills nav-stacked">
          @foreach($categories['main'] as $category)
            <li role="presentation">
              <a href="/site/{{ $category->alias }}">{{ $category->title }}</a>

              <ul>
                @foreach($categories[$category->id] ?? [] as $category)
                  <li role="presentation">
                    <a href="/site/{{ $category->alias }}">{{ $category->title }}</a>
                  </li>
                @endforeach
              </ul>
            </li>
          @endforeach
        </ul>
      </div>

      <div class="col-md-8">
        <div class="row">
          @foreach($products as $product)
            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <img src="{{ $product->image }}" alt="...">
                <div class="caption">
                  <h6>{{ $product->title }}</h6>
{{--                  <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>--}}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@stop