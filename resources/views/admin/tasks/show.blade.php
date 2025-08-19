<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            記事詳細（ID: {{ $task->id }}）
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">{{ $task->title }}</h3>
                    <p class="mb-2"><strong>内容:</strong>{{ $task->content }}</p>
                    <p class="mb-2"><strong>対応期限:</strong>{{ (new \Carbon\Carbon($task->deadline_at))->format('Y-m-d') }}</p>
                    <p class="mb-2"><strong>対応日時:</strong> {{ $task->support_at ? (new \Carbon\Carbon($task->support_at))->format('Y-m-d') : ' ' }}</p>
                    <p class="mb-2"><strong>優先度:</strong>{{ $task->priority }}</p>
                    <p class="mb-2"><strong>ステータス:</strong>{{ $task->status }}</p>
                    <p class="mb-2"><strong>作成日時:</strong>{{ $task->created_at ? (new \Carbon\Carbon($task->created_at))->format('Y-m-d H:i:s') : ' '}}</p>
                    <p class="mb-2"><strong>更新日時:</strong>{{ $task->updated_at ? (new \Carbon\Carbon($task->updated_at))->format('Y-m-d H:i:s') : ' '}}</p>
                    <div class="mt-4">
                        <strong>本文:</strong>
                        <p class="mt-2 whitespace-pre-line">{{ $task->body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

