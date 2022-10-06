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
                                <th>Submitted At</th>
                                <th width="50px">PDF</th>
                                <th>Mail</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot></tfoot>
                        </table>
                        <!-- Button trigger modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="feedbackFormModal" tabindex="-1"
                            aria-labelledby="feedbackFormModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="feedbackFormModalLabel">Feedback</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="feedbackForm">
                                            <div class="mb-3">
                                                <input type="text" name="feedbackQuizId" id="feedbackQuizId" hidden>
                                                <textarea class="form-control" id="feedbackInput" name="feedbackInput" rows="4"></textarea>
                                                <span id="feedbackError" class="text-danger"></span>
                                            </div>
                                            <button id="feedbackFormBtn" type="button" class="btn btn_add">Save</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- mail modal triger --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="/mail" method="post" id="mail_data">
                                        @csrf
                                        @method('post')
                                        <div class="modal-body" id="mailData">
                                            <input type="text" value="" name="id" id="mail_id" hidden>
                                            <div class="form-group mb-3">
                                                <label for="Name">Name</label>
                                                <input type="text" class="form-control" id="mail_name" value=""
                                                    name="name">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Block name">Title</label>
                                                <input type="text" class="form-control mb-3" id="mail_blockname"
                                                    value="" name="block_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input type="email" class="form-control" id="mail_email" value=""
                                                    name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="Subject">Subject</label>
                                                <input type="text" class="form-control" id="mail_subject" value=""
                                                    name="subject">

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <i class="bi bi-filetype-pdf"
                                                style="font-size:50px; color:red; margin-right:180px;"></i>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Send
                                                mail</button>
                                        </div>
                                    <form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
