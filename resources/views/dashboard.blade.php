<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    {{-- ここからタスク表示領域 --}}
                    <div class="mt-4">
                        <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-2">担当タスク</h3>
                        {{-- ここに、ログインユーザーの担当タスク（対応期限、タイトル順）を表示します --}}
                    @if($loginUserId && $tasks->isNotEmpty())
                        <ul>
                            @foreach($tasks as $val)
                                <li>
                                    対応期限:{{ $val->priority }}
                                    タイトル:{{ $val->title }}
                                </li>   
                            @endforeach
                        </ul>
                    @else
                        現在、該当するタスクはありません。 
                    @endif
                    </div>
                    {{-- ここまでタスク表示領域 --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>