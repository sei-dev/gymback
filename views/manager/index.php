<h3 class="heading-style"><?=$this->translate("Users");?></h3>

<div class="box box-primary">
    <div class="box-body">
        <ul class="todo-list ui-sortable">
        <?php foreach ($this->users as $one):?>
        <li>
            <!-- <span class="">
            <i class="fa fa-ellipsis-v"></i>
            </span> -->
            <span class="text"><?=$one["first_name"]?> <?=$one["last_name"]?></span>
            <span class="label label-success"><?=$one["email"]?></span>
            <span class="label label-success"><?=$one["phone"]?></span>
            <span class="label label-success"><?=$one["location"]?></span>
            <span class="label label-success"><?=$one["deadline"] . "h"?></span>
            <span class="label label-success"><?php if($one["is_trainer"]==0||$one["is_trainer"]=="0") echo $this->translate("Client"); else echo $this->translate("Trainer");?></span>
            <small class="label label-danger"><i class="fa fa-clock-o"></i> <?=$this->humanReadable($one["created_on"])?></small>
            <div class="tools">
                <a href="/manager/edituser?id=<?=$one["id"]?>"><i class="fa fa-edit"></i></a>
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
