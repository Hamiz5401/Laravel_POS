<html class="dark">
<div class="panel-body mt-10">

    <form action="{{ route('member.create') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <div class="flex form-group">
            <div>
                <label for="new_member_name" class="col-sm-3 control-label">New Member name</label>
                <div class="col-sm-6 mt-3">
                    <input type="text" name="new_member_name" id="new_member_name" class="form-control dark:bg-gray-900" value="{{ old('new_member_name') }}">
                </div>
            </div>
            
            <div class="ms-3">
                <label for="new_member_citizen_id" class="col-sm-3 control-label">New CitizenID</label>
                <div class="col-sm-6 mt-3">
                    <input type="text" name="new_member_citizen_id" id="new_member_citizen_id" class="form-control dark:bg-gray-900" value="{{ old('new_member_citizen_id') }}">
                </div>
            </div>

            <div class="ms-3">
                <label for="new_member_phone_number" class="col-sm-3 control-label">New Phone Number</label>
                <div class="col-sm-6 mt-3">
                    <input type="text" name="new_member_phone_number" id="new_member_phone_number" class="form-control dark:bg-gray-900" value="{{ old('new_member_phone_number') }}">
                </div>
            </div>

            <div class="col-sm-offset-3 col-sm-6 mt-10">
                <x-primary-button class="ms-3">
                    {{ __('Create Member') }}
                </x-primary-button>
            </div>
        </div>

    </form>
</div>