<h3 class="heading-style"><?=$this->translate("Measurements");?></h3>

<div class="box box-primary">
    <div class="box-body">
        <ul class="todo-list ui-sortable">
        <?php foreach ($this->items as $one):?>
        <li>
            <!-- <span class="">
            <i class="fa fa-ellipsis-v"></i>
            </span> -->
            <span class="text"><?=$one["trainer_name"]?></span>
            <span class="label label-success"><?=$this->translate("Client") . ": " . $one["client_name"]?></span>
            <span class="label label-success"><?=$this->translate("Height") . ": " . $one["height"]." cm"?></span>
            <span class="label label-success"><?=$this->translate("Weight") . ": " . $one["weight"]." cm"?></span>
            <span class="label label-success"><?=$this->translate("Waist") . ": " . $one["waist"]." cm"?></span>
            <span class="label label-success"><?=$this->translate("Biceps") . ": " . $one["biceps"]." cm"?></span>
            <span class="label label-success"><?=$this->translate("Neck") . ": " . $one["neck"]." cm"?></span>
            <span class="label label-success"><?=$this->translate("Chest") . ": " . $one["chest"]." cm"?></span>
            <span class="label label-success"><?=$this->translate("Gluteus") . ": " . $one["gluteus"]." cm"?></span>
            <span class="label label-success"><?=$this->translate("Lower leg") . ": " . $one["lower_leg"]." cm"?></span>
            <small class="label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["measured_at"])?></small>
            <div class="tools">
                <!-- <a href="/manager/editmeasurements?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a> -->
                <i class="fa fa-trash-o"></i>
            </div>
        </li>
        <?php endforeach;?>
        </ul>
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
