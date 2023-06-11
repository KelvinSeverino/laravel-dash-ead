@extends('admin.layouts.app')

@section('title', 'Detalhes da Dúvida')

@section('content')
    <div class="w-full">
        <div class="bg-white overflow-y-auto">
            <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
                <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200">
                    <div class="relative flex items-center space-x-4">
                        <div class="relative">
                            <span class="absolute text-green-500 right-0 bottom-0">
                                <svg width="20" height="20">
                                <circle cx="8" cy="8" r="8" fill="currentColor"></circle>
                                </svg>
                            </span>

                            <img class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"
                            src="{{ $support->user->image ? url("storage/{$support->user->image}") : url('images/user.png') }}"
                            alt="{{ $support->user->name }}">
                        </div>
                        <div class="flex flex-col leading-tight">
                            <div class="text-2xl mt-1 flex items-center">
                                <span class="text-gray-700 mr-3">{{ $support->user->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        <button type="button" class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>
                        <button type="button" class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex sm:items-center justify-between py-6 border-b-2 border-gray-200">
                    <div class="relative flex items-center space-x-4">
                        <span class="text-gray-700 mr-3">
                            {{ $support->description }}
                        </span>
                    </div>
                </div>

                <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">

                    {{-- @foreach ($support->replies as $reply)
                        <div class="chat-message">
                            @php
                                $user = $reply->user ?? $reply->admin;
                            @endphp
                            @if ($user->id == $support->user->id)
                                <div class="flex items-end">
                                    <div class="flex flex-col space-y-2 max-w-xs mx-2 order-2 items-start">
                                        <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">
                                            {{ $reply->description }}
                                        </span></div>
                                    </div>
                                    <img src="{{ $user->image ? url("storage/{$user->image}") : url('images/user.png') }}" class="w-6 h-6 rounded-full order-1">
                                </div>
                            @else
                                <div class="flex items-end justify-end">
                                    <div class="flex flex-col space-y-2 max-w-xs mx-2 order-1 items-end">
                                    <div><span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">
                                        {{ $reply->description }}
                                    </span></div>
                                    </div>
                                    <img src="{{ $user->image ? url("storage/{$user->image}") : url('images/user.png') }}" alt="My profile" class="w-6 h-6 rounded-full order-2">
                                </div>
                            @endif
                        </div>
                    @endforeach --}}

                    @foreach ($support->replies as $reply)
                        @php
                            $whenRepliesIsAuthor = $reply->user->id == $support->user->id;
                            $classChatMessage = $whenRepliesIsAuthor ? '' : 'justify-end';
                            $bgChat = $whenRepliesIsAuthor ? 'rounded-bl-none bg-gray-300 text-gray-600' : 'rounded-br-none bg-blue-600 text-white';

                            $orderImg = $whenRepliesIsAuthor ? 'order-1' : 'order-2';
                            $orderText = $whenRepliesIsAuthor ? 'order-2' : 'order-1';

                            $image = $reply->user->image ? url("storage/{$reply->user->image}") : url('images/user.png');
                        @endphp

                        <div class="chat-message">
                            <div class="flex items-end {{ $classChatMessage }}">
                                <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 {{ $orderText }} items-start">
                                    <div>
                                        <span class="px-4 py-2 rounded-lg inline-block {{ $bgChat }} ">
                                            {{ $reply->description }}
                                        </span>
                                    </div>
                                </div>
                                <img src="{{ $image }}" class="w-6 h-6 rounded-full {{ $orderImg }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
                    <div class="relative flex">
                        <span class="absolute inset-y-0 flex items-center">
                            <button type="button" class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                </svg>
                            </button>
                        </span>
                        <input type="text" placeholder="Write your message!" class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3">
                        <div class="absolute right-0 items-center inset-y-0 hidden sm:flex">
                            <button type="button" class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                                <span class="font-bold">Enviar</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 ml-2 transform rotate-90">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const el = document.getElementById('messages')
        el.scrollTop = el.scrollHeight
    </script>

@endsection
