@extends('layouts.base', ['title' => 'Users - Administrator - Laravel 9'])

@section('content')
    @include('layouts.header', ['title' => 'Users', 'action' => 'users'])
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @forelse ($pendaftaran as $regis)
                    <x-card title="{{ $regis->nama }}" subtitle="{{ $regis->date_created }}">
                    </x-card>
                @empty
                    <div class="alert alert-info">Tidak ada data</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
