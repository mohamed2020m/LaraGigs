@extends('layout')

@section('content')
    
    @include('partials._hero')
    @include('partials._search')

    @unless(count($listings) == 0)

        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

            @foreach($listings as $list)
                <x-listing-card :list="$list" />
            @endforeach

        </div>
        @else
        
        <p class="text-center pt-10">No listings found!</p>
        
    @endunless
    
    <div class="mt-6 p-4">
        {{$listings->links()}}
    </div>

@endsection
