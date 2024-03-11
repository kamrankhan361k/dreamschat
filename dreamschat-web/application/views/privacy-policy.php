<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Privacy Policy</h1>
        <div id="content">
        </div>
    </div>
<input type="hidden" id="apiKey" value="<?php echo getenv('DB_FIREBASE_APIKEY') ?>" />
<input type="hidden" id="authDomain" value="<?php echo getenv('DB_FIREBASE_AUTHDOMAIN') ?>" />
<input type="hidden" id="databaseURL" value="<?php echo getenv('DB_FIREBASE_DBURL') ?>" />
<input type="hidden" id="projectId" value="<?php echo getenv('DB_FIREBASE_PROJECTID') ?>" />
<input type="hidden" id="storageBucket" value="<?php echo getenv('DB_FIREBASE_STORAGEBUGKET') ?>" />
<input type="hidden" id="messagingSenderId" value="<?php echo getenv('DB_FIREBASE_MESSAGEID') ?>" />
<input type="hidden" id="appId" value="<?php echo getenv('DB_FIREBASE_APPID') ?>" />
<script type="text/javascript">
	        var cmethod = '<?=$this->router->fetch_method()?>';
	    </script>

<script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
<!-- Slimscroll JS -->
<script src="<?php echo base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/mainconfig.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fireconfig.js"></script>
<!-- Custom JS -->
<script  src="<?php echo base_url(); ?>assets/js/script_admin.js"></script>
<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Initialize DataTable
        var privacyTable = $('#privacyTable').DataTable({
            paging: true, // Enable pagination
            pageLength: 10, // Number of items per page
            searching: false, // Disable searching
            ordering: false, // Disable sorting
            info: false, // Disable "Showing X of Y entries"
            lengthChange: false, // Disable changing the number of items per page

            // You can add more DataTable options as needed

            language: {
                emptyTable: "No data available",
            }
        });

        // Fetch privacy policy content from Firebase and populate DataTable
        getpages();
        function getpages() {
            firebase.database().ref("data/websitepages").once('value', function(snapshot) {
                if (snapshot.val() != null) {
                    var privacyPolicy = snapshot.val().privacy_policy;
                    // Split the content into paragraphs or lines as needed
                    var paragraphs = privacyPolicy.split("\n"); // Change delimiter as needed

                    // Add each paragraph to the DataTable
                    for (var i = 0; i < paragraphs.length; i++) {
                        privacyTable.row.add([paragraphs[i]]);
                    }

                    // Draw the DataTable
                    privacyTable.draw();
                }
            });
        }
    });
</script>

    
</body>
</html>