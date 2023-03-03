@extends('user.auth.index')

@section('register')

<div class="bg bg-cover h-[1000px]" style="background-image: url(image/bgSecond.svg)">
    <div class="container">
        
       
            <div class="textHeader mb-6 ml-[730px] pt-12 font-mont">
                <p class="text-4xl font-bold leading-[43px] mb-1">Hey,<br>Let’s Start with Public Complaint!</p>
                <p class="text-base font-medium text-slate-500">Just create your account now, and join with us!</p>
            </div>
            <div class="form ml-[730px] font-mont w-[610px] gap-4">
                <div class="bodyForm flex flex-col gap-6 mb-4">
                    <div class="signUp flex gap-6">
                        <button class="flex items-center gap-1  border border-slate-200 rounded px-5 py-2">
                          <img src="image/google.svg" alt="">
                          <p class="text-slate-500 text-sm font-medium">Sign Up With Google</p>
                        </button>
                        <button class="flex items-center gap-1  border border-slate-200 rounded px-5 py-2">
                          <img src="image/microsoft.svg" alt="">
                          <p class="text-slate-500 text-sm font-medium">Sign Up With Microsoft</p>
                        </button>
                    </div>
                    <div class="or flex items-center gap-2">
                        <div class="w-full h-[1px] bg-slate-200"></div>
                        <p class="text-xs font-medium text-slate-500">OR</p>
                        <div class="w-full h-[1px] bg-slate-200"></div>
                    </div>
                    <form action="register/auth" method="POST">
                        @csrf {{ csrf_field() }} 
                    <div class="input flex flex-col gap-5">
                        <div class="flex gap-2">
                                <div class="input flex flex-col w-full">
                                    <label for="nama" class="mb-2 font-semibold">What should we call you?</label>
                                    <input name="nama" type="text" id="nama" value="{{ old('nama') }}" class="px-4 py-3 text-sm font-medium rounded outline-2 border-b-slate-300 border-[1px] border-solid outline-slate-300 bg-bg w-full @error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @enderror" placeholder="input your name here...">
                                   
                                </div>
                                <div class="input flex flex-col w-full">
                                    <label for="username" class="mb-2 font-semibold">Username</label>
                                    <input name="username" type="text" id="username" value="{{ old('username') }}" class="px-4 py-3 text-sm font-medium rounded outline-2 border-b-slate-300 border-[1px] border-solid outline-slate-300 bg-bg w-full @error('username') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @enderror" placeholder="what is your username?">
                                    @error('username')
                                <div class="invalid-feedback">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> Username already taken!</p>
                                </div>
                                @enderror
                                </div>
                        </div>
                        <div class="emailAndNIK flex gap-2">
                            <div class="input flex flex-col w-full">
                                <label for="email" class="mb-2 font-semibold">Email</label>
                                <input name="email" type="text" id="email" value="{{ old('email') }}" class="px-4 py-3 text-sm font-medium rounded outline-2 border-b-slate-300 border-[1px] border-solid outline-slate-300 bg-bg w-full @error('email') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @enderror" placeholder="input your email here...">
                                @error('email')
                                <div class="invalid-feedback">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> Email already taken!</p>
                                </div>
                                @enderror
                            </div>
                            <div class="input flex flex-col w-full">
                                <label for="nik" class="mb-2 font-semibold">NIK</label>
                                <input name="nik" type="text" id="nik" value="{{ old('nik') }}" class="px-4 py-3 text-sm font-medium rounded outline-2 border-b-slate-300 border-[1px] border-solid outline-slate-300 bg-bg w-full @error('nik') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @enderror" placeholder="input your NIK here..." >
                                @error('nik')
                                <div class="invalid-feedback">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> NIK already taken!</p>
                                </div>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="input flex flex-col">
                            <label for="password" class="mb-2 font-semibold">Password</label>
                            <input name="password" type="password" id="password" value="{{ old('password') }}" class="px-4 py-3 text-sm font-medium rounded outline-2 border-b-slate-300 border-[1px] border-solid outline-slate-300 bg-bg w-full @error('password') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-red-100 dark:border-red-400 @enderror" placeholder="input your password here...">
                            @error('password')
                                <div class="">
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> Password Min 6 Karakter</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                    @if (Session::has('pesan'))
                        <div class="alert alert-danger my-2">
                            {{ Session::get('pesan') }}
                        </div>
                    @endif
                </div>
                {{-- diluar body form --}}
                <div class="checkBox text-slate-400 flex gap-2 text-sm font-medium mb-6">
                    <input type="checkbox" name="" id="" class="w-[14px] h-[14px] bg-bg border border-slate-300" id="check">
                    <label for="check">You agree to Public Complaint <span class="text-blue-500">Term of Use</span> and <span class="text-blue-400">Privacy Policy.</span></label>
                </div>
                <button type="submit" class="w-full py-3 bg-blue-600 text-white mb-6 rounded hover:bg-blue-800 focus:ring-blue-400 focus:ring-4">Sign Up</button>
                <p class="text-slate-400 text-sm font-medium font-mont text-center ">Already have an account? <a href="/" class="text-blue-500">Log in here!</a></p>
                {{-- diluar body form --}}
            </div>
        </form>
    </div>
</div>
@if (Session::has('pesan'))
    <div class="alert alert-danger my-2">
        {{ Session::get('pesan') }}
    </div>
@endif
    
@endsection