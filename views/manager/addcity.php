<form class="req-forms" id="search_form" method="post" action="updategym" enctype="multipart/form-data">
	<h3 class="heading-style"><?=$this->translate("Add city");?></h3>
	<div class="box box-primary">
		<div class="box-body">
		
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
                		<label class="text-primary"><?=$this->translate("City");?></label>
                		<input placeholder="<?=$this->translate("City");?>" class="form-control" type="text" name="city" value=""/>
                	</div>
                </div>
                
			</div>
            
			
        <div class="row">
            <div class="col-md-12">
            	<button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div>
        </div>
        
        
		</div>
	</div>
</form>			


<script>

</script>