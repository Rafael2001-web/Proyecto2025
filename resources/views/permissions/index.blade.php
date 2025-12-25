<x-app-layout>
    @section('title', 'Permisos')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Permisos') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    {{-- Validación mensaje --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-accent/20 border border-accent/40 text-primary rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <div class="bg-white">
                        <x-table
                            :headers="[
                                ['label' => 'ID', 'type' => 'text'],
                                ['label' => 'Nombre', 'type' => 'text'],
                                ['label' => 'Roles Asignados', 'type' => 'text'],
                                ['label' => 'Fecha de Creación', 'type' => 'date'],
                                ['label' => 'Acciones', 'type' => 'actions']
                            ]"
                            :csv="false"
                            :print="false"
                            id="permissions-table"
                        >
                            <x-slot name="buttons">
                                {{-- Aquí puedes agregar botones adicionales si es necesario --}}
                            </x-slot>

                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr class="hover:bg-light/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ $permission->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral font-medium">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 01-2 2m2-2h3m-3 0h-3m-2-4.5v9"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <span class="text-neutral font-medium">{{ $permission->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-neutral">
                                            @if($permission->roles->count() > 0)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($permission->roles->take(2) as $role)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                                            {{ $role->name }}
                                                        </span>
                                                    @endforeach
                                                    @if($permission->roles->count() > 2)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                                            +{{ $permission->roles->count() - 2 }} más
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-500 text-xs">No asignado</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/70">
                                            {{ $permission->created_at ? $permission->created_at->format('d/m/Y H:i') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                @canany(['view permissions', 'manage permissions'])
                                                    <a href="{{ route('permissions.show', $permission->id) }}"
                                                       class="text-secondary hover:text-accent font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        Ver
                                                    </a>
                                                @endcanany
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
