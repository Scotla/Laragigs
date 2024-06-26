@extends('layout')
@section('content')

<x-card class="p-10  max-w-lg mx-auto mt-24">
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Log in
                        </h2>
                        <p class="mb-4">Log in to your account</p>
                    </header>

                    <form action="/users/authenticate" method="POST">
                        @csrf
                        

                        <div class="mb-6">
                            <label for="email" class="inline-block text-lg mb-2"
                                >Email</label
                            >
                            <input
                                type="email"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="email"
                                value="{{old('email')}}"
                            />
                            @error('email')
                            <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                            @enderror
                            <!-- Error Example -->
                            <p class="text-red-500 text-xs mt-1">
                                Please enter a valid email
                            </p>
                        </div>

                        <div class="mb-6">
                            <label
                                for="password"
                                class="inline-block text-lg mb-2"
                            >
                                Password
                            </label>
                            <input
                                type="password"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="password"
                                value="{{old('pasword')}}"
                            />
                            @error('password')
                            <div class="text-red-500 text-xs mt-1">{{$message}}</div>
                            @enderror
                        </div>

                        
                        <div class="mb-6">
                            <button
                                type="submit"
                                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Sign in
                            </button>
                        </div>

                        <div class="mt-8">
                            <p>
                                Don't have an account? !
                                <a href="/register" class="text-laravel"
                                    >Register</a
                                >
                            </p>
                        </div>
                    </form>
</x-card>

@endsection