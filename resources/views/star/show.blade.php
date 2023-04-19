<x-home-layout>
    <div class="lg:container mx-auto pt-4 mb-5">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="col-span-12 px-3">
                <a class="float-left inline-flex items-center" href="{{ route('home') }}" title="Return to home">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home
                </a>

                @auth
                    <x-secondary-button-link class="float-right" href="{{ route('star.edit', ['id' => $star->id]) }}" title="Edit this Star">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                        Edit
                    </x-secondary-button-link>
                @endauth
            </div>

            <div class="lg:col-span-3 col-span-12 px-3">
                <ul>
                    <li>
                        <a href="{{ route('star.show', ['id' => $star->id]) }}" class="block py-4 px-4 bg-slate-200 text-yellow-500">
                            <img class="h-7 w-7 rounded-md inline" src="{{ asset('storage/' . $star->image) }}" alt="Star image" />
                                {{ $star->first_name }} {{ $star->last_name }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="lg:col-span-9 col-span-12 px-3">
                <article>
                        <figure class="float-left mx-4">
                            <img src="{{ asset('storage/' . $star->image) }}" width="100" alt="Star image" />
                        </figure>

                        <h1 class="text-3xl font-bold">
                            {{ $star->first_name }} {{ $star->last_name }}
                        </h1>

                        <div class="whitespace-pre-line">
                            {{ $star->description }}
                        </div>
                </article>
            </div>
        </div>
    </div>
</x-home-layout>