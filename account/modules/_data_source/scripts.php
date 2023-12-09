<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="./_vendors/libs/jquery/jquery.min.js"></script>
<script src="./_vendors/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./_vendors/libs/metismenu/metisMenu.min.js"></script>
<script src="./_vendors/libs/simplebar/simplebar.min.js"></script>
<script src="./_vendors/libs/node-waves/waves.min.js"></script>

<!-- validation init -->
<script src="./_vendors/js/pages/validation.init.js"></script>

<!-- Required datatable js -->
<script>	
    new DataTable('#tradeTable');
</script>
<script src="./_vendors/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="./_vendors/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="./_vendors/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="./_vendors/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="./_vendors/libs/jszip/jszip.min.js"></script>
<script src="./_vendors/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="./_vendors/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="./_vendors/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="./_vendors/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="./_vendors/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="./_vendors/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="./_vendors/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="./_vendors/js/pages/datatables.init.js"></script>

<!-- dashboard init -->
<script src="./_vendors/js/pages/dashboard.init.js"></script>

<script>
    const now = new Date();
    const hour = now.getHours();
    const greeting = hour >= 5 && hour < 12 ? "Good morning" : hour >= 12 && hour < 16 ? "Good afternoon" : "Good evening";
    document.getElementById('greeting').textContent = `${greeting}`;
</script>

<!-- App js -->
<script src="./_vendors/js/app.js"></script>

<script>
    document.querySelectorAll('.copy-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var input = document.getElementById(this.dataset.copytarget);
            input.select();
            input.setSelectionRange(0, 99999);

            try {
                document.execCommand('copy');
            } catch (err) {
                console.log('Copy failed:', err);
            }
        });
    });
</script>

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js-eu1.hs-scripts.com/143770756.js"></script>
<!-- End of HubSpot Embed Code -->

<script>
    document.getElementById("walletSelect").addEventListener("change", function() {
        var selectedWallet = this.value;
        var walletDivs = document.querySelectorAll("[data-wallet]");

        walletDivs.forEach(function(walletDiv) {
            walletDiv.classList.toggle("d-none", walletDiv.dataset.wallet !== selectedWallet);
        });
    });
</script>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');
    }
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- script for BUY and SELL -->
<script>
    $(document).ready(function() {
        $(".stk").hide();
        $(".cyt").hide();
        $(".fx").hide();
        $(".rdata").hide();

        $(document).on("change", ".type", function() {
            var value = $(this).val();
            $(".stk").toggle(value === "Stocks").prop("disabled", value !== "Stocks");
            $(".cyt").toggle(value === "Crypto").prop("disabled", value !== "Crypto");
            $(".fx").toggle(value === "Forex").prop("disabled", value !== "Forex");
            $(".rdata").show();
        });

        $(document).on("keyup", ".amount", function() {
            var value = $(this).val();
            if (value != "" && value >= 10) {
                $(".amount").attr("style", "border: 1px solid green");
                $(".sbt").attr("disabled", false);
            }
        });
    });
</script>