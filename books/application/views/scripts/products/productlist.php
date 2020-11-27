<script defer src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'scripts/products.js'; ?>"></script>
<script type="text/javascript">
$(function($) {
    <?php if (!empty($mast_pro_dept_list)) { ?>
            if( $('#mastercategorylist').length ) {
                $('#mastercategorylist').DataTable({
                	"responsive": true,
                    "processing": true,
                    "serverSide": true,
                    "autoWidth"	: true,
                    "bSort"     : false,
                    "ajax" : {
                        "url" : localurl+"products/getMasterCategoryList_ajax",
                        "type" : "POST",
                    },
                    "deferRender": true,
                    "columns": <?php echo !empty($mast_pro_dept_list)?$mast_pro_dept_list:''; ?>,
                    "language": {
                        infoEmpty: "No records found",
                    }
                });    
            }
    <?php } ?>
    <?php if (!empty($sub_cat_list)) { ?>
            if( $('#subcategorylist').length ) {
                $('#subcategorylist').DataTable({
                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    "autoWidth" : true,
                    "bSort"     : false,
                    "ajax" : {
                        "url" : localurl+"products/getSubCategoryList_ajax",
                        "type" : "POST",
                    },
                    "deferRender": true,
                    "columns": <?php echo !empty($sub_cat_list)?$sub_cat_list:''; ?>,
                    "language": {
                        infoEmpty: "No records found",
                    }
                });    
            }
    <?php } ?>

    <?php if (!empty($mast_brand_data)) { ?>
            if( $('#brandlist').length ) {
                $('#brandlist').DataTable({
                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    "autoWidth" : true,
                    "bSort"     : false,
                    "ajax" : {
                        "url" : localurl+"products/getBrandList_ajax",
                        "type" : "POST",
                    },
                    "deferRender": true,
                    "columns": <?php echo !empty($mast_brand_data)?$mast_brand_data:''; ?>,
                    "language": {
                        infoEmpty: "No records found",
                    }
                });    
            }
    <?php } ?>

    <?php if (!empty($products_data)) { ?>
            if( $('#productslist').length ) {
                $('#productslist').DataTable({
                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    "autoWidth" : true,
                    "bSort"     : false,
                    "ajax" : {
                        "url"  : localurl+"products/getproductList_ajax",
                        "type" : "POST",
                    },
                    "deferRender": true,
                    "columns": <?php echo !empty($products_data)?$products_data:''; ?>,
                    "language": {
                        infoEmpty: "No records found",
                    }
                });    
            }
    <?php } ?>
});

$(function() {
    if ($('.select2').length>0) {
        $('.select2').select2();
    }

});

</script>