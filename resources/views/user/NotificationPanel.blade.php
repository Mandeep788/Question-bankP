@extends('user_layout.template')
@section('main-content')



<div class="container-fluid p-0">
    <h4 class="mt-2 bg-dark text-white h-20 p-4 text-center">Notification Panel</h4>
    <div class="notificationPanel mt-3">
        <table  id="datatable"class="table">
            <thead>
                <th>S. No.</th>
                <th>Blockname</th>
                <th>created by</th>
                <th>Status</th>
                <th>file</th>
            </thead>

            <tbody>
            @foreach($notificationPanel as $Np )
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$Np->block_name}}</td>
                <td>{{$Np->name}}</td>
                <td>
                    @if ($Np->status == 'P')

                    {{'Pending'}}

                    @elseif ($Np->status == 'I')
                    {{'Initiated'}}
                    @elseif ($Np->status == 'S')
                    {{'Submitted'}}
                    @elseif ($Np->status == 'U')
                    {{'Under Review'}}

                    @elseif ($Np->status == 'C')
                    {{'Reviewed'}}
                    @elseif ($Np->status == 'AR')
                    {{'Reviewed'}}

                    @endif
                    {{-- {{$Np->status}} --}}
                </td>
                <td>
                    @if ($Np->status == 'AR')
                 <a href="/user/download-pdf/{{$Np->id}}"><button class="btn btn-default "><i class="bi bi-cloud-arrow-down-fill"></i></button></a>
                    @endif
                </td>


            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>









@endsection
