@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->first_name.' '.$user->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            User Plan
                        </th>
                        <td>
                            <form action="{{ route('admin.users.subscription') }}"  method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="row">

                               
                                <div class="form-group col">
                                    <label for=""></label>
                                    <select class="form-control form-control-sm" name="plan_id" id="">
                                       <option hidden>Select Plan</option>
                                        @foreach($plans as $key => $plan)
                                            <option value="{{ $plan->id }}" {{ (@$user->userPlan[0]->id == $plan->id) ? 'selected' : '' }}>{{ $plan->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-xs btn-light">➕</button>
                            </div>
                            </form>
                            {{-- {{ @$user->userPlan[0]->name }} --}}
                            {{-- @foreach($user->roles()->pluck('name') as $role)
                                <span class="label label-info label-many">{{ $role }}</span>
                            @endforeach --}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection