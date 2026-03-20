<div>
    <livewire:admin.layout.header />
    <div class="container mt-4">

        <h3 class="mb-3 text-center">App Settings Management</h3>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Android Version</th>
                    <th>iOS Version</th>
                    <th>Android Mandatory</th>
                    <th>iOS Mandatory</th>
                    <th>App Maintenance</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($settings as $index => $setting)
                    <tr>

                        <td>{{ $setting['title'] }}</td>

                        <td>
                            <input type="text" wire:model.defer="settings.{{ $index }}.AndroidAppVersion"
                                class="form-control" @disabled($editIndex !== $index)>
                        </td>

                        <td>
                            <input type="text" wire:model.defer="settings.{{ $index }}.IOSAppVersion"
                                class="form-control" @disabled($editIndex !== $index)>
                        </td>

                        <td>
                            <select class="form-control"
                                wire:model.defer="settings.{{ $index }}.AndroidAppVersionMandatory"
                                @disabled($editIndex !== $index)>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </td>

                        <td>
                            <select class="form-control"
                                wire:model.defer="settings.{{ $index }}.IOSAppVersionMandatory"
                                @disabled($editIndex !== $index)>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </td>

                        <td>
                            <select class="form-control" wire:model.defer="settings.{{ $index }}.AppMaintenance"
                                @disabled($editIndex !== $index)>
                                <option value="1">ON</option>
                                <option value="0">OFF</option>
                            </select>
                        </td>

                        <td>
                            @if ($editIndex === $index)
                                <button class="btn btn-success btn-sm" wire:click="updateRow({{ $index }})">
                                    Update
                                </button>

                                <button class="btn btn-secondary btn-sm" wire:click="cancelEdit">
                                    Cancel
                                </button>
                            @else
                                <button class="btn btn-primary btn-sm" wire:click="enableEdit({{ $index }})">
                                    Edit
                                </button>
                            @endif
                        </td>

                        <input type="hidden" wire:model="settings.{{ $index }}.id">

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    <livewire:admin.layout.footer />
</div>
