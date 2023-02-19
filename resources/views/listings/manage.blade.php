@extends('layout')

@section('content')
    <x-card class="p-10 mx-4">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Manage Gigs</h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless ($listings->isEmpty())
                    @foreach ($listings as $list)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/list/{{$list->id}}">
                                    {{$list->title}}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/list/{{$list->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form method="POST" action="/list/{{$list->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500">
                                        <i class="fa-solid fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="text-center px-4 py-8 border-t border-b border-gray-300 text-lg">
                            Not Listings Found!
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
@endsection