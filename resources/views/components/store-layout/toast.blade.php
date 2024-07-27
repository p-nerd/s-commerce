@if (session()->get('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function() {
                toastr.error("{{ session()->get('error') }}");
            });
        });
    </script>
@endif

@if (session()->get('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function() {
                toastr.success("{{ session()->get('success') }}");
            });
        });
    </script>
@endif
