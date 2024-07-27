@if (session()->get('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $(document).ready(function() {
                toastr.error("{{ session()->get('error') }}");
            });
        });
    </script>
@endif
