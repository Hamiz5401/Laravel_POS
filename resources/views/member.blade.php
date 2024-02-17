<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Member') }}
        </h2>
    </x-slot>
    
    <html class="dark">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center gap-4 mt-10 ml-10 text-l">
                        
                    </div>

                    <div class="text-l relative overflow-x-auto">
                        @if(count($members) > 0)
                        <table class="w-full text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-left text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-4">
                                        Member name
                                    </th>
                                    <th class="px-6 py-4">
                                        Member CitizenID
                                    </th>
                                    <th class="px-6 py-4">
                                        Member Phone number
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                            @foreach($members as $member)
                                <tr>
                                    <td class="px-6 py-4">{{ $member->name }}</td>
                                    <td class="px-6 py-4">{{ $member->citizen_id }}</td>
                                    <td class="px-6 py-4">{{ $member->phone_number }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('member.delete') }}" method="POST" class="form-horizontal">
                                            @csrf
                                            @method('delete')

                                            <input type="hidden" name="id" value="{{ $member->id }}">
                                            <x-primary-button>
                                                {{ __('Remove') }}
                                            </x-primary-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endif
                    
                    <div class="mt-4">
                        @include('member.member-create-form')
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>