<h3 class="heading-style"><?=$this->translate("Cities");?></h3>

<div class="box box-primary">
    <div class="box-body bgr-every-second">
    
        <div class="row">
        	<div class="col-md-6"><?=$this->translate("Monthly subscription")?></div>
            <div class="col-md-3"><?=$this->items[0]["price"]?></div>
            <div class="col-md-3 tools">
                <a href="/manager/editsub?id=<?=$this->items[0]["id"]?>"><i class="fa fa-edit"></i></a>
            </div>
        </div>
        	
        <div class="row">
        	<div class="col-md-6"><?=$this->translate("Yearly subscription")?></div>
            <div class="col-md-3"><?=$this->items[1]["price"]?></div>
            <div class="col-md-3 tools">
                <a href="/manager/editsub?id=<?=$this->items[1]["id"]?>"><i class="fa fa-edit"></i></a>
            </div>
        </div>
        
    </div>
    
    <div class="box-footer" style="">
        <i class="ion ion-clipboard">Total: <?=$this->count?></i>
        <div class="box-tools pull-right">
            <?php echo $this->pagination?>
        </div>
    </div>
    
	<div class="box-footer clearfix no-border">
    <a href="/manager/addcity" type="button" class="btn btn-default pull-left"><i class="fa fa-plus"></i><?=$this->translate("Add");?></a>
    </div>
    
    
    
</div>




<script>

</script>