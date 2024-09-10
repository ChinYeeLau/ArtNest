@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
           
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Subscribers</h4>
                        
                        <!--<p class="card-description">
                            Add class <code>.table-bordered</code>
                        </p>-->
                        @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> {{Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
                        <div class="table-responsive pt-3">
                            <table id="subscribers" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                           Email
                                        </th>
                                        <th>
                                            Subscribed on
                                         </th>
                                             <th>
                                                Status
                                           </th>
                                           <th>
                                           Action
                                       </th>
                                     </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscribers as $subscriber)
                                    
                                    <tr>
                                        <td>
                                            {{ $subscriber['id']}}
                                        </td>
                                        
                                        <td>
                                            {{ $subscriber['email']}}
                                        </td>
                                        <td>
                                           {{date('l jS \o\f F Y h:i:s A', strtotime($subscriber['created_at']))}}                                       </td>
                                        <td>
                                            @if($subscriber['status']==1)
                                            <a class="updateSubscriberStatus" id="subscriber-{{$subscriber['id']}}" subscriber_id="{{$subscriber['id']}}" href="javascript:void(0)"><i style="font-size:25px"class="mdi mdi-bookmark-check" status="Active"></i></a>
                                            @else
                                            <a class="updateSubscriberStatus" id="subscriber-{{$subscriber['id']}}" subscriber_id="{{$subscriber['id']}}" href="javascript:void(0)"><i style="font-size:25px" class="mdi mdi-bookmark-outline"status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="javascript:void(0)" class="confirmDelete" module="subscriber" moduleid="{{$subscriber['id']}}"><i style="font-size:25px" class="mdi mdi-file-excel-box"></i></a>
                                    </td>
                                    </tr>
                                  @endforeach
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    @include('admin.layout.footer')

    <!-- partial -->
</div>

@endsection