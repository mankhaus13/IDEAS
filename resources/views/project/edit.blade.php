<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Редактирование проекта</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
<div class="w-full max-w-md space-y-8">
    <!-- ЛОГО -->
    <div class="flex justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-16 w-auto text-gray-700 sm:h-20">
            <path d="M18.75 12.75h1.5a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM12 6a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 6ZM12 18a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 18ZM3.75 6.75h1.5a.75.75 0 1 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM5.25 18.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 0 1.5ZM3 12a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 3 12ZM9 3.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM12.75 12a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM9 15.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
        </svg>
    </div>

    <!-- Заголовок -->
    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
        Редактирование проекта
    </h2>

    <!-- Форма -->
    <div class="mt-8 bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
        <div class="px-6 py-8">
            <form method="POST" action="{{ route('project.update', $project->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Название проекта -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Название проекта
                    </label>
                    <div class="mt-1">
                        <input id="title" name="title" type="text" required
                               class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                               value="{{ old('title', $project->title) }}">
                        @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Описание -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Описание
                    </label>
                    <div class="mt-1">
                        <textarea id="description" name="description" rows="3"
                                  class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Статус -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Статус
                    </label>
                    <div class="mt-1">
                        <select id="status" name="status"
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Активный</option>
                            <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Завершен</option>
                            <option value="archived" {{ $project->status == 'archived' ? 'selected' : '' }}>Архив</option>
                            <option value="paused" {{ $project->status == 'paused' ? 'paused' : '' }}>На паузе</option>
                        </select>
                        @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Срок выполнения -->
                <div>
                    <label for="deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Срок выполнения
                    </label>
                    <div class="mt-1">
                        <input id="deadline" name="deadline" type="date" required
                               class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                               value="{{ old('deadline',\Carbon\Carbon::parse($project->deadline)->format('d.m.Y')) }}">
                        @error('deadline')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Прогресс -->
                <div class="pt-2">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        Прогресс: {{ $project->progress() }}%
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mt-1">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $project->progress() }}%"></div>
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        {{ $project->completed_tasks() }} из {{ $project->total_tasks() }} задач выполнено
                    </div>
                </div>

                <!-- Кнопки -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('project.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        Назад
                    </a>
                    <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                        Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
