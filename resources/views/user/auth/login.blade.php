@extends('user.auth.index')

@section('login')
<div class="bg h-[1000px] bg-cover" style="background-image: url(image/bgFinal.png)">
    <div class="container px-[72px]">
        <div class="form mt-12  font-mont w-[420px] ">
            <form action="/login/auth" method="POST">
              @csrf
                <div class="textHeader mb-6">
                    <p class="text-5xl font-bold leading-[72px]">Hey,<br>Welcome Back!</p>
                    <p class="text-base font-medium text-slate-500">We are very happy to see you back!</p>
                </div>
                <div class="input flex flex-col gap-5 mb-7">
                    <div class="input flex flex-col">
                        <label for="email" class="mb-2 font-semibold">Email</label>
                        <input type="text" id="email" name="username" class="px-4 py-3 text-sm font-medium rounded outline-2 border-b-slate-300 border-[1px] border-solid outline-slate-300 bg-bg w-[420px]" placeholder="input your email here...">
                    </div>
                    <div class="input flex flex-col">
                        <label for="password" class="mb-2 font-semibold">Password</label>
                        <input type="password" id="password"name="password" class="px-4 py-3 text-sm font-medium rounded outline-2 border-b-slate-300 border-[1px] border-solid outline-slate-300 bg-bg w-[420px]" placeholder="input your password here...">
                    </div>
                </div>
                @if (Session::has('pesan'))
                  <div class="flex font-medium p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                      <p>Snapp!! Something went wrong</p>
                  </div>
                @endif
                <div class="checkBox text-slate-400 flex gap-2 text-sm font-medium leading-[25px] mb-3">
                    <input type="checkbox" name="" id="" class="w-[14px] h-[14px] bg-bg border border-slate-300" id="check">
                    <label for="check">By signing up, you are creating a COMMIT account, and<br>you agreeto COMMIT’s <span class="text-blue-500">Term of Use</span> and <span class="text-blue-500">Privacy Policy. </span></label>
                </div>
                <div class="checkBox text-slate-400 flex gap-2 text-sm font-medium mb-6">
                  <input type="checkbox" name="" id="" class="w-[14px] h-[14px] bg-bg border border-slate-300" id="check">
                  <label for="check">Remember Me as <span class="text-blue-500">Member</span> of <span class="text-blue-500">COMMIT Community</span></label>
                </div>
              <div class="footer flex flex-col gap-4 mb-6">
                  <button type="submit" class="px-[188px] py-3 bg-blue-600 text-white rounded hover:bg-blue-800 focus:ring-blue-400 focus:ring-4">Login</button>
                <div class="or flex items-center gap-2">
                  <div class="w-full h-[1px] bg-slate-200"></div>
                  <p class="text-xs font-medium text-slate-500">OR</p>
                  <div class="w-full h-[1px] bg-slate-200"></div>
                </div>
                <div class="signIn flex gap-12">
                  <button class="flex items-center gap-1  border border-slate-200 rounded px-5 py-2">
                    <img src="image/google.svg" alt="">
                    <p class="text-slate-500 text-sm font-medium">Login With Google</p>
                  </button>
                  <button  class="flex items-center gap-1  border border-slate-200 rounded px-5 py-2">
                    <img src="image/microsoft.svg" alt="">
                    <p class="text-slate-500 text-sm font-medium">Login With Microsoft</p>
                  </button>
                </div>
              </div>
              <p class="text-slate-400 text-sm font-medium font-mont text-center ">Do not have an account? <a href="/register" class="text-blue-500">Register here!</a></p>     
            </form>
        </div>
    </div>
  </div>
  
@endsection

