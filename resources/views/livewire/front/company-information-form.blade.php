<div>

    <livewire:front.layout.header />


    <style>
        /* Design System */
        :root {
            /* Colors */
            --primary: #4361EE;
            --primary-hover: #3A56D4;
            --primary-light: #EFF3FE;
            --secondary: #F8F9FA;
            --accent: #7209B7;
            --success: #4CC9F0;
            --warning: #F8961E;
            --danger: #F72585;
            --text: #212529;
            --text-light: #6C757D;
            --border: #E9ECEF;
            --white: #FFFFFF;
            --card-bg: #FFFFFF;
            --card-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);

            /* Spacing */
            --space-xs: 4px;
            --space-sm: 8px;
            --space-md: 16px;
            --space-lg: 24px;
            --space-xl: 32px;
            --space-2xl: 48px;

            /* Typography */
            --text-xs: 12px;
            --text-sm: 14px;
            --text-base: 16px;
            --text-lg: 18px;
            --text-xl: 20px;
            --text-2xl: 24px;
            --text-3xl: 32px;

            /* Effects */
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --radius-full: 9999px;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Base Styles */


        .settings-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: var(--space-xl);
            width: 80%;
            margin: 40px auto;
        }

        /* Header */
        .settings-header {
            padding: var(--space-2xl) var(--space-xl);
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: var(--white);
            text-align: center;
        }

        .settings-header h1 {
            font-size: var(--text-3xl);
            font-weight: 700;
            color: white;
            margin-bottom: var(--space-sm);
        }

        .settings-header p {
            opacity: 0.9;
            font-size: var(--text-base);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Progress Indicator */
        .progress-container {
            padding: var(--space-xl) var(--space-xl) 0;
            background: var(--white);
        }

        .progress-steps {
            display: flex;
            position: relative;
        }

        .progress-bar {
            position: absolute;
            top: 12px;
            left: 0;
            right: 0;
            height: 4px;
            background-color: var(--border);
            z-index: 1;
        }

        .progress-completed {
            position: absolute;
            top: 12px;
            left: 0;
            height: 4px;
            background-color: var(--primary);
            z-index: 2;
            transition: width 0.3s ease;
        }

        .step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 3;
        }

        .step-number {
            width: 28px;
            height: 28px;
            border-radius: var(--radius-full);
            background-color: var(--border);
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--text-sm);
            font-weight: 600;
            margin-bottom: var(--space-sm);
            position: relative;
            border: 2px solid var(--white);
            box-shadow: 0 0 0 2px var(--border);
            transition: var(--transition);
        }

        .step.active .step-number {
            background-color: var(--primary);
            color: var(--white);
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .step.completed .step-number {
            background-color: var(--success);
            color: var(--white);
            box-shadow: 0 0 0 2px var(--success);
        }

        .step.completed .step-number::after {
            content: '✓';
        }

        .step-label {
            font-size: var(--text-sm);
            font-weight: 500;
            color: var(--text-light);
            text-align: center;
            padding: 0 var(--space-sm);
        }

        .step.active .step-label,
        .step.completed .step-label {
            color: var(--text);
            font-weight: 600;
        }

        /* Form Sections */
        .form-section {
            padding: var(--space-xl);
            display: none;
        }

        .form-section.active {
            display: block;
            animation: fadeIn 0.4s ease-out;
        }


        .form-section h2 {
            font-size: var(--text-xl);
            font-weight: 600;
            margin-bottom: var(--space-sm);
            color: var(--text);
        }

        .form-section p.subtitle {
            color: var(--text-light);
            font-size: var(--text-base);
        }

        /* Form Cards */
        .form-card {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            padding: var(--space-lg);
            margin-bottom: var(--space-lg);
            box-shadow: var(--card-shadow);
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            gap: var(--space-lg);
        }

        .cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        /* Form Groups */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: var(--space-xs);
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label svg {
            width: 16px;
            height: 16px;
            stroke-width: 2;
            color: var(--text-light);
        }

        .form-control {
            padding: 12px 14px;
            /* border: 1px solid var(--border); */
            border-radius: var(--radius-sm);
            font-size: var(--text-base);
            transition: var(--transition);
            background-color: var(--white);
            width: 100%;
        }

        .form-control:focus {
            outline: none;
            /* border-color: var(--primary); */
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
            line-height: 1.5;
        }

        /* Select Wrapper */
        .select-wrapper {
            position: relative;
        }

        .select-wrapper select {
            appearance: none;
            padding-right: 36px;
        }

        .select-arrow {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            width: 16px;
            height: 16px;
            color: var(--text-light);
        }





        /* Input Helpers */
        .input-hint {
            font-size: var(--text-xs);
            color: var(--text-light);
        }

        .char-count {
            font-size: var(--text-xs);
            color: var(--text-light);
            text-align: right;
        }

        /* Completion Badge */
        .completion-badge {
            background: var(--primary-light);
            color: var(--primary);
            padding: 4px 10px;
            border-radius: var(--radius-full);
            font-size: var(--text-xs);
            font-weight: 600;
        }

        /* Help Button */
        .btn-help {
            background: none;
            border: none;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: var(--space-xs);
            font-size: var(--text-sm);
            cursor: pointer;
            padding: var(--space-xs) 0;
        }

        .btn-help svg {
            width: 16px;
            height: 16px;
        }

        /* Address Actions */
        .address-actions {
            display: flex;
            gap: var(--space-md);
            margin-top: var(--space-xs);
        }

        .btn svg {
            width: 16px;
            height: 16px;
        }

        /* Verification Page */
        .verification-section {
            text-align: center;
            padding: var(--space-2xl) var(--space-xl);
        }

        .verification-icon {
            width: 100px;
            height: 100px;
            background-color: var(--primary-light);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-xl);
        }

        .verification-icon svg {
            color: var(--primary);
            width: 48px;
            height: 48px;
            stroke-width: 1.5;
        }

        .verification-section h2 {
            font-size: var(--text-2xl);
            margin-bottom: var(--space-sm);
        }

        .verification-section p {
            color: var(--text-light);
            max-width: 500px;
            margin: 0 auto var(--space-xl);
        }

        /* Upload Card */
        .upload-card {
            border: 2px dashed var(--border);
            border-radius: var(--radius-md);
            padding: var(--space-xl);
            text-align: center;
            background: var(--white);
            transition: var(--transition);
            cursor: pointer;
        }

        .upload-card:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .upload-card svg {
            width: 48px;
            height: 48px;
            color: var(--primary);
            margin-bottom: var(--space-md);
        }

        .upload-card h4 {
            font-size: var(--text-lg);
            margin-bottom: var(--space-xs);
        }

        .upload-card p {
            color: var(--text-light);
            margin-bottom: var(--space-md);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .container {
                padding: var(--space-md);
            }

            .settings-header {
                padding: var(--space-xl) var(--space-md);
            }

            .progress-container {
                padding: var(--space-md) var(--space-md) 0;
            }

            .form-section {
                padding: var(--space-md);
            }

            .form-actions {
                padding: var(--space-md);
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
            }

            .form-grid {
                grid-template-columns: 1fr !important;
            }

            .address-actions {
                flex-direction: column;
                gap: var(--space-sm);
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        .success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--success);
            color: white;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: var(--shadow-md);
            z-index: 1000;
            opacity: 0;
            transform: translateY(-20px);
        }

        .animate-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
    <div class="container mt-5">
        <div class="settings-card">
            <!-- Header -->
            <div class="settings-header">
                <h1>Company Profile Setup</h1>
                <p>Complete your profile to increase trust with potential buyers and unlock full platform features</p>
            </div>

            <!-- Progress Indicator -->
            <div class="progress-container">
                <div class="progress-steps">
                    <div class="progress-bar"></div>
                    <div class="progress-completed" style="width: 0%"></div>

                    <div class="step active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Basic Info</div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Business Details</div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Verification</div>
                    </div>
                </div>
            </div>

            <!-- Basic Info Form -->
            <form id="basicInfoForm" class="form-section active">
                <div class="form-section-header">
                    <h2>Basic Information</h2>
                    {{-- <p class="subtitle">Tell us about your company</p> --}}
                </div>

                <div class="form-card">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="companyName">
                                <i class="fas fa-building"></i>
                                Company Name </label>
                            <input type="text" id="companyName" class="form-control" placeholder="Your company name">
                            <small class="input-hint">Your official registered business name</small>
                        </div>

                        <div class="form-group">
                            <label for="companyName">
                                <i class="fas fa-receipt"></i>
                                Company Gst No. </label>
                            <input type="text" id="companyName" class="form-control" placeholder="Your company Gst No.">
                            {{-- <small class="input-hint">Your official registered business name</small> --}}
                        </div>

                        <div class="form-group full-width">
                            <label for="companyDescription">
                                <i class="fas fa-file-lines"></i>
                                Company Description
                            </label>
                            <textarea id="companyDescription" class="form-control"
                                placeholder="Tell us about your company "></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-actions text-end">
                    <button type="submit" class="btn btn-primary">
                        Save & Continue
                        <span class="fa fa-chevron-right"></span>
                    </button>
                </div>
            </form>

            <!-- Business Details Form -->
            <form id="businessDetailsForm" class="form-section">
                <div class="form-section-header">
                    <div>
                        <h2>Business Details</h2>
                        <p class="subtitle">Help buyers understand your business better</p>
                    </div>

                </div>

                <!-- Key Metrics Card -->
                <div class="form-card">
                    <div class="form-card-header d-flex mb-3">
                        <div style="width: 3%"> <i class="fas fa-landmark"></i></div>
                        <div>
                            <h4>Key Business Metrics</h4>
                        </div>
                    </div>
                    <div class="form-grid cols-3">
                        <!-- Year Established -->
                        <div class="form-group">
                            <label for="yearEstablished">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                Year Established
                            </label>
                            <div class="select-wrapper">
                                <select id="yearEstablished" class="form-control">
                                    <option value="" disabled selected>Select year</option>
                                    <option>2025</option>
                                    <option>2024</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                    <option>2021</option>
                                    <option>2020</option>
                                    <option>2019</option>
                                    <option>2018</option>
                                    <option>2017</option>
                                    <option>2016</option>
                                    <option>2015</option>
                                    <option>2014</option>
                                    <option>2013</option>
                                    <option>2012</option>
                                    <option>2011</option>
                                    <option>2010</option>
                                    <option>2009</option>
                                    <option>2008</option>
                                    <option>2007</option>
                                    <option>2006</option>
                                    <option>2005</option>
                                    <option>2004</option>
                                    <option>2003</option>
                                </select>
                                <svg class="select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </div>
                        </div>

                        <!-- Employee Count -->
                        <div class="form-group">
                            <label for="employees">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                                Employees
                            </label>
                            <div class="select-wrapper">
                                <select id="employees" class="form-control">
                                    <option value="" disabled selected>Select range</option>
                                    <option>1-5</option>
                                    <option>5-10</option>
                                    <option>10-50</option>
                                    <option>50-100</option>
                                    <option>100+</option>
                                </select>
                                <svg class="select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </div>
                        </div>

                        <!-- Revenue -->
                        <div class="form-group">
                            <label for="revenue">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <line x1="12" y1="1" x2="12" y2="23" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                                Annual Revenue
                            </label>
                            <div class="select-wrapper">
                                <select id="revenue" class="form-control">
                                    <option value="" disabled selected>Select range</option>
                                    <option>1-5M</option>
                                    <option>5-10M</option>
                                    <option>10-50M</option>
                                    <option>50-100M</option>
                                    <option>100M+</option>
                                </select>
                                <svg class="select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Info Card -->
                <div class="form-card">
                    <div class="form-card-header d-flex mb-3">
                        <div style="width: 3%"><i class="fas fa-bookmark"></i></div>
                        <div>
                            <h4>Business Information</h4>
                        </div>
                    </div>
                    <div class="form-grid cols-2">
                        <!-- Business Type -->
                        <div class="form-group">
                            <label for="businessType">Business Type</label>
                            <div class="select-wrapper">
                                <select id="businessType" class="form-control">
                                    <option value="" disabled selected>Select type</option>
                                    <option>Manufacturer</option>
                                    <option>Wholesaler</option>
                                    <option>Distributor</option>
                                    <option>Retailer</option>
                                    <option>Service Provider</option>
                                </select>
                                <svg class="select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </div>
                        </div>

                        <!-- Country -->

                    </div>
                </div>

                <!-- Address Card -->
                <div class="form-card">
                    <div class="form-card-header d-flex mb-3">
                        <div style="width: 3%">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4>Office Location</h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Full Address</label>
                        <textarea id="address" class="form-control"
                            placeholder="Enter your company's physical address"></textarea>

                    </div>
                </div>

                <div class="form-actions d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" id="backToBasicInfo">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                        Back
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save & Continue
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </button>
                </div>
            </form>



            <!-- Verification Page -->
            <div id="verificationSection" class="form-section verification-section">
                <div class="verification-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L4 5V11C4 16 7.3 20.7 12 22C16.7 20.7 20 16 20 11V5L12 2Z" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                </div>
                <h2>Verification Required</h2>
                <p>Your company information has been saved successfully. Please complete verification to unlock all
                    platform features.</p>

                <div class="form-card" style="max-width: 600px; margin: 0 auto;">
                    <div class="upload-card">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="17 8 12 3 7 8" />
                            <line x1="12" y1="3" x2="12" y2="15" />
                        </svg>
                        <h4>Upload Verification Documents</h4>
                        <p>Accepted formats: PDF, JPG, PNG</p>
                        {{-- <button type="button" class="btn btn-secondary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" style="margin-right: 8px;">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="17 8 12 3 7 8" />
                                <line x1="12" y1="3" x2="12" y2="15" />
                            </svg>
                            Select Files
                        </button> --}}
                    </div>
                </div>




                <div class="form-actions d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" id="backToBusinessDetails">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                        Back
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save & Continue
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Current step tracking
            let currentStep = 1;
            const totalSteps = 3;
            const progressBar = document.querySelector('.progress-completed');

            // Form elements
            const basicInfoForm = document.getElementById('basicInfoForm');
            const businessDetailsForm = document.getElementById('businessDetailsForm');
            const verificationSection = document.getElementById('verificationSection');

            // Navigation buttons
            const backToBasicInfoBtn = document.getElementById('backToBasicInfo');
            const backToBusinessDetailsBtn = document.getElementById('backToBusinessDetails');

            // Progress steps
            const stepElements = document.querySelectorAll('.step');

            // Update progress bar and steps
            function updateProgress(step) {
                // Calculate progress percentage
                const percentage = ((step - 1) / (totalSteps - 1)) * 100;
                progressBar.style.width = `${percentage}%`;

                // Update step indicators
                stepElements.forEach((el, index) => {
                    if (index + 1 < step) {
                        el.classList.add('completed');
                        el.classList.remove('active');
                    } else if (index + 1 === step) {
                        el.classList.add('active');
                        el.classList.remove('completed');
                    } else {
                        el.classList.remove('active', 'completed');
                    }
                });
            }

            // Show specific step
            function showStep(step) {
                // Hide all sections
                document.querySelectorAll('.form-section').forEach(section => {
                    section.classList.remove('active');
                });

                // Show the requested step
                if (step === 1) {
                    basicInfoForm.classList.add('active');
                } else if (step === 2) {
                    businessDetailsForm.classList.add('active');
                } else if (step === 3) {
                    verificationSection.classList.add('active');
                }

                // Update progress
                updateProgress(step);
            }

            // Basic Info Form Submission
            basicInfoForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = `
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="animate-spin">
                        <path d="M12 2V6"/>
                        <path d="M12 18V22"/>
                        <path d="M4.93 4.93L7.76 7.76"/>
                        <path d="M16.24 16.24L19.07 19.07"/>
                        <path d="M2 12H6"/>
                        <path d="M18 12H22"/>
                        <path d="M4.93 19.07L7.76 16.24"/>
                        <path d="M16.24 7.76L19.07 4.93"/>
                    </svg>
                    Saving...
                `;
                submitBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    // Show success message
                    const successMessage = document.createElement('div');
                    successMessage.className = 'success-message animate-in';
                    successMessage.innerHTML = `
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="20" height="20">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        Basic information saved successfully!
                    `;
                    document.body.appendChild(successMessage);

                    // Remove message after 3 seconds
                    setTimeout(() => {
                        successMessage.remove();
                    }, 3000);

                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;

                    // Move to next step
                    showStep(2);
                }, 1500);
            });

            // Business Details Form Submission
            businessDetailsForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = `
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="animate-spin">
                        <path d="M12 2V6"/>
                        <path d="M12 18V22"/>
                        <path d="M4.93 4.93L7.76 7.76"/>
                        <path d="M16.24 16.24L19.07 19.07"/>
                        <path d="M2 12H6"/>
                        <path d="M18 12H22"/>
                        <path d="M4.93 19.07L7.76 16.24"/>
                        <path d="M16.24 7.76L19.07 4.93"/>
                    </svg>
                    Saving...
                `;
                submitBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    // Show success message
                    const successMessage = document.createElement('div');
                    successMessage.className = 'success-message animate-in';
                    successMessage.innerHTML = `
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="20" height="20">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        Business details saved successfully!
                    `;
                    document.body.appendChild(successMessage);

                    // Remove message after 3 seconds
                    setTimeout(() => {
                        successMessage.remove();
                    }, 3000);

                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;

                    // Move to next step
                    showStep(3);
                }, 1500);
            });

            // Navigation handlers
            backToBasicInfoBtn.addEventListener('click', function () {
                showStep(1);
            });

            backToBusinessDetailsBtn.addEventListener('click', function () {
                showStep(2);
            });

            // Character count for description
            const description = document.getElementById('companyDescription');
            const charCount = document.querySelector('.char-count');

            description.addEventListener('input', function () {
                const count = this.value.length;
                charCount.textContent = `${count}/500 characters`;
            });

            // Initialize progress
            updateProgress(currentStep);
        });
    </script>
    <livewire:front.layout.footer />
</div>


</div>