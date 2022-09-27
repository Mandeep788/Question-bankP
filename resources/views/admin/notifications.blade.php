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
                        <table id="userBlockStatus">
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
                              
                            </tbody>
                            
                        </table>
                      
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
