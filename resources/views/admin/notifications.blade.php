@extends('admin_layout.template')
@section('main-content')

    <div class="first_section">
        <div class="bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h5 class="page-title p-3">Notification Panel</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-xlg-12 col-md-12">
                <div class="profile_box">
                    <div class="">
                        <table id="userBlockStatus" class="table table-light table-striped">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Block Assigned</th>
                                <th>Status</th>
                                <th>Aggregate Marks</th>
                                <th>Feedback</th>
                                <th>PDF</th>
                                <th>Mail</th>
                            </thead>
                            <tbody>
                                @foreach ($notificationData as $userblockStatus)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$userblockStatus->name}}</td>
                                    <td>{{$userblockStatus->block_name}}</td>
                                    <td>
                                        @if($userblockStatus->status =='P')
                                        {{'Pending'}}
                                        @elseif ($userblockStatus->status =='I')
                                        {{'Initiated'}}
                                        @elseif ($userblockStatus->status =='S')
                                        {{'Submitted'}}
                                        @elseif ($userblockStatus->status =='U')
                                        {{'Under Review'}}
                                        @elseif ($userblockStatus->status =='C')
                                        {{'Reviewed'}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($userblockStatus->block_aggregate == '')
                                            {{'-'}}
                                        @else
                                        {{$userblockStatus->block_aggregate}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($userblockStatus->block_aggregate == '')
                                            {{'-'}}
                                        @else
                                        @if($userblockStatus->feedback == '')
                                         <i class="bi bi-plus-circle feedbackIcon" data-id="{{$userblockStatus->id}}"></i>
                                        @else
                                        {{$userblockStatus->feedback}}
                                        @endif

                                        @endif

                                    </td>
                                    <td class="pdfColumn">

                                        @if($userblockStatus->block_aggregate == '')
                                            {{'-'}}
                                        @else
                                        <a href="/admin/view-pdf/{{$userblockStatus->id}}"><i class="bi bi-eye-fill viewPdf"></i> </a> <a href="/admin/download-pdf/{{$userblockStatus->id}}"><i class="bi bi-cloud-arrow-down-fill downPdf"></i></a>
                                        @endif
                                    </td>
                                    <td>

                                        @if($userblockStatus->block_aggregate == '')
                                            {{'-'}}
                                        @else
                                        <a href="/mail/{{$userblockStatus->id}}"><i class="bi bi-envelope-fill sendMail"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                        <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="feedbackFormModal" tabindex="-1" aria-labelledby="feedbackFormModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="feedbackFormModalLabel">Feedback</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="feedbackForm">
                                        <div class="mb-3">
                                            <input type="text" name="feedbackQuizId" id="feedbackQuizId" hidden>
                                            <textarea class="form-control" id="feedbackInput" name="feedbackInput" rows="4" ></textarea>
                                            <span id="feedbackError" class="text-danger"></span>
                                          </div>
                                          <button id="feedbackFormBtn" type="button" class="btn btn_add">Save</button>
                                        </form>
                                    </div>

                                </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
