{{-- <div>
    <h1 class="text-xl font-bold mb-4">Groups</h1>

    <div class="flex gap-4 mb-6">
        @foreach ($groups as $group)
            <button wire:click="selectGroup({{ $group->id }})"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ $group->name }}
            </button>
        @endforeach
    </div>

    @if ($selectedGroupId)
        <h2 class="text-lg font-semibold mb-2">Members of Group: {{ $groups->find($selectedGroupId)->name }}</h2>

        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Member ID</th>
                    <th class="px-4 py-2">Customer Name</th>
                    <th class="px-4 py-2">Phone Number</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td class="border px-4 py-2">{{ $member->id }}</td>
                        <td class="border px-4 py-2">{{ $member->customer->name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $member->customer->phonenumber ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="removeMember({{ $member->id }})"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">
                                Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add New Customer to Group -->
        <h3 class="text-lg font-semibold mt-6">Add New Member</h3>

        <div class="flex items-center gap-4 mt-2">
          

            <!-- Searchable Customer Dropdown -->
            <div x-data="{ search: '', open: false }" class="relative">
                <input type="text" x-model="search" @focus="open = true" @click.away="open = false"
                    placeholder="Search Customer..." class="border rounded p-2 w-full">

                <ul x-show="open"
                    class="absolute z-10 bg-white border mt-1 w-full max-h-60 overflow-auto rounded shadow">
                    @foreach ($availableCustomers as $customer)
                        <li x-show="search === '' || '{{ strtolower($customer->name) }} {{ strtolower($customer->phonenumber) }}'.includes(search.toLowerCase())"
                            @click="$wire.set('newCustomerId', '{{ $customer->id }}'); search = '{{ $customer->name }} ({{ $customer->phonenumber }})'; open = false"
                            class="px-3 py-2 hover:bg-gray-100 cursor-pointer">
                            {{ $customer->name }} ({{ $customer->phonenumber }})
                        </li>
                    @endforeach
                </ul>
            </div>

            <button wire:click="addMember" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                Add to Group
            </button>
        </div>

        @if (session()->has('message'))
            <div class="text-green-500 mt-4">{{ session('message') }}</div>
        @endif
    @endif
</div> --}}
<div>
    <livewire:admin.layout.header />
    {{-- <div class="container-fluid p-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h1 class="h4 mb-0 text-primary">👥 Manage Customer Groups</h1>
            </div> --}}
    {{-- <div class="card-body">
                <!-- Group Dropdown -->
                <div class="mb-3">
                    <label class="form-label">Select Group</label>
                    <select wire:change="selectGroup($event.target.value)" class="form-select">
                        <option value="">-- Select --</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}" {{ $selectedGroupId == $group->id ? 'selected' : '' }}>
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if ($selectedGroupId)
                    <!-- Members List -->
                    <h5>Members of {{ $groups->find($selectedGroupId)->name }}</h5>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($members as $member)
                                <tr wire:key="member-{{ $member->id }}">
                                    <td>{{ $member->id }}</td>
                                    <td>{{ $member->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $member->customer->phonenumber ?? 'N/A' }}</td>
                                    <td>
                                        <button wire:click="removeMember({{ $member->id }})"
                                            class="btn btn-sm btn-danger">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No members in this group.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="text-center mb-3">
                        <button wire:click="prevMemberPage" class="btn btn-sm btn-outline-primary"
                            {{ $memberPage == 1 ? 'disabled' : '' }}>Previous</button>
                        <span class="mx-2">Page {{ $memberPage }} of
                            {{ ceil($totalMembers / $membersPerPage) }}</span>
                        <button wire:click="nextMemberPage" class="btn btn-sm btn-outline-primary"
                            {{ $memberPage * $membersPerPage >= $totalMembers ? 'disabled' : '' }}>Next</button>
                    </div>

                    <!-- Add Customers -->
                    <h5>Add New Customers</h5>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($availableCustomers as $cust)
                                <tr wire:key="customer-{{ $cust->id }}">
                                    <td>{{ $cust->id }}</td>
                                    <td>{{ $cust->name }}</td>
                                    <td>{{ $cust->phonenumber }}</td>
                                    <td>
                                        <button wire:click="addMember({{ $cust->id }})"
                                            class="btn btn-sm btn-success">
                                            Add
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No available customers to add.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="text-center mb-3">
                        <button wire:click="prevCustomerPage" class="btn btn-sm btn-outline-primary"
                            {{ $customerPage == 1 ? 'disabled' : '' }}>Previous</button>
                        <span class="mx-2">Page {{ $customerPage }} of
                            {{ ceil($totalCustomers / $customersPerPage) }}</span>
                        <button wire:click="nextCustomerPage" class="btn btn-sm btn-outline-primary"
                            {{ $customerPage * $customersPerPage >= $totalCustomers ? 'disabled' : '' }}>Next</button>
                    </div>
                @endif

            </div> --}}

    <style>
        body {
            font-size: 16px;
            background-color: #f8f9fa;
        }

        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border: none;
            border-radius: 0.75rem;
        }

        .card-header {
            background: linear-gradient(135deg, #6c5ce7, #a29bfe);
            color: white;
            border-radius: 0.75rem 0.75rem 0 0 !important;
            padding: 1.25rem;
        }

        .table-responsive {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table th {
            background-color: #e9ecef;
            font-weight: 600;
        }

        .btn-sm {
            font-size: 0.875rem;
            padding: 0.25rem 0.75rem;
        }

        .pagination-info {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .section-title {
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 0.5rem;
            margin-bottom: 1.25rem;
            font-weight: 600;
        }

        .empty-state {
            color: #6c757d;
            font-style: italic;
            text-align: center;
            padding: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.75rem;
        }

        .form-select {
            border-radius: 0.5rem;
            padding: 0.75rem;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header text-center">

                        <h4 class="mb-0 text-white"><i class="bi bi-people-fill me-2"></i>Group Management</h4>

                    </div>
                    <div class="card-body p-4">
                        <!-- Group Dropdown -->
                        <div class="mb-4">
                            <label class="form-label">Select Group</label>
                            <select wire:change="selectGroup($event.target.value)" class="form-select">
                                <option value="">-- Select Group --</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"
                                        {{ $selectedGroupId == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @if ($selectedGroupId)
                            <!-- Members List Section -->
                            <div class="mb-5">
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

                                    <h5 class="section-title">
                                        <span>
                                            <i class="bi bi-person-check-fill me-2"></i>
                                            Members of {{ $groups->find($selectedGroupId)->name }}
                                        </span>
                                        <span class="badge bg-primary fs-9">{{ $totalMembers }} Members</span>
                                    </h5>

                                    <div class="mb-3">
                                        <form wire:submit.prevent="searchMembers">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Search Members..." wire:model="memberSearch">
                                                <button class="btn btn-primary btn-sm" type="submit">
                                                    <i class="bi bi-search"></i> Search
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="35%">Customer Name</th>
                                                <th width="30%">Phone</th>
                                                <th width="25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($members as $member)
                                                <tr wire:key="member-{{ $member->id }}">
                                                    <td>{{ $member->id }}</td>
                                                    <td>{{ $member->customer->name ?? 'N/A' }}</td>
                                                    <td>{{ $member->customer->phonenumber ?? 'N/A' }}</td>
                                                    <td>
                                                        <button wire:click="removeMember({{ $member->id }})"
                                                            class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-person-dash me-1"></i>Remove
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="empty-state">
                                                        <i class="bi bi-people display-6 d-block mb-2"></i>
                                                        No members in this group.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($totalMembers > 0)
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <button wire:click="prevMemberPage" class="btn btn-outline-primary btn-sm"
                                            {{ $memberPage == 1 ? 'disabled' : '' }}>
                                            <i class="bi bi-chevron-left me-1"></i>Previous
                                        </button>
                                        <span class="pagination-info">Page {{ $memberPage }} of
                                            {{ ceil($totalMembers / $membersPerPage) }}</span>
                                        <button wire:click="nextMemberPage" class="btn btn-outline-primary btn-sm"
                                            {{ $memberPage * $membersPerPage >= $totalMembers ? 'disabled' : '' }}>
                                            Next<i class="bi bi-chevron-right ms-1"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <!-- Add Customers Section -->
                            <div>
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

                                    <h5 class="section-title">
                                        <span>
                                            <i class="bi bi-person-plus-fill me-2"></i>
                                            Add New Customers
                                        </span>
                                        <span class="badge bg-success fs-9">{{ $totalCustomers }} Customers</span>
                                    </h5>

                                    <div class="mb-3">
                                        <form wire:submit.prevent="searchCustomers">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Search Customers..." wire:model="customerSearch">
                                                <button class="btn btn-success btn-sm" type="submit">
                                                    <i class="bi bi-search"></i> Search
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="35%">Customer Name</th>
                                                <th width="30%">Phone</th>
                                                <th width="25%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($availableCustomers as $cust)
                                                <tr wire:key="customer-{{ $cust->id }}">
                                                    <td>{{ $cust->id }}</td>
                                                    <td>{{ $cust->name }}</td>
                                                    <td>{{ $cust->phonenumber }}</td>
                                                    <td>
                                                        <button wire:click="addMember({{ $cust->id }})"
                                                            class="btn btn-sm btn-outline-success">
                                                            <i class="bi bi-person-add me-1"></i>Add
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="empty-state">
                                                        <i class="bi bi-person-x display-6 d-block mb-2"></i>
                                                        No available customers to add.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($totalCustomers > 0)
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <button wire:click="prevCustomerPage" class="btn btn-outline-primary btn-sm"
                                            {{ $customerPage == 1 ? 'disabled' : '' }}>
                                            <i class="bi bi-chevron-left me-1"></i>Previous
                                        </button>
                                        <span class="pagination-info">Page {{ $customerPage }} of
                                            {{ ceil($totalCustomers / $customersPerPage) }}</span>
                                        <button wire:click="nextCustomerPage" class="btn btn-outline-primary btn-sm"
                                            {{ $customerPage * $customersPerPage >= $totalCustomers ? 'disabled' : '' }}>
                                            Next<i class="bi bi-chevron-right ms-1"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- </div>
    </div> --}}





        </div>

        {{-- <script>
            function memberSelect() {
                return {
                    search: '',
                    open: false,
                    selected: @entangle('selectedCustomerIds'),
                    customers: @js($availableCustomers),
                    get filtered() {
                        return this.customers.filter(c =>
                            (c.name.toLowerCase().includes(this.search.toLowerCase()) ||
                                c.phonenumber.includes(this.search)) &&
                            !this.selected.includes(c.id)
                        );
                    },
                    add(id) {
                        if (!this.selected.includes(id)) this.selected.push(id);
                        this.search = '';
                    },
                    remove(id) {
                        this.selected = this.selected.filter(i => i !== id);
                    },
                    name(id) {
                        return this.customers.find(c => c.id === id)?.name || 'Unknown';
                    }
                }
            }
        </script> --}}


    </div>

    @if (session()->has('message'))
        <div class="alert alert-subtle-success p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3"
            role="alert" id="alert">
            <span class="fas fa-check-circle text-success fs-7 me-3"></span>
            <p class="mb-0 flex-1 fw-semibold">{{ session('message') }}</p>
            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger p-2 d-flex align-items-center position-fixed top-0 end-0 m-3 z-3" role="alert"
            id="alert">
            <span class="fas fa-cross-circle text-black fs-7 me-3"></span>
            <p class="mb-0 flex-1 fw-semibold">{{ session('error') }}</p>
            <button class="btn-close fs-10 ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <livewire:admin.layout.footer />
</div>
