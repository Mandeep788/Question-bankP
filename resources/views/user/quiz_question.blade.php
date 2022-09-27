@extends('user_layout.template')
@section('main-content')
    <div class="container-fluid p-0">
        <div class="container-fluid p-4 quiz_question">
            @foreach ($quizQuestionData as $key => $data)
                Block Name:- {{ $data['block_name'] }}
            @endforeach
        </div>
        <div class="section p-3">
            <form action="" method="post">
                @csrf
                @foreach ($quizQuestionData as $key => $data)
                    <div class="question_section shadow">
                        {{-- Q.{{$quizQuestionData->iteration}} --}}
                        Q. {{ $quizQuestionData->firstItem() + $loop->index }}
                        {{ $data['question'] }}
                    </div>
                    <div class="md-form mt-3 amber-textarea active-amber-textarea">
                        <input type="text" class="q_" value="{{ $data['id'] }}" hidden />
                        <input type="text"id="block_id" value=" {{ $data['block_id'] }}" hidden>
                        <input type="text"id="quiz_id" value=" {{ $data['u'] }}" hidden>



                        <textarea id="form22" class="md-textarea form-control text-info text-black" data-id="{{ $loop->iteration }}"
                            rows="3" placeholder="write your Answer" value="">{{ $data['answer'] }}</textarea>
                        <span class="skipText">Skipped</span>
                        <i class="bi bi-pen-fill edit btn btn-default" data-id=""></i>

                        @if ($data['answerid'] == '')
                            <input type="text" class="last_id" value=""hidden />
                        @else
                            <input type="text" class="last_id" value="{{ $data['answerid'] }}"hidden />
                        @endif

                        <button class="btn btn-primary enter">Insert</button>
                        <button class="btn btn-primary update ">Update</button>
                        <input type="button" class="btn btn-warning " value="Skip" id="skipAnswer">
                    </div>
                @endforeach

            </form>
            {{-- {{ $quizQuestionData->links() }} --}}
            @if ($quizQuestionData->links() )
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($quizQuestionData->onFirstPage())
                        {{-- <li class="disabled"><span>{{ __('Prev') }}</span></li> --}}
                    @else
                        <li><a class="btn btn-primary" href="{{ $quizQuestionData->previousPageUrl() }}" rel="prev">{{ __('Prev') }}</a></li>
                    @endif
                    {{-- Next Page Link --}}
                    @if ($quizQuestionData->hasMorePages())
                        <li><a class="btn btn-primary nextQuiz" href="{{ $quizQuestionData->nextPageUrl() }}" rel="next">{{ __('Next') }}</a></li>
                    @else
                        {{-- <li class="disabled"><span>{{ __('Next') }}</span></li> --}}
                    @endif
                </ul>
            @endif

            @if ($quizQuestionData->firstItem() ==$quizQuestionData->lastPage() )
                <button class="btn btn-primary mt-2 mb-5" name="submit" id="submit">submit</button>
            @endif

        </div>
    </div>
@endsection
