<!DOCTYPE html>
<html>
<title><?php echo $title;?></title>

<head>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets').'/';?>img/favicon.ico">
    <!--Let browser know website is optimized for mobile-->
    <link rel="stylesheet" href="<?php echo base_url('assets').'/';?>bower_components/Materialize/dist/css/materialize.css">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url('assets').'/';?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url('assets').'/';?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets').'/';?>css/jquery.fancybox.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets').'/';?>css/linearfonts.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="<?php echo base_url('assets').'/';?>bower_components/Materialize/dist/js/materialize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

	<header>
			<nav class="blue darken-4">
			<?php   $menus = $this->menu_model->viewmenus(); 	  ?>
			<?php   $ProjectTitle = $this->menu_model->getProjectTitle(); 	  ?>
			<ul id="slide-out" class="side-nav fixed">
			<li class="sub-menu logo">
                    		<?php   if($ProjectTitle->name !="") 	{ ?>
						<a id="logo-container" href="<?php echo site_url(); ?>" class="align-center blue-text text-darken-4" style="font-size: 28px;">
                           
                            <span style="font-weight: 400;"><?php echo $ProjectTitle->name ?></span>
						</a>
						<?php }
                    else if($ProjectTitle->logo !=""){
                    ?>
                    <div class="logo">
							<img src="<?php echo base_url('uploads').'/'.$ProjectTitle->logo; ?>" width="40" style="margin-top: 15px;margin-left: 15px; margin-right: 5px;">
						</div>
						
						<?php }?>

                    </li>
                    <?php
				foreach($menus as $row)
				{
					$pieces = explode("/", $row->url);
					$page2="";
					if(empty($pieces) || !isset($pieces[1]))
					{
						$page2="";
					}
					else
						$page2=$pieces[1];
					$submenus = $this->menu_model->getsubmenus($row->id);
					?>
                        <li class="<?php if($page==$page2 || $page == strtolower($row->name)) { echo 'active'; } //echo $page2;
					if(count($submenus > 0))
					{
						$pages =  $this->menu_model->getpages($row->id);
						//echo $page2;
						//print_r($pages);
						echo ' sub-menu';
						if(in_array($page, $pages,TRUE))
							echo ' active';
					}
					?> ">
                            <a class="waves-effect waves-default" href="<?php
						if($row->url == " ")
							echo "javascript:; ";
						else if($row->linktype == 1) echo site_url($row->url);
						else if($row->linktype == 2) echo base_url($row->url);
						else if($row->linktype == 3) echo ($row->url);
						?>" <?php if($row->linktype == 3) echo ""; ?>>
							<?php
							if($row->icon != "")
							{  ?>
								<i class="<?php echo $row->icon; ?>"></i>
					<?php	}
							?>
							<span><?php echo $row->name;  ?></span>
							<span class="arrow"></span>
						</a>
                            <?php
						if(count($submenus) > 0)
						{  ?>
                                <ul class="sub">
                                    <?php
								foreach($submenus as $row2)
								{
									$pieces2 = explode("/", $row2->url);

									if(empty($pieces2) || !isset($pieces2[1]))
									{
										$page3="";
									}
									else
										$page3=$pieces2[1];
								?>
                                    <li class="<?php if($page==$page3 || $page == strtolower($row2->name))  ?> nopadding">
                                            <a class="waves-effect waves-default" href="<?php
											if($row2->url == " ")
												echo "javascript:; ";
											else if($row2->linktype == 1) echo site_url($row2->url);
											else if($row2->linktype == 2) echo base_url($row2->url);
											else if($row2->linktype == 3) echo ($row2->url);
										?>">
                                                <?php
											if($row2->icon != "")
											{  ?>
                                                    <i class="<?php echo $row2->icon; ?>" <?php if($row2->linktype == 3) echo ""; ?>></i>
                                                    <?php	}
											?>
                                                        <?php echo $row2->name;  ?>
                                            </a>
                                        </li>
                                        <?php	}
								?>
                                </ul>
                                <?php	}
						?>
                        </li>
                        <?php }
				?>
                </ul>

                <div class="row">
                    <div class="col s6">
                        <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                    </div>
                    <div class="col s6 offset-l6 m6 l6 search">
                        <a href="<?php echo site_url('login/logout'); ?>" class="waves-effect waves-light btn red" style="float:right; margin: 7px 0 0;"><i class="material-icons left">power_settings_new</i> Logout</a>
                    </div>
                </div>
        </nav>


    </header>
    <main>

	<div class="row">
		<div class="col s12">
			<h4 class="pad-left-15 capitalize">Add Invoice
			</h4>
		</div>
	<form action="<?php echo site_url('site/createinvoicelistsubmit');?>" method="post" enctype= 'multipart/form-data'>
		<div class="row">
				<div class="col s2">Sr no</div>
				<div class="col s2">Job Number</div>
				<div class="col s2">Value of Work</div>
				<div class="col s2">Balance</div>
				<div class="col s2">Amount</div>
		</div>
		<hr>
		<?php $i=1;?>
			<?php foreach ($jobnumberlist as $singleJobNum) { ?>
			<div class="row">
				<div class="col s2"><?php echo $i;?></div>
				<div class="col s2"><?php echo $singleJobNum->jobnumber;?></div>
				<div class="col s2"><?php echo $singleJobNum->valueofwork;?></div>
				<div class="col s2"><?php echo $singleJobNum->balance;?></div>
				<?php if($singleJobNum->balance == 0) {
					$readonlytext = 'readonly';
					$placeholderText = 'No Balance Amount Left';
				} else {
					$readonlytext = '';
					$placeholderText = 'Enter Amount';
				}?>
				<div class="col s2">
					<input placeholder="<?php echo $placeholderText?>" <?php echo $readonlytext;?> id="<?php echo "payment_".$singleJobNum->id;?>" name="<?php echo "payment_".$singleJobNum->id;?>" type="text" required class="validate getamt">
				</div>
				
			</div>
			<hr>
			<?php
				$i++;
			}?>
			<div class="row">
				<div class="col s4" style="margin-right: 219px;">
				<span id="totalsum"></span><br>
					<span id="notetext" style="font-size: 14px;
    color: red;"></span>
				</div>
			</div>
			
			<div class="row">
					<div class="file-field input-field col s12 l3">
						<div class="btn blue darken-4">
						<span>Upload Invoice</span>
						<input type="file" name="image">
						</div>
						<div class="file-path-wrapper">
						<input class="file-path validate" type="text" placeholder="Upload Invoice" value='<?php echo set_value('image');?>' required>
						</div>
					</div>
					<div class="input-field col l3 s12">
						<input id="invoiceamount" type="text" class="validate getinvamt" name="invoiceamount" required>
						<label for="invoiceamount">Total Invoice Amount *</label>
					</div>
					<div class="input-field col l3 s12">
						<input id="invoicenumber" type="text" class="validate" name="invoicenumber" required>
						<label for="invoicenumber">Invoice Number  *</label>
					</div>
			</div>
			<div class="row">
				<div class="col s6 m6">
					<button type="submit"  class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
					<a href="<?php echo site_url("site/viewtransaction"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
				</div>
			</div>

	</form>
    </div>


<!-- End Date Modal Starts -->
</main>
</body>
</html>
<script>
var totalsum = 0;
var invamt = 0;
$(document).on("change", ".getamt", function() {
    var sum = 0;
    $(".getamt").each(function(){
        sum += +$(this).val();
    });
	$("#totalsum").html("Total Paid Amount is : "+sum);
    totalsum = sum
	if(totalsum && totalsum !=0 && invamt && invamt !=0){
		if(totalsum != invamt){
			$("#notetext").html("Please note : Paid amount and invoice amount is not same");
		} else {
			$("#notetext").html("");
		}
	}
});
$(document).on("change", ".getinvamt", function() {
	 invamt = $('.getinvamt').val();
	if(totalsum && totalsum !=0 && invamt && invamt !=0){
		if(totalsum != invamt){
			$("#notetext").html("Please note paid amount and invoice amount is not same");
		} else {
			$("#notetext").html("");
		}
	}
});
</script>

