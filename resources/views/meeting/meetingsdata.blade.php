<div class="shadow rounded-md border my-5">
    <table class="table-auto w-full">
    <thead class="bg-blue-600 text-white rounded-t-md">
        <tr class="divide-x rounded-t-md">
        <th class="text-center px-4 py-2">Id</th>
        <th class="text-center px-4 py-2">Subject</th>
        <th class="text-center px-4 py-2">Date Time</th>
        <th class="text-center px-4 py-2">Edit</th>
        <th class="text-center px-4 py-2">Delete</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($meetings as $meeting)
        <tr class="divide-x border-y">
        <td class="text-center">{{$meeting->id}}</td>
        <td class="text-center">{{$meeting->subject}}</td>
        <td class="text-center">{{$meeting->date_time}}</td>
         <td class="text-center"><button class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight  rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out " data-id="{{ $meeting->id }}" id="editbutton">Edit</button></td>
         <td class="text-center"><button class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight  rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out " data-id="{{ $meeting->id }}" id="deletebutton">Delete</button></td>
        </tr>
      @endforeach
    </tbody>
    </table>
    <div class="mt-3">
       {{ $meetings->links()}}
    </div>
</div>
