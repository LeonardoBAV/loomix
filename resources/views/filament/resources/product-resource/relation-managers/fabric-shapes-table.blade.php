<div class="space-y-4">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Fabric</th>
                <th scope="col" class="px-6 py-3">Usage (kg)</th>
                <th scope="col" class="px-6 py-3">Cost</th>
                <th scope="col" class="px-6 py-3">Sample</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fabricShapes as $fabricShape)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $fabricShape->fabric->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $fabricShape->usage }} kg
                    </td>
                    <td class="px-6 py-4">
                        ${{ number_format($fabricShape->cost, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($fabricShape->sample)
                            <span class="text-blue-500">Yes</span>
                        @else
                            <span class="text-gray-500">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <button type="button" class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600" onclick="editFabricShape({{ $fabricShape->id }})">Edit</button>
                            <button type="button" class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600" onclick="deleteFabricShape({{ $fabricShape->id }})">Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
