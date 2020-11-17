@extends('layouts.main')

@section('title', 'Statistics')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>SOURCE</th>
                <th>SHORT</th>
                <th>ACTIVE TO</th>
                <th>COUNTS</th>
            </tr>
        </thead>
        <tbody>
        @forelse($rows as $row)
            <tr>
                <td>{{$row['id']}}</td>
                <td><a href="{{$row['source']}}" target="_blank">{{$row['source']}}</a></td>
                <td><a href="{{request()->getSchemeAndHttpHost() . '/' . $row['short']}}" target="_blank">
                        {{$row['short']}}
                    </a></td>
                <td>{{$row['active_to']}}</td>
                <td>{{$row['count_redirects']}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    Empty
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection