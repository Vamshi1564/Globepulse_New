<div>
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Service Document List</h5>

            <form wire:submit.prevent="search" class="d-flex gap-2 align-items-center">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Search Service..." wire:model="searchTerm"
                        :key="$formKey">
                    <button class="btn btn-primary btn-sm" type="submit" wire:loading.attr="disabled"
                        wire:target="search">
                        <span wire:loading.remove wire:target="search">
                            <i class="bi bi-search"></i> Search
                        </span>
                        <span wire:loading wire:target="search">
                            Searching...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-hover text-center align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Service</th>
                        <th>Documents</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listData as $row)
                        <tr>
                            <td>{{ ($page - 1) * $perPage + $loop->iteration }}</td>
                            <td>{{ $row->service?->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('task-document-list', ['service_id' => $row->serviceid]) }}"
                                    class="text-primary fw-bold" style="cursor:pointer; text-decoration:underline;">
                                    {{ $row->doc_count }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($totalPages > 1)
            <div class="card-footer d-flex justify-content-end align-items-center">
                <button class="btn btn-outline-primary btn-sm" wire:click="prevPage"
                    {{ $page == 1 ? 'disabled' : '' }}>« Prev</button>

                <span class="mx-2">Page {{ $page }} of {{ $totalPages }}</span>

                <button class="btn btn-outline-primary btn-sm" wire:click="nextPage"
                    {{ $page == $totalPages ? 'disabled' : '' }}>Next »</button>
            </div>
        @endif
    </div>
</div>
