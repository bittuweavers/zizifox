<!-- Start Footer Section  -->
<section class="footer_sec">
  <div class="container">
    <div class="content">
      <p>Copyright <?php echo date('Y'); ?> Zizifox</p>
    </div>
  </div>
</section>
<!-- End Footer Section  -->
<script type="text/javascript">
	$('.js-search-field').unbind('keyup change input paste').bind('keyup change input paste',function(e){
    var $this = $(this);
    var val = $this.val();
    var valLength = val.length;
    var maxCount = $this.attr('maxlength');
    if(valLength>maxCount){
        $this.val($this.val().substring(0,maxCount));
    }
}); 
</script>