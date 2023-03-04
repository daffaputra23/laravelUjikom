@extends('layout.admin')

@section('bread')
<li class="flex items-center gap-1">
    <svg fill="currentColor" class="text-gray-500 dark:text-gray-400 w-4 h-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"></path>
        <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"></path>
      </svg>
    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
    Laporan
    </a>
    {{-- <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg> --}}
</li>
@endsection

@section('laporan')

<h1 class="text-gray-900 text-xl dark:text-white">Pilih Tanggal Laporan</h1>
<form action="/admin/laporan/cari" method="POST">
@csrf
 <div class="flex items-center gap-3 w-[700px]"> 
    <input name="from" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
    <input name="to" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        {{-- <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input name="from" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative mr-4">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
        <input name="to" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end"> --}}
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cari Laporan</button>

    </div> 
  

</div>
</form>


<h1 class="text-gray-900 dark:text-white text-xl ">Hasil Data Laporan</h1>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    
    @if ($pengaduan ?? '')                                   
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Complaint
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $item => $k)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item+1 }}
                </th>
                <td class="px-6 py-4">
                    {{ $k->tgl_pengaduan }}
                </td>
               
                <td class="px-6 py-4">
                    {{ $k->isi_laporan }}
                </td>
                <td class="px-6 py-4">
                    @if($k->status == '0')
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2 py-1 rounded dark:bg-gray-700 dark:text-gray-300">Pending</span>                        
                    @elseif($k->status == 'proses')
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ ucwords($k->status) }}</span>
                    @else
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ ucwords($k->status) }}</span>
                    @endif
                </td>
            </tr>

            @endforeach

            @else
            <div>
                
                <h1 class="mb-1 text-4xl font-extrabold leading-none tracking-tight text-white text-1xl  dark:text-white">Data tidak ditemukan <span class="text-blue-600 dark:text-red-500 underline">Cari kembali</span></h1>
                <p class="text-lg font-normal text-gray-500 lg:text-lg dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>

            </div>

            @endif
        </tbody>
    </table>
    @if ($pengaduan ?? '')
    <a type="submit" href="{{ route('admin.laporan.print', ['from' => $from, 'to' => $to]) }}"  class="focus:outline-none ml-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 flex justify-center gap-2 w-[150px]">Print to PDF
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="24" fill="currentColor"><path d="M16 14h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h1V9h12v5zM4 4V0h12v4h1a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3h-1v4H4v-4H3a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1zm2 14h8v-7H6v7zM6 4h8V2H6v2z"></path></svg>
    </a>
    @endif
</div>



  
@endsection

@section('js')
{{-- <script src="../path/to/flowbite/dist/datepicker.js"> --}}
    // import Datepicker from 'flowbite-datepicker/Datepicker';
    // import DateRangePicker from 'flowbite-datepicker/DateRangePicker';

{{-- </script> --}}

@endsection


@section('jsDate')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/datepicker.min.js"></script> --}}


@endsection