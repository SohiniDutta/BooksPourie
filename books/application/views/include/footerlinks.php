<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script defer src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script defer src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script defer src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script defer src="<?php echo base_url(); ?>assets/dist/js/lazy-loading.js"></script>
<script defer src="<?php echo base_url(); ?>scripts/common.js"></script>
<script type="text/javascript">
	let localurl = "<?php echo base_url(); ?>";
	$.ajaxSetup({
        data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
    });
</script>