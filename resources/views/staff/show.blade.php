@extends('layouts.admin_master')
@section('meta')
    <meta name="csrf-token" content="{{csrf_token()}}" />
    @endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/staff.js')}}"></script>
@endsection
@section('content')


    <p><a href="{{action('Admin\StaffController@index')}}" class="btn btn-default"><span class="fi-misc-return fi-misc"></span> Return to Staff</a></p>

    {{--DISABLE USER--}}
    <div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content panel-danger">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Disable User</h4>
                </div>
                <div class="modal-body">
                    <div style="padding:1em" class="text-center">
                    <p><span class="glyphicon glyphicon-warning-sign large-warning-icon"></span></p>
                    <p>Are you sure you want to disabled {{$staff->full_name}}?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirmDisable" data-dismiss="modal">Confirm Disable</button>
                </div>
            </div>
        </div>
    </div>

    {{--ENABLE USER--}}
    <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content panel-success">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Re-activate User</h4>
                </div>
                <div class="modal-body">
                    <div style="padding:1em" class="text-center">

                        <p>Are you sure you want to re-activate {{$staff->full_name}}?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="confirmEnable" data-dismiss="modal">Confirm Re-activate</button>
                </div>
            </div>
        </div>
    </div>



    <div class="row row-eq-height">

        <div class="col-md-6 stretch col-flex">

            @component('components.panel')
                @slot('title')
                    <span class="fi-misc-user fi-misc"></span> User Information
                    @endslot

                    <h1><span class="fi-misc-user-1 fi-misc"></span> {{$staff->full_name}}</h1>
                <p>Registered {{$staff->created_at->diffForHumans()}}</p>

                <table class="table-responsive table">
                    <tr>
                        <td><strong>Name</strong></td>
                        <td>{{$staff->full_name}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{$staff->email}}</td>
                    </tr>
                </table>

                @endcomponent

            @component('components.panel')
                @slot('title')
                    Recent Orders
                    @endslot

                Recent Orders

                @endcomponent

        </div>

    <div class="col-md-6 stretch col-flex">

        @php
        $active = ($staff->activations->count()>=1);
        @endphp


        @component('components.panel',['colour'=>($active ? 'success' : 'danger'),'id'=>'statePanel'])
            @slot('title')
                <span class="fi-misc-padlock{{($active ? '' : '-1')}} fi-misc"></span> User: <strong>{{($active ? 'Active' : 'Disabled')}}</strong>
            @endslot



            <a href="#" class="btn btn-{{($active ? 'danger' : 'success')}} btn-lg btn-block" data-toggle="modal" data-target="#{{($active ? 'deactivate' : 'activate')}}Modal" id="stateButton"><span class="glyphicon-alert glyphicon"></span> {{($active ? 'Disable' : 'Activate')}}User?</a>

        @endcomponent


    @component('components.panel')
    @slot('title')
        <span class="fi-man fi-man-teamwork"></span> Current roles
        @endslot

        <table class="table table-responsive">
            <thead>
            <tr>
                <th>Role</th>
                <th>Add/Remove</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{$role->name}}</td>
                <td>
                    @if($staff->inRole($role->slug))
                        <a href="#" class="btn btn-lg btn-success btn-block role-button" data-role-id="{{$role->id}}">Remove from Role</a>
                        @else
                        <a href="#" class="btn btn-lg btn-default btn-block role-button" data-role-id="{{$role->id}}">Assign to Role</a>
                    @endif
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>



    @endcomponent

    </div>

    </div>

@endsection