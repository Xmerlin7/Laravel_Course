<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center mb-6">
            <div>
                <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide">Admin area</p>
                <h1 class="text-3xl font-bold text-gray-800">All Users</h1>
                <p class="text-gray-600 mt-1">Logged in as {{ auth()->user()->name }}</p>
            </div>
            <div class="flex items-center gap-3">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-lg transition">
                        Logout
                    </button>
                </form>
                <a href="/users/create"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    + Add New User
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            ID
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Name
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Email
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Role
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                            Created At
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $user->id }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $user->name }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                    <span aria-hidden
                                        class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                    <span
                                        class="relative">{{ \Illuminate\Support\Carbon::parse($user->created_at)->format('M d, Y') }}</span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
