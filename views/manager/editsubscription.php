<form class="req-forms" id="search_form" method="post"
	action="updatesubscription" enctype="multipart/form-data">
	<h3 class="heading-style">
            <?php
            if ($this->subscription['id'] == 1) {
                echo 'Monthly Subscription';
            } elseif ($this->subscription['id'] == 2) {
                echo 'Yearly Subscription';
            } else {
                echo 'Subscription';
            }
            ?>
        </h3>
	<div class="box box-primary">
		<div class="box-body">

			<!-- Price Input Row -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="text-primary"><?php echo $this->translate("Price"); ?></label>
						<input placeholder="<?php echo $this->translate("Price"); ?>"
							class="form-control" type="text" name="price"
							value="<?php echo $this->subscription['price']; ?>" />
					</div>
				</div>
			</div>

			<!-- Hidden ID Input Row -->
			<div style="display: none" class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input class="form-control" type="text" id="id" name="id"
							value="<?php echo $this->subscription['id']; ?>" />
					</div>
				</div>
			</div>

			<!-- Submit Button Row -->
			<div class="row">
				<div class="col-md-12">
					<button name="submit" type="submit"
						class="btn btn-primary btn-block btn-flat">Submit</button>
				</div>
			</div>

		</div>
	</div>
</form>


<script>

</script>