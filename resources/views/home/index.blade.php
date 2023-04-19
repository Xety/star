<x-home-layout>
    <div class="lg:container mx-auto pt-4 mb-5">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="col-span-12 px-3">
                <ul>
                @forelse ($stars as $star)
                    <li>
                    @if ($loop->last)
                        <a href="{{ route('star.show', ['id' => $star->id]) }}" class="block py-4 px-4 hover:bg-slate-200 hover:text-yellow-500">
                    @else
                        <a href="{{ route('star.show', ['id' => $star->id]) }}" class="block border-b py-4 px-4 hover:bg-slate-200 hover:text-yellow-500">
                    @endif
                            <img class="h-7 w-7 rounded-md inline" src="{{ asset('storage/' . $star->image) }}" alt="Star image" />
                                {{ $star->first_name }} {{ $star->last_name }}
                        </a>
                    </li>
                @empty
                    <li class="text-center text-gray-400">
                        {{ __('There\'s no Stars yet.') }}
                        @auth
                            <x-primary-button-link href="{{ route('star.create') }}">
                                {{ __('Create a Star') }}
                            </x-primary-button-link>
                        @endauth
                    </li>
                @endforelse
                </ul>
            </div>

            <div class="col-span-12 px-3">
                {{ $stars->links() }}
            </div>
        </div>
    </div>

</x-home-layout>