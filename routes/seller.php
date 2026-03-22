<?php
// FILE: routes/seller.php
// CHANGES FROM ORIGINAL:
//   1. Line 3: Auth::class  →  SellerAuth::class
//   2. Line 99: ->name('seller')  →  ->name('seller.dashboard')
//   All other routes UNCHANGED

use App\Http\Middleware\SellerAuth;   // <-- CHANGED from: use App\Http\Middleware\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Seller\SellerDashboard;
use App\Livewire\Seller\ShipmentData;
use App\Livewire\Seller\ProductAdd;
use App\Livewire\Seller\SellerProductEdit;
use App\Livewire\Seller\ProductGallery;
use App\Livewire\Seller\ProductList;
use App\Livewire\Seller\TotalLead;
use App\Livewire\Seller\TotalData;
use App\Livewire\Seller\TotalProductView;
use App\Livewire\Seller\TotalWebsiteLinks;
use App\Livewire\Seller\Profile;
use App\Livewire\Seller\TotalEnquiries;
use App\Livewire\Seller\TotalBuyleadEnquiry;
use App\Livewire\Seller\PrimaryDetails;
use App\Livewire\Seller\BusinessDetails;
use App\Livewire\Seller\SellerPackage;
use App\Livewire\Seller\SelleractivePackage;
use App\Livewire\Seller\Invoice;
use App\Livewire\Seller\Project;
use App\Livewire\Seller\InvoiceList;
use App\Livewire\Seller\WebsiteLead;
use App\Livewire\Seller\Review;
use App\Livewire\Seller\Logo;
use App\Livewire\Seller\Socialmedia;
use App\Livewire\Seller\ContactUs;
use App\Livewire\Seller\ProCat;
use App\Livewire\Seller\Pro;
use App\Livewire\Seller\Slider;
use App\Livewire\Seller\Testimonial;
use App\Livewire\Seller\CompanyInfo;
use App\Livewire\Seller\Whychoose;
use App\Livewire\Seller\Gallery;
use App\Livewire\Seller\Brochure;
use App\Livewire\Seller\TermsConditionsWebsite;
use App\Livewire\Seller\RefundPolicy;
use App\Livewire\Seller\Privacypolicy;
use App\Livewire\Seller\WhereWeExportcountry;
use App\Livewire\Seller\StatutoryDetails;
use App\Livewire\Seller\NotificationList;
use App\Livewire\Seller\TasksList;
use App\Livewire\Seller\ShowNotification;
use App\Livewire\Seller\PortfolioSlider;
use App\Livewire\Seller\PostrequirementList;
use App\Livewire\Seller\MyPackage;
use App\Livewire\Seller\MyProducts;
use App\Livewire\Seller\Opportunities;
use App\Livewire\Seller\MyResources;
use App\Livewire\Seller\ExportInformation;
use App\Livewire\Seller\Tools;
use App\Livewire\Seller\QuotationForm;
use App\Livewire\Seller\ReferenceMaterialList;
use App\Livewire\Seller\ProductReportList;
use App\Livewire\Seller\CreateTradeDocs;
use App\Livewire\Seller\ShipmentcheckList;
use App\Livewire\Seller\ActionPlan;
use App\Livewire\Seller\Templates;
use App\Livewire\Seller\LoisPage;
use App\Livewire\Seller\PosPage;
use App\Livewire\Seller\AdvanceSupport;
use App\Livewire\Seller\ShipmentData as SellerShipmentDataAlias;
use App\Livewire\Seller\VerifybuyersList;
use App\Livewire\Seller\MyDocumentList;
use App\Livewire\Seller\Batchespage;
use App\Livewire\Seller\Lecturespage;
use App\Livewire\Seller\CreateWebsiteForm;
use App\Livewire\Seller\Certificate;
use App\Livewire\Seller\Team;
use App\Livewire\Seller\Videos;
use App\Livewire\Seller\ProformaInvoice;
use App\Livewire\Seller\ProformaDownload;
use App\Livewire\Seller\CommercialInvoice;
use App\Livewire\Seller\CommercialDownload;
use App\Livewire\Seller\PackingListInvoice;
use App\Livewire\Seller\PackinglistDownload;
use App\Livewire\Seller\PurchaseOrder;
use App\Livewire\Seller\PurchaseorderDownload;
use App\Livewire\Seller\InvoiceLists;
use App\Livewire\Seller\Hotdealproductform;
use App\Livewire\Seller\SuppliersandImporters;
use App\Livewire\Seller\BuyerInformasion;
use App\Livewire\Seller\SuppliersInformasion;
use App\Livewire\Seller\SuppliersandImportersInformasion;
use App\Livewire\Seller\EmbassyContactsShow;
use App\Livewire\Seller\SocialMediaGroupShow;
use App\Livewire\Seller\FaqsShow;
use App\Livewire\Seller\LatterHead;
use App\Livewire\Seller\LatterheadList;
use App\Livewire\Seller\LatterHeadForm;
use App\Livewire\Seller\VCard;
use App\Livewire\Seller\VCardList;
use App\Livewire\Seller\ChamberMembershipCard;
use App\Livewire\Seller\SellerShipmentdataList;
use App\Livewire\Seller\ExpoterCompanyDetails;
use App\Livewire\Seller\SearchShipmentdatalist;
use App\Livewire\Seller\DistributionInquiries;
use App\Livewire\Seller\SellerQueryTickets;
use App\Livewire\Seller\QueryTicketsDetails;
use App\Livewire\Seller\DigitalInformationForm;
use App\Livewire\Seller\MyListings;
use App\Livewire\Seller\ServiceAdd;
use App\Livewire\Seller\RFQList;
use App\Livewire\Seller\Quotations as SellerQuotations;
 
use App\Http\Controllers\Seller\ProfileController;

Route::get('/seller/profile', [ProfileController::class,'profile'])->name('seller.profile');

Route::middleware([SellerAuth::class])->group(function () {  // <-- CHANGED from: Auth::class

    Route::get('/seller/dashboard', SellerDashboard::class)->name('seller.dashboard');  // <-- CHANGED from: ->name('seller')

    Route::get('/seller/shipment-data', ShipmentData::class)->name('shipment-data');
    Route::get('/seller/product_add', ProductAdd::class)->name('product_add');
    Route::get('/seller/seller_product_edit/{productId}', SellerProductEdit::class)->name('seller-product-edit');
    Route::get('/seller/product_gallery/{productId}', ProductGallery::class)->name('product_gallery');
    Route::get('/seller/product_list', ProductList::class)->name('product_list');
    Route::get('/seller/total_lead', TotalLead::class)->name('total_lead');
    Route::get('/seller/total_data', TotalData::class)->name('total_data');
    Route::get('/seller/total_product_view', TotalProductView::class)->name('total_product_view');
    Route::get('/seller/total_website', TotalWebsiteLinks::class)->name('total_website');
    Route::get('/seller/profile', Profile::class)->name('seller.profile');
    Route::get('/seller/product_enquiries', TotalEnquiries::class)->name('enquiries');
    Route::get('/seller/buylead_enquiries/{postrequirementID}', TotalBuyleadEnquiry::class)->name('buyleadenquiries');
    Route::get('/seller/primary_details', PrimaryDetails::class)->name('primary_details');
    Route::get('/seller/business_details', BusinessDetails::class)->name('business_details');
    Route::get('/seller/seller_package', SellerPackage::class)->name('seller_package');
    Route::get('/seller/seller_active_package', SelleractivePackage::class)->name('seller_active_package');
    Route::get('/seller/invoice', Invoice::class)->name('invoice');
    Route::get('/seller/project', Project::class)->name('project');
    Route::get('/seller/invoice-list', InvoiceList::class)->name('invoice-list');
    Route::get('/seller/website-lead', WebsiteLead::class)->name('website-lead');
    Route::get('/seller/review', Review::class)->name('review');
    Route::get('/seller/logo', Logo::class)->name('logo');
    Route::get('/seller/socialmedia', Socialmedia::class)->name('socialmedia');
    Route::get('/seller/contact_us', ContactUs::class)->name('contact_us');
    Route::get('/seller/pro_cat', ProCat::class)->name('pro_cat');
    Route::get('/seller/pro', Pro::class)->name('pro');
    Route::get('/seller/slider', Slider::class)->name('slider');
    Route::get('/seller/testimonial', Testimonial::class)->name('testimonial');
    Route::get('/seller/company_info', CompanyInfo::class)->name('company_info');
    Route::get('/seller/whychoose', Whychoose::class)->name('whychoose');
    Route::get('/seller/gallery', Gallery::class)->name('gallery');
    Route::get('/seller/brochure', Brochure::class)->name('brochure');
    Route::get('/seller/terms-conditions-website', TermsConditionsWebsite::class)->name('terms-conditions-website');
    Route::get('/seller/refund-policy', RefundPolicy::class)->name('refund-policy');
    Route::get('/seller/privacypolicy', Privacypolicy::class)->name('privacypolicy');
    Route::get('/seller/where-we-exportcountry', WhereWeExportcountry::class)->name('where-we-exportcountry');
    Route::get('/seller/statutory_details', StatutoryDetails::class)->name('statutory_details');
    Route::get('/seller/seller-notification-list', NotificationList::class)->name('seller-notification-list');
    Route::get('/seller/tasks/{projectId}', TasksList::class)->name('tasks-list');
    Route::get('/seller/show-notification/{id}', ShowNotification::class)->name('show-notification');
    Route::get('/seller/slider-image', PortfolioSlider::class)->name('slider-image');
    Route::get('/seller/postrequirement-list', PostrequirementList::class)->name('postreq-list');
    Route::get('/seller/my-package', MyPackage::class)->name('my-package');
    Route::get('/seller/my-products', MyProducts::class)->name('my-products');
    Route::get('/seller/opportunities', Opportunities::class)->name('opportunities');
    Route::get('/seller/my-resources', MyResources::class)->name('my-resources');
    Route::get('/seller/export-information', ExportInformation::class)->name('export-information');
    Route::get('/seller/tools', Tools::class)->name('tools');
    Route::get('/seller/quotation-form', QuotationForm::class)->name('quotation-form');

    Route::get('/seller/reference-material-list/{procatId}', ReferenceMaterialList::class)->name('reference-materials');
    Route::get('/seller/product-report-list/{procatId}', ProductReportList::class)->name('product-reports');
    Route::get('/seller/create-trade-list/{procatId}', CreateTradeDocs::class)->name('create-trade');
    Route::get('/seller/shipmentcheck-list/{procatId}', ShipmentcheckList::class)->name('shipment-list');
    Route::get('/seller/action-plan/{procatId}', ActionPlan::class)->name('action-plan');
    Route::get('/seller/templates/{procatId}', Templates::class)->name('templates');
    Route::get('/seller/lois/{procatId}', LoisPage::class)->name('lois');
    Route::get('/seller/pos/{procatId}', PosPage::class)->name('pos');
    Route::get('/seller/advance-support', AdvanceSupport::class)->name('advance-support');
    Route::get('/seller/real-shipmentdata-list', ShipmentData::class)->name('realshipment-data');
    Route::get('/seller/verifybuyers-list', VerifybuyersList::class)->name('verifybuyers-list');
    Route::get('/seller/my-documents', MyDocumentList::class)->name('documents');
    Route::get('/seller/batches', Batchespage::class)->name('batches');
    Route::get('/seller/lectures/{batchId}', Lecturespage::class)->name('lectures');
    Route::get('/seller/create-website', CreateWebsiteForm::class)->name('create-website');
    Route::get('/seller/certificate', Certificate::class)->name('certificate');
    Route::get('/seller/team', Team::class)->name('team');
    Route::get('/seller/videos', Videos::class)->name('videos');

    Route::get('/seller/proforma-invoice', ProformaInvoice::class)->name('ProformaInvoice');
    Route::get('/seller/proforma-download/{id}', ProformaDownload::class)->name('proforma-download');

    Route::get('/seller/commercial-invoice', CommercialInvoice::class)->name('CommercialInvoice');
    Route::get('/seller/commercial-download/{id}', CommercialDownload::class)->name('commercial-download');

    Route::get('/seller/packing-list-invoice', PackingListInvoice::class)->name('PackingListInvoice');
    Route::get('/seller/packinglist-download/{id}', PackinglistDownload::class)->name('packinglist-download');

    Route::get('/seller/purchase-order', PurchaseOrder::class)->name('PurchaseOrder');
    Route::get('/seller/purchaseorder-download/{id}', PurchaseorderDownload::class)->name('purchaseorder-download');

    Route::get('/seller/invoice-lists/{type}', InvoiceLists::class)->name('invoice-lists');
    Route::get('/seller/hotdealproductform', Hotdealproductform::class)->name('hotdealproductform');
    Route::get('/seller/suppliersand-importers', SuppliersandImporters::class)->name('suppliersand-importers');
    Route::get('/seller/buyer-information', BuyerInformasion::class)->name('buyer-informasion');
    Route::get('/seller/suppliers-informasion', SuppliersInformasion::class)->name('suppliers-informasion');
    Route::get('/seller/suppliersand-importers-informasion', SuppliersandImportersInformasion::class)->name('suppliersand-importers-informasion');

    Route::get('/seller/embassy-contacts-show', EmbassyContactsShow::class)->name('embassy-contacts-show');
    Route::get('/seller/social-media-group-show', SocialMediaGroupShow::class)->name('social-media-group-show');
    Route::get('/seller/faqs-show', FaqsShow::class)->name('faqs-show');

    Route::get('/seller/latter-head/{id}/{type?}', LatterHead::class)->name('latter-head');
    Route::get('/seller/latterhead-list', LatterheadList::class)->name('latterhead-list');
    Route::get('/seller/latter-head-form', LatterHeadForm::class)->name('latter-head-form');

    Route::get('/seller/v-card/{leadId}/{type?}', VCard::class)->name('v-card');
    Route::get('/seller/v-card-list', VCardList::class)->name('v-card-list');
    Route::get('/seller/chamber-membership-card/{leadId}', ChamberMembershipCard::class)->name('chamber-membership-card');

    Route::get('/seller/seller-shipmentdata-list', SellerShipmentdataList::class)->name('seller-shipmentdata-list');
    Route::get('/seller/expoter-company-details/{id}', ExpoterCompanyDetails::class)->name('expoter-company-details');
    Route::get('/seller/search-shipmentdatalist', SearchShipmentdatalist::class)->name('search-shipmentdatalist');
    Route::get('/seller/distribution-inquiries', DistributionInquiries::class)->name('distribution-inquiries');

    Route::get('/seller/seller-query-tickets', SellerQueryTickets::class)->name('QueryTickets');
    Route::get('/seller/query-tickets-details/{id}', QueryTicketsDetails::class)->name('QueryTicketsDetails');
    Route::get('/seller/digital-information', DigitalInformationForm::class)->name('digital-information');
    // ── Combined listings page (replaces separate product/service list pages)
    Route::get('/seller/my-listings', MyListings::class)->name('my-listings');
    Route::get('/seller/service-add', ServiceAdd::class)->name('service_add');

    Route::get('/seller/rfqs', RFQList::class)
        ->name('seller.rfqs');
        Route::get('/seller/rfq/{id}', \App\Livewire\Seller\RFQView::class)
    ->name('seller.rfq.view');
    Route::get('/seller/rfq/{id}/quote', \App\Livewire\Seller\RFQQuote::class)
    ->name('seller.rfq.quote');
Route::get('/seller/quotations', SellerQuotations::class)
    ->name('seller.quotations');
});