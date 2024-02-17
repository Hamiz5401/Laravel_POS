<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public static function get_all_members()
    {
        return Member::get();
    }

    public function create_member(Request $request)
    {
        $request->validate([
            'new_member_name' => 'required',
            'new_member_citizen_id' => 'required|numeric',
            'new_member_phone_number' => 'required|numeric',
        ], [
            'new_member_name.required' => 'Member name can not be blank.',
            'new_member_citizen_id.required' => 'Member CitizenID can not be blank.',
            'new_member_phone_number.required' => 'Member Phone number can not be blank.',
            'new_member_citizen_id.numeric' => 'Member CitizenID must be a number.',
            'new_member_phone_number.numeric' => 'Member Phone number must be a number.',
        ]);

        $member = new Member;
        $member->name = $request->new_member_name;
        $member->citizen_id = $request->new_member_citizen_id;
        $member->phone_number = $request->new_member_phone_number;

        $member->save();

        return redirect('member');
    }

    public function destroy_member(Request $request)
    {
        Member::where('id', '=', $request->id)->delete();
        return redirect('member');
    }
}
