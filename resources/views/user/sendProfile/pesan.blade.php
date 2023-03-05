@extends('user.sendProfile.index')

@section('pesan')



@foreach ($pengaduan as $k => $v)




    
<div class="p-5 mb-4 border border-gray-100 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
   
    <div class="flex justify-between items-center">
    
        @if($v->status == '0')
        <time class="text-lg font-semibold text-gray-900 dark:text-white">{{ $v->tgl_pengaduan->format('d M, h:i') }}</time>
        <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2 py-1 rounded dark:bg-gray-700 dark:text-gray-300">Pending</span>                        
        @elseif($v->status == 'proses')
        <time class="text-lg font-semibold text-gray-900 dark:text-white">{{ $v->tgl_pengaduan->format('d M, h:i') }}</time>
        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ ucwords($v->status) }}</span>
        @else
        <time class="text-lg font-semibold text-gray-900 dark:text-white">{{ $v->tgl_pengaduan->format('d M, h:i') }}</time>
        <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ ucwords($v->status) }}</span>
        @endif
    </div>
    <ol class="mt-3 divide-y divider-gray-200 dark:divide-gray-700">
        <li>
            <a href="#" class=" block p-3 flex flex-col space-y-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                <div class="flex gap-2">
                    <div id="tooltip-jese" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        {{ Auth::guard('masyarakat')->user()->nama }}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    <img data-tooltip-target="tooltip-jese" class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Medium avatar">
                    <div>
                        <p class="text-white font-bold">{{ $v->user->nama }}</p>
                        <p class="text-gray-400  text-xs">{{ $v->user->email }}</p>
                    </div>
                </div>            
                  <div class="text-gray-600 dark:text-gray-400">
                    <div class="text-base font-normal"><span class="font-medium text-gray-900 dark:text-white">Kamu</span> mengirim pesan kepada <span class="font-medium text-gray-900 dark:text-white">Petugas</span> pesan tentang <span class="font-medium text-gray-900 dark:text-white">{{ $v->judul_laporan }}</span></div>
                    {{-- <div class="text-sm font-normal"></div> --}}
                    <blockquote class="p-4 my-4 border-l-4 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                        <p>pesan kamu :</p>
                        <p class="text-base italic font-medium leading-relaxed text-gray-900 dark:text-white">{{ $v->isi_laporan }}</p>
                    </blockquote>
                    <span class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                        <svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path></svg>
                        Pengaduan
                    </span> 
                </div>
            </a>
        </li>
        @if ($v->tanggapan != null)
        <li>
            <a href="#" class="items-center block p-3 space-y-2 hover:bg-gray-100 dark:hover:bg-gray-700 gap-3 flex-col">
                <div>
                    <div class="flex gap-2">
                        <div id="tooltip-jese" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            {{-- {{ Auth::guard('masyarakat')->user()->nama }} --}}
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>   
                        <img data-tooltip-target="tooltip-jese" class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-4.jpg" alt="Medium avatar">
                        <div>
                            <p class="text-white font-bold">{{$v->tanggapan->petugas->nama_petugas ?? ' '}}</p>
                            <div class="flex items-center">
                                <span class="text-gray-400 text-xs">@</span>
                                <p class="text-gray-400  text-xs">{{$v->tanggapan->petugas->username ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie Green image"/> --}}
                <div class="text-gray-600 dark:text-gray-400">
                    <div class="text-base font-normal"><span class="font-medium text-gray-900 dark:text-white">{{ 'Tanggapan dari '. $v->tanggapan->petugas->nama_petugas }}</span> membalas <span class="font-medium text-gray-900 dark:text-white"></span> masalah <span class="font-medium text-gray-900 dark:text-white">{{ $v->judul_laporan }}</span></div>
                    {{-- <div class="text-sm font-normal"></div> --}}
                    <blockquote class="p-4 my-4 border-l-4 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                        <p>Balasan petugas :</p>
                        <p class="text-base italic font-medium leading-relaxed text-gray-900 dark:text-white">{{ $v->tanggapan->tanggapan }}</p>
                    </blockquote>
                    <span class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                        <svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path></svg>
                        Balasan pesan
                    </span> 
                </div>
            </a>
        </li>
        @endif
    </ol>
  </div>


  @endforeach
 
    
@endsection