@extends('layouts.admin')
@section('userlist')
<div class="p-6 sm:ml-64">
    <div class="p-8 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input. <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
       <div class="grid grid-cols-2 gap-4">
        <h1>Action Done by, <strong>{{ Auth::user()->username }}</strong></h1>
       </div>
    </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Post List
            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Clients, stay organized, get answers, keep in touch, grow your business, and more.</p>
            <div class="text-left ">
                <a href="{{route('post.create')}}" class="px-5 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600">
                    <strong>+  </strong> Add Posts
                </a>
            </div>
        </caption>
        <br>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                   Post Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Need For
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
                <th scope="col" class="px-3 py-3">
                    <span class="">Message</span>
                </th>
                <th scope="col" class="px-3 py-3">
                    <span class="">Duration</span>
                </th>
                <th scope="col" class="px-3 py-3">
                    <span class="">Image</span>
                </th>
                <th scope="col" class="px-3 py-3">
                    <span class="">Delete</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{-- {{ $client->id }} --}}
                        {{$post->id}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{-- {{ $client->username }} --}}
                        {{ $post->first_name . ' ' . $post->last_name }}
                    </th>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{-- {{ $client->role }} --}}
                        <p>{{ $post->profession->name }}</p>
                    </td>
                    <td class="px-6 py-4">
                        {{-- {{ $client->email }} --}}
                        {{$post->email}}

                    </td>
                    <td class="px-6 py-4">
                        {{-- {{ $client->created_at }} --}}
                        {{$post->phone}}
                    </td>
                    <td class="px-6 py-4">
                        {{-- {{ $client->created_at }} --}}
                        {{$post->message }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{-- {{ $client->created_at }} --}}
                        {{$post->duration }}
                    </td>
                    <td class="px-6 py-4">
                        <img src=" {{ asset('images/' . $post->image)}}" alt="">
                        {{-- {{ $client->created_at }} --}}
                       

                    </td>
                    {{-- <td class="px-8 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ asset('images/' . $post->image)}}</a>
                    </td> --}}
                    <td class="px-8 py-4 text-right">
                        <form action="{{route('post.destroy',$post->id )}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="font-medium text-red-600 dark:text-blue-500 hover:underline" type="submit"
                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                        <a href="{{route('post.edit',$post->id )}}">
                            <button class="font-medium text-green-600 dark:text-blue-500 hover:underline" type="submit">Edit</button>
                        </a>
                       
                        {{-- <button type="submit" class="font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</button> --}}
                    </td>
                </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
</div>
 </div>
</div>
</div>
</div>
@endsection
