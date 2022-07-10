@extends('layouts.main')

@section('content')
    @if (count($rowsByDate) > 0)
        <div style="display: flex; flex-wrap: wrap">
        @foreach($rowsByDate as $date => $rows)
        <div style="margin: 10px 20px; background-color: lightgray">
            <p><b>{{ $date }}</b></p>
            @foreach($rows as $i => $row)
                [{{ implode('; ', $row) }}]
                @if ($i % 5 == 0)
                <br>
                @endif
            @endforeach
        </div>
        @endforeach
        </div>
    @else
        <p>No rows in DB</p>
    @endif
@endsection