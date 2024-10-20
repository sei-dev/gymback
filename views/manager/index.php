<h3 class="heading-style"><?=$this->translate("Users");?></h3>

<div class="box box-primary">
    <div class="box-body bgr-every-second">
        
        <?php foreach ($this->users as $one):?>
        <div class="row">
            <div class="col-md-1"><span class="circular--portrait"> <img src="/images/blank.webp" /></span></div>
            <div class="col-md-2"><?=$one["first_name"]?> <?=$one["last_name"]?></div>
            <div class="col-md-2"><?=$one["email"]?></div>
            <div class="col-md-2 text "><?=$one["phone"]?></div>
            <div class="col-md-1 text "><?=$one["location"]?></div>
            <div class="col-md-1 text "><?=$one["deadline"] . "h"?></div>
            <div class="col-md-1 label label-success"><?php if($one["is_trainer"]=="0") echo $this->translate("Client"); else echo $this->translate("Trainer");?></div>
            <div class="col-md-1 label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["created_on"])?></div>
            <div class="col-md-1 tools">
                <a href="/manager/edituser?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a>
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
    
    <!-- <div class="box-footer clearfix no-border">
    <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
    </div> -->
    
    
    
</div>




<script>

</script>