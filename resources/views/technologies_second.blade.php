@extends('user_layout.template')
@section('main-content')
    <div class="container-fluidd">
        <form id="form">
            <nav class="navbar bg-dark abc">
                <div class="container">
                    <a class="navbar-brand text-light p-3" href="#">HTML Interview Questions</a>
                </div>
            </nav>
            <div class="container">
                <div>
                    
                </div>
                <div class="dropdown dropdown_exp  mt-4">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Experience
                    </button>
                    @foreach ($framework as $frame)
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" id="all" href="/questionbyexperience/{{$frame->id}}/0">All</a></li>
                        <li><a class="dropdown-item" id="fresher"  href="/questionbyexperience/{{$frame->id}}/1">Fresher</a></li>
                        <li><a class="dropdown-item" id="intermediate"  href="/questionbyexperience/{{$frame->id}}/2">Intermediate</a></li>
                        <li><a class="dropdown-item" id="advanced"  href="/questionbyexperience/{{$frame->id}}/3">Advanced</a></li>
                    </ul>
                </div>
                <br>
                <div class="body">
                    
                    <input type="hidden" id="technologies2" value="">
               
                        <div class="qa_box">
                            <div class="d-flex question p-2">
                                <div class="Q.No.">
                                    <h4>Q{{ $framework->firstItem() + $loop->index }}.</h4>
                                </div>&nbsp; &nbsp;
                                <div class="aa">
                                    <h4>{{ $frame->question }}</h4>
                                </div>
                            </div>
                            <div class="answers d-flex p-3">
                                <h5>Ans:</h5>&nbsp; &nbsp;<p>{{ $frame->answer }}</p>
                            </div>
                        </div>
                        <br>
                    @endforeach
                    {{ $framework->links() }}
                    <div id="dynamic_questions" class="container-fluid">

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection