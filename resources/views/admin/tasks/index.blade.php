<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            記事一覧
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full border">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">タイトル</th>
                                <th class="border px-4 py-2">対応期限</th>
                                <th class="border px-4 py-2">優先度</th>
                                <th class="border px-4 py-2">ステータス</th>
                                <th class="border px-4 py-2">最終更新日時</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $val)
                                <tr>
                                    <td class="border px-4 py-2">{{ $val->id }}</td>
                                    <td class="border px-4 py-2">{{ $val->title }}</td>
                                    <td class="border px-4 py-2">{{ $val->deadline_at }}</td>
                                    <td class="border px-4 py-2">{{ $val->priority }}</td>
                                    <td class="border px-4 py-2">{{ $val->status }}</td>
                                    <td class="border px-4 py-2">{{ $val->updated_at ? (new \Carbon\Carbon($val->updated_at))->format('Y-m-d H:i:s') : ' ' }}</td>

                                    <td class="border px-4 py-2">
                                        <a href="{{ route('admin.tasks.show', $val->id) }}" class="text-blue-600 hover:underline">詳細</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
