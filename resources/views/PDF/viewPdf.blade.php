<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif
        }
        .body{
            padding: 10px;
        }
        .logo{
            text-align: center;
            margin-bottom: 40px;
        }
        .header{
            line-height: .19cm;
        }
        .heading{
            text-align: center;
            font-family: 'Aboreto', cursive !important;
            color: red;
        }
        .headerOne{
            margin-right: 30px;
            float: right;
        }
        .headerTwo{
            margin-left: 25px;
            margin-right: 0px;
            float: right;

        }
        .qaheading{
            margin-top: 120px;
            /* margin-bottom: 90px; */
        }
        .quesAns{
            border-bottom: 2px solid rgb(196, 196, 196);
            margin-bottom: 20px;
            margin-top: 30px;
        }
        .ques{
            margin-bottom: 10px;
        }
        .ans{
            margin-bottom: 10px;
        }
        .mark{
            margin-bottom: 20px;
        }
        .aggregateMark{
            line-height: .2cm;
        }
        .lastOne{
            text-align: right;
            margin-right: 150px;
            margin-top: 70px
        }
    </style>
</head>
<body>

    <div class="body">
    <div class="logo">
        <img src="{{ public_path('img/seasialogo.png') }}" alt="" height="80px">
    </div>
        <div>
            <div class="header">
                @foreach ($userdata as $user)

                <div class="headerTwo">
                    <p>{{date('d-m-y')}}</p>
                    <p>{{$user->name}}</p>
                    <p>{{$user->admin_name}}</p>
                </div>
                @endforeach
                <div class="headerOne">
                    <p>Date :  </p>
                    <p>Name : </p>
                    <p>Assigned By : </p>
                </div>
            </div>

            <div class="qaheading">
                @foreach ($userdata as $user)
                <h2 class="heading">{{$user->block_name}}</h2>
                @endforeach
                @foreach ($data as $detail)
                <div class="quesAns">
                    <div class="ques"><b>Q{{$loop->iteration}}.</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$detail->question}}</div>
                    <div class="ans"><b>Ans:</b> &nbsp;&nbsp;&nbsp;&nbsp; {{$detail->answer}}</div>
                    <div class="mark"><b>Marks:&nbsp;&nbsp;</b> {{$detail->marks_per_ques}}</div>
                </div>
                @endforeach
            </div>
            @foreach ($userdata as $user)
            <div class="aggregateMark">
                <p>Aggregate Marks : {{$user->block_aggregate}}</p>
                <p>Feedback : {{$user->feedback}}</p>
            </div>
            <div class="lastOne">
                <h4>Reviewed By : {{$user->admin_name}}</h4>
            </div>
            @endforeach
        </div>

    </div>
</body>
</html>
