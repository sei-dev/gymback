<h3 class="heading-style"><?=$this->translate("Trainings");?></h3>

<div class="box box-primary">
    <div class="box-body">
        <ul class="todo-list ui-sortable">
        <?php foreach ($this->items as $one):?>
        <li>
            <!-- <span class="">
            <i class="fa fa-ellipsis-v"></i>
            </span> -->
            <span class="text"><?=$one["name"]?></span>
            <span class="label label-success"><?=$one["gym"]?></span>
            <span class="label label-success"><?php if($one["is_group"]==0||$one["is_group"]=="0") echo $this->translate("Independent"); else echo $this->translate("Group");?></span>
            <span class="label label-success"><?=$one["date"]?></span>
            <span class="label label-success"><?=$one["time"]?></span>
            <small class="label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["created_at"])?></small>
            <div class="tools">
                <!-- <a href="/manager/edittraining?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a> -->
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
