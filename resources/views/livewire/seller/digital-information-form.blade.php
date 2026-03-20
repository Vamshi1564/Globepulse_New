<div>


    <livewire:front.layout.header />


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Card Wrapper -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-white py-4">
                    <h2 class="mb-0 fw-bold text-white">Digital Detail Form</h2>
                    <small class="">Please fill all required details carefully</small>
                </div>

                <!-- Body -->
                <div class="card-body p-4 p-md-5 bg-light">

                    @if (session('success'))
                        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
                    @endif

                    <form wire:submit.prevent="submit" wire:key="form-{{ $reset_key }}">

                        <!-- Section 1 -->
                        <div class="mb-4">
                            <h6 class="text-primary fw-semibold mb-3">Basic Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name *</label>
                                    <input type="text" wire:model="name" class="form-control form-control">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Company Name *</label>
                                    <input type="text" wire:model="company_name" class="form-control form-control">
                                    @error('company_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 2 -->
                        <div class="mb-4">
                            <h6 class="text-primary fw-semibold mb-3">Contact Details</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Registered Email *</label>
                                    <input type="email" wire:model="email" class="form-control form-control">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Mobile Number *</label>
                                    <input type="text" wire:model="mobile" class="form-control form-control">
                                    @error('mobile') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address with Pin Code *</label>
                                    <input type="text" wire:model="address" class="form-control form-control">
                                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 3 -->
                        <div class="mb-4">
                            <h6 class="text-primary fw-semibold mb-3">Company Details</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Company Logo *</label>
                                    <input type="file" wire:model="company_logo" class="form-control form-control">
                                    @error('company_logo') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Professional Email *</label>
                                    <select wire:model="professional_email" class="form-select form-select">
                                        <option value="">Select Email</option>
                                        <option value="info@companyname.com">info@companyname.com</option>
                                        <option value="support@companyname.com">support@companyname.com</option>
                                        <option value="care@companyname.com">care@companyname.com</option>
                                        <option value="contact@companyname.com">contact@companyname.com</option>
                                        <option value="sales@companyname.com">sales@companyname.com</option>
                                    </select>
                                    @error('professional_email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Birth Date *</label>
                                    <input type="date" wire:model="birth_date" class="form-control form-control">
                                    @error('birth_date') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">PAN Number *</label>
                                    <input type="text" wire:model="pan_number" class="form-control form-control">
                                    @error('pan_number') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 4 -->
                        <div class="mb-4">
                            <h6 class="text-primary fw-semibold mb-3">Business Description</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Product List *</label>
                                    <textarea wire:model="product_list" rows="4" class="form-control form-control"></textarea>
                                    @error('product_list') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">About Company *</label>
                                    <textarea wire:model="about_company" rows="4" class="form-control form-control"></textarea>
                                    @error('about_company') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 5 -->
                        <div class="mb-4">
                            <h6 class="text-primary fw-semibold mb-3">Demo Link Selection</h6>
                            <div class="bg-white p-3 rounded-3 border">
                                <div class="row">
                                @foreach ($demo_links as $link)
                                    <div class="col-md-6">
                                        <label class="d-flex align-items-start mb-2 gap-2">
                                            <input type="radio" name="demo_link_group" wire:model="demo_link" value="{{ $link->id }}" class="form-check-input mt-1">
                                            <span class="text-break">
                                                <a href="{{ $link->demo_url }}" target="_blank" class="text-decoration-underline text-primary">
                                                    {{ $link->demo_url }}
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                                </div>
                                @error('demo_link') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="pt-3">
                            <button class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm">
                                Submit Application
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Gradient Helper -->
<style>
.bg-gradient-primary{
    background: linear-gradient(135deg, #0d6efd, #4f8cff);
}
</style>

        <livewire:front.layout.footer />

</div>