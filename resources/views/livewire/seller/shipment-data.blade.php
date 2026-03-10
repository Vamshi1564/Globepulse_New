<div>
    <livewire:seller.layout.header />

    <div class="content pt-0 m-0">
        <div class="container-fluid">
            <nav class="my-5" style="--phoenix-breadcrumb-divider: '&gt;&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('seller') }}">My Dashboard</a></li>
                    {{-- <li class="breadcrumb-item" aria-current="page"><a href="{{ route('my-products') }}">My
                            Products</a>
                    </li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Real Shipment Data</li>
                </ol>
            </nav>
            <form class="mb-9" wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="row g-3 flex-between-end mb-5">
                    <div class="col-auto">
                        <h2 class="mb-2">Real Shipment Data</h2>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-12 col-xl-8">
                        <div class="mb-3">
                            <h4 class="mb-3">HSN</h4>
                            <select class="form-select mb-2" aria-label="hsncode" wire:model="hsncode">
                                <option value="">Select HSN</option>
                                @foreach ($HsnCode as $data)
                                    <option value="{{ $data->HSN }}">
                                        {{ $data->HSN }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-danger fs-9">
                                @error('hsncode')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>



            @if ($shipmentData && $shipmentData->isNotEmpty())

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="my-3">Real Shipment Data List</h5>
                    <div class="text-end">
                        <button wire:click="download"
                            class="btn px-3 rounded fw-bold py-2 btn-outline-success">Download</button>
                    </div>
                </div>
                <div
                    class="mx-n4 mb-4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
                    <div class="table-responsive scrollbar mx-n1 px-1">
                        <table class="table fs-9 mb-0 text-center">
                            <thead>
                                <tr>
                                    <th class="sort white-space-nowrap align-middle border-end border-translucent"
                                        scope="col" style="width:70px;">
                                        No.</th>
                                    <th class="sort white-space-nowrap align-middle border-end border-translucent"
                                        scope="col" style="width:150px;">Export_from_Indian_Port</th>
                                    <th class="sort align-middle border-end border-translucent" scope="col"
                                        style="width:150px;">
                                        Exporter_Name</th>
                                    <th class="sort align-middle border-end border-translucent" scope="col"
                                        style="width:150px;">
                                        Exporter_Address</th>
                                    <th class="sort align-middle border-end border-translucent" scope="col"
                                        style="width:150px;">
                                        City_State</th>
                                    <th class="sort align-middle border-end border-translucent" scope="col"
                                        style="width:150px;">
                                        Importer_Buyer_Name</th>
                                    <th class="sort align-middle border-end border-translucent" scope="col"
                                        style="width:150px;">
                                        Importer_Buyer_Address</th>
                                    <th class="sort align-middle border-end border-translucent" scope="col"
                                        style="width:150px;">
                                        Foreign_Port</th>
                                    <th class="sort align-middle border-end border-translucent" scope="col"
                                        style="width:150px;">
                                        Foreign_Country</th>
                                    <th class="sort align-middle border-end border-translucent" scope="col"
                                        style="width:150px;">
                                        Chapter</th>
                                    <th class="sort align-middle border-end border-translucent" scope="col"
                                        style="width:150px;">
                                        hsncode</th>
                                    <th class="sort align-middle " scope="col" style="width:150px;">
                                        Product_Description</th>
                                </tr>
                            </thead>
                            <tbody class="list" id="products-table-body">

                                @foreach ($shipmentData as $item)
                                    <tr class="position-static">
                                        <td
                                            class="price align-middle white-space-nowrap ps-2 fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->export_from_indian_port }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->exporter_name }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->exporter_address }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->city_state }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->importer_buyer_name }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->importer_buyer_address }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->foreign_port }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->foreign_country }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->chapter }}
                                        </td>
                                        <td
                                            class="price align-middle white-space-nowrap fw-bold text-body-tertiary border-end border-translucent">
                                            {{ $item->hsncode }}
                                        </td>
                                        <td class="price align-middle white-space-nowrap fw-bold text-body-tertiary ">
                                            {{ $item->product_description }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            @elseif($hsncode)
                <p class="text-warning">No data found for HSN code: {{ $hsncode }}</p>
            @endif

        </div>
    </div>

    <livewire:seller.layout.footer />

</div>