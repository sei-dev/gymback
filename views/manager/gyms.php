<h3 class="heading-style"><?=$this->translate("Gyms");?></h3>

<div class="box">
<form class="req-forms" id="search_form" method="post" action="searchgym" enctype="multipart/form-data">
				<div class="col-md-11">
					<div class="form-group">
                		<input placeholder="<?=$this->translate("Search");?>" class="form-control" type="text" name="param" value=""/>
                	</div>
                	</div>
                	<div class="col-md-1">
                		<button name="submit" type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-search"></i></button>
                	</div>
</form>
</div>

<div class="box box-primary">
    <div class="box-body bgr-every-second">
    
        <?php foreach ($this->items as $one):?>
        
            <!-- <span class="">
            <i class="fa fa-ellipsis-v"></i>
            </span> -->
            <div class="row">
            <div class="col-md-3"><?=$one["name"]?></div>
            <div class="col-md-2"><?=$one["address"]?></div>
            <div class="col-md-2"><?=$one["city"]?></div>
            <div class="col-md-2"><?=$one["phone"]?></div>
            <div class="col-md-2 label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["created_on"])?></div>
            <div class="col-md-1 tools">
                <a href="/manager/editgym?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a>
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
    <a href="/manager/addgym" type="button" class="btn btn-default pull-left"><i class="fa fa-plus"></i><?=$this->translate("Add");?></a>
    </div>
    
    
    
</div>




<script>

</script>