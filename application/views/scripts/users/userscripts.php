<script type="text/javascript" src="<?php echo base_url().'scripts/users.js'; ?>"></script>
<script type="text/javascript">
$(function($) {
    <?php if (!empty($customerData)) { ?>
            if( $('#userslist').length ) {
                $('#userslist').DataTable({
                	"responsive": true,
                    "processing": true,
                    "serverSide": true,
                    "autoWidth"	: true,
                    "bSort"     : false,
                    "ajax" : {
                        "url" : localurl+"users/getAllUsers_ajax",
                        "type" : "POST",
                    },
                    "deferRender": true,
                    "columns": <?php echo !empty($customerData)?$customerData:''; ?>,
                    "language": {
                        infoEmpty: "No records found",
                    }
                });    
            }
    <?php } ?>
});

</script>