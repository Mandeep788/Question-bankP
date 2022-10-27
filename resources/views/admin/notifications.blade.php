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
                        <!-- Button trigger modal for mail icon-->
                        <!-- Modal -->
                        <div class="modal fade" id="sendEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="sendEmailModalLabel">SEND EMAIL</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form  action ="/admin/send-email-pdf" method="post" id=sendDataInEmailForm>
                                            @csrf
                                            @method("post")
                                            <input type="hidden" value="" name="id"  id="email-box">

                                            <div class="form-group mb-3">
                                                <label for="Name">Name</label>
                                                <input type="text" class="form-control" id="name" value ="" name="name" readonly>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Block Nname">Block Name</label>
                                                <input type="text" class="form-control mb-3" id="blockname" value =""name="block_name" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email">Email</label>
                                                <input type="email" class="form-control" id="email" value =""name="email" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="Subject">Subject</label>
                                                <input type="text" class="form-control" id="subject" value =""name="subject">
                                            </div>
                                            <div class="form-group">
                                                <label for="Email">Message</label>
                                                <input type="text" class="form-control" id="emal" value ="" name="message">
                                            </div>
                                            <button type="submit" class="btn btn-success mt-3">Send Mail</button>

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
    </div>


@endsection
