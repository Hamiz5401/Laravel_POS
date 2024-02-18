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
                    <div class="flex items-center gap-4 mb-5 text-l">
                        <h3 class="text-lg font-semibold">Member Management Page</h3>
                        <p class="text-gray-600 dark:text-gray-400">-- Here you can manage your members' information.</p>
                    </div>

                    <div class="text-l relative overflow-x-auto mt-8">
                        @if(count($members) > 0)
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Member name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Member CitizenID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Member Phone number
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-500 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($members as $member)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $member->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $member->citizen_id }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $member->phone_number }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-lg transition duration-300 ease-in-out">Remove</button>
                                            <!-- You can add more actions here if needed, like edit or view details -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="mt-4 text-gray-600 dark:text-gray-400">No members found.</p>
                        @endif
                    
                        <div class="mt-6">
                            <!-- Include the member creation form -->
                            @include('member.member-create-form')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
