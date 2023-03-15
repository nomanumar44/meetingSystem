@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="flex justify-between items-center text-center">
                    <div></div>
                    <h1>Meetings</h1>
                    <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight  rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out " onclick="showmodal()" >Add Meeting</button>
                    </div>
                    <div id="Allmeeting">
                    @include('meeting.meetingsdata')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- model code  --}}

<div id="popup-modal" tabindex="-1"
class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 z-50 md:inset-0 h-modal md:h-full mx-auto my-auto top-0">
<div class="relative p-4 w-full m-auto h-full md:h-auto flex justify-center items-center mt-20 h-screen">
    <div class="relative bg-white rounded-lg">
        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" >
            <svg onclick="hidemodal()" aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close modal</span>
        </button>
        <div class="p-6 text-center w-96">
            <h3 class="text-xl text-center font-medium leading-normal text-gray-800">Create Meeting </h3>
            <form action="{{ route('addMeeting') }}" method="Post" enctype="multipart/form-data" id="form">
                @csrf
            <div class="col-span-12 mt-6">
                 <div class="col-span-6 w-full">
                    <div class="w-full ">
                        <label
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-left"
                            for="grid-last-name">
                            Subject
                        </label>
                        <input
                            class="bg-white appearance-none block w-full bg-white border border-slate-300 focus:ring-gray-100 text-gray-700 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-300"
                            id="subject1" type="text" placeholder="Enter Subject"
                            name="subject" value="" >
                        <span class="text-red-500  subject_name_error"></span>
                    </div>
                </div>
                 <div class="col-span-6 w-full">
                    <div class="w-full ">
                        <label
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 text-left"
                            for="grid-last-name">
                            DateTime
                        </label>
                        <input
                            class="bg-white appearance-none block w-full bg-white border border-slate-300 focus:ring-gray-100 text-gray-700 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-300"
                            id="date_time1" type="datetime-local" placeholder="Add Description"
                            name="date_time">
                            <span class="text-red-500  date_time_name_error"></span>
                    </div>
            </div>
            <input type="hidden" id="UpdateId" name="updateId"/>
            <div
            class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">

         <button type="button"  onclick="hidemodal()"
                    class="inline-block px-6 py-2.5 bg-red-900 text-white font-medium text-xs leading-tight  rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out ml-1">
                    Close
                </button>
            <button type="submit"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight  rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
            data-bs-dismiss="modal" id="save">
            Save
            </button>
        </form>
        </div>

        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <input type="hidden" id="page_value">
            <script>
                function deletePopup(id) {
                $("#deleted_id").val(id);
                showmodal();
                }

                function showmodal() {
                    $("#popup-modal").show();
                }

                function hidemodal() {
                    $("#popup-modal").hide();
                }

                fetchAllMeetings();
                $(document).ready(function(){
                    $('#form').on('submit',function(e){
                        e.preventDefault();
                        var form = this;
                        var form_data = new FormData(form);
                        $.ajax({
                            url:$(form).attr('action'),
                            method:$(form).attr('method'),
                            data:form_data,
                            processData:false,
                            dataType:'json',
                            contentType:false,
                            beforeSend:function(){
                                $(form).find('span.error.text').text('');
                            },
                            success:function(data){
                                if(data.code == 0){
                                    $.each(data.error,function(prefix,val){
                                        $(form).find('span.'+prefix+'_error').text(val[0]);
                                    })
                                }else{
                                    $(form)[0].reset();
                                    if(data.code == 2){
                                        alert('New Meeting has been saved successfully');
                                        hidemodal();
                                        fetchAllMeetings();
                                    }else{
                                        alert('Meeting has been updated successfully');
                                        hidemodal();
                                        fetchAllMeetings();
                                        $('#UpdateId').val('');
                                    }
                                    
                                }
                            }
                        })
                    });
                });
                
                function fetchAllMeetings(){
                    $.get('{{ url("Allmeetings") }}',{},function(data){
                        $('#Allmeeting').html(data.result);
                    })
                }
                $(document).on('click','#deletebutton',function(){
                    var meetingId = $(this).data('id');
                    url = "{{ url('deleteMeeting') }}";
                    if(confirm('Are you sure you want to delete this meeting')){
                        $.ajax({
                            url:url,
                            method:"post",
                            data:{
                                meetingId:meetingId,
                                _token: "{{ csrf_token() }}",
                            },
                            success:function(data){
                                if(data.code == 1){
                                    fetchAllMeetings();
                                }else{
                                    alert(data.msg);
                                }
                            }
                        })
                    }
                });
                $(document).on('click','#editbutton',function(){
                    var meetingId = $(this).data('id');
                    url = "{{ url('getMeetingEdit') }}";
                        $.ajax({
                            url:url,
                            method:"get",
                            data:{
                                meetingId:meetingId,
                                _token: "{{ csrf_token() }}",
                            },
                            success:function(data){
                                if(data.code == 1){
                                    showmodal();
                                   $("#subject1").val(data.result.subject);
                                   $('input[type=datetime-local]').val(new Date(data.result.date_time).toJSON().slice(0,19))
                                   $('#UpdateId').val(data.result.id);
                                }else{
                                    alert(data.msg);
                                }
                            }
                        })
                    });
                //     $(document).ready(function(){
                //     $('#save').on('click',function(e){
                //         e.preventDefault();
                //         var subject =  $("#subject1").val();
                //         var date_time =  $('input[type=datetime-local]').val();
                //         url = "{{ url('getMeetingUpdate') }}";
                //         updateId = $('UpdateId').val();
                //         $.ajax({
                //             url:url,
                //             method:"post",
                //             data:{
                //                 updateId:updateId,
                //                 subject:subject,
                //                 date_time:date_time,
                //                 _token: "{{ csrf_token() }}",
                //             },
                //             processData:false,
                //             dataType:'json',
                //             contentType:false,
                //             beforeSend:function(){
                //                 $(form).find('span.error.text').text('');
                //             },
                //             success:function(data){
                //                 if(data.code == 0){
                //                     $.each(data.error,function(prefix,val){
                //                         $(form).find('span.'+prefix+'_error').text(val[0]);
                //                     })
                //                 }else{
                //                     $(form)[0].reset();
                //                     alert('Meeting Record Updated successfully has been saved successfully');
                //                     hidemodal();
                //                     fetchAllMeetings();
                //                 }
                //             }
                //         })
                //     });
                // });

        </script>
@endsection
