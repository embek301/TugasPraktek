$(document).ready(function() {
    // Function to enable or disable tgl_kontrak input based on status
    function toggleTglKontrak(status) {
        const tglKontrakInput = $("#tgl_kontrak");
        if (status === "TETAP") {
            tglKontrakInput.prop("disabled", true);
            tglKontrakInput.val(null);
        } else {
            tglKontrakInput.prop("disabled", false);
        }
    }
    // Initial state
    toggleTglKontrak($("#status").val());
    // Handle status change event
    $("#status").change(function() {
        const selectedStatus = $(this).val();
        toggleTglKontrak(selectedStatus);
    });
});


