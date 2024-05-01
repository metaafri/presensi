<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="{{ asset('assets/template/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/template/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/template/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/template/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('assets/template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/template/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('assets/template/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('assets/template/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/template/vendor/js/menu.js') }}"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/template/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/template/vendor/libs/swiper/swiper.js') }}"></script>
<script src="{{ asset('assets/template/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/template/js/main.js') }}"></script>

<!-- Page JS -->
@stack('page-js')
