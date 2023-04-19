<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stars') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                <x-primary-button-link
                    href="{{ route('star.create') }}"
                    title="Create Star"
                    class="mb-4"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ __('Create Star') }}
                </x-primary-button-link>

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        First Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Last Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stars as $star)
                                    @if ($loop->last)
                                        <tr>
                                    @else
                                        <tr class="border-b">
                                    @endif

                                        <th class="px-6 py-4">
                                            {{ $star->first_name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $star->last_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ Str::limit($star->description, 50) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $star->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- Actions Buttons --}}
                                            <x-secondary-button-link
                                                class="px-2"
                                                href="{{ route('star.edit', ['id' => $star->id]) }}"
                                                title="Edit"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                    </svg>
                                            </x-button-link>

                                            <form method="post" action="{{ route('star.destroy', ['id' => $star->id]) }}" class="inline">
                                                @csrf
                                                @method('delete')

                                                <x-danger-button class="px-2 mr-3" title="{{ __('Delete') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $stars->links() }}
        </div>
    </div>
</x-app-layout>
