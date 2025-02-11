<div class="login-box">
    <div class="login-logo">
    	<a href="/"><b>GYM</b>Trainer</a>
    </div>
    
    <div class="login-box-body">
    <?php echo "<div class='error-text' style='color: #dd4b39;'>";
    if (isset($_SESSION["messages"]["errors"]["login"])) {
        echo $_SESSION["messages"]["errors"]["login"];
    }
    echo "</div>";
    ?>
        <p class="login-box-msg"><?=$this->translate("Sign in to start your session");?></p>
        <form action="" method="post">
        <div class="form-group has-feedback">
            <input type="email"  name="email", class="form-control" placeholder="<?=$this->translate("Email");?>">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="<?=$this->translate("Password");?>">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
               <a href = "https://phpstack-1301327-4732761.cloudwaysapps.com/log/tof"><?=$this->translate("Terms of Service");?></a> 
            </div>
            
            <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat"><?=$this->translate("Sign In");?></button>
            </div>
            
        </div>
        </form>
        
        <!--<a href="#">I forgot my password</a><br>-->
    </div>

</div>

<script>
 
</script>