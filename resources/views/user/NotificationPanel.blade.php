@extends('user_layout.template')
@section('main-content')



<div class="container">
    <h4 class="mt-2 bg-dark text-white h-20 p-4 text-center">Notification Panel</h4>
    <div class="notificationPanel mt-3">
        <table  id="datatable"class="table table-striped table-bordered">
            
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

                    @elseif ($Np->status == 'C')
                    {{'Reviewed'}}

                    @endif
                    {{-- {{$Np->status}} --}}
                </td>
                <td>
                    @if ($Np->status == 'C')
                            <button>Download</button>
                    @endif
                </td>
      
       
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
</div>









@endsection
