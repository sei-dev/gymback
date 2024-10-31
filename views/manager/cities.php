<h3 class="heading-style"><?=$this->translate("Cities");?></h3>

<div class="box box-primary">
    <div class="box-body bg-every-second">
    
        <?php foreach ($this->items as $one):?>
        
            <!-- <span class="">
            <i class="fa fa-ellipsis-v"></i>
            </span> -->
            <div class="row">
            <div class="col-md-11"><?=$one["city"]?></div>
            <div class="col-md-1 tools">
                <i class="fa fa-trash-o"></i>
            </div>
        	</div>
        <?php endforeach;?>
        
    </div>
    
    <div class="box-footer" style="">
        <i class="ion ion-clipboard">Total: <?=$this->count?></i>
        <div class="box-tools pull-right">
            <?php echo $this->pagination?>
        </div>
    </div>
    
	<div class="box-footer clearfix no-border">
    <button type="button" class="btn btn-default pull-left"><i class="fa fa-plus"></i><?=$this->translate("Add");?></button>
    </div>
    
    
    
</div>




<script>

</script>