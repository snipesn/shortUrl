@extends('layouts.main')

@section('title', 'Home / Add')

@section('content')
    <div class="row align-items-center justify-content-center jumbotron">
        <form action="/add" method="post" class="col-6">
            @csrf
            @if(Session::has('status'))
                <div class="alert alert-{{ (Session::get('status') === 'success' ? 'success' : 'danger')}}" role="alert">
                    @if(Session::has('short_url'))
                        Link successfully created <a href="{{Session::get('short_url')}}" target="_blank">{{Session::get('short_url')}}</a>
                    @else
                        Server error!
                    @endif
                </div>
            @endif
            <div class="form-group">
                <label for="source_url">Source url</label>
                <input type="url" class="form-control" id="source_url" name="source_url">
                @error('source_url')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ttl">Time to live short url</label>
                <input type="number" class="form-control" id="ttl" name="ttl" aria-describedby="ttl_description">
                <small id="ttl_description" class="form-text text-muted">time in hours</small>
                @error('ttl')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection